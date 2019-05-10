<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTodolistUpdateRequest;
use App\Http\Requests\UpdateJobTodolistUpdateRequest;
use App\Repositories\JobTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTodolistUpdateController extends AppBaseController
{
    private $jobTodolistUpdateRepository;

    public function __construct(JobTodolistUpdateRepository $jobTodolistUpdateRepo)
    {
        $this->jobTodolistUpdateRepository = $jobTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTodolistUpdates = $this->jobTodolistUpdateRepository->all();
    
            return view('job_todolist_updates.index')
                ->with('jobTodolistUpdates', $jobTodolistUpdates);
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
            return view('job_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTodolistUpdate = $this->jobTodolistUpdateRepository->create($input);
    
            Flash::success('Job Todolist Update saved successfully.');
            return redirect(route('jobTodolistUpdates.index'));
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
            $jobTodolistUpdate = $this->jobTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTodolistUpdate))
            {
                Flash::error('Job Todolist Update not found');
                return redirect(route('jobTodolistUpdates.index'));
            }
            
            if($jobTodolistUpdate -> user_id == $user_id)
            {
                return view('job_todolist_updates.show')->with('jobTodolistUpdate', $jobTodolistUpdate);
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
            $jobTodolistUpdate = $this->jobTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTodolistUpdate))
            {
                Flash::error('Job Todolist Update not found');
                return redirect(route('jobTodolistUpdates.index'));
            }
            
            if($jobTodolistUpdate -> user_id == $user_id)
            {
                return view('job_todolist_updates.edit')->with('jobTodolistUpdate', $jobTodolistUpdate);
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

    public function update($id, UpdateJobTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTodolistUpdate = $this->jobTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTodolistUpdate))
            {
                Flash::error('Job Todolist Update not found');
                return redirect(route('jobTodolistUpdates.index'));
            }
            
            if($jobTodolistUpdate -> user_id == $user_id)
            {
                $jobTodolistUpdate = $this->jobTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job Todolist Update updated successfully.');
                return redirect(route('jobTodolistUpdates.index'));
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
            $jobTodolistUpdate = $this->jobTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTodolistUpdate))
            {
                Flash::error('Job Todolist Update not found');
                return redirect(route('jobTodolistUpdates.index'));
            }
    
            if($jobTodolistUpdate -> user_id == $user_id)
            {
                $this->jobTodolistUpdateRepository->delete($id);
            
                Flash::success('Job Todolist Update deleted successfully.');
                return redirect(route('jobTodolistUpdates.index'));
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