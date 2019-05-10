<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSNoteUpdateRequest;
use App\Http\Requests\UpdateJobTSNoteUpdateRequest;
use App\Repositories\JobTSNoteUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSNoteUpdateController extends AppBaseController
{
    private $jobTSNoteUpdateRepository;

    public function __construct(JobTSNoteUpdateRepository $jobTSNoteUpdateRepo)
    {
        $this->jobTSNoteUpdateRepository = $jobTSNoteUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSNoteUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSNoteUpdates = $this->jobTSNoteUpdateRepository->all();
    
            return view('job_t_s_note_updates.index')
                ->with('jobTSNoteUpdates', $jobTSNoteUpdates);
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
            return view('job_t_s_note_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSNoteUpdate = $this->jobTSNoteUpdateRepository->create($input);
            
                Flash::success('Job T S Note Update saved successfully.');
                return redirect(route('jobTSNoteUpdates.index'));
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
            $jobTSNoteUpdate = $this->jobTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteUpdate))
            {
                Flash::error('Job T S Note Update not found');
                return redirect(route('jobTSNoteUpdates.index'));
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
            
            if($user_id == $jobTSNoteUpdate -> user_id || $isShared)
            {
                return view('job_t_s_note_updates.show')->with('jobTSNoteUpdate', $jobTSNoteUpdate);
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
            $jobTSNoteUpdate = $this->jobTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteUpdate))
            {
                Flash::error('Job T S Note Update not found');
                return redirect(route('jobTSNoteUpdates.index'));
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
            
            if($user_id == $jobTSNoteUpdate -> user_id || $isShared)
            {
                return view('job_t_s_note_updates.edit')->with('jobTSNoteUpdate', $jobTSNoteUpdate);
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

    public function update($id, UpdateJobTSNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSNoteUpdate = $this->jobTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteUpdate))
            {
                Flash::error('Job T S Note Update not found');
                return redirect(route('jobTSNoteUpdates.index'));
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
            
            if($user_id == $jobTSNoteUpdate -> user_id || $isShared)
            {
                $jobTSNoteUpdate = $this->jobTSNoteUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Note Update updated successfully.');
                return redirect(route('jobTSNoteUpdates.index'));
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
            $jobTSNoteUpdate = $this->jobTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteUpdate))
            {
                Flash::error('Job T S Note Update not found');
                return redirect(route('jobTSNoteUpdates.index'));
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
            
            if($user_id == $jobTSNoteUpdate -> user_id || $isShared)
            {
                $this->jobTSNoteUpdateRepository->delete($id);
            
                Flash::success('Job T S Note Update deleted successfully.');
                return redirect(route('jobTSNoteUpdates.index'));
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