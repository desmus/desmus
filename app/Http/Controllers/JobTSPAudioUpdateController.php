<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPAudioUpdateRequest;
use App\Http\Requests\UpdateJobTSPAudioUpdateRequest;
use App\Repositories\JobTSPAudioUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPAudioUpdateController extends AppBaseController
{
    private $jobTSPAudioUpdateRepository;

    public function __construct(JobTSPAudioUpdateRepository $jobTSPAudioUpdateRepo)
    {
        $this->jobTSPAudioUpdateRepository = $jobTSPAudioUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPAudioUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPAudioUpdates = $this->jobTSPAudioUpdateRepository->all();
    
            return view('job_t_s_p_audio_updates.index')
                ->with('jobTSPAudioUpdates', $jobTSPAudioUpdates);
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
            return view('job_t_s_p_audio_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSPAudioUpdate = $this->jobTSPAudioUpdateRepository->create($input);
            
                Flash::success('Job T S P Audio Update saved successfully.');
                return redirect(route('jobTSPAudioUpdates.index'));
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
            $jobTSPAudioUpdate = $this->jobTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioUpdate))
            {
                Flash::error('Job T S P Audio Update not found');
                return redirect(route('jobTSPAudioUpdates.index'));
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
            
            if($user_id == $jobTSPAudioUpdate -> user_id || $isShared)
            {
                return view('job_t_s_p_audio_updates.show')->with('jobTSPAudioUpdate', $jobTSPAudioUpdate);
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
            $jobTSPAudioUpdate = $this->jobTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioUpdate))
            {
                Flash::error('Job T S P Audio Update not found');
                return redirect(route('jobTSPAudioUpdates.index'));
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
            
            if($user_id == $jobTSPAudioUpdate -> user_id || $isShared)
            {
                return view('job_t_s_p_audio_updates.edit')->with('jobTSPAudioUpdate', $jobTSPAudioUpdate);
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

    public function update($id, UpdateJobTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSPAudioUpdate = $this->jobTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioUpdate))
            {
                Flash::error('Job T S P Audio Update not found');
                return redirect(route('jobTSPAudioUpdates.index'));
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
            
            if($user_id == $jobTSPAudioUpdate -> user_id || $isShared)
            {
                $jobTSPAudioUpdate = $this->jobTSPAudioUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S P Audio Update updated successfully.');
                return redirect(route('jobTSPAudioUpdates.index'));
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
            $jobTSPAudioUpdate = $this->jobTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioUpdate))
            {
                Flash::error('Job T S P Audio Update not found');
                return redirect(route('jobTSPAudioUpdates.index'));
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
            
            if($user_id == $jobTSPAudioUpdate -> user_id || $isShared)
            {
                $this->jobTSPAudioUpdateRepository->delete($id);
            
                Flash::success('Job T S P Audio Update deleted successfully.');
                return redirect(route('jobTSPAudioUpdates.index'));
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