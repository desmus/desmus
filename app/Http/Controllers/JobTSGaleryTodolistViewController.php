<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryTodolistViewRequest;
use App\Http\Requests\UpdateJobTSGaleryTodolistViewRequest;
use App\Repositories\JobTSGaleryTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryTodolistViewController extends AppBaseController
{
    private $jobTSGaleryTodolistViewRepository;

    public function __construct(JobTSGaleryTodolistViewRepository $jobTSGaleryTodolistViewRepo)
    {
        $this->jobTSGaleryTodolistViewRepository = $jobTSGaleryTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryTodolistViews = $this->jobTSGaleryTodolistViewRepository->all();
    
            return view('job_t_s_galery_todolist_views.index')
                ->with('jobTSGaleryTodolistViews', $jobTSGaleryTodolistViews);
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
            return view('job_t_s_galery_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSGaleryTodolistView = $this->jobTSGaleryTodolistViewRepository->create($input);
    
            Flash::success('Job T S Galery Todolist View saved successfully.');
            return redirect(route('jobTSGaleryTodolistViews.index'));
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
            $jobTSGaleryTodolistView = $this->jobTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistView))
            {
                Flash::error('Job T S Galery Todolist View not found');
                return redirect(route('jobTSGaleryTodolistViews.index'));
            }
            
            if($jobTSGaleryTodolistView -> user_id == $user_id)
            {
                return view('job_t_s_galery_todolist_views.show')->with('jobTSGaleryTodolistView', $jobTSGaleryTodolistView);
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
            $jobTSGaleryTodolistView = $this->jobTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistView))
            {
                Flash::error('Job T S Galery Todolist View not found');
                return redirect(route('jobTSGaleryTodolistViews.index'));
            }
    
            if($jobTSGaleryTodolistView -> user_id == $user_id)
            {
                return view('job_t_s_galery_todolist_views.edit')->with('jobTSGaleryTodolistView', $jobTSGaleryTodolistView);
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

    public function update($id, UpdateJobTSGaleryTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryTodolistView = $this->jobTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistView))
            {
                Flash::error('Job T S Galery Todolist View not found');
                return redirect(route('jobTSGaleryTodolistViews.index'));
            }
    
            if($jobTSGaleryTodolistView -> user_id == $user_id)
            {
                $jobTSGaleryTodolistView = $this->jobTSGaleryTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery Todolist View updated successfully.');
                return redirect(route('jobTSGaleryTodolistViews.index'));
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
            $jobTSGaleryTodolistView = $this->jobTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistView))
            {
                Flash::error('Job T S Galery Todolist View not found');
                return redirect(route('jobTSGaleryTodolistViews.index'));
            }
    
            if($jobTSGaleryTodolistView -> user_id == $user_id)
            {
                $this->jobTSGaleryTodolistViewRepository->delete($id);
            
                Flash::success('Job T S Galery Todolist View deleted successfully.');
                return redirect(route('jobTSGaleryTodolistViews.index'));
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