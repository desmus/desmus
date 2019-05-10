<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolFileTodolistDeleteRequest;
use App\Http\Requests\UpdateJobTSToolFileTodolistDeleteRequest;
use App\Repositories\JobTSToolFileTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolFileTodolistDeleteController extends AppBaseController
{
    private $jobTSToolFileTodolistDeleteRepository;

    public function __construct(JobTSToolFileTodolistDeleteRepository $jobTSToolFileTodolistDeleteRepo)
    {
        $this->jobTSToolFileTodolistDeleteRepository = $jobTSToolFileTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolFileTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolFileTodolistDeletes = $this->jobTSToolFileTodolistDeleteRepository->all();
    
            return view('job_t_s_tool_file_todolist_deletes.index')
                ->with('jobTSToolFileTodolistDeletes', $jobTSToolFileTodolistDeletes);
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
            return view('job_t_s_tool_file_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(CreateJobTSToolFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSToolFileTodolistDelete = $this->jobTSToolFileTodolistDeleteRepository->create($input);
    
            Flash::success('Job T S Tool File Todolist Delete saved successfully.');
            return redirect(route('jobTSToolFileTodolistDeletes.index'));
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
            $jobTSToolFileTodolistDelete = $this->jobTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistDelete))
            {
                Flash::error('Job T S Tool File Todolist Delete not found');
                return redirect(route('jobTSToolFileTodolistDeletes.index'));
            }
            
            if($jobTSToolFileTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_tool_file_todolist_deletes.show')->with('jobTSToolFileTodolistDelete', $jobTSToolFileTodolistDelete);
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
            $jobTSToolFileTodolistDelete = $this->jobTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistDelete))
            {
                Flash::error('Job T S Tool File Todolist Delete not found');
                return redirect(route('jobTSToolFileTodolistDeletes.index'));
            }
    
            if($jobTSToolFileTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_tool_file_todolist_deletes.edit')->with('jobTSToolFileTodolistDelete', $jobTSToolFileTodolistDelete);
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

    public function update($id, UpdateJobTSToolFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolFileTodolistDelete = $this->jobTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistDelete))
            {
                Flash::error('Job T S Tool File Todolist Delete not found');
                return redirect(route('jobTSToolFileTodolistDeletes.index'));
            }
    
            if($jobTSToolFileTodolistDelete -> user_id == $user_id)
            {
                $jobTSToolFileTodolistDelete = $this->jobTSToolFileTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool File Todolist Delete updated successfully.');
                return redirect(route('jobTSToolFileTodolistDeletes.index'));
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
            $jobTSToolFileTodolistDelete = $this->jobTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistDelete))
            {
                Flash::error('Job T S Tool File Todolist Delete not found');
                return redirect(route('jobTSToolFileTodolistDeletes.index'));
            }
    
            if($jobTSToolFileTodolistDelete -> user_id == $user_id)
            {
                $this->jobTSToolFileTodolistDeleteRepository->delete($id);
            
                Flash::success('Job T S Tool File Todolist Delete deleted successfully.');
                return redirect(route('jobTSToolFileTodolistDeletes.index'));
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