<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPlaylistRequest;
use App\Http\Requests\UpdateCollegeTSPlaylistRequest;
use App\Repositories\CollegeTSPlaylistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\CollegeTSPlaylist;
use Illuminate\Support\Carbon;

class CollegeTSPlaylistController extends AppBaseController
{
    private $collegeTSPlaylistRepository;

    public function __construct(CollegeTSPlaylistRepository $collegeTSPlaylistRepo)
    {
        $this->collegeTSPlaylistRepository = $collegeTSPlaylistRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPlaylistRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPlaylists = $this->collegeTSPlaylistRepository->all();
    
            return view('college_t_s_playlists.index')
                ->with('collegeTSPlaylists', $collegeTSPlaylists);
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
            $collegeTSPlaylistsList = CollegeTSPlaylist::where('c_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            return view('college_t_s_playlists.create')
                ->with('id', $id)
                ->with('collegeTSPlaylistsList', $collegeTSPlaylistsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $collegeTSPlaylist = $this->collegeTSPlaylistRepository->create($input);
            
            DB::table('college_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_p_id' => $collegeTSPlaylist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSPlaylist -> name, 'status' => 'active', 'type' => 'c_t_s_p_c', 'user_id' => $user_id, 'entity_id' => $collegeTSPlaylist -> id, 'created_at' => $now]);
    
            Flash::success('College T S Playlist saved successfully.');
            return redirect(route('collegeTopicSections.show', [$collegeTSPlaylist -> c_t_s_id]));
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
            $college_audio_p = $request -> college_audio_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $collegeTSPlaylist = $this->collegeTSPlaylistRepository->findWithoutFail($id);
            
            if(empty($collegeTSPlaylist))
            {
                Flash::error('College T S Playlist not found');
                return redirect(route('collegeTSPlaylists.index'));
            }
            
            $userCollegeTSPlaylists = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSPlaylists as $userCollegeTSPlaylist)
            {
                if($userCollegeTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_playlists')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('college_t_s_playlist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_p_id' => $id]);
                DB::table('college_t_s_playlists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
                $collegeTSPlaylist = $this->collegeTSPlaylistRepository->findWithoutFail($id);
                $collegeTSPAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'college_audio_p');
                $collegeTSPlaylistViews = DB::table('users')->join('college_t_s_playlist_views', 'users.id', '=', 'college_t_s_playlist_views.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeTSPlaylistUpdates = DB::table('users')->join('college_t_s_playlist_updates', 'users.id', '=', 'college_t_s_playlist_updates.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeTSPTodolist = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_playlists', 'college_topic_sections.id', '=', 'college_t_s_playlists.c_t_s_id')->join('college_t_s_p_todolists', 'college_t_s_playlists.id', '=', 'college_t_s_p_todolists.c_t_s_p_id')->where('college_t_s_p_todolists.c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('college_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_p_todolists.status', '=', 'active');})->orderBy('college_t_s_p_todolists.datetime', 'desc')->limit(50)->get();
                $collegeTSPTodolistCompleted = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_playlists', 'college_topic_sections.id', '=', 'college_t_s_playlists.c_t_s_id')->join('college_t_s_p_todolists', 'college_t_s_playlists.id', '=', 'college_t_s_p_todolists.c_t_s_p_id')->where('college_t_s_p_todolists.c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('college_t_s_p_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_t_s_p_todolists.deleted_at', '=', null);})->orderBy('college_t_s_p_todolists.datetime', 'desc')->limit(50)->get();

