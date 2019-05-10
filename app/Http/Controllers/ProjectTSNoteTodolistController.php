<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSNoteTodolistRequest;
use App\Http\Requests\UpdateProjectTSNoteTodolistRequest;
use App\Repositories\ProjectTSNoteTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSNoteTodolistController extends AppBaseController
{
    private $projectTSNoteTodolistRepository;

    public function __construct(ProjectTSNoteTodolistRepository $projectTSNoteTodolistRepo)
    {
        $this->projectTSNoteTodolistRepository = $projectTSNoteTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->projectTSNoteTodolistRepository->pushCriteria(new RequestCriteria($request));
            $projectTSNoteTodolists = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->join('project_t_s_note_todolists', 'project_t_s_notes.id', '=', 'project_t_s_note_todolists.p_t_s_n_id')->where('projects.user_id', '=', $user_id)->where(function ($query) {$query->where('project_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_note_todolists.status', '=', 'active');})->orderBy('project_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('project_t_s_note_todolists.index')
                ->with('projectTSNoteTodolists', $projectTSNoteTodolists);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        if(Auth::user() != null)
        {
            return view('project_t_s_note_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSNoteTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_t_s_notes.id', $request -> p_t_s_n_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $projectTSNoteTodolist = $this->projectTSNoteTodolistRepository->create($input);
    
            DB::table('project_t_s_note_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_n_t_id' => $projectTSNoteTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTSNoteTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_n_todo_c', 'user_id' => $user_id, 'entity_id' => $projectTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S Note Todolist saved successfully.');
            return redirect(route('projectTSNotes.show', [$projectTSNoteTodolist -> p_t_s_n_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            
            DB::table('project_t_s_note_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_n_t_id' => $id]);
            DB::table('project_t_s_note_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $projectTSNoteTodolist = $this->projectTSNoteTodolistRepository->findWithoutFail($id);
            $projectTSNoteTodolistViews = DB::table('users')->join('project_t_s_note_todolist_views', 'users.id', '=', 'project_t_s_note_todolist_views.user_id')->where('p_t_s_n_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $projectTSNoteTodolistUpdates = DB::table('users')->join('project_t_s_note_todolist_updates', 'users.id', '=', 'project_t_s_note_todolist_updates.user_id')->where('p_t_s_n_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($projectTSNoteTodolist))
            {
                Flash::error('Project T S Note Todolist not found');
                return redirect(route('projectTSNoteTodolists.index'));
            }
    
            return view('project_t_s_note_todolists.show')->with('projectTSNoteTodolist', $projectTSNoteTodolist)
                ->with('projectTSNoteTodolistViews', $projectTSNoteTodolistViews)
                ->with('projectTSNoteTodolistUpdates', $projectTSNoteTodolistUpdates);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function edit($id)
    {
        if(Auth::user() != null)
        {
            $projectTSNoteTodolist = $this->projectTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolist))
            {
                Flash::error('Project T S Note Todolist not found');
                return redirect(route('projectTSNoteTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('project_t_s_note_todolists.edit')->with('projectTSNoteTodolist', $projectTSNoteTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateProjectTSNoteTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_note_todolists')->join('project_t_s_notes', 'project_t_s_note_todolists.p_t_s_n_id', '=', 'project_t_s_notes.id')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('p_t_s_n_id', $request -> p_t_s_n_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTSNoteTodolist = $this->projectTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolist))
            {
                Flash::error('Project T S Note Todolist not found');
                return redirect(route('projectTSNoteTodolists.index'));
            }
    
            $newProjectTSNoteTodolist = $this->projectTSNoteTodolistRepository->update($request->all(), $id);
    
            DB::table('project_t_s_note_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('project_t_s_note_todolist_updates')->insert(['actual_name' => $newProjectTSNoteTodolist -> name, 'past_name' => $projectTSNoteTodolist -> name, 'datetime' => $now, 'p_t_s_n_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $projectTSNoteTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_n_todo_u', 'user_id' => $user_id, 'entity_id' => $projectTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S Note Todolist updated successfully.');
            return redirect(route('projectTSNotes.show', [$projectTSNoteTodolist -> p_t_s_n_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_note_todolists')->join('project_t_s_notes', 'project_t_s_note_todolists.p_t_s_n_id', '=', 'project_t_s_notes.id')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_t_s_note_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTSNoteTodolist = $this->projectTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolist))
            {
                Flash::error('Project T S Note Todolist not found');
                return redirect(route('projectTSNoteTodolists.index'));
            }
    
            $this->projectTSNoteTodolistRepository->delete($id);
            DB::table('recent_activities')->insert(['name' => $projectTSNoteTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_n_todo_d', 'user_id' => $user_id, 'entity_id' => $projectTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S Note Todolist deleted successfully.');
            return redirect(route('projectTSNotes.show', [$projectTSNoteTodolist -> p_t_s_n_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}