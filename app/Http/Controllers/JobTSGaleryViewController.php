<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryViewRequest;
use App\Http\Requests\UpdateJobTSGaleryViewRequest;
use App\Repositories\JobTSGaleryViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryViewController extends AppBaseController
{
    private $jobTSGaleryViewRepository;

    public function __construct(JobTSGaleryViewRepository $jobTSGaleryViewRepo)
    {
        $this->jobTSGaleryViewRepository = $jobTSGaleryViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryViews = $this->jobTSGaleryViewRepository->all();
    
            return view('job_t_s_galery_views.index')
                ->with('jobTSGaleryViews', $jobTSGaleryViews);
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
            return view('job_t_s_galery_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSGaleryView = $this->jobTSGaleryViewRepository->create($input);
            
                Flash::success('Job T S Galery View saved successfully.');
                return redirect(route('jobTSGaleryViews.index'));
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
            $jobTSGaleryView = $this->jobTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryView))
            {
                Flash::error('Job T S Galery View not found');
                return redirect(route('jobTSGaleryViews.index'));
            }
            
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleries as $userJobTSGalerie)
            {
                if($userJobTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryView -> user_id || $isShared)
            {
                return view('job_t_s_galery_views.show')->with('jobTSGaleryView', $jobTSGaleryView);
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
            $jobTSGaleryView = $this->jobTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryView))
            {
                Flash::error('Job T S Galery View not found');
                return redirect(route('jobTSGaleryViews.index'));
            }
            
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleries as $userJobTSGalerie)
            {
                if($userJobTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryView -> user_id || $isShared)
            {
                return view('job_t_s_galery_views.edit')->with('jobTSGaleryView', $jobTSGaleryView);
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

    public function update($id, UpdateJobTSGaleryViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryView = $this->jobTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryView))
            {
                Flash::error('Job T S Galery View not found');
                return redirect(route('jobTSGaleryViews.index'));
            }
    
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleries as $userJobTSGalerie)
            {
                if($userJobTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryView -> user_id || $isShared)
            {
                $jobTSGaleryView = $this->jobTSGaleryViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery View updated successfully.');
                return redirect(route('jobTSGaleryViews.index'));
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
            $jobTSGaleryView = $this->jobTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryView))
            {
                Flash::error('Job T S Galery View not found');
                return redirect(route('jobTSGaleryViews.index'));
            }
            
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleries as $userJobTSGalerie)
            {
                if($userJobTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryView -> user_id || $isShared)
            {
                $this->jobTSGaleryViewRepository->delete($id);
            
                Flash::success('Job T S Galery View deleted successfully.');
                return redirect(route('jobTSGaleryViews.index'));
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