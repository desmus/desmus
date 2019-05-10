<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryImageViewRequest;
use App\Http\Requests\UpdateJobTSGaleryImageViewRequest;
use App\Repositories\JobTSGaleryImageViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryImageViewController extends AppBaseController
{
    private $jobTSGaleryImageViewRepository;

    public function __construct(JobTSGaleryImageViewRepository $jobTSGaleryImageViewRepo)
    {
        $this->jobTSGaleryImageViewRepository = $jobTSGaleryImageViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryImageViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryImageViews = $this->jobTSGaleryImageViewRepository->all();
    
            return view('job_t_s_galery_image_views.index')
                ->with('jobTSGaleryImageViews', $jobTSGaleryImageViews);
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
            return view('job_t_s_galery_image_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSGaleryImageView = $this->jobTSGaleryImageViewRepository->create($input);
            
                Flash::success('Job T S Galery Image View saved successfully.');
                return redirect(route('jobTSGaleryImageViews.index'));
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
            $jobTSGaleryImageView = $this->jobTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageView))
            {
                Flash::error('Job T S Galery Image View not found');
                return redirect(route('jobTSGaleryImageViews.index'));
            }
            
            $userJobTSGaleryImages = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleryImages as $userJobTSGaleryImage)
            {
                if($userJobTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galery_images')->join('job_t_s_galeries', 'job_t_s_galery_images.job_t_s_g_id', '=', 'job_t_s_galeries.id')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryImageView -> user_id || $isShared)
            {
                return view('job_t_s_galery_image_views.show')->with('jobTSGaleryImageView', $jobTSGaleryImageView);
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
            $jobTSGaleryImageView = $this->jobTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageView))
            {
                Flash::error('Job T S Galery Image View not found');
                return redirect(route('jobTSGaleryImageViews.index'));
            }
    
            $userJobTSGaleryImages = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleryImages as $userJobTSGaleryImage)
            {
                if($userJobTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galery_images')->join('job_t_s_galeries', 'job_t_s_galery_images.job_t_s_g_id', '=', 'job_t_s_galeries.id')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryImageView -> user_id || $isShared)
            {
                return view('job_t_s_galery_image_views.edit')->with('jobTSGaleryImageView', $jobTSGaleryImageView);
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

    public function update($id, UpdateJobTSGaleryImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryImageView = $this->jobTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageView))
            {
                Flash::error('Job T S Galery Image View not found');
                return redirect(route('jobTSGaleryImageViews.index'));
            }
            
            $userJobTSGaleryImages = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleryImages as $userJobTSGaleryImage)
            {
                if($userJobTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galery_images')->join('job_t_s_galeries', 'job_t_s_galery_images.job_t_s_g_id', '=', 'job_t_s_galeries.id')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryImageView -> user_id || $isShared)
            {
                $jobTSGaleryImageView = $this->jobTSGaleryImageViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery Image View updated successfully.');
                return redirect(route('jobTSGaleryImageViews.index'));
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
            $jobTSGaleryImageView = $this->jobTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageView))
            {
                Flash::error('Job T S Galery Image View not found');
                return redirect(route('jobTSGaleryImageViews.index'));
            }
    
            $userJobTSGaleryImages = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleryImages as $userJobTSGaleryImage)
            {
                if($userJobTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galery_images')->join('job_t_s_galeries', 'job_t_s_galery_images.job_t_s_g_id', '=', 'job_t_s_galeries.id')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryImageView -> user_id || $isShared)
            {
                $this->jobTSGaleryImageViewRepository->delete($id);
            
                Flash::success('Job T S Galery Image View deleted successfully.');
                return redirect(route('jobTSGaleryImageViews.index'));
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