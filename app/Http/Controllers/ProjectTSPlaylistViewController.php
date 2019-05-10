<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPlaylistViewRequest;
use App\Http\Requests\UpdateProjectTSPlaylistViewRequest;
use App\Repositories\ProjectTSPlaylistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPlaylistViewController extends AppBaseController
{
    private $projectTSPlaylistViewRepository;

    public function __construct(ProjectTSPlaylistViewRepository $projectTSPlaylistViewRepo)
    {
        $this->projectTSPlaylistViewRepository = $projectTSPlaylistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPlaylistViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPlaylistViews = $this->projectTSPlaylistViewRepository->all();
    
            return view('project_t_s_playlist_views.index')
                ->with('projectTSPlaylistViews', $projectTSPlaylistViews);
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
            return view('project_t_s_playlist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPlaylistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSPlaylistView = $this->projectTSPlaylistViewRepository->create($input);
                
                Flash::success('Project T S Playlist View saved successfully.');
                return redirect(route('projectTSPlaylistViews.index'));
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
            $projectTSPlaylistView = $this->projectTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistView))
            {
                Flash::error('Project T S Playlist View not found');
                return redirect(route('projectTSPlaylistViews.index'));
            }
            
            $userProjectTSPlaylists = DB::table('user_project_t_s_playlists')->where('c_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPlaylists as $userProjectTSPlaylist)
            {
                if($userProjectTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.c_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $projectTSPlaylistView -> user_id || $isShared)
            {
                return view('project_t_s_playlist_views.show')->with('projectTSPlaylistView', $projectTSPlaylistView);
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
            $projectTSPlaylistView = $this->projectTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistView))
            {
                Flash::error('Project T S Playlist View not found');
                return redirect(route('projectTSPlaylistViews.index'));
            }
    
            $userProjectTSPlaylists = DB::table('user_project_t_s_playlists')->where('c_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPlaylists as $userProjectTSPlaylist)
            {
                if($userProjectTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.c_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $projectTSPlaylistView -> user_id || $isShared)
            {
                return view('project_t_s_playlist_views.edit')->with('projectTSPlaylistView', $projectTSPlaylistView);
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

    public function update($id, UpdateProjectTSPlaylistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $projectTSPlaylistView = $this->projectTSPlaylistViewRepository->findWithoutFail($id);
    
            if (empty($projectTSPlaylistView))
            {
                Flash::error('Project T S Playlist View not found');
                return redirect(route('projectTSPlaylistViews.index'));
            }
    
            $userProjectTSPlaylists = DB::table('user_project_t_s_playlists')->where('c_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPlaylists as $userProjectTSPlaylist)
            {
                if($userProjectTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.c_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $projectTSPlaylistView -> user_id || $isShared)
            {
                $projectTSPlaylistView = $this->projectTSPlaylistViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S Playlist View updated successfully.');
                return redirect(route('projectTSPlaylistViews.index'));
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
            $projectTSPlaylistView = $this->projectTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistView))
            {
                Flash::error('Project T S Playlist View not found');
                return redirect(route('projectTSPlaylistViews.index'));
            }
    
            $userProjectTSPlaylists = DB::table('user_project_t_s_playlists')->where('c_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPlaylists as $userProjectTSPlaylist)
            {
                if($userProjectTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_playlists')->join('project_topic_sections', 'project_t_s_playlists.c_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $projectTSPlaylistView -> user_id || $isShared)
            {
                $this->projectTSPlaylistViewRepository->delete($id);
                
                Flash::success('Project T S Playlist View deleted successfully.');
                return redirect(route('projectTSPlaylistViews.index'));
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