<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPlaylistViewRequest;
use App\Http\Requests\UpdateCollegeTSPlaylistViewRequest;
use App\Repositories\CollegeTSPlaylistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPlaylistViewController extends AppBaseController
{
    private $collegeTSPlaylistViewRepository;

    public function __construct(CollegeTSPlaylistViewRepository $collegeTSPlaylistViewRepo)
    {
        $this->collegeTSPlaylistViewRepository = $collegeTSPlaylistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPlaylistViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPlaylistViews = $this->collegeTSPlaylistViewRepository->all();
    
            return view('college_t_s_playlist_views.index')
                ->with('collegeTSPlaylistViews', $collegeTSPlaylistViews);
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
            return view('college_t_s_playlist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPlaylistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSPlaylistView = $this->collegeTSPlaylistViewRepository->create($input);
            
                Flash::success('College T S Playlist View saved successfully.');
                return redirect(route('collegeTSPlaylistViews.index'));
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
            $collegeTSPlaylistView = $this->collegeTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistView))
            {
                Flash::error('College T S Playlist View not found');
                return redirect(route('collegeTSPlaylistViews.index'));
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
            
            if($user_id == $collegeTSPlaylistView -> user_id || $isShared)
            {
                return view('college_t_s_playlist_views.show')->with('collegeTSPlaylistView', $collegeTSPlaylistView);
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
            $collegeTSPlaylistView = $this->collegeTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistView))
            {
                Flash::error('College T S Playlist View not found');
                return redirect(route('collegeTSPlaylistViews.index'));
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
            
            if($user_id == $collegeTSPlaylistView -> user_id || $isShared)
            {
                return view('college_t_s_playlist_views.edit')->with('collegeTSPlaylistView', $collegeTSPlaylistView);
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

    public function update($id, UpdateCollegeTSPlaylistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $collegeTSPlaylistView = $this->collegeTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistView))
            {
                Flash::error('College T S Playlist View not found');
                return redirect(route('collegeTSPlaylistViews.index'));
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
            
            if($user_id == $collegeTSPlaylistView -> user_id || $isShared)
            {
                $collegeTSPlaylistView = $this->collegeTSPlaylistViewRepository->update($request->all(), $id);
            
                Flash::success('College T S Playlist View updated successfully.');
                return redirect(route('collegeTSPlaylistViews.index'));
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
            $collegeTSPlaylistView = $this->collegeTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistView))
            {
                Flash::error('College T S Playlist View not found');
                return redirect(route('collegeTSPlaylistViews.index'));
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
            
            if($user_id == $collegeTSPlaylistView -> user_id || $isShared)
            {
                $this->collegeTSPlaylistViewRepository->delete($id);
            
                Flash::success('College T S Playlist View deleted successfully.');
                return redirect(route('collegeTSPlaylistViews.index'));
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