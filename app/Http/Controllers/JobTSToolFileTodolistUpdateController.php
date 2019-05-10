<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJobTSToolFileTodolistUpdateRequest;
use App\Http\Requests\UpdateJobTSToolFileTodolistUpdateRequest;
use App\Repositories\JobTSToolFileTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolFileTodolistUpdateController extends AppBaseController
{
    private $jobTSToolFileTodolistUpdateRepository;

    public function __construct(JobTSToolFileTodolistUpdateRepository $jobTSToolFileTodolistUpdateRepo)
    {
        $this->jobTSToolFileTodolistUpdateRepository = $jobTSToolFileTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolFileTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolFileTodolistUpdates = $this->jobTSToolFileTodolistUpdateRepository->all();
    
            return view('job_t_s_tool_file_todolist_updates.index')
                ->with('jobTSToolFileTodolistUpdates', $jobTSToolFileTodolistUpdates);
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
            return view('job_t_s_tool_file_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSToolFileTodolistUpdate = $this->jobTSToolFileTodolistUpdateRepository->create($input);
    
            Flash::success('Job T S Tool File Todolist Update saved successfully.');
            return redirect(route('jobTSToolFileTodolistUpdates.index'));
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
            $jobTSToolFileTodolistUpdate = $this->jobTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistUpdate))
            {
                Flash::error('Job T S Tool File Todolist Update not found');
                return redirect(route('jobTSToolFileTodolistUpdates.index'));
            }
    
            return view('job_t_s_tool_file_todolist_updates.show')
                ->with('jobTSToolFileTodolistUpdate', $jobTSToolFileTodolistUpdate);
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
            $jobTSToolFileTodolistUpdate = $this->jobTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistUpdate))
            {
                Flash::error('Job T S Tool File Todolist Update not found');
                return redirect(route('jobTSToolFileTodolistUpdates.index'));
            }
    
            return view('job_t_s_tool_file_todolist_updates.edit')
                ->with('jobTSToolFileTodolistUpdate', $jobTSToolFileTodolistUpdate);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTSToolFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $jobTSToolFileTodolistUpdate = $this->jobTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistUpdate))
            {
                Flash::error('Job T S Tool File Todolist Update not found');
                return redirect(route('jobTSToolFileTodolistUpdates.index'));
            }
    
            $jobTSToolFileTodolistUpdate = $this->jobTSToolFileTodolistUpdateRepository->update($request->all(), $id);
    
            Flash::success('Job T S Tool File Todolist Update updated successfully.');
            return redirect(route('jobTSToolFileTodolistUpdates.index'));
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
            $jobTSToolFileTodolistUpdate = $this->jobTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistUpdate))
            {
                Flash::error('Job T S Tool File Todolist Update not found');
                return redirect(route('jobTSToolFileTodolistUpdates.index'));
            }
    
            $this->jobTSToolFileTodolistUpdateRepository->delete($id);
    
            Flash::success('Job T S Tool File Todolist Update deleted successfully.');
            return redirect(route('jobTSToolFileTodolistUpdates.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}