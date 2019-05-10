<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicSectionTodolistViewRequest;
use App\Http\Requests\UpdateJobTopicSectionTodolistViewRequest;
use App\Repositories\JobTopicSectionTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicSectionTodolistViewController extends AppBaseController
{
    private $jobTopicSectionTodolistViewRepository;

    public function __construct(JobTopicSectionTodolistViewRepository $jobTopicSectionTodolistViewRepo)
    {
        $this->jobTopicSectionTodolistViewRepository = $jobTopicSectionTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicSectionTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicSectionTodolistViews = $this->jobTopicSectionTodolistViewRepository->all();

            return view('job_topic_section_todolist_views.index')
                ->with('jobTopicSectionTodolistViews', $jobTopicSectionTodolistViews);
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
            return view('job_topic_section_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicSectionTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTopicSectionTodolistView = $this->jobTopicSectionTodolistViewRepository->create($input);
    
            Flash::success('Job Topic Section Todolist View saved successfully.');
            return redirect(route('jobTSTodolistViews.index'));
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
            $jobTopicSectionTodolistView = $this->jobTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistView))
            {
                Flash::error('Job Topic Section Todolist View not found');
                return redirect(route('jobTSTodolistViews.index'));
            }
            
            if($jobTopicSectionTodolistView -> user_id == $user_id)
            {
                return view('job_topic_section_todolist_views.show')->with('jobTopicSectionTodolistView', $jobTopicSectionTodolistView);
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
            $jobTopicSectionTodolistView = $this->jobTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistView))
            {
                Flash::error('Job Topic Section Todolist View not found');
                return redirect(route('jobTSTodolistViews.index'));
            }
    
            if($jobTopicSectionTodolistView -> user_id == $user_id)
            {
                return view('job_topic_section_todolist_views.edit')->with('jobTopicSectionTodolistView', $jobTopicSectionTodolistView);
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

    public function update($id, UpdateJobTopicSectionTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicSectionTodolistView = $this->jobTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistView))
            {
                Flash::error('Job Topic Section Todolist View not found');
                return redirect(route('jobTSTodolistViews.index'));
            }
    
            if($jobTopicSectionTodolistView -> user_id == $user_id)
            {
                $jobTopicSectionTodolistView = $this->jobTopicSectionTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Section Todolist View updated successfully.');
                return redirect(route('jobTSTodolistViews.index'));
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
            $jobTopicSectionTodolistView = $this->jobTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistView))
            {
                Flash::error('Job Topic Section Todolist View not found');
                return redirect(route('jobTSTodolistViews.index'));
            }
            
            if($jobTopicSectionTodolistView -> user_id == $user_id)
            {
                $this->jobTopicSectionTodolistViewRepository->delete($id);
            
                Flash::success('Job Topic Section Todolist View deleted successfully.');
                return redirect(route('jobTSTodolistViews.index'));
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