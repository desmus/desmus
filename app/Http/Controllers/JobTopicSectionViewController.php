<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicSectionViewRequest;
use App\Http\Requests\UpdateJobTopicSectionViewRequest;
use App\Repositories\JobTopicSectionViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicSectionViewController extends AppBaseController
{
    private $jobTopicSectionViewRepository;

    public function __construct(JobTopicSectionViewRepository $jobTopicSectionViewRepo)
    {
        $this->jobTopicSectionViewRepository = $jobTopicSectionViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicSectionViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicSectionViews = $this->jobTopicSectionViewRepository->all();
    
            return view('job_topic_section_views.index')
                ->with('jobTopicSectionViews', $jobTopicSectionViews);
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
            return view('job_topic_section_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicSectionViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTopicSectionView = $this->jobTopicSectionViewRepository->create($input);
            
                Flash::success('Job Topic Section View saved successfully.');
                return redirect(route('jobTopicSectionViews.index'));
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
            $jobTopicSectionView = $this->jobTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionView))
            {
                Flash::error('Job Topic Section View not found');
                return redirect(route('jobTopicSectionViews.index'));
            }
            
            $userJobTopicSections = DB::table('user_job_topic_sections')->where('job_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTopicSections as $userJobTopicSection)
            {
                if($userJobTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_topic_sections.id', '=', $id)->get();
            
            if($user_id == $jobTopicSectionView -> user_id || $isShared)
            {
                return view('job_topic_section_views.show')->with('jobTopicSectionView', $jobTopicSectionView);
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
            $jobTopicSectionView = $this->jobTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionView))
            {
                Flash::error('Job Topic Section View not found');
                return redirect(route('jobTopicSectionViews.index'));
            }
            
            $userJobTopicSections = DB::table('user_job_topic_sections')->where('job_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTopicSections as $userJobTopicSection)
            {
                if($userJobTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_topic_sections.id', '=', $id)->get();
            
            if($user_id == $jobTopicSectionView -> user_id || $isShared)
            {
                return view('job_topic_section_views.edit')->with('jobTopicSectionView', $jobTopicSectionView);
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

    public function update($id, UpdateJobTopicSectionViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicSectionView = $this->jobTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionView))
            {
                Flash::error('Job Topic Section View not found');
                return redirect(route('jobTopicSectionViews.index'));
            }
            
            $userJobTopicSections = DB::table('user_job_topic_sections')->where('job_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTopicSections as $userJobTopicSection)
            {
                if($userJobTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_topic_sections.id', '=', $id)->get();
            
            if($user_id == $jobTopicSectionView -> user_id || $isShared)
            {
                $jobTopicSectionView = $this->jobTopicSectionViewRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Section View updated successfully.');
                return redirect(route('jobTopicSectionViews.index'));
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
            $jobTopicSectionView = $this->jobTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionView))
            {
                Flash::error('Job Topic Section View not found');
                return redirect(route('jobTopicSectionViews.index'));
            }
            
            $userJobTopicSections = DB::table('user_job_topic_sections')->where('job_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTopicSections as $userJobTopicSection)
            {
                if($userJobTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_topic_sections.id', '=', $id)->get();
            
            if($user_id == $jobTopicSectionView -> user_id || $isShared)
            {
                $this->jobTopicSectionViewRepository->delete($id);
            
                Flash::success('Job Topic Section View deleted successfully.');
                return redirect(route('jobTopicSectionViews.index'));
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