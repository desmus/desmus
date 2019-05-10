<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPAudioDeleteRequest;
use App\Http\Requests\UpdateCollegeTSPAudioDeleteRequest;
use App\Repositories\CollegeTSPAudioDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPAudioDeleteController extends AppBaseController
{
    private $collegeTSPAudioDeleteRepository;

    public function __construct(CollegeTSPAudioDeleteRepository $collegeTSPAudioDeleteRepo)
    {
        $this->collegeTSPAudioDeleteRepository = $collegeTSPAudioDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPAudioDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPAudioDeletes = $this->collegeTSPAudioDeleteRepository->all();
    
            return view('college_t_s_p_audio_deletes.index')
                ->with('collegeTSPAudioDeletes', $collegeTSPAudioDeletes);
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
            return view('college_t_s_p_audio_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSPAudioDelete = $this->collegeTSPAudioDeleteRepository->create($input);
            
                Flash::success('College T S P Audio Delete saved successfully.');
                return redirect(route('collegeTSPAudioDeletes.index'));
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
            $collegeTSPAudioDelete = $this->collegeTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioDelete))
            {
                Flash::error('College T S P Audio Delete not found');
                return redirect(route('collegeTSPAudioDeletes.index'));
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
            
            if($user_id == $collegeTSPAudioDelete -> user_id || $isShared)
            {
                return view('college_t_s_p_audio_deletes.show')->with('collegeTSPAudioDelete', $collegeTSPAudioDelete);
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
            $collegeTSPAudioDelete = $this->collegeTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioDelete))
            {
                Flash::error('College T S P Audio Delete not found');
                return redirect(route('collegeTSPAudioDeletes.index'));
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
            
            if($user_id == $collegeTSPAudioDelete -> user_id || $isShared)
            {
              return view('college_t_s_p_audio_deletes.edit')->with('collegeTSPAudioDelete', $collegeTSPAudioDelete);
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

    public function update($id, UpdateCollegeTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSPAudioDelete = $this->collegeTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioDelete))
            {
                Flash::error('College T S P Audio Delete not found');
                return redirect(route('collegeTSPAudioDeletes.index'));
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
            
            if($user_id == $collegeTSPAudioDelete -> user_id || $isShared)
            {
                $collegeTSPAudioDelete = $this->collegeTSPAudioDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S P Audio Delete updated successfully.');
                return redirect(route('collegeTSPAudioDeletes.index'));
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
            $collegeTSPAudioDelete = $this->collegeTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPAudioDelete))
            {
                Flash::error('College T S P Audio Delete not found');
                return redirect(route('collegeTSPAudioDeletes.index'));
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
            
            if($user_id == $collegeTSPAudioDelete -> user_id || $isShared)
            {
                $this->collegeTSPAudioDeleteRepository->delete($id);
            
                Flash::success('College T S P Audio Delete deleted successfully.');
                return redirect(route('collegeTSPAudioDeletes.index'));
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