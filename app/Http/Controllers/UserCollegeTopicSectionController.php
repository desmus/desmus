<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCollegeTopicSectionRequest;
use App\Http\Requests\UpdateUserCollegeTopicSectionRequest;
use App\Repositories\UserCollegeTopicSectionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CollegeTSFile;
use App\Models\CollegeTSNote;
use App\Models\CollegeTSGalerie;
use App\Models\CollegeTSPlaylist;
use App\Models\CollegeTSTool;

class UserCollegeTopicSectionController extends AppBaseController
{
    private $userCollegeTopicSectionRepository;

    public function __construct(UserCollegeTopicSectionRepository $userCollegeTopicSectionRepo)
    {
        $this->userCollegeTopicSectionRepository = $userCollegeTopicSectionRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTopicSectionRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTopicSections = $this->userCollegeTopicSectionRepository->all();
    
            return view('user_college_topic_sections.index')
                ->with('userCollegeTopicSections', $userCollegeTopicSections);
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $users = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->select('name', 'contacts.user_id', 'users.id')->where('contacts.user_id', '=', $user_id)->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->orderBy('name', 'asc')->get();
            $select = [];
                
            foreach($users as $user)
            {
                $select[$user->id] = $user->name;
            }
            
            $collegeTSFilesList = CollegeTSFile::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $collegeTSNotesList = CollegeTSNote::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $collegeTSGaleriesList = CollegeTSGalerie::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $collegeTSPlaylistsList = CollegeTSPlaylist::where('c_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $collegeTSToolsList = CollegeTSTool::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            $userCollegeTopicSectionsList = DB::table('user_college_topic_sections')->join('users', 'user_college_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_college_topic_sections.description', 'permissions', 'user_college_topic_sections.datetime', 'user_college_topic_sections.id', 'college_topic_section_id')->where('college_topic_section_id', $id)->where(function ($query) {$query->where('user_college_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTopicSectionViewsList = DB::table('users')->join('college_topic_section_views', 'users.id', '=', 'college_topic_section_views.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTopicSectionUpdatesList = DB::table('users')->join('college_topic_section_updates', 'users.id', '=', 'college_topic_section_updates.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_college_topic_sections.create', compact('select'))->with('id', $id)
                ->with('now', $now)
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

    public function store(CreateUserCollegeTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_topic_sections.id', '=', $request -> college_topic_section_id)->get();
            
            $userCollegeTopicSectionCheck = DB::table('user_college_topic_sections')->where('user_id', '=', $request -> user_id)->where('college_topic_section_id', '=', $request -> college_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userCollegeTopicSectionCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userCollegeTopicSection = $this->userCollegeTopicSectionRepository->create($input);
                    $collegeTopicSection = DB::table('college_topic_sections')->where('id', '=', $userCollegeTopicSection -> college_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $userCollegeTopicSection -> college_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_college_topic_section_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_id' => $userCollegeTopicSection -> id]);
                    
                    foreach($collegeTSFiles as $collegeTSFile)
                    {
                        DB::table('user_college_t_s_files')->insert(['datetime' => $now, 'user_id' => $userCollegeTopicSection -> user_id, 'description' => $userCollegeTopicSection -> description, 'college_t_s_file_id' => $collegeTSFile -> id]);
                                        
                        $userCollegeTSFile = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $collegeTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userCollegeTSFile[0]))
                        {
                            DB::table('user_college_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile[0] -> id]);
                        }
                    }
                    
                    $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($collegeTSNotes as $collegeTSNote)
                    {
                        DB::table('user_college_t_s_notes')->insert(['datetime' => $now, 'user_id' => $userCollegeTopicSection -> user_id, 'description' => $userCollegeTopicSection -> description, 'college_t_s_note_id' => $collegeTSNote -> id]);
                                        
                        $userCollegeTSNote = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $collegeTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userCollegeTSNote[0]))
                        {
                            DB::table('user_college_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote[0] -> id]);
                        }
                    }
                                        
                    $collegeTSGaleries = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($collegeTSGaleries as $collegeTSGalery)
                    {
                        DB::table('user_college_t_s_galeries')->insert(['datetime' => $now, 'user_id' => $userCollegeTopicSection -> user_id, 'description' => $userCollegeTopicSection -> description, 'college_t_s_galery_id' => $collegeTSGalery -> id]);
                                        
                        $userCollegeTSGalery = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $collegeTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userCollegeTSGalery[0]))
                        {
                            DB::table('user_college_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalery[0] -> id]);
                    
                            $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $collegeTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                            {
                                DB::table('user_college_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userCollegeTopicSection -> user_id, 'description' => $userCollegeTopicSection -> description, 'college_t_s_g_image_id' => $collegeTSGaleryImage -> id]);
                                                
                                $userCollegeTSGaleryImage = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $collegeTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userCollegeTSGalery[0]))
                                {
                                    DB::table('user_college_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage[0] -> id]);
                                }        
                            }
                        }
                    }
                                    
                    $collegeTSPlaylists = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($collegeTSPlaylists as $collegeTSPlaylist)
                    {
                        DB::table('user_college_t_s_playlists')->insert(['datetime' => $now, 'user_id' => $userCollegeTopicSection -> user_id, 'description' => $userCollegeTopicSection -> description, 'c_t_s_p_id' => $collegeTSPlaylist -> id]);
                                        
                        $userCollegeTSPlaylist = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userCollegeTSPlaylist[0]))
                        {
                            DB::table('u_c_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist[0] -> id]);
                        }
                                        
                        $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                        
                        foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                        {
                            DB::table('user_college_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userCollegeTopicSection -> user_id, 'description' => $userCollegeTopicSection -> description, 'c_t_s_p_a_id' => $collegeTSPlaylistAudio -> id]);
                                           
                            $userCollegeTSPlaylistAudio = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $collegeTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userCollegeTSPlaylistAudio[0]))
                            {
                                DB::table('u_c_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPlaylistAudio[0] -> id]);
                            }
                        }
                    }
                                    
                    $collegeTSTools = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($collegeTSTools as $collegeTSTool)
                    {
                        DB::table('user_college_t_s_tools')->insert(['datetime' => $now, 'user_id' => $userCollegeTopicSection -> user_id, 'description' => $userCollegeTopicSection -> description, 'college_t_s_tool_id' => $collegeTSTool -> id]);
                                        
                        $userCollegeTSTool = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $collegeTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userCollegeTSTool[0]))
                        {
                            DB::table('user_college_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool[0] -> id]);
                                            
                            $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($collegeTSToolFiles as $collegeTSToolFile)
                            {
                                DB::table('user_college_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userCollegeTopicSection -> user_id, 'description' => $userCollegeTopicSection -> description, 'college_t_s_t_file_id' => $collegeTSToolFile -> id]);
                                                
                                $userCollegeTSToolFile = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $collegeTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userCollegeTSToolFile[0]))
                                {
                                    DB::table('user_college_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile[0] -> id]);
                                }
                            }
                        }
                    }
                    
                    $user = DB::table('user_college_topic_sections')->join('users', 'users.id', '=', 'user_college_topic_sections.user_id')->where('user_college_topic_sections.id', '=', $userCollegeTopicSection -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_c', 'user_id' => $user_id, 'entity_id' => $userCollegeTopicSection -> college_topic_section_id, 'created_at' => $now]);
                
                    Flash::success('User College Topic Section saved successfully.');
                    return redirect(route('userCollegeTopicSections.show', [$userCollegeTopicSection -> college_topic_section_id]));
                }
            
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userCollegeTopicSections.show', [$request -> college_topic_section_id]));
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
            $userCollegeTopicSection = $this->userCollegeTopicSectionRepository->findWithoutFail($id);
            $userCollegeTopicSections = DB::table('user_college_topic_sections')->join('users', 'user_college_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_college_topic_sections.description', 'permissions', 'user_college_topic_sections.datetime', 'user_college_topic_sections.id', 'college_topic_section_id')->where('college_topic_section_id', $id)->where(function ($query) {$query->where('user_college_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            if(empty($userCollegeTopicSections[0]))
            {
                Flash::error('User College Topic Section not found');
                return redirect(route('userCollegeTopicSections.create', [$id]));
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_topic_sections.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTopicSection = DB::table('college_topic_sections')->where('id', '=', $userCollegeTopicSections[0] -> college_topic_section_id)->get();
    
                $collegeTSFilesList = CollegeTSFile::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSNotesList = CollegeTSNote::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSGaleriesList = CollegeTSGalerie::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSPlaylistsList = CollegeTSPlaylist::where('c_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSToolsList = CollegeTSTool::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
    
                $userCollegeTopicSectionsList = DB::table('user_college_topic_sections')->join('users', 'user_college_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_college_topic_sections.description', 'permissions', 'user_college_topic_sections.datetime', 'user_college_topic_sections.id', 'college_topic_section_id')->where('college_topic_section_id', $id)->where(function ($query) {$query->where('user_college_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTopicSectionViewsList = DB::table('users')->join('college_topic_section_views', 'users.id', '=', 'college_topic_section_views.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTopicSectionUpdatesList = DB::table('users')->join('college_topic_section_updates', 'users.id', '=', 'college_topic_section_updates.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_college_topic_sections.show')
                    ->with('userCollegeTopicSections', $userCollegeTopicSections)
                    ->with('id', $id)
                    ->with('collegeTopicSection', $collegeTopicSection)
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
            $userCollegeTopicSection = DB::table('users')->join('user_college_topic_sections', 'user_college_topic_sections.user_id', '=', 'users.id')->where('user_college_topic_sections.id', $id)->where(function ($query) {$query->where('user_college_topic_sections.deleted_at', '=', null);})->get();
            
            if(empty($userCollegeTopicSection[0]))
            {
                Flash::error('User College Topic Section not found');
                return redirect(route('userCollegeTopicSections.index'));
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_topic_sections.id', '=', $userCollegeTopicSection[0] -> college_topic_section_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $collegeTSFilesList = CollegeTSFile::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSNotesList = CollegeTSNote::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSGaleriesList = CollegeTSGalerie::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSPlaylistsList = CollegeTSPlaylist::where('c_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $collegeTSToolsList = CollegeTSTool::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
    
                $userCollegeTopicSectionsList = DB::table('user_college_topic_sections')->join('users', 'user_college_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_college_topic_sections.description', 'permissions', 'user_college_topic_sections.datetime', 'user_college_topic_sections.id', 'college_topic_section_id')->where('college_topic_section_id', $id)->where(function ($query) {$query->where('user_college_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTopicSectionViewsList = DB::table('users')->join('college_topic_section_views', 'users.id', '=', 'college_topic_section_views.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTopicSectionUpdatesList = DB::table('users')->join('college_topic_section_updates', 'users.id', '=', 'college_topic_section_updates.user_id')->where('college_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_college_topic_sections.edit')
                    ->with('userCollegeTopicSection', $userCollegeTopicSection)
                    ->with('id', $userCollegeTopicSection[0] -> college_topic_section_id)
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

    public function update($id, UpdateUserCollegeTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userCollegeTopicSection = $this->userCollegeTopicSectionRepository->findWithoutFail($id);
            
            if(empty($userCollegeTopicSection))
            {
                Flash::error('User College Topic Section not found');
                return redirect(route('userCollegeTopicSections.index'));
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_topic_sections.id', '=', $userCollegeTopicSection -> college_topic_section_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollegeTopicSection -> user_id;
                $userCollegeTopicSection = $this->userCollegeTopicSectionRepository->update($request->all(), $id);
                $collegeTopicSection = DB::table('college_topic_sections')->where('id', '=', $userCollegeTopicSection -> college_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $userCollegeTopicSection -> college_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_college_topic_section_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_id' => $userCollegeTopicSection -> id]);
        
                foreach($collegeTSFiles as $collegeTSFile)
                {
                    DB::table('user_college_t_s_files')->where('college_t_s_file_id', $collegeTSFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopicSection -> permissions]);
                                    
                    $userCollegeTSFile = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $collegeTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                             
                    if(isset($userCollegeTSFile[0]))
                    {
                        DB::table('user_college_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile[0] -> id]);
                    }
                }
                
                $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($collegeTSNotes as $collegeTSNote)
                {
                    DB::table('user_college_t_s_notes')->where('college_t_s_note_id', $collegeTSNote -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopicSection -> permissions]);
                                    
                    $userCollegeTSNote = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $collegeTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userCollegeTSNote[0]))
                    {
                        DB::table('user_college_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote[0] -> id]);
                    }
                }
                                
                $collegeTSGaleries = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($collegeTSGaleries as $collegeTSGalery)
                {
                    $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $collegeTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', $collegeTSGalery -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopicSection -> permissions]);
                                    
                    $userCollegeTSGalery = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $collegeTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userCollegeTSGalery[0]))
                    {
                        DB::table('user_college_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalery[0] -> id]);
                    
                        foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                        {
                            DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', $collegeTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopicSection -> permissions]);
                                            
                            $userCollegeTSGaleryImage = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $collegeTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userCollegeTSGaleryImage[0]))
                            {
                                DB::table('user_college_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage[0] -> id]);
                            }
                        }
                    }
                }
                                
                $collegeTSPlaylists = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($collegeTSPlaylists as $collegeTSPlaylist)
                {
                    $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', $collegeTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopicSection -> permissions]);
                                    
                    $userCollegeTSPlaylist = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userCollegeTSPlaylist[0]))
                    {
                        DB::table('u_c_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist[0] -> id]);
                    
                        foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                        {
                            DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', $collegeTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopicSection -> permissions]);
                                            
                            $userCollegeTSPlaylistAudio = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $collegeTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userCollegeTSPlaylistAudio[0]))
                            {
                                DB::table('u_c_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPlaylistAudio[0] -> id]);
                            }
                        }
                    }
                }
                                
                $collegeTSTools = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($collegeTSTools as $collegeTSTool)
                {
                    $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', $collegeTSTool -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopicSection -> permissions]);
                                    
                    $userCollegeTSTool = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $collegeTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userCollegeTSTool[0]))
                    {
                        DB::table('user_college_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool[0] -> id]);
                                    
                        foreach($collegeTSToolFiles as $collegeTSToolFile)
                        {
                            DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', $collegeTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopicSection -> permissions]);
                                            
                            $userCollegeTSToolFile = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $collegeTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userCollegeTSToolFile[0]))
                            {
                                DB::table('user_college_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile[0] -> id]);
                            }
                        }
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_topic_sections')->join('users', 'users.id', '=', 'user_college_topic_sections.user_id')->where('user_college_topic_sections.id', '=', $userCollegeTopicSection -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_u', 'user_id' => $user_id, 'entity_id' => $userCollegeTopicSection -> college_topic_section_id, 'created_at' => $now]);
            
                Flash::success('User College Topic Section updated successfully.');
                return redirect(route('userCollegeTopicSections.show', [$userCollegeTopicSection -> college_topic_section_id]));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userCollegeTopicSection = $this->userCollegeTopicSectionRepository->findWithoutFail($id);
            
            if(empty($userCollegeTopicSection))
            {
                Flash::error('User College Topic Section not found');
                return redirect(route('userCollegeTopicSections.index'));
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_topic_sections.id', '=', $userCollegeTopicSection -> college_topic_section_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollegeTopicSection -> user_id;
                $collegeTopicSection = DB::table('college_topic_sections')->where('id', '=', $userCollegeTopicSection -> college_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $userCollegeTopicSection -> college_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_college_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_id' => $userCollegeTopicSection -> id]);
        
                foreach($collegeTSFiles as $collegeTSFile)
                {
                    DB::table('user_college_t_s_files')->where('college_t_s_file_id', $collegeTSFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                    $userCollegeTSFile = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $collegeTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userCollegeTSFile[0]))
                    {
                        DB::table('user_college_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile[0] -> id]);
                    }
                }
                
                $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($collegeTSNotes as $collegeTSNote)
                {
                    DB::table('user_college_t_s_notes')->where('college_t_s_note_id', $collegeTSNote -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                   
                    $userCollegeTSNote = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $collegeTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userCollegeTSNote[0]))
                    {
                        DB::table('user_college_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote[0] -> id]);
                    }
                }
                                
                $collegeTSGaleries = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($collegeTSGaleries as $collegeTSGalery)
                {
                    $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $collegeTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', $collegeTSGalery -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                    $userCollegeTSGalery = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $collegeTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userCollegeTSGalery[0]))
                    {
                        DB::table('user_college_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalery[0] -> id]);
                    
                        foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                        {
                            DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', $collegeTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                            $userCollegeTSGaleryImage = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $collegeTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userCollegeTSGaleryImage[0]))
                            {
                                DB::table('user_college_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage[0] -> id]);
                            }
                        }
                    }
                }
                                
                $collegeTSPlaylists = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($collegeTSPlaylists as $collegeTSPlaylist)
                {
                    $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', $collegeTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                    $userCollegeTSPlaylist = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userCollegeTSPlaylist[0]))
                    {
                        DB::table('u_c_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist[0] -> id]);
                                        
                        foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                        {
                            DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', $collegeTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                            $userCollegeTSPlaylistAudio = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $collegeTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userCollegeTSPlaylistAudio[0]))
                            {
                                DB::table('u_c_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPlaylistAudio[0] -> id]);
                            }
                        }
                    }
                }
                                
                $collegeTSTools = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $collegeTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($collegeTSTools as $collegeTSTool)
                {
                    $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', $collegeTSTool -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                    $userCollegeTSTool = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $collegeTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userCollegeTSTool[0]))
                    {
                        DB::table('user_college_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool[0] -> id]);
                                    
                        foreach($collegeTSToolFiles as $collegeTSToolFile)
                        {
                            DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', $collegeTSToolFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                            $userCollegeTSToolFile = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $collegeTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userCollegeTSToolFile[0]))
                            {
                                DB::table('user_college_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile[0] -> id]);
                            }
                        }
                    }
                }
        
                $this->userCollegeTopicSectionRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_topic_sections')->join('users', 'users.id', '=', 'user_college_topic_sections.user_id')->where('user_college_topic_sections.id', '=', $userCollegeTopicSection -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_d', 'user_id' => $user_id, 'entity_id' => $userCollegeTopicSection -> college_topic_section_id, 'created_at' => $now]);
            
                Flash::success('User College Topic Section deleted successfully.');
                return redirect(route('userCollegeTopicSections.show', [$userCollegeTopicSection -> college_topic_section_id]));
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