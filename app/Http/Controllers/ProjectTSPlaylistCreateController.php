<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPlaylistCreateRequest;
use App\Http\Requests\UpdateProjectTSPlaylistCreateRequest;
use App\Repositories\ProjectTSPlaylistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPlaylistCreateController extends AppBaseController
{
    private $projectTSPlaylistCreateRepository;

    public function __construct(ProjectTSPlaylistCreateRepository $projectTSPlaylistCreateRepo)
    {
        $this->projectTSPlaylistCreateRepository = $projectTSPlaylistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPlaylistCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPlaylistCreates = $this->projectTSPlaylistCreateRepository->all();
    
            return view('project_t_s_playlist_creates.index')
                ->with('projectTSPlaylistCreates', $projectTSPlaylistCreates);
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
            return view('project_t_s_playlist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPlaylistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSPlaylistCreate = $this->projectTSPlaylistCreateRepository->create($input);
                
                Flash::success('Project T S Playlist Create saved successfully.');
                return redirect(route('projectTSPlaylistCreates.index'));
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
            $projectTSPlaylistCreate = $this->projectTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistCreate))
            {
                Flash::error('Project T S Playlist Create not found');
                return redirect(route('projectTSPlaylistCreates.index'));
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
            
            if($user_id == $projectTSPlaylistCreate -> user_id || $isShared)
            {
                return view('project_t_s_playlist_creates.show')->with('projectTSPlaylistCreate', $projectTSPlaylistCreate);
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
            $projectTSPlaylistCreate = $this->projectTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistCreate))
            {
                Flash::error('Project T S Playlist Create not found');
                return redirect(route('projectTSPlaylistCreates.index'));
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
            
            if($user_id == $projectTSPlaylistCreate -> user_id || $isShared)
            {
                return view('project_t_s_playlist_creates.edit')->with('projectTSPlaylistCreate', $projectTSPlaylistCreate);
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

    public function update($id, UpdateProjectTSPlaylistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPlaylistCreate = $this->projectTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistCreate))
            {
                Flash::error('Project T S Playlist Create not found');
                return redirect(route('projectTSPlaylistCreates.index'));
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
            
            if($user_id == $projectTSPlaylistCreate -> user_id || $isShared)
            {
                $projectTSPlaylistCreate = $this->projectTSPlaylistCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Playlist Create updated successfully.');
                return redirect(route('projectTSPlaylistCreates.index'));
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
            $projectTSPlaylistCreate = $this->projectTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPlaylistCreate))
            {
                Flash::error('Project T S Playlist Create not found');
                return redirect(route('projectTSPlaylistCreates.index'));
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
            
            if($user_id == $projectTSPlaylistCreate -> user_id || $isShared)
            {
                $this->projectTSPlaylistCreateRepository->delete($id);
                
                Flash::success('Project T S Playlist Create deleted successfully.');
                return redirect(route('projectTSPlaylistCreates.index'));
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