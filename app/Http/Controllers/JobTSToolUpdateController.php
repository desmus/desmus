<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolUpdateRequest;
use App\Http\Requests\UpdateJobTSToolUpdateRequest;
use App\Repositories\JobTSToolUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolUpdateController extends AppBaseController
{
    private $jobTSToolUpdateRepository;

    public function __construct(JobTSToolUpdateRepository $jobTSToolUpdateRepo)
    {
        $this->jobTSToolUpdateRepository = $jobTSToolUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolUpdates = $this->jobTSToolUpdateRepository->all();
    
            return view('job_t_s_tool_updates.index')
                ->with('jobTSToolUpdates', $jobTSToolUpdates);
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
            return view('job_t_s_tool_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSToolUpdate = $this->jobTSToolUpdateRepository->create($input);
            
                Flash::success('Job T S Tool Update saved successfully.');
                return redirect(route('jobTSToolUpdates.index'));
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
            $jobTSToolUpdate = $this->jobTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolUpdate))
            {
                Flash::error('Job T S Tool Update not found');
                return redirect(route('jobTSToolUpdates.index'));
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
            
            if($user_id == $jobTSToolUpdate -> user_id || $isShared)
            {
                return view('job_t_s_tool_updates.show')->with('jobTSToolUpdate', $jobTSToolUpdate);
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
            $jobTSToolUpdate = $this->jobTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolUpdate))
            {
                Flash::error('Job T S Tool Update not found');
                return redirect(route('jobTSToolUpdates.index'));
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
            
            if($user_id == $jobTSToolUpdate -> user_id || $isShared)
            {
                return view('job_t_s_tool_updates.edit')->with('jobTSToolUpdate', $jobTSToolUpdate);
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

    public function update($id, UpdateJobTSToolUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolUpdate = $this->jobTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolUpdate))
            {
                Flash::error('Job T S Tool Update not found');
                return redirect(route('jobTSToolUpdates.index'));
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
            
            if($user_id == $jobTSToolUpdate -> user_id || $isShared)
            {
                $jobTSToolUpdate = $this->jobTSToolUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool Update updated successfully.');
                return redirect(route('jobTSToolUpdates.index'));
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
            $jobTSToolUpdate = $this->jobTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolUpdate))
            {
                Flash::error('Job T S Tool Update not found');
                return redirect(route('jobTSToolUpdates.index'));
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
            
            if($user_id == $jobTSToolUpdate -> user_id || $isShared)
            {
                $this->jobTSToolUpdateRepository->delete($id);
            
                Flash::success('Job T S Tool Update deleted successfully.');
                return redirect(route('jobTSToolUpdates.index'));
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