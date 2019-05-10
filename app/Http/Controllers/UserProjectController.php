<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserProjectRequest;
use App\Http\Requests\UpdateUserProjectRequest;
use App\Repositories\UserProjectRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\ProjectTopic;

class UserProjectController extends AppBaseController
{
    private $userProjectRepository;

    public function __construct(UserProjectRepository $userProjectRepo)
    {
        $this->userProjectRepository = $userProjectRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectRepository->pushCriteria(new RequestCriteria($request));
            $userProjects = $this->userProjectRepository->all();
    
            return view('user_projects.index')
                ->with('userProjects', $userProjects);
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
            
            $projectTopicsList = ProjectTopic::where('project_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $userProjectsList = DB::table('user_projects')->join('users', 'user_projects.user_id', '=', 'users.id')->select('name', 'email', 'user_projects.description', 'permissions', 'user_projects.datetime', 'user_projects.id', 'project_id', 'users.id as user_id')->where('project_id', $id)->where(function ($query) {$query->where('user_projects.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectViewsList = DB::table('users')->join('project_views', 'users.id', '=', 'project_views.user_id')->where('project_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectUpdatesList = DB::table('users')->join('project_updates', 'users.id', '=', 'project_updates.user_id')->where('project_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

            return view('user_projects.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('projectTopicsList', $projectTopicsList)
                ->with('projectViewsList', $projectViewsList)
                ->with('projectUpdatesList', $projectUpdatesList)
                ->with('userProjectsList', $userProjectsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('projects')->where('id', '=', $request -> project_id)->get();
            
            $userProjectCheck = DB::table('user_projects')->where('user_id', '=', $request -> user_id)->where('project_id', '=', $request -> project_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userProjectCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userProject = $this->userProjectRepository->create($input);
                    $projectTopics = DB::table('project_topics')->where('project_id', '=', $userProject -> project_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                    DB::table('user_project_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_id' => $userProject -> id]);
        
                    foreach($projectTopics as $projectTopic)
                    {
                        DB::table('user_project_topics')->insert(['datetime' => $now, 'user_id' => $userProject -> user_id, 'description' => $userProject -> description, 'project_topic_id' => $projectTopic -> id]);
                        
                        $userProjectTopic = DB::table('user_project_topics')->where('project_topic_id', '=', $projectTopic -> id)->orderBy('datetime', 'desc')->limit(1)->get();
    
                        if(isset($userProjectTopic[0]))
                        {
                            DB::table('user_project_topic_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_id' => $userProjectTopic[0] -> id]);
            
                            $projectTopicSections = DB::table('project_topic_sections')->where('project_topic_id', '=', $projectTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                            foreach($projectTopicSections as $projectTopicSection)
                            {
                                DB::table('user_project_topic_sections')->insert(['datetime' => $now, 'user_id' => $userProject -> user_id, 'description' => $userProject -> description, 'project_topic_section_id' => $projectTopicSection -> id]);
                                
                                $userProjectTopicSection = DB::table('user_project_topic_sections')->where('project_topic_section_id', '=', $projectTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                
                                if(isset($userProjectTopicSection[0]))
                                {
                                    DB::table('user_project_topic_section_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_id' => $userProjectTopicSection[0] -> id]);
                                    
                                    $projectTSFiles = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                                    foreach($projectTSFiles as $projectTSFile)
                                    {
                                        DB::table('user_project_t_s_files')->insert(['datetime' => $now, 'user_id' => $userProject -> user_id, 'description' => $userProject -> description, 'project_t_s_file_id' => $projectTSFile -> id]);
                                        
                                        $userProjectTSFile = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $projectTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userProjectTSFile[0]))
                                        {
                                            DB::table('user_project_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile[0] -> id]);
                                        }
                                    }
                    
                                    $projectTSNotes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                                    foreach($projectTSNotes as $projectTSNote)
                                    {
                                        DB::table('user_project_t_s_notes')->insert(['datetime' => $now, 'user_id' => $userProject -> user_id, 'description' => $userProject -> description, 'project_t_s_note_id' => $projectTSNote -> id]);
                                        
                                        $userProjectTSNote = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $projectTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userProjectTSNote[0]))
                                        {
                                            DB::table('user_project_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote[0] -> id]);
                                        }
                                    }
                                        
                                    $projectTSGaleries = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                                    foreach($projectTSGaleries as $projectTSGalery)
                                    {
                                        DB::table('user_project_t_s_galeries')->insert(['datetime' => $now, 'user_id' => $userProject -> user_id, 'description' => $userProject -> description, 'project_t_s_galery_id' => $projectTSGalery -> id]);
                                        
                                        $userProjectTSGalery = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $projectTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userProjectTSGalery[0]))
                                        {
                                            DB::table('user_project_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_id' => $userProjectTSGalery[0] -> id]);
                    
                                            $projectTSGaleryImages = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $projectTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                                            foreach($projectTSGaleryImages as $projectTSGaleryImage)
                                            {
                                                DB::table('user_project_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userProject -> user_id, 'description' => $userProject -> description, 'project_t_s_g_image_id' => $projectTSGaleryImage -> id]);
                                                
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
                                        DB::table('user_project_t_s_playlists')->insert(['datetime' => $now, 'user_id' => $userProject -> user_id, 'description' => $userProject -> description, 'p_t_s_p_id' => $projectTSPlaylist -> id]);
                                        
                                        $userProjectTSPlaylist = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userProjectTSPlaylist[0]))
                                        {
                                            DB::table('u_p_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist[0] -> id]);
                                        }
                                        
                                        $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                        
                                        foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                                        {
                                            DB::table('user_project_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userProject -> user_id, 'description' => $userProject -> description, 'p_t_s_p_a_id' => $projectTSPlaylistAudio -> id]);
                                           
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
                                        DB::table('user_project_t_s_tools')->insert(['datetime' => $now, 'user_id' => $userProject -> user_id, 'description' => $userProject -> description, 'project_t_s_tool_id' => $projectTSTool -> id]);
                                        
                                        $userProjectTSTool = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $projectTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userProjectTSTool[0]))
                                        {
                                            DB::table('user_project_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_id' => $userProjectTSTool[0] -> id]);
                                            
                                            $projectTSToolFiles = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $projectTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                                            foreach($projectTSToolFiles as $projectTSToolFile)
                                            {
                                                DB::table('user_project_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userProject -> user_id, 'description' => $userProject -> description, 'project_t_s_t_file_id' => $projectTSToolFile -> id]);
                                                
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
                        }
                    }
                    
                    $user = DB::table('user_projects')->join('users', 'users.id', '=', 'user_projects.user_id')->where('user_projects.id', '=', $userProject -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_c', 'user_id' => $user_id, 'entity_id' => $userProject -> project_id, 'created_at' => $now]);
                
                    Flash::success('User Project saved successfully.');
                    return redirect(route('userProjects.show', [$userProject -> project_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }

            return redirect(route('userProjects.show', [$request -> project_id]));
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
            $userProject = $this->userProjectRepository->findWithoutFail($id);
            $userProjects = DB::table('user_projects')->join('users', 'user_projects.user_id', '=', 'users.id')->select('name', 'email', 'user_projects.description', 'permissions', 'user_projects.datetime', 'user_projects.id', 'project_id', 'users.id as user_id')->where('project_id', $id)->where(function ($query) {$query->where('user_projects.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            if(empty($userProjects[0]))
            {
                Flash::error('User Project not found');
                return redirect(route('userProjects.create', [$id]));
            }
            
            $user = DB::table('projects')->where('id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $project = DB::table('projects')->where('id', '=', $userProjects[0] -> project_id)->get();
        
                $projectTopicsList = ProjectTopic::where('project_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userProjectsList = DB::table('user_projects')->join('users', 'user_projects.user_id', '=', 'users.id')->select('name', 'email', 'user_projects.description', 'permissions', 'user_projects.datetime', 'user_projects.id', 'project_id', 'users.id as user_id')->where('project_id', $id)->where(function ($query) {$query->where('user_projects.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectViewsList = DB::table('users')->join('project_views', 'users.id', '=', 'project_views.user_id')->where('project_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectUpdatesList = DB::table('users')->join('project_updates', 'users.id', '=', 'project_updates.user_id')->where('project_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
        
                return view('user_projects.show')
                    ->with('userProjects', $userProjects)
                    ->with('id', $id)
                    ->with('project', $project)
                    ->with('projectTopicsList', $projectTopicsList)
                    ->with('projectViewsList', $projectViewsList)
                    ->with('projectUpdatesList', $projectUpdatesList)
                    ->with('userProjectsList', $userProjectsList);
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
            $userProject = DB::table('users')->join('user_projects', 'user_projects.user_id', '=', 'users.id')->where('user_projects.id', $id)->where(function ($query) {$query->where('user_projects.deleted_at', '=', null);})->get();
    
            if(empty($userProject[0]))
            {
                Flash::error('User Project not found');
                return redirect(route('userProjects.index'));
            }
            
            $user = DB::table('projects')->where('id', '=', $userProject[0] -> project_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTopicsList = ProjectTopic::where('project_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userProjectsList = DB::table('user_projects')->join('users', 'user_projects.user_id', '=', 'users.id')->select('name', 'email', 'user_projects.description', 'permissions', 'user_projects.datetime', 'user_projects.id', 'project_id', 'users.id as user_id')->where('project_id', $id)->where(function ($query) {$query->where('user_projects.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectViewsList = DB::table('users')->join('project_views', 'users.id', '=', 'project_views.user_id')->where('project_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectUpdatesList = DB::table('users')->join('project_updates', 'users.id', '=', 'project_updates.user_id')->where('project_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_projects.edit')
                    ->with('userProject', $userProject)
                    ->with('id', $userProject[0] -> project_id)
                    ->with('projectTopicsList', $projectTopicsList)
                    ->with('projectViewsList', $projectViewsList)
                    ->with('projectUpdatesList', $projectUpdatesList)
                    ->with('userProjectsList', $userProjectsList);
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

    public function update($id, UpdateUserProjectRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userProject = $this->userProjectRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userProject))
            {
                Flash::error('User Project not found');
                return redirect(route('userProjects.index'));
            }
            
            $user = DB::table('projects')->where('id', '=', $userProject -> project_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProject -> user_id;
                $userProject = $this->userProjectRepository->update($request->all(), $id);
                $projectTopics = DB::table('project_topics')->where('project_id', '=', $userProject -> project_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_project_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_id' => $userProject -> id]);
        
                foreach($projectTopics as $projectTopic)
                {
                    $projectTopicSections = DB::table('project_topic_sections')->where('project_topic_id', '=', $projectTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_project_topics')->where('project_topic_id', $projectTopic -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProject -> permissions]);
                    
                    $userProjectTopic = DB::table('user_project_topics')->where('project_topic_id', '=', $projectTopic -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if(isset($userProjectTopic[0]))
                    {
                        DB::table('user_project_topic_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_id' => $userProjectTopic[0] -> id]);
                                    
                        foreach($projectTopicSections as $projectTopicSection)
                        {
                            $projectTSFiles = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                            DB::table('user_project_topic_sections')->where('project_topic_section_id', $projectTopicSection -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProject -> permissions]);
                            
                            $userProjectTopicSection = DB::table('user_project_topic_sections')->where('project_topic_section_id', '=', $projectTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                            if(isset($userProjectTopicSection[0]))
                            {
                                DB::table('user_project_topic_section_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_id' => $userProjectTopicSection[0] -> id]);
                
                                foreach($projectTSFiles as $projectTSFile)
                                {
                                    DB::table('user_project_t_s_files')->where('project_t_s_file_id', $projectTSFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProject -> permissions]);
                                    
                                    $userProjectTSFile = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $projectTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                             
                                    if(isset($userProjectTSFile[0]))
                                    {
                                        DB::table('user_project_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile[0] -> id]);
                                    }
                                }
                
                                $projectTSNotes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                                foreach($projectTSNotes as $projectTSNote)
                                {
                                    DB::table('user_project_t_s_notes')->where('project_t_s_note_id', $projectTSNote -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProject -> permissions]);
                                    
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
            
                                    DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', $projectTSGalery -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProject -> permissions]);
                                    
                                    $userProjectTSGalery = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $projectTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userProjectTSGalery[0]))
                                    {
                                        DB::table('user_project_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_id' => $userProjectTSGalery[0] -> id]);
                    
                                        foreach($projectTSGaleryImages as $projectTSGaleryImage)
                                        {
                                            DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', $projectTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProject -> permissions]);
                                            
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
            
                                    DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', $projectTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProject -> permissions]);
                                    
                                    $userProjectTSPlaylist = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userProjectTSPlaylist[0]))
                                    {
                                        DB::table('u_p_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist[0] -> id]);
                    
                                        foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                                        {
                                            DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', $projectTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProject -> permissions]);
                                            
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
            
                                    DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', $projectTSTool -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProject -> permissions]);
                                    
                                    $userProjectTSTool = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $projectTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userProjectTSTool[0]))
                                    {
                                        DB::table('user_project_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_id' => $userProjectTSTool[0] -> id]);
                                    
                                        foreach($projectTSToolFiles as $projectTSToolFile)
                                        {
                                            DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', $projectTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProject -> permissions]);
                                            
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
                    }                    
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_projects')->join('users', 'users.id', '=', 'user_projects.user_id')->where('user_projects.id', '=', $userProject -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_u', 'user_id' => $user_id, 'entity_id' => $userProject -> project_id, 'created_at' => $now]);
            
                Flash::success('User Project updated successfully.');
                return redirect(route('userProjects.show', [$userProject -> project_id]));
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
            $userProject = $this->userProjectRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userProject))
            {
                Flash::error('User Project not found');
                return redirect(route('userProjects.index'));
            }
            
            $user = DB::table('projects')->where('id', '=', $userProject -> project_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProject -> user_id;
                $projectTopics = DB::table('project_topics')->where('project_id', '=', $userProject -> project_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_project_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_id' => $userProject -> id]);
    
                foreach($projectTopics as $projectTopic)
                {
                    $projectTopicSections = DB::table('project_topic_sections')->where('project_topic_id', '=', $projectTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_project_topics')->where('project_topic_id', $projectTopic -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                    
                    $userProjectTopic = DB::table('user_project_topics')->where('project_topic_id', '=', $projectTopic -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if(isset($userProjectTopic[0]))
                    {
                        DB::table('user_project_topic_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_id' => $userProjectTopic[0] -> id]);
                        
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
                    }
                }
        
                $this->userProjectRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_projects')->join('users', 'users.id', '=', 'user_projects.user_id')->where('user_projects.id', '=', $userProject -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d', 'user_id' => $user_id, 'entity_id' => $userProject -> project_id, 'created_at' => $now]);
            
                Flash::success('User Project deleted successfully.');
                return redirect(route('userProjects.show', [$userProject -> project_id]));
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