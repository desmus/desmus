<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolCreateRequest;
use App\Http\Requests\UpdateProjectTSToolCreateRequest;
use App\Repositories\ProjectTSToolCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolCreateController extends AppBaseController
{
    private $projectTSToolCreateRepository;

    public function __construct(ProjectTSToolCreateRepository $projectTSToolCreateRepo)
    {
        $this->projectTSToolCreateRepository = $projectTSToolCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolCreates = $this->projectTSToolCreateRepository->all();
    
            return view('project_t_s_tool_creates.index')
                ->with('projectTSToolCreates', $projectTSToolCreates);
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
            return view('project_t_s_tool_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSToolCreate = $this->projectTSToolCreateRepository->create($input);
                
                Flash::success('Project T S Tool Create saved successfully.');
                return redirect(route('projectTSToolCreates.index'));
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
            $projectTSToolCreate = $this->projectTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolCreate))
            {
                Flash::error('Project T S Tool Create not found');
                return redirect(route('projectTSToolCreates.index'));
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
            
            if($user_id == $projectTSToolCreate -> user_id || $isShared)
            {
                return view('project_t_s_tool_creates.show')->with('projectTSToolCreate', $projectTSToolCreate);
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
            $projectTSToolCreate = $this->projectTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolCreate))
            {
                Flash::error('Project T S Tool Create not found');
                return redirect(route('projectTSToolCreates.index'));
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
            
            if($user_id == $projectTSToolCreate -> user_id || $isShared)
            {
                return view('project_t_s_tool_creates.edit')->with('projectTSToolCreate', $projectTSToolCreate);
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

    public function update($id, UpdateProjectTSToolCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolCreate = $this->projectTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolCreate))
            {
                Flash::error('Project T S Tool Create not found');
                return redirect(route('projectTSToolCreates.index'));
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
            
            if($user_id == $projectTSToolCreate -> user_id || $isShared)
            {
                $projectTSToolCreate = $this->projectTSToolCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool Create updated successfully.');
                return redirect(route('projectTSToolCreates.index'));
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
            $projectTSToolCreate = $this->projectTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolCreate))
            {
                Flash::error('Project T S Tool Create not found');
                return redirect(route('projectTSToolCreates.index'));
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
            
            if($user_id == $projectTSToolCreate -> user_id || $isShared)
            {
                $this->projectTSToolCreateRepository->delete($id);
                
                Flash::success('Project T S Tool Create deleted successfully.');
                return redirect(route('projectTSToolCreates.index'));
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