<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicTodolistRequest;
use App\Http\Requests\UpdateProjectTopicTodolistRequest;
use App\Repositories\ProjectTopicTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicTodolistController extends AppBaseController
{
    private $projectTopicTodolistRepository;

    public function __construct(ProjectTopicTodolistRepository $projectTopicTodolistRepo)
    {
        $this->projectTopicTodolistRepository = $projectTopicTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->projectTopicTodolistRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicTodolists = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_todolists', 'project_topics.id', '=', 'project_topic_todolists.project_topic_id')->where('projects.user_id', '=', $user_id)->where(function ($query) {$query->where('project_topic_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_topic_todolists.status', '=', 'active');})->orderBy('project_topic_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('project_topic_todolists.index')
                ->with('projectTopicTodolists', $projectTopicTodolists);
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
            return view('project_topic_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_topics')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_topics.id', $request -> project_topic_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $projectTopicTodolist = $this->projectTopicTodolistRepository->create($input);
            
            DB::table('project_topic_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_t_id' => $projectTopicTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTopicTodolist -> name, 'status' => 'active', 'type' => 'p_t_todo_c', 'user_id' => $user_id, 'entity_id' => $projectTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project Topic Todolist saved successfully.');
            return redirect(route('projectTopics.show', [$projectTopicTodolist -> project_topic_id]));
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
            $projectTopicTodolist = $this->projectTopicTodolistRepository->findWithoutFail($id);
            
            DB::table('project_topic_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_t_id' => $id]);
            DB::table('project_topic_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $projectTopicTodolist = $this->projectTopicTodolistRepository->findWithoutFail($id);
            $projectTopicTodolistViews = DB::table('users')->join('project_topic_todolist_views', 'users.id', '=', 'project_topic_todolist_views.user_id')->where('p_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $projectTopicTodolistUpdates = DB::table('users')->join('project_topic_todolist_updates', 'users.id', '=', 'project_topic_todolist_updates.user_id')->where('p_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($projectTopicTodolist))
            {
                Flash::error('Project Topic Todolist not found');
                return redirect(route('projectTopicTodolists.index'));
            }
    
            return view('project_topic_todolists.show')
                ->with('projectTopicTodolist', $projectTopicTodolist)
                ->with('projectTopicTodolistViews', $projectTopicTodolistViews)
                ->with('projectTopicTodolistUpdates', $projectTopicTodolistUpdates);
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
            $projectTopicTodolist = $this->projectTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolist))
            {
                Flash::error('Project Topic Todolist not found');
                return redirect(route('projectTopicTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('project_topic_todolists.edit')
                ->with('projectTopicTodolist', $projectTopicTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateProjectTopicTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_topic_todolists')->join('project_topics', 'project_topic_todolists.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_topic_id', $request -> project_topic_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTopicTodolist = $this->projectTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolist))
            {
                Flash::error('Project Topic Todolist not found');
                return redirect(route('projectTopicTodolists.index'));
            }
    
            $newProjectTopicTodolist = $this->projectTopicTodolistRepository->update($request->all(), $id);
            
            DB::table('project_topic_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('project_topic_todolist_updates')->insert(['actual_name' => $newProjectTopicTodolist -> name, 'past_name' => $projectTopicTodolist -> name, 'datetime' => $now, 'p_t_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $projectTopicTodolist -> name, 'status' => 'active', 'type' => 'p_t_todo_u', 'user_id' => $user_id, 'entity_id' => $projectTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project Topic Todolist updated successfully.');
            return redirect(route('projectTopics.show', [$projectTopicTodolist -> project_topic_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_topic_todolists')->join('project_topics', 'project_topic_todolists.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_topic_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTopicTodolist = $this->projectTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolist))
            {
                Flash::error('Project Topic Todolist not found');
                return redirect(route('projectTopicTodolists.index'));
            }
    
            $this->projectTopicTodolistRepository->delete($id);
            
            DB::table('project_topic_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_t_id' => $projectTopicTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTopicTodolist -> name, 'status' => 'active', 'type' => 'p_t_todo_d', 'user_id' => $user_id, 'entity_id' => $projectTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project Topic Todolist deleted successfully.');
            return redirect(route('projectTopics.show', [$projectTopicTodolist -> project_topic_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}