<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSFileTodolistRequest;
use App\Http\Requests\UpdateJobTSFileTodolistRequest;
use App\Repositories\JobTSFileTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSFileTodolistController extends AppBaseController
{
    private $jobTSFileTodolistRepository;

    public function __construct(JobTSFileTodolistRepository $jobTSFileTodolistRepo)
    {
        $this->jobTSFileTodolistRepository = $jobTSFileTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSFileTodolistRepository->pushCriteria(new RequestCriteria($request));
            $jobTSFileTodolists = $this->jobTSFileTodolistRepository->all();
    
            return view('job_t_s_file_todolists.index')
                ->with('jobTSFileTodolists', $jobTSFileTodolists);
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
            return view('job_t_s_file_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSFileTodolist = $this->jobTSFileTodolistRepository->create($input);
    
            Flash::success('Job T S File Todolist saved successfully.');
            return redirect(route('jobTSFileTodolists.index'));
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
            $jobTSFileTodolist = $this->jobTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolist))
            {
                Flash::error('Job T S File Todolist not found');
                return redirect(route('jobTSFileTodolists.index'));
            }
    
            return view('job_t_s_file_todolists.show')->with('jobTSFileTodolist', $jobTSFileTodolist);
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
            $jobTSFileTodolist = $this->jobTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolist))
            {
                Flash::error('Job T S File Todolist not found');
                return redirect(route('jobTSFileTodolists.index'));
            }
    
            return view('job_t_s_file_todolists.edit')->with('jobTSFileTodolist', $jobTSFileTodolist);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTSFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $jobTSFileTodolist = $this->jobTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolist))
            {
                Flash::error('Job T S File Todolist not found');
                return redirect(route('jobTSFileTodolists.index'));
            }
    
            $jobTSFileTodolist = $this->jobTSFileTodolistRepository->update($request->all(), $id);
    
            Flash::success('Job T S File Todolist updated successfully.');
            return redirect(route('jobTSFileTodolists.index'));
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
            $jobTSFileTodolist = $this->jobTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolist))
            {
                Flash::error('Job T S File Todolist not found');
                return redirect(route('jobTSFileTodolists.index'));
            }
    
            $this->jobTSFileTodolistRepository->delete($id);
    
            Flash::success('Job T S File Todolist deleted successfully.');
            return redirect(route('jobTSFileTodolists.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}