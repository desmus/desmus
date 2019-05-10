<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSPlaylistDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSPlaylistDeleteRequest;
use App\Repositories\PersonalDataTSPlaylistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSPlaylistDeleteController extends AppBaseController
{
    private $personalDataTSPlaylistDeleteRepository;

    public function __construct(PersonalDataTSPlaylistDeleteRepository $personalDataTSPlaylistDeleteRepo)
    {
        $this->personalDataTSPlaylistDeleteRepository = $personalDataTSPlaylistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSPlaylistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSPlaylistDeletes = $this->personalDataTSPlaylistDeleteRepository->all();
    
            return view('personal_data_t_s_playlist_deletes.index')
                ->with('personalDataTSPlaylistDeletes', $personalDataTSPlaylistDeletes);
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
            return view('personal_data_t_s_playlist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSPlaylistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSPlaylistDelete = $this->personalDataTSPlaylistDeleteRepository->create($input);
            
                Flash::success('PersonalData T S Playlist Delete saved successfully.');
                return redirect(route('personalDataTSPlaylistDeletes.index'));
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
            $personalDataTSPlaylistDelete = $this->personalDataTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistDelete))
            {
                Flash::error('PersonalData T S Playlist Delete not found');
                return redirect(route('personalDataTSPlaylistDeletes.index'));
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
            
            if($user_id == $personalDataTSPlaylistDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_playlist_deletes.show')->with('personalDataTSPlaylistDelete', $personalDataTSPlaylistDelete);
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
            $personalDataTSPlaylistDelete = $this->personalDataTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistDelete))
            {
                Flash::error('PersonalData T S Playlist Delete not found');
                return redirect(route('personalDataTSPlaylistDeletes.index'));
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
            
            if($user_id == $personalDataTSPlaylistDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_playlist_deletes.edit')->with('personalDataTSPlaylistDelete', $personalDataTSPlaylistDelete);
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

    public function update($id, UpdatePersonalDataTSPlaylistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSPlaylistDelete = $this->personalDataTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistDelete))
            {
                Flash::error('PersonalData T S Playlist Delete not found');
                return redirect(route('personalDataTSPlaylistDeletes.index'));
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
            
            if($user_id == $personalDataTSPlaylistDelete -> user_id || $isShared)
            {
                $personalDataTSPlaylistDelete = $this->personalDataTSPlaylistDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Playlist Delete updated successfully.');
                return redirect(route('personalDataTSPlaylistDeletes.index'));
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
            $personalDataTSPlaylistDelete = $this->personalDataTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistDelete))
            {
                Flash::error('PersonalData T S Playlist Delete not found');
                return redirect(route('personalDataTSPlaylistDeletes.index'));
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
            
            if($user_id == $personalDataTSPlaylistDelete -> user_id || $isShared)
            {
                $this->personalDataTSPlaylistDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S Playlist Delete deleted successfully.');
                return redirect(route('personalDataTSPlaylistDeletes.index'));
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