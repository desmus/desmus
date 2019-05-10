<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPlaylistUpdateRequest;
use App\Http\Requests\UpdateJobTSPlaylistUpdateRequest;
use App\Repositories\JobTSPlaylistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPlaylistUpdateController extends AppBaseController
{
    private $jobTSPlaylistUpdateRepository;

    public function __construct(JobTSPlaylistUpdateRepository $jobTSPlaylistUpdateRepo)
    {
        $this->jobTSPlaylistUpdateRepository = $jobTSPlaylistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPlaylistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPlaylistUpdates = $this->jobTSPlaylistUpdateRepository->all();
    
            return view('job_t_s_playlist_updates.index')
                ->with('jobTSPlaylistUpdates', $jobTSPlaylistUpdates);
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
            return view('job_t_s_playlist_updates.jreate');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPlaylistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSPlaylistUpdate = $this->jobTSPlaylistUpdateRepository->create($input);
            
                Flash::success('Job T S Playlist Update saved successfully.');
                return redirect(route('jobTSPlaylistUpdates.index'));
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
            $jobTSPlaylistUpdate = $this->jobTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistUpdate))
            {
                Flash::error('Job T S Playlist Update not found');
                return redirect(route('jobTSPlaylistUpdates.index'));
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
            
            if($user_id == $jobTSPlaylistUpdate -> user_id || $isShared)
            {
                return view('job_t_s_playlist_updates.show')->with('jobTSPlaylistUpdate', $jobTSPlaylistUpdate);
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
            $jobTSPlaylistUpdate = $this->jobTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistUpdate))
            {
                Flash::error('Job T S Playlist Update not found');
                return redirect(route('jobTSPlaylistUpdates.index'));
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
            
            if($user_id == $jobTSPlaylistUpdate -> user_id || $isShared)
            {
                return view('job_t_s_playlist_updates.edit')->with('jobTSPlaylistUpdate', $jobTSPlaylistUpdate);
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

    public function update($id, UpdateJobTSPlaylistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSPlaylistUpdate = $this->jobTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistUpdate))
            {
                Flash::error('Job T S Playlist Update not found');
                return redirect(route('jobTSPlaylistUpdates.index'));
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
            
            if($user_id == $jobTSPlaylistUpdate -> user_id || $isShared)
            {
                $jobTSPlaylistUpdate = $this->jobTSPlaylistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Playlist Update updated successfully.');
                return redirect(route('jobTSPlaylistUpdates.index'));
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
            $jobTSPlaylistUpdate = $this->jobTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistUpdate))
            {
                Flash::error('Job T S Playlist Update not found');
                return redirect(route('jobTSPlaylistUpdates.index'));
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
            
            if($user_id == $jobTSPlaylistUpdate -> user_id || $isShared)
            {
                $this->jobTSPlaylistUpdateRepository->delete($id);
            
                Flash::success('Job T S Playlist Update deleted successfully.');
                return redirect(route('jobTSPlaylistUpdates.index'));
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