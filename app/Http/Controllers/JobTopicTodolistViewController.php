<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicTodolistViewRequest;
use App\Http\Requests\UpdateJobTopicTodolistViewRequest;
use App\Repositories\JobTopicTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicTodolistViewController extends AppBaseController
{
    private $jobTopicTodolistViewRepository;

    public function __construct(JobTopicTodolistViewRepository $jobTopicTodolistViewRepo)
    {
        $this->jobTopicTodolistViewRepository = $jobTopicTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicTodolistViews = $this->jobTopicTodolistViewRepository->all();
    
            return view('job_topic_todolist_views.index')
                ->with('jobTopicTodolistViews', $jobTopicTodolistViews);
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
            return view('job_topic_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTopicTodolistView = $this->jobTopicTodolistViewRepository->create($input);
    
            Flash::success('Job Topic Todolist View saved successfully.');
            return redirect(route('jobTopicTodolistViews.index'));
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
            $jobTopicTodolistView = $this->jobTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistView))
            {
                Flash::error('Job Topic Todolist View not found');
                return redirect(route('jobTopicTodolistViews.index'));
            }
            
            if($jobTopicTodolistView -> user_id == $user_id)
            {
                return view('job_topic_todolist_views.show')
                    ->with('jobTopicTodolistView', $jobTopicTodolistView);
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
            $jobTopicTodolistView = $this->jobTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistView))
            {
                Flash::error('Job Topic Todolist View not found');
                return redirect(route('jobTopicTodolistViews.index'));
            }
    
            if($jobTopicTodolistView -> user_id == $user_id)
            {
                return view('job_topic_todolist_views.edit')
                    ->with('jobTopicTodolistView', $jobTopicTodolistView);
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

    public function update($id, UpdateJobTopicTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicTodolistView = $this->jobTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistView))
            {
                Flash::error('Job Topic Todolist View not found');
                return redirect(route('jobTopicTodolistViews.index'));
            }
            
            if($jobTopicTodolistView -> user_id == $user_id)
            {
                $jobTopicTodolistView = $this->jobTopicTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Todolist View updated successfully.');
                return redirect(route('jobTopicTodolistViews.index'));
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
            $jobTopicTodolistView = $this->jobTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistView))
            {
                Flash::error('Job Topic Todolist View not found');
                return redirect(route('jobTopicTodolistViews.index'));
            }
    
            if($jobTopicTodolistView -> user_id == $user_id)
            {
                $this->jobTopicTodolistViewRepository->delete($id);
            
                Flash::success('Job Topic Todolist View deleted successfully.');
                return redirect(route('jobTopicTodolistViews.index'));
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