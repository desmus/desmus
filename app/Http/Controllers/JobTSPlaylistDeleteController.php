<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPlaylistDeleteRequest;
use App\Http\Requests\UpdateJobTSPlaylistDeleteRequest;
use App\Repositories\JobTSPlaylistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPlaylistDeleteController extends AppBaseController
{
    private $jobTSPlaylistDeleteRepository;

    public function __construct(JobTSPlaylistDeleteRepository $jobTSPlaylistDeleteRepo)
    {
        $this->jobTSPlaylistDeleteRepository = $jobTSPlaylistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPlaylistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPlaylistDeletes = $this->jobTSPlaylistDeleteRepository->all();
    
            return view('job_t_s_playlist_deletes.index')
                ->with('jobTSPlaylistDeletes', $jobTSPlaylistDeletes);
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
            return view('job_t_s_playlist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPlaylistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSPlaylistDelete = $this->jobTSPlaylistDeleteRepository->create($input);
            
                Flash::success('Job T S Playlist Delete saved successfully.');
                return redirect(route('jobTSPlaylistDeletes.index'));
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
            $jobTSPlaylistDelete = $this->jobTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistDelete))
            {
                Flash::error('Job T S Playlist Delete not found');
                return redirect(route('jobTSPlaylistDeletes.index'));
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
            
            if($user_id == $jobTSPlaylistDelete -> user_id || $isShared)
            {
                return view('job_t_s_playlist_deletes.show')->with('jobTSPlaylistDelete', $jobTSPlaylistDelete);
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
            $jobTSPlaylistDelete = $this->jobTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistDelete))
            {
                Flash::error('Job T S Playlist Delete not found');
                return redirect(route('jobTSPlaylistDeletes.index'));
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
            
            if($user_id == $jobTSPlaylistDelete -> user_id || $isShared)
            {
                return view('job_t_s_playlist_deletes.edit')->with('jobTSPlaylistDelete', $jobTSPlaylistDelete);
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

    public function update($id, UpdateJobTSPlaylistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSPlaylistDelete = $this->jobTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistDelete))
            {
                Flash::error('Job T S Playlist Delete not found');
                return redirect(route('jobTSPlaylistDeletes.index'));
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
            
            if($user_id == $jobTSPlaylistDelete -> user_id || $isShared)
            {
                $jobTSPlaylistDelete = $this->jobTSPlaylistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S Playlist Delete updated successfully.');
                return redirect(route('jobTSPlaylistDeletes.index'));
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
            $jobTSPlaylistDelete = $this->jobTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistDelete))
            {
                Flash::error('Job T S Playlist Delete not found');
                return redirect(route('jobTSPlaylistDeletes.index'));
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
            
            if($user_id == $jobTSPlaylistDelete -> user_id || $isShared)
            {
                $this->jobTSPlaylistDeleteRepository->delete($id);
            
                Flash::success('Job T S Playlist Delete deleted successfully.');
                return redirect(route('jobTSPlaylistDeletes.index'));
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