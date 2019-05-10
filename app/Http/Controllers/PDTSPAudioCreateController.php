<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePDTSPAudioCreateRequest;
use App\Http\Requests\UpdatePDTSPAudioCreateRequest;
use App\Repositories\PDTSPAudioCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PDTSPAudioCreateController extends AppBaseController
{
    private $pDTSPAudioCreateRepository;

    public function __construct(PDTSPAudioCreateRepository $pDTSPAudioCreateRepo)
    {
        $this->pDTSPAudioCreateRepository = $pDTSPAudioCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->pDTSPAudioCreateRepository->pushCriteria(new RequestCriteria($request));
            $pDTSPAudioCreates = $this->pDTSPAudioCreateRepository->all();
    
            return view('p_d_t_s_p_audio_creates.index')
                ->with('pDTSPAudioCreates', $pDTSPAudioCreates);
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
            return view('p_d_t_s_p_audio_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePDTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $pDTSPAudioCreate = $this->pDTSPAudioCreateRepository->create($input);
            
                Flash::success('PD T S P Audio Create saved successfully.');
                return redirect(route('pDTSPAudioCreates.index'));
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
            $pDTSPAudioCreate = $this->pDTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioCreate))
            {
                Flash::error('PD T S P Audio Create not found');
                return redirect(route('pDTSPAudioCreates.index'));
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
            
            if($user_id == $pDTSPAudioCreate -> user_id || $isShared)
            {
                return view('p_d_t_s_p_audio_creates.show')->with('pDTSPAudioCreate', $pDTSPAudioCreate);
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
            $pDTSPAudioCreate = $this->pDTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioCreate))
            {
                Flash::error('PD T S P Audio Create not found');
                return redirect(route('pDTSPAudioCreates.index'));
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
            
            if($user_id == $pDTSPAudioCreate -> user_id || $isShared)
            {
                return view('p_d_t_s_p_audio_creates.edit')->with('pDTSPAudioCreate', $pDTSPAudioCreate);
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

    public function update($id, UpdatePDTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $pDTSPAudioCreate = $this->pDTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioCreate))
            {
                Flash::error('PD T S P Audio Create not found');
                return redirect(route('pDTSPAudioCreates.index'));
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
            
            if($user_id == $pDTSPAudioCreate -> user_id || $isShared)
            {
                $pDTSPAudioCreate = $this->pDTSPAudioCreateRepository->update($request->all(), $id);
            
                Flash::success('PD T S P Audio Create updated successfully.');
                return redirect(route('pDTSPAudioCreates.index'));
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
            $pDTSPAudioCreate = $this->pDTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioCreate))
            {
                Flash::error('PD T S P Audio Create not found');
                return redirect(route('pDTSPAudioCreates.index'));
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
            
            if($user_id == $pDTSPAudioCreate -> user_id || $isShared)
            {
                $this->pDTSPAudioCreateRepository->delete($id);
            
                Flash::success('PD T S P Audio Create deleted successfully.');
                return redirect(route('pDTSPAudioCreates.index'));
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