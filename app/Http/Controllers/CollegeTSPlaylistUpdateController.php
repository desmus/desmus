<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPlaylistUpdateRequest;
use App\Http\Requests\UpdateCollegeTSPlaylistUpdateRequest;
use App\Repositories\CollegeTSPlaylistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPlaylistUpdateController extends AppBaseController
{
    private $collegeTSPlaylistUpdateRepository;

    public function __construct(CollegeTSPlaylistUpdateRepository $collegeTSPlaylistUpdateRepo)
    {
        $this->collegeTSPlaylistUpdateRepository = $collegeTSPlaylistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPlaylistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPlaylistUpdates = $this->collegeTSPlaylistUpdateRepository->all();
    
            return view('college_t_s_playlist_updates.index')
                ->with('collegeTSPlaylistUpdates', $collegeTSPlaylistUpdates);
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
            return view('college_t_s_playlist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPlaylistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSPlaylistUpdate = $this->collegeTSPlaylistUpdateRepository->create($input);
            
                Flash::success('College T S Playlist Update saved successfully.');
                return redirect(route('collegeTSPlaylistUpdates.index'));
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
            $collegeTSPlaylistUpdate = $this->collegeTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistUpdate))
            {
                Flash::error('College T S Playlist Update not found');
                return redirect(route('collegeTSPlaylistUpdates.index'));
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
            
            if($user_id == $collegeTSPlaylistUpdate -> user_id || $isShared)
            {
                return view('college_t_s_playlist_updates.show')->with('collegeTSPlaylistUpdate', $collegeTSPlaylistUpdate);
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
            $collegeTSPlaylistUpdate = $this->collegeTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistUpdate))
            {
                Flash::error('College T S Playlist Update not found');
                return redirect(route('collegeTSPlaylistUpdates.index'));
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
            
            if($user_id == $collegeTSPlaylistUpdate -> user_id || $isShared)
            {
                return view('college_t_s_playlist_updates.edit')->with('collegeTSPlaylistUpdate', $collegeTSPlaylistUpdate);
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

    public function update($id, UpdateCollegeTSPlaylistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSPlaylistUpdate = $this->collegeTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistUpdate))
            {
                Flash::error('College T S Playlist Update not found');
                return redirect(route('collegeTSPlaylistUpdates.index'));
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
            
            if($user_id == $collegeTSPlaylistUpdate -> user_id || $isShared)
            {
                $collegeTSPlaylistUpdate = $this->collegeTSPlaylistUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S Playlist Update updated successfully.');
                return redirect(route('collegeTSPlaylistUpdates.index'));
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
            $collegeTSPlaylistUpdate = $this->collegeTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistUpdate))
            {
                Flash::error('College T S Playlist Update not found');
                return redirect(route('collegeTSPlaylistUpdates.index'));
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
            
            if($user_id == $collegeTSPlaylistUpdate -> user_id || $isShared)
            {
                $this->collegeTSPlaylistUpdateRepository->delete($id);
            
                Flash::success('College T S Playlist Update deleted successfully.');
                return redirect(route('collegeTSPlaylistUpdates.index'));
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