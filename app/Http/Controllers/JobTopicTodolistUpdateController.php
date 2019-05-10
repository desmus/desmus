<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicTodolistUpdateRequest;
use App\Http\Requests\UpdateJobTopicTodolistUpdateRequest;
use App\Repositories\JobTopicTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicTodolistUpdateController extends AppBaseController
{
    private $jobTopicTodolistUpdateRepository;

    public function __construct(JobTopicTodolistUpdateRepository $jobTopicTodolistUpdateRepo)
    {
        $this->jobTopicTodolistUpdateRepository = $jobTopicTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicTodolistUpdates = $this->jobTopicTodolistUpdateRepository->all();
    
            return view('job_topic_todolist_updates.index')
                ->with('jobTopicTodolistUpdates', $jobTopicTodolistUpdates);
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
            return view('job_topic_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTopicTodolistUpdate = $this->jobTopicTodolistUpdateRepository->create($input);
    
            Flash::success('Job Topic Todolist Update saved successfully.');
            return redirect(route('jobTopicTodolistUpdates.index'));
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
            $jobTopicTodolistUpdate = $this->jobTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistUpdate))
            {
                Flash::error('Job Topic Todolist Update not found');
                return redirect(route('jobTopicTodolistUpdates.index'));
            }
            
            if($jobTopicTodolistUpdate -> user_id == $user_id)
            {
                return view('job_topic_todolist_updates.show')->with('jobTopicTodolistUpdate', $jobTopicTodolistUpdate);
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
            $jobTopicTodolistUpdate = $this->jobTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistUpdate))
            {
                Flash::error('Job Topic Todolist Update not found');
                return redirect(route('jobTopicTodolistUpdates.index'));
            }
    
            if($jobTopicTodolistUpdate -> user_id == $user_id)
            {
                return view('job_topic_todolist_updates.edit')->with('jobTopicTodolistUpdate', $jobTopicTodolistUpdate);
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

    public function update($id, UpdateJobTopicTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicTodolistUpdate = $this->jobTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistUpdate))
            {
                Flash::error('Job Topic Todolist Update not found');
                return redirect(route('jobTopicTodolistUpdates.index'));
            }
            
            if($jobTopicTodolistUpdate -> user_id == $user_id)
            {
                $jobTopicTodolistUpdate = $this->jobTopicTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Todolist Update updated successfully.');
                return redirect(route('jobTopicTodolistUpdates.index'));
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
            $jobTopicTodolistUpdate = $this->jobTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistUpdate))
            {
                Flash::error('Job Topic Todolist Update not found');
                return redirect(route('jobTopicTodolistUpdates.index'));
            }
            
            if($jobTopicTodolistUpdate -> user_id == $user_id)
            {
                $this->jobTopicTodolistUpdateRepository->delete($id);
            
                Flash::success('Job Topic Todolist Update deleted successfully.');
                return redirect(route('jobTopicTodolistUpdates.index'));
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