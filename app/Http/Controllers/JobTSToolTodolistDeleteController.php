<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolTodolistDeleteRequest;
use App\Http\Requests\UpdateJobTSToolTodolistDeleteRequest;
use App\Repositories\JobTSToolTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolTodolistDeleteController extends AppBaseController
{
    private $jobTSToolTodolistDeleteRepository;

    public function __construct(JobTSToolTodolistDeleteRepository $jobTSToolTodolistDeleteRepo)
    {
        $this->jobTSToolTodolistDeleteRepository = $jobTSToolTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolTodolistDeletes = $this->jobTSToolTodolistDeleteRepository->all();
    
            return view('job_t_s_tool_todolist_deletes.index')
                ->with('jobTSToolTodolistDeletes', $jobTSToolTodolistDeletes);
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
            return view('job_t_s_tool_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSToolTodolistDelete = $this->jobTSToolTodolistDeleteRepository->create($input);
    
            Flash::success('Job T S Tool Todolist Delete saved successfully.');
            return redirect(route('jobTSToolTodolistDeletes.index'));
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
            $jobTSToolTodolistDelete = $this->jobTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistDelete))
            {
                Flash::error('Job T S Tool Todolist Delete not found');
                return redirect(route('jobTSToolTodolistDeletes.index'));
            }
            
            if($jobTSToolTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_tool_todolist_deletes.show')->with('jobTSToolTodolistDelete', $jobTSToolTodolistDelete);
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
            $jobTSToolTodolistDelete = $this->jobTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistDelete))
            {
                Flash::error('Job T S Tool Todolist Delete not found');
                return redirect(route('jobTSToolTodolistDeletes.index'));
            }
            
            if($jobTSToolTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_tool_todolist_deletes.edit')->with('jobTSToolTodolistDelete', $jobTSToolTodolistDelete);
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

    public function update($id, UpdateJobTSToolTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolTodolistDelete = $this->jobTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistDelete))
            {
                Flash::error('Job T S Tool Todolist Delete not found');
                return redirect(route('jobTSToolTodolistDeletes.index'));
            }
    
            if($jobTSToolTodolistDelete -> user_id == $user_id)
            {
                $jobTSToolTodolistDelete = $this->jobTSToolTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool Todolist Delete updated successfully.');
                return redirect(route('jobTSToolTodolistDeletes.index'));
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
            $jobTSToolTodolistDelete = $this->jobTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolistDelete))
            {
                Flash::error('Job T S Tool Todolist Delete not found');
                return redirect(route('jobTSToolTodolistDeletes.index'));
            }
    
            if($jobTSToolTodolistDelete -> user_id == $user_id)
            {
                $this->jobTSToolTodolistDeleteRepository->delete($id);
            
                Flash::success('Job T S Tool Todolist Delete deleted successfully.');
                return redirect(route('jobTSToolTodolistDeletes.index'));
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