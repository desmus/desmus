<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPAudioViewRequest;
use App\Http\Requests\UpdateCollegeTSPAudioViewRequest;
use App\Repositories\CollegeTSPAudioViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPAudioViewController extends AppBaseController
{
    private $collegeTSPAudioViewRepository;

    public function __construct(CollegeTSPAudioViewRepository $collegeTSPAudioViewRepo)
    {
        $this->collegeTSPAudioViewRepository = $collegeTSPAudioViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPAudioViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPAudioViews = $this->collegeTSPAudioViewRepository->all();
    
            return view('college_t_s_p_audio_views.index')
                ->with('collegeTSPAudioViews', $collegeTSPAudioViews);
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
            return view('college_t_s_p_audio_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSPAudioView = $this->collegeTSPAudioViewRepository->create($input);
            
                Flash::success('College T S P Audio View saved successfully.');
                return redirect(route('collegeTSPAudioViews.index'));
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
            $collegeTSPAudioView = $this->collegeTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioView))
            {
                Flash::error('College T S P Audio View not found');
                return redirect(route('collegeTSPAudioViews.index'));
            }
    
            $userCollegeTSPAudios = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSPAudios as $userCollegeTSPAudio)
            {
                if($userCollegeTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_p_audios')->join('college_t_s_playlists', 'college_t_s_p_audios.c_t_s_p_id', '=', 'college_t_s_playlists.id')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $collegeTSPAudioView -> user_id || $isShared)
            {
                return view('college_t_s_p_audio_views.show')->with('collegeTSPAudioView', $collegeTSPAudioView);
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
            $collegeTSPAudioView = $this->collegeTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioView))
            {
                Flash::error('College T S P Audio View not found');
                return redirect(route('collegeTSPAudioViews.index'));
            }
            
            $userCollegeTSPAudios = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSPAudios as $userCollegeTSPAudio)
            {
                if($userCollegeTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_p_audios')->join('college_t_s_playlists', 'college_t_s_p_audios.c_t_s_p_id', '=', 'college_t_s_playlists.id')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $collegeTSPAudioView -> user_id || $isShared)
            {
                return view('college_t_s_p_audio_views.edit')->with('collegeTSPAudioView', $collegeTSPAudioView);
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

    public function update($id, UpdateCollegeTSPAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSPAudioView = $this->collegeTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioView))
            {
                Flash::error('College T S P Audio View not found');
                return redirect(route('collegeTSPAudioViews.index'));
            }
            
            $userCollegeTSPAudios = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSPAudios as $userCollegeTSPAudio)
            {
                if($userCollegeTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_p_audios')->join('college_t_s_playlists', 'college_t_s_p_audios.c_t_s_p_id', '=', 'college_t_s_playlists.id')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $collegeTSPAudioView -> user_id || $isShared)
            {
                $collegeTSPAudioView = $this->collegeTSPAudioViewRepository->update($request->all(), $id);
            
                Flash::success('College T S P Audio View updated successfully.');
                return redirect(route('collegeTSPAudioViews.index'));
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
            $collegeTSPAudioView = $this->collegeTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioView))
            {
                Flash::error('College T S P Audio View not found');
                return redirect(route('collegeTSPAudioViews.index'));
            }
            
            $userCollegeTSPAudios = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSPAudios as $userCollegeTSPAudio)
            {
                if($userCollegeTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_p_audios')->join('college_t_s_playlists', 'college_t_s_p_audios.c_t_s_p_id', '=', 'college_t_s_playlists.id')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $collegeTSPAudioView -> user_id || $isShared)
            {
                $this->collegeTSPAudioViewRepository->delete($id);
            
                Flash::success('College T S P Audio View deleted successfully.');
                return redirect(route('collegeTSPAudioViews.index'));
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