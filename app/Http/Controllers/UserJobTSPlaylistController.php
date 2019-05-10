<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserJobTSPlaylistRequest;
use App\Http\Requests\UpdateUserJobTSPlaylistRequest;
use App\Repositories\UserJobTSPlaylistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserJobTSPlaylistController extends AppBaseController
{
    private $userJobTSPlaylistRepository;

    public function __construct(UserJobTSPlaylistRepository $userJobTSPlaylistRepo)
    {
        $this->userJobTSPlaylistRepository = $userJobTSPlaylistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSPlaylistRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSPlaylists = $this->userJobTSPlaylistRepository->all();
    
            return view('user_job_t_s_playlists.index')
                ->with('userJobTSPlaylists', $userJobTSPlaylists);
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
            
            $jobTSPAudiosList = DB::table('job_t_s_p_audios')->where('j_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('job_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $userJobTSPlaylistsList = DB::table('user_job_t_s_playlists')->join('users', 'user_job_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_playlists.description', 'permissions', 'user_job_t_s_playlists.datetime', 'user_job_t_s_playlists.id', 'j_t_s_p_id')->where('j_t_s_p_id', $id)->where(function ($query) {$query->where('user_job_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $jobTSPlaylistViewsList = DB::table('users')->join('job_t_s_playlist_views', 'users.id', '=', 'job_t_s_playlist_views.user_id')->where('j_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $jobTSPlaylistUpdatesList = DB::table('users')->join('job_t_s_playlist_updates', 'users.id', '=', 'job_t_s_playlist_updates.user_id')->where('j_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_job_t_s_playlists.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('jobTSPAudiosList', $jobTSPAudiosList)
                ->with('userJobTSPlaylistsList', $userJobTSPlaylistsList)
                ->with('jobTSPlaylistViewsList', $jobTSPlaylistViewsList)
                ->with('jobTSPlaylistUpdatesList', $jobTSPlaylistUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $user = DB::table('job_t_s_playlists')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_playlists.id', '=', $request -> j_t_s_p_id)->get();
            
            $userJobTSPlaylistCheck = DB::table('user_job_t_s_playlists')->where('user_id', '=', $request -> user_id)->where('j_t_s_p_id', '=', $request -> j_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            if($userJobTSPlaylistCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $input = $request->all();
                    $userJobTSPlaylist = $this->userJobTSPlaylistRepository->create($input);
                    $jobTSPlaylistAudios = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $userJobTSPlaylist -> j_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('u_j_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_id' => $userJobTSPlaylist -> id]);
                    
                    foreach($jobTSPlaylistAudios as $jobTSPlaylistAudio)
                    {
                        DB::table('user_job_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userJobTSPlaylist -> user_id, 'description' => $userJobTSPlaylist -> description, 'j_t_s_p_a_id' => $jobTSPlaylistAudio -> id]);
                                           
                        $userJobTSPlaylistAudio = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $jobTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                        if(isset($userJobTSPlaylistAudio[0]))
                        {
                            DB::table('u_j_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPlaylistAudio[0] -> id]);
                        }
                    }
                    
                    $user = DB::table('user_job_t_s_playlists')->join('users', 'users.id', '=', 'user_job_t_s_playlists.user_id')->where('user_job_t_s_playlists.id', '=', $userJobTSPlaylist -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_p_c', 'user_id' => $user_id, 'entity_id' => $userJobTSPlaylist -> j_t_s_p_id, 'created_at' => $now]);
                
                    Flash::success('User Job T S Playlist saved successfully.');
                    return redirect(route('userJobTSPlaylists.show', [$userJobTSPlaylist -> j_t_s_p_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userJobTSPlaylists.show', [$request -> j_t_s_p_id]));
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
            $userJobTSPlaylist = $this->userJobTSPlaylistRepository->findWithoutFail($id);
            $userJobTSPlaylists = DB::table('user_job_t_s_playlists')->join('users', 'user_job_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_playlists.description', 'permissions', 'user_job_t_s_playlists.datetime', 'user_job_t_s_playlists.id', 'j_t_s_p_id')->where('j_t_s_p_id', $id)->where(function ($query) {$query->where('user_job_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userJobTSPlaylists[0]))
            {
                Flash::error('User Job T S Galerie not found');
                return redirect(route('userJobTSPlaylists.create', [$id]));
            }
            
            $user = DB::table('job_t_s_playlists')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_playlists.id', '=', $userJobTSPlaylists[0] -> j_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $jobTSPlaylist = DB::table('job_t_s_playlists')->where('id', '=', $userJobTSPlaylists[0] -> j_t_s_p_id)->get();
    
                $jobTSPAudiosList = DB::table('job_t_s_p_audios')->where('j_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('job_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userJobTSPlaylistsList = DB::table('user_job_t_s_playlists')->join('users', 'user_job_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_playlists.description', 'permissions', 'user_job_t_s_playlists.datetime', 'user_job_t_s_playlists.id', 'j_t_s_p_id')->where('j_t_s_p_id', $id)->where(function ($query) {$query->where('user_job_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSPlaylistViewsList = DB::table('users')->join('job_t_s_playlist_views', 'users.id', '=', 'job_t_s_playlist_views.user_id')->where('j_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSPlaylistUpdatesList = DB::table('users')->join('job_t_s_playlist_updates', 'users.id', '=', 'job_t_s_playlist_updates.user_id')->where('j_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_job_t_s_playlists.show')
                    ->with('userJobTSPlaylists', $userJobTSPlaylists)
                    ->with('jobTSPlaylist', $jobTSPlaylist)
                    ->with('id', $id)
                    ->with('jobTSPAudiosList', $jobTSPAudiosList)
                    ->with('userJobTSPlaylistsList', $userJobTSPlaylistsList)
                    ->with('jobTSPlaylistViewsList', $jobTSPlaylistViewsList)
                    ->with('jobTSPlaylistUpdatesList', $jobTSPlaylistUpdatesList);
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
            $userJobTSPlaylist = DB::table('users')->join('user_job_t_s_playlists', 'user_job_t_s_playlists.user_id', '=', 'users.id')->where('user_job_t_s_playlists.id', $id)->where(function ($query) {$query->where('user_job_t_s_playlists.deleted_at', '=', null);})->get();
    
            if(empty($userJobTSPlaylist[0]))
            {
                Flash::error('User Job T S Playlist not found');
                return redirect(route('userJobTSPlaylists.index'));
            }
    
            $user = DB::table('job_t_s_playlists')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_playlists.id', '=', $userJobTSPlaylist[0] -> j_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $jobTSPAudiosList = DB::table('job_t_s_p_audios')->where('j_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('job_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userJobTSPlaylistsList = DB::table('user_job_t_s_playlists')->join('users', 'user_job_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_playlists.description', 'permissions', 'user_job_t_s_playlists.datetime', 'user_job_t_s_playlists.id', 'j_t_s_p_id')->where('j_t_s_p_id', $id)->where(function ($query) {$query->where('user_job_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSPlaylistViewsList = DB::table('users')->join('job_t_s_playlist_views', 'users.id', '=', 'job_t_s_playlist_views.user_id')->where('j_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSPlaylistUpdatesList = DB::table('users')->join('job_t_s_playlist_updates', 'users.id', '=', 'job_t_s_playlist_updates.user_id')->where('j_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_job_t_s_playlists.edit')
                    ->with('userJobTSPlaylist', $userJobTSPlaylist)
                    ->with('id', $userJobTSPlaylist[0] -> j_t_s_p_id)
                    ->with('jobTSPAudiosList', $jobTSPAudiosList)
                    ->with('userJobTSPlaylistsList', $userJobTSPlaylistsList)
                    ->with('jobTSPlaylistViewsList', $jobTSPlaylistViewsList)
                    ->with('jobTSPlaylistUpdatesList', $jobTSPlaylistUpdatesList);
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

    public function update($id, UpdateUserJobTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userJobTSPlaylist = $this->userJobTSPlaylistRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userJobTSPlaylist))
            {
                Flash::error('User Job T S Playlist not found');
                return redirect(route('userJobTSPlaylists.index'));
            }
    
            $user = DB::table('job_t_s_playlists')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_playlists.id', '=', $userJobTSPlaylist -> j_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userJobTSPlaylist -> user_id;
                $userJobTSPlaylist = $this->userJobTSPlaylistRepository->update($request->all(), $id);
                $jobTSPlaylistAudios = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $userJobTSPlaylist -> j_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                       
                DB::table('u_j_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_id' => $userJobTSPlaylist -> id]);
         
                foreach($jobTSPlaylistAudios as $jobTSPlaylistAudio)
                {
                    DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', $jobTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJobTSPlaylist -> permissions]);
                                            
                    $userJobTSPlaylistAudio = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $jobTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userJobTSPlaylistAudio[0]))
                    {
                        DB::table('u_j_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPlaylistAudio[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_t_s_playlists')->join('users', 'users.id', '=', 'user_job_t_s_playlists.user_id')->where('user_job_t_s_playlists.id', '=', $userJobTSPlaylist -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_p_u', 'user_id' => $user_id, 'entity_id' => $userJobTSPlaylist -> j_t_s_p_id, 'created_at' => $now]);
            
                Flash::success('User Job T S Playlist updated successfully.');
                return redirect(route('userJobTSPlaylists.show', [$userJobTSPlaylist -> j_t_s_p_id]));
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
            $userJobTSPlaylist = $this->userJobTSPlaylistRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userJobTSPlaylist))
            {
                Flash::error('User Job T S Playlist not found');
                return redirect(route('userJobTSPlaylists.index'));
            }
            
            $user = DB::table('job_t_s_playlists')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_playlists.id', '=', $userJobTSPlaylist -> j_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userJobTSPlaylist -> user_id;
                $jobTSPlaylistAudios = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $userJobTSPlaylist -> j_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('u_j_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_id' => $userJobTSPlaylist -> id]);
                
                foreach($jobTSPlaylistAudios as $jobTSPlaylistAudio)
                {
                    DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', $jobTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userJobTSPlaylistAudio = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $jobTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userJobTSPlaylistAudio[0]))
                    {
                        DB::table('u_j_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPlaylistAudio[0] -> id]);
                    }
                }
        
                $this->userJobTSPlaylistRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_t_s_playlists')->join('users', 'users.id', '=', 'user_job_t_s_playlists.user_id')->where('user_job_t_s_playlists.id', '=', $userJobTSPlaylist -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_p_d', 'user_id' => $user_id, 'entity_id' => $userJobTSPlaylist -> j_t_s_p_id, 'created_at' => $now]);
            
                Flash::success('User Job T S Playlist deleted successfully.');
                return redirect(route('userJobTSPlaylists.show', [$userJobTSPlaylist -> j_t_s_p_id]));
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