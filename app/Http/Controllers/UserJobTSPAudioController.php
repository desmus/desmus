<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserJobTSPAudioRequest;
use App\Http\Requests\UpdateUserJobTSPAudioRequest;
use App\Repositories\UserJobTSPAudioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserJobTSPAudioController extends AppBaseController
{
    private $userJobTSPAudioRepository;

    public function __construct(UserJobTSPAudioRepository $userJobTSPAudioRepo)
    {
        $this->userJobTSPAudioRepository = $userJobTSPAudioRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSPAudioRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSPAudios = $this->userJobTSPAudioRepository->all();
    
            return view('user_job_t_s_p_audios.index')
                ->with('userJobTSPAudios', $userJobTSPAudios);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $users = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->select('name', 'contacts.user_id', 'users.id')->where('contacts.user_id', '=', $user_id)->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->orderBy('name', 'asc')->get();
            $select = [];
                
            foreach($users as $user)
            {
                $select[$user->id] = $user->name;
            }
            
            $userJobTSPAudiosList = DB::table('user_job_t_s_p_audios')->join('users', 'user_job_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_p_audios.description', 'permissions', 'user_job_t_s_p_audios.datetime', 'user_job_t_s_p_audios.id', 'j_t_s_p_a_id')->where('j_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_job_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $jobTSPAudioViewsList = DB::table('users')->join('job_t_s_p_audio_views', 'users.id', '=', 'job_t_s_p_audio_views.user_id')->where('j_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $jobTSPAudioUpdatesList = DB::table('users')->join('job_t_s_p_audio_updates', 'users.id', '=', 'job_t_s_p_audio_updates.user_id')->where('j_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            
            return view('user_job_t_s_p_audios.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userJobTSPAudiosList', $userJobTSPAudiosList)
                ->with('jobTSPAudioViewsList', $jobTSPAudioViewsList)
                ->with('jobTSPAudioUpdatesList', $jobTSPAudioUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('job_t_s_p_audios')->join('job_t_s_playlists', 'job_t_s_p_audios.j_t_s_p_id', '=', 'job_t_s_playlists.id')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_p_audios.id', '=', $request -> j_t_s_p_a_id)->get();
            
            $userJobTSPAudioCheck = DB::table('user_job_t_s_p_audios')->where('user_id', '=', $request -> user_id)->where('j_t_s_p_a_id', '=', $request -> j_t_s_p_a_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userJobTSPAudioCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userJobTSPAudio = $this->userJobTSPAudioRepository->create($input);
                    $user = DB::table('user_job_t_s_p_audios')->join('users', 'users.id', '=', 'user_job_t_s_p_audios.user_id')->where('user_job_t_s_p_audios.id', '=', $userJobTSPAudio -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_p_a_c', 'user_id' => $user_id, 'entity_id' => $userJobTSPAudio -> j_t_s_p_a_id, 'created_at' => $now]);
                    DB::table('u_j_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPAudio -> id]);
                
                    Flash::success('User Job T S P Audio saved successfully.');
                    return redirect(route('userJobTSPAudios.show', [$userJobTSPAudio -> j_t_s_p_a_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userJobTSPAudios.show', [$request -> j_t_s_p_a_id]));
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
            $userJobTSPAudio = $this->userJobTSPAudioRepository->findWithoutFail($id);
            $userJobTSPAudios = DB::table('user_job_t_s_p_audios')->join('users', 'user_job_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_p_audios.description', 'permissions', 'user_job_t_s_p_audios.datetime', 'user_job_t_s_p_audios.id', 'j_t_s_p_a_id')->where('j_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_job_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userJobTSPAudios[0]))
            {
                return redirect(route('userJobTSPAudios.create', [$id]));
            }
            
            $user = DB::table('job_t_s_p_audios')->join('job_t_s_playlists', 'job_t_s_p_audios.j_t_s_p_id', '=', 'job_t_s_playlists.id')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_p_audios.id', '=', $userJobTSPAudios[0] -> j_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $jobTSPAudio = DB::table('job_t_s_p_audios')->where('id', '=', $userJobTSPAudios[0] -> j_t_s_p_a_id)->get();
    
                $userJobTSPAudiosList = DB::table('user_job_t_s_p_audios')->join('users', 'user_job_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_p_audios.description', 'permissions', 'user_job_t_s_p_audios.datetime', 'user_job_t_s_p_audios.id', 'j_t_s_p_a_id')->where('j_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_job_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSPAudioViewsList = DB::table('users')->join('job_t_s_p_audio_views', 'users.id', '=', 'job_t_s_p_audio_views.user_id')->where('j_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $jobTSPAudioUpdatesList = DB::table('users')->join('job_t_s_p_audio_updates', 'users.id', '=', 'job_t_s_p_audio_updates.user_id')->where('j_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
                return view('user_job_t_s_p_audios.show')
                    ->with('userJobTSPAudios', $userJobTSPAudios)
                    ->with('id', $id)
                    ->with('jobTSPAudio', $jobTSPAudio)
                    ->with('userJobTSPAudiosList', $userJobTSPAudiosList)
                    ->with('jobTSPAudioViewsList', $jobTSPAudioViewsList)
                    ->with('jobTSPAudioUpdatesList', $jobTSPAudioUpdatesList);
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
            $userJobTSPAudio = DB::table('users')->join('user_job_t_s_p_audios', 'user_job_t_s_p_audios.user_id', '=', 'users.id')->where('user_job_t_s_p_audios.id', $id)->where(function ($query) {$query->where('user_job_t_s_p_audios.deleted_at', '=', null);})->get();
    
            if(empty($userJobTSPAudio))
            {
                Flash::error('User Job T S P Audio not found');
                return redirect(route('userJobTSPAudios.index'));
            }
    
            $user = DB::table('job_t_s_p_audios')->join('job_t_s_playlists', 'job_t_s_p_audios.j_t_s_p_id', '=', 'job_t_s_playlists.id')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_p_audios.id', '=', $userJobTSPAudio[0] -> j_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userJobTSPAudiosList = DB::table('user_job_t_s_p_audios')->join('users', 'user_job_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_p_audios.description', 'permissions', 'user_job_t_s_p_audios.datetime', 'user_job_t_s_p_audios.id', 'j_t_s_p_a_id')->where('j_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_job_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSPAudioViewsList = DB::table('users')->join('job_t_s_p_audio_views', 'users.id', '=', 'job_t_s_p_audio_views.user_id')->where('j_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $jobTSPAudioUpdatesList = DB::table('users')->join('job_t_s_p_audio_updates', 'users.id', '=', 'job_t_s_p_audio_updates.user_id')->where('j_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();

                return view('user_job_t_s_p_audios.edit')
                    ->with('userJobTSPAudio', $userJobTSPAudio)
                    ->with('id', $userJobTSPAudio[0] -> j_t_s_p_a_id)
                    ->with('userJobTSPAudiosList', $userJobTSPAudiosList)
                    ->with('jobTSPAudioViewsList', $jobTSPAudioViewsList)
                    ->with('jobTSPAudioUpdatesList', $jobTSPAudioUpdatesList);
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

    public function update($id, UpdateUserJobTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userJobTSPAudio = $this->userJobTSPAudioRepository->findWithoutFail($id);
    
            if(empty($userJobTSPAudio))
            {
                Flash::error('User Job T S P Audio not found');
                return redirect(route('userJobTSPAudios.index'));
            }
            
            $user = DB::table('job_t_s_p_audios')->join('job_t_s_playlists', 'job_t_s_p_audios.j_t_s_p_id', '=', 'job_t_s_playlists.id')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_p_audios.id', '=', $userJobTSPAudio -> j_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userJobTSPAudio = $this->userJobTSPAudioRepository->update($request->all(), $id);
                $user = DB::table('user_job_t_s_p_audios')->join('users', 'users.id', '=', 'user_job_t_s_p_audios.user_id')->where('user_job_t_s_p_audios.id', '=', $userJobTSPAudio -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_p_a_u', 'user_id' => $user_id, 'entity_id' => $userJobTSPAudio -> j_t_s_p_a_id, 'created_at' => $now]);
                DB::table('u_j_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPAudio -> id]);
            
                Flash::success('User Job T S P Audio updated successfully.');
                return redirect(route('userJobTSPAudios.show', [$userJobTSPAudio -> j_t_s_p_a_id]));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userJobTSPAudio = $this->userJobTSPAudioRepository->findWithoutFail($id);
    
            if(empty($userJobTSPAudio))
            {
                Flash::error('User Job T S P Audio not found');
                return redirect(route('userJobTSPAudios.index'));
            }
            
            $user = DB::table('job_t_s_p_audios')->join('job_t_s_playlists', 'job_t_s_p_audios.j_t_s_p_id', '=', 'job_t_s_playlists.id')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_p_audios.id', '=', $userJobTSPAudio -> j_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userJobTSPAudioRepository->delete($id);
                $user = DB::table('user_job_t_s_p_audios')->join('users', 'users.id', '=', 'user_job_t_s_p_audios.user_id')->where('user_job_t_s_p_audios.id', '=', $userJobTSPAudio -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_p_a_d', 'user_id' => $user_id, 'entity_id' => $userJobTSPAudio -> j_t_s_p_a_id, 'created_at' => $now]);
                DB::table('u_j_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPAudio -> id]);
            
                Flash::success('User Job T S P Audio deleted successfully.');
                return redirect(route('userJobTSPAudios.show', [$userJobTSPAudio -> j_t_s_p_a_id]));
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