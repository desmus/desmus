<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicCreateRequest;
use App\Http\Requests\UpdateJobTopicCreateRequest;
use App\Repositories\JobTopicCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicCreateController extends AppBaseController
{
    private $jobTopicCreateRepository;

    public function __construct(JobTopicCreateRepository $jobTopicCreateRepo)
    {
        $this->jobTopicCreateRepository = $jobTopicCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicCreates = $this->jobTopicCreateRepository->all();
    
            return view('job_topic_creates.index')
                ->with('jobTopicCreates', $jobTopicCreates);
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
            return view('job_topic_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTopicCreate = $this->jobTopicCreateRepository->create($input);
            
                Flash::success('Job Topic Create saved successfully.');
                return redirect(route('jobTopicCreates.index'));
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
            $jobTopicCreate = $this->jobTopicCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicCreate))
            {
                Flash::error('Job Topic Create not found');
                return redirect(route('jobTopicCreates.index'));
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
            
            if($user_id == $jobTopicCreate -> user_id || $isShared)
            {
                return view('job_topic_creates.show')->with('jobTopicCreate', $jobTopicCreate);
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
            $jobTopicCreate = $this->jobTopicCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicCreate))
            {
                Flash::error('Job Topic Create not found');
                return redirect(route('jobTopicCreates.index'));
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
            
            if($user_id == $jobTopicCreate -> user_id || $isShared)
            {
                return view('job_topic_creates.edit')->with('jobTopicCreate', $jobTopicCreate);
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

    public function update($id, UpdateJobTopicCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicCreate = $this->jobTopicCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicCreate))
            {
                Flash::error('Job Topic Create not found');
                return redirect(route('jobTopicCreates.index'));
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
    
            if($user_id == $jobTopicCreate -> user_id || $isShared)
            {
                $jobTopicCreate = $this->jobTopicCreateRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Create updated successfully.');
                return redirect(route('jobTopicCreates.index'));
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
            $jobTopicCreate = $this->jobTopicCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicCreate))
            {
                Flash::error('Job Topic Create not found');
                return redirect(route('jobTopicCreates.index'));
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
    
            if($user_id == $jobTopicCreate -> user_id || $isShared)
            {
                $this->jobTopicCreateRepository->delete($id);
            
                Flash::success('Job Topic Create deleted successfully.');
                return redirect(route('jobTopicCreates.index'));
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