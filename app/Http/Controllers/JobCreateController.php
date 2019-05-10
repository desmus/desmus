<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobCreateRequest;
use App\Http\Requests\UpdateJobCreateRequest;
use App\Repositories\JobCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobCreateController extends AppBaseController
{
    private $jobCreateRepository;

    public function __construct(JobCreateRepository $jobCreateRepo)
    {
        $this->jobCreateRepository = $jobCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobCreates = $this->jobCreateRepository->all();
    
            return view('job_creates.index')
                ->with('jobCreates', $jobCreates);
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
            return view('job_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobCreate = $this->jobCreateRepository->create($input);
            
                Flash::success('Job Create saved successfully.');
                return redirect(route('jobCreates.index'));
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
            $jobCreate = $this->jobCreateRepository->findWithoutFail($id);
    
            if(empty($jobCreate))
            {
                Flash::error('Job Create not found');
                return redirect(route('jobCreates.index'));
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
            
            if($user_id == $jobCreate -> user_id || $isShared)
            {
                return view('job_creates.show')->with('jobCreate', $jobCreate);
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
            $jobCreate = $this->jobCreateRepository->findWithoutFail($id);
    
            if(empty($jobCreate))
            {
                Flash::error('Job Create not found');
                return redirect(route('jobCreates.index'));
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
            
            if($user_id == $jobCreate -> user_id || $isShared)
            {
                return view('job_creates.edit')->with('jobCreate', $jobCreate);
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

    public function update($id, UpdateJobCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobCreate = $this->jobCreateRepository->findWithoutFail($id);
    
            if(empty($jobCreate))
            {
                Flash::error('Job Create not found');
                return redirect(route('jobCreates.index'));
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
            
            if($user_id == $jobCreate -> user_id || $isShared)
            {
                $jobCreate = $this->jobCreateRepository->update($request->all(), $id);
            
                Flash::success('Job Create updated successfully.');
                return redirect(route('jobCreates.index'));
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
            $jobCreate = $this->jobCreateRepository->findWithoutFail($id);
    
            if(empty($jobCreate))
            {
                Flash::error('Job Create not found');
                return redirect(route('jobCreates.index'));
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
            
            if($user_id == $jobCreate -> user_id || $isShared)
            {
                $this->jobCreateRepository->delete($id);
            
                Flash::success('Job Create deleted successfully.');
                return redirect(route('jobCreates.index'));
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