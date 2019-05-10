<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicSectionRequest;
use App\Http\Requests\UpdateCollegeTopicSectionRequest;
use App\Repositories\CollegeTopicSectionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\CollegeTopicSection;
use App\Models\CollegeTSFile;
use App\Models\CollegeTSNote;
use App\Models\CollegeTSGalerie;
use App\Models\CollegeTSPlaylist;
use App\Models\CollegeTSTool;
use App\Models\CollegeTopicSectionUpdate;
use Illuminate\Support\Carbon;

class CollegeTopicSectionController extends AppBaseController
{
    private $collegeTopicSectionRepository;

    public function __construct(CollegeTopicSectionRepository $collegeTopicSectionRepo)
    {
        $this->collegeTopicSectionRepository = $collegeTopicSectionRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicSectionRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicSections = $this->collegeTopicSectionRepository->all();

            return view('college_topic_sections.index')
                ->with('collegeTopicSections', $collegeTopicSections);
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
            $collegeTopicSectionsList = CollegeTopicSection::where('college_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            
            $collegeTSFilesList = CollegeTSFile::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $collegeTSNotesList = CollegeTSNote::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $collegeTSGaleriesList = CollegeTSGalerie::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $collegeTSPlaylistsList = CollegeTSPlaylist::where('c_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $collegeTSToolsList = CollegeTSTool::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            $userCollegeTopicSectionsList = DB::table('user_college_topic_sections')->join('users', 'user_college_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_college_topic_sections.description', 'permissions', 'user_college_topic_sections.datetime', 'user_college_topic_sections.id', 'college_topic_section_id')->where('college_topic_section_id', $id)->where(function ($query) {$query->where('user_college_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTopicSectionViewsList = DB::table('users')->join('college_topic_section_views', 'users.id', '=', 'college_topic_section_views.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTopicSectionUpdatesList = DB::table('users')->join('college_topic_section_updates', 'users.id', '=', 'college_topic_section_updates.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

            return view('college_topic_sections.create')
                ->with('id', $id)
                ->with('collegeTopicSectionsList', $collegeTopicSectionsList)
                ->with('userCollegeTopicSectionsList', $userCollegeTopicSectionsList)
                ->with('collegeTopicSectionViewsList', $collegeTopicSectionViewsList)
                ->with('collegeTopicSectionUpdatesList', $collegeTopicSectionUpdatesList)
                ->with('collegeTSFilesList', $collegeTSFilesList)
                ->with('collegeTSNotesList', $collegeTSNotesList)
                ->with('collegeTSGaleriesList', $collegeTSGaleriesList)
                ->with('collegeTSToolsList', $collegeTSToolsList)
                ->with('collegeTSPlaylistsList', $collegeTSPlaylistsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $collegeTopicSection = $this->collegeTopicSectionRepository->create($input);
    
            DB::table('college_topic_section_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_topic_section_id' => $collegeTopicSection -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTopicSection -> name, 'status' => 'active', 'type' => 'c_t_s_c', 'user_id' => $user_id, 'entity_id' => $collegeTopicSection -> id, 'created_at' => $now]);
    
            Flash::success('College Topic Section saved successfully.');
            return redirect(route('collegeTopics.show', [$collegeTopicSection -> college_topic_id]));
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
            $college_file_p = $request -> college_file_p;
            $college_note_p = $request -> college_note_p;
            $college_galery_p = $request -> college_galery_p;
            $college_playlist_p = $request -> college_playlist_p;
            $college_tool_p = $request -> college_tool_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $collegeTopicSection = $this->collegeTopicSectionRepository->findWithoutFail($id);
            
            if(empty($collegeTopicSection))
            {
                Flash::error('College Topic Section not found');
                return redirect(route('collegeTopicSections.index'));
            }
            
            $userCollegeTopicSections = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTopicSections as $userCollegeTopicSection)
            {
                if($userCollegeTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_topic_sections.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('college_topic_section_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_topic_section_id' => $id]);
                DB::table('college_topic_sections')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
                
                $collegeTopicSection = $this->collegeTopicSectionRepository->findWithoutFail($id);
                $collegeTSFiles = CollegeTSFile::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'college_file_p');
                $collegeTSNotes = CollegeTSNote::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'college_note_p');
                $collegeTSGaleries = CollegeTSGalerie::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'college_galery_p');
                $collegeTSPlaylists = CollegeTSPlaylist::where('c_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'college_playlist_p');
                $collegeTSTools = CollegeTSTool::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'college_tool_p');
                $collegeTopicSectionFileCount = DB::table('college_t_s_files')->where('college_topic_section_id', $id)->where(function ($query) {$query->where('college_t_s_files.deleted_at', '=', null);})->count();
                $collegeTopicSectionNoteCount = DB::table('college_t_s_notes')->where('college_topic_section_id', $id)->where(function ($query) {$query->where('college_t_s_notes.deleted_at', '=', null);})->count();
                $collegeTopicSectionGaleryCount = DB::table('college_t_s_galeries')->where('college_topic_section_id', $id)->where(function ($query) {$query->where('college_t_s_galeries.deleted_at', '=', null);})->count();
                $collegeTopicSectionToolCount = DB::table('college_t_s_tools')->where('college_topic_section_id', $id)->where(function ($query) {$query->where('college_t_s_tools.deleted_at', '=', null);})->count();
                $collegeTopicSectionPlaylistCount = DB::table('college_t_s_playlists')->where('c_t_s_id', $id)->where(function ($query) {$query->where('college_t_s_playlists.deleted_at', '=', null);})->count();
                $collegeTopicSectionFileList = DB::table('college_topic_sections')->join('college_t_s_files', 'college_topic_sections.id', '=', 'college_t_s_files.college_topic_section_id')->where('college_topic_section_id' , '=', $id)->orderBy('college_t_s_files.views_quantity', 'desc')->limit(5)->get();
                $collegeTopicSectionNoteList = DB::table('college_topic_sections')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->where('college_topic_section_id' , '=', $id)->orderBy('college_t_s_notes.views_quantity', 'desc')->limit(5)->get();
                $collegeTopicSectionGaleryList = DB::table('college_topic_sections')->join('college_t_s_galeries', 'college_topic_sections.id', '=', 'college_t_s_galeries.college_topic_section_id')->where('college_topic_section_id' , '=', $id)->orderBy('college_t_s_galeries.views_quantity', 'desc')->limit(5)->get();
                $collegeTopicSectionToolList = DB::table('college_topic_sections')->join('college_t_s_tools', 'college_topic_sections.id', '=', 'college_t_s_tools.college_topic_section_id')->where('college_topic_section_id' , '=', $id)->orderBy('college_t_s_tools.views_quantity', 'desc')->limit(5)->get();
                $collegeTopicSectionViews = DB::table('users')->join('college_topic_section_views', 'users.id', '=', 'college_topic_section_views.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeTopicSectionUpdates = DB::table('users')->join('college_topic_section_updates', 'users.id', '=', 'college_topic_section_updates.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeTopicSectionTodolist = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_topic_section_todolists', 'college_topic_sections.id', '=', 'college_topic_section_todolists.c_t_s_id')->where('college_topic_section_todolists.c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('college_topic_section_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_topic_section_todolists.status', '=', 'active');})->orderBy('college_topic_section_todolists.datetime', 'desc')->limit(50)->get();
                $collegeTopicSectionTodolistCompleted = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_topic_section_todolists', 'college_topic_sections.id', '=', 'college_topic_section_todolists.c_t_s_id')->where('college_topic_section_todolists.c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('college_topic_section_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_topic_section_todolists.deleted_at', '=', null);})->orderBy('college_topic_section_todolists.datetime', 'desc')->limit(50)->get();

                $collegeTSFilesList = CollegeTSFile::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSNotesList = CollegeTSNote::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSGaleriesList = CollegeTSGalerie::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSPlaylistsList = CollegeTSPlaylist::where('c_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSToolsList = CollegeTSTool::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

                $collegeTopicSectionTodolistsList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_topic_section_todolists', 'college_topic_sections.id', '=', 'college_topic_section_todolists.c_t_s_id')->where('college_topic_section_todolists.c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('college_topic_section_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_topic_section_todolists.status', '=', 'active');})->orderBy('college_topic_section_todolists.datetime', 'desc')->limit(5)->get();
                $collegeTopicSectionTodolistsCompletedList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_topic_section_todolists', 'college_topic_sections.id', '=', 'college_topic_section_todolists.c_t_s_id')->where('college_topic_section_todolists.c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('college_topic_section_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_topic_section_todolists.deleted_at', '=', null);})->orderBy('college_topic_section_todolists.datetime', 'desc')->limit(5)->get();
                $userCollegeTopicSectionsList = DB::table('user_college_topic_sections')->join('users', 'user_college_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_college_topic_sections.description', 'permissions', 'user_college_topic_sections.datetime', 'user_college_topic_sections.id', 'college_topic_section_id')->where('college_topic_section_id', $id)->where(function ($query) {$query->where('user_college_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTopicSectionViewsList = DB::table('users')->join('college_topic_section_views', 'users.id', '=', 'college_topic_section_views.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTopicSectionUpdatesList = DB::table('users')->join('college_topic_section_updates', 'users.id', '=', 'college_topic_section_updates.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                        
                return view('college_topic_sections.show')
                    ->with('collegeTopicSection', $collegeTopicSection)
                    ->with('collegeTSFiles', $collegeTSFiles)
                    ->with('collegeTSNotes', $collegeTSNotes)
                    ->with('collegeTSGaleries', $collegeTSGaleries)
                    ->with('collegeTSTools', $collegeTSTools)
                    ->with('collegeTSPlaylists', $collegeTSPlaylists)
                    ->with('collegeTopicSectionFileCount', $collegeTopicSectionFileCount)
                    ->with('collegeTopicSectionNoteCount', $collegeTopicSectionNoteCount)
                    ->with('collegeTopicSectionGaleryCount', $collegeTopicSectionGaleryCount)
                    ->with('collegeTopicSectionPlaylistCount', $collegeTopicSectionPlaylistCount)
                    ->with('collegeTopicSectionToolCount', $collegeTopicSectionToolCount)
                    ->with('collegeTopicSectionViews', $collegeTopicSectionViews)
                    ->with('collegeTopicSectionUpdates', $collegeTopicSectionUpdates)
                    ->with('collegeTopicSectionTodolist', $collegeTopicSectionTodolist)
                    ->with('collegeTopicSectionTodolistCompleted', $collegeTopicSectionTodolistCompleted)
                    ->with('college_file_p', $college_file_p)
                    ->with('college_note_p', $college_note_p)
                    ->with('college_galery_p', $college_galery_p)
                    ->with('college_playlist_p', $college_playlist_p)
                    ->with('college_tool_p', $college_tool_p)
                    ->with('user_id', $user_id)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('collegeTopicSectionTodolistsList', $collegeTopicSectionTodolistsList)
                    ->with('collegeTopicSectionTodolistsCompletedList', $collegeTopicSectionTodolistsCompletedList)
                    ->with('userCollegeTopicSectionsList', $userCollegeTopicSectionsList)
                    ->with('collegeTopicSectionViewsList', $collegeTopicSectionViewsList)
                    ->with('collegeTopicSectionUpdatesList', $collegeTopicSectionUpdatesList)
                    ->with('collegeTSFilesList', $collegeTSFilesList)
                    ->with('collegeTSNotesList', $collegeTSNotesList)
                    ->with('collegeTSGaleriesList', $collegeTSGaleriesList)
                    ->with('collegeTSToolsList', $collegeTSToolsList)
                    ->with('collegeTSPlaylistsList', $collegeTSPlaylistsList);
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
            $collegeTopicSection = $this->collegeTopicSectionRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSection))
            {
                Flash::error('College Topic Section not found');
                return redirect(route('collegeTopicSections.index'));
            }
            
            $userCollegeTopicSections = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTopicSections as $userCollegeTopicSection)
            {
                if($userCollegeTopicSection -> user_id == $user_id && $userCollegeTopicSection -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_topic_sections.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $collegeTSFilesList = CollegeTSFile::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSNotesList = CollegeTSNote::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSGaleriesList = CollegeTSGalerie::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSPlaylistsList = CollegeTSPlaylist::where('c_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSToolsList = CollegeTSTool::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

                $collegeTopicSectionTodolistsList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_topic_section_todolists', 'college_topic_sections.id', '=', 'college_topic_section_todolists.c_t_s_id')->where('college_topic_section_todolists.c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('college_topic_section_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_topic_section_todolists.status', '=', 'active');})->orderBy('college_topic_section_todolists.datetime', 'desc')->limit(5)->get();
                $collegeTopicSectionTodolistsCompletedList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_topic_section_todolists', 'college_topic_sections.id', '=', 'college_topic_section_todolists.c_t_s_id')->where('college_topic_section_todolists.c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('college_topic_section_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_topic_section_todolists.deleted_at', '=', null);})->orderBy('college_topic_section_todolists.datetime', 'desc')->limit(5)->get();
                $userCollegeTopicSectionsList = DB::table('user_college_topic_sections')->join('users', 'user_college_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_college_topic_sections.description', 'permissions', 'user_college_topic_sections.datetime', 'user_college_topic_sections.id', 'college_topic_section_id')->where('college_topic_section_id', $id)->where(function ($query) {$query->where('user_college_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTopicSectionViewsList = DB::table('users')->join('college_topic_section_views', 'users.id', '=', 'college_topic_section_views.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTopicSectionUpdatesList = DB::table('users')->join('college_topic_section_updates', 'users.id', '=', 'college_topic_section_updates.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('college_topic_sections.edit')
                    ->with('collegeTopicSection', $collegeTopicSection)
                    ->with('collegeTopicSectionTodolistsList', $collegeTopicSectionTodolistsList)
                    ->with('collegeTopicSectionTodolistsCompletedList', $collegeTopicSectionTodolistsCompletedList)
                    ->with('userCollegeTopicSectionsList', $userCollegeTopicSectionsList)
                    ->with('collegeTopicSectionViewsList', $collegeTopicSectionViewsList)
                    ->with('collegeTopicSectionUpdatesList', $collegeTopicSectionUpdatesList)
                    ->with('collegeTSFilesList', $collegeTSFilesList)
                    ->with('collegeTSNotesList', $collegeTSNotesList)
                    ->with('collegeTSGaleriesList', $collegeTSGaleriesList)
                    ->with('collegeTSToolsList', $collegeTSToolsList)
                    ->with('collegeTSPlaylistsList', $collegeTSPlaylistsList);
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

    public function update($id, UpdateCollegeTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $collegeTopicSection = $this->collegeTopicSectionRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSection))
            {
                Flash::error('College Topic Section not found');
                return redirect(route('collegeTopicSections.index'));
            }
    
            $userCollegeTopicSections = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTopicSections as $userCollegeTopicSection)
            {
                if($userCollegeTopicSection -> user_id == $user_id && $userCollegeTopicSection -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_topic_sections.id', '=', $id)->get();
            
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
                $newCollegeTopicSection = $this->collegeTopicSectionRepository->update($request->all(), $id);
                $specific_info_size = strlen($request -> specific_info);
                
                DB::table('college_topic_sections')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1'), 'specific_info_size' => $specific_info_size]);
                DB::table('college_topic_section_updates')->insert(['actual_name' => $newCollegeTopicSection -> name, 'past_name' => $collegeTopicSection -> name, 'datetime' => $now, 'college_topic_section_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $collegeTopicSection -> name, 'status' => 'active', 'type' => 'c_t_s_u', 'user_id' => $user_id, 'entity_id' => $collegeTopicSection -> id, 'created_at' => $now]);
                
                Flash::success('College Topic Section updated successfully.');
                return redirect(route('collegeTopicSections.show', [$id]));
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
            $collegeTopicSection = $this->collegeTopicSectionRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSection))
            {
                Flash::error('College Topic Section not found');
                return redirect(route('collegeTopicSections.index'));
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_topic_sections.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                DB::table('user_college_topic_sections')->where('college_topic_section_id', $collegeTopicSection -> id)->update(['deleted_at' => $now]);
                
                $userCollegeTopicSection = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userCollegeTopicSection == null)
                {
                    DB::table('user_college_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_id' => $userCollegeTopicSection[0] -> id]);
                }
                
                foreach($collegeTSFiles as $collegeTSFile)
                {
                    DB::table('user_college_t_s_files')->where('college_t_s_file_id', $collegeTSFile -> id)->update(['deleted_at' => $now]);
                    
                    $userCollegeTSFile = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $collegeTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userCollegeTSFile == null)
                    {
                        DB::table('user_college_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile[0] -> id]);
                    }
                }
        
                $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($collegeTSNotes as $collegeTSNote)
                {
                    DB::table('user_college_t_s_notes')->where('college_t_s_note_id', $collegeTSNote -> id)->update(['deleted_at' => $now]);
                    
                    $userCollegeTSNote = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $collegeTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userCollegeTSNote == null)
                    {
                        DB::table('user_college_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote[0] -> id]);
                    }
                }
                        
                $collegeTSGaleries = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($collegeTSGaleries as $collegeTSGalery)
                {
                    $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $collegeTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                    DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', $collegeTSGalery -> id)->update(['deleted_at' => $now]);
                    
                    $userCollegeTSGalery = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $collegeTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userCollegeTSGalery == null)
                    {
                        DB::table('user_college_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalery[0] -> id]);
                    }
        
                    foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                    {
                        DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', $collegeTSGaleryImage -> id)->update(['deleted_at' => $now]);
                        
                        $userCollegeTSGaleryImage = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $collegeTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userCollegeTSGaleryImage == null)
                        {
                            DB::table('user_college_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage[0] -> id]);
                        }
                    }
                }
                        
                $collegeTSPlaylists = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($collegeTSPlaylists as $collegeTSPlaylist)
                {
                    $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                    DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', $collegeTSPlaylist -> id)->update(['deleted_at' => $now]);
                    
                    $userCollegeTSPlaylist = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userCollegeTSPlaylist == null)
                    {
                        DB::table('u_c_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist[0] -> id]);
                    }
                    
                    foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                    {
                        DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', $collegeTSPlaylistAudio -> id)->update(['deleted_at' => $now]);
                        
                        $userCollegeTSPlaylistAudio = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $collegeTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userCollegeTSPlaylistAudio == null)
                        {
                            DB::table('u_c_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPlaylistAudio[0] -> id]);
                        }
                    }
                }
                        
                $collegeTSTools = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($collegeTSTools as $collegeTSTool)
                {
                    $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                    DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', $collegeTSTool -> id)->update(['deleted_at' => $now]);
                    
                    $userCollegeTSTool = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $collegeTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userCollegeTSTool == null)
                    {
                        DB::table('user_college_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool[0] -> id]);
                    }
                    
                    foreach($collegeTSToolFiles as $collegeTSToolFile)
                    {
                        DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', $collegeTSToolFile -> id)->update(['deleted_at' => $now]);
                        
                        $userCollegeTSToolFile = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $collegeTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userCollegeTSToolFile == null)
                        {
                            DB::table('user_college_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile[0] -> id]);
                        }        
                    }
                }
                    
                $this->collegeTopicSectionRepository->delete($id);
                $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                foreach($collegeTSFiles as $collegeTSFile)
                {
                    DB::table('college_t_s_files')->where('id', $collegeTSFile -> id)->update(['deleted_at' => $now]);
                    DB::table('college_t_s_file_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_file_id' => $collegeTSFile -> id]);
                }
        
                $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($collegeTSNotes as $collegeTSNote)
                {
                    DB::table('college_t_s_notes')->where('id', $collegeTSNote -> id)->update(['deleted_at' => $now]);
                    DB::table('college_t_s_note_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_note_id' => $collegeTSNote -> id]);
                }
                        
                $collegeTSGaleries = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($collegeTSGaleries as $collegeTSGalery)
                {
                    $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $collegeTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                    DB::table('college_t_s_galeries')->where('id', $collegeTSGalery -> id)->update(['deleted_at' => $now]);
                    DB::table('college_t_s_galery_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_galery_id' => $collegeTSGalery -> id]);
        
                    foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                    {
                        DB::table('college_t_s_galery_images')->where('id', $collegeTSGaleryImage -> id)->update(['deleted_at' => $now]);
                        DB::table('college_t_s_galery_image_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_g_image_id' => $collegeTSGaleryImage -> id]);
                    }
                }
                        
                $collegeTSPlaylists = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($collegeTSPlaylists as $collegeTSPlaylist)
                {
                    $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                    DB::table('college_t_s_playlists')->where('id', $collegeTSPlaylist -> id)->update(['deleted_at' => $now]);
                    DB::table('college_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_p_id' => $collegeTSPlaylist -> id]);
                            
                    foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                    {
                        DB::table('college_t_s_p_audios')->where('id', $collegeTSPlaylistAudio -> id)->update(['deleted_at' => $now]);
                        DB::table('college_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_p_a_id' => $collegeTSPlaylistAudio -> id]);
                    }
                }
                        
                $collegeTSTools = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                foreach($collegeTSTools as $collegeTSTool)
                {
                    $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                    DB::table('college_t_s_tools')->where('id', $collegeTSTool -> id)->update(['deleted_at' => $now]);
                    DB::table('college_t_s_tool_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_tool_id' => $collegeTSTool -> id]);
                        
                    foreach($collegeTSToolFiles as $collegeTSToolFile)
                    {
                        DB::table('college_t_s_tool_files')->where('id', $collegeTSToolFile -> id)->update(['deleted_at' => $now]);
                        DB::table('college_t_s_tool_file_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_t_file_id' => $collegeTSToolFile -> id]);
                    }
                }
                
                DB::table('college_topic_section_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_topic_section_id' => $collegeTopicSection -> id]);
                DB::table('recent_activities')->insert(['name' => $collegeTopicSection -> name, 'status' => 'active', 'type' => 'c_t_s_d', 'user_id' => $user_id, 'entity_id' => $collegeTopicSection -> id, 'created_at' => $now]);
            
                Flash::success('College Topic Section deleted successfully.');
                return redirect(route('collegeTopics.show', [$collegeTopicSection -> college_topic_id]));
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