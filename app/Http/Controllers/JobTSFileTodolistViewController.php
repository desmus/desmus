<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSFileTodolistViewRequest;
use App\Http\Requests\UpdateJobTSFileTodolistViewRequest;
use App\Repositories\JobTSFileTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSFileTodolistViewController extends AppBaseController
{
    private $jobTSFileTodolistViewRepository;

    public function __construct(JobTSFileTodolistViewRepository $jobTSFileTodolistViewRepo)
    {
        $this->jobTSFileTodolistViewRepository = $jobTSFileTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSFileTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSFileTodolistViews = $this->jobTSFileTodolistViewRepository->all();
    
            return view('job_t_s_file_todolist_views.index')
                ->with('jobTSFileTodolistViews', $jobTSFileTodolistViews);
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
            return view('job_t_s_file_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSFileTodolistView = $this->jobTSFileTodolistViewRepository->create($input);
    
            Flash::success('Job T S File Todolist View saved successfully.');
            return redirect(route('jobTSFileTodolistViews.index'));
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
            $jobTSFileTodolistView = $this->jobTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistView))
            {
                Flash::error('Job T S File Todolist View not found');
                return redirect(route('jobTSFileTodolistViews.index'));
            }
            
            if($jobTSFileTodolistView -> user_id == $user_id)
            {
                return view('job_t_s_file_todolist_views.show')
                    ->with('jobTSFileTodolistView', $jobTSFileTodolistView);
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
            $jobTSFileTodolistView = $this->jobTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistView))
            {
                Flash::error('Job T S File Todolist View not found');
                return redirect(route('jobTSFileTodolistViews.index'));
            }
            
            if($jobTSFileTodolistView -> user_id == $user_id)
            {
                return view('job_t_s_file_todolist_views.edit')
                    ->with('jobTSFileTodolistView', $jobTSFileTodolistView);
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
    
    public function update($id, UpdateJobTSFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $jobTSFileTodolistView = $this->jobTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistView))
            {
                Flash::error('Job T S File Todolist View not found');
                return redirect(route('jobTSFileTodolistViews.index'));
            }
            
            if($jobTSFileTodolistView -> user_id == $user_id)
            {
                $jobTSFileTodolistView = $this->jobTSFileTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S File Todolist View updated successfully.');
                return redirect(route('jobTSFileTodolistViews.index'));
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
            $jobTSFileTodolistView = $this->jobTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSFileTodolistView))
            {
                Flash::error('Job T S File Todolist View not found');
                return redirect(route('jobTSFileTodolistViews.index'));
            }
            
            if($jobTSFileTodolistView -> user_id == $user_id)
            {
                $this->jobTSFileTodolistViewRepository->delete($id);
            
                Flash::success('Job T S File Todolist View deleted successfully.');
                return redirect(route('jobTSFileTodolistViews.index'));
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