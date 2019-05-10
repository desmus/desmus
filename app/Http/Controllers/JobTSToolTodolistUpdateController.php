<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolTodolistUpdateRequest;
use App\Http\Requests\UpdateJobTSToolTodolistUpdateRequest;
use App\Repositories\JobTSToolTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolTodolistUpdateController extends AppBaseController
{
    private $jobTSToolTodolistUpdateRepository;

    public function __construct(JobTSToolTodolistUpdateRepository $jobTSToolTodolistUpdateRepo)
    {
        $this->jobTSToolTodolistUpdateRepository = $jobTSToolTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolTodolistUpdates = $this->jobTSToolTodolistUpdateRepository->all();
    
            return view('job_t_s_tool_todolist_updates.index')
                ->with('jobTSToolTodolistUpdates', $jobTSToolTodolistUpdates);
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
            return view('job_t_s_tool_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSToolTodolistUpdate = $this->jobTSToolTodolistUpdateRepository->create($input);
    
            Flash::success('Job T S Tool Todolist Update saved successfully.');
            return redirect(route('jobTSToolTodolistUpdates.index'));
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
            $jobTSToolTodolistUpdate = $this->jobTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistUpdate))
            {
                Flash::error('Job T S Tool Todolist Update not found');
                return redirect(route('jobTSToolTodolistUpdates.index'));
            }
            
            if($jobTSToolTodolistUpdate -> user_id == $user_id)
            {
                return view('job_t_s_tool_todolist_updates.show')->with('jobTSToolTodolistUpdate', $jobTSToolTodolistUpdate);
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
            $jobTSToolTodolistUpdate = $this->jobTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistUpdate))
            {
                Flash::error('Job T S Tool Todolist Update not found');
                return redirect(route('jobTSToolTodolistUpdates.index'));
            }
    
            if($jobTSToolTodolistUpdate -> user_id == $user_id)
            {
                return view('job_t_s_tool_todolist_updates.edit')->with('jobTSToolTodolistUpdate', $jobTSToolTodolistUpdate);
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

    public function update($id, UpdateJobTSToolTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolTodolistUpdate = $this->jobTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistUpdate))
            {
                Flash::error('Job T S Tool Todolist Update not found');
                return redirect(route('jobTSToolTodolistUpdates.index'));
            }
    
            if($jobTSToolTodolistUpdate -> user_id == $user_id)
            {
                $jobTSToolTodolistUpdate = $this->jobTSToolTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool Todolist Update updated successfully.');
                return redirect(route('jobTSToolTodolistUpdates.index'));
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
            $jobTSToolTodolistUpdate = $this->jobTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistUpdate))
            {
                Flash::error('Job T S Tool Todolist Update not found');
                return redirect(route('jobTSToolTodolistUpdates.index'));
            }
            
            if($jobTSToolTodolistUpdate -> user_id == $user_id)
            {
                $this->jobTSToolTodolistUpdateRepository->delete($id);
            
                Flash::success('Job T S Tool Todolist Update deleted successfully.');
                return redirect(route('jobTSToolTodolistUpdates.index'));
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