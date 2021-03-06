<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolUpdateRequest;
use App\Http\Requests\UpdateProjectTSToolUpdateRequest;
use App\Repositories\ProjectTSToolUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolUpdateController extends AppBaseController
{
    private $projectTSToolUpdateRepository;

    public function __construct(ProjectTSToolUpdateRepository $projectTSToolUpdateRepo)
    {
        $this->projectTSToolUpdateRepository = $projectTSToolUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolUpdates = $this->projectTSToolUpdateRepository->all();
    
            return view('project_t_s_tool_updates.index')
                ->with('projectTSToolUpdates', $projectTSToolUpdates);
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
            return view('project_t_s_tool_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSToolUpdate = $this->projectTSToolUpdateRepository->create($input);
                
                Flash::success('Project T S Tool Update saved successfully.');
                return redirect(route('projectTSToolUpdates.index'));
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
            $projectTSToolUpdate = $this->projectTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolUpdate))
            {
                Flash::error('Project T S Tool Update not found');
                return redirect(route('projectTSToolUpdates.index'));
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
            
            if($user_id == $projectTSToolUpdate -> user_id || $isShared)
            {
                return view('project_t_s_tool_updates.show')->with('projectTSToolUpdate', $projectTSToolUpdate);
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
            $projectTSToolUpdate = $this->projectTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolUpdate))
            {
                Flash::error('Project T S Tool Update not found');
                return redirect(route('projectTSToolUpdates.index'));
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
            
            if($user_id == $projectTSToolUpdate -> user_id || $isShared)
            {
                return view('project_t_s_tool_updates.edit')->with('projectTSToolUpdate', $projectTSToolUpdate);
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

    public function update($id, UpdateProjectTSToolUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolUpdate = $this->projectTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolUpdate))
            {
                Flash::error('Project T S Tool Update not found');
                return redirect(route('projectTSToolUpdates.index'));
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
            
            if($user_id == $projectTSToolUpdate -> user_id || $isShared)
            {
                $projectTSToolUpdate = $this->projectTSToolUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool Update updated successfully.');
                return redirect(route('projectTSToolUpdates.index'));
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
            $projectTSToolUpdate = $this->projectTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolUpdate))
            {
                Flash::error('Project T S Tool Update not found');
                return redirect(route('projectTSToolUpdates.index'));
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
            
            if($user_id == $projectTSToolUpdate -> user_id || $isShared)
            {
                $this->projectTSToolUpdateRepository->delete($id);
            
                Flash::success('Project T S Tool Update deleted successfully.');
                return redirect(route('projectTSToolUpdates.index'));
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