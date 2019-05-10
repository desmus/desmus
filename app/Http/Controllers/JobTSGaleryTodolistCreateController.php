<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryTodolistCreateRequest;
use App\Http\Requests\UpdateJobTSGaleryTodolistCreateRequest;
use App\Repositories\JobTSGaleryTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryTodolistCreateController extends AppBaseController
{
    private $jobTSGaleryTodolistCreateRepository;

    public function __construct(JobTSGaleryTodolistCreateRepository $jobTSGaleryTodolistCreateRepo)
    {
        $this->jobTSGaleryTodolistCreateRepository = $jobTSGaleryTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryTodolistCreates = $this->jobTSGaleryTodolistCreateRepository->all();
    
            return view('job_t_s_galery_todolist_creates.index')
                ->with('jobTSGaleryTodolistCreates', $jobTSGaleryTodolistCreates);
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
            return view('job_t_s_galery_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSGaleryTodolistCreate = $this->jobTSGaleryTodolistCreateRepository->create($input);
    
            Flash::success('Job T S Galery Todolist Create saved successfully.');
            return redirect(route('jobTSGaleryTodolistCreates.index'));
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
            $jobTSGaleryTodolistCreate = $this->jobTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistCreate))
            {
                Flash::error('Job T S Galery Todolist Create not found');
                return redirect(route('jobTSGaleryTodolistCreates.index'));
            }
            
            if($jobTSGaleryTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_galery_todolist_creates.show')->with('jobTSGaleryTodolistCreate', $jobTSGaleryTodolistCreate);
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
            $jobTSGaleryTodolistCreate = $this->jobTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistCreate))
            {
                Flash::error('Job T S Galery Todolist Create not found');
                return redirect(route('jobTSGaleryTodolistCreates.index'));
            }
    
            if($jobTSGaleryTodolistCreate -> user_id == $user_id)
            {
                return view('job_t_s_galery_todolist_creates.edit')->with('jobTSGaleryTodolistCreate', $jobTSGaleryTodolistCreate);
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

    public function update($id, UpdateJobTSGaleryTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryTodolistCreate = $this->jobTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistCreate))
            {
                Flash::error('Job T S Galery Todolist Create not found');
                return redirect(route('jobTSGaleryTodolistCreates.index'));
            }
            
            if($jobTSGaleryTodolistCreate -> user_id == $user_id)
            {
                $jobTSGaleryTodolistCreate = $this->jobTSGaleryTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery Todolist Create updated successfully.');
                return redirect(route('jobTSGaleryTodolistCreates.index'));
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
            $jobTSGaleryTodolistCreate = $this->jobTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistCreate))
            {
                Flash::error('Job T S Galery Todolist Create not found');
                return redirect(route('jobTSGaleryTodolistCreates.index'));
            }
    
            if($jobTSGaleryTodolistCreate -> user_id == $user_id)
            {
                $this->jobTSGaleryTodolistCreateRepository->delete($id);
            
                Flash::success('Job T S Galery Todolist Create deleted successfully.');
                return redirect(route('jobTSGaleryTodolistCreates.index'));
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