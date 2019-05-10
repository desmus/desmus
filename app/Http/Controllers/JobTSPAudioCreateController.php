<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPAudioCreateRequest;
use App\Http\Requests\UpdateJobTSPAudioCreateRequest;
use App\Repositories\JobTSPAudioCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPAudioCreateController extends AppBaseController
{
    private $jobTSPAudioCreateRepository;

    public function __construct(JobTSPAudioCreateRepository $jobTSPAudioCreateRepo)
    {
        $this->jobTSPAudioCreateRepository = $jobTSPAudioCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPAudioCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPAudioCreates = $this->jobTSPAudioCreateRepository->all();
    
            return view('job_t_s_p_audio_creates.index')
                ->with('jobTSPAudioCreates', $jobTSPAudioCreates);
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
            return view('job_t_s_p_audio_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSPAudioCreate = $this->jobTSPAudioCreateRepository->create($input);
            
                Flash::success('Job T S P Audio Create saved successfully.');
                return redirect(route('jobTSPAudioCreates.index'));
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
            $jobTSPAudioCreate = $this->jobTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioCreate))
            {
                Flash::error('Job T S P Audio Create not found');
                return redirect(route('jobTSPAudioCreates.index'));
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
            
            if($user_id == $jobTSPAudioCreate -> user_id || $isShared)
            {
                return view('job_t_s_p_audio_creates.show')->with('jobTSPAudioCreate', $jobTSPAudioCreate);
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
            $jobTSPAudioCreate = $this->jobTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioCreate))
            {
                Flash::error('Job T S P Audio Create not found');
                return redirect(route('jobTSPAudioCreates.index'));
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
            
            if($user_id == $jobTSPAudioCreate -> user_id || $isShared)
            {
                return view('job_t_s_p_audio_creates.edit')->with('jobTSPAudioCreate', $jobTSPAudioCreate);
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

    public function update($id, UpdateJobTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSPAudioCreate = $this->jobTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioCreate))
            {
                Flash::error('Job T S P Audio Create not found');
                return redirect(route('jobTSPAudioCreates.index'));
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
            
            if($user_id == $jobTSPAudioCreate -> user_id || $isShared)
            {
                $jobTSPAudioCreate = $this->jobTSPAudioCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S P Audio Create updated successfully.');
                return redirect(route('jobTSPAudioCreates.index'));
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
            $jobTSPAudioCreate = $this->jobTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioCreate))
            {
                Flash::error('Job T S P Audio Create not found');
                return redirect(route('jobTSPAudioCreates.index'));
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
            
            if($user_id == $jobTSPAudioCreate -> user_id || $isShared)
            {
                $this->jobTSPAudioCreateRepository->delete($id);
            
                Flash::success('Job T S P Audio Create deleted successfully.');
                return redirect(route('jobTSPAudioCreates.index'));
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