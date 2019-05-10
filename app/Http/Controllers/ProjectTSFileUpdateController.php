<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSFileUpdateRequest;
use App\Http\Requests\UpdateProjectTSFileUpdateRequest;
use App\Repositories\ProjectTSFileUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSFileUpdateController extends AppBaseController
{
    private $projectTSFileUpdateRepository;

    public function __construct(ProjectTSFileUpdateRepository $projectTSFileUpdateRepo)
    {
        $this->projectTSFileUpdateRepository = $projectTSFileUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSFileUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSFileUpdates = $this->projectTSFileUpdateRepository->all();
    
            return view('project_t_s_file_updates.index')
                ->with('projectTSFileUpdates', $projectTSFileUpdates);
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
            return view('project_t_s_file_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSFileUpdate = $this->projectTSFileUpdateRepository->create($input);
                
                Flash::success('Project T S File Update saved successfully.');
                return redirect(route('projectTSFileUpdates.index'));
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
            $projectTSFileUpdate = $this->projectTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileUpdate))
            {
                Flash::error('Project T S File Update not found');
                return redirect(route('projectTSFileUpdates.index'));
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
            
            if($user_id == $projectTSFileUpdate -> user_id || $isShared)
            {
                return view('project_t_s_file_updates.show')->with('projectTSFileUpdate', $projectTSFileUpdate);
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
            $projectTSFileUpdate = $this->projectTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileUpdate))
            {
                Flash::error('Project T S File Update not found');
                return redirect(route('projectTSFileUpdates.index'));
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
            
            if($user_id == $projectTSFileUpdate -> user_id || $isShared)
            {
                return view('project_t_s_file_updates.edit')->with('projectTSFileUpdate', $projectTSFileUpdate);
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

    public function update($id, UpdateProjectTSFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSFileUpdate = $this->projectTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileUpdate))
            {
                Flash::error('Project T S File Update not found');
                return redirect(route('projectTSFileUpdates.index'));
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
            
            if($user_id == $projectTSFileUpdate -> user_id || $isShared)
            {
                $projectTSFileUpdate = $this->projectTSFileUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S File Update updated successfully.');
                return redirect(route('projectTSFileUpdates.index'));
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
            $projectTSFileUpdate = $this->projectTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileUpdate))
            {
                Flash::error('Project T S File Update not found');
                return redirect(route('projectTSFileUpdates.index'));
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
            
            if($user_id == $projectTSFileUpdate -> user_id || $isShared)
            {
                $this->projectTSFileUpdateRepository->delete($id);
                
                Flash::success('Project T S File Update deleted successfully.');
                return redirect(route('projectTSFileUpdates.index'));
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