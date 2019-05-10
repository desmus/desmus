<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserProjectTSPlaylistRequest;
use App\Http\Requests\UpdateUserProjectTSPlaylistRequest;
use App\Repositories\UserProjectTSPlaylistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserProjectTSPlaylistController extends AppBaseController
{
    private $userProjectTSPlaylistRepository;

    public function __construct(UserProjectTSPlaylistRepository $userProjectTSPlaylistRepo)
    {
        $this->userProjectTSPlaylistRepository = $userProjectTSPlaylistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSPlaylistRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSPlaylists = $this->userProjectTSPlaylistRepository->all();
    
            return view('user_project_t_s_playlists.index')
                ->with('userProjectTSPlaylists', $userProjectTSPlaylists);
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
            
            $projectTSPAudiosList = DB::table('project_t_s_p_audios')->where('p_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('project_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $projectTSPlaylistViewsList = DB::table('users')->join('project_t_s_playlist_views', 'users.id', '=', 'project_t_s_playlist_views.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTSPlaylistUpdatesList = DB::table('users')->join('project_t_s_playlist_updates', 'users.id', '=', 'project_t_s_playlist_updates.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $userProjectTSPlaylistsList = DB::table('user_project_t_s_playlists')->join('users', 'user_project_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_playlists.description', 'permissions', 'user_project_t_s_playlists.datetime', 'user_project_t_s_playlists.id', 'p_t_s_p_id')->where('p_t_s_p_id', $id)->where(function ($query) {$query->where('user_project_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            return view('user_project_t_s_playlists.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('projectTSPAudiosList', $projectTSPAudiosList)
                ->with('projectTSPlaylistViewsList', $projectTSPlaylistViewsList)
                ->with('projectTSPlaylistUpdatesList', $projectTSPlaylistUpdatesList)
                ->with('userProjectTSPlaylistsList', $userProjectTSPlaylistsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_playlists.id', '=', $request -> p_t_s_p_id)->get();
            
            $userProjectTSPlaylistCheck = DB::table('user_project_t_s_playlists')->where('user_id', '=', $request -> user_id)->where('p_t_s_p_id', '=', $request -> p_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            if($userProjectTSPlaylistCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $input = $request->all();
                    $userProjectTSPlaylist = $this->userProjectTSPlaylistRepository->create($input);
                    $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $userProjectTSPlaylist -> p_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('u_p_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist -> id]);
                    
                    foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                    {
                        DB::table('user_project_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userProjectTSPlaylist -> user_id, 'description' => $userProjectTSPlaylist -> description, 'p_t_s_p_a_id' => $projectTSPlaylistAudio -> id]);
                                           
                        $userProjectTSPlaylistAudio = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $projectTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                        if(isset($userProjectTSPlaylistAudio[0]))
                        {
                            DB::table('u_p_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPlaylistAudio[0] -> id]);
                        }
                    }
                    
                    $user = DB::table('user_project_t_s_playlists')->join('users', 'users.id', '=', 'user_project_t_s_playlists.user_id')->where('user_project_t_s_playlists.id', '=', $userProjectTSPlaylist -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_p_c', 'user_id' => $user_id, 'entity_id' => $userProjectTSPlaylist -> p_t_s_p_id, 'created_at' => $now]);
                
                    Flash::success('User Project T S Playlist saved successfully.');
                    return redirect(route('userProjectTSPlaylists.show', [$userProjectTSPlaylist -> p_t_s_p_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userProjectTSPlaylists.show', [$request -> p_t_s_p_id]));
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
            $userProjectTSPlaylist = $this->userProjectTSPlaylistRepository->findWithoutFail($id);
            $userProjectTSPlaylists = DB::table('user_project_t_s_playlists')->join('users', 'user_project_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_playlists.description', 'permissions', 'user_project_t_s_playlists.datetime', 'user_project_t_s_playlists.id', 'p_t_s_p_id')->where('p_t_s_p_id', $id)->where(function ($query) {$query->where('user_project_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userProjectTSPlaylists[0]))
            {
                Flash::error('User Project T S Galerie not found');
                return redirect(route('userProjectTSPlaylists.create', [$id]));
            }
            
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_playlists.id', '=', $userProjectTSPlaylists[0] -> p_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTSPlaylist = DB::table('project_t_s_playlists')->where('id', '=', $userProjectTSPlaylists[0] -> p_t_s_p_id)->get();
    
                $projectTSPAudiosList = DB::table('project_t_s_p_audios')->where('p_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('project_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $projectTSPlaylistViewsList = DB::table('users')->join('project_t_s_playlist_views', 'users.id', '=', 'project_t_s_playlist_views.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSPlaylistUpdatesList = DB::table('users')->join('project_t_s_playlist_updates', 'users.id', '=', 'project_t_s_playlist_updates.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userProjectTSPlaylistsList = DB::table('user_project_t_s_playlists')->join('users', 'user_project_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_playlists.description', 'permissions', 'user_project_t_s_playlists.datetime', 'user_project_t_s_playlists.id', 'p_t_s_p_id')->where('p_t_s_p_id', $id)->where(function ($query) {$query->where('user_project_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
                return view('user_project_t_s_playlists.show')
                    ->with('userProjectTSPlaylists', $userProjectTSPlaylists)
                    ->with('projectTSPlaylist', $projectTSPlaylist)
                    ->with('id', $id)
                    ->with('projectTSPAudiosList', $projectTSPAudiosList)
                    ->with('projectTSPlaylistViewsList', $projectTSPlaylistViewsList)
                    ->with('projectTSPlaylistUpdatesList', $projectTSPlaylistUpdatesList)
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

    public function edit($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSPlaylist = DB::table('users')->join('user_project_t_s_playlists', 'user_project_t_s_playlists.user_id', '=', 'users.id')->where('user_project_t_s_playlists.id', $id)->where(function ($query) {$query->where('user_project_t_s_playlists.deleted_at', '=', null);})->get();
    
            if(empty($userProjectTSPlaylist[0]))
            {
                Flash::error('User Project T S Playlist not found');
                return redirect(route('userProjectTSPlaylists.index'));
            }
    
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_playlists.id', '=', $userProjectTSPlaylist[0] -> p_t_s_p_id)->get();
            
            $projectTSPAudiosList = DB::table('project_t_s_p_audios')->where('p_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('project_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $projectTSPlaylistViewsList = DB::table('users')->join('project_t_s_playlist_views', 'users.id', '=', 'project_t_s_playlist_views.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTSPlaylistUpdatesList = DB::table('users')->join('project_t_s_playlist_updates', 'users.id', '=', 'project_t_s_playlist_updates.user_id')->where('p_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $userProjectTSPlaylistsList = DB::table('user_project_t_s_playlists')->join('users', 'user_project_t_s_playlists.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_playlists.description', 'permissions', 'user_project_t_s_playlists.datetime', 'user_project_t_s_playlists.id', 'p_t_s_p_id')->where('p_t_s_p_id', $id)->where(function ($query) {$query->where('user_project_t_s_playlists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('user_project_t_s_playlists.edit')
                    ->with('userProjectTSPlaylist', $userProjectTSPlaylist)
                    ->with('id', $userProjectTSPlaylist[0] -> p_t_s_p_id)
                    ->with('projectTSPAudiosList', $projectTSPAudiosList)
                    ->with('projectTSPlaylistViewsList', $projectTSPlaylistViewsList)
                    ->with('projectTSPlaylistUpdatesList', $projectTSPlaylistUpdatesList)
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

    public function update($id, UpdateUserProjectTSPlaylistRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userProjectTSPlaylist = $this->userProjectTSPlaylistRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userProjectTSPlaylist))
            {
                Flash::error('User Project T S Playlist not found');
                return redirect(route('userProjectTSPlaylists.index'));
            }
    
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_playlists.id', '=', $userProjectTSPlaylist -> p_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProjectTSPlaylist -> user_id;
                $userProjectTSPlaylist = $this->userProjectTSPlaylistRepository->update($request->all(), $id);
                $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $userProjectTSPlaylist -> p_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                       
                DB::table('u_p_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist -> id]);
         
                foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                {
                    DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', $projectTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTSPlaylist -> permissions]);
                                            
                    $userProjectTSPlaylistAudio = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $projectTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userProjectTSPlaylistAudio[0]))
                    {
                        DB::table('u_p_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPlaylistAudio[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_t_s_playlists')->join('users', 'users.id', '=', 'user_project_t_s_playlists.user_id')->where('user_project_t_s_playlists.id', '=', $userProjectTSPlaylist -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_p_u', 'user_id' => $user_id, 'entity_id' => $userProjectTSPlaylist -> p_t_s_p_id, 'created_at' => $now]);
            
                Flash::success('User Project T S Playlist updated successfully.');
                return redirect(route('userProjectTSPlaylists.show', [$userProjectTSPlaylist -> p_t_s_p_id]));
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
            $userProjectTSPlaylist = $this->userProjectTSPlaylistRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userProjectTSPlaylist))
            {
                Flash::error('User Project T S Playlist not found');
                return redirect(route('userProjectTSPlaylists.index'));
            }
            
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_playlists.id', '=', $userProjectTSPlaylist -> p_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProjectTSPlaylist -> user_id;
                $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $userProjectTSPlaylist -> p_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('u_p_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist -> id]);
                
                foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                {
                    DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', $projectTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userProjectTSPlaylistAudio = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $projectTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userProjectTSPlaylistAudio[0]))
                    {
                        DB::table('u_p_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPlaylistAudio[0] -> id]);
                    }
                }
        
                $this->userProjectTSPlaylistRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_t_s_playlists')->join('users', 'users.id', '=', 'user_project_t_s_playlists.user_id')->where('user_project_t_s_playlists.id', '=', $userProjectTSPlaylist -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_p_d', 'user_id' => $user_id, 'entity_id' => $userProjectTSPlaylist -> p_t_s_p_id, 'created_at' => $now]);
            
                Flash::success('User Project T S Playlist deleted successfully.');
                return redirect(route('userProjectTSPlaylists.show', [$userProjectTSPlaylist -> p_t_s_p_id]));
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