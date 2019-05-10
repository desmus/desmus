<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSNoteRequest;
use App\Http\Requests\UpdateCollegeTSNoteRequest;
use App\Repositories\CollegeTSNoteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\CollegeTSNote;
use Illuminate\Support\Carbon;
use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;

class CollegeTSNoteController extends AppBaseController
{
    private $collegeTSNoteRepository;

    public function __construct(CollegeTSNoteRepository $collegeTSNoteRepo)
    {
        $this->collegeTSNoteRepository = $collegeTSNoteRepo;
    }
    
    public function annotateImage($id, Request $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $collegeTSNote = $this->collegeTSNoteRepository->findWithoutFail($id);
            
            if(empty($collegeTSNote))
            {
                Flash::error('College T S Note not found');
                return redirect(route('collegeTSNotes.index'));
            }
            
            $userCollegeTSNotes = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSNotes as $userCollegeTSNote)
            {
                if($userCollegeTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('college_t_s_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_note_id' => $id]);
                DB::table('college_t_s_notes')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
               
                $collegeTSNote = $this->collegeTSNoteRepository->findWithoutFail($id);
                $collegeTopicSectionNoteViews = DB::table('users')->join('college_t_s_note_views', 'users.id', '=', 'college_t_s_note_views.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeTopicSectionNoteUpdates = DB::table('users')->join('college_t_s_note_updates', 'users.id', '=', 'college_t_s_note_updates.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeTSNoteTodolist = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->join('college_t_s_note_todolists', 'college_t_s_notes.id', '=', 'college_t_s_note_todolists.c_t_s_n_id')->where('college_t_s_note_todolists.c_t_s_n_id', '=', $collegeTSNote -> id)->where(function ($query) {$query->where('college_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_note_todolists.status', '=', 'active');})->orderBy('college_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
                $collegeTSNoteTodolistCompleted = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->join('college_t_s_note_todolists', 'college_t_s_notes.id', '=', 'college_t_s_note_todolists.c_t_s_n_id')->where('college_t_s_note_todolists.c_t_s_n_id', '=', $collegeTSNote -> id)->where(function ($query) {$query->where('college_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_t_s_note_todolists.deleted_at', '=', null);})->orderBy('college_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
            
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
                
                $collegeTSNoteTodolistsList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->join('college_t_s_note_todolists', 'college_t_s_notes.id', '=', 'college_t_s_note_todolists.c_t_s_n_id')->where('college_t_s_note_todolists.c_t_s_n_id', '=', $collegeTSNote -> id)->where(function ($query) {$query->where('college_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_note_todolists.status', '=', 'active');})->orderBy('college_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $collegeTSNoteTodolistsCompletedList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->join('college_t_s_note_todolists', 'college_t_s_notes.id', '=', 'college_t_s_note_todolists.c_t_s_n_id')->where('college_t_s_note_todolists.c_t_s_n_id', '=', $collegeTSNote -> id)->where(function ($query) {$query->where('college_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_t_s_note_todolists.deleted_at', '=', null);})->orderBy('college_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $userCollegeTSNotesList = DB::table('user_college_t_s_notes')->join('users', 'user_college_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_notes.description', 'permissions', 'user_college_t_s_notes.datetime', 'user_college_t_s_notes.id', 'college_t_s_note_id')->where('college_t_s_note_id', $id)->where(function ($query) {$query->where('user_college_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTopicSectionNoteViewsList = DB::table('users')->join('college_t_s_note_views', 'users.id', '=', 'college_t_s_note_views.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTopicSectionNoteUpdatesList = DB::table('users')->join('college_t_s_note_updates', 'users.id', '=', 'college_t_s_note_updates.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
                return view('college_t_s_notes.show')
                    ->with('collegeTSNote', $collegeTSNote)
                    ->with('collegeTSNoteViews', $collegeTopicSectionNoteViews)
                    ->with('collegeTSNoteUpdates', $collegeTopicSectionNoteUpdates)
                    ->with('collegeTSNoteTodolist', $collegeTSNoteTodolist)
                    ->with('collegeTSNoteTodolistCompleted', $collegeTSNoteTodolistCompleted)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('text', $text)
                    ->with('collegeTSNoteTodolistsList', $collegeTSNoteTodolistsList)
                    ->with('collegeTSNoteTodolistsCompletedList', $collegeTSNoteTodolistsCompletedList)
                    ->with('userCollegeTSNotesList', $userCollegeTSNotesList)
                    ->with('collegeTSNoteViewsList', $collegeTopicSectionNoteViewsList)
                    ->with('collegeTSNoteUpdatesList', $collegeTopicSectionNoteUpdatesList);
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
            $this->collegeTSNoteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSNotes = $this->collegeTSNoteRepository->all();
    
            return view('college_t_s_notes.index')
                ->with('collegeTSNotes', $collegeTSNotes);
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
            $collegeTSNotesList = CollegeTSNote::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            return view('college_t_s_notes.create')
                ->with('id', $id)
                ->with('collegeTSNotesList', $collegeTSNotesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $collegeTSNote = $this->collegeTSNoteRepository->create($input);
            
            DB::table('college_t_s_note_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_note_id' => $collegeTSNote -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSNote -> name, 'status' => 'active', 'type' => 'c_t_s_n_c', 'user_id' => $user_id, 'entity_id' => $collegeTSNote -> id, 'created_at' => $now]);
    
            Flash::success('College T S Note saved successfully.');
            return redirect(route('collegeTopicSections.show', [$collegeTSNote -> college_topic_section_id]));
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
            $collegeTSNote = $this->collegeTSNoteRepository->findWithoutFail($id);
            
            if(empty($collegeTSNote))
            {
                Flash::error('College T S Note not found');
                return redirect(route('collegeTSNotes.index'));
            }
            
            $userCollegeTSNotes = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSNotes as $userCollegeTSNote)
            {
                if($userCollegeTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('college_t_s_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_note_id' => $id]);
                DB::table('college_t_s_notes')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
               
                $collegeTSNote = $this->collegeTSNoteRepository->findWithoutFail($id);
                $collegeTopicSectionNoteViews = DB::table('users')->join('college_t_s_note_views', 'users.id', '=', 'college_t_s_note_views.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeTopicSectionNoteUpdates = DB::table('users')->join('college_t_s_note_updates', 'users.id', '=', 'college_t_s_note_updates.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeTSNoteTodolist = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->join('college_t_s_note_todolists', 'college_t_s_notes.id', '=', 'college_t_s_note_todolists.c_t_s_n_id')->where('college_t_s_note_todolists.c_t_s_n_id', '=', $collegeTSNote -> id)->where(function ($query) {$query->where('college_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_note_todolists.status', '=', 'active');})->orderBy('college_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
                $collegeTSNoteTodolistCompleted = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->join('college_t_s_note_todolists', 'college_t_s_notes.id', '=', 'college_t_s_note_todolists.c_t_s_n_id')->where('college_t_s_note_todolists.c_t_s_n_id', '=', $collegeTSNote -> id)->where(function ($query) {$query->where('college_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_t_s_note_todolists.deleted_at', '=', null);})->orderBy('college_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
            
                $collegeTSNoteTodolistsList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->join('college_t_s_note_todolists', 'college_t_s_notes.id', '=', 'college_t_s_note_todolists.c_t_s_n_id')->where('college_t_s_note_todolists.c_t_s_n_id', '=', $collegeTSNote -> id)->where(function ($query) {$query->where('college_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_note_todolists.status', '=', 'active');})->orderBy('college_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $collegeTSNoteTodolistsCompletedList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->join('college_t_s_note_todolists', 'college_t_s_notes.id', '=', 'college_t_s_note_todolists.c_t_s_n_id')->where('college_t_s_note_todolists.c_t_s_n_id', '=', $collegeTSNote -> id)->where(function ($query) {$query->where('college_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_t_s_note_todolists.deleted_at', '=', null);})->orderBy('college_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $userCollegeTSNotesList = DB::table('user_college_t_s_notes')->join('users', 'user_college_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_notes.description', 'permissions', 'user_college_t_s_notes.datetime', 'user_college_t_s_notes.id', 'college_t_s_note_id')->where('college_t_s_note_id', $id)->where(function ($query) {$query->where('user_college_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTopicSectionNoteViewsList = DB::table('users')->join('college_t_s_note_views', 'users.id', '=', 'college_t_s_note_views.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTopicSectionNoteUpdatesList = DB::table('users')->join('college_t_s_note_updates', 'users.id', '=', 'college_t_s_note_updates.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                $text = '';
            
                return view('college_t_s_notes.show')
                    ->with('collegeTSNote', $collegeTSNote)
                    ->with('collegeTSNoteViews', $collegeTopicSectionNoteViews)
                    ->with('collegeTSNoteUpdates', $collegeTopicSectionNoteUpdates)
                    ->with('collegeTSNoteTodolist', $collegeTSNoteTodolist)
                    ->with('collegeTSNoteTodolistCompleted', $collegeTSNoteTodolistCompleted)
                    ->with('text', $text)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('collegeTSNoteTodolistsList', $collegeTSNoteTodolistsList)
                    ->with('collegeTSNoteTodolistsCompletedList', $collegeTSNoteTodolistsCompletedList)
                    ->with('userCollegeTSNotesList', $userCollegeTSNotesList)
                    ->with('collegeTSNoteViewsList', $collegeTopicSectionNoteViewsList)
                    ->with('collegeTSNoteUpdatesList', $collegeTopicSectionNoteUpdatesList);
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
            $collegeTSNote = $this->collegeTSNoteRepository->findWithoutFail($id);
    
            if(empty($collegeTSNote))
            {
                Flash::error('College T S Note not found');
                return redirect(route('collegeTSNotes.index'));
            }
            
            $userCollegeTSNotes = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSNotes as $userCollegeTSNote)
            {
                if($userCollegeTSNote -> user_id == $user_id && $userCollegeTSNote -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $collegeTSNoteTodolistsList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->join('college_t_s_note_todolists', 'college_t_s_notes.id', '=', 'college_t_s_note_todolists.c_t_s_n_id')->where('college_t_s_note_todolists.c_t_s_n_id', '=', $collegeTSNote -> id)->where(function ($query) {$query->where('college_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_note_todolists.status', '=', 'active');})->orderBy('college_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $collegeTSNoteTodolistsCompletedList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->join('college_t_s_note_todolists', 'college_t_s_notes.id', '=', 'college_t_s_note_todolists.c_t_s_n_id')->where('college_t_s_note_todolists.c_t_s_n_id', '=', $collegeTSNote -> id)->where(function ($query) {$query->where('college_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_t_s_note_todolists.deleted_at', '=', null);})->orderBy('college_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $userCollegeTSNotesList = DB::table('user_college_t_s_notes')->join('users', 'user_college_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_notes.description', 'permissions', 'user_college_t_s_notes.datetime', 'user_college_t_s_notes.id', 'college_t_s_note_id')->where('college_t_s_note_id', $id)->where(function ($query) {$query->where('user_college_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTopicSectionNoteViewsList = DB::table('users')->join('college_t_s_note_views', 'users.id', '=', 'college_t_s_note_views.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTopicSectionNoteUpdatesList = DB::table('users')->join('college_t_s_note_updates', 'users.id', '=', 'college_t_s_note_updates.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('college_t_s_notes.edit')
                    ->with('collegeTSNote', $collegeTSNote)
                    ->with('id', $id)
                    ->with('collegeTSNoteTodolistsList', $collegeTSNoteTodolistsList)
                    ->with('collegeTSNoteTodolistsCompletedList', $collegeTSNoteTodolistsCompletedList)
                    ->with('userCollegeTSNotesList', $userCollegeTSNotesList)
                    ->with('collegeTSNoteViewsList', $collegeTopicSectionNoteViewsList)
                    ->with('collegeTSNoteUpdatesList', $collegeTopicSectionNoteUpdatesList);
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

    public function update($id, UpdateCollegeTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $collegeTSNote = $this->collegeTSNoteRepository->findWithoutFail($id);
    
            if(empty($collegeTSNote))
            {
                Flash::error('College T S Note not found');
                return redirect(route('collegeTSNotes.index'));
            }
            
            $userCollegeTSNotes = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSNotes as $userCollegeTSNote)
            {
                if($userCollegeTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_notes.id', '=', $id)->get();
            
            $size = 0;
            $college_data_sizes = DB::table('colleges')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            foreach($college_data_sizes as $college_data_size)
            {
                $size += $college_data_size -> specific_info_size;
                $college_topic_data_sizes = DB::table('college_topics')->where('college_id', '=', $college_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($college_topic_data_sizes as $college_topic_data_size)
                {
                    $size += $college_topic_data_size -> specific_info_size;
                    $college_section_data_sizes = DB::table('college_topic_sections')->where('college_topic_id', '=', $college_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($college_section_data_sizes as $college_section_data_size)
                    {
                        $size += $college_section_data_size -> specific_info_size;
                        $college_file_data_sizes = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $college_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($college_file_data_sizes as $college_file_data_size)
                        {
                            $size += $college_file_data_size -> file_size;
                        }
                
                        $college_note_data_sizes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $college_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($college_note_data_sizes as $college_note_data_size)
                        {
                            $size += $college_note_data_size -> specific_info_size;
                        }
                                
                        $college_galery_data_sizes = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $college_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($college_galery_data_sizes as $college_galery_data_size)
                        {
                            //$size += $college_galery_data_size -> specific_info_size;
                            $college_image_data_sizes = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $college_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($college_image_data_sizes as $college_image_data_size)
                            {
                                $size += $college_image_data_size -> file_size;
                            }
                        }
                                
                        $college_playlist_data_sizes = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $college_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($college_playlist_data_sizes as $college_playlist_data_size)
                        {
                            //$size += $college_playlist_data_size -> specific_info_size;
                            $college_audio_data_sizes = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $college_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($college_audio_data_sizes as $college_audio_data_size)
                            {
                                $size += $college_audio_data_size -> file_size;
                            }
                        }
                                
                        $college_tool_data_sizes = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $college_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($college_tool_data_sizes as $college_tool_data_size)
                        {
                            //$size += $college_tool_data_size -> specific_info_size;
                            $college_tool_file_data_sizes = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $college_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($college_tool_file_data_sizes as $college_tool_file_data_size)
                            {
                                $size += $college_tool_file_data_size -> file_size;
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
                $newCollegeTSNote = $this->collegeTSNoteRepository->update($request->all(), $id);
                $specific_info_size = strlen($request -> content);
                
                DB::table('college_t_s_notes')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1'), 'specific_info_size' => $specific_info_size]);
                DB::table('college_t_s_note_updates')->insert(['actual_name' => $newCollegeTSNote -> name, 'past_name' => $collegeTSNote -> name, 'datetime' => $now, 'college_t_s_note_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $collegeTSNote -> name, 'status' => 'active', 'type' => 'c_t_s_n_u', 'user_id' => $user_id, 'entity_id' => $collegeTSNote -> id, 'created_at' => $now]);
            
                Flash::success('College T S Note updated successfully.');
                return redirect(route('collegeTSNotes.show', [$id]));
            }
            
            else
            {
                if($size > 1073741824)
                {
                    Flash::error('Your storage space is exhausted, you can get more space at only 15 dollars per month.');
                    return redirect(route('colleges.index'));
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
            $collegeTSNote = $this->collegeTSNoteRepository->findWithoutFail($id);
    
            if (empty($collegeTSNote))
            {
                Flash::error('College T S Note not found');
                return redirect(route('collegeTSNotes.index'));
            }
            
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                DB::table('user_college_t_s_notes')->where('college_t_s_note_id', $collegeTSNote -> id)->update(['deleted_at' => $now]);
                
                $userCollegeTSNote = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $collegeTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userCollegeTSNote == null)
                {
                    DB::table('user_college_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote[0] -> id]);
                }
                
                $this->collegeTSNoteRepository->delete($id);
                
                DB::table('college_t_s_note_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_note_id' => $collegeTSNote -> id]);
                DB::table('recent_activities')->insert(['name' => $collegeTSNote -> name, 'status' => 'active', 'type' => 'c_t_s_n_d', 'user_id' => $user_id, 'entity_id' => $collegeTSNote -> id, 'created_at' => $now]);
            
                Flash::success('College T S Note deleted successfully.');
                return redirect(route('collegeTopicSections.show', [$collegeTSNote -> college_topic_section_id]));
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