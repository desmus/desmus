<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSPlaylistCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSPlaylistCreateRequest;
use App\Repositories\PersonalDataTSPlaylistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSPlaylistCreateController extends AppBaseController
{
    private $personalDataTSPlaylistCreateRepository;

    public function __construct(PersonalDataTSPlaylistCreateRepository $personalDataTSPlaylistCreateRepo)
    {
        $this->personalDataTSPlaylistCreateRepository = $personalDataTSPlaylistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSPlaylistCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSPlaylistCreates = $this->personalDataTSPlaylistCreateRepository->all();
    
            return view('personal_data_t_s_playlist_creates.index')
                ->with('personalDataTSPlaylistCreates', $personalDataTSPlaylistCreates);
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
            return view('personal_data_t_s_playlist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSPlaylistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSPlaylistCreate = $this->personalDataTSPlaylistCreateRepository->create($input);
            
                Flash::success('PersonalData T S Playlist Create saved successfully.');
                return redirect(route('personalDataTSPlaylistCreates.index'));
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
            $personalDataTSPlaylistCreate = $this->personalDataTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistCreate))
            {
                Flash::error('PersonalData T S Playlist Create not found');
                return redirect(route('personalDataTSPlaylistCreates.index'));
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
            
            if($user_id == $personalDataTSPlaylistCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_playlist_creates.show')->with('personalDataTSPlaylistCreate', $personalDataTSPlaylistCreate);
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
            $personalDataTSPlaylistCreate = $this->personalDataTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistCreate))
            {
                Flash::error('PersonalData T S Playlist Create not found');
                return redirect(route('personalDataTSPlaylistCreates.index'));
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
            
            if($user_id == $personalDataTSPlaylistCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_playlist_creates.edit')->with('personalDataTSPlaylistCreate', $personalDataTSPlaylistCreate);
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

    public function update($id, UpdatePersonalDataTSPlaylistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSPlaylistCreate = $this->personalDataTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistCreate))
            {
                Flash::error('PersonalData T S Playlist Create not found');
                return redirect(route('personalDataTSPlaylistCreates.index'));
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
            
            if($user_id == $personalDataTSPlaylistCreate -> user_id || $isShared)
            {
                $personalDataTSPlaylistCreate = $this->personalDataTSPlaylistCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Playlist Create updated successfully.');
                return redirect(route('personalDataTSPlaylistCreates.index'));
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
            $personalDataTSPlaylistCreate = $this->personalDataTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistCreate))
            {
                Flash::error('PersonalData T S Playlist Create not found');
                return redirect(route('personalDataTSPlaylistCreates.index'));
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
            
            if($user_id == $personalDataTSPlaylistCreate -> user_id || $isShared)
            {
                $this->personalDataTSPlaylistCreateRepository->delete($id);
            
                Flash::success('PersonalData T S Playlist Create deleted successfully.');
                return redirect(route('personalDataTSPlaylistCreates.index'));
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