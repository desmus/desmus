<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTodolistDeleteRequest;
use App\Http\Requests\UpdateJobTodolistDeleteRequest;
use App\Repositories\JobTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTodolistDeleteController extends AppBaseController
{
    private $jobTodolistDeleteRepository;

    public function __construct(JobTodolistDeleteRepository $jobTodolistDeleteRepo)
    {
        $this->jobTodolistDeleteRepository = $jobTodolistDeleteRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTodolistDeletes = $this->jobTodolistDeleteRepository->all();
    
            return view('job_todolist_deletes.index')
                ->with('jobTodolistDeletes', $jobTodolistDeletes);
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
            return view('job_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTodolistDelete = $this->jobTodolistDeleteRepository->create($input);
    
            Flash::success('Job Todolist Delete saved successfully.');
            return redirect(route('jobTodolistDeletes.index'));
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
            $jobTodolistDelete = $this->jobTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTodolistDelete))
            {
                Flash::error('Job Todolist Delete not found');
                return redirect(route('jobTodolistDeletes.index'));
            }
            
            if($jobTodolistDelete -> user_id == $user_id)
            {   
                return view('job_todolist_deletes.show')->with('jobTodolistDelete', $jobTodolistDelete);
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
            $jobTodolistDelete = $this->jobTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTodolistDelete))
            {
                Flash::error('Job Todolist Delete not found');
                return redirect(route('jobTodolistDeletes.index'));
            }
            
            if($jobTodolistDelete -> user_id == $user_id)
            {
                return view('job_todolist_deletes.edit')->with('jobTodolistDelete', $jobTodolistDelete);
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

    public function update($id, UpdateJobTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTodolistDelete = $this->jobTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTodolistDelete))
            {
                Flash::error('Job Todolist Delete not found');
                return redirect(route('jobTodolistDeletes.index'));
            }
            
            if($jobTodolistDelete -> user_id == $user_id)
            {
                $jobTodolistDelete = $this->jobTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job Todolist Delete updated successfully.');
                return redirect(route('jobTodolistDeletes.index'));
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
            $jobTodolistDelete = $this->jobTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTodolistDelete))
            {
                Flash::error('Job Todolist Delete not found');
                return redirect(route('jobTodolistDeletes.index'));
            }
            
            if($jobTodolistDelete -> user_id == $user_id)
            {
                $this->jobTodolistDeleteRepository->delete($id);
            
                Flash::success('Job Todolist Delete deleted successfully.');
                return redirect(route('jobTodolistDeletes.index'));
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