<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\DeleteJobTSFileTodolistDeleteRequest;
use App\Http\Requests\UpdateJobTSFileTodolistDeleteRequest;
use App\Repositories\JobTSFileTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSFileTodolistDeleteController extends AppBaseController
{
    private $jobTSFileTodolistDeleteRepository;

    public function __construct(JobTSFileTodolistDeleteRepository $jobTSFileTodolistDeleteRepo)
    {
        $this->jobTSFileTodolistDeleteRepository = $jobTSFileTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSFileTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSFileTodolistDeletes = $this->jobTSFileTodolistDeleteRepository->all();
    
            return view('job_t_s_file_todolist_deletes.index')
                ->with('jobTSFileTodolistDeletes', $jobTSFileTodolistDeletes);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function delete()
    {
        if(Auth::user() != null)
        {
            return view('job_t_s_file_todolist_deletes.delete');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeleteJobTSFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSFileTodolistDelete = $this->jobTSFileTodolistDeleteRepository->delete($input);
    
            Flash::success('Job T S File Todolist Delete saved successfully.');
            return redirect(route('jobTSFileTodolistDeletes.index'));
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
            $jobTSFileTodolistDelete = $this->jobTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistDelete))
            {
                Flash::error('Job T S File Todolist Delete not found');
                return redirect(route('jobTSFileTodolistDeletes.index'));
            }
            
            if($jobTSFileTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_file_todolist_deletes.show')
                    ->with('jobTSFileTodolistDelete', $jobTSFileTodolistDelete);
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
            $jobTSFileTodolistDelete = $this->jobTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistDelete))
            {
                Flash::error('Job T S File Todolist Delete not found');
                return redirect(route('jobTSFileTodolistDeletes.index'));
            }
            
            if($jobTSFileTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_file_todolist_deletes.edit')->with('jobTSFileTodolistDelete', $jobTSFileTodolistDelete);
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

    public function update($id, UpdateJobTSFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSFileTodolistDelete = $this->jobTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistDelete))
            {
                Flash::error('Job T S File Todolist Delete not found');
                return redirect(route('jobTSFileTodolistDeletes.index'));
            }
            
            if($jobTSFileTodolistDelete -> user_id == $user_id)
            {
                $jobTSFileTodolistDelete = $this->jobTSFileTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S File Todolist Delete updated successfully.');
                return redirect(route('jobTSFileTodolistDeletes.index'));
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
            $jobTSFileTodolistDelete = $this->jobTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistDelete))
            {
                Flash::error('Job T S File Todolist Delete not found');
                return redirect(route('jobTSFileTodolistDeletes.index'));
            }
            
            if($jobTSFileTodolistDelete -> user_id == $user_id)
            {
                $this->jobTSFileTodolistDeleteRepository->delete($id);
            
                Flash::success('Job T S File Todolist Delete deleted successfully.');
                return redirect(route('jobTSFileTodolistDeletes.index'));
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