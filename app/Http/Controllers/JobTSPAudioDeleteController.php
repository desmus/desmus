<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPAudioDeleteRequest;
use App\Http\Requests\UpdateJobTSPAudioDeleteRequest;
use App\Repositories\JobTSPAudioDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPAudioDeleteController extends AppBaseController
{
    private $jobTSPAudioDeleteRepository;

    public function __construct(JobTSPAudioDeleteRepository $jobTSPAudioDeleteRepo)
    {
        $this->jobTSPAudioDeleteRepository = $jobTSPAudioDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPAudioDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPAudioDeletes = $this->jobTSPAudioDeleteRepository->all();
    
            return view('job_t_s_p_audio_deletes.index')
                ->with('jobTSPAudioDeletes', $jobTSPAudioDeletes);
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
            return view('job_t_s_p_audio_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $jobTSPAudioDelete = $this->jobTSPAudioDeleteRepository->create($input);
            
                Flash::success('Job T S P Audio Delete saved successfully.');
                return redirect(route('jobTSPAudioDeletes.index'));
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
            $jobTSPAudioDelete = $this->jobTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioDelete))
            {
                Flash::error('Job T S P Audio Delete not found');
                return redirect(route('jobTSPAudioDeletes.index'));
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
            
            if($user_id == $jobTSPAudioDelete -> user_id || $isShared)
            {
                return view('job_t_s_p_audio_deletes.show')->with('jobTSPAudioDelete', $jobTSPAudioDelete);
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
            $jobTSPAudioDelete = $this->jobTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioDelete))
            {
                Flash::error('Job T S P Audio Delete not found');
                return redirect(route('jobTSPAudioDeletes.index'));
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
            
            if($user_id == $jobTSPAudioDelete -> user_id || $isShared)
            {
                return view('job_t_s_p_audio_deletes.edit')->with('jobTSPAudioDelete', $jobTSPAudioDelete);
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

    public function update($id, UpdateJobTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSPAudioDelete = $this->jobTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioDelete))
            {
                Flash::error('Job T S P Audio Delete not found');
                return redirect(route('jobTSPAudioDeletes.index'));
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
            
            if($user_id == $jobTSPAudioDelete -> user_id || $isShared)
            {
                $jobTSPAudioDelete = $this->jobTSPAudioDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S P Audio Delete updated successfully.');
                return redirect(route('jobTSPAudioDeletes.index'));
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
            $jobTSPAudioDelete = $this->jobTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPAudioDelete))
            {
                Flash::error('Job T S P Audio Delete not found');
                return redirect(route('jobTSPAudioDeletes.index'));
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
            
            if($user_id == $jobTSPAudioDelete -> user_id || $isShared)
            {
                $this->jobTSPAudioDeleteRepository->delete($id);
            
                Flash::success('Job T S P Audio Delete deleted successfully.');
                return redirect(route('jobTSPAudioDeletes.index'));
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