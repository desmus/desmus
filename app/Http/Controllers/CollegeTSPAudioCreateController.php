<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPAudioCreateRequest;
use App\Http\Requests\UpdateCollegeTSPAudioCreateRequest;
use App\Repositories\CollegeTSPAudioCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPAudioCreateController extends AppBaseController
{
    private $collegeTSPAudioCreateRepository;

    public function __construct(CollegeTSPAudioCreateRepository $collegeTSPAudioCreateRepo)
    {
        $this->collegeTSPAudioCreateRepository = $collegeTSPAudioCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPAudioCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPAudioCreates = $this->collegeTSPAudioCreateRepository->all();
    
            return view('college_t_s_p_audio_creates.index')
                ->with('collegeTSPAudioCreates', $collegeTSPAudioCreates);
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
            return view('college_t_s_p_audio_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSPAudioCreate = $this->collegeTSPAudioCreateRepository->create($input);
            }
            
            else
            {
                return view('deniedAccess');
            }
    
            Flash::success('College T S P Audio Create saved successfully.');
            return redirect(route('collegeTSPAudioCreates.index'));
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
            $collegeTSPAudioCreate = $this->collegeTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioCreate))
            {
                Flash::error('College T S P Audio Create not found');
                return redirect(route('collegeTSPAudioCreates.index'));
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
            
            if($user_id == $collegeTSPAudioCreate -> user_id || $isShared)
            {
                return view('college_t_s_p_audio_creates.show')->with('collegeTSPAudioCreate', $collegeTSPAudioCreate);
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
            $collegeTSPAudioCreate = $this->collegeTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioCreate))
            {
                Flash::error('College T S P Audio Create not found');
                return redirect(route('collegeTSPAudioCreates.index'));
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
            
            if($user_id == $collegeTSPAudioCreate -> user_id || $isShared)
            {
                return view('college_t_s_p_audio_creates.edit')->with('collegeTSPAudioCreate', $collegeTSPAudioCreate);
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

    public function update($id, UpdateCollegeTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSPAudioCreate = $this->collegeTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioCreate))
            {
                Flash::error('College T S P Audio Create not found');
                return redirect(route('collegeTSPAudioCreates.index'));
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
            
            if($user_id == $collegeTSPAudioCreate -> user_id || $isShared)
            {
                $collegeTSPAudioCreate = $this->collegeTSPAudioCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S P Audio Create updated successfully.');
                return redirect(route('collegeTSPAudioCreates.index'));
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
            $collegeTSPAudioCreate = $this->collegeTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioCreate))
            {
                Flash::error('College T S P Audio Create not found');
                return redirect(route('collegeTSPAudioCreates.index'));
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
            
            if($user_id == $collegeTSPAudioCreate -> user_id || $isShared)
            {
                $this->collegeTSPAudioCreateRepository->delete($id);
            
                Flash::success('College T S P Audio Create deleted successfully.');
                return redirect(route('collegeTSPAudioCreates.index'));
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