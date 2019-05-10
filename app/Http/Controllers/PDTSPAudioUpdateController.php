<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePDTSPAudioUpdateRequest;
use App\Http\Requests\UpdatePDTSPAudioUpdateRequest;
use App\Repositories\PDTSPAudioUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PDTSPAudioUpdateController extends AppBaseController
{
    private $pDTSPAudioUpdateRepository;

    public function __construct(PDTSPAudioUpdateRepository $pDTSPAudioUpdateRepo)
    {
        $this->pDTSPAudioUpdateRepository = $pDTSPAudioUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->pDTSPAudioUpdateRepository->pushCriteria(new RequestCriteria($request));
            $pDTSPAudioUpdates = $this->pDTSPAudioUpdateRepository->all();
    
            return view('p_d_t_s_p_audio_updates.index')
                ->with('pDTSPAudioUpdates', $pDTSPAudioUpdates);
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
            return view('p_d_t_s_p_audio_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePDTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $pDTSPAudioUpdate = $this->pDTSPAudioUpdateRepository->create($input);
            
                Flash::success('PD T S P Audio Update saved successfully.');
                return redirect(route('pDTSPAudioUpdates.index'));
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
            $pDTSPAudioUpdate = $this->pDTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioUpdate))
            {
                Flash::error('PD T S P Audio Update not found');
                return redirect(route('pDTSPAudioUpdates.index'));
            }
            
            $userPDTSPAudios = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPDTSPAudios as $userPDTSPAudio)
            {
                if($userPDTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $pDTSPAudioUpdate -> user_id || $isShared)
            {
                return view('p_d_t_s_p_audio_updates.show')->with('pDTSPAudioUpdate', $pDTSPAudioUpdate);
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
            $pDTSPAudioUpdate = $this->pDTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioUpdate))
            {
                Flash::error('PD T S P Audio Update not found');
                return redirect(route('pDTSPAudioUpdates.index'));
            }
            
            $userPDTSPAudios = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPDTSPAudios as $userPDTSPAudio)
            {
                if($userPDTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $pDTSPAudioUpdate -> user_id || $isShared)
            {
                return view('p_d_t_s_p_audio_updates.edit')->with('pDTSPAudioUpdate', $pDTSPAudioUpdate);
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

    public function update($id, UpdatePDTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $pDTSPAudioUpdate = $this->pDTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioUpdate))
            {
                Flash::error('PD T S P Audio Update not found');
                return redirect(route('pDTSPAudioUpdates.index'));
            }
    
            $userPDTSPAudios = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPDTSPAudios as $userPDTSPAudio)
            {
                if($userPDTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $pDTSPAudioUpdate -> user_id || $isShared)
            {
                $pDTSPAudioUpdate = $this->pDTSPAudioUpdateRepository->update($request->all(), $id);
            
                Flash::success('PD T S P Audio Update updated successfully.');
                return redirect(route('pDTSPAudioUpdates.index'));
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
            $pDTSPAudioUpdate = $this->pDTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioUpdate))
            {
                Flash::error('PD T S P Audio Update not found');
                return redirect(route('pDTSPAudioUpdates.index'));
            }
            
            $userPDTSPAudios = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPDTSPAudios as $userPDTSPAudio)
            {
                if($userPDTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $pDTSPAudioUpdate -> user_id || $isShared)
            {
                $this->pDTSPAudioUpdateRepository->delete($id);
            
                Flash::success('PD T S P Audio Update deleted successfully.');
                return redirect(route('pDTSPAudioUpdates.index'));
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