                $collegeTSPAudiosList = DB::table('college_t_s_p_audios')->where('c_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $collegeTSPTodolistsList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_playlists', 'college_topic_sections.id', '=', 'college_t_s_playlists.c_t_s_id')->join('college_t_s_p_todolists', 'college_t_s_playlists.id', '=', 'college_t_s_p_todolists.c_t_s_p_id')->where('college_t_s_p_todolists.c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('college_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_p_todolists.status', '=', 'active');})->orderBy('college_t_s_p_todolists.datetime', 'desc')->limit(5)->get();
                $collegeTSPTodolistsCompletedList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_playlists', 'college_topic_sections.id', '=', 'college_t_s_playlists.c_t_s_id')->join('college_t_s_p_todolists', 'college_t_s_playlists.id', '=', 'college_t_s_p_todolists.c_t_s_p_id')->where('college_t_s_p_todolists.c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('college_t_s_p_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_t_s_p_todolists.deleted_at', '=', null);})->orderBy('college_t_s_p_todolists.datetime', 'desc')->limit(5)->get();
                $userCollegeTSPlaylistsList = DB::table('user_college_t_s_playlists')->join('users', 'user_college_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_playlists.description', 'permissions', 'user_college_t_s_playlists.datetime', 'user_college_t_s_playlists.id', 'c_t_s_p_id')->where('c_t_s_p_id', $id)->where(function ($query) {$query->where('user_college_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSPlaylistViewsList = DB::table('users')->join('college_t_s_playlist_views', 'users.id', '=', 'college_t_s_playlist_views.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSPlaylistUpdatesList = DB::table('users')->join('college_t_s_playlist_updates', 'users.id', '=', 'college_t_s_playlist_updates.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                        
                return view('college_t_s_playlists.show')
                    ->with('collegeTSPlaylist', $collegeTSPlaylist)
                    ->with('collegeTSPAudios', $collegeTSPAudios)
                    ->with('collegeTSPlaylistViews', $collegeTSPlaylistViews)
                    ->with('collegeTSPlaylistUpdates', $collegeTSPlaylistUpdates)
                    ->with('collegeTSPTodolist', $collegeTSPTodolist)
                    ->with('collegeTSPTodolistCompleted', $collegeTSPTodolistCompleted)
                    ->with('college_audio_p', $college_audio_p)
                    ->with('user_id', $user_id)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('collegeTSPAudiosList', $collegeTSPAudiosList)
                    ->with('collegeTSPTodolistsList', $collegeTSPTodolistsList)
                    ->with('collegeTSPTodolistsCompletedList', $collegeTSPTodolistsCompletedList)
                    ->with('userCollegeTSPlaylistsList', $userCollegeTSPlaylistsList)
                    ->with('collegeTSPlaylistViewsList', $collegeTSPlaylistViewsList)
                    ->with('collegeTSPlaylistUpdatesList', $collegeTSPlaylistUpdatesList);
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
            $collegeTSPlaylist = $this->collegeTSPlaylistRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylist))
            {
                Flash::error('College T S Playlist not found');
                return redirect(route('collegeTSPlaylists.index'));
            }
    
            $userCollegeTSPlaylists = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSPlaylists as $userCollegeTSPlaylist)
            {
                if($userCollegeTSPlaylist -> user_id == $user_id && $userCollegeTSPlaylist -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_playlists')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $collegeTSPAudiosList = DB::table('college_t_s_p_audios')->where('c_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $collegeTSPTodolistsList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_playlists', 'college_topic_sections.id', '=', 'college_t_s_playlists.c_t_s_id')->join('college_t_s_p_todolists', 'college_t_s_playlists.id', '=', 'college_t_s_p_todolists.c_t_s_p_id')->where('college_t_s_p_todolists.c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('college_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_p_todolists.status', '=', 'active');})->orderBy('college_t_s_p_todolists.datetime', 'desc')->limit(5)->get();
                $collegeTSPTodolistsCompletedList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_playlists', 'college_topic_sections.id', '=', 'college_t_s_playlists.c_t_s_id')->join('college_t_s_p_todolists', 'college_t_s_playlists.id', '=', 'college_t_s_p_todolists.c_t_s_p_id')->where('college_t_s_p_todolists.c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('college_t_s_p_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_t_s_p_todolists.deleted_at', '=', null);})->orderBy('college_t_s_p_todolists.datetime', 'desc')->limit(5)->get();
                $userCollegeTSPlaylistsList = DB::table('user_college_t_s_playlists')->join('users', 'user_college_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_playlists.description', 'permissions', 'user_college_t_s_playlists.datetime', 'user_college_t_s_playlists.id', 'c_t_s_p_id')->where('c_t_s_p_id', $id)->where(function ($query) {$query->where('user_college_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSPlaylistViewsList = DB::table('users')->join('college_t_s_playlist_views', 'users.id', '=', 'college_t_s_playlist_views.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSPlaylistUpdatesList = DB::table('users')->join('college_t_s_playlist_updates', 'users.id', '=', 'college_t_s_playlist_updates.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('college_t_s_playlists.edit')
                    ->with('collegeTSPlaylist', $collegeTSPlaylist)
                    ->with('collegeTSPAudiosList', $collegeTSPAudiosList)
                    ->with('collegeTSPTodolistsList', $collegeTSPTodolistsList)
                    ->with('collegeTSPTodolistsCompletedList', $collegeTSPTodolistsCompletedList)
                    ->with('userCollegeTSPlaylistsList', $userCollegeTSPlaylistsList)
                    ->with('collegeTSPlaylistViewsList', $collegeTSPlaylistViewsList)
                    ->with('collegeTSPlaylistUpdatesList', $collegeTSPlaylistUpdatesList);
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

    public function update($id, UpdateCollegeTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $collegeTSPlaylist = $this->collegeTSPlaylistRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylist))
            {
                Flash::error('College T S Playlist not found');
                return redirect(route('collegeTSPlaylists.index'));
            }
            
            $userCollegeTSPlaylists = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSPlaylists as $userCollegeTSPlaylist)
            {
                if($userCollegeTSPlaylist -> user_id == $user_id && $userCollegeTSPlaylist -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_playlists')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_playlists.id', '=', $id)->get();
            
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
                $newCollegeTSPlaylist = $this->collegeTSPlaylistRepository->update($request->all(), $id);
        
                DB::table('college_t_s_playlists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('college_t_s_playlist_updates')->insert(['actual_name' => $newCollegeTSPlaylist -> name, 'past_name' => $collegeTSPlaylist -> name, 'datetime' => $now, 'c_t_s_p_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $collegeTSPlaylist -> name, 'status' => 'active', 'type' => 'c_t_s_p_u', 'user_id' => $user_id, 'entity_id' => $collegeTSPlaylist -> id, 'created_at' => $now]);
            
                Flash::success('College T S Playlist updated successfully.');
                return redirect(route('collegeTSPlaylists.show', [$id]));
            }
            
            else
            {
                return view('deniedAccess');
            }
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

    public function destroy($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $collegeTSPlaylist = $this->collegeTSPlaylistRepository->findWithoutFail($id);
            
            if(empty($collegeTSPlaylist))
            {
                Flash::error('College T S Playlist not found');
                return redirect(route('collegeTSPlaylists.index'));
            }
            
            $user = DB::table('college_t_s_playlists')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
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
                
                $this->collegeTSPlaylistRepository->delete($id);
                $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                {
                    DB::table('college_t_s_p_audios')->where('id', $collegeTSPlaylistAudio -> id)->update(['deleted_at' => $now]);
                    DB::table('college_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_p_a_id' => $collegeTSPlaylistAudio -> id]);
                }
                
                DB::table('college_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_p_id' => $collegeTSPlaylist -> id]);
                DB::table('recent_activities')->insert(['name' => $collegeTSPlaylist -> name, 'status' => 'active', 'type' => 'c_t_s_p_d', 'user_id' => $user_id, 'entity_id' => $collegeTSPlaylist -> id, 'created_at' => $now]);
            
                Flash::success('College T S Playlist deleted successfully.');
                return redirect(route('collegeTopicSections.show', [$collegeTSPlaylist -> c_t_s_id]));
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