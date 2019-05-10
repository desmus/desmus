<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSNoteRequest;
use App\Http\Requests\UpdateProjectTSNoteRequest;
use App\Repositories\ProjectTSNoteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\ProjectTSNote;
use Illuminate\Support\Carbon;
use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;

class ProjectTSNoteController extends AppBaseController
{
    private $projectTSNoteRepository;

    public function __construct(ProjectTSNoteRepository $projectTSNoteRepo)
    {
        $this->projectTSNoteRepository = $projectTSNoteRepo;
    }
    
    public function annotateImage($id, Request $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $projectTSNote = $this->projectTSNoteRepository->findWithoutFail($id);
            
            if(empty($projectTSNote))
            {
                Flash::error('Project T S Note not found');
                return redirect(route('projectTSNotes.index'));
            }
            
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('project_t_s_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_t_s_note_id' => $id]);
                DB::table('project_t_s_notes')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
               
                $projectTSNote = $this->projectTSNoteRepository->findWithoutFail($id);
                $projectTopicSectionNoteViews = DB::table('users')->join('project_t_s_note_views', 'users.id', '=', 'project_t_s_note_views.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $projectTopicSectionNoteUpdates = DB::table('users')->join('project_t_s_note_updates', 'users.id', '=', 'project_t_s_note_updates.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $projectTSNoteTodolist = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->join('project_t_s_note_todolists', 'project_t_s_notes.id', '=', 'project_t_s_note_todolists.p_t_s_n_id')->where('project_t_s_note_todolists.p_t_s_n_id', '=', $projectTSNote -> id)->where(function ($query) {$query->where('project_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_note_todolists.status', '=', 'active');})->orderBy('project_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
                $projectTSNoteTodolistCompleted = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->join('project_t_s_note_todolists', 'project_t_s_notes.id', '=', 'project_t_s_note_todolists.p_t_s_n_id')->where('project_t_s_note_todolists.p_t_s_n_id', '=', $projectTSNote -> id)->where(function ($query) {$query->where('project_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('project_t_s_note_todolists.deleted_at', '=', null);})->orderBy('project_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
            
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
                
                $projectTSNoteTodolistsList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->join('project_t_s_note_todolists', 'project_t_s_notes.id', '=', 'project_t_s_note_todolists.p_t_s_n_id')->where('project_t_s_note_todolists.p_t_s_n_id', '=', $projectTSNote -> id)->where(function ($query) {$query->where('project_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_note_todolists.status', '=', 'active');})->orderBy('project_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $projectTSNoteTodolistsCompletedList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->join('project_t_s_note_todolists', 'project_t_s_notes.id', '=', 'project_t_s_note_todolists.p_t_s_n_id')->where('project_t_s_note_todolists.p_t_s_n_id', '=', $projectTSNote -> id)->where(function ($query) {$query->where('project_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('project_t_s_note_todolists.deleted_at', '=', null);})->orderBy('project_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $userProjectTSNotesList = DB::table('user_project_t_s_notes')->join('users', 'user_project_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_notes.description', 'permissions', 'user_project_t_s_notes.datetime', 'user_project_t_s_notes.id', 'project_t_s_note_id')->where('project_t_s_note_id', $id)->where(function ($query) {$query->where('user_project_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTopicSectionNoteViewsList = DB::table('users')->join('project_t_s_note_views', 'users.id', '=', 'project_t_s_note_views.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTopicSectionNoteUpdatesList = DB::table('users')->join('project_t_s_note_updates', 'users.id', '=', 'project_t_s_note_updates.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
                return view('project_t_s_notes.show')
                    ->with('projectTSNote', $projectTSNote)
                    ->with('projectTSNoteViews', $projectTopicSectionNoteViews)
                    ->with('projectTSNoteUpdates', $projectTopicSectionNoteUpdates)
                    ->with('projectTSNoteTodolist', $projectTSNoteTodolist)
                    ->with('projectTSNoteTodolistCompleted', $projectTSNoteTodolistCompleted)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('text', $text)
                    ->with('projectTSNoteTodolistsList', $projectTSNoteTodolistsList)
                    ->with('projectTSNoteTodolistsCompletedList', $projectTSNoteTodolistsCompletedList)
                    ->with('userProjectTSNotesList', $userProjectTSNotesList)
                    ->with('projectTSNoteViewsList', $projectTopicSectionNoteViewsList)
                    ->with('projectTSNoteUpdatesList', $projectTopicSectionNoteUpdatesList);
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
            $this->projectTSNoteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSNotes = $this->projectTSNoteRepository->all();
    
            return view('project_t_s_notes.index')
                ->with('projectTSNotes', $projectTSNotes);
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
            $projectTSNotesList = ProjectTSNote::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            return view('project_t_s_notes.create')
                ->with('id', $id)
                ->with('projectTSNotesList', $projectTSNotesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $projectTSNote = $this->projectTSNoteRepository->create($input);
            
            DB::table('project_t_s_note_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_t_s_note_id' => $projectTSNote -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTSNote -> name, 'status' => 'active', 'type' => 'p_t_s_n_c', 'user_id' => $user_id, 'entity_id' => $projectTSNote -> id, 'created_at' => $now]);
    
            Flash::success('Project T S Note saved successfully.');
            return redirect(route('projectTopicSections.show', [$projectTSNote -> project_topic_section_id]));
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
            $projectTSNote = $this->projectTSNoteRepository->findWithoutFail($id);
            
            if(empty($projectTSNote))
            {
                Flash::error('Project T S Note not found');
                return redirect(route('projectTSNotes.index'));
            }
            
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('project_t_s_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_t_s_note_id' => $id]);
                DB::table('project_t_s_notes')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
               
                $projectTSNote = $this->projectTSNoteRepository->findWithoutFail($id);
                $projectTopicSectionNoteViews = DB::table('users')->join('project_t_s_note_views', 'users.id', '=', 'project_t_s_note_views.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $projectTopicSectionNoteUpdates = DB::table('users')->join('project_t_s_note_updates', 'users.id', '=', 'project_t_s_note_updates.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $projectTSNoteTodolist = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->join('project_t_s_note_todolists', 'project_t_s_notes.id', '=', 'project_t_s_note_todolists.p_t_s_n_id')->where('project_t_s_note_todolists.p_t_s_n_id', '=', $projectTSNote -> id)->where(function ($query) {$query->where('project_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_note_todolists.status', '=', 'active');})->orderBy('project_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
                $projectTSNoteTodolistCompleted = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->join('project_t_s_note_todolists', 'project_t_s_notes.id', '=', 'project_t_s_note_todolists.p_t_s_n_id')->where('project_t_s_note_todolists.p_t_s_n_id', '=', $projectTSNote -> id)->where(function ($query) {$query->where('project_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('project_t_s_note_todolists.deleted_at', '=', null);})->orderBy('project_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
            
                $projectTSNoteViewsList = DB::table('users')->join('project_t_s_note_views', 'users.id', '=', 'project_t_s_note_views.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSNoteUpdatesList = DB::table('users')->join('project_t_s_note_updates', 'users.id', '=', 'project_t_s_note_updates.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userProjectTSNotesList = DB::table('user_project_t_s_notes')->join('users', 'user_project_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_notes.description', 'permissions', 'user_project_t_s_notes.datetime', 'user_project_t_s_notes.id', 'project_t_s_note_id')->where('project_t_s_note_id', $id)->where(function ($query) {$query->where('user_project_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSNoteTodolistsList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->join('project_t_s_note_todolists', 'project_t_s_notes.id', '=', 'project_t_s_note_todolists.p_t_s_n_id')->where('project_t_s_note_todolists.p_t_s_n_id', '=', $projectTSNote -> id)->where(function ($query) {$query->where('project_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_note_todolists.status', '=', 'active');})->orderBy('project_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $projectTSNoteTodolistsCompletedList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->join('project_t_s_note_todolists', 'project_t_s_notes.id', '=', 'project_t_s_note_todolists.p_t_s_n_id')->where('project_t_s_note_todolists.p_t_s_n_id', '=', $projectTSNote -> id)->where(function ($query) {$query->where('project_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('project_t_s_note_todolists.deleted_at', '=', null);})->orderBy('project_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
            
                $text = '';
            
                return view('project_t_s_notes.show')
                    ->with('projectTSNote', $projectTSNote)
                    ->with('projectTSNoteViews', $projectTopicSectionNoteViews)
                    ->with('projectTSNoteUpdates', $projectTopicSectionNoteUpdates)
                    ->with('projectTSNoteTodolist', $projectTSNoteTodolist)
                    ->with('projectTSNoteTodolistCompleted', $projectTSNoteTodolistCompleted)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('text', $text)
                    ->with('projectTSNoteViewsList', $projectTSNoteViewsList)
                    ->with('projectTSNoteUpdatesList', $projectTSNoteUpdatesList)
                    ->with('userProjectTSNotesList', $userProjectTSNotesList)
                    ->with('projectTSNoteTodolistsList', $projectTSNoteTodolistsList)
                    ->with('projectTSNoteTodolistsCompletedList', $projectTSNoteTodolistsCompletedList);
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
            $projectTSNote = $this->projectTSNoteRepository->findWithoutFail($id);
    
            if(empty($projectTSNote))
            {
                Flash::error('Project T S Note not found');
                return redirect(route('projectTSNotes.index'));
            }
            
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id && $userProjectTSNote -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $projectTSNoteViewsList = DB::table('users')->join('project_t_s_note_views', 'users.id', '=', 'project_t_s_note_views.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSNoteUpdatesList = DB::table('users')->join('project_t_s_note_updates', 'users.id', '=', 'project_t_s_note_updates.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userProjectTSNotesList = DB::table('user_project_t_s_notes')->join('users', 'user_project_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_notes.description', 'permissions', 'user_project_t_s_notes.datetime', 'user_project_t_s_notes.id', 'project_t_s_note_id')->where('project_t_s_note_id', $id)->where(function ($query) {$query->where('user_project_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSNoteTodolistsList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->join('project_t_s_note_todolists', 'project_t_s_notes.id', '=', 'project_t_s_note_todolists.p_t_s_n_id')->where('project_t_s_note_todolists.p_t_s_n_id', '=', $projectTSNote -> id)->where(function ($query) {$query->where('project_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_note_todolists.status', '=', 'active');})->orderBy('project_t_s_note_todolists.datetime', 'desc')->limit(5)->get();
                $projectTSNoteTodolistsCompletedList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->join('project_t_s_note_todolists', 'project_t_s_notes.id', '=', 'project_t_s_note_todolists.p_t_s_n_id')->where('project_t_s_note_todolists.p_t_s_n_id', '=', $projectTSNote -> id)->where(function ($query) {$query->where('project_t_s_note_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('project_t_s_note_todolists.deleted_at', '=', null);})->orderBy('project_t_s_note_todolists.datetime', 'desc')->limit(5)->get();

                return view('project_t_s_notes.edit')
                    ->with('projectTSNote', $projectTSNote)
                    ->with('id', $id)
                    ->with('projectTSNoteViewsList', $projectTSNoteViewsList)
                    ->with('projectTSNoteUpdatesList', $projectTSNoteUpdatesList)
                    ->with('projectTSNoteTodolistsList', $projectTSNoteTodolistsList)
                    ->with('projectTSNoteTodolistsCompletedList', $projectTSNoteTodolistsCompletedList)
                    ->with('userProjectTSNotesList', $userProjectTSNotesList);
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

    public function update($id, UpdateProjectTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $projectTSNote = $this->projectTSNoteRepository->findWithoutFail($id);
    
            if(empty($projectTSNote))
            {
                Flash::error('Project T S Note not found');
                return redirect(route('projectTSNotes.index'));
            }
            
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            $size = 0;
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
                $newProjectTSNote = $this->projectTSNoteRepository->update($request->all(), $id);
                $specific_info_size = strlen($request -> content);
                
                DB::table('project_t_s_notes')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1'), 'specific_info_size' => $specific_info_size]);
                DB::table('project_t_s_note_updates')->insert(['actual_name' => $newProjectTSNote -> name, 'past_name' => $projectTSNote -> name, 'datetime' => $now, 'project_t_s_note_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $projectTSNote -> name, 'status' => 'active', 'type' => 'p_t_s_n_u', 'user_id' => $user_id, 'entity_id' => $projectTSNote -> id, 'created_at' => $now]);
                
                Flash::success('Project T S Note updated successfully.');
                return redirect(route('projectTSNotes.show', [$id]));
            }
            
            else
            {
                if($size > 1073741824)
                {
                    Flash::error('Your storage space is exhausted, you can get more space at only 15 dollars per month.');
                    return redirect(route('projects.index'));
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
            $projectTSNote = $this->projectTSNoteRepository->findWithoutFail($id);
    
            if(empty($projectTSNote))
            {
                Flash::error('Project T S Note not found');
                return redirect(route('projectTSNotes.index'));
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                DB::table('user_project_t_s_notes')->where('project_t_s_note_id', $projectTSNote -> id)->update(['deleted_at' => $now]);
                
                $userProjectTSNote = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $projectTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userProjectTSNote == null)
                {
                    DB::table('user_project_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote[0] -> id]);
                }
                
                $this->projectTSNoteRepository->delete($id);
                
                DB::table('project_t_s_note_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_t_s_note_id' => $projectTSNote -> id]);
                DB::table('recent_activities')->insert(['name' => $projectTSNote -> name, 'status' => 'active', 'type' => 'p_t_s_n_d', 'user_id' => $user_id, 'entity_id' => $projectTSNote -> id, 'created_at' => $now]);
            
                Flash::success('Project T S Note deleted successfully.');
                return redirect(route('projectTopicSections.show', [$projectTSNote -> project_topic_section_id]));
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