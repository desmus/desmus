<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryUpdateRequest;
use App\Http\Requests\UpdateJobTSGaleryUpdateRequest;
use App\Repositories\JobTSGaleryUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryUpdateController extends AppBaseController
{
    private $jobTSGaleryUpdateRepository;

    public function __construct(JobTSGaleryUpdateRepository $jobTSGaleryUpdateRepo)
    {
        $this->jobTSGaleryUpdateRepository = $jobTSGaleryUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryUpdates = $this->jobTSGaleryUpdateRepository->all();
    
            return view('job_t_s_galery_updates.index')
                ->with('jobTSGaleryUpdates', $jobTSGaleryUpdates);
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
            return view('job_t_s_galery_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSGaleryUpdate = $this->jobTSGaleryUpdateRepository->create($input);
            
                Flash::success('Job T S Galery Update saved successfully.');
                return redirect(route('jobTSGaleryUpdates.index'));
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
            $jobTSGaleryUpdate = $this->jobTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryUpdate))
            {
                Flash::error('Job T S Galery Update not found');
                return redirect(route('jobTSGaleryUpdates.index'));
            }
            
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleries as $userJobTSGalerie)
            {
                if($userJobTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryUpdate -> user_id || $isShared)
            {
                return view('job_t_s_galery_updates.show')->with('jobTSGaleryUpdate', $jobTSGaleryUpdate);
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
            $jobTSGaleryUpdate = $this->jobTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryUpdate))
            {
                Flash::error('Job T S Galery Update not found');
                return redirect(route('jobTSGaleryUpdates.index'));
            }
    
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleries as $userJobTSGalerie)
            {
                if($userJobTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryUpdate -> user_id || $isShared)
            {
                return view('job_t_s_galery_updates.edit')->with('jobTSGaleryUpdate', $jobTSGaleryUpdate);
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

    public function update($id, UpdateJobTSGaleryUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryUpdate = $this->jobTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryUpdate))
            {
                Flash::error('Job T S Galery Update not found');
                return redirect(route('jobTSGaleryUpdates.index'));
            }
    
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleries as $userJobTSGalerie)
            {
                if($userJobTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryUpdate -> user_id || $isShared)
            {
                $jobTSGaleryUpdate = $this->jobTSGaleryUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery Update updated successfully.');
                return redirect(route('jobTSGaleryUpdates.index'));
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
            $jobTSGaleryUpdate = $this->jobTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryUpdate))
            {
                Flash::error('Job T S Galery Update not found');
                return redirect(route('jobTSGaleryUpdates.index'));
            }
            
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleries as $userJobTSGalerie)
            {
                if($userJobTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $jobTSGaleryUpdate -> user_id || $isShared)
            {
                $this->jobTSGaleryUpdateRepository->delete($id);
            
                Flash::success('Job T S Galery Update deleted successfully.');
                return redirect(route('jobTSGaleryUpdates.index'));
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