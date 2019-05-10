<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobViewRequest;
use App\Http\Requests\UpdateJobViewRequest;
use App\Repositories\JobViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobViewController extends AppBaseController
{
    private $jobViewRepository;

    public function __construct(JobViewRepository $jobViewRepo)
    {
        $this->jobViewRepository = $jobViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobViewRepository->pushCriteria(new RequestCriteria($request));
            $jobViews = $this->jobViewRepository->all();
    
            return view('job_views.index')
                ->with('jobViews', $jobViews);
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
            return view('job_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobView = $this->jobViewRepository->create($input);
            
                Flash::success('Job View saved successfully.');
                return redirect(route('jobViews.index'));
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
            $jobView = $this->jobViewRepository->findWithoutFail($id);
    
            if(empty($jobView))
            {
                Flash::error('Job View not found');
                return redirect(route('jobViews.index'));
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
            
            if($user_id == $jobView -> user_id || $isShared)
            {
                return view('job_views.show')
                    ->with('jobView', $jobView);
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
            $jobView = $this->jobViewRepository->findWithoutFail($id);
    
            if(empty($jobView))
            {
                Flash::error('Job View not found');
                return redirect(route('jobViews.index'));
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
            
            if($user_id == $jobView -> user_id || $isShared)
            {
                return view('job_views.edit')
                    ->with('jobView', $jobView);
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

    public function update($id, UpdateJobViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobView = $this->jobViewRepository->findWithoutFail($id);
    
            if(empty($jobView))
            {
                Flash::error('Job View not found');
                return redirect(route('jobViews.index'));
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
            
            if($user_id == $jobView -> user_id || $isShared)
            {
                $jobView = $this->jobViewRepository->update($request->all(), $id);
            
                Flash::success('Job View updated successfully.');
                return redirect(route('jobViews.index'));
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
            $jobView = $this->jobViewRepository->findWithoutFail($id);
    
            if(empty($jobView))
            {
                Flash::error('Job View not found');
                return redirect(route('jobViews.index'));
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
            
            if($user_id == $jobView -> user_id || $isShared)
            {
                $this->jobViewRepository->delete($id);
            
                Flash::success('Job View deleted successfully.');
                return redirect(route('jobViews.index'));
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