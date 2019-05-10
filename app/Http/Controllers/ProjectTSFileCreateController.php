<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSFileCreateRequest;
use App\Http\Requests\UpdateProjectTSFileCreateRequest;
use App\Repositories\ProjectTSFileCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSFileCreateController extends AppBaseController
{
    private $projectTSFileCreateRepository;

    public function __construct(ProjectTSFileCreateRepository $projectTSFileCreateRepo)
    {
        $this->projectTSFileCreateRepository = $projectTSFileCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSFileCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSFileCreates = $this->projectTSFileCreateRepository->all();
    
            return view('project_t_s_file_creates.index')
                ->with('projectTSFileCreates', $projectTSFileCreates);
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
            return view('project_t_s_file_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSFileCreate = $this->projectTSFileCreateRepository->create($input);
                
                Flash::success('Project T S File Create saved successfully.');
                return redirect(route('projectTSFileCreates.index'));
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
            $projectTSFileCreate = $this->projectTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileCreate))
            {
                Flash::error('Project T S File Create not found');
                return redirect(route('projectTSFileCreates.index'));
            }
    
            $userProjectTSFiles = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSFiles as $userProjectTSFile)
            {
                if($userProjectTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_files')->join('project_topic_sections', 'project_t_s_files.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_files.id', '=', $id)->get();
            
            if($user_id == $projectTSFileCreate -> user_id || $isShared)
            {
                return view('project_t_s_file_creates.show')->with('projectTSFileCreate', $projectTSFileCreate);
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
            $projectTSFileCreate = $this->projectTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileCreate))
            {
                Flash::error('Project T S File Create not found');
                return redirect(route('projectTSFileCreates.index'));
            }
            
            $userProjectTSFiles = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSFiles as $userProjectTSFile)
            {
                if($userProjectTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_files')->join('project_topic_sections', 'project_t_s_files.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_files.id', '=', $id)->get();
            
            if($user_id == $projectTSFileCreate -> user_id || $isShared)
            {
                return view('project_t_s_file_creates.edit')->with('projectTSFileCreate', $projectTSFileCreate);
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

    public function update($id, UpdateProjectTSFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSFileCreate = $this->projectTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileCreate))
            {
                Flash::error('Project T S File Create not found');
                return redirect(route('projectTSFileCreates.index'));
            }
    
            $userProjectTSFiles = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSFiles as $userProjectTSFile)
            {
                if($userProjectTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_files')->join('project_topic_sections', 'project_t_s_files.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_files.id', '=', $id)->get();
            
            if($user_id == $projectTSFileCreate -> user_id || $isShared)
            {
                $projectTSFileCreate = $this->projectTSFileCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S File Create updated successfully.');
                return redirect(route('projectTSFileCreates.index'));
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
            $projectTSFileCreate = $this->projectTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileCreate))
            {
                Flash::error('Project T S File Create not found');
                return redirect(route('projectTSFileCreates.index'));
            }
            
            $userProjectTSFiles = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSFiles as $userProjectTSFile)
            {
                if($userProjectTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_files')->join('project_topic_sections', 'project_t_s_files.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_files.id', '=', $id)->get();
            
            if($user_id == $projectTSFileCreate -> user_id || $isShared)
            {
                $this->projectTSFileCreateRepository->delete($id);
                
                Flash::success('Project T S File Create deleted successfully.');
                return redirect(route('projectTSFileCreates.index'));
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