<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPTUpdateRequest;
use App\Http\Requests\UpdateJobTSPTUpdateRequest;
use App\Repositories\JobTSPTUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPTUpdateController extends AppBaseController
{
    private $jobTSPTUpdateRepository;

    public function __construct(JobTSPTUpdateRepository $jobTSPTUpdateRepo)
    {
        $this->jobTSPTUpdateRepository = $jobTSPTUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPTUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPTUpdates = $this->jobTSPTUpdateRepository->all();
    
            return view('job_t_s_p_t_updates.index')
                ->with('jobTSPTUpdates', $jobTSPTUpdates);
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
            return view('job_t_s_p_t_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPTUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSPTUpdate = $this->jobTSPTUpdateRepository->create($input);
    
            Flash::success('Job T S P T Update saved successfully.');
            return redirect(route('jobTSPTUpdates.index'));
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
            $jobTSPTUpdate = $this->jobTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPTUpdate))
            {
                Flash::error('Job T S P T Update not found');
                return redirect(route('jobTSPTUpdates.index'));
            }
    
            if($jobTSPTUpdate -> user_id == $user_id)
            {
                return view('job_t_s_p_t_updates.show')->with('jobTSPTUpdate', $jobTSPTUpdate);
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
            $jobTSPTUpdate = $this->jobTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPTUpdate))
            {
                Flash::error('Job T S P T Update not found');
                return redirect(route('jobTSPTUpdates.index'));
            }
    
            if($jobTSPTUpdate -> user_id == $user_id)
            {
                return view('job_t_s_p_t_updates.edit')->with('jobTSPTUpdate', $jobTSPTUpdate);
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

    public function update($id, UpdateJobTSPTUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSPTUpdate = $this->jobTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPTUpdate))
            {
                Flash::error('Job T S P T Update not found');
                return redirect(route('jobTSPTUpdates.index'));
            }
    
            if($jobTSPTUpdate -> user_id == $user_id)
            {
                $jobTSPTUpdate = $this->jobTSPTUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S P T Update updated successfully.');
                return redirect(route('jobTSPTUpdates.index'));
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
            $jobTSPTUpdate = $this->jobTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPTUpdate))
            {
                Flash::error('Job T S P T Update not found');
                return redirect(route('jobTSPTUpdates.index'));
            }
    
            if($jobTSPTUpdate -> user_id == $user_id)
            {
                $this->jobTSPTUpdateRepository->delete($id);
            
                Flash::success('Job T S P T Update deleted successfully.');
                return redirect(route('jobTSPTUpdates.index'));
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