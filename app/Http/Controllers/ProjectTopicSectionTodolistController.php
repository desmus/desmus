<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicSectionTodolistRequest;
use App\Http\Requests\UpdateProjectTopicSectionTodolistRequest;
use App\Repositories\ProjectTopicSectionTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicSectionTodolistController extends AppBaseController
{
    private $projectTopicSectionTodolistRepository;

    public function __construct(ProjectTopicSectionTodolistRepository $projectTopicSectionTodolistRepo)
    {
        $this->projectTopicSectionTodolistRepository = $projectTopicSectionTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->projectTopicSectionTodolistRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicSectionTodolists = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_topic_section_todolists', 'project_topic_sections.id', '=', 'project_topic_section_todolists.p_t_s_id')->where('projects.user_id', '=', $user_id)->where(function ($query) {$query->where('project_topic_section_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_topic_section_todolists.status', '=', 'active');})->orderBy('project_topic_section_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('project_topic_section_todolists.index')
                ->with('projectTopicSectionTodolists', $projectTopicSectionTodolists);
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
            return view('project_topic_section_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicSectionTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_topic_sections')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_topic_sections.id', $request -> p_t_s_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $projectTopicSectionTodolist = $this->projectTopicSectionTodolistRepository->create($input);
    
            DB::table('project_topic_section_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_t_id' => $projectTopicSectionTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTopicSectionTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_todo_c', 'user_id' => $user_id, 'entity_id' => $projectTopicSectionTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project Topic Section Todolist saved successfully.');
            return redirect(route('projectTopicSections.show', [$projectTopicSectionTodolist -> p_t_s_id]));
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
            
            DB::table('project_topic_section_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_t_id' => $id]);
            DB::table('project_topic_section_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $projectTopicSectionTodolist = $this->projectTopicSectionTodolistRepository->findWithoutFail($id);
            $projectTopicSectionTodolistViews = DB::table('users')->join('project_topic_section_todolist_views', 'users.id', '=', 'project_topic_section_todolist_views.user_id')->where('p_t_s_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $projectTopicSectionTodolistUpdates = DB::table('users')->join('project_topic_section_todolist_updates', 'users.id', '=', 'project_topic_section_todolist_updates.user_id')->where('p_t_s_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($projectTopicSectionTodolist))
            {
                Flash::error('Project Topic Section Todolist not found');
                return redirect(route('projectTopicSectionTodolists.index'));
            }
    
            return view('project_topic_section_todolists.show')->with('projectTopicSectionTodolist', $projectTopicSectionTodolist)
                ->with('projectTopicSectionTodolistViews', $projectTopicSectionTodolistViews)
                ->with('projectTopicSectionTodolistUpdates', $projectTopicSectionTodolistUpdates);
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
            $projectTopicSectionTodolist = $this->projectTopicSectionTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolist))
            {
                Flash::error('Project Topic Section Todolist not found');
                return redirect(route('projectTopicSectionTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('project_topic_section_todolists.edit')->with('projectTopicSectionTodolist', $projectTopicSectionTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateProjectTopicSectionTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_topic_section_todolists')->join('project_topic_sections', 'project_topic_section_todolists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('p_t_s_id', $request -> p_t_s_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTopicSectionTodolist = $this->projectTopicSectionTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolist))
            {
                Flash::error('Project Topic Section Todolist not found');
                return redirect(route('projectTopicSectionTodolists.index'));
            }
    
            $newProjectTopicSectionTodolist = $this->projectTopicSectionTodolistRepository->update($request->all(), $id);
    
            DB::table('project_topic_section_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('project_topic_section_todolist_updates')->insert(['actual_name' => $newProjectTopicSectionTodolist -> name, 'past_name' => $projectTopicSectionTodolist -> name, 'datetime' => $now, 'p_t_s_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $projectTopicSectionTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_todo_u', 'user_id' => $user_id, 'entity_id' => $projectTopicSectionTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project Topic Section Todolist updated successfully.');
            return redirect(route('projectTopicSections.show', [$projectTopicSectionTodolist -> p_t_s_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_topic_section_todolists')->join('project_topic_sections', 'project_topic_section_todolists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_topic_section_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTopicSectionTodolist = $this->projectTopicSectionTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolist))
            {
                Flash::error('Project Topic Section Todolist not found');
                return redirect(route('projectTopicSectionTodolists.index'));
            }
    
            $this->projectTopicSectionTodolistRepository->delete($id);
            
            DB::table('project_topic_section_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_t_id' => $projectTopicSectionTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTopicSectionTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_todo_d', 'user_id' => $user_id, 'entity_id' => $projectTopicSectionTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project Topic Section Todolist deleted successfully.');
            return redirect(route('projectTopicSections.show', [$projectTopicSectionTodolist -> p_t_s_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}