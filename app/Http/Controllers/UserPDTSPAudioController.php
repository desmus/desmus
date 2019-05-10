<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserPDTSPAudioRequest;
use App\Http\Requests\UpdateUserPDTSPAudioRequest;
use App\Repositories\UserPDTSPAudioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserPDTSPAudioController extends AppBaseController
{
    private $userPDTSPAudioRepository;

    public function __construct(UserPDTSPAudioRepository $userPDTSPAudioRepo)
    {
        $this->userPDTSPAudioRepository = $userPDTSPAudioRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPDTSPAudioRepository->pushCriteria(new RequestCriteria($request));
            $userPDTSPAudios = $this->userPDTSPAudioRepository->all();
    
            return view('user_p_d_t_s_p_audios.index')
                ->with('userPDTSPAudios', $userPDTSPAudios);
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
            
            $userPDTSPAudiosList = DB::table('user_p_d_t_s_p_audios')->join('users', 'user_p_d_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_p_d_t_s_p_audios.description', 'permissions', 'user_p_d_t_s_p_audios.datetime', 'user_p_d_t_s_p_audios.id', 'p_d_t_s_p_a_id')->where('p_d_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_p_d_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTSPAudioViewsList = DB::table('users')->join('p_d_t_s_p_audio_views', 'users.id', '=', 'p_d_t_s_p_audio_views.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTSPAudioUpdatesList = DB::table('users')->join('p_d_t_s_p_audio_updates', 'users.id', '=', 'p_d_t_s_p_audio_updates.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_p_d_t_s_p_audios.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userPDTSPAudiosList', $userPDTSPAudiosList)
                ->with('personalDataTSPAudioViewsList', $personalDataTSPAudioViewsList)
                ->with('personalDataTSPAudioUpdatesList', $personalDataTSPAudioUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPDTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_p_audios.id', '=', $request -> p_d_t_s_p_a_id)->get();
            
            $userPersonalDataTSPAudioCheck = DB::table('user_p_d_t_s_p_audios')->where('user_id', '=', $request -> user_id)->where('p_d_t_s_p_a_id', '=', $request -> p_d_t_s_p_a_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userPersonalDataTSPAudioCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userPDTSPAudio = $this->userPDTSPAudioRepository->create($input);
                    $user = DB::table('user_p_d_t_s_p_audios')->join('users', 'users.id', '=', 'user_p_d_t_s_p_audios.user_id')->where('user_p_d_t_s_p_audios.id', '=', $userPDTSPAudio -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_p_a_c', 'user_id' => $user_id, 'entity_id' => $userPDTSPAudio -> p_d_t_s_p_a_id, 'created_at' => $now]);
                    DB::table('u_p_d_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPDTSPAudio -> id]);
                
                    Flash::success('User PD T S P Audio saved successfully.');
                    return redirect(route('userPDTSPAudios.show', [$userPDTSPAudio -> p_d_t_s_p_a_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userPDTSPAudios.show', [$request -> p_d_t_s_p_a_id]));
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
            $userPDTSPAudio = $this->userPDTSPAudioRepository->findWithoutFail($id);
            $userPDTSPAudios = DB::table('user_p_d_t_s_p_audios')->join('users', 'user_p_d_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_p_d_t_s_p_audios.description', 'permissions', 'user_p_d_t_s_p_audios.datetime', 'user_p_d_t_s_p_audios.id', 'p_d_t_s_p_a_id')->where('p_d_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_p_d_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userPDTSPAudios[0]))
            {
                return redirect(route('userPDTSPAudios.create', [$id]));
            }
            
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_p_audios.id', '=', $userPDTSPAudios[0] -> p_d_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSPAudio = DB::table('personal_data_t_s_p_audios')->where('id', '=', $userPDTSPAudios[0] -> p_d_t_s_p_a_id)->get();
    
                $userPDTSPAudiosList = DB::table('user_p_d_t_s_p_audios')->join('users', 'user_p_d_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_p_d_t_s_p_audios.description', 'permissions', 'user_p_d_t_s_p_audios.datetime', 'user_p_d_t_s_p_audios.id', 'p_d_t_s_p_a_id')->where('p_d_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_p_d_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSPAudioViewsList = DB::table('users')->join('p_d_t_s_p_audio_views', 'users.id', '=', 'p_d_t_s_p_audio_views.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSPAudioUpdatesList = DB::table('users')->join('p_d_t_s_p_audio_updates', 'users.id', '=', 'p_d_t_s_p_audio_updates.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_p_d_t_s_p_audios.show')
                    ->with('userPDTSPAudios', $userPDTSPAudios)
                    ->with('id', $id)
                    ->with('personalDataTSPAudio', $personalDataTSPAudio)
                    ->with('userPDTSPAudiosList', $userPDTSPAudiosList)
                    ->with('personalDataTSPAudioViewsList', $personalDataTSPAudioViewsList)
                    ->with('personalDataTSPAudioUpdatesList', $personalDataTSPAudioUpdatesList);
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
            $userPDTSPAudio = DB::table('users')->join('user_p_d_t_s_p_audios', 'user_p_d_t_s_p_audios.user_id', '=', 'users.id')->where('user_p_d_t_s_p_audios.id', $id)->where(function ($query) {$query->where('user_p_d_t_s_p_audios.deleted_at', '=', null);})->get();
    
            if(empty($userPDTSPAudio))
            {
                Flash::error('User PD T S P Audio not found');
                return redirect(route('userPDTSPAudios.index'));
            }
    
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_p_audios.id', '=', $userPDTSPAudio[0] -> p_d_t_s_p_a_id)->get();
            
            $userPDTSPAudiosList = DB::table('user_p_d_t_s_p_audios')->join('users', 'user_p_d_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_p_d_t_s_p_audios.description', 'permissions', 'user_p_d_t_s_p_audios.datetime', 'user_p_d_t_s_p_audios.id', 'p_d_t_s_p_a_id')->where('p_d_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_p_d_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTSPAudioViewsList = DB::table('users')->join('p_d_t_s_p_audio_views', 'users.id', '=', 'p_d_t_s_p_audio_views.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTSPAudioUpdatesList = DB::table('users')->join('p_d_t_s_p_audio_updates', 'users.id', '=', 'p_d_t_s_p_audio_updates.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('user_p_d_t_s_p_audios.edit')
                    ->with('userPDTSPAudio', $userPDTSPAudio)
                    ->with('id', $userPDTSPAudio[0] -> p_d_t_s_p_a_id)
                    ->with('userPDTSPAudiosList', $userPDTSPAudiosList)
                    ->with('personalDataTSPAudioViewsList', $personalDataTSPAudioViewsList)
                    ->with('personalDataTSPAudioUpdatesList', $personalDataTSPAudioUpdatesList);
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

    public function update($id, UpdateUserPDTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userPDTSPAudio = $this->userPDTSPAudioRepository->findWithoutFail($id);
    
            if(empty($userPDTSPAudio))
            {
                Flash::error('User PD T S P Audio not found');
                return redirect(route('userPDTSPAudios.index'));
            }
    
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_p_audios.id', '=', $userPDTSPAudio -> p_d_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userPDTSPAudio = $this->userPDTSPAudioRepository->update($request->all(), $id);
                $user = DB::table('user_p_d_t_s_p_audios')->join('users', 'users.id', '=', 'user_p_d_t_s_p_audios.user_id')->where('user_p_d_t_s_p_audios.id', '=', $userPDTSPAudio -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_p_a_u', 'user_id' => $user_id, 'entity_id' => $userPDTSPAudio -> p_d_t_s_p_a_id, 'created_at' => $now]);
                DB::table('u_p_d_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPDTSPAudio -> id]);
            
                Flash::success('User PD T S P Audio updated successfully.');
                return redirect(route('userPDTSPAudios.show', [$userPDTSPAudio -> p_d_t_s_p_a_id]));
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
            $userPDTSPAudio = $this->userPDTSPAudioRepository->findWithoutFail($id);
    
            if(empty($userPDTSPAudio))
            {
                Flash::error('User PD T S P Audio not found');
                return redirect(route('userPDTSPAudios.index'));
            }
            
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_p_audios.id', '=', $userPDTSPAudio -> p_d_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userPDTSPAudioRepository->delete($id);
                $user = DB::table('user_p_d_t_s_p_audios')->join('users', 'users.id', '=', 'user_p_d_t_s_p_audios.user_id')->where('user_p_d_t_s_p_audios.id', '=', $userPDTSPAudio -> id)->select('name')->get();
          
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_p_a_d', 'user_id' => $user_id, 'entity_id' => $userPDTSPAudio -> p_d_t_s_p_a_id, 'created_at' => $now]);
                DB::table('u_p_d_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPDTSPAudio -> id]);
            
                Flash::success('User PD T S P Audio deleted successfully.');
                return redirect(route('userPDTSPAudios.show', [$userPDTSPAudio -> p_d_t_s_p_a_id]));
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