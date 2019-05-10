<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSNoteCreateRequest;
use App\Http\Requests\UpdateJobTSNoteCreateRequest;
use App\Repositories\JobTSNoteCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSNoteCreateController extends AppBaseController
{
    private $jobTSNoteCreateRepository;

    public function __construct(JobTSNoteCreateRepository $jobTSNoteCreateRepo)
    {
        $this->jobTSNoteCreateRepository = $jobTSNoteCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSNoteCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSNoteCreates = $this->jobTSNoteCreateRepository->all();
    
            return view('job_t_s_note_creates.index')
                ->with('jobTSNoteCreates', $jobTSNoteCreates);
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
            return view('job_t_s_note_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSNoteCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSNoteCreate = $this->jobTSNoteCreateRepository->create($input);
            
                Flash::success('Job T S Note Create saved successfully.');
                return redirect(route('jobTSNoteCreates.index'));
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
            $jobTSNoteCreate = $this->jobTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteCreate))
            {
                Flash::error('Job T S Note Create not found');
                return redirect(route('jobTSNoteCreates.index'));
            }
            
            $userJobTSNotes = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSNotes as $userJobTSNote)
            {
                if($userJobTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $jobTSNoteCreate -> user_id || $isShared)
            {
                return view('job_t_s_note_creates.show')->with('jobTSNoteCreate', $jobTSNoteCreate);
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
            $jobTSNoteCreate = $this->jobTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteCreate))
            {
                Flash::error('Job T S Note Create not found');
                return redirect(route('jobTSNoteCreates.index'));
            }
            
            $userJobTSNotes = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSNotes as $userJobTSNote)
            {
                if($userJobTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $jobTSNoteCreate -> user_id || $isShared)
            {
                return view('job_t_s_note_creates.edit')->with('jobTSNoteCreate', $jobTSNoteCreate);
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

    public function update($id, UpdateJobTSNoteCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSNoteCreate = $this->jobTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteCreate))
            {
                Flash::error('Job T S Note Create not found');
                return redirect(route('jobTSNoteCreates.index'));
            }
    
            $userJobTSNotes = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSNotes as $userJobTSNote)
            {
                if($userJobTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $jobTSNoteCreate -> user_id || $isShared)
            {
                $jobTSNoteCreate = $this->jobTSNoteCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Note Create updated successfully.');
                return redirect(route('jobTSNoteCreates.index'));
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
            $jobTSNoteCreate = $this->jobTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteCreate))
            {
                Flash::error('Job T S Note Create not found');
                return redirect(route('jobTSNoteCreates.index'));
            }
            
            $userJobTSNotes = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSNotes as $userJobTSNote)
            {
                if($userJobTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $jobTSNoteCreate -> user_id || $isShared)
            {
                $this->jobTSNoteCreateRepository->delete($id);
            
                Flash::success('Job T S Note Create deleted successfully.');
                return redirect(route('jobTSNoteCreates.index'));
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