<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSFileViewRequest;
use App\Http\Requests\UpdateJobTSFileViewRequest;
use App\Repositories\JobTSFileViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSFileViewController extends AppBaseController
{
    private $jobTSFileViewRepository;

    public function __construct(JobTSFileViewRepository $jobTSFileViewRepo)
    {
        $this->jobTSFileViewRepository = $jobTSFileViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSFileViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSFileViews = $this->jobTSFileViewRepository->all();
    
            return view('job_t_s_file_views.index')
                ->with('jobTSFileViews', $jobTSFileViews);
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
            return view('job_t_s_file_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSFileView = $this->jobTSFileViewRepository->create($input);
            
                Flash::success('Job T S File View saved successfully.');
                return redirect(route('jobTSFileViews.index'));
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
            $jobTSFileView = $this->jobTSFileViewRepository->findWithoutFail($id);
    
            if(empty($jobTSFileView))
            {
                Flash::error('Job T S File View not found');
                return redirect(route('jobTSFileViews.index'));
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
            
            if($user_id == $jobTSFileView -> user_id || $isShared)
            {
                return view('job_t_s_file_views.show')->with('jobTSFileView', $jobTSFileView);
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
            $jobTSFileView = $this->jobTSFileViewRepository->findWithoutFail($id);
    
            if(empty($jobTSFileView))
            {
                Flash::error('Job T S File View not found');
                return redirect(route('jobTSFileViews.index'));
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
            
            if($user_id == $jobTSFileView -> user_id || $isShared)
            {
                return view('job_t_s_file_views.edit')->with('jobTSFileView', $jobTSFileView);
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

    public function update($id, UpdateJobTSFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSFileView = $this->jobTSFileViewRepository->findWithoutFail($id);
    
            if(empty($jobTSFileView))
            {
                Flash::error('Job T S File View not found');
                return redirect(route('jobTSFileViews.index'));
            }
            
            if($user_id == $jobTSFileView -> user_id || $isShared)
            {
                $jobTSFileView = $this->jobTSFileViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S File View updated successfully.');
                return redirect(route('jobTSFileViews.index'));
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
            $jobTSFileView = $this->jobTSFileViewRepository->findWithoutFail($id);
    
            if(empty($jobTSFileView))
            {
                Flash::error('Job T S File View not found');
                return redirect(route('jobTSFileViews.index'));
            }
    
            if($user_id == $jobTSFileView -> user_id || $isShared)
            {
                $this->jobTSFileViewRepository->delete($id);
            
                Flash::success('Job T S File View deleted successfully.');
                return redirect(route('jobTSFileViews.index'));
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