<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSFileTodolistCreateRequest;
use App\Http\Requests\UpdateJobTSFileTodolistCreateRequest;
use App\Repositories\JobTSFileTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSFileTodolistCreateController extends AppBaseController
{
    private $jobTSFileTodolistCreateRepository;

    public function __construct(JobTSFileTodolistCreateRepository $jobTSFileTodolistCreateRepo)
    {
        $this->jobTSFileTodolistCreateRepository = $jobTSFileTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSFileTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSFileTodolistCreates = $this->jobTSFileTodolistCreateRepository->all();
    
            return view('job_t_s_file_todolist_creates.index')
                ->with('jobTSFileTodolistCreates', $jobTSFileTodolistCreates);
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
            return view('job_t_s_file_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSFileTodolistCreate = $this->jobTSFileTodolistCreateRepository->create($input);
    
            Flash::success('Job T S File Todolist Create saved successfully.');
            return redirect(route('jobTSFileTodolistCreates.index'));
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
            $jobTSFileTodolistCreate = $this->jobTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistCreate))
            {
                Flash::error('Job T S File Todolist Create not found');
                return redirect(route('jobTSFileTodolistCreates.index'));
            }
            
            if($jobTSFileTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_file_todolist_creates.show')
                    ->with('jobTSFileTodolistCreate', $jobTSFileTodolistCreate);
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
            $jobTSFileTodolistCreate = $this->jobTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistCreate))
            {
                Flash::error('Job T S File Todolist Create not found');
                return redirect(route('jobTSFileTodolistCreates.index'));
            }
            
            if($jobTSFileTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_file_todolist_creates.edit')->with('jobTSFileTodolistCreate', $jobTSFileTodolistCreate);
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

    public function update($id, UpdateJobTSFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSFileTodolistCreate = $this->jobTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistCreate))
            {
                Flash::error('Job T S File Todolist Create not found');
                return redirect(route('jobTSFileTodolistCreates.index'));
            }
            
            if($jobTSFileTodolistCreate -> user_id == $user_id)
            {
                $jobTSFileTodolistCreate = $this->jobTSFileTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S File Todolist Create updated successfully.');
                return redirect(route('jobTSFileTodolistCreates.index'));
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
            $jobTSFileTodolistCreate = $this->jobTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistCreate))
            {
                Flash::error('Job T S File Todolist Create not found');
                return redirect(route('jobTSFileTodolistCreates.index'));
            }
            
            if($jobTSFileTodolistCreate -> user_id == $user_id)
            {
                $this->jobTSFileTodolistCreateRepository->delete($id);
            
                Flash::success('Job T S File Todolist Create deleted successfully.');
                return redirect(route('jobTSFileTodolistCreates.index'));
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