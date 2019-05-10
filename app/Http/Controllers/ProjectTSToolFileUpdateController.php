<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolFileUpdateRequest;
use App\Http\Requests\UpdateProjectTSToolFileUpdateRequest;
use App\Repositories\ProjectTSToolFileUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolFileUpdateController extends AppBaseController
{
    private $projectTSToolFileUpdateRepository;

    public function __construct(ProjectTSToolFileUpdateRepository $projectTSToolFileUpdateRepo)
    {
        $this->projectTSToolFileUpdateRepository = $projectTSToolFileUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolFileUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolFileUpdates = $this->projectTSToolFileUpdateRepository->all();
    
            return view('project_t_s_tool_file_updates.index')
                ->with('projectTSToolFileUpdates', $projectTSToolFileUpdates);
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
            return view('project_t_s_tool_file_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSToolFileUpdate = $this->projectTSToolFileUpdateRepository->create($input);
                
                Flash::success('Project T S Tool File Update saved successfully.');
                return redirect(route('projectTSToolFileUpdates.index'));
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
            $projectTSToolFileUpdate = $this->projectTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileUpdate))
            {
                Flash::error('Project T S Tool File Update not found');
                return redirect(route('projectTSToolFileUpdates.index'));
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
            
            if($user_id == $projectTSToolFileUpdate -> user_id || $isShared)
            {
                return view('project_t_s_tool_file_updates.show')->with('projectTSToolFileUpdate', $projectTSToolFileUpdate);
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
            $projectTSToolFileUpdate = $this->projectTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileUpdate))
            {
                Flash::error('Project T S Tool File Update not found');
                return redirect(route('projectTSToolFileUpdates.index'));
            }
    
            if($user_id == $projectTSToolFileUpdate -> user_id || $isShared)
            {
                return view('project_t_s_tool_file_updates.edit')->with('projectTSToolFileUpdate', $projectTSToolFileUpdate);
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

    public function update($id, UpdateProjectTSToolFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolFileUpdate = $this->projectTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileUpdate))
            {
                Flash::error('Project T S Tool File Update not found');
                return redirect(route('projectTSToolFileUpdates.index'));
            }
    
            if($user_id == $projectTSToolFileUpdate -> user_id || $isShared)
            {
                $projectTSToolFileUpdate = $this->projectTSToolFileUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool File Update updated successfully.');
                return redirect(route('projectTSToolFileUpdates.index'));
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
            $projectTSToolFileUpdate = $this->projectTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileUpdate))
            {
                Flash::error('Project T S Tool File Update not found');
                return redirect(route('projectTSToolFileUpdates.index'));
            }
    
            if($user_id == $projectTSToolFileUpdate -> user_id || $isShared)
            {
                $this->projectTSToolFileUpdateRepository->delete($id);
                
                Flash::success('Project T S Tool File Update deleted successfully.');
                return redirect(route('projectTSToolFileUpdates.index'));
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