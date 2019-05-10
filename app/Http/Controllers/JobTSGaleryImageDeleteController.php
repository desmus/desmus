<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryImageDeleteRequest;
use App\Http\Requests\UpdateJobTSGaleryImageDeleteRequest;
use App\Repositories\JobTSGaleryImageDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryImageDeleteController extends AppBaseController
{
    private $jobTSGaleryImageDeleteRepository;

    public function __construct(JobTSGaleryImageDeleteRepository $jobTSGaleryImageDeleteRepo)
    {
        $this->jobTSGaleryImageDeleteRepository = $jobTSGaleryImageDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryImageDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryImageDeletes = $this->jobTSGaleryImageDeleteRepository->all();
    
            return view('job_t_s_galery_image_deletes.index')
                ->with('jobTSGaleryImageDeletes', $jobTSGaleryImageDeletes);
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
            return view('job_t_s_galery_image_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryImageDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSGaleryImageDelete = $this->jobTSGaleryImageDeleteRepository->create($input);
            
                Flash::success('Job T S Galery Image Delete saved successfully.');
                return redirect(route('jobTSGaleryImageDeletes.index'));
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
            $jobTSGaleryImageDelete = $this->jobTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageDelete))
            {
                Flash::error('Job T S Galery Image Delete not found');
                return redirect(route('jobTSGaleryImageDeletes.index'));
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
            
            if($user_id == $jobTSGaleryImageDelete -> user_id || $isShared)
            {
                return view('job_t_s_galery_image_deletes.show')->with('jobTSGaleryImageDelete', $jobTSGaleryImageDelete);
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
            $jobTSGaleryImageDelete = $this->jobTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageDelete))
            {
                Flash::error('Job T S Galery Image Delete not found');
                return redirect(route('jobTSGaleryImageDeletes.index'));
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
            
            if($user_id == $jobTSGaleryImageDelete -> user_id || $isShared)
            {
                return view('job_t_s_galery_image_deletes.edit')->with('jobTSGaleryImageDelete', $jobTSGaleryImageDelete);
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

    public function update($id, UpdateJobTSGaleryImageDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryImageDelete = $this->jobTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageDelete))
            {
                Flash::error('Job T S Galery Image Delete not found');
                return redirect(route('jobTSGaleryImageDeletes.index'));
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
            
            if($user_id == $jobTSGaleryImageDelete -> user_id || $isShared)
            {
                $jobTSGaleryImageDelete = $this->jobTSGaleryImageDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery Image Delete updated successfully.');
                return redirect(route('jobTSGaleryImageDeletes.index'));
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
            $jobTSGaleryImageDelete = $this->jobTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageDelete))
            {
                Flash::error('Job T S Galery Image Delete not found');
                return redirect(route('jobTSGaleryImageDeletes.index'));
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
            
            if($user_id == $jobTSGaleryImageDelete -> user_id || $isShared)
            {
                $this->jobTSGaleryImageDeleteRepository->delete($id);
            
                Flash::success('Job T S Galery Image Delete deleted successfully.');
                return redirect(route('jobTSGaleryImageDeletes.index'));
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