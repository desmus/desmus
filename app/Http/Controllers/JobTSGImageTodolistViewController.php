<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGImageTodolistViewRequest;
use App\Http\Requests\UpdateJobTSGImageTodolistViewRequest;
use App\Repositories\JobTSGImageTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGImageTodolistViewController extends AppBaseController
{
    private $jobTSGImageTodolistViewRepository;

    public function __construct(JobTSGImageTodolistViewRepository $jobTSGImageTodolistViewRepo)
    {
        $this->jobTSGImageTodolistViewRepository = $jobTSGImageTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGImageTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGImageTodolistViews = $this->jobTSGImageTodolistViewRepository->all();
    
            return view('job_t_s_g_image_todolist_views.index')
                ->with('jobTSGImageTodolistViews', $jobTSGImageTodolistViews);
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
            return view('job_t_s_g_image_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGImageTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSGImageTodolistView = $this->jobTSGImageTodolistViewRepository->create($input);
    
            Flash::success('Job T S G Image Todolist View saved successfully.');
            return redirect(route('jobTSGImageTodolistViews.index'));
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
            $jobTSGImageTodolistView = $this->jobTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistView))
            {
                Flash::error('Job T S G Image Todolist View not found');
                return redirect(route('jobTSGImageTodolistViews.index'));
            }
    
            if($jobTSGImageTodolistView -> user_id == $user_id)
            {
                return view('job_t_s_g_image_todolist_views.show')
                    ->with('jobTSGImageTodolistView', $jobTSGImageTodolistView);
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
            $jobTSGImageTodolistView = $this->jobTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistView))
            {
                Flash::error('Job T S G Image Todolist View not found');
                return redirect(route('jobTSGImageTodolistViews.index'));
            }
    
            if($jobTSGImageTodolistView -> user_id == $user_id)
            {
                return view('job_t_s_g_image_todolist_views.edit')
                    ->with('jobTSGImageTodolistView', $jobTSGImageTodolistView);
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

    public function update($id, UpdateJobTSGImageTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGImageTodolistView = $this->jobTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistView))
            {
                Flash::error('Job T S G Image Todolist View not found');
                return redirect(route('jobTSGImageTodolistViews.index'));
            }
            
            if($jobTSGImageTodolistView -> user_id == $user_id)
            {
                $jobTSGImageTodolistView = $this->jobTSGImageTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S G Image Todolist View updated successfully.');
                return redirect(route('jobTSGImageTodolistViews.index'));
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
            $jobTSGImageTodolistView = $this->jobTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistView))
            {
                Flash::error('Job T S G Image Todolist View not found');
                return redirect(route('jobTSGImageTodolistViews.index'));
            }
            
            if($jobTSGImageTodolistView -> user_id == $user_id)
            {
                $this->jobTSGImageTodolistViewRepository->delete($id);
            
                Flash::success('Job T S G Image Todolist View deleted successfully.');
                return redirect(route('jobTSGImageTodolistViews.index'));
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