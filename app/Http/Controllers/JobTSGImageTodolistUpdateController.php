<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGImageTodolistUpdateRequest;
use App\Http\Requests\UpdateJobTSGImageTodolistUpdateRequest;
use App\Repositories\JobTSGImageTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGImageTodolistUpdateController extends AppBaseController
{
    private $jobTSGImageTodolistUpdateRepository;

    public function __construct(JobTSGImageTodolistUpdateRepository $jobTSGImageTodolistUpdateRepo)
    {
        $this->jobTSGImageTodolistUpdateRepository = $jobTSGImageTodolistUpdateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGImageTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGImageTodolistUpdates = $this->jobTSGImageTodolistUpdateRepository->all();
    
            return view('job_t_s_g_image_todolist_updates.index')
                ->with('jobTSGImageTodolistUpdates', $jobTSGImageTodolistUpdates);
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
            return view('job_t_s_g_image_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGImageTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSGImageTodolistUpdate = $this->jobTSGImageTodolistUpdateRepository->create($input);

            Flash::success('Job T S G Image Todolist Update saved successfully.');
            return redirect(route('jobTSGImageTodolistUpdates.index'));
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
            $jobTSGImageTodolistUpdate = $this->jobTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistUpdate))
            {
                Flash::error('Job T S G Image Todolist Update not found');
                return redirect(route('jobTSGImageTodolistUpdates.index'));
            }
            
            if($jobTSGImageTodolistUpdate -> user_id == $user_id)
            {
                return view('job_t_s_g_image_todolist_updates.show')
                    ->with('jobTSGImageTodolistUpdate', $jobTSGImageTodolistUpdate);
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
            $jobTSGImageTodolistUpdate = $this->jobTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistUpdate))
            {
                Flash::error('Job T S G Image Todolist Update not found');
                return redirect(route('jobTSGImageTodolistUpdates.index'));
            }
    
            if($jobTSGImageTodolistUpdate -> user_id == $user_id)
            {
                return view('job_t_s_g_image_todolist_updates.edit')->with('jobTSGImageTodolistUpdate', $jobTSGImageTodolistUpdate);
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

    public function update($id, UpdateJobTSGImageTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGImageTodolistUpdate = $this->jobTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistUpdate))
            {
                Flash::error('Job T S G Image Todolist Update not found');
                return redirect(route('jobTSGImageTodolistUpdates.index'));
            }
    
            if($jobTSGImageTodolistUpdate -> user_id == $user_id)
            {
                $jobTSGImageTodolistUpdate = $this->jobTSGImageTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S G Image Todolist Update updated successfully.');
                return redirect(route('jobTSGImageTodolistUpdates.index'));
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
            $jobTSGImageTodolistUpdate = $this->jobTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGImageTodolistUpdate))
            {
                Flash::error('Job T S G Image Todolist Update not found');
                return redirect(route('jobTSGImageTodolistUpdates.index'));
            }
            
            if($jobTSGImageTodolistUpdate -> user_id == $user_id)
            {
                $this->jobTSGImageTodolistUpdateRepository->delete($id);
            
                Flash::success('Job T S G Image Todolist Update deleted successfully.');
                return redirect(route('jobTSGImageTodolistUpdates.index'));
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