<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCollegeTSPAudioRequest;
use App\Http\Requests\UpdateUserCollegeTSPAudioRequest;
use App\Repositories\UserCollegeTSPAudioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSPAudioController extends AppBaseController
{
    private $userCollegeTSPAudioRepository;

    public function __construct(UserCollegeTSPAudioRepository $userCollegeTSPAudioRepo)
    {
        $this->userCollegeTSPAudioRepository = $userCollegeTSPAudioRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSPAudioRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSPAudios = $this->userCollegeTSPAudioRepository->all();
    
            return view('user_college_t_s_p_audios.index')
                ->with('userCollegeTSPAudios', $userCollegeTSPAudios);
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
            
            $userCollegeTSPAudiosList = DB::table('user_college_t_s_p_audios')->join('users', 'user_college_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_p_audios.description', 'permissions', 'user_college_t_s_p_audios.datetime', 'user_college_t_s_p_audios.id', 'c_t_s_p_a_id')->where('c_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_college_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTSPAudioViewsList = DB::table('users')->join('college_t_s_p_audio_views', 'users.id', '=', 'college_t_s_p_audio_views.user_id')->where('c_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTSPAudioUpdatesList = DB::table('users')->join('college_t_s_p_audio_updates', 'users.id', '=', 'college_t_s_p_audio_updates.user_id')->where('c_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_college_t_s_p_audios.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userCollegeTSPAudiosList', $userCollegeTSPAudiosList)
                ->with('collegeTSPAudioViewsList', $collegeTSPAudioViewsList)
                ->with('collegeTSPAudioUpdatesList', $collegeTSPAudioUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('college_t_s_p_audios')->join('college_t_s_playlists', 'college_t_s_p_audios.c_t_s_p_id', '=', 'college_t_s_playlists.id')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_p_audios.id', '=', $request -> c_t_s_p_a_id)->get();
            
            $userCollegeTSPAudioCheck = DB::table('user_college_t_s_p_audios')->where('user_id', '=', $request -> user_id)->where('c_t_s_p_a_id', '=', $request -> c_t_s_p_a_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userCollegeTSPAudioCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userCollegeTSPAudio = $this->userCollegeTSPAudioRepository->create($input);
                    $user = DB::table('user_college_t_s_p_audios')->join('users', 'users.id', '=', 'user_college_t_s_p_audios.user_id')->where('user_college_t_s_p_audios.id', '=', $userCollegeTSPAudio -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_p_a_c', 'user_id' => $user_id, 'entity_id' => $userCollegeTSPAudio -> c_t_s_p_a_id, 'created_at' => $now]);
                    DB::table('u_c_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPAudio -> id]);
                
                    Flash::success('User College T S P Audio saved successfully.');
                    return redirect(route('userCollegeTSPAudios.show', [$userCollegeTSPAudio -> c_t_s_p_a_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userCollegeTSPAudios.show', [$request -> c_t_s_p_a_id]));
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
            $userCollegeTSPAudio = $this->userCollegeTSPAudioRepository->findWithoutFail($id);
            $userCollegeTSPAudios = DB::table('user_college_t_s_p_audios')->join('users', 'user_college_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_p_audios.description', 'permissions', 'user_college_t_s_p_audios.datetime', 'user_college_t_s_p_audios.id', 'c_t_s_p_a_id')->where('c_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_college_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userCollegeTSPAudios[0]))
            {
                return redirect(route('userCollegeTSPAudios.create', [$id]));
            }
            
            $user = DB::table('college_t_s_p_audios')->join('college_t_s_playlists', 'college_t_s_p_audios.c_t_s_p_id', '=', 'college_t_s_playlists.id')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_p_audios.id', '=', $userCollegeTSPAudios[0] -> c_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTSPAudio = DB::table('college_t_s_p_audios')->where('id', '=', $userCollegeTSPAudios[0] -> c_t_s_p_a_id)->get();
    
                $userCollegeTSPAudiosList = DB::table('user_college_t_s_p_audios')->join('users', 'user_college_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_p_audios.description', 'permissions', 'user_college_t_s_p_audios.datetime', 'user_college_t_s_p_audios.id', 'c_t_s_p_a_id')->where('c_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_college_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSPAudioViewsList = DB::table('users')->join('college_t_s_p_audio_views', 'users.id', '=', 'college_t_s_p_audio_views.user_id')->where('c_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSPAudioUpdatesList = DB::table('users')->join('college_t_s_p_audio_updates', 'users.id', '=', 'college_t_s_p_audio_updates.user_id')->where('c_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_college_t_s_p_audios.show')
                    ->with('userCollegeTSPAudios', $userCollegeTSPAudios)
                    ->with('id', $id)
                    ->with('collegeTSPAudio', $collegeTSPAudio)
                    ->with('userCollegeTSPAudiosList', $userCollegeTSPAudiosList)
                    ->with('collegeTSPAudioViewsList', $collegeTSPAudioViewsList)
                    ->with('collegeTSPAudioUpdatesList', $collegeTSPAudioUpdatesList);
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
            $userCollegeTSPAudio = DB::table('users')->join('user_college_t_s_p_audios', 'user_college_t_s_p_audios.user_id', '=', 'users.id')->where('user_college_t_s_p_audios.id', $id)->where(function ($query) {$query->where('user_college_t_s_p_audios.deleted_at', '=', null);})->get();
    
            if(empty($userCollegeTSPAudio))
            {
                Flash::error('User College T S P Audio not found');
                return redirect(route('userCollegeTSPAudios.index'));
            }
    
            $user = DB::table('college_t_s_p_audios')->join('college_t_s_playlists', 'college_t_s_p_audios.c_t_s_p_id', '=', 'college_t_s_playlists.id')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_p_audios.id', '=', $userCollegeTSPAudio[0] -> c_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userCollegeTSPAudiosList = DB::table('user_college_t_s_p_audios')->join('users', 'user_college_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_p_audios.description', 'permissions', 'user_college_t_s_p_audios.datetime', 'user_college_t_s_p_audios.id', 'c_t_s_p_a_id')->where('c_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_college_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSPAudioViewsList = DB::table('users')->join('college_t_s_p_audio_views', 'users.id', '=', 'college_t_s_p_audio_views.user_id')->where('c_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSPAudioUpdatesList = DB::table('users')->join('college_t_s_p_audio_updates', 'users.id', '=', 'college_t_s_p_audio_updates.user_id')->where('c_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_college_t_s_p_audios.edit')
                    ->with('userCollegeTSPAudio', $userCollegeTSPAudio)
                    ->with('id', $userCollegeTSPAudio[0] -> c_t_s_p_a_id)
                    ->with('userCollegeTSPAudiosList', $userCollegeTSPAudiosList)
                    ->with('collegeTSPAudioViewsList', $collegeTSPAudioViewsList)
                    ->with('collegeTSPAudioUpdatesList', $collegeTSPAudioUpdatesList);
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

    public function update($id, UpdateUserCollegeTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userCollegeTSPAudio = $this->userCollegeTSPAudioRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSPAudio))
            {
                Flash::error('User College T S P Audio not found');
                return redirect(route('userCollegeTSPAudios.index'));
            }
            
            $user = DB::table('college_t_s_p_audios')->join('college_t_s_playlists', 'college_t_s_p_audios.c_t_s_p_id', '=', 'college_t_s_playlists.id')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_p_audios.id', '=', $userCollegeTSPAudio -> c_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userCollegeTSPAudio = $this->userCollegeTSPAudioRepository->update($request->all(), $id);
                $user = DB::table('user_college_t_s_p_audios')->join('users', 'users.id', '=', 'user_college_t_s_p_audios.user_id')->where('user_college_t_s_p_audios.id', '=', $userCollegeTSPAudio -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_p_a_u', 'user_id' => $user_id, 'entity_id' => $userCollegeTSPAudio -> c_t_s_p_a_id, 'created_at' => $now]);
                DB::table('u_c_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPAudio -> id]);
            
                Flash::success('User College T S P Audio updated successfully.');
                return redirect(route('userCollegeTSPAudios.show', [$userCollegeTSPAudio -> c_t_s_p_a_id]));
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
            $userCollegeTSPAudio = $this->userCollegeTSPAudioRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSPAudio))
            {
                Flash::error('User College T S P Audio not found');
                return redirect(route('userCollegeTSPAudios.index'));
            }
            
            $user = DB::table('college_t_s_p_audios')->join('college_t_s_playlists', 'college_t_s_p_audios.c_t_s_p_id', '=', 'college_t_s_playlists.id')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_p_audios.id', '=', $userCollegeTSPAudio -> c_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userCollegeTSPAudioRepository->delete($id);
                $user = DB::table('user_college_t_s_p_audios')->join('users', 'users.id', '=', 'user_college_t_s_p_audios.user_id')->where('user_college_t_s_p_audios.id', '=', $userCollegeTSPAudio -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_p_a_d', 'user_id' => $user_id, 'entity_id' => $userCollegeTSPAudio -> c_t_s_p_a_id, 'created_at' => $now]);
                DB::table('u_c_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPAudio -> id]);
            
                Flash::success('User College T S P Audio deleted successfully.');
                return redirect(route('userCollegeTSPAudios.show', [$userCollegeTSPAudio -> c_t_s_p_a_id]));
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