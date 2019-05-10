<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolFileCreateRequest;
use App\Http\Requests\UpdateProjectTSToolFileCreateRequest;
use App\Repositories\ProjectTSToolFileCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolFileCreateController extends AppBaseController
{
    private $projectTSToolFileCreateRepository;

    public function __construct(ProjectTSToolFileCreateRepository $projectTSToolFileCreateRepo)
    {
        $this->projectTSToolFileCreateRepository = $projectTSToolFileCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolFileCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolFileCreates = $this->projectTSToolFileCreateRepository->all();
    
            return view('project_t_s_tool_file_creates.index')
                ->with('projectTSToolFileCreates', $projectTSToolFileCreates);
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
            return view('project_t_s_tool_file_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSToolFileCreate = $this->projectTSToolFileCreateRepository->create($input);
                
                Flash::success('Project T S Tool File Create saved successfully.');
                return redirect(route('projectTSToolFileCreates.index'));
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
            $projectTSToolFileCreate = $this->projectTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileCreate))
            {
                Flash::error('Project T S Tool File Create not found');
                return redirect(route('projectTSToolFileCreates.index'));
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
            
            if($user_id == $projectTSToolFileCreate -> user_id || $isShared)
            {
                return view('project_t_s_tool_file_creates.show')->with('projectTSToolFileCreate', $projectTSToolFileCreate);
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
            $projectTSToolFileCreate = $this->projectTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileCreate))
            {
                Flash::error('Project T S Tool File Create not found');
                return redirect(route('projectTSToolFileCreates.index'));
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
            
            if($user_id == $projectTSToolFileCreate -> user_id || $isShared)
            {
                return view('project_t_s_tool_file_creates.edit')->with('projectTSToolFileCreate', $projectTSToolFileCreate);
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

    public function update($id, UpdateProjectTSToolFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolFileCreate = $this->projectTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileCreate))
            {
                Flash::error('Project T S Tool File Create not found');
                return redirect(route('projectTSToolFileCreates.index'));
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
            
            if($user_id == $projectTSToolFileCreate -> user_id || $isShared)
            {
                $projectTSToolFileCreate = $this->projectTSToolFileCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool File Create updated successfully.');
                return redirect(route('projectTSToolFileCreates.index'));
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
            $projectTSToolFileCreate = $this->projectTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileCreate))
            {
                Flash::error('Project T S Tool File Create not found');
                return redirect(route('projectTSToolFileCreates.index'));
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
            
            if($user_id == $projectTSToolFileCreate -> user_id || $isShared)
            {
                $this->projectTSToolFileCreateRepository->delete($id);
                
                Flash::success('Project T S Tool File Create deleted successfully.');
                return redirect(route('projectTSToolFileCreates.index'));
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