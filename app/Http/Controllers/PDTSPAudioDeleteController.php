<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePDTSPAudioDeleteRequest;
use App\Http\Requests\UpdatePDTSPAudioDeleteRequest;
use App\Repositories\PDTSPAudioDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PDTSPAudioDeleteController extends AppBaseController
{
    private $pDTSPAudioDeleteRepository;

    public function __construct(PDTSPAudioDeleteRepository $pDTSPAudioDeleteRepo)
    {
        $this->pDTSPAudioDeleteRepository = $pDTSPAudioDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->pDTSPAudioDeleteRepository->pushCriteria(new RequestCriteria($request));
            $pDTSPAudioDeletes = $this->pDTSPAudioDeleteRepository->all();
    
            return view('p_d_t_s_p_audio_deletes.index')
                ->with('pDTSPAudioDeletes', $pDTSPAudioDeletes);
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
            return view('p_d_t_s_p_audio_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePDTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $pDTSPAudioDelete = $this->pDTSPAudioDeleteRepository->create($input);
            
                Flash::success('PD T S P Audio Delete saved successfully.');
                return redirect(route('pDTSPAudioDeletes.index'));
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
            $pDTSPAudioDelete = $this->pDTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioDelete))
            {
                Flash::error('PD T S P Audio Delete not found');
                return redirect(route('pDTSPAudioDeletes.index'));
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
            
            if($user_id == $pDTSPAudioDelete -> user_id || $isShared)
            {
                return view('p_d_t_s_p_audio_deletes.show')->with('pDTSPAudioDelete', $pDTSPAudioDelete);
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
            $pDTSPAudioDelete = $this->pDTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioDelete))
            {
                Flash::error('PD T S P Audio Delete not found');
                return redirect(route('pDTSPAudioDeletes.index'));
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
            
            if($user_id == $pDTSPAudioDelete -> user_id || $isShared)
            {
                return view('p_d_t_s_p_audio_deletes.edit')->with('pDTSPAudioDelete', $pDTSPAudioDelete);
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

    public function update($id, UpdatePDTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $pDTSPAudioDelete = $this->pDTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioDelete))
            {
                Flash::error('PD T S P Audio Delete not found');
                return redirect(route('pDTSPAudioDeletes.index'));
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
            
            if($user_id == $pDTSPAudioDelete -> user_id || $isShared)
            {
                $pDTSPAudioDelete = $this->pDTSPAudioDeleteRepository->update($request->all(), $id);
            
                Flash::success('PD T S P Audio Delete updated successfully.');
                return redirect(route('pDTSPAudioDeletes.index'));
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
            $pDTSPAudioDelete = $this->pDTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioDelete))
            {
                Flash::error('PD T S P Audio Delete not found');
                return redirect(route('pDTSPAudioDeletes.index'));
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
            
            if($user_id == $pDTSPAudioDelete -> user_id || $isShared)
            {
                $this->pDTSPAudioDeleteRepository->delete($id);
            
                Flash::success('PD T S P Audio Delete deleted successfully.');
                return redirect(route('pDTSPAudioDeletes.index'));
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