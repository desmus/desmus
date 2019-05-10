<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSFileUpdateRequest;
use App\Http\Requests\UpdateJobTSFileUpdateRequest;
use App\Repositories\JobTSFileUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSFileUpdateController extends AppBaseController
{
    private $jobTSFileUpdateRepository;

    public function __construct(JobTSFileUpdateRepository $jobTSFileUpdateRepo)
    {
        $this->jobTSFileUpdateRepository = $jobTSFileUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSFileUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSFileUpdates = $this->jobTSFileUpdateRepository->all();
    
            return view('job_t_s_file_updates.index')
                ->with('jobTSFileUpdates', $jobTSFileUpdates);
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
            return view('job_t_s_file_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSFileUpdate = $this->jobTSFileUpdateRepository->create($input);
            
                Flash::success('Job T S File Update saved successfully.');
                return redirect(route('jobTSFileUpdates.index'));
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
            $jobTSFileUpdate = $this->jobTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileUpdate))
            {
                Flash::error('Job T S File Update not found');
                return redirect(route('jobTSFileUpdates.index'));
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
            
            if($user_id == $jobTSFileUpdate -> user_id || $isShared)
            {
                return view('job_t_s_file_updates.show')->with('jobTSFileUpdate', $jobTSFileUpdate);
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
            $jobTSFileUpdate = $this->jobTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileUpdate))
            {
                Flash::error('Job T S File Update not found');
                return redirect(route('jobTSFileUpdates.index'));
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
            
            if($user_id == $jobTSFileUpdate -> user_id || $isShared)
            {
                return view('job_t_s_file_updates.edit')->with('jobTSFileUpdate', $jobTSFileUpdate);
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

    public function update($id, UpdateJobTSFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSFileUpdate = $this->jobTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileUpdate))
            {
                Flash::error('Job T S File Update not found');
                return redirect(route('jobTSFileUpdates.index'));
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
            
            if($user_id == $jobTSFileUpdate -> user_id || $isShared)
            {
                $jobTSFileUpdate = $this->jobTSFileUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S File Update updated successfully.');
                return redirect(route('jobTSFileUpdates.index'));
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
            $jobTSFileUpdate = $this->jobTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSFileUpdate))
            {
                Flash::error('Job T S File Update not found');
                return redirect(route('jobTSFileUpdates.index'));
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
            
            if($user_id == $jobTSFileUpdate -> user_id || $isShared)
            {
                $this->jobTSFileUpdateRepository->delete($id);
            
                Flash::success('Job T S File Update deleted successfully.');
                return redirect(route('jobTSFileUpdates.index'));
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