<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGImageTodolistRequest;
use App\Http\Requests\UpdateJobTSGImageTodolistRequest;
use App\Repositories\JobTSGImageTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGImageTodolistController extends AppBaseController
{
    private $jobTSGImageTodolistRepository;

    public function __construct(JobTSGImageTodolistRepository $jobTSGImageTodolistRepo)
    {
        $this->jobTSGImageTodolistRepository = $jobTSGImageTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGImageTodolistRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGImageTodolists = $this->jobTSGImageTodolistRepository->all();
    
            return view('job_t_s_g_image_todolists.index')
                ->with('jobTSGImageTodolists', $jobTSGImageTodolists);
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
            return view('job_t_s_g_image_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGImageTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSGImageTodolist = $this->jobTSGImageTodolistRepository->create($input);
    
            Flash::success('Job T S G Image Todolist saved successfully.');
            return redirect(route('jobTSGImageTodolists.index'));
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
            $jobTSGImageTodolist = $this->jobTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolist))
            {
                Flash::error('Job T S G Image Todolist not found');
                return redirect(route('jobTSGImageTodolists.index'));
            }
    
            return view('job_t_s_g_image_todolists.show')->with('jobTSGImageTodolist', $jobTSGImageTodolist);
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
            $jobTSGImageTodolist = $this->jobTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolist))
            {
                Flash::error('Job T S G Image Todolist not found');
                return redirect(route('jobTSGImageTodolists.index'));
            }
    
            return view('job_t_s_g_image_todolists.edit')->with('jobTSGImageTodolist', $jobTSGImageTodolist);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTSGImageTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $jobTSGImageTodolist = $this->jobTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolist))
            {
                Flash::error('Job T S G Image Todolist not found');
                return redirect(route('jobTSGImageTodolists.index'));
            }
    
            $jobTSGImageTodolist = $this->jobTSGImageTodolistRepository->update($request->all(), $id);
    
            Flash::success('Job T S G Image Todolist updated successfully.');
            return redirect(route('jobTSGImageTodolists.index'));
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
            $jobTSGImageTodolist = $this->jobTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolist))
            {
                Flash::error('Job T S G Image Todolist not found');
                return redirect(route('jobTSGImageTodolists.index'));
            }
    
            $this->jobTSGImageTodolistRepository->delete($id);
    
            Flash::success('Job T S G Image Todolist deleted successfully.');
            return redirect(route('jobTSGImageTodolists.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}