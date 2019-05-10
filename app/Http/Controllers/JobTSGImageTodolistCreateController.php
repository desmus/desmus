<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGImageTodolistCreateRequest;
use App\Http\Requests\UpdateJobTSGImageTodolistCreateRequest;
use App\Repositories\JobTSGImageTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGImageTodolistCreateController extends AppBaseController
{
    private $jobTSGImageTodolistCreateRepository;

    public function __construct(JobTSGImageTodolistCreateRepository $jobTSGImageTodolistCreateRepo)
    {
        $this->jobTSGImageTodolistCreateRepository = $jobTSGImageTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGImageTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGImageTodolistCreates = $this->jobTSGImageTodolistCreateRepository->all();
    
            return view('job_t_s_g_image_todolist_creates.index')
                ->with('jobTSGImageTodolistCreates', $jobTSGImageTodolistCreates);
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
            return view('job_t_s_g_image_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGImageTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSGImageTodolistCreate = $this->jobTSGImageTodolistCreateRepository->create($input);
    
            Flash::success('Job T S G Image Todolist Create saved successfully.');
            return redirect(route('jobTSGImageTodolistCreates.index'));
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
            $jobTSGImageTodolistCreate = $this->jobTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistCreate))
            {
                Flash::error('Job T S G Image Todolist Create not found');
                return redirect(route('jobTSGImageTodolistCreates.index'));
            }
            
            if($jobTSGImageTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_g_image_todolist_creates.show')->with('jobTSGImageTodolistCreate', $jobTSGImageTodolistCreate);
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
            $jobTSGImageTodolistCreate = $this->jobTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistCreate))
            {
                Flash::error('Job T S G Image Todolist Create not found');
                return redirect(route('jobTSGImageTodolistCreates.index'));
            }
            
            if($jobTSGImageTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_g_image_todolist_creates.edit')->with('jobTSGImageTodolistCreate', $jobTSGImageTodolistCreate);
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

    public function update($id, UpdateJobTSGImageTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGImageTodolistCreate = $this->jobTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistCreate))
            {
                Flash::error('Job T S G Image Todolist Create not found');
                return redirect(route('jobTSGImageTodolistCreates.index'));
            }
            
            if($jobTSGImageTodolistCreate -> user_id == $user_id)
            {
                $jobTSGImageTodolistCreate = $this->jobTSGImageTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S G Image Todolist Create updated successfully.');
                return redirect(route('jobTSGImageTodolistCreates.index'));
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
            $jobTSGImageTodolistCreate = $this->jobTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistCreate))
            {
                Flash::error('Job T S G Image Todolist Create not found');
                return redirect(route('jobTSGImageTodolistCreates.index'));
            }
    
            if($jobTSGImageTodolistCreate -> user_id == $user_id)
            {
                $this->jobTSGImageTodolistCreateRepository->delete($id);
            
                Flash::success('Job T S G Image Todolist Create deleted successfully.');
                return redirect(route('jobTSGImageTodolistCreates.index'));
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