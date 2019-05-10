<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPAudioCreateRequest;
use App\Http\Requests\UpdateProjectTSPAudioCreateRequest;
use App\Repositories\ProjectTSPAudioCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPAudioCreateController extends AppBaseController
{
    private $projectTSPAudioCreateRepository;

    public function __construct(ProjectTSPAudioCreateRepository $projectTSPAudioCreateRepo)
    {
        $this->projectTSPAudioCreateRepository = $projectTSPAudioCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPAudioCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPAudioCreates = $this->projectTSPAudioCreateRepository->all();
    
            return view('project_t_s_p_audio_creates.index')
                ->with('projectTSPAudioCreates', $projectTSPAudioCreates);
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
            return view('project_t_s_p_audio_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSPAudioCreate = $this->projectTSPAudioCreateRepository->create($input);
                
                Flash::success('Project T S P Audio Create saved successfully.');
                return redirect(route('projectTSPAudioCreates.index'));
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
            $projectTSPAudioCreate = $this->projectTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioCreate))
            {
                Flash::error('Project T S P Audio Create not found');
                return redirect(route('projectTSPAudioCreates.index'));
            }
            
            $userProjectTSPAudios = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPAudios as $userProjectTSPAudio)
            {
                if($userProjectTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $projectTSPAudioCreate -> user_id || $isShared)
            {
                return view('project_t_s_p_audio_creates.show')->with('projectTSPAudioCreate', $projectTSPAudioCreate);
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
            $projectTSPAudioCreate = $this->projectTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioCreate))
            {
                Flash::error('Project T S P Audio Create not found');
                return redirect(route('projectTSPAudioCreates.index'));
            }
            
            $userProjectTSPAudios = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPAudios as $userProjectTSPAudio)
            {
                if($userProjectTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $projectTSPAudioCreate -> user_id || $isShared)
            {
                return view('project_t_s_p_audio_creates.edit')->with('projectTSPAudioCreate', $projectTSPAudioCreate);
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

    public function update($id, UpdateProjectTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPAudioCreate = $this->projectTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioCreate))
            {
                Flash::error('Project T S P Audio Create not found');
                return redirect(route('projectTSPAudioCreates.index'));
            }
    
            $userProjectTSPAudios = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPAudios as $userProjectTSPAudio)
            {
                if($userProjectTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $projectTSPAudioCreate -> user_id || $isShared)
            {
                $projectTSPAudioCreate = $this->projectTSPAudioCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S P Audio Create updated successfully.');
                return redirect(route('projectTSPAudioCreates.index'));
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
            $projectTSPAudioCreate = $this->projectTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioCreate))
            {
                Flash::error('Project T S P Audio Create not found');
                return redirect(route('projectTSPAudioCreates.index'));
            }
            
            $userProjectTSPAudios = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPAudios as $userProjectTSPAudio)
            {
                if($userProjectTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $projectTSPAudioCreate -> user_id || $isShared)
            {
                $this->projectTSPAudioCreateRepository->delete($id);
                
                Flash::success('Project T S P Audio Create deleted successfully.');
                return redirect(route('projectTSPAudioCreates.index'));
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