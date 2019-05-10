<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolFileTodolistCreateRequest;
use App\Http\Requests\UpdateJobTSToolFileTodolistCreateRequest;
use App\Repositories\JobTSToolFileTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolFileTodolistCreateController extends AppBaseController
{
    private $jobTSToolFileTodolistCreateRepository;

    public function __construct(JobTSToolFileTodolistCreateRepository $jobTSToolFileTodolistCreateRepo)
    {
        $this->jobTSToolFileTodolistCreateRepository = $jobTSToolFileTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolFileTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolFileTodolistCreates = $this->jobTSToolFileTodolistCreateRepository->all();
    
            return view('job_t_s_tool_file_todolist_creates.index')
                ->with('jobTSToolFileTodolistCreates', $jobTSToolFileTodolistCreates);
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
            return view('job_t_s_tool_file_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSToolFileTodolistCreate = $this->jobTSToolFileTodolistCreateRepository->create($input);
    
            Flash::success('Job T S Tool File Todolist Create saved successfully.');
            return redirect(route('jobTSToolFileTodolistCreates.index'));
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
            $jobTSToolFileTodolistCreate = $this->jobTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistCreate))
            {
                Flash::error('Job T S Tool File Todolist Create not found');
                return redirect(route('jobTSToolFileTodolistCreates.index'));
            }
    
            if($jobTSToolFileTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_tool_file_todolist_creates.show')->with('jobTSToolFileTodolistCreate', $jobTSToolFileTodolistCreate);
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
            $jobTSToolFileTodolistCreate = $this->jobTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistCreate))
            {
                Flash::error('Job T S Tool File Todolist Create not found');
                return redirect(route('jobTSToolFileTodolistCreates.index'));
            }
    
            if($jobTSToolFileTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_tool_file_todolist_creates.edit')->with('jobTSToolFileTodolistCreate', $jobTSToolFileTodolistCreate);
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

    public function update($id, UpdateJobTSToolFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolFileTodolistCreate = $this->jobTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistCreate))
            {
                Flash::error('Job T S Tool File Todolist Create not found');
                return redirect(route('jobTSToolFileTodolistCreates.index'));
            }
            
            if($jobTSToolFileTodolistCreate -> user_id == $user_id)
            {
                $jobTSToolFileTodolistCreate = $this->jobTSToolFileTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool File Todolist Create updated successfully.');
                return redirect(route('jobTSToolFileTodolistCreates.index'));
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
            $jobTSToolFileTodolistCreate = $this->jobTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistCreate))
            {
                Flash::error('Job T S Tool File Todolist Create not found');
                return redirect(route('jobTSToolFileTodolistCreates.index'));
            }
    
            if($jobTSToolFileTodolistCreate -> user_id == $user_id)
            {
                $this->jobTSToolFileTodolistCreateRepository->delete($id);
            
                Flash::success('Job T S Tool File Todolist Create deleted successfully.');
                return redirect(route('jobTSToolFileTodolistCreates.index'));
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