<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSFileTodolistUpdateRequest;
use App\Http\Requests\UpdateJobTSFileTodolistUpdateRequest;
use App\Repositories\JobTSFileTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSFileTodolistUpdateController extends AppBaseController
{
    private $jobTSFileTodolistUpdateRepository;

    public function __construct(JobTSFileTodolistUpdateRepository $jobTSFileTodolistUpdateRepo)
    {
        $this->jobTSFileTodolistUpdateRepository = $jobTSFileTodolistUpdateRepo;
    }
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSFileTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSFileTodolistUpdates = $this->jobTSFileTodolistUpdateRepository->all();
    
            return view('job_t_s_file_todolist_updates.index')
                ->with('jobTSFileTodolistUpdates', $jobTSFileTodolistUpdates);
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
            return view('job_t_s_file_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(CreateJobTSFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSFileTodolistUpdate = $this->jobTSFileTodolistUpdateRepository->create($input);
    
            Flash::success('Job T S File Todolist Update saved successfully.');
            return redirect(route('jobTSFileTodolistUpdates.index'));
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
            $jobTSFileTodolistUpdate = $this->jobTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistUpdate))
            {
                Flash::error('Job T S File Todolist Update not found');
                return redirect(route('jobTSFileTodolistUpdates.index'));
            }
    
            if($jobTSFileTodolistUpdate -> user_id == $user_id)
            {
                return view('job_t_s_file_todolist_updates.show')->with('jobTSFileTodolistUpdate', $jobTSFileTodolistUpdate);
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
            $jobTSFileTodolistUpdate = $this->jobTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistUpdate))
            {
                Flash::error('Job T S File Todolist Update not found');
                return redirect(route('jobTSFileTodolistUpdates.index'));
            }
    
            if($jobTSFileTodolistUpdate -> user_id == $user_id)
            {
                return view('job_t_s_file_todolist_updates.edit')->with('jobTSFileTodolistUpdate', $jobTSFileTodolistUpdate);
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
    
    public function update($id, UpdateJobTSFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSFileTodolistUpdate = $this->jobTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistUpdate))
            {
                Flash::error('Job T S File Todolist Update not found');
                return redirect(route('jobTSFileTodolistUpdates.index'));
            }
    
            if($jobTSFileTodolistUpdate -> user_id == $user_id)
            {
                $jobTSFileTodolistUpdate = $this->jobTSFileTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S File Todolist Update updated successfully.');
                return redirect(route('jobTSFileTodolistUpdates.index'));
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
            $jobTSFileTodolistUpdate = $this->jobTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistUpdate))
            {
                Flash::error('Job T S File Todolist Update not found');
                return redirect(route('jobTSFileTodolistUpdates.index'));
            }
            
            if($jobTSFileTodolistUpdate -> user_id == $user_id)
            {
                $this->jobTSFileTodolistUpdateRepository->delete($id);
            
                Flash::success('Job T S File Todolist Update deleted successfully.');
                return redirect(route('jobTSFileTodolistUpdates.index'));
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