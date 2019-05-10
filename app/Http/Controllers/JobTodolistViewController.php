<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTodolistViewRequest;
use App\Http\Requests\UpdateJobTodolistViewRequest;
use App\Repositories\JobTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTodolistViewController extends AppBaseController
{
    private $jobTodolistViewRepository;

    public function __construct(JobTodolistViewRepository $jobTodolistViewRepo)
    {
        $this->jobTodolistViewRepository = $jobTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTodolistViews = $this->jobTodolistViewRepository->all();
    
            return view('job_todolist_views.index')
                ->with('jobTodolistViews', $jobTodolistViews);
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
            return view('job_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTodolistView = $this->jobTodolistViewRepository->create($input);
    
            Flash::success('Job Todolist View saved successfully.');
            return redirect(route('jobTodolistViews.index'));
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
            $user_id = Auth::user()->id;
            $jobTodolistView = $this->jobTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTodolistView))
            {
                Flash::error('Job Todolist View not found');
                return redirect(route('jobTodolistViews.index'));
            }
    
            if($jobTodolistView -> user_id == $user_id)
            {  
                return view('job_todolist_views.show')->with('jobTodolistView', $jobTodolistView);
            }
            
            else
            {
                return view('deniedAccess');
            }
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
            $jobTodolistView = $this->jobTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTodolistView))
            {
                Flash::error('Job Todolist View not found');
                return redirect(route('jobTodolistViews.index'));
            }
            
            if($jobTodolistView -> user_id == $user_id)
            {
                return view('job_todolist_views.edit')->with('jobTodolistView', $jobTodolistView);
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTodolistView = $this->jobTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTodolistView))
            {
                Flash::error('Job Todolist View not found');
                return redirect(route('jobTodolistViews.index'));
            }
    
            if($jobTodolistView -> user_id == $user_id)
            {
                $jobTodolistView = $this->jobTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('Job Todolist View updated successfully.');
                return redirect(route('jobTodolistViews.index'));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTodolistView = $this->jobTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTodolistView))
            {
                Flash::error('Job Todolist View not found');
                return redirect(route('jobTodolistViews.index'));
            }
            
            if($jobTodolistView -> user_id == $user_id)
            {
                $this->jobTodolistViewRepository->delete($id);
            
                Flash::success('Job Todolist View deleted successfully.');
                return redirect(route('jobTodolistViews.index'));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}