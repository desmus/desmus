<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPlaylistDeleteRequest;
use App\Http\Requests\UpdateProjectTSPlaylistDeleteRequest;
use App\Repositories\ProjectTSPlaylistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPlaylistDeleteController extends AppBaseController
{
    private $projectTSPlaylistDeleteRepository;

    public function __construct(ProjectTSPlaylistDeleteRepository $projectTSPlaylistDeleteRepo)
    {
        $this->projectTSPlaylistDeleteRepository = $projectTSPlaylistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPlaylistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPlaylistDeletes = $this->projectTSPlaylistDeleteRepository->all();
    
            return view('project_t_s_playlist_deletes.index')
                ->with('projectTSPlaylistDeletes', $projectTSPlaylistDeletes);
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
            return view('project_t_s_playlist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPlaylistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSPlaylistDelete = $this->projectTSPlaylistDeleteRepository->create($input);
                
                Flash::success('Project T S Playlist Delete saved successfully.');
                return redirect(route('projectTSPlaylistDeletes.index'));
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
            $projectTSPlaylistDelete = $this->projectTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistDelete))
            {
                Flash::error('Project T S Playlist Delete not found');
                return redirect(route('projectTSPlaylistDeletes.index'));
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
            
            if($user_id == $projectTSPlaylistDelete -> user_id || $isShared)
            {
                return view('project_t_s_playlist_deletes.show')->with('projectTSPlaylistDelete', $projectTSPlaylistDelete);
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
            $projectTSPlaylistDelete = $this->projectTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistDelete))
            {
                Flash::error('Project T S Playlist Delete not found');
                return redirect(route('projectTSPlaylistDeletes.index'));
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
            
            if($user_id == $projectTSPlaylistDelete -> user_id || $isShared)
            {
                return view('project_t_s_playlist_deletes.edit')->with('projectTSPlaylistDelete', $projectTSPlaylistDelete);
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

    public function update($id, UpdateProjectTSPlaylistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPlaylistDelete = $this->projectTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistDelete))
            {
                Flash::error('Project T S Playlist Delete not found');
                return redirect(route('projectTSPlaylistDeletes.index'));
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
            
            if($user_id == $projectTSPlaylistDelete -> user_id || $isShared)
            {
                $projectTSPlaylistDelete = $this->projectTSPlaylistDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S Playlist Delete updated successfully.');
                return redirect(route('projectTSPlaylistDeletes.index'));
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
            $projectTSPlaylistDelete = $this->projectTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistDelete))
            {
                Flash::error('Project T S Playlist Delete not found');
                return redirect(route('projectTSPlaylistDeletes.index'));
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
            
            if($user_id == $projectTSPlaylistDelete -> user_id || $isShared)
            {
                $this->projectTSPlaylistDeleteRepository->delete($id);
                
                Flash::success('Project T S Playlist Delete deleted successfully.');
                return redirect(route('projectTSPlaylistDeletes.index'));
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