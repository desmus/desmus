<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\DeleteProjectTSFileDeleteRequest;
use App\Http\Requests\UpdateProjectTSFileDeleteRequest;
use App\Repositories\ProjectTSFileDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSFileDeleteController extends AppBaseController
{
    private $projectTSFileDeleteRepository;

    public function __construct(ProjectTSFileDeleteRepository $projectTSFileDeleteRepo)
    {
        $this->projectTSFileDeleteRepository = $projectTSFileDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSFileDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSFileDeletes = $this->projectTSFileDeleteRepository->all();
    
            return view('project_t_s_file_deletes.index')
                ->with('projectTSFileDeletes', $projectTSFileDeletes);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function delete()
    {
        if(Auth::user() != null)
        {
            return view('project_t_s_file_deletes.delete');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeleteProjectTSFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSFileDelete = $this->projectTSFileDeleteRepository->delete($input);
                
                Flash::success('Project T S File Delete saved successfully.');
                return redirect(route('projectTSFileDeletes.index'));
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
            $projectTSFileDelete = $this->projectTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSFileDelete))
            {
                Flash::error('Project T S File Delete not found');
                return redirect(route('projectTSFileDeletes.index'));
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
            
            if($user_id == $projectTSFileDelete -> user_id || $isShared)
            {
                return view('project_t_s_file_deletes.show')->with('projectTSFileDelete', $projectTSFileDelete);
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
            $projectTSFileDelete = $this->projectTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSFileDelete))
            {
                Flash::error('Project T S File Delete not found');
                return redirect(route('projectTSFileDeletes.index'));
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
            
            if($user_id == $projectTSFileDelete -> user_id || $isShared)
            {
                return view('project_t_s_file_deletes.edit')->with('projectTSFileDelete', $projectTSFileDelete);
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

    public function update($id, UpdateProjectTSFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSFileDelete = $this->projectTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSFileDelete))
            {
                Flash::error('Project T S File Delete not found');
                return redirect(route('projectTSFileDeletes.index'));
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
            
            if($user_id == $projectTSFileDelete -> user_id || $isShared)
            {
                $projectTSFileDelete = $this->projectTSFileDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S File Delete updated successfully.');
                return redirect(route('projectTSFileDeletes.index'));
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
            $projectTSFileDelete = $this->projectTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSFileDelete))
            {
                Flash::error('Project T S File Delete not found');
                return redirect(route('projectTSFileDeletes.index'));
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
            
            if($user_id == $projectTSFileDelete -> user_id || $isShared)
            {
                $this->projectTSFileDeleteRepository->delete($id);
                
                Flash::success('Project T S File Delete deleted successfully.');
                return redirect(route('projectTSFileDeletes.index'));
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