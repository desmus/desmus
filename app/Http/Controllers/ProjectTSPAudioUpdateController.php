<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPAudioUpdateRequest;
use App\Http\Requests\UpdateProjectTSPAudioUpdateRequest;
use App\Repositories\ProjectTSPAudioUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPAudioUpdateController extends AppBaseController
{
    private $projectTSPAudioUpdateRepository;

    public function __construct(ProjectTSPAudioUpdateRepository $projectTSPAudioUpdateRepo)
    {
        $this->projectTSPAudioUpdateRepository = $projectTSPAudioUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPAudioUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPAudioUpdates = $this->projectTSPAudioUpdateRepository->all();
    
            return view('project_t_s_p_audio_updates.index')
                ->with('projectTSPAudioUpdates', $projectTSPAudioUpdates);
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
            return view('project_t_s_p_audio_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSPAudioUpdate = $this->projectTSPAudioUpdateRepository->create($input);
            
                Flash::success('Project T S P Audio Update saved successfully.');
                return redirect(route('projectTSPAudioUpdates.index'));
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
            $projectTSPAudioUpdate = $this->projectTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioUpdate))
            {
                Flash::error('Project T S P Audio Update not found');
                return redirect(route('projectTSPAudioUpdates.index'));
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
            
            if($user_id == $projectTSPAudioUpdate -> user_id || $isShared)
            {
                return view('project_t_s_p_audio_updates.show')->with('projectTSPAudioUpdate', $projectTSPAudioUpdate);
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
            $projectTSPAudioUpdate = $this->projectTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioUpdate))
            {
                Flash::error('Project T S P Audio Update not found');
                return redirect(route('projectTSPAudioUpdates.index'));
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
            
            if($user_id == $projectTSPAudioUpdate -> user_id || $isShared)
            {
                return view('project_t_s_p_audio_updates.edit')->with('projectTSPAudioUpdate', $projectTSPAudioUpdate);
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

    public function update($id, UpdateProjectTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPAudioUpdate = $this->projectTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioUpdate))
            {
                Flash::error('Project T S P Audio Update not found');
                return redirect(route('projectTSPAudioUpdates.index'));
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
            
            if($user_id == $projectTSPAudioUpdate -> user_id || $isShared)
            {
                $projectTSPAudioUpdate = $this->projectTSPAudioUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S P Audio Update updated successfully.');
                return redirect(route('projectTSPAudioUpdates.index'));
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
            $projectTSPAudioUpdate = $this->projectTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioUpdate))
            {
                Flash::error('Project T S P Audio Update not found');
                return redirect(route('projectTSPAudioUpdates.index'));
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
            
            if($user_id == $projectTSPAudioUpdate -> user_id || $isShared)
            {
                $this->projectTSPAudioUpdateRepository->delete($id);
                
                Flash::success('Project T S P Audio Update deleted successfully.');
                return redirect(route('projectTSPAudioUpdates.index'));
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