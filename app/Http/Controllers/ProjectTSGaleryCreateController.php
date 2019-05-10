<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryCreateRequest;
use App\Http\Requests\UpdateProjectTSGaleryCreateRequest;
use App\Repositories\ProjectTSGaleryCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryCreateController extends AppBaseController
{
    private $projectTSGaleryCreateRepository;

    public function __construct(ProjectTSGaleryCreateRepository $projectTSGaleryCreateRepo)
    {
        $this->projectTSGaleryCreateRepository = $projectTSGaleryCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryCreates = $this->projectTSGaleryCreateRepository->all();
    
            return view('project_t_s_galery_creates.index')
                ->with('projectTSGaleryCreates', $projectTSGaleryCreates);
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
            return view('project_t_s_galery_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSGaleryCreate = $this->projectTSGaleryCreateRepository->create($input);
                
                Flash::success('Project T S Galery Create saved successfully.');
                return redirect(route('projectTSGaleryCreates.index'));
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
            $projectTSGaleryCreate = $this->projectTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryCreate))
            {
                Flash::error('Project T S Galery Create not found');
                return redirect(route('projectTSGaleryCreates.index'));
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
            
            if($user_id == $projectTSGaleryCreate -> user_id || $isShared)
            {
                return view('project_t_s_galery_creates.show')
                    ->with('projectTSGaleryCreate', $projectTSGaleryCreate);
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
            $projectTSGaleryCreate = $this->projectTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryCreate))
            {
                Flash::error('Project T S Galery Create not found');
                return redirect(route('projectTSGaleryCreates.index'));
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
            
            if($user_id == $projectTSGaleryCreate -> user_id || $isShared)
            {
                return view('project_t_s_galery_creates.edit')
                    ->with('projectTSGaleryCreate', $projectTSGaleryCreate);
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

    public function update($id, UpdateProjectTSGaleryCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryCreate = $this->projectTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryCreate))
            {
                Flash::error('Project T S Galery Create not found');
                return redirect(route('projectTSGaleryCreates.index'));
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
            
            if($user_id == $projectTSGaleryCreate -> user_id || $isShared)
            {
                $projectTSGaleryCreate = $this->projectTSGaleryCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery Create updated successfully.');
                return redirect(route('projectTSGaleryCreates.index'));
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
            $projectTSGaleryCreate = $this->projectTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryCreate))
            {
                Flash::error('Project T S Galery Create not found');
                return redirect(route('projectTSGaleryCreates.index'));
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
            
            if($user_id == $projectTSGaleryCreate -> user_id || $isShared)
            {
                $this->projectTSGaleryCreateRepository->delete($id);
                
                Flash::success('Project T S Galery Create deleted successfully.');
                return redirect(route('projectTSGaleryCreates.index'));
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