<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPlaylistViewRequest;
use App\Http\Requests\UpdateJobTSPlaylistViewRequest;
use App\Repositories\JobTSPlaylistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPlaylistViewController extends AppBaseController
{
    private $jobTSPlaylistViewRepository;

    public function __construct(JobTSPlaylistViewRepository $jobTSPlaylistViewRepo)
    {
        $this->jobTSPlaylistViewRepository = $jobTSPlaylistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPlaylistViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPlaylistViews = $this->jobTSPlaylistViewRepository->all();
    
            return view('job_t_s_playlist_views.index')
                ->with('jobTSPlaylistViews', $jobTSPlaylistViews);
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
            return view('job_t_s_playlist_views.jreate');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPlaylistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSPlaylistView = $this->jobTSPlaylistViewRepository->create($input);
            
                Flash::success('Job T S Playlist View saved successfully.');
                return redirect(route('jobTSPlaylistViews.index'));
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
            $jobTSPlaylistView = $this->jobTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistView))
            {
                Flash::error('Job T S Playlist View not found');
                return redirect(route('jobTSPlaylistViews.index'));
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
            
            if($user_id == $jobTSPlaylistView -> user_id || $isShared)
            {
                return view('job_t_s_playlist_views.show')->with('jobTSPlaylistView', $jobTSPlaylistView);
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
            $jobTSPlaylistView = $this->jobTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistView))
            {
                Flash::error('Job T S Playlist View not found');
                return redirect(route('jobTSPlaylistViews.index'));
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
            
            if($user_id == $jobTSPlaylistView -> user_id || $isShared)
            {
                return view('job_t_s_playlist_views.edit')->with('jobTSPlaylistView', $jobTSPlaylistView);
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

    public function update($id, UpdateJobTSPlaylistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $jobTSPlaylistView = $this->jobTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistView))
            {
                Flash::error('Job T S Playlist View not found');
                return redirect(route('jobTSPlaylistViews.index'));
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
            
            if($user_id == $jobTSPlaylistView -> user_id || $isShared)
            {
                $jobTSPlaylistView = $this->jobTSPlaylistViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S Playlist View updated successfully.');
                return redirect(route('jobTSPlaylistViews.index'));
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
            $jobTSPlaylistView = $this->jobTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPlaylistView))
            {
                Flash::error('Job T S Playlist View not found');
                return redirect(route('jobTSPlaylistViews.index'));
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
            
            if($user_id == $jobTSPlaylistView -> user_id || $isShared)
            {
                $this->jobTSPlaylistViewRepository->delete($id);
            
                Flash::success('Job T S Playlist View deleted successfully.');
                return redirect(route('jobTSPlaylistViews.index'));
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