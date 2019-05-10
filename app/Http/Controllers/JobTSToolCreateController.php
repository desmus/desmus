<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolCreateRequest;
use App\Http\Requests\UpdateJobTSToolCreateRequest;
use App\Repositories\JobTSToolCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolCreateController extends AppBaseController
{
    private $jobTSToolCreateRepository;

    public function __construct(JobTSToolCreateRepository $jobTSToolCreateRepo)
    {
        $this->jobTSToolCreateRepository = $jobTSToolCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolCreates = $this->jobTSToolCreateRepository->all();
    
            return view('job_t_s_tool_creates.index')
                ->with('jobTSToolCreates', $jobTSToolCreates);
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
            return view('job_t_s_tool_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSToolCreate = $this->jobTSToolCreateRepository->create($input);
            
                Flash::success('Job T S Tool Create saved successfully.');
                return redirect(route('jobTSToolCreates.index'));
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
            $jobTSToolCreate = $this->jobTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolCreate))
            {
                Flash::error('Job T S Tool Create not found');
                return redirect(route('jobTSToolCreates.index'));
            }
            
            $userJobTSTools = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSTools as $userJobTSTool)
            {
                if($userJobTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $jobTSToolCreate -> user_id || $isShared)
            {
                return view('job_t_s_tool_creates.show')->with('jobTSToolCreate', $jobTSToolCreate);
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
            $jobTSToolCreate = $this->jobTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolCreate))
            {
                Flash::error('Job T S Tool Create not found');
                return redirect(route('jobTSToolCreates.index'));
            }
            
            $userJobTSTools = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSTools as $userJobTSTool)
            {
                if($userJobTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $jobTSToolCreate -> user_id || $isShared)
            {
                return view('job_t_s_tool_creates.edit')->with('jobTSToolCreate', $jobTSToolCreate);
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

    public function update($id, UpdateJobTSToolCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolCreate = $this->jobTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolCreate))
            {
                Flash::error('Job T S Tool Create not found');
                return redirect(route('jobTSToolCreates.index'));
            }
    
            $userJobTSTools = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSTools as $userJobTSTool)
            {
                if($userJobTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $jobTSToolCreate -> user_id || $isShared)
            {
                $jobTSToolCreate = $this->jobTSToolCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool Create updated successfully.');
                return redirect(route('jobTSToolCreates.index'));
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
            $jobTSToolCreate = $this->jobTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolCreate))
            {
                Flash::error('Job T S Tool Create not found');
                return redirect(route('jobTSToolCreates.index'));
            }
            
            $userJobTSTools = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSTools as $userJobTSTool)
            {
                if($userJobTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $jobTSToolCreate -> user_id || $isShared)
            {
                $this->jobTSToolCreateRepository->delete($id);
            
                Flash::success('Job T S Tool Create deleted successfully.');
                return redirect(route('jobTSToolCreates.index'));
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