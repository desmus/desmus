<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicSectionRequest;
use App\Http\Requests\UpdateJobTopicSectionRequest;
use App\Repositories\JobTopicSectionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\JobTopicSection;
use App\Models\JobTSFile;
use App\Models\JobTSNote;
use App\Models\JobTSGalerie;
use App\Models\JobTSTool;
use App\Models\JobTSPlaylist;
use App\Models\JobTopicSectionUpdate;
use Illuminate\Support\Carbon;

class JobTopicSectionController extends AppBaseController
{
    private $jobTopicSectionRepository;

    public function __construct(JobTopicSectionRepository $jobTopicSectionRepo)
    {
        $this->jobTopicSectionRepository = $jobTopicSectionRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicSectionRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicSections = $this->jobTopicSectionRepository->all();

            return view('job_topic_sections.index')
                ->with('jobTopicSections', $jobTopicSections);
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
            $jobTopicSectionsList = JobTopicSection::where('job_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();

            $jobTSFilesList = JobTSFile::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $jobTSNotesList = JobTSNote::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $jobTSGaleriesList = JobTSGalerie::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $jobTSPlaylistsList = JobTSPlaylist::where('j_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $jobTSToolsList = JobTSTool::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
    
            $userJobTopicSectionsList = DB::table('user_job_topic_sections')->join('users', 'user_job_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_job_topic_sections.description', 'permissions', 'user_job_topic_sections.datetime', 'user_job_topic_sections.id', 'job_topic_section_id')->where('job_topic_section_id', $id)->where(function ($query) {$query->where('user_job_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $jobTopicSectionViewsList = DB::table('users')->join('job_topic_section_views', 'users.id', '=', 'job_topic_section_views.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $jobTopicSectionUpdatesList = DB::table('users')->join('job_topic_section_updates', 'users.id', '=', 'job_topic_section_updates.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

            return view('job_topic_sections.create')
                ->with('id', $id)
                ->with('jobTopicSectionsList', $jobTopicSectionsList)
                ->with('jobTSFilesList', $jobTSFilesList)
                ->with('jobTSNotesList', $jobTSNotesList)
                ->with('jobTSGaleriesList', $jobTSGaleriesList)
                ->with('jobTSToolsList', $jobTSToolsList)
                ->with('jobTSPlaylistsList', $jobTSPlaylistsList)
                ->with('jobTopicSectionViewsList', $jobTopicSectionViewsList)
                ->with('jobTopicSectionUpdatesList', $jobTopicSectionUpdatesList)
                ->with('userJobTopicSectionsList', $userJobTopicSectionsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $jobTopicSection = $this->jobTopicSectionRepository->create($input);
    
            DB::table('job_topic_section_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_topic_section_id' => $jobTopicSection -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTopicSection -> name, 'status' => 'active', 'type' => 'j_t_s_c', 'user_id' => $user_id, 'entity_id' => $jobTopicSection -> id, 'created_at' => $now]);
    
            Flash::success('Job Topic Section saved successfully.');
            return redirect(route('jobTopics.show', [$jobTopicSection -> job_topic_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function show($id, Request $request)
    {
        if(Auth::user() != null)
        {
            $job_file_p = $request -> job_file_p;
            $job_note_p = $request -> job_note_p;
            $job_galery_p = $request -> job_galery_p;
            $job_playlist_p = $request -> job_playlist_p;
            $job_tool_p = $request -> job_tool_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $jobTopicSection = $this->jobTopicSectionRepository->findWithoutFail($id);
            
            if(empty($jobTopicSection))
            {
                Flash::error('Job Topic Section not found');
                return redirect(route('jobTopicSections.index'));
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
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('job_topic_section_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_topic_section_id' => $id]);
                DB::table('job_topic_sections')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
                
                $jobTopicSection = $this->jobTopicSectionRepository->findWithoutFail($id);
                $jobTSFiles = JobTSFile::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'job_file_p');
                $jobTSNotes = JobTSNote::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'job_note_p');
                $jobTSGaleries = JobTSGalerie::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'job_galery_p');
                $jobTSPlaylists = JobTSPlaylist::where('j_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'job_playlist_p');
                $jobTSTools = JobTSTool::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'job_tool_p');
                $jobTopicSectionFileCount = DB::table('job_t_s_files')->where('job_topic_section_id', $id)->where(function ($query) {$query->where('job_t_s_files.deleted_at', '=', null);})->count();
                $jobTopicSectionNoteCount = DB::table('job_t_s_notes')->where('job_topic_section_id', $id)->where(function ($query) {$query->where('job_t_s_notes.deleted_at', '=', null);})->count();
                $jobTopicSectionGaleryCount = DB::table('job_t_s_galeries')->where('job_topic_section_id', $id)->where(function ($query) {$query->where('job_t_s_galeries.deleted_at', '=', null);})->count();
                $jobTopicSectionToolCount = DB::table('job_t_s_tools')->where('job_topic_section_id', $id)->where(function ($query) {$query->where('job_t_s_tools.deleted_at', '=', null);})->count();
                $jobTopicSectionPlaylistCount = DB::table('job_t_s_playlists')->where('j_t_s_id', $id)->where(function ($query) {$query->where('job_t_s_playlists.deleted_at', '=', null);})->count();
                $jobTopicSectionFileList = DB::table('job_topic_sections')->join('job_t_s_files', 'job_topic_sections.id', '=', 'job_t_s_files.job_topic_section_id')->where('job_topic_section_id' , '=', $id)->orderBy('job_t_s_files.views_quantity', 'desc')->limit(5)->get();
                $jobTopicSectionNoteList = DB::table('job_topic_sections')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->where('job_topic_section_id' , '=', $id)->orderBy('job_t_s_notes.views_quantity', 'desc')->limit(5)->get();
                $jobTopicSectionGaleryList = DB::table('job_topic_sections')->join('job_t_s_galeries', 'job_topic_sections.id', '=', 'job_t_s_galeries.job_topic_section_id')->where('job_topic_section_id' , '=', $id)->orderBy('job_t_s_galeries.views_quantity', 'desc')->limit(5)->get();
                $jobTopicSectionToolList = DB::table('job_topic_sections')->join('job_t_s_tools', 'job_topic_sections.id', '=', 'job_t_s_tools.job_topic_section_id')->where('job_topic_section_id' , '=', $id)->orderBy('job_t_s_tools.views_quantity', 'desc')->limit(5)->get();
                $jobTopicSectionViews = DB::table('users')->join('job_topic_section_views', 'users.id', '=', 'job_topic_section_views.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $jobTopicSectionUpdates = DB::table('users')->join('job_topic_section_updates', 'users.id', '=', 'job_topic_section_updates.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $jobTopicSectionTodolist = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_topic_section_todolists', 'job_topic_sections.id', '=', 'job_topic_section_todolists.j_t_s_id')->where('job_topic_section_todolists.j_t_s_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('job_topic_section_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_topic_section_todolists.status', '=', 'active');})->orderBy('job_topic_section_todolists.datetime', 'desc')->limit(50)->get();
                $jobTopicSectionTodolistCompleted = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_topic_section_todolists', 'job_topic_sections.id', '=', 'job_topic_section_todolists.j_t_s_id')->where('job_topic_section_todolists.j_t_s_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('job_topic_section_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_topic_section_todolists.deleted_at', '=', null);})->orderBy('job_topic_section_todolists.datetime', 'desc')->limit(50)->get();
        
                $jobTSFilesList = JobTSFile::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSNotesList = JobTSNote::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSGaleriesList = JobTSGalerie::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSPlaylistsList = JobTSPlaylist::where('j_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSToolsList = JobTSTool::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
    
                $jobTopicSectionTodolistsList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_topic_section_todolists', 'job_topic_sections.id', '=', 'job_topic_section_todolists.j_t_s_id')->where('job_topic_section_todolists.j_t_s_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('job_topic_section_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_topic_section_todolists.status', '=', 'active');})->orderBy('job_topic_section_todolists.datetime', 'desc')->limit(5)->get();
                $jobTopicSectionTodolistsCompletedList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_topic_section_todolists', 'job_topic_sections.id', '=', 'job_topic_section_todolists.j_t_s_id')->where('job_topic_section_todolists.j_t_s_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('job_topic_section_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_topic_section_todolists.deleted_at', '=', null);})->orderBy('job_topic_section_todolists.datetime', 'desc')->limit(5)->get();
                $userJobTopicSectionsList = DB::table('user_job_topic_sections')->join('users', 'user_job_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_job_topic_sections.description', 'permissions', 'user_job_topic_sections.datetime', 'user_job_topic_sections.id', 'job_topic_section_id')->where('job_topic_section_id', $id)->where(function ($query) {$query->where('user_job_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTopicSectionViewsList = DB::table('users')->join('job_topic_section_views', 'users.id', '=', 'job_topic_section_views.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTopicSectionUpdatesList = DB::table('users')->join('job_topic_section_updates', 'users.id', '=', 'job_topic_section_updates.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                        
                return view('job_topic_sections.show')
                    ->with('jobTopicSection', $jobTopicSection)
                    ->with('jobTSFiles', $jobTSFiles)
                    ->with('jobTSNotes', $jobTSNotes)
                    ->with('jobTSGaleries', $jobTSGaleries)
                    ->with('jobTSTools', $jobTSTools)
                    ->with('jobTSPlaylists', $jobTSPlaylists)
                    ->with('jobTopicSectionFileCount', $jobTopicSectionFileCount)
                    ->with('jobTopicSectionNoteCount', $jobTopicSectionNoteCount)
                    ->with('jobTopicSectionGaleryCount', $jobTopicSectionGaleryCount)
                    ->with('jobTopicSectionToolCount', $jobTopicSectionToolCount)
                    ->with('jobTopicSectionPlaylistCount', $jobTopicSectionPlaylistCount)
                    ->with('jobTopicSectionViews', $jobTopicSectionViews)
                    ->with('jobTopicSectionUpdates', $jobTopicSectionUpdates)
                    ->with('jobTopicSectionTodolist', $jobTopicSectionTodolist)
                    ->with('jobTopicSectionTodolistCompleted', $jobTopicSectionTodolistCompleted)
                    ->with('job_file_p', $job_file_p)
                    ->with('job_note_p', $job_note_p)
                    ->with('job_galery_p', $job_galery_p)
                    ->with('job_playlist_p', $job_playlist_p)
                    ->with('job_tool_p', $job_tool_p)
                    ->with('user_id', $user_id)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('jobTSFilesList', $jobTSFilesList)
                    ->with('jobTSNotesList', $jobTSNotesList)
                    ->with('jobTSGaleriesList', $jobTSGaleriesList)
                    ->with('jobTSToolsList', $jobTSToolsList)
                    ->with('jobTSPlaylistsList', $jobTSPlaylistsList)
                    ->with('jobTopicSectionViewsList', $jobTopicSectionViewsList)
                    ->with('jobTopicSectionUpdatesList', $jobTopicSectionUpdatesList)
                    ->with('jobTopicSectionTodolistsList', $jobTopicSectionTodolistsList)
                    ->with('jobTopicSectionTodolistsCompletedList', $jobTopicSectionTodolistsCompletedList)
                    ->with('userJobTopicSectionsList', $userJobTopicSectionsList);
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
            $jobTopicSection = $this->jobTopicSectionRepository->findWithoutFail($id);
    
            if(empty($jobTopicSection))
            {
                Flash::error('Job Topic Section not found');
                return redirect(route('jobTopicSections.index'));
            }
            
            $userJobTopicSections = DB::table('user_job_topic_sections')->where('job_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTopicSections as $userJobTopicSection)
            {
                if($userJobTopicSection -> user_id == $user_id && $userJobTopicSection -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_topic_sections.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $jobTSFilesList = JobTSFile::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSNotesList = JobTSNote::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSGaleriesList = JobTSGalerie::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSPlaylistsList = JobTSPlaylist::where('j_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSToolsList = JobTSTool::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
    
                $jobTopicSectionViewsList = DB::table('users')->join('job_topic_section_views', 'users.id', '=', 'job_topic_section_views.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTopicSectionUpdatesList = DB::table('users')->join('job_topic_section_updates', 'users.id', '=', 'job_topic_section_updates.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userJobTopicSectionsList = DB::table('user_job_topic_sections')->join('users', 'user_job_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_job_topic_sections.description', 'permissions', 'user_job_topic_sections.datetime', 'user_job_topic_sections.id', 'job_topic_section_id')->where('job_topic_section_id', $id)->where(function ($query) {$query->where('user_job_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTopicSectionTodolistsList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_topic_section_todolists', 'job_topic_sections.id', '=', 'job_topic_section_todolists.j_t_s_id')->where('job_topic_section_todolists.j_t_s_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('job_topic_section_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_topic_section_todolists.status', '=', 'active');})->orderBy('job_topic_section_todolists.datetime', 'desc')->limit(5)->get();
                $jobTopicSectionTodolistsCompletedList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_topic_section_todolists', 'job_topic_sections.id', '=', 'job_topic_section_todolists.j_t_s_id')->where('job_topic_section_todolists.j_t_s_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('job_topic_section_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_topic_section_todolists.deleted_at', '=', null);})->orderBy('job_topic_section_todolists.datetime', 'desc')->limit(5)->get();

                return view('job_topic_sections.edit')
                    ->with('jobTopicSection', $jobTopicSection)
                    ->with('jobTSFilesList', $jobTSFilesList)
                    ->with('jobTSNotesList', $jobTSNotesList)
                    ->with('jobTSGaleriesList', $jobTSGaleriesList)
                    ->with('jobTSToolsList', $jobTSToolsList)
                    ->with('jobTSPlaylistsList', $jobTSPlaylistsList)
                    ->with('jobTopicSectionViewsList', $jobTopicSectionViewsList)
                    ->with('jobTopicSectionUpdatesList', $jobTopicSectionUpdatesList)
                    ->with('userJobTopicSectionsList', $userJobTopicSectionsList)
                    ->with('jobTopicSectionTodolistsList', $jobTopicSectionTodolistsList)
                    ->with('jobTopicSectionTodolistsCompletedList', $jobTopicSectionTodolistsCompletedList);
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

    public function update($id, UpdateJobTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $jobTopicSection = $this->jobTopicSectionRepository->findWithoutFail($id);
    
            if(empty($jobTopicSection))
            {
                Flash::error('Job Topic Section not found');
                return redirect(route('jobTopicSections.index'));
            }
    
            $userJobTopicSections = DB::table('user_job_topic_sections')->where('job_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTopicSections as $userJobTopicSection)
            {
                if($userJobTopicSection -> user_id == $user_id && $userJobTopicSection -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_topic_sections.id', '=', $id)->get();
            
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
                $newJobTopicSection = $this->jobTopicSectionRepository->update($request->all(), $id);
                $specific_info_size = strlen($request -> specific_info);
                
                DB::table('job_topic_sections')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1'), 'specific_info_size' => $specific_info_size]);
                DB::table('job_topic_section_updates')->insert(['actual_name' => $newJobTopicSection -> name, 'past_name' => $jobTopicSection -> name, 'datetime' => $now, 'job_topic_section_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $jobTopicSection -> name, 'status' => 'active', 'type' => 'j_t_s_u', 'user_id' => $user_id, 'entity_id' => $jobTopicSection -> id, 'created_at' => $now]);
                
                Flash::success('Job Topic Section updated successfully.');
                return redirect(route('jobTopicSections.show', [$id]));
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
            $jobTopicSection = $this->jobTopicSectionRepository->findWithoutFail($id);
    
            if (empty($jobTopicSection))
            {
                Flash::error('Job Topic Section not found');
                return redirect(route('jobTopicSections.index'));
            }
            
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_topic_sections.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $jobTSFiles = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                DB::table('user_job_topic_sections')->where('job_topic_section_id', $jobTopicSection -> id)->update(['deleted_at' => $now]);
                
                $userJobTopicSection = DB::table('user_job_topic_sections')->where('job_topic_section_id', '=', $jobTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userJobTopicSection == null)
                {
                    DB::table('user_job_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_id' => $userJobTopicSection[0] -> id]);
                }
                
                foreach($jobTSFiles as $jobTSFile)
                {
                    DB::table('user_job_t_s_files')->where('job_t_s_file_id', $jobTSFile -> id)->update(['deleted_at' => $now]);
                    
                    $userJobTSFile = DB::table('user_job_t_s_files')->where('job_t_s_file_id', '=', $jobTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userJobTSFile == null)
                    {
                        DB::table('user_job_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_f_id' => $userJobTSFile[0] -> id]);
                    }
                }
        
                $jobTSNotes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($jobTSNotes as $jobTSNote)
                {
                    DB::table('user_job_t_s_notes')->where('job_t_s_note_id', $jobTSNote -> id)->update(['deleted_at' => $now]);
                    
                    $userJobTSNote = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $jobTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userJobTSNote == null)
                    {
                        DB::table('user_job_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_n_id' => $userJobTSNote[0] -> id]);
                    }
                }
                        
                $jobTSGaleries = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($jobTSGaleries as $jobTSGalery)
                {
                    $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $jobTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                    DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', $jobTSGalery -> id)->update(['deleted_at' => $now]);
                    
                    $userJobTSGalery = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $jobTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userJobTSGalery == null)
                    {
                        DB::table('user_job_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_id' => $userJobTSGalery[0] -> id]);
                    }
        
                    foreach($jobTSGaleryImages as $jobTSGaleryImage)
                    {
                        DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', $jobTSGaleryImage -> id)->update(['deleted_at' => $now]);
                        
                        $userJobTSGaleryImage = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $jobTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userJobTSGaleryImage == null)
                        {
                            DB::table('user_job_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage[0] -> id]);
                        }
                    }
                }
                        
                $jobTSPlaylists = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($jobTSPlaylists as $jobTSPlaylist)
                {
                    $jobTSPlaylistAudios = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                    DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', $jobTSPlaylist -> id)->update(['deleted_at' => $now]);
                    
                    $userJobTSPlaylist = DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userJobTSPlaylist == null)
                    {
                        DB::table('u_j_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_id' => $userJobTSPlaylist[0] -> id]);
                    }
                    
                    foreach($jobTSPlaylistAudios as $jobTSPlaylistAudio)
                    {
                        DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', $jobTSPlaylistAudio -> id)->update(['deleted_at' => $now]);
                        
                        $userJobTSPlaylistAudio = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $jobTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userJobTSPlaylistAudio == null)
                        {
                            DB::table('u_j_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPlaylistAudio[0] -> id]);
                        }
                    }
                }
                        
                $jobTSTools = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($jobTSTools as $jobTSTool)
                {
                    $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                    DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', $jobTSTool -> id)->update(['deleted_at' => $now]);
                    
                    $userJobTSTool = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $jobTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userJobTSTool == null)
                    {
                        DB::table('user_job_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_id' => $userJobTSTool[0] -> id]);
                    }
                    
                    foreach($jobTSToolFiles as $jobTSToolFile)
                    {
                        DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', $jobTSToolFile -> id)->update(['deleted_at' => $now]);
                        
                        $userJobTSToolFile = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $jobTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userJobTSToolFile == null)
                        {
                            DB::table('user_job_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile[0] -> id]);
                        }
                    }
                }
                    
                $this->jobTopicSectionRepository->delete($id);
                $jobTSFiles = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                foreach($jobTSFiles as $jobTSFile)
                {
                    DB::table('job_t_s_files')->where('id', $jobTSFile -> id)->update(['deleted_at' => $now]);
                    DB::table('job_t_s_file_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_file_id' => $jobTSFile -> id]);
                }
        
                $jobTSNotes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($jobTSNotes as $jobTSNote)
                {
                    DB::table('job_t_s_notes')->where('id', $jobTSNote -> id)->update(['deleted_at' => $now]);
                    DB::table('job_t_s_note_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_note_id' => $jobTSNote -> id]);
                }
                        
                $jobTSGaleries = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($jobTSGaleries as $jobTSGalery)
                {
                    $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $jobTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                    DB::table('job_t_s_galeries')->where('id', $jobTSGalery -> id)->update(['deleted_at' => $now]);
                    DB::table('job_t_s_galery_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_galery_id' => $jobTSGalery -> id]);
        
                    foreach($jobTSGaleryImages as $jobTSGaleryImage)
                    {
                        DB::table('job_t_s_galery_images')->where('id', $jobTSGaleryImage -> id)->update(['deleted_at' => $now]);
                        DB::table('job_t_s_galery_image_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_g_image_id' => $jobTSGaleryImage -> id]);
                    }
                }
                        
                $jobTSPlaylists = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($jobTSPlaylists as $jobTSPlaylist)
                {
                    $jobTSPlaylistAudios = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                    DB::table('job_t_s_playlists')->where('id', $jobTSPlaylist -> id)->update(['deleted_at' => $now]);
                    DB::table('job_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_p_id' => $jobTSPlaylist -> id]);
                            
                    foreach($jobTSPlaylistAudios as $jobTSPlaylistAudio)
                    {
                        DB::table('job_t_s_p_audios')->where('id', $jobTSPlaylistAudio -> id)->update(['deleted_at' => $now]);
                        DB::table('job_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_p_a_id' => $jobTSPlaylistAudio -> id]);
                    }
                }
                        
                $jobTSTools = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($jobTSTools as $jobTSTool)
                {
                    $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                    DB::table('job_t_s_tools')->where('id', $jobTSTool -> id)->update(['deleted_at' => $now]);
                    DB::table('job_t_s_tool_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_tool_id' => $jobTSTool -> id]);
                        
                    foreach($jobTSToolFiles as $jobTSToolFile)
                    {
                        DB::table('job_t_s_tool_files')->where('id', $jobTSToolFile -> id)->update(['deleted_at' => $now]);
                        DB::table('job_t_s_tool_file_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_t_file_id' => $jobTSToolFile -> id]);
                    }
                }
                
                DB::table('job_topic_section_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_topic_section_id' => $jobTopicSection -> id]);
                DB::table('recent_activities')->insert(['name' => $jobTopicSection -> name, 'status' => 'active', 'type' => 'j_t_s_d', 'user_id' => $user_id, 'entity_id' => $jobTopicSection -> id, 'created_at' => $now]);
            
                Flash::success('Job Topic Section deleted successfully.');
                return redirect(route('jobTopics.show', [$jobTopicSection -> job_topic_id]));
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