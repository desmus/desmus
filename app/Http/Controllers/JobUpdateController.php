<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobUpdateRequest;
use App\Http\Requests\UpdateJobUpdateRequest;
use App\Repositories\JobUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobUpdateController extends AppBaseController
{
    private $jobUpdateRepository;

    public function __construct(JobUpdateRepository $jobUpdateRepo)
    {
        $this->jobUpdateRepository = $jobUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobUpdates = $this->jobUpdateRepository->all();
    
            return view('job_updates.index')
                ->with('jobUpdates', $jobUpdates);
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
            return view('job_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobUpdate = $this->jobUpdateRepository->create($input);
            
                Flash::success('Job Update saved successfully.');
                return redirect(route('jobUpdates.index'));
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

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobUpdate = $this->jobUpdateRepository->findWithoutFail($id);
    
            if(empty($jobUpdate))
            {
                Flash::error('Job Update not found');
                return redirect(route('jobUpdates.index'));
            }
            
            $userJobs = DB::table('user_jobs')->where('job_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobs as $userJob)
            {
                if($userJob -> user_id == $user_id && $userJob -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $jobUpdate -> user_id || $isShared)
            {
                return view('job_updates.show')
                    ->with('jobUpdate', $jobUpdate);
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
            $jobUpdate = $this->jobUpdateRepository->findWithoutFail($id);
    
            if(empty($jobUpdate))
            {
                Flash::error('Job Update not found');
                return redirect(route('jobUpdates.index'));
            }
            
            $userJobs = DB::table('user_jobs')->where('job_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobs as $userJob)
            {
                if($userJob -> user_id == $user_id && $userJob -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $jobUpdate -> user_id || $isShared)
            {
                return view('job_updates.edit')
                    ->with('jobUpdate', $jobUpdate);
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

    public function update($id, UpdateJobUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobUpdate = $this->jobUpdateRepository->findWithoutFail($id);
    
            if(empty($jobUpdate))
            {
                Flash::error('Job Update not found');
                return redirect(route('jobUpdates.index'));
            }
            
            $userJobs = DB::table('user_jobs')->where('job_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobs as $userJob)
            {
                if($userJob -> user_id == $user_id && $userJob -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $jobUpdate -> user_id || $isShared)
            {
                $jobUpdate = $this->jobUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job Update updated successfully.');
                return redirect(route('jobUpdates.index'));
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
            $jobUpdate = $this->jobUpdateRepository->findWithoutFail($id);
    
            if(empty($jobUpdate))
            {
                Flash::error('Job Update not found');
                return redirect(route('jobUpdates.index'));
            }
    
            $userJobs = DB::table('user_jobs')->where('job_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobs as $userJob)
            {
                if($userJob -> user_id == $user_id && $userJob -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $jobUpdate -> user_id || $isShared)
            {
                $this->jobUpdateRepository->delete($id);
            
                Flash::success('Job Update deleted successfully.');
                return redirect(route('jobUpdates.index'));
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