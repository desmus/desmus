<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobDeleteRequest;
use App\Http\Requests\UpdateJobDeleteRequest;
use App\Repositories\JobDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobDeleteController extends AppBaseController
{
    private $jobDeleteRepository;

    public function __construct(JobDeleteRepository $jobDeleteRepo)
    {
        $this->jobDeleteRepository = $jobDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobDeletes = $this->jobDeleteRepository->all();
    
            return view('job_deletes.index')
                ->with('jobDeletes', $jobDeletes);
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
            return view('job_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobDelete = $this->jobDeleteRepository->create($input);
            
                Flash::success('Job Delete saved successfully.');
                return redirect(route('jobDeletes.index'));
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
            $jobDelete = $this->jobDeleteRepository->findWithoutFail($id);
    
            if(empty($jobDelete))
            {
                Flash::error('Job Delete not found');
                return redirect(route('jobDeletes.index'));
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
            
            if($user_id == $jobDelete -> user_id || $isShared)
            {
                return view('job_deletes.show')
                    ->with('jobDelete', $jobDelete);
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
            $jobDelete = $this->jobDeleteRepository->findWithoutFail($id);
    
            if(empty($jobDelete))
            {
                Flash::error('Job Delete not found');
                return redirect(route('jobDeletes.index'));
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
            
            if($user_id == $jobDelete -> user_id || $isShared)
            {
                return view('job_deletes.edit')->with('jobDelete', $jobDelete);
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

    public function update($id, UpdateJobDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobDelete = $this->jobDeleteRepository->findWithoutFail($id);
    
            if(empty($jobDelete))
            {
                Flash::error('Job Delete not found');
                return redirect(route('jobDeletes.index'));
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
            
            if($user_id == $jobDelete -> user_id || $isShared)
            {
                $jobDelete = $this->jobDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job Delete updated successfully.');
                return redirect(route('jobDeletes.index'));
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
            $jobDelete = $this->jobDeleteRepository->findWithoutFail($id);
    
            if(empty($jobDelete))
            {
                Flash::error('Job Delete not found');
                return redirect(route('jobDeletes.index'));
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
            
            if($user_id == $jobDelete -> user_id || $isShared)
            {
                $this->jobDeleteRepository->delete($id);
            
                Flash::success('Job Delete deleted successfully.');
                return redirect(route('jobDeletes.index'));
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