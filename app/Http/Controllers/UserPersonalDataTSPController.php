<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserPersonalDataTSPRequest;
use App\Http\Requests\UpdateUserPersonalDataTSPRequest;
use App\Repositories\UserPersonalDataTSPRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserPersonalDataTSPController extends AppBaseController
{
    private $userPersonalDataTSPRepository;

    public function __construct(UserPersonalDataTSPRepository $userPersonalDataTSPRepo)
    {
        $this->userPersonalDataTSPRepository = $userPersonalDataTSPRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSPRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSPs = $this->userPersonalDataTSPRepository->all();
    
            return view('user_personal_data_t_s_p.index')
                ->with('userPersonalDataTSPs', $userPersonalDataTSPs);
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
            
            $personalDataTSPAudiosList = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $userPersonalDataTSPlaylistsList = DB::table('user_personal_data_t_s_p')->join('users', 'user_personal_data_t_s_p.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_p.description', 'permissions', 'user_personal_data_t_s_p.datetime', 'user_personal_data_t_s_p.id', 'p_d_t_s_p_id')->where('p_d_t_s_p_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_p.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTSPlaylistViewsList = DB::table('users')->join('personal_data_t_s_p_views', 'users.id', '=', 'personal_data_t_s_p_views.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTSPlaylistUpdatesList = DB::table('users')->join('personal_data_t_s_p_updates', 'users.id', '=', 'personal_data_t_s_p_updates.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_personal_data_t_s_ps.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('personalDataTSPAudiosList', $personalDataTSPAudiosList)
                ->with('userPersonalDataTSPlaylistsList', $userPersonalDataTSPlaylistsList)
                ->with('personalDataTSPlaylistViewsList', $personalDataTSPlaylistViewsList)
                ->with('personalDataTSPlaylistUpdatesList', $personalDataTSPlaylistUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSPRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_playlists.id', '=', $request -> p_d_t_s_p_id)->get();
            
            $userPersonalDataTSPlaylistCheck = DB::table('user_personal_data_t_s_p')->where('user_id', '=', $request -> user_id)->where('p_d_t_s_p_id', '=', $request -> p_d_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            if($userPersonalDataTSPlaylistCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userPersonalDataTSP = $this->userPersonalDataTSPRepository->create($input);
                    $personalDataTSPlaylistAudios = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $userPersonalDataTSP -> p_d_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('u_p_d_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_id' => $userPersonalDataTSP -> id]);
                         
                    foreach($personalDataTSPlaylistAudios as $personalDataTSPlaylistAudio)
                    {
                        DB::table('user_p_d_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTSP -> user_id, 'description' => $userPersonalDataTSP -> description, 'p_d_t_s_p_a_id' => $personalDataTSPlaylistAudio -> id]);
                                                
                        $userPersonalDataTSPlaylistAudio = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $personalDataTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                        if(isset($userPersonalDataTSPlaylistAudio[0]))
                        {
                            DB::table('u_p_d_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPersonalDataTSPlaylistAudio[0] -> id]);
                        }
                    }
                    
                    $user = DB::table('user_personal_data_t_s_p')->join('users', 'users.id', '=', 'user_personal_data_t_s_p.user_id')->where('user_personal_data_t_s_p.id', '=', $userPersonalDataTSP -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_p_c', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSP -> p_d_t_s_p_id, 'created_at' => $now]);
                
                    Flash::success('User PersonalData T S P saved successfully.');
                    return redirect(route('userPersonalDataTSPs.show', [$userPersonalDataTSP -> p_d_t_s_p_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userPersonalDataTSPs.show', [$request -> p_d_t_s_p_id]));
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
            $userPersonalDataTSP = $this->userPersonalDataTSPRepository->findWithoutFail($id);
            $userPersonalDataTSPs = DB::table('user_personal_data_t_s_p')->join('users', 'user_personal_data_t_s_p.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_p.description', 'permissions', 'user_personal_data_t_s_p.datetime', 'user_personal_data_t_s_p.id', 'p_d_t_s_p_id')->where('p_d_t_s_p_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_p.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userPersonalDataTSPs[0]))
            {
                Flash::error('User PersonalData T S Galerie not found');
                return redirect(route('userPersonalDataTSPs.create', [$id]));
            }
            
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_playlists.id', '=', $userPersonalDataTSPs[0] -> p_d_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSP = DB::table('personal_data_t_s_playlists')->where('id', '=', $userPersonalDataTSPs[0] -> p_d_t_s_p_id)->get();
    
                $personalDataTSPAudiosList = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userPersonalDataTSPlaylistsList = DB::table('user_personal_data_t_s_p')->join('users', 'user_personal_data_t_s_p.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_p.description', 'permissions', 'user_personal_data_t_s_p.datetime', 'user_personal_data_t_s_p.id', 'p_d_t_s_p_id')->where('p_d_t_s_p_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_p.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSPlaylistViewsList = DB::table('users')->join('personal_data_t_s_p_views', 'users.id', '=', 'personal_data_t_s_p_views.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSPlaylistUpdatesList = DB::table('users')->join('personal_data_t_s_p_updates', 'users.id', '=', 'personal_data_t_s_p_updates.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_personal_data_t_s_ps.show')
                    ->with('userPersonalDataTSPs', $userPersonalDataTSPs)
                    ->with('personalDataTSP', $personalDataTSP)
                    ->with('id', $id)
                    ->with('personalDataTSPAudiosList', $personalDataTSPAudiosList)
                    ->with('userPersonalDataTSPlaylistsList', $userPersonalDataTSPlaylistsList)
                    ->with('personalDataTSPlaylistViewsList', $personalDataTSPlaylistViewsList)
                    ->with('personalDataTSPlaylistUpdatesList', $personalDataTSPlaylistUpdatesList);
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
            $userPersonalDataTSP = DB::table('users')->join('user_personal_data_t_s_p', 'user_personal_data_t_s_p.user_id', '=', 'users.id')->where('user_personal_data_t_s_p.id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_p.deleted_at', '=', null);})->get();
    
            if(empty($userPersonalDataTSP))
            {
                Flash::error('User PersonalData T S P not found');
                return redirect(route('userPersonalDataTSPs.index'));
            }
    
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_playlists.id', '=', $userPersonalDataTSP[0] -> p_d_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSPAudiosList = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userPersonalDataTSPlaylistsList = DB::table('user_personal_data_t_s_p')->join('users', 'user_personal_data_t_s_p.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_p.description', 'permissions', 'user_personal_data_t_s_p.datetime', 'user_personal_data_t_s_p.id', 'p_d_t_s_p_id')->where('p_d_t_s_p_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_p.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSPlaylistViewsList = DB::table('users')->join('personal_data_t_s_p_views', 'users.id', '=', 'personal_data_t_s_p_views.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSPlaylistUpdatesList = DB::table('users')->join('personal_data_t_s_p_updates', 'users.id', '=', 'personal_data_t_s_p_updates.user_id')->where('p_d_t_s_p_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                
                return view('user_personal_data_t_s_ps.edit')
                    ->with('userPersonalDataTSP', $userPersonalDataTSP)
                    ->with('id', $userPersonalDataTSP[0] -> p_d_t_s_p_id)
                    ->with('personalDataTSPAudiosList', $personalDataTSPAudiosList)
                    ->with('userPersonalDataTSPlaylistsList', $userPersonalDataTSPlaylistsList)
                    ->with('personalDataTSPlaylistViewsList', $personalDataTSPlaylistViewsList)
                    ->with('personalDataTSPlaylistUpdatesList', $personalDataTSPlaylistUpdatesList);
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

    public function update($id, UpdateUserPersonalDataTSPRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userPersonalDataTSP = $this->userPersonalDataTSPRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userPersonalDataTSP))
            {
                Flash::error('User PersonalData T S P not found');
                return redirect(route('userPersonalDataTSPs.index'));
            }
    
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_playlists.id', '=', $userPersonalDataTSP -> p_d_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userPersonalDataTSP -> user_id;
                $userPersonalDataTSP = $this->userPersonalDataTSPRepository->update($request->all(), $id);
                $personalDataTSPlaylistAudios = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $userPersonalDataTSP -> p_d_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('u_p_d_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_id' => $userPersonalDataTSP -> id]);
                    
                foreach($personalDataTSPlaylistAudios as $personalDataTSPlaylistAudio)
                {
                    DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', $personalDataTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTSP -> permissions]);
                                            
                    $userPersonalDataTSPlaylistAudio = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $personalDataTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userPersonalDataTSPlaylistAudio[0]))
                    {
                        DB::table('u_p_d_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPersonalDataTSPlaylistAudio[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_personal_data_t_s_p')->join('users', 'users.id', '=', 'user_personal_data_t_s_p.user_id')->where('user_personal_data_t_s_p.id', '=', $userPersonalDataTSP -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_p_u', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSP -> p_d_t_s_p_id, 'created_at' => $now]);
            
                Flash::success('User PersonalData T S P updated successfully.');
                return redirect(route('userPersonalDataTSPs.show', [$userPersonalDataTSP -> p_d_t_s_p_id]));
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
            $userPersonalDataTSP = $this->userPersonalDataTSPRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userPersonalDataTSP))
            {
                Flash::error('User PersonalData T S P not found');
                return redirect(route('userPersonalDataTSPs.index'));
            }
            
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_playlists.id', '=', $userPersonalDataTSP -> p_d_t_s_p_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userPersonalDataTSP -> user_id;
                $personalDataTSPlaylistAudios = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $userPersonalDataTSP -> p_d_t_s_p_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('u_p_d_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_id' => $userPersonalDataTSP -> id]);
           
                foreach($personalDataTSPlaylistAudios as $personalDataTSPlaylistAudio)
                {
                    DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', $personalDataTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userPersonalDataTSPlaylistAudio = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $personalDataTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userPersonalDataTSPlaylistAudio[0]))
                    {
                        DB::table('u_p_d_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPersonalDataTSPlaylistAudio[0] -> id]);
                    }
                }
        
                $this->userPersonalDataTSPRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_personal_data_t_s_p')->join('users', 'users.id', '=', 'user_personal_data_t_s_p.user_id')->where('user_personal_data_t_s_p.id', '=', $userPersonalDataTSP -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_p_d', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSP -> p_d_t_s_p_id, 'created_at' => $now]);
            
                Flash::success('User PersonalData T S P deleted successfully.');
                return redirect(route('userPersonalDataTSPs.show', [$userPersonalDataTSP -> p_d_t_s_p_id]));
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