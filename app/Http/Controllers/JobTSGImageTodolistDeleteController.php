<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGImageTodolistDeleteRequest;
use App\Http\Requests\UpdateJobTSGImageTodolistDeleteRequest;
use App\Repositories\JobTSGImageTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGImageTodolistDeleteController extends AppBaseController
{
    private $jobTSGImageTodolistDeleteRepository;

    public function __construct(JobTSGImageTodolistDeleteRepository $jobTSGImageTodolistDeleteRepo)
    {
        $this->jobTSGImageTodolistDeleteRepository = $jobTSGImageTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGImageTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGImageTodolistDeletes = $this->jobTSGImageTodolistDeleteRepository->all();
    
            return view('job_t_s_g_image_todolist_deletes.index')
                ->with('jobTSGImageTodolistDeletes', $jobTSGImageTodolistDeletes);
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
            return view('job_t_s_g_image_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGImageTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSGImageTodolistDelete = $this->jobTSGImageTodolistDeleteRepository->create($input);
    
            Flash::success('Job T S G Image Todolist Delete saved successfully.');
            return redirect(route('jobTSGImageTodolistDeletes.index'));
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
            $jobTSGImageTodolistDelete = $this->jobTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistDelete))
            {
                Flash::error('Job T S G Image Todolist Delete not found');
                return redirect(route('jobTSGImageTodolistDeletes.index'));
            }
            
            if($jobTSGImageTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_g_image_todolist_deletes.show')->with('jobTSGImageTodolistDelete', $jobTSGImageTodolistDelete);
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
            $jobTSGImageTodolistDelete = $this->jobTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistDelete))
            {
                Flash::error('Job T S G Image Todolist Delete not found');
                return redirect(route('jobTSGImageTodolistDeletes.index'));
            }
    
            if($jobTSGImageTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_g_image_todolist_deletes.edit')
                    ->with('jobTSGImageTodolistDelete', $jobTSGImageTodolistDelete);
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

    public function update($id, UpdateJobTSGImageTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGImageTodolistDelete = $this->jobTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistDelete))
            {
                Flash::error('Job T S G Image Todolist Delete not found');
                return redirect(route('jobTSGImageTodolistDeletes.index'));
            }
            
            if($jobTSGImageTodolistDelete -> user_id == $user_id)
            {
                $jobTSGImageTodolistDelete = $this->jobTSGImageTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S G Image Todolist Delete updated successfully.');
                return redirect(route('jobTSGImageTodolistDeletes.index'));
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
            $jobTSGImageTodolistDelete = $this->jobTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistDelete))
            {
                Flash::error('Job T S G Image Todolist Delete not found');
                return redirect(route('jobTSGImageTodolistDeletes.index'));
            }
            
            if($jobTSGImageTodolistDelete -> user_id == $user_id)
            {
                $this->jobTSGImageTodolistDeleteRepository->delete($id);
            
                Flash::success('Job T S G Image Todolist Delete deleted successfully.');
                return redirect(route('jobTSGImageTodolistDeletes.index'));
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