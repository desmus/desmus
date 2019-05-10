<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryDeleteRequest;
use App\Http\Requests\UpdateProjectTSGaleryDeleteRequest;
use App\Repositories\ProjectTSGaleryDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryDeleteController extends AppBaseController
{
    private $projectTSGaleryDeleteRepository;

    public function __construct(ProjectTSGaleryDeleteRepository $projectTSGaleryDeleteRepo)
    {
        $this->projectTSGaleryDeleteRepository = $projectTSGaleryDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryDeletes = $this->projectTSGaleryDeleteRepository->all();
    
            return view('project_t_s_galery_deletes.index')
                ->with('projectTSGaleryDeletes', $projectTSGaleryDeletes);
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
            return view('project_t_s_galery_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSGaleryDelete = $this->projectTSGaleryDeleteRepository->create($input);
                
                Flash::success('Project T S Galery Delete saved successfully.');
                return redirect(route('projectTSGaleryDeletes.index'));
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
            $projectTSGaleryDelete = $this->projectTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryDelete))
            {
                Flash::error('Project T S Galery Delete not found');
                return redirect(route('projectTSGaleryDeletes.index'));
            }
            
            $userProjectTSGaleries = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSGaleries as $userProjectTSGalerie)
            {
                if($userProjectTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_galeries')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $projectTSGaleryDelete -> user_id || $isShared)
            {
                return view('project_t_s_galery_deletes.show')->with('projectTSGaleryDelete', $projectTSGaleryDelete);
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
            $projectTSGaleryDelete = $this->projectTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryDelete))
            {
                Flash::error('Project T S Galery Delete not found');
                return redirect(route('projectTSGaleryDeletes.index'));
            }
            
            $userProjectTSGaleries = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSGaleries as $userProjectTSGalerie)
            {
                if($userProjectTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_galeries')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $projectTSGaleryDelete -> user_id || $isShared)
            {
                return view('project_t_s_galery_deletes.edit')->with('projectTSGaleryDelete', $projectTSGaleryDelete);
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

    public function update($id, UpdateProjectTSGaleryDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryDelete = $this->projectTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryDelete))
            {
                Flash::error('Project T S Galery Delete not found');
                return redirect(route('projectTSGaleryDeletes.index'));
            }
            
            $userProjectTSGaleries = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSGaleries as $userProjectTSGalerie)
            {
                if($userProjectTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_galeries')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $projectTSGaleryDelete -> user_id || $isShared)
            {
                $projectTSGaleryDelete = $this->projectTSGaleryDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery Delete updated successfully.');
                return redirect(route('projectTSGaleryDeletes.index'));
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
            $projectTSGaleryDelete = $this->projectTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryDelete)) 
            {
                Flash::error('Project T S Galery Delete not found');
                return redirect(route('projectTSGaleryDeletes.index'));
            }
            
            $userProjectTSGaleries = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSGaleries as $userProjectTSGalerie)
            {
                if($userProjectTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_galeries')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $projectTSGaleryDelete -> user_id || $isShared)
            {
                $this->projectTSGaleryDeleteRepository->delete($id);
                
                Flash::success('Project T S Galery Delete deleted successfully.');
                return redirect(route('projectTSGaleryDeletes.index'));
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