<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicDeleteRequest;
use App\Http\Requests\UpdateJobTopicDeleteRequest;
use App\Repositories\JobTopicDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicDeleteController extends AppBaseController
{
    private $jobTopicDeleteRepository;

    public function __construct(JobTopicDeleteRepository $jobTopicDeleteRepo)
    {
        $this->jobTopicDeleteRepository = $jobTopicDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicDeletes = $this->jobTopicDeleteRepository->all();
    
            return view('job_topic_deletes.index')
                ->with('jobTopicDeletes', $jobTopicDeletes);
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
            return view('job_topic_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTopicDelete = $this->jobTopicDeleteRepository->create($input);
            
                Flash::success('Job Topic Delete saved successfully.');
                return redirect(route('jobTopicDeletes.index'));
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
            $jobTopicDelete = $this->jobTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicDelete))
            {
                Flash::error('Job Topic Delete not found');
                return redirect(route('jobTopicDeletes.index'));
            }
            
            $userJobTopics = DB::table('user_job_topics')->where('job_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTopics as $userJobTopic)
            {
                if($userJobTopic -> user_id == $user_id && $userJob -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $jobTopicDelete -> user_id || $isShared)
            {
                return view('job_topic_deletes.show')->with('jobTopicDelete', $jobTopicDelete);
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
            $jobTopicDelete = $this->jobTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicDelete))
            {
                Flash::error('Job Topic Delete not found');
                return redirect(route('jobTopicDeletes.index'));
            }
            
            $userJobTopics = DB::table('user_job_topics')->where('job_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTopics as $userJobTopic)
            {
                if($userJobTopic -> user_id == $user_id && $userJob -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $jobTopicDelete -> user_id || $isShared)
            {
                return view('job_topic_deletes.edit')->with('jobTopicDelete', $jobTopicDelete);
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

    public function update($id, UpdateJobTopicDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicDelete = $this->jobTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicDelete))
            {
                Flash::error('Job Topic Delete not found');
                return redirect(route('jobTopicDeletes.index'));
            }
            
            $userJobTopics = DB::table('user_job_topics')->where('job_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTopics as $userJobTopic)
            {
                if($userJobTopic -> user_id == $user_id && $userJob -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $jobTopicDelete -> user_id || $isShared)
            {
                $jobTopicDelete = $this->jobTopicDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Delete updated successfully.');
                return redirect(route('jobTopicDeletes.index'));
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
            $jobTopicDelete = $this->jobTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicDelete))
            {
                Flash::error('Job Topic Delete not found');
                return redirect(route('jobTopicDeletes.index'));
            }
            
            $userJobTopics = DB::table('user_job_topics')->where('job_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTopics as $userJobTopic)
            {
                if($userJobTopic -> user_id == $user_id && $userJob -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $jobTopicDelete -> user_id || $isShared)
            {
                $this->jobTopicDeleteRepository->delete($id);
            
                Flash::success('Job Topic Delete deleted successfully.');
                return redirect(route('jobTopicDeletes.index'));
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