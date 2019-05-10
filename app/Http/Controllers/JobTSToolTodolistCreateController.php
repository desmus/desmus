<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolTodolistCreateRequest;
use App\Http\Requests\UpdateJobTSToolTodolistCreateRequest;
use App\Repositories\JobTSToolTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolTodolistCreateController extends AppBaseController
{
    private $jobTSToolTodolistCreateRepository;

    public function __construct(JobTSToolTodolistCreateRepository $jobTSToolTodolistCreateRepo)
    {
        $this->jobTSToolTodolistCreateRepository = $jobTSToolTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolTodolistCreates = $this->jobTSToolTodolistCreateRepository->all();
    
            return view('job_t_s_tool_todolist_creates.index')
                ->with('jobTSToolTodolistCreates', $jobTSToolTodolistCreates);
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
            return view('job_t_s_tool_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSToolTodolistCreate = $this->jobTSToolTodolistCreateRepository->create($input);
    
            Flash::success('Job T S Tool Todolist Create saved successfully.');
            return redirect(route('jobTSToolTodolistCreates.index'));
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
            $jobTSToolTodolistCreate = $this->jobTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistCreate))
            {
                Flash::error('Job T S Tool Todolist Create not found');
                return redirect(route('jobTSToolTodolistCreates.index'));
            }
            
            if($jobTSToolTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_tool_todolist_creates.show')->with('jobTSToolTodolistCreate', $jobTSToolTodolistCreate);
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
            $jobTSToolTodolistCreate = $this->jobTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistCreate))
            {
                Flash::error('Job T S Tool Todolist Create not found');
                return redirect(route('jobTSToolTodolistCreates.index'));
            }
            
            if($jobTSToolTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_tool_todolist_creates.edit')->with('jobTSToolTodolistCreate', $jobTSToolTodolistCreate);
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

    public function update($id, UpdateJobTSToolTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolTodolistCreate = $this->jobTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistCreate))
            {
                Flash::error('Job T S Tool Todolist Create not found');
                return redirect(route('jobTSToolTodolistCreates.index'));
            }
    
            if($jobTSToolTodolistCreate -> user_id == $user_id)
            {
                $jobTSToolTodolistCreate = $this->jobTSToolTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool Todolist Create updated successfully.');
                return redirect(route('jobTSToolTodolistCreates.index'));
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
            $jobTSToolTodolistCreate = $this->jobTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistCreate))
            {
                Flash::error('Job T S Tool Todolist Create not found');
                return redirect(route('jobTSToolTodolistCreates.index'));
            }
    
            if($jobTSToolTodolistCreate -> user_id == $user_id)
            {
                $this->jobTSToolTodolistCreateRepository->delete($id);
            
                Flash::success('Job T S Tool Todolist Create deleted successfully.');
                return redirect(route('jobTSToolTodolistCreates.index'));
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