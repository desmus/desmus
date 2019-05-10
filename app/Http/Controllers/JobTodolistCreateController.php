<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTodolistCreateRequest;
use App\Http\Requests\UpdateJobTodolistCreateRequest;
use App\Repositories\JobTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTodolistCreateController extends AppBaseController
{
    private $jobTodolistCreateRepository;

    public function __construct(JobTodolistCreateRepository $jobTodolistCreateRepo)
    {
        $this->jobTodolistCreateRepository = $jobTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTodolistCreates = $this->jobTodolistCreateRepository->all();
    
            return view('job_todolist_creates.index')
                ->with('jobTodolistCreates', $jobTodolistCreates);
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
            return view('job_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTodolistCreate = $this->jobTodolistCreateRepository->create($input);
    
            Flash::success('Job Todolist Create saved successfully.');
            return redirect(route('jobTodolistCreates.index'));
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
            $jobTodolistCreate = $this->jobTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTodolistCreate))
            {
                Flash::error('Job Todolist Create not found');
                return redirect(route('jobTodolistCreates.index'));
            }
            
            if($jobTodolistCreate -> user_id == $user_id)
            {
                return view('job_todolist_creates.show')
                    ->with('jobTodolistCreate', $jobTodolistCreate);
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
            $jobTodolistCreate = $this->jobTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTodolistCreate))
            {
                Flash::error('Job Todolist Create not found');
                return redirect(route('jobTodolistCreates.index'));
            }
    
            if($jobTodolistCreate -> user_id == $user_id)
            {
                return view('job_todolist_creates.edit')->with('jobTodolistCreate', $jobTodolistCreate);
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

    public function update($id, UpdateJobTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTodolistCreate = $this->jobTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTodolistCreate))
            {
                Flash::error('Job Todolist Create not found');
                return redirect(route('jobTodolistCreates.index'));
            }
    
            if($jobTodolistCreate -> user_id == $user_id)
            {
                $jobTodolistCreate = $this->jobTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Job Todolist Create updated successfully.');
                return redirect(route('jobTodolistCreates.index'));
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
            $jobTodolistCreate = $this->jobTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTodolistCreate))
            {
                Flash::error('Job Todolist Create not found');
                return redirect(route('jobTodolistCreates.index'));
            }
            
            if($jobTodolistCreate -> user_id == $user_id)
            {
                $this->jobTodolistCreateRepository->delete($id);
            
                Flash::success('Job Todolist Create deleted successfully.');
                return redirect(route('jobTodolistCreates.index'));
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