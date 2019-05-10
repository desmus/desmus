<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSPlaylistUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSPlaylistUpdateRequest;
use App\Repositories\PersonalDataTSPlaylistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSPlaylistUpdateController extends AppBaseController
{
    private $personalDataTSPlaylistUpdateRepository;

    public function __construct(PersonalDataTSPlaylistUpdateRepository $personalDataTSPlaylistUpdateRepo)
    {
        $this->personalDataTSPlaylistUpdateRepository = $personalDataTSPlaylistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSPlaylistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSPlaylistUpdates = $this->personalDataTSPlaylistUpdateRepository->all();
    
            return view('personal_data_t_s_playlist_updates.index')
                ->with('personalDataTSPlaylistUpdates', $personalDataTSPlaylistUpdates);
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
            return view('personal_data_t_s_playlist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSPlaylistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSPlaylistUpdate = $this->personalDataTSPlaylistUpdateRepository->create($input);
            
                Flash::success('PersonalData T S Playlist Update saved successfully.');
                return redirect(route('personalDataTSPlaylistUpdates.index'));
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
            $personalDataTSPlaylistUpdate = $this->personalDataTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistUpdate))
            {
                Flash::error('PersonalData T S Playlist Update not found');
                return redirect(route('personalDataTSPlaylistUpdates.index'));
            }
            
            $userPersonalDataTSPlaylists = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSPlaylists as $userPersonalDataTSPlaylist)
            {
                if($userPersonalDataTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $personalDataTSPlaylistUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_playlist_updates.show')->with('personalDataTSPlaylistUpdate', $personalDataTSPlaylistUpdate);
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
            $personalDataTSPlaylistUpdate = $this->personalDataTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistUpdate))
            {
                Flash::error('PersonalData T S Playlist Update not found');
                return redirect(route('personalDataTSPlaylistUpdates.index'));
            }
            
            $userPersonalDataTSPlaylists = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSPlaylists as $userPersonalDataTSPlaylist)
            {
                if($userPersonalDataTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $personalDataTSPlaylistUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_playlist_updates.edit')->with('personalDataTSPlaylistUpdate', $personalDataTSPlaylistUpdate);
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

    public function update($id, UpdatePersonalDataTSPlaylistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSPlaylistUpdate = $this->personalDataTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistUpdate))
            {
                Flash::error('PersonalData T S Playlist Update not found');
                return redirect(route('personalDataTSPlaylistUpdates.index'));
            }
            
            $userPersonalDataTSPlaylists = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSPlaylists as $userPersonalDataTSPlaylist)
            {
                if($userPersonalDataTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $personalDataTSPlaylistUpdate -> user_id || $isShared)
            {
                $personalDataTSPlaylistUpdate = $this->personalDataTSPlaylistUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Playlist Update updated successfully.');
                return redirect(route('personalDataTSPlaylistUpdates.index'));
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
            $personalDataTSPlaylistUpdate = $this->personalDataTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistUpdate))
            {
                Flash::error('PersonalData T S Playlist Update not found');
                return redirect(route('personalDataTSPlaylistUpdates.index'));
            }
    
            $userPersonalDataTSPlaylists = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSPlaylists as $userPersonalDataTSPlaylist)
            {
                if($userPersonalDataTSPlaylist -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_playlists.id', '=', $id)->get();
            
            if($user_id == $personalDataTSPlaylistUpdate -> user_id || $isShared)
            {
                $this->personalDataTSPlaylistUpdateRepository->delete($id);
            
                Flash::success('PersonalData T S Playlist Update deleted successfully.');
                return redirect(route('personalDataTSPlaylistUpdates.index'));
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