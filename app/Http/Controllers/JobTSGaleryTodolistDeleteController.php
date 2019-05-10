<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryTodolistDeleteRequest;
use App\Http\Requests\UpdateJobTSGaleryTodolistDeleteRequest;
use App\Repositories\JobTSGaleryTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryTodolistDeleteController extends AppBaseController
{
    private $jobTSGaleryTodolistDeleteRepository;

    public function __construct(JobTSGaleryTodolistDeleteRepository $jobTSGaleryTodolistDeleteRepo)
    {
        $this->jobTSGaleryTodolistDeleteRepository = $jobTSGaleryTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryTodolistDeletes = $this->jobTSGaleryTodolistDeleteRepository->all();
    
            return view('job_t_s_galery_todolist_deletes.index')
                ->with('jobTSGaleryTodolistDeletes', $jobTSGaleryTodolistDeletes);
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
            return view('job_t_s_galery_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSGaleryTodolistDelete = $this->jobTSGaleryTodolistDeleteRepository->create($input);
    
            Flash::success('Job T S Galery Todolist Delete saved successfully.');
            return redirect(route('jobTSGaleryTodolistDeletes.index'));
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
            $jobTSGaleryTodolistDelete = $this->jobTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistDelete))
            {
                Flash::error('Job T S Galery Todolist Delete not found');
                return redirect(route('jobTSGaleryTodolistDeletes.index'));
            }
            
            if($jobTSGaleryTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_galery_todolist_deletes.show')->with('jobTSGaleryTodolistDelete', $jobTSGaleryTodolistDelete);
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
            $jobTSGaleryTodolistDelete = $this->jobTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistDelete))
            {
                Flash::error('Job T S Galery Todolist Delete not found');
                return redirect(route('jobTSGaleryTodolistDeletes.index'));
            }
    
            if($jobTSGaleryTodolistDelete -> user_id == $user_id)
            {
                return view('job_t_s_galery_todolist_deletes.edit')->with('jobTSGaleryTodolistDelete', $jobTSGaleryTodolistDelete);
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

    public function update($id, UpdateJobTSGaleryTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryTodolistDelete = $this->jobTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistDelete))
            {
                Flash::error('Job T S Galery Todolist Delete not found');
                return redirect(route('jobTSGaleryTodolistDeletes.index'));
            }
    
            if($jobTSGaleryTodolistDelete -> user_id == $user_id)
            {
                $jobTSGaleryTodolistDelete = $this->jobTSGaleryTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery Todolist Delete updated successfully.');
                return redirect(route('jobTSGaleryTodolistDeletes.index'));
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
            $jobTSGaleryTodolistDelete = $this->jobTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistDelete))
            {
                Flash::error('Job T S Galery Todolist Delete not found');
                return redirect(route('jobTSGaleryTodolistDeletes.index'));
            }
    
            if($jobTSGaleryTodolistDelete -> user_id == $user_id)
            {
                $this->jobTSGaleryTodolistDeleteRepository->delete($id);
            
                Flash::success('Job T S Galery Todolist Delete deleted successfully.');
                return redirect(route('jobTSGaleryTodolistDeletes.index'));
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