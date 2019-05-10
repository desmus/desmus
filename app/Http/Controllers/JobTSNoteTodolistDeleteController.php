<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSNoteTodolistDeleteRequest;
use App\Http\Requests\UpdateJobTSNoteTodolistDeleteRequest;
use App\Repositories\JobTSNoteTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSNoteTodolistDeleteController extends AppBaseController
{
    private $jobTSNoteTodolistDeleteRepository;

    public function __construct(JobTSNoteTodolistDeleteRepository $jobTSNoteTodolistDeleteRepo)
    {
        $this->jobTSNoteTodolistDeleteRepository = $jobTSNoteTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSNoteTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSNoteTodolistDeletes = $this->jobTSNoteTodolistDeleteRepository->all();
    
            return view('job_t_s_note_todolist_deletes.index')
                ->with('jobTSNoteTodolistDeletes', $jobTSNoteTodolistDeletes);
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
            return view('job_t_s_note_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSNoteTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSNoteTodolistDelete = $this->jobTSNoteTodolistDeleteRepository->create($input);
    
            Flash::success('Job T S Note Todolist Delete saved successfully.');
            return redirect(route('jobTSNoteTodolistDeletes.index'));
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
            $jobTSNoteTodolistDelete = $this->jobTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistDelete))
            {
                Flash::error('Job T S Note Todolist Delete not found');
                return redirect(route('jobTSNoteTodolistDeletes.index'));
            }
            
            if($jobTSNoteTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_note_todolist_deletes.show')->with('jobTSNoteTodolistDelete', $jobTSNoteTodolistDelete);
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
            $jobTSNoteTodolistDelete = $this->jobTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistDelete))
            {
                Flash::error('Job T S Note Todolist Delete not found');
                return redirect(route('jobTSNoteTodolistDeletes.index'));
            }
    
            if($jobTSNoteTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_note_todolist_deletes.edit')->with('jobTSNoteTodolistDelete', $jobTSNoteTodolistDelete);
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

    public function update($id, UpdateJobTSNoteTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSNoteTodolistDelete = $this->jobTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistDelete))
            {
                Flash::error('Job T S Note Todolist Delete not found');
                return redirect(route('jobTSNoteTodolistDeletes.index'));
            }
            
            if($jobTSNoteTodolistDelete -> user_id == $user_id)
            {
                $jobTSNoteTodolistDelete = $this->jobTSNoteTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S Note Todolist Delete updated successfully.');
                return redirect(route('jobTSNoteTodolistDeletes.index'));
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
            $jobTSNoteTodolistDelete = $this->jobTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistDelete))
            {
                Flash::error('Job T S Note Todolist Delete not found');
                return redirect(route('jobTSNoteTodolistDeletes.index'));
            }
    
            if($jobTSNoteTodolistDelete -> user_id == $user_id)
            {
                $this->jobTSNoteTodolistDeleteRepository->delete($id);
            
                Flash::success('Job T S Note Todolist Delete deleted successfully.');
                return redirect(route('jobTSNoteTodolistDeletes.index'));
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