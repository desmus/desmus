<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicViewRequest;
use App\Http\Requests\UpdateJobTopicViewRequest;
use App\Repositories\JobTopicViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicViewController extends AppBaseController
{
    private $jobTopicViewRepository;

    public function __construct(JobTopicViewRepository $jobTopicViewRepo)
    {
        $this->jobTopicViewRepository = $jobTopicViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicViews = $this->jobTopicViewRepository->all();
    
            return view('job_topic_views.index')
                ->with('jobTopicViews', $jobTopicViews);
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
            return view('job_topic_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTopicView = $this->jobTopicViewRepository->create($input);
            
                Flash::success('Job Topic View saved successfully.');
                return redirect(route('jobTopicViews.index'));
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
            $jobTopicView = $this->jobTopicViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicView))
            {
                Flash::error('Job Topic View not found');
                return redirect(route('jobTopicViews.index'));
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
            
            if($user_id == $jobTopicView -> user_id || $isShared)
            {
                return view('job_topic_views.show')
                    ->with('jobTopicView', $jobTopicView);
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
            $jobTopicView = $this->jobTopicViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicView))
            {
                Flash::error('Job Topic View not found');
                return redirect(route('jobTopicViews.index'));
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
            
            if($user_id == $jobTopicView -> user_id || $isShared)
            {
                return view('job_topic_views.edit')
                    ->with('jobTopicView', $jobTopicView);
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

    public function update($id, UpdateJobTopicViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicView = $this->jobTopicViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicView))
            {
                Flash::error('Job Topic View not found');
                return redirect(route('jobTopicViews.index'));
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
            
            if($user_id == $jobTopicView -> user_id || $isShared)
            {
                $jobTopicView = $this->jobTopicViewRepository->update($request->all(), $id);
            
                Flash::success('Job Topic View updated successfully.');
                return redirect(route('jobTopicViews.index'));
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
            $jobTopicView = $this->jobTopicViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicView))
            {
                Flash::error('Job Topic View not found');
                return redirect(route('jobTopicViews.index'));
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
            
            if($user_id == $jobTopicView -> user_id || $isShared)
            {
                $this->jobTopicViewRepository->delete($id);
            
                Flash::success('Job Topic View deleted successfully.');
                return redirect(route('jobTopicViews.index'));
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