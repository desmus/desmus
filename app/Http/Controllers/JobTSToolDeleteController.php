<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolDeleteRequest;
use App\Http\Requests\UpdateJobTSToolDeleteRequest;
use App\Repositories\JobTSToolDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolDeleteController extends AppBaseController
{
    private $jobTSToolDeleteRepository;

    public function __construct(JobTSToolDeleteRepository $jobTSToolDeleteRepo)
    {
        $this->jobTSToolDeleteRepository = $jobTSToolDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolDeletes = $this->jobTSToolDeleteRepository->all();
    
            return view('job_t_s_tool_deletes.index')
                ->with('jobTSToolDeletes', $jobTSToolDeletes);
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
            return view('job_t_s_tool_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSToolDelete = $this->jobTSToolDeleteRepository->create($input);
            
                Flash::success('Job T S Tool Delete saved successfully.');
                return redirect(route('jobTSToolDeletes.index'));
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
            $jobTSToolDelete = $this->jobTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolDelete))
            {
                Flash::error('Job T S Tool Delete not found');
                return redirect(route('jobTSToolDeletes.index'));
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
            
            if($user_id == $jobTSToolDelete -> user_id || $isShared)
            {
                return view('job_t_s_tool_deletes.show')->with('jobTSToolDelete', $jobTSToolDelete);
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
            $jobTSToolDelete = $this->jobTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolDelete))
            {
                Flash::error('Job T S Tool Delete not found');
                return redirect(route('jobTSToolDeletes.index'));
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
            
            if($user_id == $jobTSToolDelete -> user_id || $isShared)
            {
                return view('job_t_s_tool_deletes.edit')->with('jobTSToolDelete', $jobTSToolDelete);
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

    public function update($id, UpdateJobTSToolDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolDelete = $this->jobTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolDelete))
            {
                Flash::error('Job T S Tool Delete not found');
                return redirect(route('jobTSToolDeletes.index'));
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
            
            if($user_id == $jobTSToolDelete -> user_id || $isShared)
            {
                $jobTSToolDelete = $this->jobTSToolDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool Delete updated successfully.');
                return redirect(route('jobTSToolDeletes.index'));
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
            $jobTSToolDelete = $this->jobTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolDelete))
            {
                Flash::error('Job T S Tool Delete not found');
                return redirect(route('jobTSToolDeletes.index'));
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
            
            if($user_id == $jobTSToolDelete -> user_id || $isShared)
            {
                $this->jobTSToolDeleteRepository->delete($id);
            
                Flash::success('Job T S Tool Delete deleted successfully.');
                return redirect(route('jobTSToolDeletes.index'));
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