<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolViewRequest;
use App\Http\Requests\UpdateJobTSToolViewRequest;
use App\Repositories\JobTSToolViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolViewController extends AppBaseController
{
    private $jobTSToolViewRepository;

    public function __construct(JobTSToolViewRepository $jobTSToolViewRepo)
    {
        $this->jobTSToolViewRepository = $jobTSToolViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolViews = $this->jobTSToolViewRepository->all();
    
            return view('job_t_s_tool_views.index')
                ->with('jobTSToolViews', $jobTSToolViews);
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
            return view('job_t_s_tool_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSToolView = $this->jobTSToolViewRepository->create($input);
            
                Flash::success('Job T S Tool View saved successfully.');
                return redirect(route('jobTSToolViews.index'));
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
            $jobTSToolView = $this->jobTSToolViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolView))
            {
                Flash::error('Job T S Tool View not found');
                return redirect(route('jobTSToolViews.index'));
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
            
            if($user_id == $jobTSToolView -> user_id || $isShared)
            {
                return view('job_t_s_tool_views.show')->with('jobTSToolView', $jobTSToolView);
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
            $jobTSToolView = $this->jobTSToolViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolView))
            {
                Flash::error('Job T S Tool View not found');
                return redirect(route('jobTSToolViews.index'));
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
            
            if($user_id == $jobTSToolView -> user_id || $isShared)
            {
                return view('job_t_s_tool_views.edit')->with('jobTSToolView', $jobTSToolView);
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

    public function update($id, UpdateJobTSToolViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolView = $this->jobTSToolViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolView))
            {
                Flash::error('Job T S Tool View not found');
                return redirect(route('jobTSToolViews.index'));
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
            
            if($user_id == $jobTSToolView -> user_id || $isShared)
            {
                $jobTSToolView = $this->jobTSToolViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool View updated successfully.');
                return redirect(route('jobTSToolViews.index'));
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
            $jobTSToolView = $this->jobTSToolViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolView))
            {
                Flash::error('Job T S Tool View not found');
                return redirect(route('jobTSToolViews.index'));
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
            
            if($user_id == $jobTSToolView -> user_id || $isShared)
            {
                $this->jobTSToolViewRepository->delete($id);
            
                Flash::success('Job T S Tool View deleted successfully.');
                return redirect(route('jobTSToolViews.index'));
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