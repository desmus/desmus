<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSFileViewRequest;
use App\Http\Requests\UpdateProjectTSFileViewRequest;
use App\Repositories\ProjectTSFileViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSFileViewController extends AppBaseController
{
    private $projectTSFileViewRepository;

    public function __construct(ProjectTSFileViewRepository $projectTSFileViewRepo)
    {
        $this->projectTSFileViewRepository = $projectTSFileViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSFileViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSFileViews = $this->projectTSFileViewRepository->all();
    
            return view('project_t_s_file_views.index')
                ->with('projectTSFileViews', $projectTSFileViews);
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
            return view('project_t_s_file_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSFileView = $this->projectTSFileViewRepository->create($input);
                
                Flash::success('Project T S File View saved successfully.');
                return redirect(route('projectTSFileViews.index'));
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
            $projectTSFileView = $this->projectTSFileViewRepository->findWithoutFail($id);
    
            if(empty($projectTSFileView))
            {
                Flash::error('Project T S File View not found');
                return redirect(route('projectTSFileViews.index'));
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
            
            if($user_id == $projectTSFileView -> user_id || $isShared)
            {
                return view('project_t_s_file_views.show')->with('projectTSFileView', $projectTSFileView);
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
            $projectTSFileView = $this->projectTSFileViewRepository->findWithoutFail($id);
    
            if(empty($projectTSFileView))
            {
                Flash::error('Project T S File View not found');
                return redirect(route('projectTSFileViews.index'));
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
            
            if($user_id == $projectTSFileView -> user_id || $isShared)
            {
                return view('project_t_s_file_views.edit')->with('projectTSFileView', $projectTSFileView);
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

    public function update($id, UpdateProjectTSFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSFileView = $this->projectTSFileViewRepository->findWithoutFail($id);
    
            if(empty($projectTSFileView))
            {
                Flash::error('Project T S File View not found');
                return redirect(route('projectTSFileViews.index'));
            }
            
            if($user_id == $projectTSFileView -> user_id || $isShared)
            {
                $projectTSFileView = $this->projectTSFileViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S File View updated successfully.');
                return redirect(route('projectTSFileViews.index'));
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
            $projectTSFileView = $this->projectTSFileViewRepository->findWithoutFail($id);
    
            if(empty($projectTSFileView))
            {
                Flash::error('Project T S File View not found');
                return redirect(route('projectTSFileViews.index'));
            }
    
            if($user_id == $projectTSFileView -> user_id || $isShared)
            {
                $this->projectTSFileViewRepository->delete($id);
                
                Flash::success('Project T S File View deleted successfully.');
                return redirect(route('projectTSFileViews.index'));
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