<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSPlaylistRequest;
use App\Http\Requests\UpdatePersonalDataTSPlaylistRequest;
use App\Repositories\PersonalDataTSPlaylistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\PersonalDataTSPlaylist;
use Illuminate\Support\Carbon;

class PersonalDataTSPlaylistController extends AppBaseController
{
    private $personalDataTSPlaylistRepository;

    public function __construct(PersonalDataTSPlaylistRepository $personalDataTSPlaylistRepo)
    {
        $this->personalDataTSPlaylistRepository = $personalDataTSPlaylistRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSPlaylistRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSPlaylists = $this->personalDataTSPlaylistRepository->all();
    
            return view('personal_data_t_s_playlists.index')
                ->with('personalDataTSPlaylists', $personalDataTSPlaylists);
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
            $personalDataTSPlaylistsList = PersonalDataTSPlaylist::where('p_d_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            return view('personal_data_t_s_playlists.create')
                ->with('id', $id)
                ->with('personalDataTSPlaylistsList', $personalDataTSPlaylistsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $personalDataTSPlaylist = $this->personalDataTSPlaylistRepository->create($input);
            
            DB::table('personal_data_t_s_p_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_p_id' => $personalDataTSPlaylist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSPlaylist -> name, 'status' => 'active', 'type' => 'p_d_t_s_p_c', 'user_id' => $user_id, 'entity_id' => $personalDataTSPlaylist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Playlist saved successfully.');
            return redirect(route('personalDataTopicSections.show', [$personalDataTSPlaylist -> p_d_t_s_id]));
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
            $personal_data_audio_p = $request -> personal_data_audio_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSPlaylist = $this->personalDataTSPlaylistRepository->findWithoutFail($id);
            
            if(empty($personalDataTSPlaylist))
            {
                Flash::error('PersonalData T S Playlist not found');
                return redirect(route('personalDataTSPlaylists.index'));
            }
            
            $userPersonalDataTSPlaylists = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSPlaylists as $userPersonalDataTSPlaylist)
            {
                if($userPersonalDataTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('personal_data_t_s_p_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_p_id' => $id]);
                DB::table('personal_data_t_s_playlists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
                $personalDataTSPlaylist = $this->personalDataTSPlaylistRepository->findWithoutFail($id);
                $personalDataTSPAudios = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'personal_data_audio_p');
                $personalDataTSPlaylistViews = DB::table('users')->join('personal_data_t_s_p_views', 'users.id', '=', 'personal_data_t_s_p_views.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $personalDataTSPlaylistUpdates = DB::table('users')->join('personal_data_t_s_p_updates', 'users.id', '=', 'personal_data_t_s_p_updates.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $personalDataTSPTodolist = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_playlists', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_playlists.p_d_t_s_id')->join('personal_data_t_s_p_todolists', 'personal_data_t_s_playlists.id', '=', 'personal_data_t_s_p_todolists.p_d_t_s_p_id')->where('personal_data_t_s_p_todolists.p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('personal_data_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_p_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_p_todolists.datetime', 'desc')->limit(50)->get();
                $personalDataTSPTodolistCompleted = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_playlists', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_playlists.p_d_t_s_id')->join('personal_data_t_s_p_todolists', 'personal_data_t_s_playlists.id', '=', 'personal_data_t_s_p_todolists.p_d_t_s_p_id')->where('personal_data_t_s_p_todolists.p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('personal_data_t_s_p_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('personal_data_t_s_p_todolists.deleted_at', '=', null);})->orderBy('personal_data_t_s_p_todolists.datetime', 'desc')->limit(50)->get();

                $personalDataTSPAudiosList = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userPersonalDataTSPlaylistsList = DB::table('user_personal_data_t_s_p')->join('users', 'user_personal_data_t_s_p.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_p.description', 'permissions', 'user_personal_data_t_s_p.datetime', 'user_personal_data_t_s_p.id', 'p_d_t_s_p_id')->where('p_d_t_s_p_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_p.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSPlaylistViewsList = DB::table('users')->join('personal_data_t_s_p_views', 'users.id', '=', 'personal_data_t_s_p_views.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSPlaylistUpdatesList = DB::table('users')->join('personal_data_t_s_p_updates', 'users.id', '=', 'personal_data_t_s_p_updates.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSPTodolistsList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_playlists', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_playlists.p_d_t_s_id')->join('personal_data_t_s_p_todolists', 'personal_data_t_s_playlists.id', '=', 'personal_data_t_s_p_todolists.p_d_t_s_p_id')->where('personal_data_t_s_p_todolists.p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('personal_data_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_p_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_p_todolists.datetime', 'desc')->limit(5)->get();
                $personalDataTSPTodolistsCompletedList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_playlists', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_playlists.p_d_t_s_id')->join('personal_data_t_s_p_todolists', 'personal_data_t_s_playlists.id', '=', 'personal_data_t_s_p_todolists.p_d_t_s_p_id')->where('personal_data_t_s_p_todolists.p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('personal_data_t_s_p_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('personal_data_t_s_p_todolists.deleted_at', '=', null);})->orderBy('personal_data_t_s_p_todolists.datetime', 'desc')->limit(5)->get();
        
                return view('personal_data_t_s_playlists.show')
                    ->with('personalDataTSPlaylist', $personalDataTSPlaylist)
                    ->with('personalDataTSPAudios', $personalDataTSPAudios)
                    ->with('personalDataTSPlaylistViews', $personalDataTSPlaylistViews)
                    ->with('personalDataTSPlaylistUpdates', $personalDataTSPlaylistUpdates)
                    ->with('personalDataTSPTodolist', $personalDataTSPTodolist)
                    ->with('personalDataTSPTodolistCompleted', $personalDataTSPTodolistCompleted)
                    ->with('personal_data_audio_p', $personal_data_audio_p)
                    ->with('user_id', $user_id)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('personalDataTSPAudiosList', $personalDataTSPAudiosList)
                    ->with('userPersonalDataTSPlaylistsList', $userPersonalDataTSPlaylistsList)
                    ->with('personalDataTSPlaylistViewsList', $personalDataTSPlaylistViewsList)
                    ->with('personalDataTSPlaylistUpdatesList', $personalDataTSPlaylistUpdatesList)
                    ->with('personalDataTSPTodolistsList', $personalDataTSPTodolistsList)
                    ->with('personalDataTSPTodolistsCompletedList', $personalDataTSPTodolistsCompletedList);
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
            $personalDataTSPlaylist = $this->personalDataTSPlaylistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylist))
            {
                Flash::error('PersonalData T S Playlist not found');
                return redirect(route('personalDataTSPlaylists.index'));
            }
    
            $userPersonalDataTSPlaylists = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSPlaylists as $userPersonalDataTSPlaylist)
            {
                if($userPersonalDataTSPlaylist -> user_id == $user_id && $userPersonalDataTSPlaylist -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $personalDataTSPAudiosList = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $personalDataTSPlaylistViewsList = DB::table('users')->join('personal_data_t_s_p_views', 'users.id', '=', 'personal_data_t_s_p_views.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSPlaylistUpdatesList = DB::table('users')->join('personal_data_t_s_p_updates', 'users.id', '=', 'personal_data_t_s_p_updates.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userPersonalDataTSPlaylistsList = DB::table('user_personal_data_t_s_p')->join('users', 'user_personal_data_t_s_p.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_p.description', 'permissions', 'user_personal_data_t_s_p.datetime', 'user_personal_data_t_s_p.id', 'p_d_t_s_p_id')->where('p_d_t_s_p_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_p.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSPTodolistsList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_playlists', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_playlists.p_d_t_s_id')->join('personal_data_t_s_p_todolists', 'personal_data_t_s_playlists.id', '=', 'personal_data_t_s_p_todolists.p_d_t_s_p_id')->where('personal_data_t_s_p_todolists.p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('personal_data_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_p_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_p_todolists.datetime', 'desc')->limit(5)->get();
                $personalDataTSPTodolistsCompletedList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_playlists', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_playlists.p_d_t_s_id')->join('personal_data_t_s_p_todolists', 'personal_data_t_s_playlists.id', '=', 'personal_data_t_s_p_todolists.p_d_t_s_p_id')->where('personal_data_t_s_p_todolists.p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('personal_data_t_s_p_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('personal_data_t_s_p_todolists.deleted_at', '=', null);})->orderBy('personal_data_t_s_p_todolists.datetime', 'desc')->limit(5)->get();

                return view('personal_data_t_s_playlists.edit')
                    ->with('personalDataTSPlaylist', $personalDataTSPlaylist)
                    ->with('personalDataTSPAudiosList', $personalDataTSPAudiosList)
                    ->with('personalDataTSPlaylistViewsList', $personalDataTSPlaylistViewsList)
                    ->with('personalDataTSPlaylistUpdatesList', $personalDataTSPlaylistUpdatesList)
                    ->with('userPersonalDataTSPlaylistsList', $userPersonalDataTSPlaylistsList)
                    ->with('personalDataTSPTodolistsList', $personalDataTSPTodolistsList)
                    ->with('personalDataTSPTodolistsCompletedList', $personalDataTSPTodolistsCompletedList);
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

    public function update($id, UpdatePersonalDataTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSPlaylist = $this->personalDataTSPlaylistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylist))
            {
                Flash::error('PersonalData T S Playlist not found');
                return redirect(route('personalDataTSPlaylists.index'));
            }
            
            $userPersonalDataTSPlaylists = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSPlaylists as $userPersonalDataTSPlaylist)
            {
                if($userPersonalDataTSPlaylist -> user_id == $user_id && $userPersonalDataTSPlaylist -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_playlists.id', '=', $id)->get();
            
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
                $newPersonalDataTSPlaylist = $this->personalDataTSPlaylistRepository->update($request->all(), $id);
        
                DB::table('personal_data_t_s_playlists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('personal_data_t_s_p_updates')->insert(['actual_name' => $newPersonalDataTSPlaylist -> name, 'past_name' => $personalDataTSPlaylist -> name, 'datetime' => $now, 'p_d_t_s_p_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $personalDataTSPlaylist -> name, 'status' => 'active', 'type' => 'p_d_t_s_p_u', 'user_id' => $user_id, 'entity_id' => $personalDataTSPlaylist -> id, 'created_at' => $now]);
            
                Flash::success('PersonalData T S Playlist updated successfully.');
                return redirect(route('personalDataTSPlaylists.show', [$id]));
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
            $personalDataTSPlaylist = $this->personalDataTSPlaylistRepository->findWithoutFail($id);
            
            if(empty($personalDataTSPlaylist))
            {
                Flash::error('PersonalData T S Playlist not found');
                return redirect(route('personalDataTSPlaylists.index'));
            }
            
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $personalDataTSPAudios = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', $personalDataTSPlaylist -> id)->update(['deleted_at' => $now]);
                
                $userPersonalDataTSPlaylist = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userPersonalDataTSPlaylist == null)
                {
                    DB::table('u_p_d_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_id' => $userPersonalDataTSPlaylist[0] -> id]);
                }
                
                foreach($personalDataTSPAudios as $personalDataTSPAudio)
                {
                    DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', $personalDataTSPAudio -> id)->update(['deleted_at' => $now]);
                   
                    $userPersonalDataTSPlaylistAudio = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $personalDataTSPAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                   
                    if($userPersonalDataTSPlaylistAudio == null)
                    {
                        DB::table('u_p_d_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPersonalDataTSPlaylistAudio[0] -> id]);
                    }
                }
                
                $this->personalDataTSPlaylistRepository->delete($id);
                $personalDataTSPAudios = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                foreach($personalDataTSPAudios as $personalDataTSPAudio)
                {
                    DB::table('personal_data_t_s_p_audios')->where('id', $personalDataTSPAudio -> id)->update(['deleted_at' => $now]);
                    DB::table('p_d_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_p_a_id' => $personalDataTSPAudio -> id]);
                }
                
                DB::table('personal_data_t_s_p_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_p_id' => $personalDataTSPlaylist -> id]);
                DB::table('recent_activities')->insert(['name' => $personalDataTSPlaylist -> name, 'status' => 'active', 'type' => 'p_d_t_s_p_d', 'user_id' => $user_id, 'entity_id' => $personalDataTSPlaylist -> id, 'created_at' => $now]);
            
                Flash::success('PersonalData T S Playlist deleted successfully.');
                return redirect(route('personalDataTopicSections.show', [$personalDataTSPlaylist -> p_d_t_s_id]));
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