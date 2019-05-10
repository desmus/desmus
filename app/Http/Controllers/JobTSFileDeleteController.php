<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\DeleteJobTSFileDeleteRequest;
use App\Http\Requests\UpdateJobTSFileDeleteRequest;
use App\Repositories\JobTSFileDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSFileDeleteController extends AppBaseController
{
    private $jobTSFileDeleteRepository;

    public function __construct(JobTSFileDeleteRepository $jobTSFileDeleteRepo)
    {
        $this->jobTSFileDeleteRepository = $jobTSFileDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSFileDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSFileDeletes = $this->jobTSFileDeleteRepository->all();
    
            return view('job_t_s_file_deletes.index')
                ->with('jobTSFileDeletes', $jobTSFileDeletes);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function delete()
    {
        if(Auth::user() != null)
        {
            return view('job_t_s_file_deletes.delete');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeleteJobTSFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSFileDelete = $this->jobTSFileDeleteRepository->delete($input);
            
                Flash::success('Job T S File Delete saved successfully.');
                return redirect(route('jobTSFileDeletes.index'));
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
            $jobTSFileDelete = $this->jobTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSFileDelete))
            {
                Flash::error('Job T S File Delete not found');
                return redirect(route('jobTSFileDeletes.index'));
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
            
            if($user_id == $jobTSFileDelete -> user_id || $isShared)
            {
                return view('job_t_s_file_deletes.show')->with('jobTSFileDelete', $jobTSFileDelete);
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
            $jobTSFileDelete = $this->jobTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSFileDelete))
            {
                Flash::error('Job T S File Delete not found');
                return redirect(route('jobTSFileDeletes.index'));
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
            
            if($user_id == $jobTSFileDelete -> user_id || $isShared)
            {
                return view('job_t_s_file_deletes.edit')->with('jobTSFileDelete', $jobTSFileDelete);
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

    public function update($id, UpdateJobTSFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSFileDelete = $this->jobTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSFileDelete))
            {
                Flash::error('Job T S File Delete not found');
                return redirect(route('jobTSFileDeletes.index'));
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
            
            if($user_id == $jobTSFileDelete -> user_id || $isShared)
            {
                $jobTSFileDelete = $this->jobTSFileDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S File Delete updated successfully.');
                return redirect(route('jobTSFileDeletes.index'));
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
            $jobTSFileDelete = $this->jobTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSFileDelete))
            {
                Flash::error('Job T S File Delete not found');
                return redirect(route('jobTSFileDeletes.index'));
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
            
            if($user_id == $jobTSFileDelete -> user_id || $isShared)
            {
                $this->jobTSFileDeleteRepository->delete($id);
            
                Flash::success('Job T S File Delete deleted successfully.');
                return redirect(route('jobTSFileDeletes.index'));
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