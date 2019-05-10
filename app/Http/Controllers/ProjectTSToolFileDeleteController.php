<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolFileDeleteRequest;
use App\Http\Requests\UpdateProjectTSToolFileDeleteRequest;
use App\Repositories\ProjectTSToolFileDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolFileDeleteController extends AppBaseController
{
    private $projectTSToolFileDeleteRepository;

    public function __construct(ProjectTSToolFileDeleteRepository $projectTSToolFileDeleteRepo)
    {
        $this->projectTSToolFileDeleteRepository = $projectTSToolFileDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolFileDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolFileDeletes = $this->projectTSToolFileDeleteRepository->all();
    
            return view('project_t_s_tool_file_deletes.index')
                ->with('projectTSToolFileDeletes', $projectTSToolFileDeletes);
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
            return view('project_t_s_tool_file_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSToolFileDelete = $this->projectTSToolFileDeleteRepository->create($input);
                
                Flash::success('Project T S Tool File Delete saved successfully.');
                return redirect(route('projectTSToolFileDeletes.index'));
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
            $projectTSToolFileDelete = $this->projectTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileDelete))
            {
                Flash::error('Project T S Tool File Delete not found');
                return redirect(route('projectTSToolFileDeletes.index'));
            }
            
            $userProjectTSToolFiles = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSToolFiles as $userProjectTSToolFile)
            {
                if($userProjectTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_tool_files')->join('project_t_s_tools', 'project_t_s_tool_files.project_t_s_t_id', '=', 'project_t_s_tools.id')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $projectTSToolFileDelete -> user_id || $isShared)
            {
                return view('project_t_s_tool_file_deletes.show')->with('projectTSToolFileDelete', $projectTSToolFileDelete);
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
            $projectTSToolFileDelete = $this->projectTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileDelete))
            {
                Flash::error('Project T S Tool File Delete not found');
                return redirect(route('projectTSToolFileDeletes.index'));
            }
            
            $userProjectTSToolFiles = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSToolFiles as $userProjectTSToolFile)
            {
                if($userProjectTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_tool_files')->join('project_t_s_tools', 'project_t_s_tool_files.project_t_s_t_id', '=', 'project_t_s_tools.id')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $projectTSToolFileDelete -> user_id || $isShared)
            {
                return view('project_t_s_tool_file_deletes.edit')->with('projectTSToolFileDelete', $projectTSToolFileDelete);
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

    public function update($id, UpdateProjectTSToolFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolFileDelete = $this->projectTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileDelete))
            {
                Flash::error('Project T S Tool File Delete not found');
                return redirect(route('projectTSToolFileDeletes.index'));
            }
            
            $userProjectTSToolFiles = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSToolFiles as $userProjectTSToolFile)
            {
                if($userProjectTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_tool_files')->join('project_t_s_tools', 'project_t_s_tool_files.project_t_s_t_id', '=', 'project_t_s_tools.id')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $projectTSToolFileDelete -> user_id || $isShared)
            {
                $projectTSToolFileDelete = $this->projectTSToolFileDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool File Delete updated successfully.');
                return redirect(route('projectTSToolFileDeletes.index'));
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
            $projectTSToolFileDelete = $this->projectTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileDelete))
            {
                Flash::error('Project T S Tool File Delete not found');
                return redirect(route('projectTSToolFileDeletes.index'));
            }
            
            $userProjectTSToolFiles = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSToolFiles as $userProjectTSToolFile)
            {
                if($userProjectTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_tool_files')->join('project_t_s_tools', 'project_t_s_tool_files.project_t_s_t_id', '=', 'project_t_s_tools.id')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $projectTSToolFileDelete -> user_id || $isShared)
            {
                $this->projectTSToolFileDeleteRepository->delete($id);
                
                Flash::success('Project T S Tool File Delete deleted successfully.');
                return redirect(route('projectTSToolFileDeletes.index'));
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