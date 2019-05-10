<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryTodolistUpdateRequest;
use App\Http\Requests\UpdateJobTSGaleryTodolistUpdateRequest;
use App\Repositories\JobTSGaleryTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryTodolistUpdateController extends AppBaseController
{
    private $jobTSGaleryTodolistUpdateRepository;

    public function __construct(JobTSGaleryTodolistUpdateRepository $jobTSGaleryTodolistUpdateRepo)
    {
        $this->jobTSGaleryTodolistUpdateRepository = $jobTSGaleryTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryTodolistUpdates = $this->jobTSGaleryTodolistUpdateRepository->all();
    
            return view('job_t_s_galery_todolist_updates.index')
                ->with('jobTSGaleryTodolistUpdates', $jobTSGaleryTodolistUpdates);
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
            return view('job_t_s_galery_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSGaleryTodolistUpdate = $this->jobTSGaleryTodolistUpdateRepository->create($input);
    
            Flash::success('Job T S Galery Todolist Update saved successfully.');
            return redirect(route('jobTSGaleryTodolistUpdates.index'));
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
            $jobTSGaleryTodolistUpdate = $this->jobTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistUpdate))
            {
                Flash::error('Job T S Galery Todolist Update not found');
                return redirect(route('jobTSGaleryTodolistUpdates.index'));
            }
    
            if($jobTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                return view('job_t_s_galery_todolist_updates.show')->with('jobTSGaleryTodolistUpdate', $jobTSGaleryTodolistUpdate);
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
            $jobTSGaleryTodolistUpdate = $this->jobTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistUpdate))
            {
                Flash::error('Job T S Galery Todolist Update not found');
                return redirect(route('jobTSGaleryTodolistUpdates.index'));
            }
            
            if($jobTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                return view('job_t_s_galery_todolist_updates.edit')->with('jobTSGaleryTodolistUpdate', $jobTSGaleryTodolistUpdate);
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

    public function update($id, UpdateJobTSGaleryTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryTodolistUpdate = $this->jobTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistUpdate))
            {
                Flash::error('Job T S Galery Todolist Update not found');
                return redirect(route('jobTSGaleryTodolistUpdates.index'));
            }
    
            if($jobTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                $jobTSGaleryTodolistUpdate = $this->jobTSGaleryTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery Todolist Update updated successfully.');
                return redirect(route('jobTSGaleryTodolistUpdates.index'));
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
            $jobTSGaleryTodolistUpdate = $this->jobTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolistUpdate))
            {
                Flash::error('Job T S Galery Todolist Update not found');
                return redirect(route('jobTSGaleryTodolistUpdates.index'));
            }
    
            if($jobTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                $this->jobTSGaleryTodolistUpdateRepository->delete($id);
            
                Flash::success('Job T S Galery Todolist Update deleted successfully.');
                return redirect(route('jobTSGaleryTodolistUpdates.index'));
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