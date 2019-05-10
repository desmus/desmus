<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSFileCreateRequest;
use App\Http\Requests\UpdateJobTSFileCreateRequest;
use App\Repositories\JobTSFileCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSFileCreateController extends AppBaseController
{
    private $jobTSFileCreateRepository;

    public function __construct(JobTSFileCreateRepository $jobTSFileCreateRepo)
    {
        $this->jobTSFileCreateRepository = $jobTSFileCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSFileCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSFileCreates = $this->jobTSFileCreateRepository->all();
    
            return view('job_t_s_file_creates.index')
                ->with('jobTSFileCreates', $jobTSFileCreates);
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
            return view('job_t_s_file_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSFileCreate = $this->jobTSFileCreateRepository->create($input);
                
                Flash::success('Job T S File Create saved successfully.');
                return redirect(route('jobTSFileCreates.index'));
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
            $jobTSFileCreate = $this->jobTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileCreate))
            {
                Flash::error('Job T S File Create not found');
                return redirect(route('jobTSFileCreates.index'));
            }
    
            $userJobTSFiles = DB::table('user_job_t_s_files')->where('job_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSFiles as $userJobTSFile)
            {
                if($userJobTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_files')->join('job_topic_sections', 'job_t_s_files.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_files.id', '=', $id)->get();
            
            if($user_id == $jobTSFileCreate -> user_id || $isShared)
            {
                return view('job_t_s_file_creates.show')->with('jobTSFileCreate', $jobTSFileCreate);
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
            $jobTSFileCreate = $this->jobTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileCreate))
            {
                Flash::error('Job T S File Create not found');
                return redirect(route('jobTSFileCreates.index'));
            }
            
            $userJobTSFiles = DB::table('user_job_t_s_files')->where('job_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSFiles as $userJobTSFile)
            {
                if($userJobTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_files')->join('job_topic_sections', 'job_t_s_files.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_files.id', '=', $id)->get();
            
            if($user_id == $jobTSFileCreate -> user_id || $isShared)
            {
                return view('job_t_s_file_creates.edit')->with('jobTSFileCreate', $jobTSFileCreate);
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

    public function update($id, UpdateJobTSFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSFileCreate = $this->jobTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileCreate))
            {
                Flash::error('Job T S File Create not found');
                return redirect(route('jobTSFileCreates.index'));
            }
    
            $userJobTSFiles = DB::table('user_job_t_s_files')->where('job_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSFiles as $userJobTSFile)
            {
                if($userJobTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_files')->join('job_topic_sections', 'job_t_s_files.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_files.id', '=', $id)->get();
            
            if($user_id == $jobTSFileCreate -> user_id || $isShared)
            {
                $jobTSFileCreate = $this->jobTSFileCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S File Create updated successfully.');
                return redirect(route('jobTSFileCreates.index'));
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
            $jobTSFileCreate = $this->jobTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileCreate))
            {
                Flash::error('Job T S File Create not found');
                return redirect(route('jobTSFileCreates.index'));
            }
            
            $userJobTSFiles = DB::table('user_job_t_s_files')->where('job_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSFiles as $userJobTSFile)
            {
                if($userJobTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_files')->join('job_topic_sections', 'job_t_s_files.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_files.id', '=', $id)->get();
            
            if($user_id == $jobTSFileCreate -> user_id || $isShared)
            {
                $this->jobTSFileCreateRepository->delete($id);
            
                Flash::success('Job T S File Create deleted successfully.');
                return redirect(route('jobTSFileCreates.index'));
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