<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSNoteRequest;
use App\Http\Requests\UpdateJobTSNoteRequest;
use App\Repositories\JobTSNoteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\JobTSNote;
use Illuminate\Support\Carbon;
use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;

class JobTSNoteController extends AppBaseController
{
    private $jobTSNoteRepository;

    public function __construct(JobTSNoteRepository $jobTSNoteRepo)
    {
        $this->jobTSNoteRepository = $jobTSNoteRepo;
    }
    
    public function annotateImage($id, Request $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $jobTSNote = $this->jobTSNoteRepository->findWithoutFail($id);
            
            if(empty($jobTSNote))
            {
                Flash::error('Job T S Note not found');
                return redirect(route('jobTSNotes.index'));
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
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('job_t_s_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_note_id' => $id]);
                DB::table('job_t_s_notes')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
               
                $jobTSNote = $this->jobTSNoteRepository->findWithoutFail($id);
                $jobTopicSectionNoteViews = DB::table('users')->join('job_t_s_note_views', 'users.id', '=', 'job_t_s_note_views.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $jobTopicSectionNoteUpdates = DB::table('users')->join('job_t_s_note_updates', 'users.id', '=', 'job_t_s_note_updates.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $jobTSNoteTodolist = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->join('job_t_s_note_todolists', 'job_t_s_notes.id', '=', 'job_t_s_note_todolists.j_t_s_n_id')->where('job_t_s_note_todolists.j_t_s_n_id', '=', $jobTSNote -> id)->where(function ($query) {$query->where('job_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_note_todolists.status', '=', 'active');})->orderBy('job_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
                $jobTSNoteTodolistCompleted = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->join('job_t_s_note_todolists', 'job_t_s_notes.id', '=', 'job_t_s_note_todolists.j_t_s_n_id')->where('job_t_s_note_todolists.j_t_s_n_id', '=', $jobTSNote -> id)->where(function ($query) {$query->where('job_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_t_s_note_todolists.deleted_at', '=', null);})->orderBy('job_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
            
                $text = '';
            
                if($request->file('image'))
                {
                    $image = base64_encode(file_get_contents($request->file('image')));
                    $request = new AnnotateImageRequest();
                    $request->setImage($image);
                    $request->setFeature("TEXT_DETECTION");
                    $gcvRequest = new GoogleCloudVision([$request], 'AIzaSyCiYAx75dCXDnjUNPIOzlqTp0H7Up9AQh8');
                    $response = $gcvRequest->annotate();
            
                    $text = $response->responses[0]->fullTextAnnotation->text;
                }
                
                $jobTSNoteTodolistsList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->join('job_t_s_note_todolists', 'job_t_s_notes.id', '=', 'job_t_s_note_todolists.j_t_s_n_id')->where('job_t_s_note_todolists.j_t_s_n_id', '=', $jobTSNote -> id)->where(function ($query) {$query->where('job_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_note_todolists.status', '=', 'active');})->orderBy('job_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $jobTSNoteTodolistsCompletedList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->join('job_t_s_note_todolists', 'job_t_s_notes.id', '=', 'job_t_s_note_todolists.j_t_s_n_id')->where('job_t_s_note_todolists.j_t_s_n_id', '=', $jobTSNote -> id)->where(function ($query) {$query->where('job_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_t_s_note_todolists.deleted_at', '=', null);})->orderBy('job_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $userJobTSNotesList = DB::table('user_job_t_s_notes')->join('users', 'user_job_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_notes.description', 'permissions', 'user_job_t_s_notes.datetime', 'user_job_t_s_notes.id', 'job_t_s_note_id')->where('job_t_s_note_id', $id)->where(function ($query) {$query->where('user_job_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTopicSectionNoteViewsList = DB::table('users')->join('job_t_s_note_views', 'users.id', '=', 'job_t_s_note_views.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTopicSectionNoteUpdatesList = DB::table('users')->join('job_t_s_note_updates', 'users.id', '=', 'job_t_s_note_updates.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
                return view('job_t_s_notes.show')
                    ->with('jobTSNote', $jobTSNote)
                    ->with('jobTSNoteViews', $jobTopicSectionNoteViews)
                    ->with('jobTSNoteUpdates', $jobTopicSectionNoteUpdates)
                    ->with('jobTSNoteTodolist', $jobTSNoteTodolist)
                    ->with('jobTSNoteTodolistCompleted', $jobTSNoteTodolistCompleted)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('text', $text)
                    ->with('jobTSNoteTodolistsList', $jobTSNoteTodolistsList)
                    ->with('jobTSNoteTodolistsCompletedList', $jobTSNoteTodolistsCompletedList)
                    ->with('userJobTSNotesList', $userJobTSNotesList)
                    ->with('jobTSNoteViewsList', $jobTopicSectionNoteViewsList)
                    ->with('jobTSNoteUpdatesList', $jobTopicSectionNoteUpdatesList);
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

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSNoteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSNotes = $this->jobTSNoteRepository->all();
    
            return view('job_t_s_notes.index')
                ->with('jobTSNotes', $jobTSNotes);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create($id)
    {
        if(Auth::user() != null)
        {
            $jobTSNotesList = JobTSNote::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            return view('job_t_s_notes.create')
                ->with('id', $id)
                ->with('jobTSNotesList', $jobTSNotesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $jobTSNote = $this->jobTSNoteRepository->create($input);
            
            DB::table('job_t_s_note_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_note_id' => $jobTSNote -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTSNote -> name, 'status' => 'active', 'type' => 'j_t_s_n_c', 'user_id' => $user_id, 'entity_id' => $jobTSNote -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Note saved successfully.');
            return redirect(route('jobTopicSections.show', [$jobTSNote -> job_topic_section_id]));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $jobTSNote = $this->jobTSNoteRepository->findWithoutFail($id);
            
            if(empty($jobTSNote))
            {
                Flash::error('Job T S Note not found');
                return redirect(route('jobTSNotes.index'));
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
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('job_t_s_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_note_id' => $id]);
                DB::table('job_t_s_notes')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
               
                $jobTSNote = $this->jobTSNoteRepository->findWithoutFail($id);
                $jobTopicSectionNoteViews = DB::table('users')->join('job_t_s_note_views', 'users.id', '=', 'job_t_s_note_views.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->paginate(50);
                $jobTopicSectionNoteUpdates = DB::table('users')->join('job_t_s_note_updates', 'users.id', '=', 'job_t_s_note_updates.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $jobTSNoteTodolist = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->join('job_t_s_note_todolists', 'job_t_s_notes.id', '=', 'job_t_s_note_todolists.j_t_s_n_id')->where('job_t_s_note_todolists.j_t_s_n_id', '=', $jobTSNote -> id)->where(function ($query) {$query->where('job_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_note_todolists.status', '=', 'active');})->orderBy('job_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
                $jobTSNoteTodolistCompleted = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->join('job_t_s_note_todolists', 'job_t_s_notes.id', '=', 'job_t_s_note_todolists.j_t_s_n_id')->where('job_t_s_note_todolists.j_t_s_n_id', '=', $jobTSNote -> id)->where(function ($query) {$query->where('job_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_t_s_note_todolists.deleted_at', '=', null);})->orderBy('job_t_s_note_todolists.datetime', 'desc')->limit(50)->get();

                $jobTSNoteTodolistsList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->join('job_t_s_note_todolists', 'job_t_s_notes.id', '=', 'job_t_s_note_todolists.j_t_s_n_id')->where('job_t_s_note_todolists.j_t_s_n_id', '=', $jobTSNote -> id)->where(function ($query) {$query->where('job_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_note_todolists.status', '=', 'active');})->orderBy('job_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $jobTSNoteTodolistsCompletedList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->join('job_t_s_note_todolists', 'job_t_s_notes.id', '=', 'job_t_s_note_todolists.j_t_s_n_id')->where('job_t_s_note_todolists.j_t_s_n_id', '=', $jobTSNote -> id)->where(function ($query) {$query->where('job_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_t_s_note_todolists.deleted_at', '=', null);})->orderBy('job_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $userJobTSNotesList = DB::table('user_job_t_s_notes')->join('users', 'user_job_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_notes.description', 'permissions', 'user_job_t_s_notes.datetime', 'user_job_t_s_notes.id', 'job_t_s_note_id')->where('job_t_s_note_id', $id)->where(function ($query) {$query->where('user_job_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSNoteViewsList = DB::table('users')->join('job_t_s_note_views', 'users.id', '=', 'job_t_s_note_views.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->paginate(10);
                $jobTSNoteUpdatesList = DB::table('users')->join('job_t_s_note_updates', 'users.id', '=', 'job_t_s_note_updates.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                       
                $text = '';
                            
                return view('job_t_s_notes.show')
                    ->with('jobTSNote', $jobTSNote)
                    ->with('jobTSNoteViews', $jobTopicSectionNoteViews)
                    ->with('jobTSNoteUpdates', $jobTopicSectionNoteUpdates)
                    ->with('jobTSNoteTodolist', $jobTSNoteTodolist)
                    ->with('jobTSNoteTodolistCompleted', $jobTSNoteTodolistCompleted)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('text', $text)
                    ->with('jobTSNoteTodolistsList', $jobTSNoteTodolistsList)
                    ->with('jobTSNoteTodolistsCompletedList', $jobTSNoteTodolistsCompletedList)
                    ->with('userJobTSNotesList', $userJobTSNotesList)
                    ->with('jobTSNoteViewsList', $jobTSNoteViewsList)
                    ->with('jobTSNoteUpdatesList', $jobTSNoteUpdatesList);
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
            $jobTSNote = $this->jobTSNoteRepository->findWithoutFail($id);
    
            if(empty($jobTSNote))
            {
                Flash::error('Job T S Note not found');
                return redirect(route('jobTSNotes.index'));
            }
            
            $userJobTSNotes = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSNotes as $userJobTSNote)
            {
                if($userJobTSNote -> user_id == $user_id && $userJobTSNote -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $jobTSNoteTodolistsList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->join('job_t_s_note_todolists', 'job_t_s_notes.id', '=', 'job_t_s_note_todolists.j_t_s_n_id')->where('job_t_s_note_todolists.j_t_s_n_id', '=', $jobTSNote -> id)->where(function ($query) {$query->where('job_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_note_todolists.status', '=', 'active');})->orderBy('job_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $jobTSNoteTodolistsCompletedList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->join('job_t_s_note_todolists', 'job_t_s_notes.id', '=', 'job_t_s_note_todolists.j_t_s_n_id')->where('job_t_s_note_todolists.j_t_s_n_id', '=', $jobTSNote -> id)->where(function ($query) {$query->where('job_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_t_s_note_todolists.deleted_at', '=', null);})->orderBy('job_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $userJobTSNotesList = DB::table('user_job_t_s_notes')->join('users', 'user_job_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_notes.description', 'permissions', 'user_job_t_s_notes.datetime', 'user_job_t_s_notes.id', 'job_t_s_note_id')->where('job_t_s_note_id', $id)->where(function ($query) {$query->where('user_job_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSNoteViewsList = DB::table('users')->join('job_t_s_note_views', 'users.id', '=', 'job_t_s_note_views.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->paginate(10);
                $jobTSNoteUpdatesList = DB::table('users')->join('job_t_s_note_updates', 'users.id', '=', 'job_t_s_note_updates.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('job_t_s_notes.edit')
                    ->with('jobTSNote', $jobTSNote)
                    ->with('id', $id)
                    ->with('jobTSNoteTodolistsList', $jobTSNoteTodolistsList)
                    ->with('jobTSNoteTodolistsCompletedList', $jobTSNoteTodolistsCompletedList)
                    ->with('userJobTSNotesList', $userJobTSNotesList)
                    ->with('jobTSNoteViewsList', $jobTSNoteViewsList)
                    ->with('jobTSNoteUpdatesList', $jobTSNoteUpdatesList);
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

    public function update($id, UpdateJobTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $jobTSNote = $this->jobTSNoteRepository->findWithoutFail($id);
    
            if(empty($jobTSNote))
            {
                Flash::error('Job T S Note not found');
                return redirect(route('jobTSNotes.index'));
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
            
            $size = 0;
            $job_data_sizes = DB::table('jobs')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            foreach($job_data_sizes as $job_data_size)
            {
                $size += $job_data_size -> specific_info_size;
                $job_topic_data_sizes = DB::table('job_topics')->where('job_id', '=', $job_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($job_topic_data_sizes as $job_topic_data_size)
                {
                    $size += $job_topic_data_size -> specific_info_size;
                    $job_section_data_sizes = DB::table('job_topic_sections')->where('job_topic_id', '=', $job_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($job_section_data_sizes as $job_section_data_size)
                    {
                        $size += $job_section_data_size -> specific_info_size;
                        $job_file_data_sizes = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($job_file_data_sizes as $job_file_data_size)
                        {
                            $size += $job_file_data_size -> file_size;
                        }
                
                        $job_note_data_sizes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_note_data_sizes as $job_note_data_size)
                        {
                            $size += $job_note_data_size -> specific_info_size;
                        }
                                
                        $job_galery_data_sizes = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_galery_data_sizes as $job_galery_data_size)
                        {
                            //$size += $job_galery_data_size -> specific_info_size;
                            $job_image_data_sizes = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $job_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_image_data_sizes as $job_image_data_size)
                            {
                                $size += $job_image_data_size -> file_size;
                            }
                        }
                                
                        $job_playlist_data_sizes = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_playlist_data_sizes as $job_playlist_data_size)
                        {
                            //$size += $job_playlist_data_size -> specific_info_size;
                            $job_audio_data_sizes = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $job_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_audio_data_sizes as $job_audio_data_size)
                            {
                                $size += $job_audio_data_size -> file_size;
                            }
                        }
                                
                        $job_tool_data_sizes = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_tool_data_sizes as $job_tool_data_size)
                        {
                            //$size += $job_tool_data_size -> specific_info_size;
                            $job_tool_file_data_sizes = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $job_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_tool_file_data_sizes as $job_tool_file_data_size)
                            {
                                $size += $job_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            $job_data_sizes = DB::table('jobs')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();

            foreach($job_data_sizes as $job_data_size)
            {
                $size += $job_data_size -> specific_info_size;
                $job_topic_data_sizes = DB::table('job_topics')->where('job_id', '=', $job_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($job_topic_data_sizes as $job_topic_data_size)
                {
                    $size += $job_topic_data_size -> specific_info_size;
                    $job_section_data_sizes = DB::table('job_topic_sections')->where('job_topic_id', '=', $job_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($job_section_data_sizes as $job_section_data_size)
                    {
                        $size += $job_section_data_size -> specific_info_size;
                        $job_file_data_sizes = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($job_file_data_sizes as $job_file_data_size)
                        {
                            $size += $job_file_data_size -> file_size;
                        }
                
                        $job_note_data_sizes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_note_data_sizes as $job_note_data_size)
                        {
                            $size += $job_note_data_size -> specific_info_size;
                        }
                                
                        $job_galery_data_sizes = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_galery_data_sizes as $job_galery_data_size)
                        {
                            //$size += $job_galery_data_size -> specific_info_size;
                            $job_image_data_sizes = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $job_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_image_data_sizes as $job_image_data_size)
                            {
                                $size += $job_image_data_size -> file_size;
                            }
                        }
                                
                        $job_playlist_data_sizes = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_playlist_data_sizes as $job_playlist_data_size)
                        {
                            //$size += $job_playlist_data_size -> specific_info_size;
                            $job_audio_data_sizes = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $job_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_audio_data_sizes as $job_audio_data_size)
                            {
                                $size += $job_audio_data_size -> file_size;
                            }
                        }
                                
                        $job_tool_data_sizes = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_tool_data_sizes as $job_tool_data_size)
                        {
                            //$size += $job_tool_data_size -> specific_info_size;
                            $job_tool_file_data_sizes = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $job_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_tool_file_data_sizes as $job_tool_file_data_size)
                            {
                                $size += $job_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            $project_data_sizes = DB::table('projects')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            foreach($project_data_sizes as $project_data_size)
            {
                $size += $project_data_size -> specific_info_size;
                $project_topic_data_sizes = DB::table('project_topics')->where('project_id', '=', $project_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($project_topic_data_sizes as $project_topic_data_size)
                {
                    $size += $project_topic_data_size -> specific_info_size;
                    $project_section_data_sizes = DB::table('project_topic_sections')->where('project_topic_id', '=', $project_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($project_section_data_sizes as $project_section_data_size)
                    {
                        $size += $project_section_data_size -> specific_info_size;
                        $project_file_data_sizes = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($project_file_data_sizes as $project_file_data_size)
                        {
                            $size += $project_file_data_size -> file_size;
                        }
                
                        $project_note_data_sizes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_note_data_sizes as $project_note_data_size)
                        {
                            $size += $project_note_data_size -> specific_info_size;
                        }
                                
                        $project_galery_data_sizes = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_galery_data_sizes as $project_galery_data_size)
                        {
                            //$size += $project_galery_data_size -> specific_info_size;
                            $project_image_data_sizes = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $project_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($project_image_data_sizes as $project_image_data_size)
                            {
                                $size += $project_image_data_size -> file_size;
                            }
                        }
                                
                        $project_playlist_data_sizes = DB::table('project_t_s_playlists')->where('p_t_s_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_playlist_data_sizes as $project_playlist_data_size)
                        {
                            //$size += $project_playlist_data_size -> specific_info_size;
                            $project_audio_data_sizes = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $project_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($project_audio_data_sizes as $project_audio_data_size)
                            {
                                $size += $project_audio_data_size -> file_size;
                            }
                        }
                                
                        $project_tool_data_sizes = DB::table('project_t_s_tools')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_tool_data_sizes as $project_tool_data_size)
                        {
                            //$size += $project_tool_data_size -> specific_info_size;
                            $project_tool_file_data_sizes = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $project_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($project_tool_file_data_sizes as $project_tool_file_data_size)
                            {
                                $size += $project_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            $personal_data_data_sizes = DB::table('personal_datas')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            foreach($personal_data_data_sizes as $personal_data_data_size)
            {
                $size += $personal_data_data_size -> specific_info_size;
                $personal_data_topic_data_sizes = DB::table('personal_data_topics')->where('personal_data_id', '=', $personal_data_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($personal_data_topic_data_sizes as $personal_data_topic_data_size)
                {
                    $size += $personal_data_topic_data_size -> specific_info_size;
                    $personal_data_section_data_sizes = DB::table('personal_data_topic_sections')->where('personal_data_topic_id', '=', $personal_data_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($personal_data_section_data_sizes as $personal_data_section_data_size)
                    {
                        $size += $personal_data_section_data_size -> specific_info_size;
                        $personal_data_file_data_sizes = DB::table('personal_data_t_s_files')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($personal_data_file_data_sizes as $personal_data_file_data_size)
                        {
                            $size += $personal_data_file_data_size -> file_size;
                        }
                
                        $personal_data_note_data_sizes = DB::table('personal_data_t_s_notes')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_note_data_sizes as $personal_data_note_data_size)
                        {
                            $size += $personal_data_note_data_size -> specific_info_size;
                        }
                                
                        $personal_data_galery_data_sizes = DB::table('personal_data_t_s_galeries')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_galery_data_sizes as $personal_data_galery_data_size)
                        {
                            //$size += $personal_data_galery_data_size -> specific_info_size;
                            $personal_data_image_data_sizes = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $personal_data_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_image_data_sizes as $personal_data_image_data_size)
                            {
                                $size += $personal_data_image_data_size -> file_size;
                            }
                        }
                                
                        $personal_data_playlist_data_sizes = DB::table('personal_data_t_s_playlists')->where('p_d_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_playlist_data_sizes as $personal_data_playlist_data_size)
                        {
                            //$size += $personal_data_playlist_data_size -> specific_info_size;
                            $personal_data_audio_data_sizes = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $personal_data_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_audio_data_sizes as $personal_data_audio_data_size)
                            {
                                $size += $personal_data_audio_data_size -> file_size;
                            }
                        }
                                
                        $personal_data_tool_data_sizes = DB::table('personal_data_t_s_tools')->where('personal_data_topic_section_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_tool_data_sizes as $personal_data_tool_data_size)
                        {
                            //$size += $personal_data_tool_data_size -> specific_info_size;
                            $personal_data_tool_file_data_sizes = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $personal_data_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_tool_file_data_sizes as $personal_data_tool_file_data_size)
                            {
                                $size += $personal_data_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            if(($user_id == $user[0] -> id || $isShared) && $size <= 1073741824)
            {
                $newJobTSNote = $this->jobTSNoteRepository->update($request->all(), $id);
                $specific_info_size = strlen($request -> content);
                
                DB::table('job_t_s_notes')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1'), 'specific_info_size' => $specific_info_size]);
                DB::table('job_t_s_note_updates')->insert(['actual_name' => $newJobTSNote -> name, 'past_name' => $jobTSNote -> name, 'datetime' => $now, 'job_t_s_note_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $jobTSNote -> name, 'status' => 'active', 'type' => 'j_t_s_n_u', 'user_id' => $user_id, 'entity_id' => $jobTSNote -> id, 'created_at' => $now]);
                
                Flash::success('Job T S Note updated successfully.');
                return redirect(route('jobTSNotes.show', [$id]));
            }
            
            else
            {
                if($size > 1073741824)
                {
                    Flash::error('Your storage space is exhausted, you can get more space at only 15 dollars per month.');
                    return redirect(route('jobs.index'));
                }
                
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $jobTSNote = $this->jobTSNoteRepository->findWithoutFail($id);
    
            if(empty($jobTSNote))
            {
                Flash::error('Job T S Note not found');
                return redirect(route('jobTSNotes.index'));
            }
            
            $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                DB::table('user_job_t_s_notes')->where('job_t_s_note_id', $jobTSNote -> id)->update(['deleted_at' => $now]);
                
                $userJobTSNote = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $jobTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userJobTSNote == null)
                {
                    DB::table('user_job_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_n_id' => $userJobTSNote[0] -> id]);
                }
                
                $this->jobTSNoteRepository->delete($id);
                
                DB::table('job_t_s_note_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_note_id' => $jobTSNote -> id]);
                DB::table('recent_activities')->insert(['name' => $jobTSNote -> name, 'status' => 'active', 'type' => 'j_t_s_n_d', 'user_id' => $user_id, 'entity_id' => $jobTSNote -> id, 'created_at' => $now]);
            
                Flash::success('Job T S Note deleted successfully.');
                return redirect(route('jobTopicSections.show', [$jobTSNote -> job_topic_section_id]));
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