<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolDeleteRequest;
use App\Http\Requests\UpdateProjectTSToolDeleteRequest;
use App\Repositories\ProjectTSToolDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolDeleteController extends AppBaseController
{
    private $projectTSToolDeleteRepository;

    public function __construct(ProjectTSToolDeleteRepository $projectTSToolDeleteRepo)
    {
        $this->projectTSToolDeleteRepository = $projectTSToolDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolDeletes = $this->projectTSToolDeleteRepository->all();
    
            return view('project_t_s_tool_deletes.index')
                ->with('projectTSToolDeletes', $projectTSToolDeletes);
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
            return view('project_t_s_tool_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSToolDelete = $this->projectTSToolDeleteRepository->create($input);
                
                Flash::success('Project T S Tool Delete saved successfully.');
                return redirect(route('projectTSToolDeletes.index'));
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
            $projectTSToolDelete = $this->projectTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolDelete))
            {
                Flash::error('Project T S Tool Delete not found');
                return redirect(route('projectTSToolDeletes.index'));
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
            
            if($user_id == $projectTSToolDelete -> user_id || $isShared)
            {
                return view('project_t_s_tool_deletes.show')->with('projectTSToolDelete', $projectTSToolDelete);
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
            $projectTSToolDelete = $this->projectTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolDelete))
            {
                Flash::error('Project T S Tool Delete not found');
                return redirect(route('projectTSToolDeletes.index'));
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
            
            if($user_id == $projectTSToolDelete -> user_id || $isShared)
            {
                return view('project_t_s_tool_deletes.edit')->with('projectTSToolDelete', $projectTSToolDelete);
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

    public function update($id, UpdateProjectTSToolDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolDelete = $this->projectTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolDelete))
            {
                Flash::error('Project T S Tool Delete not found');
                return redirect(route('projectTSToolDeletes.index'));
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
            
            if($user_id == $projectTSToolDelete -> user_id || $isShared)
            {
                $projectTSToolDelete = $this->projectTSToolDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool Delete updated successfully.');
                return redirect(route('projectTSToolDeletes.index'));
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
            $projectTSToolDelete = $this->projectTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolDelete))
            {
                Flash::error('Project T S Tool Delete not found');
                return redirect(route('projectTSToolDeletes.index'));
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
            
            if($user_id == $projectTSToolDelete -> user_id || $isShared)
            {
                $this->projectTSToolDeleteRepository->delete($id);
                
                Flash::success('Project T S Tool Delete deleted successfully.');
                return redirect(route('projectTSToolDeletes.index'));
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