<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCollegeTSPlaylistRequest;
use App\Http\Requests\UpdateUserCollegeTSPlaylistRequest;
use App\Repositories\UserCollegeTSPlaylistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSPlaylistController extends AppBaseController
{
    private $userCollegeTSPlaylistRepository;

    public function __construct(UserCollegeTSPlaylistRepository $userCollegeTSPlaylistRepo)
    {
        $this->userCollegeTSPlaylistRepository = $userCollegeTSPlaylistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSPlaylistRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSPlaylists = $this->userCollegeTSPlaylistRepository->all();
    
            return view('user_college_t_s_playlists.index')
                ->with('userCollegeTSPlaylists', $userCollegeTSPlaylists);
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
            
            $collegeTSPAudiosList = DB::table('college_t_s_p_audios')->where('c_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $userCollegeTSPlaylistsList = DB::table('user_college_t_s_playlists')->join('users', 'user_college_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_playlists.description', 'permissions', 'user_college_t_s_playlists.datetime', 'user_college_t_s_playlists.id', 'c_t_s_p_id')->where('c_t_s_p_id', $id)->where(function ($query) {$query->where('user_college_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTSPlaylistViewsList = DB::table('users')->join('college_t_s_playlist_views', 'users.id', '=', 'college_t_s_playlist_views.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTSPlaylistUpdatesList = DB::table('users')->join('college_t_s_playlist_updates', 'users.id', '=', 'college_t_s_playlist_updates.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_college_t_s_playlists.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('collegeTSPAudiosList', $collegeTSPAudiosList)
                ->with('userCollegeTSPlaylistsList', $userCollegeTSPlaylistsList)
                ->with('collegeTSPlaylistViewsList', $collegeTSPlaylistViewsList)
                ->with('collegeTSPlaylistUpdatesList', $collegeTSPlaylistUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $user = DB::table('college_t_s_playlists')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_playlists.id', '=', $request -> c_t_s_p_id)->get();
            
            $userCollegeTSPlaylistCheck = DB::table('user_college_t_s_playlists')->where('user_id', '=', $request -> user_id)->where('c_t_s_p_id', '=', $request -> c_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            if($userCollegeTSPlaylistCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $input = $request->all();
                    $userCollegeTSPlaylist = $this->userCollegeTSPlaylistRepository->create($input);
                    $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $userCollegeTSPlaylist -> c_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('u_c_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist -> id]);
                    
                    foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                    {
                        DB::table('user_college_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userCollegeTSPlaylist -> user_id, 'description' => $userCollegeTSPlaylist -> description, 'c_t_s_p_a_id' => $collegeTSPlaylistAudio -> id]);
                                           
                        $userCollegeTSPlaylistAudio = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $collegeTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                        if(isset($userCollegeTSPlaylistAudio[0]))
                        {
                            DB::table('u_c_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPlaylistAudio[0] -> id]);
                        }
                    }
                    
                    $user = DB::table('user_college_t_s_playlists')->join('users', 'users.id', '=', 'user_college_t_s_playlists.user_id')->where('user_college_t_s_playlists.id', '=', $userCollegeTSPlaylist -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_p_c', 'user_id' => $user_id, 'entity_id' => $userCollegeTSPlaylist -> c_t_s_p_id, 'created_at' => $now]);
                
                    Flash::success('User College T S Playlist saved successfully.');
                    return redirect(route('userCollegeTSPlaylists.show', [$userCollegeTSPlaylist -> c_t_s_p_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userCollegeTSPlaylists.show', [$request -> c_t_s_p_id]));
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
            $userCollegeTSPlaylist = $this->userCollegeTSPlaylistRepository->findWithoutFail($id);
            $userCollegeTSPlaylists = DB::table('user_college_t_s_playlists')->join('users', 'user_college_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_playlists.description', 'permissions', 'user_college_t_s_playlists.datetime', 'user_college_t_s_playlists.id', 'c_t_s_p_id')->where('c_t_s_p_id', $id)->where(function ($query) {$query->where('user_college_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userCollegeTSPlaylists[0]))
            {
                Flash::error('User College T S Galerie not found');
                return redirect(route('userCollegeTSPlaylists.create', [$id]));
            }
            
            $user = DB::table('college_t_s_playlists')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_playlists.id', '=', $userCollegeTSPlaylists[0] -> c_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTSPlaylist = DB::table('college_t_s_playlists')->where('id', '=', $userCollegeTSPlaylists[0] -> c_t_s_p_id)->get();
    
                $collegeTSPAudiosList = DB::table('college_t_s_p_audios')->where('c_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userCollegeTSPlaylistsList = DB::table('user_college_t_s_playlists')->join('users', 'user_college_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_playlists.description', 'permissions', 'user_college_t_s_playlists.datetime', 'user_college_t_s_playlists.id', 'c_t_s_p_id')->where('c_t_s_p_id', $id)->where(function ($query) {$query->where('user_college_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSPlaylistViewsList = DB::table('users')->join('college_t_s_playlist_views', 'users.id', '=', 'college_t_s_playlist_views.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSPlaylistUpdatesList = DB::table('users')->join('college_t_s_playlist_updates', 'users.id', '=', 'college_t_s_playlist_updates.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_college_t_s_playlists.show')
                    ->with('userCollegeTSPlaylists', $userCollegeTSPlaylists)
                    ->with('collegeTSPlaylist', $collegeTSPlaylist)
                    ->with('id', $id)
                    ->with('collegeTSPAudiosList', $collegeTSPAudiosList)
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
            $userCollegeTSPlaylist = DB::table('users')->join('user_college_t_s_playlists', 'user_college_t_s_playlists.user_id', '=', 'users.id')->where('user_college_t_s_playlists.id', $id)->where(function ($query) {$query->where('user_college_t_s_playlists.deleted_at', '=', null);})->get();
    
            if(empty($userCollegeTSPlaylist[0]))
            {
                Flash::error('User College T S Playlist not found');
                return redirect(route('userCollegeTSPlaylists.index'));
            }
    
            $user = DB::table('college_t_s_playlists')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_playlists.id', '=', $userCollegeTSPlaylist[0] -> c_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTSPAudiosList = DB::table('college_t_s_p_audios')->where('c_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userCollegeTSPlaylistsList = DB::table('user_college_t_s_playlists')->join('users', 'user_college_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_playlists.description', 'permissions', 'user_college_t_s_playlists.datetime', 'user_college_t_s_playlists.id', 'c_t_s_p_id')->where('c_t_s_p_id', $id)->where(function ($query) {$query->where('user_college_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSPlaylistViewsList = DB::table('users')->join('college_t_s_playlist_views', 'users.id', '=', 'college_t_s_playlist_views.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSPlaylistUpdatesList = DB::table('users')->join('college_t_s_playlist_updates', 'users.id', '=', 'college_t_s_playlist_updates.user_id')->where('c_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_college_t_s_playlists.edit')
                    ->with('userCollegeTSPlaylist', $userCollegeTSPlaylist)
                    ->with('id', $userCollegeTSPlaylist[0] -> c_t_s_p_id)
                    ->with('collegeTSPAudiosList', $collegeTSPAudiosList)
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

    public function update($id, UpdateUserCollegeTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userCollegeTSPlaylist = $this->userCollegeTSPlaylistRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userCollegeTSPlaylist))
            {
                Flash::error('User College T S Playlist not found');
                return redirect(route('userCollegeTSPlaylists.index'));
            }
    
            $user = DB::table('college_t_s_playlists')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_playlists.id', '=', $userCollegeTSPlaylist -> c_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollegeTSPlaylist -> user_id;
                $userCollegeTSPlaylist = $this->userCollegeTSPlaylistRepository->update($request->all(), $id);
                $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $userCollegeTSPlaylist -> c_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                       
                DB::table('u_c_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist -> id]);
         
                foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                {
                    DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', $collegeTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTSPlaylist -> permissions]);
                                            
                    $userCollegeTSPlaylistAudio = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $collegeTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userCollegeTSPlaylistAudio[0]))
                    {
                        DB::table('u_c_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPlaylistAudio[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_t_s_playlists')->join('users', 'users.id', '=', 'user_college_t_s_playlists.user_id')->where('user_college_t_s_playlists.id', '=', $userCollegeTSPlaylist -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_p_u', 'user_id' => $user_id, 'entity_id' => $userCollegeTSPlaylist -> c_t_s_p_id, 'created_at' => $now]);
            
                Flash::success('User College T S Playlist updated successfully.');
                return redirect(route('userCollegeTSPlaylists.show', [$userCollegeTSPlaylist -> c_t_s_p_id]));
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
            $userCollegeTSPlaylist = $this->userCollegeTSPlaylistRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if (empty($userCollegeTSPlaylist))
            {
                Flash::error('User College T S Playlist not found');
                return redirect(route('userCollegeTSPlaylists.index'));
            }
            
            $user = DB::table('college_t_s_playlists')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_playlists.id', '=', $userCollegeTSPlaylist -> c_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollegeTSPlaylist -> user_id;
                $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $userCollegeTSPlaylist -> c_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('u_c_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist -> id]);
                
                foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                {
                    DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', $collegeTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userCollegeTSPlaylistAudio = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $collegeTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userCollegeTSPlaylistAudio[0]))
                    {
                        DB::table('u_c_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPlaylistAudio[0] -> id]);
                    }
                }
        
                $this->userCollegeTSPlaylistRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_t_s_playlists')->join('users', 'users.id', '=', 'user_college_t_s_playlists.user_id')->where('user_college_t_s_playlists.id', '=', $userCollegeTSPlaylist -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_p_d', 'user_id' => $user_id, 'entity_id' => $userCollegeTSPlaylist -> c_t_s_p_id, 'created_at' => $now]);
            
                Flash::success('User College T S Playlist deleted successfully.');
                return redirect(route('userCollegeTSPlaylists.show', [$userCollegeTSPlaylist -> c_t_s_p_id]));
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