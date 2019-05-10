<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryCreateRequest;
use App\Http\Requests\UpdateJobTSGaleryCreateRequest;
use App\Repositories\JobTSGaleryCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryCreateController extends AppBaseController
{
    private $jobTSGaleryCreateRepository;

    public function __construct(JobTSGaleryCreateRepository $jobTSGaleryCreateRepo)
    {
        $this->jobTSGaleryCreateRepository = $jobTSGaleryCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryCreates = $this->jobTSGaleryCreateRepository->all();
    
            return view('job_t_s_galery_creates.index')
                ->with('jobTSGaleryCreates', $jobTSGaleryCreates);
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
            return view('job_t_s_galery_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSGaleryCreate = $this->jobTSGaleryCreateRepository->create($input);
            
                Flash::success('Job T S Galery Create saved successfully.');
                return redirect(route('jobTSGaleryCreates.index'));
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
            $jobTSGaleryCreate = $this->jobTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryCreate))
            {
                Flash::error('Job T S Galery Create not found');
                return redirect(route('jobTSGaleryCreates.index'));
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
            
            if($user_id == $jobTSGaleryCreate -> user_id || $isShared)
            {
                return view('job_t_s_galery_creates.show')
                    ->with('jobTSGaleryCreate', $jobTSGaleryCreate);
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
            $jobTSGaleryCreate = $this->jobTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryCreate))
            {
                Flash::error('Job T S Galery Create not found');
                return redirect(route('jobTSGaleryCreates.index'));
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
            
            if($user_id == $jobTSGaleryCreate -> user_id || $isShared)
            {
                return view('job_t_s_galery_creates.edit')
                    ->with('jobTSGaleryCreate', $jobTSGaleryCreate);
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

    public function update($id, UpdateJobTSGaleryCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryCreate = $this->jobTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryCreate))
            {
                Flash::error('Job T S Galery Create not found');
                return redirect(route('jobTSGaleryCreates.index'));
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
            
            if($user_id == $jobTSGaleryCreate -> user_id || $isShared)
            {
                $jobTSGaleryCreate = $this->jobTSGaleryCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery Create updated successfully.');
                return redirect(route('jobTSGaleryCreates.index'));
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
            $jobTSGaleryCreate = $this->jobTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryCreate))
            {
                Flash::error('Job T S Galery Create not found');
                return redirect(route('jobTSGaleryCreates.index'));
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
            
            if($user_id == $jobTSGaleryCreate -> user_id || $isShared)
            {
                $this->jobTSGaleryCreateRepository->delete($id);
            
                Flash::success('Job T S Galery Create deleted successfully.');
                return redirect(route('jobTSGaleryCreates.index'));
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