<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolViewRequest;
use App\Http\Requests\UpdateProjectTSToolViewRequest;
use App\Repositories\ProjectTSToolViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolViewController extends AppBaseController
{
    private $projectTSToolViewRepository;

    public function __construct(ProjectTSToolViewRepository $projectTSToolViewRepo)
    {
        $this->projectTSToolViewRepository = $projectTSToolViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolViews = $this->projectTSToolViewRepository->all();
    
            return view('project_t_s_tool_views.index')
                ->with('projectTSToolViews', $projectTSToolViews);
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
            return view('project_t_s_tool_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSToolView = $this->projectTSToolViewRepository->create($input);
                
                Flash::success('Project T S Tool View saved successfully.');
                return redirect(route('projectTSToolViews.index'));
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
            $projectTSToolView = $this->projectTSToolViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolView))
            {
                Flash::error('Project T S Tool View not found');
                return redirect(route('projectTSToolViews.index'));
            }
            
            $userProjectTSTools = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSTools as $userProjectTSTool)
            {
                if($userProjectTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_tools')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $projectTSToolView -> user_id || $isShared)
            {
                return view('project_t_s_tool_views.show')->with('projectTSToolView', $projectTSToolView);
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
            $projectTSToolView = $this->projectTSToolViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolView))
            {
                Flash::error('Project T S Tool View not found');
                return redirect(route('projectTSToolViews.index'));
            }
    
            $userProjectTSTools = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSTools as $userProjectTSTool)
            {
                if($userProjectTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_tools')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $projectTSToolView -> user_id || $isShared)
            {
                return view('project_t_s_tool_views.edit')->with('projectTSToolView', $projectTSToolView);
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

    public function update($id, UpdateProjectTSToolViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolView = $this->projectTSToolViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolView))
            {
                Flash::error('Project T S Tool View not found');
                return redirect(route('projectTSToolViews.index'));
            }
            
            $userProjectTSTools = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSTools as $userProjectTSTool)
            {
                if($userProjectTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_tools')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $projectTSToolView -> user_id || $isShared)
            {
                $projectTSToolView = $this->projectTSToolViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool View updated successfully.');
                return redirect(route('projectTSToolViews.index'));
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
            $projectTSToolView = $this->projectTSToolViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolView))
            {
                Flash::error('Project T S Tool View not found');
                return redirect(route('projectTSToolViews.index'));
            }
            
            $userProjectTSTools = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSTools as $userProjectTSTool)
            {
                if($userProjectTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_tools')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $projectTSToolView -> user_id || $isShared)
            {
                $this->projectTSToolViewRepository->delete($id);
                
                Flash::success('Project T S Tool View deleted successfully.');
                return redirect(route('projectTSToolViews.index'));
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