<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolTodolistRequest;
use App\Http\Requests\UpdateProjectTSToolTodolistRequest;
use App\Repositories\ProjectTSToolTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolTodolistController extends AppBaseController
{
    private $projectTSToolTodolistRepository;

    public function __construct(ProjectTSToolTodolistRepository $projectTSToolTodolistRepo)
    {
        $this->projectTSToolTodolistRepository = $projectTSToolTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->projectTSToolTodolistRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolTodolists = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_tools', 'project_topic_sections.id', '=', 'project_t_s_tools.project_topic_section_id')->join('project_t_s_tool_todolists', 'project_t_s_tools.id', '=', 'project_t_s_tool_todolists.p_t_s_t_id')->where('projects.user_id', '=', $user_id)->where(function ($query) {$query->where('project_t_s_tool_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_tool_todolists.status', '=', 'active');})->orderBy('project_t_s_tool_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('project_t_s_tool_todolists.index')
                ->with('projectTSToolTodolists', $projectTSToolTodolists);
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
            return view('project_t_s_tool_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_tools')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_t_s_tools.id', $request -> p_t_s_t_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $projectTSToolTodolist = $this->projectTSToolTodolistRepository->create($input);
            
            DB::table('project_t_s_tool_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_t_t_id' => $projectTSToolTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTSToolTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_t_todo_c', 'user_id' => $user_id, 'entity_id' => $projectTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S Tool Todolist saved successfully.');
            return redirect(route('projectTSTools.show', [$projectTSToolTodolist -> p_t_s_t_id]));
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
            
            DB::table('project_t_s_tool_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_t_t_id' => $id]);
            DB::table('project_t_s_tool_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $projectTSToolTodolist = $this->projectTSToolTodolistRepository->findWithoutFail($id);
            $projectTSToolTodolistViews = DB::table('users')->join('project_t_s_tool_todolist_views', 'users.id', '=', 'project_t_s_tool_todolist_views.user_id')->where('p_t_s_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $projectTSToolTodolistUpdates = DB::table('users')->join('project_t_s_tool_todolist_updates', 'users.id', '=', 'project_t_s_tool_todolist_updates.user_id')->where('p_t_s_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($projectTSToolTodolist))
            {
                Flash::error('Project T S Tool Todolist not found');
                return redirect(route('projectTSToolTodolists.index'));
            }
    
            return view('project_t_s_tool_todolists.show')
                ->with('projectTSToolTodolist', $projectTSToolTodolist)
                ->with('projectTSToolTodolistViews', $projectTSToolTodolistViews)
                ->with('projectTSToolTodolistUpdates', $projectTSToolTodolistUpdates);
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
            $projectTSToolTodolist = $this->projectTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolist))
            {
                Flash::error('Project T S Tool Todolist not found');
                return redirect(route('projectTSToolTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('project_t_s_tool_todolists.edit')
                ->with('projectTSToolTodolist', $projectTSToolTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateProjectTSToolTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_tool_todolists')->join('project_t_s_tools', 'project_t_s_tool_todolists.p_t_s_t_id', '=', 'project_t_s_tools.id')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('p_t_s_t_id', $request -> p_t_s_t_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTSToolTodolist = $this->projectTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolist))
            {
                Flash::error('Project T S Tool Todolist not found');
                return redirect(route('projectTSToolTodolists.index'));
            }
    
            $newProjectTSToolTodolist = $this->projectTSToolTodolistRepository->update($request->all(), $id);
    
            DB::table('project_t_s_tool_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('project_t_s_tool_todolist_updates')->insert(['actual_name' => $newProjectTSToolTodolist -> name, 'past_name' => $projectTSToolTodolist -> name, 'datetime' => $now, 'p_t_s_t_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $projectTSToolTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_t_todo_u', 'user_id' => $user_id, 'entity_id' => $projectTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S Tool Todolist updated successfully.');
            return redirect(route('projectTSTools.show', [$projectTSToolTodolist -> p_t_s_t_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_tool_todolists')->join('project_t_s_tools', 'project_t_s_tool_todolists.p_t_s_t_id', '=', 'project_t_s_tools.id')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_t_s_tool_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTSToolTodolist = $this->projectTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolist))
            {
                Flash::error('Project T S Tool Todolist not found');
                return redirect(route('projectTSToolTodolists.index'));
            }
    
            $this->projectTSToolTodolistRepository->delete($id);
            
            DB::table('project_t_s_tool_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_t_t_id' => $projectTSToolTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTSToolTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_t_todo_d', 'user_id' => $user_id, 'entity_id' => $projectTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S Tool Todolist deleted successfully.');
            return redirect(route('projectTSTools.show', [$projectTSToolTodolist -> p_t_s_t_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}