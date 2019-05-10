<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPlaylistDeleteRequest;
use App\Http\Requests\UpdateCollegeTSPlaylistDeleteRequest;
use App\Repositories\CollegeTSPlaylistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPlaylistDeleteController extends AppBaseController
{
    private $collegeTSPlaylistDeleteRepository;

    public function __construct(CollegeTSPlaylistDeleteRepository $collegeTSPlaylistDeleteRepo)
    {
        $this->collegeTSPlaylistDeleteRepository = $collegeTSPlaylistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPlaylistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPlaylistDeletes = $this->collegeTSPlaylistDeleteRepository->all();
    
            return view('college_t_s_playlist_deletes.index')
                ->with('collegeTSPlaylistDeletes', $collegeTSPlaylistDeletes);
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
            return view('college_t_s_playlist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPlaylistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSPlaylistDelete = $this->collegeTSPlaylistDeleteRepository->create($input);
            
                Flash::success('College T S Playlist Delete saved successfully.');
                return redirect(route('collegeTSPlaylistDeletes.index'));
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
            $collegeTSPlaylistDelete = $this->collegeTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistDelete))
            {
                Flash::error('College T S Playlist Delete not found');
                return redirect(route('collegeTSPlaylistDeletes.index'));
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
            
            if($user_id == $collegeTSPlaylistDelete -> user_id || $isShared)
            {
                return view('college_t_s_playlist_deletes.show')->with('collegeTSPlaylistDelete', $collegeTSPlaylistDelete);
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
            $collegeTSPlaylistDelete = $this->collegeTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistDelete))
            {
                Flash::error('College T S Playlist Delete not found');
                return redirect(route('collegeTSPlaylistDeletes.index'));
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
            
            if($user_id == $collegeTSPlaylistDelete -> user_id || $isShared)
            {
                return view('college_t_s_playlist_deletes.edit')->with('collegeTSPlaylistDelete', $collegeTSPlaylistDelete);
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

    public function update($id, UpdateCollegeTSPlaylistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSPlaylistDelete = $this->collegeTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistDelete))
            {
                Flash::error('College T S Playlist Delete not found');
                return redirect(route('collegeTSPlaylistDeletes.index'));
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
            
            if($user_id == $collegeTSPlaylistDelete -> user_id || $isShared)
            {
                $collegeTSPlaylistDelete = $this->collegeTSPlaylistDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S Playlist Delete updated successfully.');
                return redirect(route('collegeTSPlaylistDeletes.index'));
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
            $collegeTSPlaylistDelete = $this->collegeTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistDelete))
            {
                Flash::error('College T S Playlist Delete not found');
                return redirect(route('collegeTSPlaylistDeletes.index'));
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
            
            if($user_id == $collegeTSPlaylistDelete -> user_id || $isShared)
            {
                $this->collegeTSPlaylistDeleteRepository->delete($id);
            
                Flash::success('College T S Playlist Delete deleted successfully.');
                return redirect(route('collegeTSPlaylistDeletes.index'));
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