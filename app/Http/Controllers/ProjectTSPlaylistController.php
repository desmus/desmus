<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPlaylistRequest;
use App\Http\Requests\UpdateProjectTSPlaylistRequest;
use App\Repositories\ProjectTSPlaylistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\ProjectTSPlaylist;
use Illuminate\Support\Carbon;

class ProjectTSPlaylistController extends AppBaseController
{
    private $projectTSPlaylistRepository;

    public function __construct(ProjectTSPlaylistRepository $projectTSPlaylistRepo)
    {
        $this->projectTSPlaylistRepository = $projectTSPlaylistRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPlaylistRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPlaylists = $this->projectTSPlaylistRepository->all();
    
            return view('project_t_s_playlists.index')
                ->with('projectTSPlaylists', $projectTSPlaylists);
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
            $projectTSPlaylistsList = ProjectTSPlaylist::where('p_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            return view('project_t_s_playlists.create')
                ->with('id', $id)
                ->with('projectTSPlaylistsList', $projectTSPlaylistsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $projectTSPlaylist = $this->projectTSPlaylistRepository->create($input);
            
            DB::table('project_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_id' => $projectTSPlaylist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTSPlaylist -> name, 'status' => 'active', 'type' => 'p_t_s_p_c', 'user_id' => $user_id, 'entity_id' => $projectTSPlaylist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S Playlist saved successfully.');
            return redirect(route('projectTopicSections.show', [$projectTSPlaylist -> p_t_s_id]));
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
            $project_audio_p = $request -> project_audio_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $projectTSPlaylist = $this->projectTSPlaylistRepository->findWithoutFail($id);
            
            if(empty($projectTSPlaylist))
            {
                Flash::error('Project T S Playlist not found');
                return redirect(route('projectTSPlaylists.index'));
            }
            
            $userProjectTSPlaylists = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPlaylists as $userProjectTSPlaylist)
            {
                if($userProjectTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('project_t_s_playlist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_id' => $id]);
                DB::table('project_t_s_playlists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
                $projectTSPlaylist = $this->projectTSPlaylistRepository->findWithoutFail($id);
                $projectTSPAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('project_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'project_audio_p');
                $projectTSPlaylistViews = DB::table('users')->join('project_t_s_playlist_views', 'users.id', '=', 'project_t_s_playlist_views.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $projectTSPlaylistUpdates = DB::table('users')->join('project_t_s_playlist_updates', 'users.id', '=', 'project_t_s_playlist_updates.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $projectTSPTodolist = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_playlists', 'project_topic_sections.id', '=', 'project_t_s_playlists.p_t_s_id')->join('project_t_s_p_todolists', 'project_t_s_playlists.id', '=', 'project_t_s_p_todolists.p_t_s_p_id')->where('project_t_s_p_todolists.p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('project_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_p_todolists.status', '=', 'active');})->orderBy('project_t_s_p_todolists.datetime', 'desc')->limit(50)->get();
                $projectTSPTodolistCompleted = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_playlists', 'project_topic_sections.id', '=', 'project_t_s_playlists.p_t_s_id')->join('project_t_s_p_todolists', 'project_t_s_playlists.id', '=', 'project_t_s_p_todolists.p_t_s_p_id')->where('project_t_s_p_todolists.p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('project_t_s_p_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('project_t_s_p_todolists.deleted_at', '=', null);})->orderBy('project_t_s_p_todolists.datetime', 'desc')->limit(50)->get();

                $projectTSPAudiosList = DB::table('project_t_s_p_audios')->where('p_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('project_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $projectTSPlaylistViewsList = DB::table('users')->join('project_t_s_playlist_views', 'users.id', '=', 'project_t_s_playlist_views.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSPlaylistUpdatesList = DB::table('users')->join('project_t_s_playlist_updates', 'users.id', '=', 'project_t_s_playlist_updates.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userProjectTSPlaylistsList = DB::table('user_project_t_s_playlists')->join('users', 'user_project_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_playlists.description', 'permissions', 'user_project_t_s_playlists.datetime', 'user_project_t_s_playlists.id', 'p_t_s_p_id')->where('p_t_s_p_id', $id)->where(function ($query) {$query->where('user_project_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSPTodolistsList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_playlists', 'project_topic_sections.id', '=', 'project_t_s_playlists.p_t_s_id')->join('project_t_s_p_todolists', 'project_t_s_playlists.id', '=', 'project_t_s_p_todolists.p_t_s_p_id')->where('project_t_s_p_todolists.p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('project_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_p_todolists.status', '=', 'active');})->orderBy('project_t_s_p_todolists.datetime', 'desc')->limit(5)->get();
                $projectTSPTodolistsCompletedList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_playlists', 'project_topic_sections.id', '=', 'project_t_s_playlists.p_t_s_id')->join('project_t_s_p_todolists', 'project_t_s_playlists.id', '=', 'project_t_s_p_todolists.p_t_s_p_id')->where('project_t_s_p_todolists.p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('project_t_s_p_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('project_t_s_p_todolists.deleted_at', '=', null);})->orderBy('project_t_s_p_todolists.datetime', 'desc')->limit(5)->get();
        
                return view('project_t_s_playlists.show')
                    ->with('projectTSPlaylist', $projectTSPlaylist)
                    ->with('projectTSPAudios', $projectTSPAudios)
                    ->with('projectTSPlaylistViews', $projectTSPlaylistViews)
                    ->with('projectTSPlaylistUpdates', $projectTSPlaylistUpdates)
                    ->with('projectTSPTodolist', $projectTSPTodolist)
                    ->with('projectTSPTodolistCompleted', $projectTSPTodolistCompleted)
                    ->with('project_audio_p', $project_audio_p)
                    ->with('user_id', $user_id)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('projectTSPAudiosList', $projectTSPAudiosList)
                    ->with('projectTSPlaylistViewsList', $projectTSPlaylistViewsList)
                    ->with('projectTSPlaylistUpdatesList', $projectTSPlaylistUpdatesList)
                    ->with('userProjectTSPlaylistsList', $userProjectTSPlaylistsList)
                    ->with('projectTSPTodolistsList', $projectTSPTodolistsList)
                    ->with('projectTSPTodolistsCompletedList', $projectTSPTodolistsCompletedList);
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
            $projectTSPlaylist = $this->projectTSPlaylistRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylist))
            {
                Flash::error('Project T S Playlist not found');
                return redirect(route('projectTSPlaylists.index'));
            }
    
            $userProjectTSPlaylists = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPlaylists as $userProjectTSPlaylist)
            {
                if($userProjectTSPlaylist -> user_id == $user_id && $userProjectTSPlaylist -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $projectTSPAudiosList = DB::table('project_t_s_p_audios')->where('p_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('project_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $projectTSPlaylistViewsList = DB::table('users')->join('project_t_s_playlist_views', 'users.id', '=', 'project_t_s_playlist_views.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSPlaylistUpdatesList = DB::table('users')->join('project_t_s_playlist_updates', 'users.id', '=', 'project_t_s_playlist_updates.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userProjectTSPlaylistsList = DB::table('user_project_t_s_playlists')->join('users', 'user_project_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_playlists.description', 'permissions', 'user_project_t_s_playlists.datetime', 'user_project_t_s_playlists.id', 'p_t_s_p_id')->where('p_t_s_p_id', $id)->where(function ($query) {$query->where('user_project_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSPTodolistsList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_playlists', 'project_topic_sections.id', '=', 'project_t_s_playlists.p_t_s_id')->join('project_t_s_p_todolists', 'project_t_s_playlists.id', '=', 'project_t_s_p_todolists.p_t_s_p_id')->where('project_t_s_p_todolists.p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('project_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_p_todolists.status', '=', 'active');})->orderBy('project_t_s_p_todolists.datetime', 'desc')->limit(5)->get();
                $projectTSPTodolistsCompletedList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_playlists', 'project_topic_sections.id', '=', 'project_t_s_playlists.p_t_s_id')->join('project_t_s_p_todolists', 'project_t_s_playlists.id', '=', 'project_t_s_p_todolists.p_t_s_p_id')->where('project_t_s_p_todolists.p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('project_t_s_p_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('project_t_s_p_todolists.deleted_at', '=', null);})->orderBy('project_t_s_p_todolists.datetime', 'desc')->limit(5)->get();

                return view('project_t_s_playlists.edit')
                    ->with('projectTSPlaylist', $projectTSPlaylist)
                    ->with('projectTSPAudiosList', $projectTSPAudiosList)
                    ->with('projectTSPlaylistViewsList', $projectTSPlaylistViewsList)
                    ->with('projectTSPlaylistUpdatesList', $projectTSPlaylistUpdatesList)
                    ->with('projectTSPTodolistsList', $projectTSPTodolistsList)
                    ->with('projectTSPTodolistsCompletedList', $projectTSPTodolistsCompletedList)
                    ->with('userProjectTSPlaylistsList', $userProjectTSPlaylistsList);
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

    public function update($id, UpdateProjectTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $projectTSPlaylist = $this->projectTSPlaylistRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylist))
            {
                Flash::error('Project T S Playlist not found');
                return redirect(route('projectTSPlaylists.index'));
            }
            
            $userProjectTSPlaylists = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPlaylists as $userProjectTSPlaylist)
            {
                if($userProjectTSPlaylist -> user_id == $user_id && $userProjectTSPlaylist -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_playlists.id', '=', $id)->get();
            
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
                $newProjectTSPlaylist = $this->projectTSPlaylistRepository->update($request->all(), $id);
        
                DB::table('project_t_s_playlists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('project_t_s_playlist_updates')->insert(['actual_name' => $newProjectTSPlaylist -> name, 'past_name' => $projectTSPlaylist -> name, 'datetime' => $now, 'p_t_s_p_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $projectTSPlaylist -> name, 'status' => 'active', 'type' => 'p_t_s_p_u', 'user_id' => $user_id, 'entity_id' => $projectTSPlaylist -> id, 'created_at' => $now]);
            
                Flash::success('Project T S Playlist updated successfully.');
                return redirect(route('projectTSPlaylists.show', [$id]));
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
            $projectTSPlaylist = $this->projectTSPlaylistRepository->findWithoutFail($id);
            
            if(empty($projectTSPlaylist))
            {
                Flash::error('Project T S Playlist not found');
                return redirect(route('projectTSPlaylists.index'));
            }
            
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', $projectTSPlaylist -> id)->update(['deleted_at' => $now]);
                
                $userProjectTSPlaylist = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userProjectTSPlaylist == null)
                {
                    DB::table('u_p_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist[0] -> id]);
                }
                
                foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                {
                    DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', $projectTSPlaylistAudio -> id)->update(['deleted_at' => $now]);
                    
                    $userProjectTSPlaylistAudio = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $projectTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userProjectTSPlaylistAudio == null)
                    {
                        DB::table('u_p_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPlaylistAudio[0] -> id]);
                    }
                }
                
                $this->projectTSPlaylistRepository->delete($id);
                $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                {
                    DB::table('project_t_s_p_audios')->where('id', $projectTSPlaylistAudio -> id)->update(['deleted_at' => $now]);
                    DB::table('project_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_a_id' => $projectTSPlaylistAudio -> id]);
                }
                
                DB::table('project_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_id' => $projectTSPlaylist -> id]);
                DB::table('recent_activities')->insert(['name' => $projectTSPlaylist -> name, 'status' => 'active', 'type' => 'p_t_s_p_d', 'user_id' => $user_id, 'entity_id' => $projectTSPlaylist -> id, 'created_at' => $now]);
            
                Flash::success('Project T S Playlist deleted successfully.');
                return redirect(route('projectTopicSections.show', [$projectTSPlaylist -> p_t_s_id]));
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