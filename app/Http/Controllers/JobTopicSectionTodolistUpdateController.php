<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicSectionTodolistUpdateRequest;
use App\Http\Requests\UpdateJobTopicSectionTodolistUpdateRequest;
use App\Repositories\JobTopicSectionTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicSectionTodolistUpdateController extends AppBaseController
{
    private $jobTopicSectionTodolistUpdateRepository;

    public function __construct(JobTopicSectionTodolistUpdateRepository $jobTopicSectionTodolistUpdateRepo)
    {
        $this->jobTopicSectionTodolistUpdateRepository = $jobTopicSectionTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicSectionTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicSectionTodolistUpdates = $this->jobTopicSectionTodolistUpdateRepository->all();
    
            return view('job_topic_section_todolist_updates.index')
                ->with('jobTopicSectionTodolistUpdates', $jobTopicSectionTodolistUpdates);
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
            return view('job_topic_section_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicSectionTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTopicSectionTodolistUpdate = $this->jobTopicSectionTodolistUpdateRepository->create($input);
    
            Flash::success('Job Topic Section Todolist Update saved successfully.');
            return redirect(route('jobTSTodolistUpdates.index'));
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
            $jobTopicSectionTodolistUpdate = $this->jobTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistUpdate))
            {
                Flash::error('Job Topic Section Todolist Update not found');
                return redirect(route('jobTSTodolistUpdates.index'));
            }
            
            if($jobTopicSectionTodolistUpdate -> user_id == $user_id)
            {
                return view('job_topic_section_todolist_updates.show')
                    ->with('jobTopicSectionTodolistUpdate', $jobTopicSectionTodolistUpdate);
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
            $jobTopicSectionTodolistUpdate = $this->jobTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistUpdate))
            {
                Flash::error('Job Topic Section Todolist Update not found');
                return redirect(route('jobTSTodolistUpdates.index'));
            }
            
            if($jobTopicSectionTodolistUpdate -> user_id == $user_id)
            {
                return view('job_topic_section_todolist_updates.edit')
                    ->with('jobTopicSectionTodolistUpdate', $jobTopicSectionTodolistUpdate);
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

    public function update($id, UpdateJobTopicSectionTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicSectionTodolistUpdate = $this->jobTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistUpdate))
            {
                Flash::error('Job Topic Section Todolist Update not found');
                return redirect(route('jobTSTodolistUpdates.index'));
            }
            
            if($jobTopicSectionTodolistUpdate -> user_id == $user_id)
            {  
                $jobTopicSectionTodolistUpdate = $this->jobTopicSectionTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Section Todolist Update updated successfully.');
                return redirect(route('jobTSTodolistUpdates.index'));
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
            $jobTopicSectionTodolistUpdate = $this->jobTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistUpdate))
            {
                Flash::error('Job Topic Section Todolist Update not found');
                return redirect(route('jobTSTodolistUpdates.index'));
            }
    
            if($jobTopicSectionTodolistUpdate -> user_id == $user_id)
            { 
                $this->jobTopicSectionTodolistUpdateRepository->delete($id);
            
                Flash::success('Job Topic Section Todolist Update deleted successfully.');
                return redirect(route('jobTSTodolistUpdates.index'));
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