<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTodolistRequest;
use App\Http\Requests\UpdateJobTodolistRequest;
use App\Repositories\JobTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTodolistController extends AppBaseController
{
    private $jobTodolistRepository;

    public function __construct(JobTodolistRepository $jobTodolistRepo)
    {
        $this->jobTodolistRepository = $jobTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->jobTodolistRepository->pushCriteria(new RequestCriteria($request));
            $jobTodolists = DB::table('users')->join('jobs', 'users.id', '=', 'jobs.user_id')->join('job_todolists', 'jobs.id', '=', 'job_todolists.job_id')->where('user_id', $user_id)->where(function ($query) {$query->where('job_todolists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->limit(50)->get();
            
            return view('job_todolists.index')
                ->with('jobTodolists', $jobTodolists);
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
            return view('job_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('jobs')->join('users', 'jobs.user_id', '=', 'users.id')->where('jobs.id', $request -> job_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $jobTodolist = $this->jobTodolistRepository->create($input);
            
            DB::table('job_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_id' => $jobTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTodolist -> name, 'status' => 'active', 'type' => 'j_todo_c', 'user_id' => $user_id, 'entity_id' => $jobTodolist -> id, 'created_at' => $now]);
            
            Flash::success('Job Todolist saved successfully.');
            return redirect(route('jobs.show', [$jobTodolist -> job_id]));
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
            
            DB::table('job_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_id' => $id]);
            DB::table('job_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $jobTodolist = $this->jobTodolistRepository->findWithoutFail($id);
            $jobTodolistViews = DB::table('users')->join('job_todolist_views', 'users.id', '=', 'job_todolist_views.user_id')->where('j_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $jobTodolistUpdates = DB::table('users')->join('job_todolist_updates', 'users.id', '=', 'job_todolist_updates.user_id')->where('j_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($jobTodolist))
            {
                Flash::error('Job Todolist not found');
                return redirect(route('jobTodolists.index'));
            }
    
            return view('job_todolists.show')
                ->with('jobTodolist', $jobTodolist)
                ->with('jobTodolistViews', $jobTodolistViews)
                ->with('jobTodolistUpdates', $jobTodolistUpdates);
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
            $jobTodolist = $this->jobTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTodolist))
            {
                Flash::error('Job Todolist not found');
                return redirect(route('jobTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('job_todolists.edit')
                ->with('jobTodolist', $jobTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_todolists')->join('jobs', 'job_todolists.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_id', $request -> job_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTodolist = $this->jobTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTodolist))
            {
                Flash::error('Job Todolist not found');
                return redirect(route('jobTodolists.index'));
            }
    
            $newJobTodolist = $this->jobTodolistRepository->update($request->all(), $id);
            
            DB::table('job_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('job_todolist_updates')->insert(['actual_name' => $newJobTodolist -> name, 'past_name' => $jobTodolist -> name, 'datetime' => $now, 'j_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $jobTodolist -> name, 'status' => 'active', 'type' => 'j_todo_u', 'user_id' => $user_id, 'entity_id' => $jobTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job Todolist updated successfully.');
            return redirect(route('jobs.show', [$jobTodolist -> job_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_todolists')->join('jobs', 'job_todolists.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTodolist = $this->jobTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTodolist))
            {
                Flash::error('Job Todolist not found');
                return redirect(route('jobTodolists.index'));
            }
    
            $this->jobTodolistRepository->delete($id);
            
            DB::table('job_todolist_deletes')->insert(['datetime' => $now, 'j_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $jobTodolist -> name, 'status' => 'active', 'type' => 'j_todo_d', 'user_id' => $user_id, 'entity_id' => $jobTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job Todolist deleted successfully.');
            return redirect(route('jobs.show', [$jobTodolist -> job_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}