<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJobTSToolFileTodolistViewRequest;
use App\Http\Requests\UpdateJobTSToolFileTodolistViewRequest;
use App\Repositories\JobTSToolFileTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolFileTodolistViewController extends AppBaseController
{
    private $jobTSToolFileTodolistViewRepository;

    public function __construct(JobTSToolFileTodolistViewRepository $jobTSToolFileTodolistViewRepo)
    {
        $this->jobTSToolFileTodolistViewRepository = $jobTSToolFileTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolFileTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolFileTodolistViews = $this->jobTSToolFileTodolistViewRepository->all();
    
            return view('job_t_s_tool_file_todolist_views.index')
                ->with('jobTSToolFileTodolistViews', $jobTSToolFileTodolistViews);
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
            return view('job_t_s_tool_file_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSToolFileTodolistView = $this->jobTSToolFileTodolistViewRepository->create($input);
    
            Flash::success('Job T S Tool File Todolist View saved successfully.');
            return redirect(route('jobTSToolFileTodolistViews.index'));
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
            $jobTSToolFileTodolistView = $this->jobTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistView))
            {
                Flash::error('Job T S Tool File Todolist View not found');
                return redirect(route('jobTSToolFileTodolistViews.index'));
            }
    
            return view('job_t_s_tool_file_todolist_views.show')
                ->with('jobTSToolFileTodolistView', $jobTSToolFileTodolistView);
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
            $jobTSToolFileTodolistView = $this->jobTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistView))
            {
                Flash::error('Job T S Tool File Todolist View not found');
                return redirect(route('jobTSToolFileTodolistViews.index'));
            }
    
            return view('job_t_s_tool_file_todolist_views.edit')
                ->with('jobTSToolFileTodolistView', $jobTSToolFileTodolistView);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTSToolFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $jobTSToolFileTodolistView = $this->jobTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistView))
            {
                Flash::error('Job T S Tool File Todolist View not found');
                return redirect(route('jobTSToolFileTodolistViews.index'));
            }
    
            $jobTSToolFileTodolistView = $this->jobTSToolFileTodolistViewRepository->update($request->all(), $id);
    
            Flash::success('Job T S Tool File Todolist View updated successfully.');
            return redirect(route('jobTSToolFileTodolistViews.index'));
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
            $jobTSToolFileTodolistView = $this->jobTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileTodolistView))
            {
                Flash::error('Job T S Tool File Todolist View not found');
                return redirect(route('jobTSToolFileTodolistViews.index'));
            }
    
            $this->jobTSToolFileTodolistViewRepository->delete($id);
    
            Flash::success('Job T S Tool File Todolist View deleted successfully.');
            return redirect(route('jobTSToolFileTodolistViews.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}