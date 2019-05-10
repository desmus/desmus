<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPAudioViewRequest;
use App\Http\Requests\UpdateProjectTSPAudioViewRequest;
use App\Repositories\ProjectTSPAudioViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPAudioViewController extends AppBaseController
{
    private $projectTSPAudioViewRepository;

    public function __construct(ProjectTSPAudioViewRepository $projectTSPAudioViewRepo)
    {
        $this->projectTSPAudioViewRepository = $projectTSPAudioViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPAudioViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPAudioViews = $this->projectTSPAudioViewRepository->all();
    
            return view('project_t_s_p_audio_views.index')
                ->with('projectTSPAudioViews', $projectTSPAudioViews);
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
            return view('project_t_s_p_audio_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSPAudioView = $this->projectTSPAudioViewRepository->create($input);
                
                Flash::success('Project T S P Audio View saved successfully.');
                return redirect(route('projectTSPAudioViews.index'));
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
            $projectTSPAudioView = $this->projectTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioView))
            {
                Flash::error('Project T S P Audio View not found');
                return redirect(route('projectTSPAudioViews.index'));
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
            
            if($user_id == $projectTSPAudioView -> user_id || $isShared)
            {
                return view('project_t_s_p_audio_views.show')->with('projectTSPAudioView', $projectTSPAudioView);
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
            $projectTSPAudioView = $this->projectTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioView))
            {
                Flash::error('Project T S P Audio View not found');
                return redirect(route('projectTSPAudioViews.index'));
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
            
            if($user_id == $projectTSPAudioView -> user_id || $isShared)
            {
                return view('project_t_s_p_audio_views.edit')->with('projectTSPAudioView', $projectTSPAudioView);
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

    public function update($id, UpdateProjectTSPAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPAudioView = $this->projectTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioView))
            {
                Flash::error('Project T S P Audio View not found');
                return redirect(route('projectTSPAudioViews.index'));
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
            
            if($user_id == $projectTSPAudioView -> user_id || $isShared)
            {
                $projectTSPAudioView = $this->projectTSPAudioViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S P Audio View updated successfully.');
                return redirect(route('projectTSPAudioViews.index'));
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
            $projectTSPAudioView = $this->projectTSPAudioViewRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudioView))
            {
                Flash::error('Project T S P Audio View not found');
                return redirect(route('projectTSPAudioViews.index'));
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
            
            if($user_id == $projectTSPAudioView -> user_id || $isShared)
            {
                $this->projectTSPAudioViewRepository->delete($id);
                
                Flash::success('Project T S P Audio View deleted successfully.');
                return redirect(route('projectTSPAudioViews.index'));
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