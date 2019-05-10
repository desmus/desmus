<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPlaylistCreateRequest;
use App\Http\Requests\UpdateJobTSPlaylistCreateRequest;
use App\Repositories\JobTSPlaylistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPlaylistCreateController extends AppBaseController
{
    private $jobTSPlaylistCreateRepository;

    public function __construct(JobTSPlaylistCreateRepository $jobTSPlaylistCreateRepo)
    {
        $this->jobTSPlaylistCreateRepository = $jobTSPlaylistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPlaylistCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPlaylistCreates = $this->jobTSPlaylistCreateRepository->all();
    
            return view('job_t_s_playlist_creates.index')
                ->with('jobTSPlaylistCreates', $jobTSPlaylistCreates);
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
            return view('job_t_s_playlist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPlaylistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSPlaylistCreate = $this->jobTSPlaylistCreateRepository->create($input);
            
                Flash::success('Job T S Playlist Create saved successfully.');
                return redirect(route('jobTSPlaylistCreates.index'));
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
            $jobTSPlaylistCreate = $this->jobTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistCreate))
            {
                Flash::error('Job T S Playlist Create not found');
                return redirect(route('jobTSPlaylistCreates.index'));
            }
            
            $userJobTSPlaylists = DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSPlaylists as $userJobTSPlaylist)
            {
                if($userJobTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_playlists')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $jobTSPlaylistCreate -> user_id || $isShared)
            {
                return view('job_t_s_playlist_creates.show')->with('jobTSPlaylistCreate', $jobTSPlaylistCreate);
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
            $jobTSPlaylistCreate = $this->jobTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistCreate))
            {
                Flash::error('Job T S Playlist Create not found');
                return redirect(route('jobTSPlaylistCreates.index'));
            }
            
            $userJobTSPlaylists = DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSPlaylists as $userJobTSPlaylist)
            {
                if($userJobTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_playlists')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $jobTSPlaylistCreate -> user_id || $isShared)
            {
                return view('job_t_s_playlist_creates.edit')->with('jobTSPlaylistCreate', $jobTSPlaylistCreate);
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

    public function update($id, UpdateJobTSPlaylistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSPlaylistCreate = $this->jobTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistCreate))
            {
                Flash::error('Job T S Playlist Create not found');
                return redirect(route('jobTSPlaylistCreates.index'));
            }
            
            $userJobTSPlaylists = DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSPlaylists as $userJobTSPlaylist)
            {
                if($userJobTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_playlists')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $jobTSPlaylistCreate -> user_id || $isShared)
            {
                $jobTSPlaylistCreate = $this->jobTSPlaylistCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Playlist Create updated successfully.');
                return redirect(route('jobTSPlaylistCreates.index'));
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
            $jobTSPlaylistCreate = $this->jobTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistCreate))
            {
                Flash::error('Job T S Playlist Create not found');
                return redirect(route('jobTSPlaylistCreates.index'));
            }
    
            $userJobTSPlaylists = DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSPlaylists as $userJobTSPlaylist)
            {
                if($userJobTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_playlists')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $jobTSPlaylistCreate -> user_id || $isShared)
            {
                $this->jobTSPlaylistCreateRepository->delete($id);
            
                Flash::success('Job T S Playlist Create deleted successfully.');
                return redirect(route('jobTSPlaylistCreates.index'));
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