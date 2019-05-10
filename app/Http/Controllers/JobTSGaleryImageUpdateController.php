<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryImageUpdateRequest;
use App\Http\Requests\UpdateJobTSGaleryImageUpdateRequest;
use App\Repositories\JobTSGaleryImageUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryImageUpdateController extends AppBaseController
{
    private $jobTSGaleryImageUpdateRepository;

    public function __construct(JobTSGaleryImageUpdateRepository $jobTSGaleryImageUpdateRepo)
    {
        $this->jobTSGaleryImageUpdateRepository = $jobTSGaleryImageUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryImageUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryImageUpdates = $this->jobTSGaleryImageUpdateRepository->all();
    
            return view('job_t_s_galery_image_updates.index')
                ->with('jobTSGaleryImageUpdates', $jobTSGaleryImageUpdates);
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
            return view('job_t_s_galery_image_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSGaleryImageUpdate = $this->jobTSGaleryImageUpdateRepository->create($input);
            
                Flash::success('Job T S Galery Image Update saved successfully.');
                return redirect(route('jobTSGaleryImageUpdates.index'));
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
            $jobTSGaleryImageUpdate = $this->jobTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageUpdate))
            {
                Flash::error('Job T S Galery Image Update not found');
                return redirect(route('jobTSGaleryImageUpdates.index'));
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
            
            if($user_id == $jobTSGaleryImageUpdate -> user_id || $isShared)
            {
                return view('job_t_s_galery_image_updates.show')->with('jobTSGaleryImageUpdate', $jobTSGaleryImageUpdate);
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
            $jobTSGaleryImageUpdate = $this->jobTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageUpdate))
            {
                Flash::error('Job T S Galery Image Update not found');
                return redirect(route('jobTSGaleryImageUpdates.index'));
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
            
            if($user_id == $jobTSGaleryImageUpdate -> user_id || $isShared)
            {
                return view('job_t_s_galery_image_updates.edit')->with('jobTSGaleryImageUpdate', $jobTSGaleryImageUpdate);
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

    public function update($id, UpdateJobTSGaleryImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryImageUpdate = $this->jobTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageUpdate))
            {
                Flash::error('Job T S Galery Image Update not found');
                return redirect(route('jobTSGaleryImageUpdates.index'));
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
            
            if($user_id == $jobTSGaleryImageUpdate -> user_id || $isShared)
            {
                $jobTSGaleryImageUpdate = $this->jobTSGaleryImageUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery Image Update updated successfully.');
                return redirect(route('jobTSGaleryImageUpdates.index'));
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
            $jobTSGaleryImageUpdate = $this->jobTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageUpdate))
            {
                Flash::error('Job T S Galery Image Update not found');
                return redirect(route('jobTSGaleryImageUpdates.index'));
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
            
            if($user_id == $jobTSGaleryImageUpdate -> user_id || $isShared)
            {
                $this->jobTSGaleryImageUpdateRepository->delete($id);
            
                Flash::success('Job T S Galery Image Update deleted successfully.');
                return redirect(route('jobTSGaleryImageUpdates.index'));
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