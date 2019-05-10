<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPAudioUpdateRequest;
use App\Http\Requests\UpdateCollegeTSPAudioUpdateRequest;
use App\Repositories\CollegeTSPAudioUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPAudioUpdateController extends AppBaseController
{
    private $collegeTSPAudioUpdateRepository;

    public function __construct(CollegeTSPAudioUpdateRepository $collegeTSPAudioUpdateRepo)
    {
        $this->collegeTSPAudioUpdateRepository = $collegeTSPAudioUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPAudioUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPAudioUpdates = $this->collegeTSPAudioUpdateRepository->all();
    
            return view('college_t_s_p_audio_updates.index')
                ->with('collegeTSPAudioUpdates', $collegeTSPAudioUpdates);
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
            return view('college_t_s_p_audio_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSPAudioUpdate = $this->collegeTSPAudioUpdateRepository->create($input);
            
                Flash::success('College T S P Audio Update saved successfully.');
                return redirect(route('collegeTSPAudioUpdates.index'));
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
            $collegeTSPAudioUpdate = $this->collegeTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioUpdate))
            {
                Flash::error('College T S P Audio Update not found');
                return redirect(route('collegeTSPAudioUpdates.index'));
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
            
            if($user_id == $collegeTSPAudioUpdate -> user_id || $isShared)
            {
                return view('college_t_s_p_audio_updates.show')->with('collegeTSPAudioUpdate', $collegeTSPAudioUpdate);
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
            $collegeTSPAudioUpdate = $this->collegeTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioUpdate))
            {
                Flash::error('College T S P Audio Update not found');
                return redirect(route('collegeTSPAudioUpdates.index'));
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
            
            if($user_id == $collegeTSPAudioUpdate -> user_id || $isShared)
            {
                return view('college_t_s_p_audio_updates.edit')->with('collegeTSPAudioUpdate', $collegeTSPAudioUpdate);
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

    public function update($id, UpdateCollegeTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSPAudioUpdate = $this->collegeTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioUpdate))
            {
                Flash::error('College T S P Audio Update not found');
                return redirect(route('collegeTSPAudioUpdates.index'));
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
            
            if($user_id == $collegeTSPAudioUpdate -> user_id || $isShared)
            {
                $collegeTSPAudioUpdate = $this->collegeTSPAudioUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S P Audio Update updated successfully.');
                return redirect(route('collegeTSPAudioUpdates.index'));
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
            $collegeTSPAudioUpdate = $this->collegeTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioUpdate))
            {
                Flash::error('College T S P Audio Update not found');
                return redirect(route('collegeTSPAudioUpdates.index'));
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
            
            if($user_id == $collegeTSPAudioUpdate -> user_id || $isShared)
            {
                $this->collegeTSPAudioUpdateRepository->delete($id);
            
                Flash::success('College T S P Audio Update deleted successfully.');
                return redirect(route('collegeTSPAudioUpdates.index'));
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