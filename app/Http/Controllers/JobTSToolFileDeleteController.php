<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolFileDeleteRequest;
use App\Http\Requests\UpdateJobTSToolFileDeleteRequest;
use App\Repositories\JobTSToolFileDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolFileDeleteController extends AppBaseController
{
    private $jobTSToolFileDeleteRepository;

    public function __construct(JobTSToolFileDeleteRepository $jobTSToolFileDeleteRepo)
    {
        $this->jobTSToolFileDeleteRepository = $jobTSToolFileDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolFileDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolFileDeletes = $this->jobTSToolFileDeleteRepository->all();
    
            return view('job_t_s_tool_file_deletes.index')
                ->with('jobTSToolFileDeletes', $jobTSToolFileDeletes);
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
            return view('job_t_s_tool_file_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSToolFileDelete = $this->jobTSToolFileDeleteRepository->create($input);
            
                Flash::success('Job T S Tool File Delete saved successfully.');
                return redirect(route('jobTSToolFileDeletes.index'));
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
            $jobTSToolFileDelete = $this->jobTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileDelete))
            {
                Flash::error('Job T S Tool File Delete not found');
                return redirect(route('jobTSToolFileDeletes.index'));
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
            
            if($user_id == $jobTSToolFileDelete -> user_id || $isShared)
            {
                return view('job_t_s_tool_file_deletes.show')->with('jobTSToolFileDelete', $jobTSToolFileDelete);
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
            $jobTSToolFileDelete = $this->jobTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileDelete))
            {
                Flash::error('Job T S Tool File Delete not found');
                return redirect(route('jobTSToolFileDeletes.index'));
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
            
            if($user_id == $jobTSToolFileDelete -> user_id || $isShared)
            {
                return view('job_t_s_tool_file_deletes.edit')->with('jobTSToolFileDelete', $jobTSToolFileDelete);
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

    public function update($id, UpdateJobTSToolFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolFileDelete = $this->jobTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileDelete))
            {
                Flash::error('Job T S Tool File Delete not found');
                return redirect(route('jobTSToolFileDeletes.index'));
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
            
            if($user_id == $jobTSToolFileDelete -> user_id || $isShared)
            {
                $jobTSToolFileDelete = $this->jobTSToolFileDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool File Delete updated successfully.');
                return redirect(route('jobTSToolFileDeletes.index'));
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
            $jobTSToolFileDelete = $this->jobTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileDelete))
            {
                Flash::error('Job T S Tool File Delete not found');
                return redirect(route('jobTSToolFileDeletes.index'));
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
            
            if($user_id == $jobTSToolFileDelete -> user_id || $isShared)
            {
                $this->jobTSToolFileDeleteRepository->delete($id);
            
                Flash::success('Job T S Tool File Delete deleted successfully.');
                return redirect(route('jobTSToolFileDeletes.index'));
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