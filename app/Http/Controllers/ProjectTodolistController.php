<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTodolistRequest;
use App\Http\Requests\UpdateProjectTodolistRequest;
use App\Repositories\ProjectTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTodolistController extends AppBaseController
{
    private $projectTodolistRepository;

    public function __construct(ProjectTodolistRepository $projectTodolistRepo)
    {
        $this->projectTodolistRepository = $projectTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->projectTodolistRepository->pushCriteria(new RequestCriteria($request));
            $projectTodolists = DB::table('users')->join('projects', 'users.id', '=', 'projects.user_id')->join('project_todolists', 'projects.id', '=', 'project_todolists.project_id')->where('user_id', $user_id)->where(function ($query) {$query->where('project_todolists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->limit(50)->get();
            
            return view('project_todolists.index')
                ->with('projectTodolists', $projectTodolists);
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
            return view('project_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('projects')->join('users', 'projects.user_id', '=', 'users.id')->where('projects.id', $request -> project_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $projectTodolist = $this->projectTodolistRepository->create($input);
            
            DB::table('project_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_id' => $projectTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTodolist -> name, 'status' => 'active', 'type' => 'p_todo_c', 'user_id' => $user_id, 'entity_id' => $projectTodolist -> id, 'created_at' => $now]);
            
            Flash::success('Project Todolist saved successfully.');
            return redirect(route('projects.show', [$projectTodolist -> project_id]));
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
            
            DB::table('project_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_id' => $id]);
            DB::table('project_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $projectTodolist = $this->projectTodolistRepository->findWithoutFail($id);
            $projectTodolistViews = DB::table('users')->join('project_todolist_views', 'users.id', '=', 'project_todolist_views.user_id')->where('p_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $projectTodolistUpdates = DB::table('users')->join('project_todolist_updates', 'users.id', '=', 'project_todolist_updates.user_id')->where('p_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($projectTodolist))
            {
                Flash::error('Project Todolist not found');
                return redirect(route('projectTodolists.index'));
            }
    
            return view('project_todolists.show')
                ->with('projectTodolist', $projectTodolist)
                ->with('projectTodolistViews', $projectTodolistViews)
                ->with('projectTodolistUpdates', $projectTodolistUpdates);
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
            $projectTodolist = $this->projectTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTodolist))
            {
                Flash::error('Project Todolist not found');
                return redirect(route('projectTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('project_todolists.edit')
                ->with('projectTodolist', $projectTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateProjectTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_todolists')->join('projects', 'project_todolists.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_id', $request -> project_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTodolist = $this->projectTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTodolist))
            {
                Flash::error('Project Todolist not found');
                return redirect(route('projectTodolists.index'));
            }
    
            $newProjectTodolist = $this->projectTodolistRepository->update($request->all(), $id);
            
            DB::table('project_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('project_todolist_updates')->insert(['actual_name' => $newProjectTodolist -> name, 'past_name' => $projectTodolist -> name, 'datetime' => $now, 'p_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $projectTodolist -> name, 'status' => 'active', 'type' => 'p_todo_u', 'user_id' => $user_id, 'entity_id' => $projectTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project Todolist updated successfully.');
            return redirect(route('projects.show', [$projectTodolist -> project_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_todolists')->join('projects', 'project_todolists.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTodolist = $this->projectTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTodolist))
            {
                Flash::error('Project Todolist not found');
                return redirect(route('projectTodolists.index'));
            }
    
            $this->projectTodolistRepository->delete($id);
            
            DB::table('project_todolist_deletes')->insert(['datetime' => $now, 'p_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $projectTodolist -> name, 'status' => 'active', 'type' => 'p_todo_d', 'user_id' => $user_id, 'entity_id' => $projectTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project Todolist deleted successfully.');
            return redirect(route('projects.show', [$projectTodolist -> project_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}