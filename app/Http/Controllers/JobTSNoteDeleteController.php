<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSNoteDeleteRequest;
use App\Http\Requests\UpdateJobTSNoteDeleteRequest;
use App\Repositories\JobTSNoteDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSNoteDeleteController extends AppBaseController
{
    private $jobTSNoteDeleteRepository;

    public function __construct(JobTSNoteDeleteRepository $jobTSNoteDeleteRepo)
    {
        $this->jobTSNoteDeleteRepository = $jobTSNoteDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSNoteDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSNoteDeletes = $this->jobTSNoteDeleteRepository->all();
    
            return view('job_t_s_note_deletes.index')
                ->with('jobTSNoteDeletes', $jobTSNoteDeletes);
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
            return view('job_t_s_note_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSNoteDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSNoteDelete = $this->jobTSNoteDeleteRepository->create($input);
            
                Flash::success('Job T S Note Delete saved successfully.');
                return redirect(route('jobTSNoteDeletes.index'));
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
            $jobTSNoteDelete = $this->jobTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteDelete))
            {
                Flash::error('Job T S Note Delete not found');
                return redirect(route('jobTSNoteDeletes.index'));
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
            
            if($user_id == $jobTSNoteDelete -> user_id || $isShared)
            {
                return view('job_t_s_note_deletes.show')->with('jobTSNoteDelete', $jobTSNoteDelete);
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
            $jobTSNoteDelete = $this->jobTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteDelete))
            {
                Flash::error('Job T S Note Delete not found');
                return redirect(route('jobTSNoteDeletes.index'));
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
            
            if($user_id == $jobTSNoteDelete -> user_id || $isShared)
            {
                return view('job_t_s_note_deletes.edit')->with('jobTSNoteDelete', $jobTSNoteDelete);
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

    public function update($id, UpdateJobTSNoteDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSNoteDelete = $this->jobTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteDelete))
            {
                Flash::error('Job T S Note Delete not found');
                return redirect(route('jobTSNoteDeletes.index'));
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
            
            if($user_id == $jobTSNoteDelete -> user_id || $isShared)
            {
                $jobTSNoteDelete = $this->jobTSNoteDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S Note Delete updated successfully.');
                return redirect(route('jobTSNoteDeletes.index'));
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
            $jobTSNoteDelete = $this->jobTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteDelete))
            {
                Flash::error('Job T S Note Delete not found');
                return redirect(route('jobTSNoteDeletes.index'));
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
            
            if($user_id == $jobTSNoteDelete -> user_id || $isShared)
            {
                $this->jobTSNoteDeleteRepository->delete($id);
            
                Flash::success('Job T S Note Delete deleted successfully.');
                return redirect(route('jobTSNoteDeletes.index'));
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