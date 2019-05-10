<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSNoteTodolistViewRequest;
use App\Http\Requests\UpdateJobTSNoteTodolistViewRequest;
use App\Repositories\JobTSNoteTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSNoteTodolistViewController extends AppBaseController
{
    private $jobTSNoteTodolistViewRepository;

    public function __construct(JobTSNoteTodolistViewRepository $jobTSNoteTodolistViewRepo)
    {
        $this->jobTSNoteTodolistViewRepository = $jobTSNoteTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSNoteTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSNoteTodolistViews = $this->jobTSNoteTodolistViewRepository->all();
    
            return view('job_t_s_note_todolist_views.index')
                ->with('jobTSNoteTodolistViews', $jobTSNoteTodolistViews);
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
            return view('job_t_s_note_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSNoteTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSNoteTodolistView = $this->jobTSNoteTodolistViewRepository->create($input);
    
            Flash::success('Job T S Note Todolist View saved successfully.');
            return redirect(route('jobTSNoteTodolistViews.index'));
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
            $jobTSNoteTodolistView = $this->jobTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistView))
            {
                Flash::error('Job T S Note Todolist View not found');
                return redirect(route('jobTSNoteTodolistViews.index'));
            }
    
            if($jobTSNoteTodolistView -> user_id == $user_id)
            {
                return view('job_t_s_note_todolist_views.show')->with('jobTSNoteTodolistView', $jobTSNoteTodolistView);
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
            $jobTSNoteTodolistView = $this->jobTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistView))
            {
                Flash::error('Job T S Note Todolist View not found');
                return redirect(route('jobTSNoteTodolistViews.index'));
            }
    
            if($jobTSNoteTodolistView -> user_id == $user_id)
            {
                return view('job_t_s_note_todolist_views.edit')->with('jobTSNoteTodolistView', $jobTSNoteTodolistView);
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

    public function update($id, UpdateJobTSNoteTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSNoteTodolistView = $this->jobTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistView))
            {
                Flash::error('Job T S Note Todolist View not found');
                return redirect(route('jobTSNoteTodolistViews.index'));
            }
    
            if($jobTSNoteTodolistView -> user_id == $user_id)
            {
                $jobTSNoteTodolistView = $this->jobTSNoteTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S Note Todolist View updated successfully.');
                return redirect(route('jobTSNoteTodolistViews.index'));
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
            $jobTSNoteTodolistView = $this->jobTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistView))
            {
                Flash::error('Job T S Note Todolist View not found');
                return redirect(route('jobTSNoteTodolistViews.index'));
            }
    
            if($jobTSNoteTodolistView -> user_id == $user_id)
            {
                $this->jobTSNoteTodolistViewRepository->delete($id);
            
                Flash::success('Job T S Note Todolist View deleted successfully.');
                return redirect(route('jobTSNoteTodolistViews.index'));
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