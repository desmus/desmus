<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPTodolistRequest;
use App\Http\Requests\UpdateProjectTSPTodolistRequest;
use App\Repositories\ProjectTSPTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPTodolistController extends AppBaseController
{
    private $projectTSPTodolistRepository;

    public function __construct(ProjectTSPTodolistRepository $projectTSPTodolistRepo)
    {
        $this->projectTSPTodolistRepository = $projectTSPTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->projectTSPTodolistRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPTodolists = $this->projectTSPTodolistRepository->all();
            $projectTSPTodolists = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_playlists', 'project_topic_sections.id', '=', 'project_t_s_playlists.p_t_s_id')->join('project_t_s_p_todolists', 'project_t_s_playlists.id', '=', 'project_t_s_p_todolists.p_t_s_p_id')->where('projects.user_id', '=', $user_id)->where(function ($query) {$query->where('project_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_p_todolists.status', '=', 'active');})->orderBy('project_t_s_p_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('project_t_s_p_todolists.index')
                ->with('projectTSPTodolists', $projectTSPTodolists);
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
            return view('project_t_s_p_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_t_s_playlists.id', $request -> p_t_s_p_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $projectTSPTodolist = $this->projectTSPTodolistRepository->create($input);
    
            DB::table('project_t_s_p_t_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_t_id' => $projectTSPTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTSPTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_p_t_c', 'user_id' => $user_id, 'entity_id' => $projectTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S P Todolist saved successfully.');
            return redirect(route('projectTSPlaylists.show', [$projectTSPTodolist -> p_t_s_p_id]));
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
            
            DB::table('project_t_s_p_t_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_t_id' => $id]);
            DB::table('project_t_s_p_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $projectTSPTodolist = $this->projectTSPTodolistRepository->findWithoutFail($id);
            $projectTSPTViews = DB::table('users')->join('project_t_s_p_t_views', 'users.id', '=', 'project_t_s_p_t_views.user_id')->where('p_t_s_p_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $projectTSPTUpdates = DB::table('users')->join('project_t_s_p_t_updates', 'users.id', '=', 'project_t_s_p_t_updates.user_id')->where('p_t_s_p_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($projectTSPTodolist))
            {
                Flash::error('Project T S P Todolist not found');
                return redirect(route('projectTSPTodolists.index'));
            }
    
            return view('project_t_s_p_todolists.show')
                ->with('projectTSPTodolist', $projectTSPTodolist)
                ->with('projectTSPTViews', $projectTSPTViews)
                ->with('projectTSPTUpdates', $projectTSPTUpdates);
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
            $user_id = Auth::user()->id;
            $projectTSPTodolist = $this->projectTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSPTodolist))
            {
                Flash::error('Project T S P Todolist not found');
                return redirect(route('projectTSPTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('project_t_s_p_todolists.edit')
                ->with('projectTSPTodolist', $projectTSPTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateProjectTSPTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_p_todolists')->join('project_t_s_playlists', 'project_t_s_p_todolists.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('p_t_s_p_id', $request -> p_t_s_p_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTSPTodolist = $this->projectTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSPTodolist))
            {
                Flash::error('Project T S P Todolist not found');
                return redirect(route('projectTSPTodolists.index'));
            }
            
            $newProjectTSPTodolist = $this->projectTSPTodolistRepository->update($request->all(), $id);
    
            DB::table('project_t_s_p_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('project_t_s_p_t_updates')->insert(['actual_name' => $newProjectTSPTodolist -> name, 'past_name' => $projectTSPTodolist -> name, 'datetime' => $now, 'p_t_s_p_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $projectTSPTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_p_t_u', 'user_id' => $user_id, 'entity_id' => $projectTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S P Todolist updated successfully.');
            return redirect(route('projectTSPlaylists.show', [$projectTSPTodolist -> p_t_s_p_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_p_todolists')->join('project_t_s_playlists', 'project_t_s_p_todolists.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_t_s_p_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTSPTodolist = $this->projectTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSPTodolist))
            {
                Flash::error('Project T S P Todolist not found');
                return redirect(route('projectTSPTodolists.index'));
            }
    
            $this->projectTSPTodolistRepository->delete($id);
            
            DB::table('project_t_s_p_t_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_t_id' => $projectTSPTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTSPTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_p_t_d', 'user_id' => $user_id, 'entity_id' => $projectTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S P Todolist deleted successfully.');
            return redirect(route('projectTSPlaylists.show', [$projectTSPTodolist -> p_t_s_p_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}