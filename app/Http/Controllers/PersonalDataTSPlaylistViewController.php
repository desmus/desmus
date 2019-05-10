<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSPlaylistViewRequest;
use App\Http\Requests\UpdatePersonalDataTSPlaylistViewRequest;
use App\Repositories\PersonalDataTSPlaylistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSPlaylistViewController extends AppBaseController
{
    private $personalDataTSPlaylistViewRepository;

    public function __construct(PersonalDataTSPlaylistViewRepository $personalDataTSPlaylistViewRepo)
    {
        $this->personalDataTSPlaylistViewRepository = $personalDataTSPlaylistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSPlaylistViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSPlaylistViews = $this->personalDataTSPlaylistViewRepository->all();
    
            return view('personal_data_t_s_playlist_views.index')
                ->with('personalDataTSPlaylistViews', $personalDataTSPlaylistViews);
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
            return view('personal_data_t_s_playlist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSPlaylistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSPlaylistView = $this->personalDataTSPlaylistViewRepository->create($input);
            
                Flash::success('PersonalData T S Playlist View saved successfully.');
                return redirect(route('personalDataTSPlaylistViews.index'));
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
            $personalDataTSPlaylistView = $this->personalDataTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistView))
            {
                Flash::error('PersonalData T S Playlist View not found');
                return redirect(route('personalDataTSPlaylistViews.index'));
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
            
            if($user_id == $personalDataTSPlaylistView -> user_id || $isShared)
            {
                return view('personal_data_t_s_playlist_views.show')->with('personalDataTSPlaylistView', $personalDataTSPlaylistView);
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
            $personalDataTSPlaylistView = $this->personalDataTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistView))
            {
                Flash::error('PersonalData T S Playlist View not found');
                return redirect(route('personalDataTSPlaylistViews.index'));
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
            
            if($user_id == $personalDataTSPlaylistView -> user_id || $isShared)
            {
                return view('personal_data_t_s_playlist_views.edit')->with('personalDataTSPlaylistView', $personalDataTSPlaylistView);
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

    public function update($id, UpdatePersonalDataTSPlaylistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSPlaylistView = $this->personalDataTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistView))
            {
                Flash::error('PersonalData T S Playlist View not found');
                return redirect(route('personalDataTSPlaylistViews.index'));
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
            
            if($user_id == $personalDataTSPlaylistView -> user_id || $isShared)
            {
                $personalDataTSPlaylistView = $this->personalDataTSPlaylistViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Playlist View updated successfully.');
                return redirect(route('personalDataTSPlaylistViews.index'));
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
            $personalDataTSPlaylistView = $this->personalDataTSPlaylistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPlaylistView))
            {
                Flash::error('PersonalData T S Playlist View not found');
                return redirect(route('personalDataTSPlaylistViews.index'));
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
            
            if($user_id == $personalDataTSPlaylistView -> user_id || $isShared)
            {
                $this->personalDataTSPlaylistViewRepository->delete($id);
            
                Flash::success('PersonalData T S Playlist View deleted successfully.');
                return redirect(route('personalDataTSPlaylistViews.index'));
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