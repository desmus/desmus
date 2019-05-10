<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolFileViewRequest;
use App\Http\Requests\UpdateProjectTSToolFileViewRequest;
use App\Repositories\ProjectTSToolFileViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolFileViewController extends AppBaseController
{
    private $projectTSToolFileViewRepository;

    public function __construct(ProjectTSToolFileViewRepository $projectTSToolFileViewRepo)
    {
        $this->projectTSToolFileViewRepository = $projectTSToolFileViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolFileViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolFileViews = $this->projectTSToolFileViewRepository->all();
    
            return view('project_t_s_tool_file_views.index')
                ->with('projectTSToolFileViews', $projectTSToolFileViews);
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
            return view('project_t_s_tool_file_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSToolFileView = $this->projectTSToolFileViewRepository->create($input);
                
                Flash::success('Project T S Tool File View saved successfully.');
                return redirect(route('projectTSToolFileViews.index'));
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
            $projectTSToolFileView = $this->projectTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileView))
            {
                Flash::error('Project T S Tool File View not found');
                return redirect(route('projectTSToolFileViews.index'));
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
            
            if($user_id == $projectTSToolFileView -> user_id || $isShared)
            {
                return view('project_t_s_tool_file_views.show')->with('projectTSToolFileView', $projectTSToolFileView);
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
            $projectTSToolFileView = $this->projectTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileView))
            {
                Flash::error('Project T S Tool File View not found');
                return redirect(route('projectTSToolFileViews.index'));
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
            
            if($user_id == $projectTSToolFileView -> user_id || $isShared)
            {
                return view('project_t_s_tool_file_views.edit')->with('projectTSToolFileView', $projectTSToolFileView);
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

    public function update($id, UpdateProjectTSToolFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolFileView = $this->projectTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileView))
            {
                Flash::error('Project T S Tool File View not found');
                return redirect(route('projectTSToolFileViews.index'));
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
            
            if($user_id == $projectTSToolFileView -> user_id || $isShared)
            {
                $projectTSToolFileView = $this->projectTSToolFileViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool File View updated successfully.');
                return redirect(route('projectTSToolFileViews.index'));
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
            $projectTSToolFileView = $this->projectTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileView))
            {
                Flash::error('Project T S Tool File View not found');
                return redirect(route('projectTSToolFileViews.index'));
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
            
            if($user_id == $projectTSToolFileView -> user_id || $isShared)
            {
                $this->projectTSToolFileViewRepository->delete($id);
                
                Flash::success('Project T S Tool File View deleted successfully.');
                return redirect(route('projectTSToolFileViews.index'));
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