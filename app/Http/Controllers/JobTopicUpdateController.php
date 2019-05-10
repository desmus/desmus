<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicUpdateRequest;
use App\Http\Requests\UpdateJobTopicUpdateRequest;
use App\Repositories\JobTopicUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicUpdateController extends AppBaseController
{
    private $jobTopicUpdateRepository;

    public function __construct(JobTopicUpdateRepository $jobTopicUpdateRepo)
    {
        $this->jobTopicUpdateRepository = $jobTopicUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicUpdates = $this->jobTopicUpdateRepository->all();
    
            return view('job_topic_updates.index')
                ->with('jobTopicUpdates', $jobTopicUpdates);
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
            return view('job_topic_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTopicUpdate = $this->jobTopicUpdateRepository->create($input);
            
                Flash::success('Job Topic Update saved successfully.');
                return redirect(route('jobTopicUpdates.index'));
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
            $jobTopicUpdate = $this->jobTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicUpdate))
            {
                Flash::error('Job Topic Update not found');
                return redirect(route('jobTopicUpdates.index'));
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
            
            if($user_id == $jobTopicUpdate -> user_id || $isShared)
            {
                return view('job_topic_updates.show')
                    ->with('jobTopicUpdate', $jobTopicUpdate);
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
            $jobTopicUpdate = $this->jobTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicUpdate))
            {
                Flash::error('Job Topic Update not found');
                return redirect(route('jobTopicUpdates.index'));
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
            
            if($user_id == $jobTopicUpdate -> user_id || $isShared)
            {
                return view('job_topic_updates.edit')
                    ->with('jobTopicUpdate', $jobTopicUpdate);
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

    public function update($id, UpdateJobTopicUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicUpdate = $this->jobTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicUpdate))
            {
                Flash::error('Job Topic Update not found');
                return redirect(route('jobTopicUpdates.index'));
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
            
            if($user_id == $jobTopicUpdate -> user_id || $isShared)
            {
                $jobTopicUpdate = $this->jobTopicUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Update updated successfully.');
                return redirect(route('jobTopicUpdates.index'));
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
            $jobTopicUpdate = $this->jobTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicUpdate))
            {
                Flash::error('Job Topic Update not found');
                return redirect(route('jobTopicUpdates.index'));
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
            
            if($user_id == $jobTopicUpdate -> user_id || $isShared)
            {
                $this->jobTopicUpdateRepository->delete($id);
            
                Flash::success('Job Topic Update deleted successfully.');
                return redirect(route('jobTopicUpdates.index'));
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