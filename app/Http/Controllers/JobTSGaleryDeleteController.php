<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryDeleteRequest;
use App\Http\Requests\UpdateJobTSGaleryDeleteRequest;
use App\Repositories\JobTSGaleryDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryDeleteController extends AppBaseController
{
    private $jobTSGaleryDeleteRepository;

    public function __construct(JobTSGaleryDeleteRepository $jobTSGaleryDeleteRepo)
    {
        $this->jobTSGaleryDeleteRepository = $jobTSGaleryDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGaleryDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryDeletes = $this->jobTSGaleryDeleteRepository->all();
    
            return view('job_t_s_galery_deletes.index')
                ->with('jobTSGaleryDeletes', $jobTSGaleryDeletes);
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
            return view('job_t_s_galery_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSGaleryDelete = $this->jobTSGaleryDeleteRepository->create($input);
            
                Flash::success('Job T S Galery Delete saved successfully.');
                return redirect(route('jobTSGaleryDeletes.index'));
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
            $jobTSGaleryDelete = $this->jobTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryDelete))
            {
                Flash::error('Job T S Galery Delete not found');
                return redirect(route('jobTSGaleryDeletes.index'));
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
            
            if($user_id == $jobTSGaleryDelete -> user_id || $isShared)
            {
                return view('job_t_s_galery_deletes.show')->with('jobTSGaleryDelete', $jobTSGaleryDelete);
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
            $jobTSGaleryDelete = $this->jobTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryDelete))
            {
                Flash::error('Job T S Galery Delete not found');
                return redirect(route('jobTSGaleryDeletes.index'));
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
            
            if($user_id == $jobTSGaleryDelete -> user_id || $isShared)
            {
                return view('job_t_s_galery_deletes.edit')->with('jobTSGaleryDelete', $jobTSGaleryDelete);
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

    public function update($id, UpdateJobTSGaleryDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSGaleryDelete = $this->jobTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryDelete))
            {
                Flash::error('Job T S Galery Delete not found');
                return redirect(route('jobTSGaleryDeletes.index'));
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
            
            if($user_id == $jobTSGaleryDelete -> user_id || $isShared)
            {
                $jobTSGaleryDelete = $this->jobTSGaleryDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S Galery Delete updated successfully.');
                return redirect(route('jobTSGaleryDeletes.index'));
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
            $jobTSGaleryDelete = $this->jobTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryDelete)) 
            {
                Flash::error('Job T S Galery Delete not found');
                return redirect(route('jobTSGaleryDeletes.index'));
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
            
            if($user_id == $jobTSGaleryDelete -> user_id || $isShared)
            {
                $this->jobTSGaleryDeleteRepository->delete($id);
            
                Flash::success('Job T S Galery Delete deleted successfully.');
                return redirect(route('jobTSGaleryDeletes.index'));
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