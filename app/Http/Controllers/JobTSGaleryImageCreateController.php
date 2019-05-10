<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryImageCreateRequest;
use App\Http\Requests\UpdateJobTSGaleryImageCreateRequest;
use App\Repositories\JobTSGaleryImageCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryImageCreateController extends AppBaseController
{
    private $jobTSGaleryImageCreateRepository;

    public function __construct(JobTSGaleryImageCreateRepository $jobTSGaleryImageCreateRepo)
    {
        $this->jobTSGaleryImageCreateRepository = $jobTSGaleryImageCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryImageCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryImageCreates = $this->jobTSGaleryImageCreateRepository->all();
    
            return view('job_t_s_galery_image_creates.index')
                ->with('jobTSGaleryImageCreates', $jobTSGaleryImageCreates);
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
            return view('job_t_s_galery_image_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryImageCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSGaleryImageCreate = $this->jobTSGaleryImageCreateRepository->create($input);
            
                Flash::success('Job T S Galery Image Create saved successfully.');
                return redirect(route('jobTSGaleryImageCreates.index'));
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
            $jobTSGaleryImageCreate = $this->jobTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageCreate))
            {
                Flash::error('Job T S Galery Image Create not found');
                return redirect(route('jobTSGaleryImageCreates.index'));
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
            
            if($user_id == $jobTSGaleryImageCreate -> user_id || $isShared)
            {
                return view('job_t_s_galery_image_creates.show')->with('jobTSGaleryImageCreate', $jobTSGaleryImageCreate);
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
            $jobTSGaleryImageCreate = $this->jobTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageCreate))
            {
                Flash::error('Job T S Galery Image Create not found');
                return redirect(route('jobTSGaleryImageCreates.index'));
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
            
            if($user_id == $jobTSGaleryImageCreate -> user_id || $isShared)
            {
                return view('job_t_s_galery_image_creates.edit')->with('jobTSGaleryImageCreate', $jobTSGaleryImageCreate);
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

    public function update($id, UpdateJobTSGaleryImageCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryImageCreate = $this->jobTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageCreate))
            {
                Flash::error('Job T S Galery Image Create not found');
                return redirect(route('jobTSGaleryImageCreates.index'));
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
            
            if($user_id == $jobTSGaleryImageCreate -> user_id || $isShared)
            {
                $jobTSGaleryImageCreate = $this->jobTSGaleryImageCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery Image Create updated successfully.');
                return redirect(route('jobTSGaleryImageCreates.index'));
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
            $jobTSGaleryImageCreate = $this->jobTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryImageCreate))
            {
                Flash::error('Job T S Galery Image Create not found');
                return redirect(route('jobTSGaleryImageCreates.index'));
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
            
            if($user_id == $jobTSGaleryImageCreate -> user_id || $isShared)
            {
                $this->jobTSGaleryImageCreateRepository->delete($id);
            
                Flash::success('Job T S Galery Image Create deleted successfully.');
                return redirect(route('jobTSGaleryImageCreates.index'));
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