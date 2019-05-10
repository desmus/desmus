<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSNoteViewRequest;
use App\Http\Requests\UpdateJobTSNoteViewRequest;
use App\Repositories\JobTSNoteViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSNoteViewController extends AppBaseController
{
    private $jobTSNoteViewRepository;

    public function __construct(JobTSNoteViewRepository $jobTSNoteViewRepo)
    {
        $this->jobTSNoteViewRepository = $jobTSNoteViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSNoteViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSNoteViews = $this->jobTSNoteViewRepository->all();
    
            return view('job_t_s_note_views.index')
                ->with('jobTSNoteViews', $jobTSNoteViews);
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
            return view('job_t_s_note_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSNoteView = $this->jobTSNoteViewRepository->create($input);
            
                Flash::success('Job T S Note View saved successfully.');
                return redirect(route('jobTSNoteViews.index'));
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
            $jobTSNoteView = $this->jobTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteView))
            {
                Flash::error('Job T S Note View not found');
                return redirect(route('jobTSNoteViews.index'));
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
            
            if($user_id == $jobTSNoteView -> user_id || $isShared)
            {
                return view('job_t_s_note_views.show')->with('jobTSNoteView', $jobTSNoteView);
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
            $jobTSNoteView = $this->jobTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteView))
            {
                Flash::error('Job T S Note View not found');
                return redirect(route('jobTSNoteViews.index'));
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
            
            if($user_id == $jobTSNoteView -> user_id || $isShared)
            {
                return view('job_t_s_note_views.edit')->with('jobTSNoteView', $jobTSNoteView);
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

    public function update($id, UpdateJobTSNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSNoteView = $this->jobTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteView))
            {
                Flash::error('Job T S Note View not found');
                return redirect(route('jobTSNoteViews.index'));
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
            
            if($user_id == $jobTSNoteView -> user_id || $isShared)
            {
                $jobTSNoteView = $this->jobTSNoteViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S Note View updated successfully.');
                return redirect(route('jobTSNoteViews.index'));
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
            $jobTSNoteView = $this->jobTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteView))
            {
                Flash::error('Job T S Note View not found');
                return redirect(route('jobTSNoteViews.index'));
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
            
            if($user_id == $jobTSNoteView -> user_id || $isShared)
            {
                $this->jobTSNoteViewRepository->delete($id);
            
                Flash::success('Job T S Note View deleted successfully.');
                return redirect(route('jobTSNoteViews.index'));
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