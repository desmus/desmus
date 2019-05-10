<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserProjectTopicSectionRequest;
use App\Http\Requests\UpdateUserProjectTopicSectionRequest;
use App\Repositories\UserProjectTopicSectionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\ProjectTSFile;
use App\Models\ProjectTSNote;
use App\Models\ProjectTSGalerie;
use App\Models\ProjectTSTool;
use App\Models\ProjectTSPlaylist;

class UserProjectTopicSectionController extends AppBaseController
{
    private $userProjectTopicSectionRepository;

    public function __construct(UserProjectTopicSectionRepository $userProjectTopicSectionRepo)
    {
        $this->userProjectTopicSectionRepository = $userProjectTopicSectionRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTopicSectionRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTopicSections = $this->userProjectTopicSectionRepository->all();
    
            return view('user_project_topic_sections.index')
                ->with('userProjectTopicSections', $userProjectTopicSections);
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
            
            $projectTSFilesList = ProjectTSFile::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $projectTSNotesList = ProjectTSNote::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $projectTSGaleriesList = ProjectTSGalerie::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $projectTSPlaylistsList = ProjectTSPlaylist::where('p_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $projectTSToolsList = ProjectTSTool::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            $userProjectTopicSectionsList = DB::table('user_project_topic_sections')->join('users', 'user_project_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_project_topic_sections.description', 'permissions', 'user_project_topic_sections.datetime', 'user_project_topic_sections.id', 'project_topic_section_id')->where('project_topic_section_id', $id)->where(function ($query) {$query->where('user_project_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectTopicSectionViewsList = DB::table('users')->join('project_topic_section_views', 'users.id', '=', 'project_topic_section_views.user_id')->where('project_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTopicSectionUpdatesList = DB::table('users')->join('project_topic_section_updates', 'users.id', '=', 'project_topic_section_updates.user_id')->where('project_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_project_topic_sections.create', compact('select'))->with('id', $id)
                ->with('now', $now)
                ->with('projectTSFilesList', $projectTSFilesList)
                ->with('projectTSNotesList', $projectTSNotesList)
                ->with('projectTSGaleriesList', $projectTSGaleriesList)
                ->with('projectTSPlaylistsList', $projectTSPlaylistsList)
                ->with('projectTSToolsList', $projectTSToolsList)
                ->with('userProjectTopicSectionsList', $userProjectTopicSectionsList)
                ->with('projectTopicSectionViewsList', $projectTopicSectionViewsList)
                ->with('projectTopicSectionUpdatesList', $projectTopicSectionUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('project_topic_sections')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_topic_sections.id', '=', $request -> project_topic_section_id)->get();
            
            $userProjectTopicSectionCheck = DB::table('user_project_topic_sections')->where('user_id', '=', $request -> user_id)->where('project_topic_section_id', '=', $request -> project_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userProjectTopicSectionCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userProjectTopicSection = $this->userProjectTopicSectionRepository->create($input);
                    $projectTopicSection = DB::table('project_topic_sections')->where('id', '=', $userProjectTopicSection -> project_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    $projectTSFiles = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $userProjectTopicSection -> project_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_project_topic_section_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_id' => $userProjectTopicSection -> id]);
                    
                    foreach($projectTSFiles as $projectTSFile)
                    {
                        DB::table('user_project_t_s_files')->insert(['datetime' => $now, 'user_id' => $userProjectTopicSection -> user_id, 'description' => $userProjectTopicSection -> description, 'project_t_s_file_id' => $projectTSFile -> id]);
                                        
                        $userProjectTSFile = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $projectTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userProjectTSFile[0]))
                        {
                            DB::table('user_project_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile[0] -> id]);
                        }
                    }
                    
                    $projectTSNotes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($projectTSNotes as $projectTSNote)
                    {
                        DB::table('user_project_t_s_notes')->insert(['datetime' => $now, 'user_id' => $userProjectTopicSection -> user_id, 'description' => $userProjectTopicSection -> description, 'project_t_s_note_id' => $projectTSNote -> id]);
                                        
                        $userProjectTSNote = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $projectTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userProjectTSNote[0]))
                        {
                            DB::table('user_project_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote[0] -> id]);
                        }
                    }
                                        
                    $projectTSGaleries = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($projectTSGaleries as $projectTSGalery)
                    {
                        DB::table('user_project_t_s_galeries')->insert(['datetime' => $now, 'user_id' => $userProjectTopicSection -> user_id, 'description' => $userProjectTopicSection -> description, 'project_t_s_galery_id' => $projectTSGalery -> id]);
                                        
                        $userProjectTSGalery = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $projectTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userProjectTSGalery[0]))
                        {
                            DB::table('user_project_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_id' => $userProjectTSGalery[0] -> id]);
                    
                            $projectTSGaleryImages = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $projectTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($projectTSGaleryImages as $projectTSGaleryImage)
                            {
                                DB::table('user_project_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userProjectTopicSection -> user_id, 'description' => $userProjectTopicSection -> description, 'project_t_s_g_image_id' => $projectTSGaleryImage -> id]);
                                                
                                $userProjectTSGaleryImage = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $projectTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userProjectTSGalery[0]))
                                {
                                    DB::table('user_project_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage[0] -> id]);
                                }        
                            }
                        }
                    }
                                    
                    $projectTSPlaylists = DB::table('project_t_s_playlists')->where('p_t_s_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($projectTSPlaylists as $projectTSPlaylist)
                    {
                        DB::table('user_project_t_s_playlists')->insert(['datetime' => $now, 'user_id' => $userProjectTopicSection -> user_id, 'description' => $userProjectTopicSection -> description, 'p_t_s_p_id' => $projectTSPlaylist -> id]);
                                        
                        $userProjectTSPlaylist = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userProjectTSPlaylist[0]))
                        {
                            DB::table('u_p_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist[0] -> id]);
                        }
                                        
                        $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                        
                        foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                        {
                            DB::table('user_project_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userProjectTopicSection -> user_id, 'description' => $userProjectTopicSection -> description, 'p_t_s_p_a_id' => $projectTSPlaylistAudio -> id]);
                                           
                            $userProjectTSPlaylistAudio = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $projectTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userProjectTSPlaylistAudio[0]))
                            {
                                DB::table('u_p_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPlaylistAudio[0] -> id]);
                            }
                        }
                    }
                                    
                    $projectTSTools = DB::table('project_t_s_tools')->where('project_topic_section_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($projectTSTools as $projectTSTool)
                    {
                        DB::table('user_project_t_s_tools')->insert(['datetime' => $now, 'user_id' => $userProjectTopicSection -> user_id, 'description' => $userProjectTopicSection -> description, 'project_t_s_tool_id' => $projectTSTool -> id]);
                                        
                        $userProjectTSTool = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $projectTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userProjectTSTool[0]))
                        {
                            DB::table('user_project_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_id' => $userProjectTSTool[0] -> id]);
                                            
                            $projectTSToolFiles = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $projectTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($projectTSToolFiles as $projectTSToolFile)
                            {
                                DB::table('user_project_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userProjectTopicSection -> user_id, 'description' => $userProjectTopicSection -> description, 'project_t_s_t_file_id' => $projectTSToolFile -> id]);
                                                
                                $userProjectTSToolFile = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $projectTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userProjectTSToolFile[0]))
                                {
                                    DB::table('user_project_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile[0] -> id]);
                                }
                            }
                        }
                    }
                    
                    $user = DB::table('user_project_topic_sections')->join('users', 'users.id', '=', 'user_project_topic_sections.user_id')->where('user_project_topic_sections.id', '=', $userProjectTopicSection -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_c', 'user_id' => $user_id, 'entity_id' => $userProjectTopicSection -> project_topic_section_id, 'created_at' => $now]);
                
                    Flash::success('User Project Topic Section saved successfully.');
                    return redirect(route('userProjectTopicSections.show', [$userProjectTopicSection -> project_topic_section_id]));
                }
            
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userProjectTopicSections.show', [$request -> project_topic_section_id]));
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
            $userProjectTopicSection = $this->userProjectTopicSectionRepository->findWithoutFail($id);
            $userProjectTopicSections = DB::table('user_project_topic_sections')->join('users', 'user_project_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_project_topic_sections.description', 'permissions', 'user_project_topic_sections.datetime', 'user_project_topic_sections.id', 'project_topic_section_id')->where('project_topic_section_id', $id)->where(function ($query) {$query->where('user_project_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            if(empty($userProjectTopicSections[0]))
            {
                Flash::error('User Project Topic Section not found');
                return redirect(route('userProjectTopicSections.create', [$id]));
            }
            
            $user = DB::table('project_topic_sections')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_topic_sections.id', '=', $id)->get();
            
            $projectTSFilesList = ProjectTSFile::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $projectTSNotesList = ProjectTSNote::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $projectTSGaleriesList = ProjectTSGalerie::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $projectTSPlaylistsList = ProjectTSPlaylist::where('p_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $projectTSToolsList = ProjectTSTool::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            $userProjectTopicSectionsList = DB::table('user_project_topic_sections')->join('users', 'user_project_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_project_topic_sections.description', 'permissions', 'user_project_topic_sections.datetime', 'user_project_topic_sections.id', 'project_topic_section_id')->where('project_topic_section_id', $id)->where(function ($query) {$query->where('user_project_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectTopicSectionViewsList = DB::table('users')->join('project_topic_section_views', 'users.id', '=', 'project_topic_section_views.user_id')->where('project_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTopicSectionUpdatesList = DB::table('users')->join('project_topic_section_updates', 'users.id', '=', 'project_topic_section_updates.user_id')->where('project_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTopicSection = DB::table('project_topic_sections')->where('id', '=', $userProjectTopicSections[0] -> project_topic_section_id)->get();
    
                return view('user_project_topic_sections.show')
                    ->with('userProjectTopicSections', $userProjectTopicSections)
                    ->with('id', $id)
                    ->with('projectTopicSection', $projectTopicSection)
                    ->with('projectTSFilesList', $projectTSFilesList)
                    ->with('projectTSNotesList', $projectTSNotesList)
                    ->with('projectTSGaleriesList', $projectTSGaleriesList)
                    ->with('projectTSPlaylistsList', $projectTSPlaylistsList)
                    ->with('projectTSToolsList', $projectTSToolsList)
                    ->with('userProjectTopicSectionsList', $userProjectTopicSectionsList)
                    ->with('projectTopicSectionViewsList', $projectTopicSectionViewsList)
                    ->with('projectTopicSectionUpdatesList', $projectTopicSectionUpdatesList);
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
            $userProjectTopicSection = DB::table('users')->join('user_project_topic_sections', 'user_project_topic_sections.user_id', '=', 'users.id')->where('user_project_topic_sections.id', $id)->where(function ($query) {$query->where('user_project_topic_sections.deleted_at', '=', null);})->get();
            
            if(empty($userProjectTopicSection[0]))
            {
                Flash::error('User Project Topic Section not found');
                return redirect(route('userProjectTopicSections.index'));
            }
            
            $user = DB::table('project_topic_sections')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_topic_sections.id', '=', $userProjectTopicSection[0] -> project_topic_section_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $projectTSFilesList = ProjectTSFile::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $projectTSNotesList = ProjectTSNote::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $projectTSGaleriesList = ProjectTSGalerie::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $projectTSPlaylistsList = ProjectTSPlaylist::where('p_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $projectTSToolsList = ProjectTSTool::where('project_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

                $userProjectTopicSectionsList = DB::table('user_project_topic_sections')->join('users', 'user_project_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_project_topic_sections.description', 'permissions', 'user_project_topic_sections.datetime', 'user_project_topic_sections.id', 'project_topic_section_id')->where('project_topic_section_id', $id)->where(function ($query) {$query->where('user_project_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTopicSectionViewsList = DB::table('users')->join('project_topic_section_views', 'users.id', '=', 'project_topic_section_views.user_id')->where('project_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTopicSectionUpdatesList = DB::table('users')->join('project_topic_section_updates', 'users.id', '=', 'project_topic_section_updates.user_id')->where('project_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_project_topic_sections.edit')
                    ->with('userProjectTopicSection', $userProjectTopicSection)
                    ->with('id', $userProjectTopicSection[0] -> project_topic_section_id)
                    ->with('projectTSFilesList', $projectTSFilesList)
                    ->with('projectTSNotesList', $projectTSNotesList)
                    ->with('projectTSGaleriesList', $projectTSGaleriesList)
                    ->with('projectTSPlaylistsList', $projectTSPlaylistsList)
                    ->with('projectTSToolsList', $projectTSToolsList)
                    ->with('userProjectTopicSectionsList', $userProjectTopicSectionsList)
                    ->with('projectTopicSectionViewsList', $projectTopicSectionViewsList)
                    ->with('projectTopicSectionUpdatesList', $projectTopicSectionUpdatesList);
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

    public function update($id, UpdateUserProjectTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userProjectTopicSection = $this->userProjectTopicSectionRepository->findWithoutFail($id);
            
            if(empty($userProjectTopicSection))
            {
                Flash::error('User Project Topic Section not found');
                return redirect(route('userProjectTopicSections.index'));
            }
            
            $user = DB::table('project_topic_sections')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_topic_sections.id', '=', $userProjectTopicSection -> project_topic_section_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProjectTopicSection -> user_id;
                $userProjectTopicSection = $this->userProjectTopicSectionRepository->update($request->all(), $id);
                $projectTopicSection = DB::table('project_topic_sections')->where('id', '=', $userProjectTopicSection -> project_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                $projectTSFiles = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $userProjectTopicSection -> project_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_project_topic_section_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_id' => $userProjectTopicSection -> id]);
        
                foreach($projectTSFiles as $projectTSFile)
                {
                    DB::table('user_project_t_s_files')->where('project_t_s_file_id', $projectTSFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopicSection -> permissions]);
                                    
                    $userProjectTSFile = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $projectTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                             
                    if(isset($userProjectTSFile[0]))
                    {
                        DB::table('user_project_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile[0] -> id]);
                    }
                }
                
                $projectTSNotes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($projectTSNotes as $projectTSNote)
                {
                    DB::table('user_project_t_s_notes')->where('project_t_s_note_id', $projectTSNote -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopicSection -> permissions]);
                                    
                    $userProjectTSNote = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $projectTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userProjectTSNote[0]))
                    {
                        DB::table('user_project_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote[0] -> id]);
                    }
                }
                                
                $projectTSGaleries = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($projectTSGaleries as $projectTSGalery)
                {
                    $projectTSGaleryImages = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $projectTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', $projectTSGalery -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopicSection -> permissions]);
                                    
                    $userProjectTSGalery = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $projectTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userProjectTSGalery[0]))
                    {
                        DB::table('user_project_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_id' => $userProjectTSGalery[0] -> id]);
                    
                        foreach($projectTSGaleryImages as $projectTSGaleryImage)
                        {
                            DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', $projectTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopicSection -> permissions]);
                                            
                            $userProjectTSGaleryImage = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $projectTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userProjectTSGaleryImage[0]))
                            {
                                DB::table('user_project_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage[0] -> id]);
                            }
                        }
                    }
                }
                                
                $projectTSPlaylists = DB::table('project_t_s_playlists')->where('p_t_s_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($projectTSPlaylists as $projectTSPlaylist)
                {
                    $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', $projectTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopicSection -> permissions]);
                                    
                    $userProjectTSPlaylist = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userProjectTSPlaylist[0]))
                    {
                        DB::table('u_p_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist[0] -> id]);
                    
                        foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                        {
                            DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', $projectTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopicSection -> permissions]);
                                            
                            $userProjectTSPlaylistAudio = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $projectTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userProjectTSPlaylistAudio[0]))
                            {
                                DB::table('u_p_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPlaylistAudio[0] -> id]);
                            }
                        }
                    }
                }
                                
                $projectTSTools = DB::table('project_t_s_tools')->where('project_topic_section_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($projectTSTools as $projectTSTool)
                {
                    $projectTSToolFiles = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $projectTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', $projectTSTool -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopicSection -> permissions]);
                                    
                    $userProjectTSTool = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $projectTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userProjectTSTool[0]))
                    {
                        DB::table('user_project_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_id' => $userProjectTSTool[0] -> id]);
                                    
                        foreach($projectTSToolFiles as $projectTSToolFile)
                        {
                            DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', $projectTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopicSection -> permissions]);
                                            
                            $userProjectTSToolFile = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $projectTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userProjectTSToolFile[0]))
                            {
                                DB::table('user_project_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile[0] -> id]);
                            }
                        }
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_topic_sections')->join('users', 'users.id', '=', 'user_project_topic_sections.user_id')->where('user_project_topic_sections.id', '=', $userProjectTopicSection -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_u', 'user_id' => $user_id, 'entity_id' => $userProjectTopicSection -> project_topic_section_id, 'created_at' => $now]);
            
                Flash::success('User Project Topic Section updated successfully.');
                return redirect(route('userProjectTopicSections.show', [$userProjectTopicSection -> project_topic_section_id]));
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
            $userProjectTopicSection = $this->userProjectTopicSectionRepository->findWithoutFail($id);
            
            if(empty($userProjectTopicSection))
            {
                Flash::error('User Project Topic Section not found');
                return redirect(route('userProjectTopicSections.index'));
            }
            
            $user = DB::table('project_topic_sections')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_topic_sections.id', '=', $userProjectTopicSection -> project_topic_section_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProjectTopicSection -> user_id;
                $projectTopicSection = DB::table('project_topic_sections')->where('id', '=', $userProjectTopicSection -> project_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                $projectTSFiles = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $userProjectTopicSection -> project_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_project_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_id' => $userProjectTopicSection -> id]);
        
                foreach($projectTSFiles as $projectTSFile)
                {
                    DB::table('user_project_t_s_files')->where('project_t_s_file_id', $projectTSFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                    $userProjectTSFile = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $projectTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userProjectTSFile[0]))
                    {
                        DB::table('user_project_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile[0] -> id]);
                    }
                }
                
                $projectTSNotes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($projectTSNotes as $projectTSNote)
                {
                    DB::table('user_project_t_s_notes')->where('project_t_s_note_id', $projectTSNote -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                   
                    $userProjectTSNote = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $projectTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userProjectTSNote[0]))
                    {
                        DB::table('user_project_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote[0] -> id]);
                    }
                }
                                
                $projectTSGaleries = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($projectTSGaleries as $projectTSGalery)
                {
                    $projectTSGaleryImages = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $projectTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', $projectTSGalery -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                    $userProjectTSGalery = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $projectTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userProjectTSGalery[0]))
                    {
                        DB::table('user_project_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_id' => $userProjectTSGalery[0] -> id]);
                    
                        foreach($projectTSGaleryImages as $projectTSGaleryImage)
                        {
                            DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', $projectTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                            $userProjectTSGaleryImage = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $projectTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userProjectTSGaleryImage[0]))
                            {
                                DB::table('user_project_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage[0] -> id]);
                            }
                        }
                    }
                }
                                
                $projectTSPlaylists = DB::table('project_t_s_playlists')->where('p_t_s_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($projectTSPlaylists as $projectTSPlaylist)
                {
                    $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', $projectTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                    $userProjectTSPlaylist = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userProjectTSPlaylist[0]))
                    {
                        DB::table('u_p_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist[0] -> id]);
                                        
                        foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                        {
                            DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', $projectTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                            $userProjectTSPlaylistAudio = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $projectTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userProjectTSPlaylistAudio[0]))
                            {
                                DB::table('u_p_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPlaylistAudio[0] -> id]);
                            }
                        }
                    }
                }
                                
                $projectTSTools = DB::table('project_t_s_tools')->where('project_topic_section_id', '=', $projectTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($projectTSTools as $projectTSTool)
                {
                    $projectTSToolFiles = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $projectTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', $projectTSTool -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                    $userProjectTSTool = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $projectTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userProjectTSTool[0]))
                    {
                        DB::table('user_project_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_id' => $userProjectTSTool[0] -> id]);
                                    
                        foreach($projectTSToolFiles as $projectTSToolFile)
                        {
                            DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', $projectTSToolFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                            $userProjectTSToolFile = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $projectTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userProjectTSToolFile[0]))
                            {
                                DB::table('user_project_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile[0] -> id]);
                            }
                        }
                    }
                }
        
                $this->userProjectTopicSectionRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_topic_sections')->join('users', 'users.id', '=', 'user_project_topic_sections.user_id')->where('user_project_topic_sections.id', '=', $userProjectTopicSection -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_d', 'user_id' => $user_id, 'entity_id' => $userProjectTopicSection -> project_topic_section_id, 'created_at' => $now]);
            
                Flash::success('User Project Topic Section deleted successfully.');
                return redirect(route('userProjectTopicSections.show', [$userProjectTopicSection -> project_topic_section_id]));
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