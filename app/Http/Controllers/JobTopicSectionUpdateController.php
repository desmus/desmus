<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicSectionUpdateRequest;
use App\Http\Requests\UpdateJobTopicSectionUpdateRequest;
use App\Repositories\JobTopicSectionUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicSectionUpdateController extends AppBaseController
{
    private $jobTopicSectionUpdateRepository;

    public function __construct(JobTopicSectionUpdateRepository $jobTopicSectionUpdateRepo)
    {
        $this->jobTopicSectionUpdateRepository = $jobTopicSectionUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicSectionUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicSectionUpdates = $this->jobTopicSectionUpdateRepository->all();
    
            return view('job_topic_section_updates.index')
                ->with('jobTopicSectionUpdates', $jobTopicSectionUpdates);
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
            return view('job_topic_section_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicSectionUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTopicSectionUpdate = $this->jobTopicSectionUpdateRepository->create($input);
            
                Flash::success('Job Topic Section Update saved successfully.');
                return redirect(route('jobTopicSectionUpdates.index'));
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
            $jobTopicSectionUpdate = $this->jobTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionUpdate))
            {
                Flash::error('Job Topic Section Update not found');
                return redirect(route('jobTopicSectionUpdates.index'));
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
            
            if($user_id == $jobTopicSectionUpdate -> user_id || $isShared)
            {
                return view('job_topic_section_updates.show')
                    ->with('jobTopicSectionUpdate', $jobTopicSectionUpdate);
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
            $jobTopicSectionUpdate = $this->jobTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionUpdate))
            {
                Flash::error('Job Topic Section Update not found');
                return redirect(route('jobTopicSectionUpdates.index'));
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
            
            if($user_id == $jobTopicSectionUpdate -> user_id || $isShared)
            {
                return view('job_topic_section_updates.edit')
                    ->with('jobTopicSectionUpdate', $jobTopicSectionUpdate);
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

    public function update($id, UpdateJobTopicSectionUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicSectionUpdate = $this->jobTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionUpdate))
            {
                Flash::error('Job Topic Section Update not found');
                return redirect(route('jobTopicSectionUpdates.index'));
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
            
            if($user_id == $jobTopicSectionUpdate -> user_id || $isShared)
            {
                $jobTopicSectionUpdate = $this->jobTopicSectionUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Section Update updated successfully.');
                return redirect(route('jobTopicSectionUpdates.index'));
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
            $jobTopicSectionUpdate = $this->jobTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionUpdate))
            {
                Flash::error('Job Topic Section Update not found');
                return redirect(route('jobTopicSectionUpdates.index'));
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
            
            if($user_id == $jobTopicSectionUpdate -> user_id || $isShared)
            {
                $this->jobTopicSectionUpdateRepository->delete($id);
            
                Flash::success('Job Topic Section Update deleted successfully.');
                return redirect(route('jobTopicSectionUpdates.index'));
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