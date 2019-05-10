<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicSectionDeleteRequest;
use App\Http\Requests\UpdateJobTopicSectionDeleteRequest;
use App\Repositories\JobTopicSectionDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicSectionDeleteController extends AppBaseController
{
    private $jobTopicSectionDeleteRepository;

    public function __construct(JobTopicSectionDeleteRepository $jobTopicSectionDeleteRepo)
    {
        $this->jobTopicSectionDeleteRepository = $jobTopicSectionDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicSectionDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicSectionDeletes = $this->jobTopicSectionDeleteRepository->all();
    
            return view('job_topic_section_deletes.index')
                ->with('jobTopicSectionDeletes', $jobTopicSectionDeletes);
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
            return view('job_topic_section_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicSectionDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTopicSectionDelete = $this->jobTopicSectionDeleteRepository->create($input);
            
                Flash::success('Job Topic Section Delete saved successfully.');
                return redirect(route('jobTopicSectionDeletes.index'));
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
            $jobTopicSectionDelete = $this->jobTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionDelete))
            {
                Flash::error('Job Topic Section Delete not found');
                return redirect(route('jobTopicSectionDeletes.index'));
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
            
            if($user_id == $jobTopicSectionDelete -> user_id || $isShared)
            {
                return view('job_topic_section_deletes.show')->with('jobTopicSectionDelete', $jobTopicSectionDelete);
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
            $jobTopicSectionDelete = $this->jobTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionDelete))
            {
                Flash::error('Job Topic Section Delete not found');
                return redirect(route('jobTopicSectionDeletes.index'));
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
            
            if($user_id == $jobTopicSectionDelete -> user_id || $isShared)
            {
                return view('job_topic_section_deletes.edit')->with('jobTopicSectionDelete', $jobTopicSectionDelete);
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

    public function update($id, UpdateJobTopicSectionDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicSectionDelete = $this->jobTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionDelete))
            {
                Flash::error('Job Topic Section Delete not found');
                return redirect(route('jobTopicSectionDeletes.index'));
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
            
            if($user_id == $jobTopicSectionDelete -> user_id || $isShared)
            {
                $jobTopicSectionDelete = $this->jobTopicSectionDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Section Delete updated successfully.');
                return redirect(route('jobTopicSectionDeletes.index'));
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
            $jobTopicSectionDelete = $this->jobTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionDelete))
            {
                Flash::error('Job Topic Section Delete not found');
                return redirect(route('jobTopicSectionDeletes.index'));
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
            
            if($user_id == $jobTopicSectionDelete -> user_id || $isShared)
            {
                $this->jobTopicSectionDeleteRepository->delete($id);
            
                Flash::success('Job Topic Section Delete deleted successfully.');
                return redirect(route('jobTopicSectionDeletes.index'));
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