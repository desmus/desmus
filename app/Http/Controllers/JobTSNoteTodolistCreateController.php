<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSNoteTodolistCreateRequest;
use App\Http\Requests\UpdateJobTSNoteTodolistCreateRequest;
use App\Repositories\JobTSNoteTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSNoteTodolistCreateController extends AppBaseController
{
    private $jobTSNoteTodolistCreateRepository;

    public function __construct(JobTSNoteTodolistCreateRepository $jobTSNoteTodolistCreateRepo)
    {
        $this->jobTSNoteTodolistCreateRepository = $jobTSNoteTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSNoteTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSNoteTodolistCreates = $this->jobTSNoteTodolistCreateRepository->all();
    
            return view('job_t_s_note_todolist_creates.index')
                ->with('jobTSNoteTodolistCreates', $jobTSNoteTodolistCreates);
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
            return view('job_t_s_note_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSNoteTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSNoteTodolistCreate = $this->jobTSNoteTodolistCreateRepository->create($input);
    
            Flash::success('Job T S Note Todolist Create saved successfully.');
            return redirect(route('jobTSNoteTodolistCreates.index'));
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
            $jobTSNoteTodolistCreate = $this->jobTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistCreate))
            {
                Flash::error('Job T S Note Todolist Create not found');
                return redirect(route('jobTSNoteTodolistCreates.index'));
            }
    
            if($jobTSNoteTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_note_todolist_creates.show')->with('jobTSNoteTodolistCreate', $jobTSNoteTodolistCreate);
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
            $jobTSNoteTodolistCreate = $this->jobTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistCreate))
            {
                Flash::error('Job T S Note Todolist Create not found');
                return redirect(route('jobTSNoteTodolistCreates.index'));
            }
    
            if($jobTSNoteTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_note_todolist_creates.edit')->with('jobTSNoteTodolistCreate', $jobTSNoteTodolistCreate);
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

    public function update($id, UpdateJobTSNoteTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSNoteTodolistCreate = $this->jobTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistCreate))
            {
                Flash::error('Job T S Note Todolist Create not found');
                return redirect(route('jobTSNoteTodolistCreates.index'));
            }
            
            if($jobTSNoteTodolistCreate -> user_id == $user_id)
            {
                $jobTSNoteTodolistCreate = $this->jobTSNoteTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Note Todolist Create updated successfully.');
                return redirect(route('jobTSNoteTodolistCreates.index'));
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
            $jobTSNoteTodolistCreate = $this->jobTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolistCreate))
            {
                Flash::error('Job T S Note Todolist Create not found');
                return redirect(route('jobTSNoteTodolistCreates.index'));
            }
            
            if($jobTSNoteTodolistCreate -> user_id == $user_id)
            {
                $this->jobTSNoteTodolistCreateRepository->delete($id);
            
                Flash::success('Job T S Note Todolist Create deleted successfully.');
                return redirect(route('jobTSNoteTodolistCreates.index'));
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