<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSNoteTodolistUpdateRequest;
use App\Http\Requests\UpdateJobTSNoteTodolistUpdateRequest;
use App\Repositories\JobTSNoteTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSNoteTodolistUpdateController extends AppBaseController
{
    private $jobTSNoteTodolistUpdateRepository;

    public function __construct(JobTSNoteTodolistUpdateRepository $jobTSNoteTodolistUpdateRepo)
    {
        $this->jobTSNoteTodolistUpdateRepository = $jobTSNoteTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSNoteTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSNoteTodolistUpdates = $this->jobTSNoteTodolistUpdateRepository->all();
    
            return view('job_t_s_note_todolist_updates.index')
                ->with('jobTSNoteTodolistUpdates', $jobTSNoteTodolistUpdates);
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
            return view('job_t_s_note_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSNoteTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSNoteTodolistUpdate = $this->jobTSNoteTodolistUpdateRepository->create($input);
    
            Flash::success('Job T S Note Todolist Update saved successfully.');
            return redirect(route('jobTSNoteTodolistUpdates.index'));
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
            $jobTSNoteTodolistUpdate = $this->jobTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistUpdate))
            {
                Flash::error('Job T S Note Todolist Update not found');
                return redirect(route('jobTSNoteTodolistUpdates.index'));
            }
    
            if($jobTSNoteTodolistUpdate -> user_id == $user_id)
            {
                return view('job_t_s_note_todolist_updates.show')->with('jobTSNoteTodolistUpdate', $jobTSNoteTodolistUpdate);
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
            $jobTSNoteTodolistUpdate = $this->jobTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistUpdate))
            {
                Flash::error('Job T S Note Todolist Update not found');
                return redirect(route('jobTSNoteTodolistUpdates.index'));
            }
    
            if($jobTSNoteTodolistUpdate -> user_id == $user_id)
            {
                return view('job_t_s_note_todolist_updates.edit')->with('jobTSNoteTodolistUpdate', $jobTSNoteTodolistUpdate);
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

    public function update($id, UpdateJobTSNoteTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSNoteTodolistUpdate = $this->jobTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistUpdate))
            {
                Flash::error('Job T S Note Todolist Update not found');
                return redirect(route('jobTSNoteTodolistUpdates.index'));
            }
    
            if($jobTSNoteTodolistUpdate -> user_id == $user_id)
            {
                $jobTSNoteTodolistUpdate = $this->jobTSNoteTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Note Todolist Update updated successfully.');
                return redirect(route('jobTSNoteTodolistUpdates.index'));
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
            $jobTSNoteTodolistUpdate = $this->jobTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistUpdate))
            {
                Flash::error('Job T S Note Todolist Update not found');
                return redirect(route('jobTSNoteTodolistUpdates.index'));
            }
    
            if($jobTSNoteTodolistUpdate -> user_id == $user_id)
            {
                $this->jobTSNoteTodolistUpdateRepository->delete($id);
            
                Flash::success('Job T S Note Todolist Update deleted successfully.');
                return redirect(route('jobTSNoteTodolistUpdates.index'));
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