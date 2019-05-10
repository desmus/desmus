<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPAudioViewRequest;
use App\Http\Requests\UpdateJobTSPAudioViewRequest;
use App\Repositories\JobTSPAudioViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPAudioViewController extends AppBaseController
{
    private $jobTSPAudioViewRepository;

    public function __construct(JobTSPAudioViewRepository $jobTSPAudioViewRepo)
    {
        $this->jobTSPAudioViewRepository = $jobTSPAudioViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPAudioViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPAudioViews = $this->jobTSPAudioViewRepository->all();
    
            return view('job_t_s_p_audio_views.index')
                ->with('jobTSPAudioViews', $jobTSPAudioViews);
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
            return view('job_t_s_p_audio_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSPAudioView = $this->jobTSPAudioViewRepository->create($input);
            
                Flash::success('Job T S P Audio View saved successfully.');
                return redirect(route('jobTSPAudioViews.index'));
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
            $jobTSPAudioView = $this->jobTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioView))
            {
                Flash::error('Job T S P Audio View not found');
                return redirect(route('jobTSPAudioViews.index'));
            }
    
            $userJobTSPAudios = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSPAudios as $userJobTSPAudio)
            {
                if($userJobTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_p_audios')->join('job_t_s_playlists', 'job_t_s_p_audios.j_t_s_p_id', '=', 'job_t_s_playlists.id')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $jobTSPAudioView -> user_id || $isShared)
            {
                return view('job_t_s_p_audio_views.show')->with('jobTSPAudioView', $jobTSPAudioView);
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
            $jobTSPAudioView = $this->jobTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioView))
            {
                Flash::error('Job T S P Audio View not found');
                return redirect(route('jobTSPAudioViews.index'));
            }
            
            $userJobTSPAudios = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSPAudios as $userJobTSPAudio)
            {
                if($userJobTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_p_audios')->join('job_t_s_playlists', 'job_t_s_p_audios.j_t_s_p_id', '=', 'job_t_s_playlists.id')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $jobTSPAudioView -> user_id || $isShared)
            {
                return view('job_t_s_p_audio_views.edit')->with('jobTSPAudioView', $jobTSPAudioView);
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

    public function update($id, UpdateJobTSPAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSPAudioView = $this->jobTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioView))
            {
                Flash::error('Job T S P Audio View not found');
                return redirect(route('jobTSPAudioViews.index'));
            }
            
            $userJobTSPAudios = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSPAudios as $userJobTSPAudio)
            {
                if($userJobTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_p_audios')->join('job_t_s_playlists', 'job_t_s_p_audios.j_t_s_p_id', '=', 'job_t_s_playlists.id')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $jobTSPAudioView -> user_id || $isShared)
            {
                $jobTSPAudioView = $this->jobTSPAudioViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S P Audio View updated successfully.');
                return redirect(route('jobTSPAudioViews.index'));
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
            $jobTSPAudioView = $this->jobTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioView))
            {
                Flash::error('Job T S P Audio View not found');
                return redirect(route('jobTSPAudioViews.index'));
            }
            
            $userJobTSPAudios = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSPAudios as $userJobTSPAudio)
            {
                if($userJobTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_p_audios')->join('job_t_s_playlists', 'job_t_s_p_audios.j_t_s_p_id', '=', 'job_t_s_playlists.id')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $jobTSPAudioView -> user_id || $isShared)
            {
                $this->jobTSPAudioViewRepository->delete($id);
            
                Flash::success('Job T S P Audio View deleted successfully.');
                return redirect(route('jobTSPAudioViews.index'));
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