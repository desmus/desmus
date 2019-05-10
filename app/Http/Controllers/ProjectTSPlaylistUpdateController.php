<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPlaylistUpdateRequest;
use App\Http\Requests\UpdateProjectTSPlaylistUpdateRequest;
use App\Repositories\ProjectTSPlaylistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPlaylistUpdateController extends AppBaseController
{
    private $projectTSPlaylistUpdateRepository;

    public function __construct(ProjectTSPlaylistUpdateRepository $projectTSPlaylistUpdateRepo)
    {
        $this->projectTSPlaylistUpdateRepository = $projectTSPlaylistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPlaylistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPlaylistUpdates = $this->projectTSPlaylistUpdateRepository->all();
    
            return view('project_t_s_playlist_updates.index')
                ->with('projectTSPlaylistUpdates', $projectTSPlaylistUpdates);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        if(Auth::user() != null)
        {
            return view('project_t_s_playlist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPlaylistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSPlaylistUpdate = $this->projectTSPlaylistUpdateRepository->create($input);
                
                Flash::success('Project T S Playlist Update saved successfully.');
                return redirect(route('projectTSPlaylistUpdates.index'));
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

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPlaylistUpdate = $this->projectTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistUpdate))
            {
                Flash::error('Project T S Playlist Update not found');
                return redirect(route('projectTSPlaylistUpdates.index'));
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
            
            if($user_id == $projectTSPlaylistUpdate -> user_id || $isShared)
            {
                return view('project_t_s_playlist_updates.show')->with('projectTSPlaylistUpdate', $projectTSPlaylistUpdate);
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
            $projectTSPlaylistUpdate = $this->projectTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistUpdate))
            {
                Flash::error('Project T S Playlist Update not found');
                return redirect(route('projectTSPlaylistUpdates.index'));
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
            
            if($user_id == $projectTSPlaylistUpdate -> user_id || $isShared)
            {
                return view('project_t_s_playlist_updates.edit')->with('projectTSPlaylistUpdate', $projectTSPlaylistUpdate);
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

    public function update($id, UpdateProjectTSPlaylistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPlaylistUpdate = $this->projectTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistUpdate))
            {
                Flash::error('Project T S Playlist Update not found');
                return redirect(route('projectTSPlaylistUpdates.index'));
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
            
            if($user_id == $projectTSPlaylistUpdate -> user_id || $isShared)
            {
                $projectTSPlaylistUpdate = $this->projectTSPlaylistUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Playlist Update updated successfully.');
                return redirect(route('projectTSPlaylistUpdates.index'));
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
            $user_id = Auth::user()->id;
            $projectTSPlaylistUpdate = $this->projectTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistUpdate))
            {
                Flash::error('Project T S Playlist Update not found');
                return redirect(route('projectTSPlaylistUpdates.index'));
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
            
            if($user_id == $projectTSPlaylistUpdate -> user_id || $isShared)
            {
                $this->projectTSPlaylistUpdateRepository->delete($id);
                
                Flash::success('Project T S Playlist Update deleted successfully.');
                return redirect(route('projectTSPlaylistUpdates.index'));
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