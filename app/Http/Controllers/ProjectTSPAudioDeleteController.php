<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPAudioDeleteRequest;
use App\Http\Requests\UpdateProjectTSPAudioDeleteRequest;
use App\Repositories\ProjectTSPAudioDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPAudioDeleteController extends AppBaseController
{
    private $projectTSPAudioDeleteRepository;

    public function __construct(ProjectTSPAudioDeleteRepository $projectTSPAudioDeleteRepo)
    {
        $this->projectTSPAudioDeleteRepository = $projectTSPAudioDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPAudioDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPAudioDeletes = $this->projectTSPAudioDeleteRepository->all();
    
            return view('project_t_s_p_audio_deletes.index')
                ->with('projectTSPAudioDeletes', $projectTSPAudioDeletes);
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
            return view('project_t_s_p_audio_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSPAudioDelete = $this->projectTSPAudioDeleteRepository->create($input);
                
                Flash::success('Project T S P Audio Delete saved successfully.');
                return redirect(route('projectTSPAudioDeletes.index'));
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
            $projectTSPAudioDelete = $this->projectTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioDelete))
            {
                Flash::error('Project T S P Audio Delete not found');
                return redirect(route('projectTSPAudioDeletes.index'));
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
            
            if($user_id == $projectTSPAudioDelete -> user_id || $isShared)
            {
                return view('project_t_s_p_audio_deletes.show')->with('projectTSPAudioDelete', $projectTSPAudioDelete);
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
            $projectTSPAudioDelete = $this->projectTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioDelete))
            {
                Flash::error('Project T S P Audio Delete not found');
                return redirect(route('projectTSPAudioDeletes.index'));
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
            
            if($user_id == $projectTSPAudioDelete -> user_id || $isShared)
            {
                return view('project_t_s_p_audio_deletes.edit')->with('projectTSPAudioDelete', $projectTSPAudioDelete);
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

    public function update($id, UpdateProjectTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPAudioDelete = $this->projectTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioDelete))
            {
                Flash::error('Project T S P Audio Delete not found');
                return redirect(route('projectTSPAudioDeletes.index'));
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
            
            if($user_id == $projectTSPAudioDelete -> user_id || $isShared)
            {
                $projectTSPAudioDelete = $this->projectTSPAudioDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S P Audio Delete updated successfully.');
                return redirect(route('projectTSPAudioDeletes.index'));
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
            $projectTSPAudioDelete = $this->projectTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioDelete))
            {
                Flash::error('Project T S P Audio Delete not found');
                return redirect(route('projectTSPAudioDeletes.index'));
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
            
            if($user_id == $projectTSPAudioDelete -> user_id || $isShared)
            {
                $this->projectTSPAudioDeleteRepository->delete($id);
                
                Flash::success('Project T S P Audio Delete deleted successfully.');
                return redirect(route('projectTSPAudioDeletes.index'));
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