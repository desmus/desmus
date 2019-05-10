<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolFileCreateRequest;
use App\Http\Requests\UpdateJobTSToolFileCreateRequest;
use App\Repositories\JobTSToolFileCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolFileCreateController extends AppBaseController
{
    private $jobTSToolFileCreateRepository;

    public function __construct(JobTSToolFileCreateRepository $jobTSToolFileCreateRepo)
    {
        $this->jobTSToolFileCreateRepository = $jobTSToolFileCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolFileCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolFileCreates = $this->jobTSToolFileCreateRepository->all();
    
            return view('job_t_s_tool_file_creates.index')
                ->with('jobTSToolFileCreates', $jobTSToolFileCreates);
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
            return view('job_t_s_tool_file_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSToolFileCreate = $this->jobTSToolFileCreateRepository->create($input);
            
                Flash::success('Job T S Tool File Create saved successfully.');
                return redirect(route('jobTSToolFileCreates.index'));
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
            $jobTSToolFileCreate = $this->jobTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileCreate))
            {
                Flash::error('Job T S Tool File Create not found');
                return redirect(route('jobTSToolFileCreates.index'));
            }
            
            $userJobTSToolFiles = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSToolFiles as $userJobTSToolFile)
            {
                if($userJobTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tool_files')->join('job_t_s_tools', 'job_t_s_tool_files.job_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $jobTSToolFileCreate -> user_id || $isShared)
            {
                return view('job_t_s_tool_file_creates.show')->with('jobTSToolFileCreate', $jobTSToolFileCreate);
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
            $jobTSToolFileCreate = $this->jobTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileCreate))
            {
                Flash::error('Job T S Tool File Create not found');
                return redirect(route('jobTSToolFileCreates.index'));
            }
    
            $userJobTSToolFiles = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSToolFiles as $userJobTSToolFile)
            {
                if($userJobTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tool_files')->join('job_t_s_tools', 'job_t_s_tool_files.job_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $jobTSToolFileCreate -> user_id || $isShared)
            {
                return view('job_t_s_tool_file_creates.edit')->with('jobTSToolFileCreate', $jobTSToolFileCreate);
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

    public function update($id, UpdateJobTSToolFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolFileCreate = $this->jobTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileCreate))
            {
                Flash::error('Job T S Tool File Create not found');
                return redirect(route('jobTSToolFileCreates.index'));
            }
            
            $userJobTSToolFiles = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSToolFiles as $userJobTSToolFile)
            {
                if($userJobTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tool_files')->join('job_t_s_tools', 'job_t_s_tool_files.job_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $jobTSToolFileCreate -> user_id || $isShared)
            {
                $jobTSToolFileCreate = $this->jobTSToolFileCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool File Create updated successfully.');
                return redirect(route('jobTSToolFileCreates.index'));
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
            $jobTSToolFileCreate = $this->jobTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileCreate))
            {
                Flash::error('Job T S Tool File Create not found');
                return redirect(route('jobTSToolFileCreates.index'));
            }
            
            $userJobTSToolFiles = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSToolFiles as $userJobTSToolFile)
            {
                if($userJobTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tool_files')->join('job_t_s_tools', 'job_t_s_tool_files.job_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $jobTSToolFileCreate -> user_id || $isShared)
            {
                $this->jobTSToolFileCreateRepository->delete($id);
            
                Flash::success('Job T S Tool File Create deleted successfully.');
                return redirect(route('jobTSToolFileCreates.index'));
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