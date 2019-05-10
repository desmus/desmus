<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePDTSPAudioViewRequest;
use App\Http\Requests\UpdatePDTSPAudioViewRequest;
use App\Repositories\PDTSPAudioViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PDTSPAudioViewController extends AppBaseController
{
    private $pDTSPAudioViewRepository;

    public function __construct(PDTSPAudioViewRepository $pDTSPAudioViewRepo)
    {
        $this->pDTSPAudioViewRepository = $pDTSPAudioViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->pDTSPAudioViewRepository->pushCriteria(new RequestCriteria($request));
            $pDTSPAudioViews = $this->pDTSPAudioViewRepository->all();
    
            return view('p_d_t_s_p_audio_views.index')
                ->with('pDTSPAudioViews', $pDTSPAudioViews);
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
            return view('p_d_t_s_p_audio_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPDTSPAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $pDTSPAudioView = $this->pDTSPAudioViewRepository->create($input);
            
                Flash::success('PD T S P Audio View saved successfully.');
                return redirect(route('pDTSPAudioViews.index'));
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
            $pDTSPAudioView = $this->pDTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioView))
            {
                Flash::error('PD T S P Audio View not found');
                return redirect(route('pDTSPAudioViews.index'));
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
            
            if($user_id == $pDTSPAudioView -> user_id || $isShared)
            {
                return view('p_d_t_s_p_audio_views.show')->with('pDTSPAudioView', $pDTSPAudioView);
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
            $pDTSPAudioView = $this->pDTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioView))
            {
                Flash::error('PD T S P Audio View not found');
                return redirect(route('pDTSPAudioViews.index'));
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
            
            if($user_id == $pDTSPAudioView -> user_id || $isShared)
            {
                return view('p_d_t_s_p_audio_views.edit')->with('pDTSPAudioView', $pDTSPAudioView);
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

    public function update($id, UpdatePDTSPAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $pDTSPAudioView = $this->pDTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioView))
            {
                Flash::error('PD T S P Audio View not found');
                return redirect(route('pDTSPAudioViews.index'));
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
            
            if($user_id == $pDTSPAudioView -> user_id || $isShared)
            {
                $pDTSPAudioView = $this->pDTSPAudioViewRepository->update($request->all(), $id);
            
                Flash::success('PD T S P Audio View updated successfully.');
                return redirect(route('pDTSPAudioViews.index'));
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
            $pDTSPAudioView = $this->pDTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($pDTSPAudioView))
            {
                Flash::error('PD T S P Audio View not found');
                return redirect(route('pDTSPAudioViews.index'));
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
            
            if($user_id == $pDTSPAudioView -> user_id || $isShared)
            {
                $this->pDTSPAudioViewRepository->delete($id);
            
                Flash::success('PD T S P Audio View deleted successfully.');
                return redirect(route('pDTSPAudioViews.index'));
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