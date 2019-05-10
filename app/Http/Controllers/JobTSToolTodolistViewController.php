<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolTodolistViewRequest;
use App\Http\Requests\UpdateJobTSToolTodolistViewRequest;
use App\Repositories\JobTSToolTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolTodolistViewController extends AppBaseController
{
    private $jobTSToolTodolistViewRepository;

    public function __construct(JobTSToolTodolistViewRepository $jobTSToolTodolistViewRepo)
    {
        $this->jobTSToolTodolistViewRepository = $jobTSToolTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolTodolistViews = $this->jobTSToolTodolistViewRepository->all();
    
            return view('job_t_s_tool_todolist_views.index')
                ->with('jobTSToolTodolistViews', $jobTSToolTodolistViews);
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
            return view('job_t_s_tool_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSToolTodolistView = $this->jobTSToolTodolistViewRepository->create($input);
    
            Flash::success('Job T S Tool Todolist View saved successfully.');
            return redirect(route('jobTSToolTodolistViews.index'));
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
            $jobTSToolTodolistView = $this->jobTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistView))
            {
                Flash::error('Job T S Tool Todolist View not found');
                return redirect(route('jobTSToolTodolistViews.index'));
            }
            
            if($jobTSToolTodolistView -> user_id == $user_id)
            {
                return view('job_t_s_tool_todolist_views.show')->with('jobTSToolTodolistView', $jobTSToolTodolistView);
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
            $jobTSToolTodolistView = $this->jobTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistView))
            {
                Flash::error('Job T S Tool Todolist View not found');
                return redirect(route('jobTSToolTodolistViews.index'));
            }
            
            if($jobTSToolTodolistView -> user_id == $user_id)
            {
                return view('job_t_s_tool_todolist_views.edit')->with('jobTSToolTodolistView', $jobTSToolTodolistView);
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

    public function update($id, UpdateJobTSToolTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolTodolistView = $this->jobTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistView))
            {
                Flash::error('Job T S Tool Todolist View not found');
                return redirect(route('jobTSToolTodolistViews.index'));
            }
            
            if($jobTSToolTodolistView -> user_id == $user_id)
            {
                $jobTSToolTodolistView = $this->jobTSToolTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool Todolist View updated successfully.');
                return redirect(route('jobTSToolTodolistViews.index'));
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
            $jobTSToolTodolistView = $this->jobTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistView))
            {
                Flash::error('Job T S Tool Todolist View not found');
                return redirect(route('jobTSToolTodolistViews.index'));
            }
            
            if($jobTSToolTodolistView -> user_id == $user_id)
            {
                $this->jobTSToolTodolistViewRepository->delete($id);
            
                Flash::success('Job T S Tool Todolist View deleted successfully.');
                return redirect(route('jobTSToolTodolistViews.index'));
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