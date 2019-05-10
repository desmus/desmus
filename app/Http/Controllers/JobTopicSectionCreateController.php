<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicSectionCreateRequest;
use App\Http\Requests\UpdateJobTopicSectionCreateRequest;
use App\Repositories\JobTopicSectionCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicSectionCreateController extends AppBaseController
{
    private $jobTopicSectionCreateRepository;

    public function __construct(JobTopicSectionCreateRepository $jobTopicSectionCreateRepo)
    {
        $this->jobTopicSectionCreateRepository = $jobTopicSectionCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicSectionCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicSectionCreates = $this->jobTopicSectionCreateRepository->all();
    
            return view('job_topic_section_creates.index')
                ->with('jobTopicSectionCreates', $jobTopicSectionCreates);
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
            return view('job_topic_section_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicSectionCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTopicSectionCreate = $this->jobTopicSectionCreateRepository->create($input);
            
                Flash::success('Job Topic Section Create saved successfully.');
                return redirect(route('jobTopicSectionCreates.index'));
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
            $jobTopicSectionCreate = $this->jobTopicSectionCreateRepository->findWithoutFail($id);
    
            if (empty($jobTopicSectionCreate))
            {
                Flash::error('Job Topic Section Create not found');
                return redirect(route('jobTopicSectionCreates.index'));
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
            
            if($user_id == $jobTopicSectionCreate -> user_id || $isShared)
            {
                return view('job_topic_section_creates.show')
                    ->with('jobTopicSectionCreate', $jobTopicSectionCreate);
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
            $jobTopicSectionCreate = $this->jobTopicSectionCreateRepository->findWithoutFail($id);
    
            if (empty($jobTopicSectionCreate))
            {
                Flash::error('Job Topic Section Create not found');
                return redirect(route('jobTopicSectionCreates.index'));
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
            
            if($user_id == $jobTopicSectionCreate -> user_id || $isShared)
            {
                return view('job_topic_section_creates.edit')
                    ->with('jobTopicSectionCreate', $jobTopicSectionCreate);
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

    public function update($id, UpdateJobTopicSectionCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicSectionCreate = $this->jobTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionCreate))
            {
                Flash::error('Job Topic Section Create not found');
                return redirect(route('jobTopicSectionCreates.index'));
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
            
            if($user_id == $jobTopicSectionCreate -> user_id || $isShared)
            {
                $jobTopicSectionCreate = $this->jobTopicSectionCreateRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Section Create updated successfully.');
                return redirect(route('jobTopicSectionCreates.index'));
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
            $jobTopicSectionCreate = $this->jobTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionCreate))
            {
                Flash::error('Job Topic Section Create not found');
                return redirect(route('jobTopicSectionCreates.index'));
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
            
            if($user_id == $jobTopicSectionCreate -> user_id || $isShared)
            {
                $this->jobTopicSectionCreateRepository->delete($id);
            
                Flash::success('Job Topic Section Create deleted successfully.');
                return redirect(route('jobTopicSectionCreates.index'));
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