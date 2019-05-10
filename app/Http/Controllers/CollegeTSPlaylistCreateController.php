<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPlaylistCreateRequest;
use App\Http\Requests\UpdateCollegeTSPlaylistCreateRequest;
use App\Repositories\CollegeTSPlaylistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPlaylistCreateController extends AppBaseController
{
    private $collegeTSPlaylistCreateRepository;

    public function __construct(CollegeTSPlaylistCreateRepository $collegeTSPlaylistCreateRepo)
    {
        $this->collegeTSPlaylistCreateRepository = $collegeTSPlaylistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPlaylistCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPlaylistCreates = $this->collegeTSPlaylistCreateRepository->all();
    
            return view('college_t_s_playlist_creates.index')
                ->with('collegeTSPlaylistCreates', $collegeTSPlaylistCreates);
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
            return view('college_t_s_playlist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPlaylistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSPlaylistCreate = $this->collegeTSPlaylistCreateRepository->create($input);
            
                Flash::success('College T S Playlist Create saved successfully.');
                return redirect(route('collegeTSPlaylistCreates.index'));
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
            $collegeTSPlaylistCreate = $this->collegeTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistCreate))
            {
                Flash::error('College T S Playlist Create not found');
                return redirect(route('collegeTSPlaylistCreates.index'));
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
            
            if($user_id == $collegeTSPlaylistCreate -> user_id || $isShared)
            {
                return view('college_t_s_playlist_creates.show')->with('collegeTSPlaylistCreate', $collegeTSPlaylistCreate);
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
            $collegeTSPlaylistCreate = $this->collegeTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistCreate))
            {
                Flash::error('College T S Playlist Create not found');
                return redirect(route('collegeTSPlaylistCreates.index'));
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
            
            if($user_id == $collegeTSPlaylistCreate -> user_id || $isShared)
            {
                return view('college_t_s_playlist_creates.edit')->with('collegeTSPlaylistCreate', $collegeTSPlaylistCreate);
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

    public function update($id, UpdateCollegeTSPlaylistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSPlaylistCreate = $this->collegeTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistCreate))
            {
                Flash::error('College T S Playlist Create not found');
                return redirect(route('collegeTSPlaylistCreates.index'));
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
            
            if($user_id == $collegeTSPlaylistCreate -> user_id || $isShared)
            {
                $collegeTSPlaylistCreate = $this->collegeTSPlaylistCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S Playlist Create updated successfully.');
                return redirect(route('collegeTSPlaylistCreates.index'));
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
            $collegeTSPlaylistCreate = $this->collegeTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPlaylistCreate))
            {
                Flash::error('College T S Playlist Create not found');
                return redirect(route('collegeTSPlaylistCreates.index'));
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
            
            if($user_id == $collegeTSPlaylistCreate -> user_id || $isShared)
            {
                $this->collegeTSPlaylistCreateRepository->delete($id);
            
                Flash::success('College T S Playlist Create deleted successfully.');
                return redirect(route('collegeTSPlaylistCreates.index'));
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