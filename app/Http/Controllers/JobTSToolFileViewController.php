<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolFileViewRequest;
use App\Http\Requests\UpdateJobTSToolFileViewRequest;
use App\Repositories\JobTSToolFileViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolFileViewController extends AppBaseController
{
    private $jobTSToolFileViewRepository;

    public function __construct(JobTSToolFileViewRepository $jobTSToolFileViewRepo)
    {
        $this->jobTSToolFileViewRepository = $jobTSToolFileViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolFileViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolFileViews = $this->jobTSToolFileViewRepository->all();
    
            return view('job_t_s_tool_file_views.index')
                ->with('jobTSToolFileViews', $jobTSToolFileViews);
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
            return view('job_t_s_tool_file_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSToolFileView = $this->jobTSToolFileViewRepository->create($input);
            
                Flash::success('Job T S Tool File View saved successfully.');
                return redirect(route('jobTSToolFileViews.index'));
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
            $jobTSToolFileView = $this->jobTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileView))
            {
                Flash::error('Job T S Tool File View not found');
                return redirect(route('jobTSToolFileViews.index'));
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
            
            if($user_id == $jobTSToolFileView -> user_id || $isShared)
            {
                return view('job_t_s_tool_file_views.show')->with('jobTSToolFileView', $jobTSToolFileView);
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
            $jobTSToolFileView = $this->jobTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileView))
            {
                Flash::error('Job T S Tool File View not found');
                return redirect(route('jobTSToolFileViews.index'));
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
            
            if($user_id == $jobTSToolFileView -> user_id || $isShared)
            {
                return view('job_t_s_tool_file_views.edit')->with('jobTSToolFileView', $jobTSToolFileView);
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

    public function update($id, UpdateJobTSToolFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolFileView = $this->jobTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileView))
            {
                Flash::error('Job T S Tool File View not found');
                return redirect(route('jobTSToolFileViews.index'));
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
            
            if($user_id == $jobTSToolFileView -> user_id || $isShared)
            {
                $jobTSToolFileView = $this->jobTSToolFileViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool File View updated successfully.');
                return redirect(route('jobTSToolFileViews.index'));
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
            $jobTSToolFileView = $this->jobTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileView))
            {
                Flash::error('Job T S Tool File View not found');
                return redirect(route('jobTSToolFileViews.index'));
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
            
            if($user_id == $jobTSToolFileView -> user_id || $isShared)
            {
                $this->jobTSToolFileViewRepository->delete($id);
            
                Flash::success('Job T S Tool File View deleted successfully.');
                return redirect(route('jobTSToolFileViews.index'));
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