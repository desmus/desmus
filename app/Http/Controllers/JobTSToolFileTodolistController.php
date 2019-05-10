<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolFileTodolistRequest;
use App\Http\Requests\UpdateJobTSToolFileTodolistRequest;
use App\Repositories\JobTSToolFileTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolFileTodolistController extends AppBaseController
{
    private $jobTSToolFileTodolistRepository;

    public function __construct(JobTSToolFileTodolistRepository $jobTSToolFileTodolistRepo)
    {
        $this->jobTSToolFileTodolistRepository = $jobTSToolFileTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolFileTodolistRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolFileTodolists = $this->jobTSToolFileTodolistRepository->all();

            return view('job_t_s_tool_file_todolists.index')
                ->with('jobTSToolFileTodolists', $jobTSToolFileTodolists);
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
            return view('job_t_s_tool_file_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSToolFileTodolist = $this->jobTSToolFileTodolistRepository->create($input);
    
            Flash::success('Job T S Tool File Todolist saved successfully.');
            return redirect(route('jobTSToolFileTodolists.index'));
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
            $jobTSToolFileTodolist = $this->jobTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolist))
            {
                Flash::error('Job T S Tool File Todolist not found');
                return redirect(route('jobTSToolFileTodolists.index'));
            }
    
            return view('job_t_s_tool_file_todolists.show')->with('jobTSToolFileTodolist', $jobTSToolFileTodolist);
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
            $jobTSToolFileTodolist = $this->jobTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolist))
            {
                Flash::error('Job T S Tool File Todolist not found');
                return redirect(route('jobTSToolFileTodolists.index'));
            }
    
            return view('job_t_s_tool_file_todolists.edit')->with('jobTSToolFileTodolist', $jobTSToolFileTodolist);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTSToolFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $jobTSToolFileTodolist = $this->jobTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolist))
            {
                Flash::error('Job T S Tool File Todolist not found');
                return redirect(route('jobTSToolFileTodolists.index'));
            }
    
            $jobTSToolFileTodolist = $this->jobTSToolFileTodolistRepository->update($request->all(), $id);
    
            Flash::success('Job T S Tool File Todolist updated successfully.');
            return redirect(route('jobTSToolFileTodolists.index'));
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
            $jobTSToolFileTodolist = $this->jobTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolist))
            {
                Flash::error('Job T S Tool File Todolist not found');
                return redirect(route('jobTSToolFileTodolists.index'));
            }
    
            $this->jobTSToolFileTodolistRepository->delete($id);
    
            Flash::success('Job T S Tool File Todolist deleted successfully.');
            return redirect(route('jobTSToolFileTodolists.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}