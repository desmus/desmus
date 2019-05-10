<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserProjectTopicRequest;
use App\Http\Requests\UpdateUserProjectTopicRequest;
use App\Repositories\UserProjectTopicRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\ProjectTopicSection;

class UserProjectTopicController extends AppBaseController
{
    private $userProjectTopicRepository;

    public function __construct(UserProjectTopicRepository $userProjectTopicRepo)
    {
        $this->userProjectTopicRepository = $userProjectTopicRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTopicRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTopics = $this->userProjectTopicRepository->all();
    
            return view('user_project_topics.index')
                ->with('userProjectTopics', $userProjectTopics);
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
            
            $projectTopicSectionsList = ProjectTopicSection::where('project_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $userProjectTopicsList = DB::table('user_project_topics')->join('users', 'user_project_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_project_topics.description', 'permissions', 'user_project_topics.datetime', 'user_project_topics.id', 'project_topic_id')->where('project_topic_id', $id)->where(function ($query) {$query->where('user_project_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectTopicViewsList = DB::table('users')->join('project_topic_views', 'users.id', '=', 'project_topic_views.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTopicUpdatesList = DB::table('users')->join('project_topic_updates', 'users.id', '=', 'project_topic_updates.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_project_topics.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('projectTopicSectionsList', $projectTopicSectionsList)
                ->with('userProjectTopicsList', $userProjectTopicsList)
                ->with('projectTopicViewsList', $projectTopicViewsList)
                ->with('projectTopicUpdatesList', $projectTopicUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTopicRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('project_topics')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_topics.id', '=', $request -> project_topic_id)->get();
            
            $userProjectTopicCheck = DB::table('user_project_topics')->where('user_id', '=', $request -> user_id)->where('project_topic_id', '=', $request -> project_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userProjectTopicCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userProjectTopic = $this->userProjectTopicRepository->create($input);
                    $projectTopicSections = DB::table('project_topic_sections')->where('project_topic_id', '=', $userProjectTopic -> project_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_project_topic_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_id' => $userProjectTopic -> id]);
                    
                    foreach($projectTopicSections as $projectTopicSection)
                    {
                        DB::table('user_project_topic_sections')->insert(['datetime' => $now, 'user_id' => $userProjectTopic  -> user_id, 'description' => $userProjectTopic  -> description, 'project_topic_section_id' => $projectTopicSection -> id]);
                                
                        $userProjectTopicSection = DB::table('user_project_topic_sections')->where('project_topic_section_id', '=', $projectTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                
                        if(isset($userProjectTopicSection[0]))
                        {
                            DB::table('user_project_topic_section_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_id' => $userProjectTopicSection[0] -> id]);
                                    
                            $projectTSFiles = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                            foreach($projectTSFiles as $projectTSFile)
                            {
                                DB::table('user_project_t_s_files')->insert(['datetime' => $now, 'user_id' => $userProjectTopic  -> user_id, 'description' => $userProjectTopic  -> description, 'project_t_s_file_id' => $projectTSFile -> id]);
                                        
                                $userProjectTSFile = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $projectTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                if(isset($userProjectTSFile[0]))
                                {
                                    DB::table('user_project_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile[0] -> id]);
                                }
                            }
                    
                            $projectTSNotes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                            foreach($projectTSNotes as $projectTSNote)
                            {
                                DB::table('user_project_t_s_notes')->insert(['datetime' => $now, 'user_id' => $userProjectTopic  -> user_id, 'description' => $userProjectTopic  -> description, 'project_t_s_note_id' => $projectTSNote -> id]);
                                        
                                $userProjectTSNote = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $projectTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                if(isset($userProjectTSNote[0]))
                                {
                                    DB::table('user_project_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote[0] -> id]);
                                }
                            }
                                        
                            $projectTSGaleries = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($projectTSGaleries as $projectTSGalery)
                            {
                                DB::table('user_project_t_s_galeries')->insert(['datetime' => $now, 'user_id' => $userProjectTopic  -> user_id, 'description' => $userProjectTopic  -> description, 'project_t_s_galery_id' => $projectTSGalery -> id]);
                                        
                                $userProjectTSGalery = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $projectTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                if(isset($userProjectTSGalery[0]))
                                {
                                    DB::table('user_project_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_id' => $userProjectTSGalery[0] -> id]);
                    
                                    $projectTSGaleryImages = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $projectTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                                    foreach($projectTSGaleryImages as $projectTSGaleryImage)
                                    {
                                        DB::table('user_project_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userProjectTopic  -> user_id, 'description' => $userProjectTopic  -> description, 'project_t_s_g_image_id' => $projectTSGaleryImage -> id]);
                                                
                                        $userProjectTSGaleryImage = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $projectTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                        if(isset($userProjectTSGalery[0]))
                                        {
                                            DB::table('user_project_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage[0] -> id]);
                                        }        
                                    }
                                }
                            }
                                    
                            $projectTSPlaylists = DB::table('project_t_s_playlists')->where('p_t_s_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($projectTSPlaylists as $projectTSPlaylist)
                            {
                                DB::table('user_project_t_s_playlists')->insert(['datetime' => $now, 'user_id' => $userProjectTopic  -> user_id, 'description' => $userProjectTopic  -> description, 'p_t_s_p_id' => $projectTSPlaylist -> id]);
                                        
                                $userProjectTSPlaylist = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                if(isset($userProjectTSPlaylist[0]))
                                {
                                    DB::table('u_p_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist[0] -> id]);
                                }
                                        
                                $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                        
                                foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                                {
                                    DB::table('user_project_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userProjectTopic  -> user_id, 'description' => $userProjectTopic  -> description, 'p_t_s_p_a_id' => $projectTSPlaylistAudio -> id]);
                                           
                                    $userProjectTSPlaylistAudio = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $projectTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userProjectTSPlaylistAudio[0]))
                                    {
                                        DB::table('u_p_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPlaylistAudio[0] -> id]);
                                    }
                                }
                            }
                                    
                            $projectTSTools = DB::table('project_t_s_tools')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($projectTSTools as $projectTSTool)
                            {
                                DB::table('user_project_t_s_tools')->insert(['datetime' => $now, 'user_id' => $userProjectTopic  -> user_id, 'description' => $userProjectTopic  -> description, 'project_t_s_tool_id' => $projectTSTool -> id]);
                                        
                                $userProjectTSTool = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $projectTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                if(isset($userProjectTSTool[0]))
                                {
                                    DB::table('user_project_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_id' => $userProjectTSTool[0] -> id]);
                                            
                                    $projectTSToolFiles = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $projectTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                                    foreach($projectTSToolFiles as $projectTSToolFile)
                                    {
                                        DB::table('user_project_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userProjectTopic  -> user_id, 'description' => $userProjectTopic  -> description, 'project_t_s_t_file_id' => $projectTSToolFile -> id]);
                                                
                                        $userProjectTSToolFile = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $projectTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                        if(isset($userProjectTSToolFile[0]))
                                        {
                                            DB::table('user_project_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile[0] -> id]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                
                    $user = DB::table('user_project_topics')->join('users', 'users.id', '=', 'user_project_topics.user_id')->where('user_project_topics.id', '=', $userProjectTopic -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_c', 'user_id' => $user_id, 'entity_id' => $userProjectTopic -> project_topic_id, 'created_at' => $now]);
                
                    Flash::success('User Project Topic saved successfully.');
                    return redirect(route('userProjectTopics.show', [$userProjectTopic -> project_topic_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userProjectTopics.show', [$request -> project_topic_id]));
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
            $userProjectTopic = $this->userProjectTopicRepository->findWithoutFail($id);
            $userProjectTopics = DB::table('user_project_topics')->join('users', 'user_project_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_project_topics.description', 'permissions', 'user_project_topics.datetime', 'user_project_topics.id', 'project_topic_id')->where('project_topic_id', $id)->where(function ($query) {$query->where('user_project_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            if(empty($userProjectTopics[0]))
            {
                Flash::error('User Project Topic not found');
                return redirect(route('userProjectTopics.create', [$id]));
            }
            
            $user = DB::table('project_topics')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_topics.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTopic = DB::table('project_topics')->where('id', '=', $userProjectTopics[0] -> project_topic_id)->get();
    
                $projectTopicSectionsList = ProjectTopicSection::where('project_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userProjectTopicsList = DB::table('user_project_topics')->join('users', 'user_project_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_project_topics.description', 'permissions', 'user_project_topics.datetime', 'user_project_topics.id', 'project_topic_id')->where('project_topic_id', $id)->where(function ($query) {$query->where('user_project_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTopicViewsList = DB::table('users')->join('project_topic_views', 'users.id', '=', 'project_topic_views.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTopicUpdatesList = DB::table('users')->join('project_topic_updates', 'users.id', '=', 'project_topic_updates.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_project_topics.show')
                    ->with('userProjectTopics', $userProjectTopics)
                    ->with('id', $id)
                    ->with('projectTopic', $projectTopic)
                    ->with('projectTopicSectionsList', $projectTopicSectionsList)
                    ->with('userProjectTopicsList', $userProjectTopicsList)
                    ->with('projectTopicViewsList', $projectTopicViewsList)
                    ->with('projectTopicUpdatesList', $projectTopicUpdatesList);
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
            $userProjectTopic = DB::table('users')->join('user_project_topics', 'user_project_topics.user_id', '=', 'users.id')->where('user_project_topics.id', $id)->where(function ($query) {$query->where('user_project_topics.deleted_at', '=', null);})->get();
            
            if(empty($userProjectTopic[0]))
            {
                Flash::error('User Project Topic not found');
                return redirect(route('userProjectTopics.index'));
            }
    
            $user = DB::table('project_topics')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_topics.id', '=', $userProjectTopic[0] -> project_topic_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $projectTopicSectionsList = ProjectTopicSection::where('project_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userProjectTopicsList = DB::table('user_project_topics')->join('users', 'user_project_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_project_topics.description', 'permissions', 'user_project_topics.datetime', 'user_project_topics.id', 'project_topic_id')->where('project_topic_id', $id)->where(function ($query) {$query->where('user_project_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTopicViewsList = DB::table('users')->join('project_topic_views', 'users.id', '=', 'project_topic_views.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTopicUpdatesList = DB::table('users')->join('project_topic_updates', 'users.id', '=', 'project_topic_updates.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_project_topics.edit')
                    ->with('userProjectTopic', $userProjectTopic)
                    ->with('id', $userProjectTopic[0] -> project_topic_id)
                    ->with('projectTopicSectionsList', $projectTopicSectionsList)
                    ->with('userProjectTopicsList', $userProjectTopicsList)
                    ->with('projectTopicViewsList', $projectTopicViewsList)
                    ->with('projectTopicUpdatesList', $projectTopicUpdatesList);
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

    public function update($id, UpdateUserProjectTopicRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userProjectTopic = $this->userProjectTopicRepository->findWithoutFail($id);
            
            if(empty($userProjectTopic))
            {
                Flash::error('User Project Topic not found');
                return redirect(route('userProjectTopics.index'));
            }
            
            $user = DB::table('project_topics')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_topics.id', '=', $userProjectTopic -> project_topic_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProjectTopic -> user_id;
                $userProjectTopic = $this->userProjectTopicRepository->update($request->all(), $id);
                $projectTopicSections = DB::table('project_topic_sections')->where('project_topic_id', '=', $userProjectTopic -> project_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_project_topic_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_id' => $userProjectTopic -> id]);
                
                foreach($projectTopicSections as $projectTopicSection)
                {
                    $projectTSFiles = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    DB::table('user_project_topic_sections')->where('project_topic_section_id', $projectTopicSection -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopic -> permissions]);
                            
                    $userProjectTopicSection = DB::table('user_project_topic_sections')->where('project_topic_section_id', '=', $projectTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                    if(isset($userProjectTopicSection[0]))
                    {
                        DB::table('user_project_topic_section_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_id' => $userProjectTopicSection[0] -> id]);
                
                        foreach($projectTSFiles as $projectTSFile)
                        {
                            DB::table('user_project_t_s_files')->where('project_t_s_file_id', $projectTSFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopic -> permissions]);
                                    
                            $userProjectTSFile = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $projectTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                             
                            if(isset($userProjectTSFile[0]))
                            {
                                DB::table('user_project_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile[0] -> id]);
                            }
                        }
                
                        $projectTSNotes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($projectTSNotes as $projectTSNote)
                        {
                            DB::table('user_project_t_s_notes')->where('project_t_s_note_id', $projectTSNote -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopic -> permissions]);
                                    
                            $userProjectTSNote = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $projectTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userProjectTSNote[0]))
                            {
                                DB::table('user_project_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote[0] -> id]);
                            }
                        }
                                
                        $projectTSGaleries = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($projectTSGaleries as $projectTSGalery)
                        {
                            $projectTSGaleryImages = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $projectTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', $projectTSGalery -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopic -> permissions]);
                                    
                            $userProjectTSGalery = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $projectTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userProjectTSGalery[0]))
                            {
                                DB::table('user_project_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_id' => $userProjectTSGalery[0] -> id]);
                    
                                foreach($projectTSGaleryImages as $projectTSGaleryImage)
                                {
                                    DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', $projectTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopic -> permissions]);
                                            
                                    $userProjectTSGaleryImage = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $projectTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userProjectTSGaleryImage[0]))
                                    {
                                        DB::table('user_project_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage[0] -> id]);
                                    }
                                }
                            }
                        }
                                
                        $projectTSPlaylists = DB::table('project_t_s_playlists')->where('p_t_s_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($projectTSPlaylists as $projectTSPlaylist)
                        {
                            $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', $projectTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopic -> permissions]);
                                    
                            $userProjectTSPlaylist = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userProjectTSPlaylist[0]))
                            {
                                DB::table('u_p_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist[0] -> id]);
                    
                                foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                                {
                                    DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', $projectTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopic -> permissions]);
                                            
                                    $userProjectTSPlaylistAudio = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $projectTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userProjectTSPlaylistAudio[0]))
                                    {
                                        DB::table('u_p_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPlaylistAudio[0] -> id]);
                                    }
                                }
                            }
                        }
                                
                        $projectTSTools = DB::table('project_t_s_tools')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($projectTSTools as $projectTSTool)
                        {
                            $projectTSToolFiles = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $projectTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', $projectTSTool -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopic -> permissions]);
                                    
                            $userProjectTSTool = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $projectTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userProjectTSTool[0]))
                            {
                                DB::table('user_project_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_id' => $userProjectTSTool[0] -> id]);
                                    
                                foreach($projectTSToolFiles as $projectTSToolFile)
                                {
                                    DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', $projectTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTopic -> permissions]);
                                            
                                    $userProjectTSToolFile = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $projectTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userProjectTSToolFile[0]))
                                    {
                                        DB::table('user_project_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile[0] -> id]);
                                    }
                                }
                            }
                        }
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_topics')->join('users', 'users.id', '=', 'user_project_topics.user_id')->where('user_project_topics.id', '=', $userProjectTopic -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_u', 'user_id' => $user_id, 'entity_id' => $userProjectTopic -> project_topic_id, 'created_at' => $now]);        
            
                Flash::success('User Project Topic updated successfully.');
                return redirect(route('userProjectTopics.show', [$userProjectTopic -> project_topic_id]));
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
            $userProjectTopic = $this->userProjectTopicRepository->findWithoutFail($id);
            
            if(empty($userProjectTopic))
            {
                Flash::error('User Project Topic not found');
                return redirect(route('userProjectTopics.index'));
            }
            
            $user = DB::table('project_topics')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_topics.id', '=', $userProjectTopic -> project_topic_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProjectTopic -> user_id;
                $projectTopicSections = DB::table('project_topic_sections')->where('project_topic_id', '=', $userProjectTopic -> project_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_project_topic_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_id' => $userProjectTopic -> id]);
                
                foreach($projectTopicSections as $projectTopicSection)
                {
                    $projectTSFiles = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                    DB::table('user_project_topic_sections')->where('project_topic_section_id', $projectTopicSection -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                            
                    $userProjectTopicSection = DB::table('user_project_topic_sections')->where('project_topic_section_id', '=', $projectTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                    if(isset($userProjectTopicSection[0]))
                    {
                        DB::table('user_project_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_id' => $userProjectTopicSection[0] -> id]);
                                
                        foreach($projectTSFiles as $projectTSFile)
                        {
                            DB::table('user_project_t_s_files')->where('project_t_s_file_id', $projectTSFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                            $userProjectTSFile = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $projectTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userProjectTSFile[0]))
                            {
                                DB::table('user_project_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile[0] -> id]);
                            }
                        }
                
                        $projectTSNotes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($projectTSNotes as $projectTSNote)
                        {
                            DB::table('user_project_t_s_notes')->where('project_t_s_note_id', $projectTSNote -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                   
                            $userProjectTSNote = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $projectTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userProjectTSNote[0]))
                            {
                                DB::table('user_project_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote[0] -> id]);
                            }
                        }
                                
                        $projectTSGaleries = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
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
                                
                        $projectTSPlaylists = DB::table('project_t_s_playlists')->where('p_t_s_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
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
                                
                        $projectTSTools = DB::table('project_t_s_tools')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
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
                    }
                }
        
                $this->userProjectTopicRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_topics')->join('users', 'users.id', '=', 'user_project_topics.user_id')->where('user_project_topics.id', '=', $userProjectTopic -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_d', 'user_id' => $user_id, 'entity_id' => $userProjectTopic -> project_topic_id, 'created_at' => $now]);        
            
                Flash::success('User Project Topic deleted successfully.');
                return redirect(route('userProjectTopics.show', [$userProjectTopic -> project_topic_id]));
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