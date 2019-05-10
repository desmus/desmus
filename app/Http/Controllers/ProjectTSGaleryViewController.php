<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryViewRequest;
use App\Http\Requests\UpdateProjectTSGaleryViewRequest;
use App\Repositories\ProjectTSGaleryViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryViewController extends AppBaseController
{
    private $projectTSGaleryViewRepository;

    public function __construct(ProjectTSGaleryViewRepository $projectTSGaleryViewRepo)
    {
        $this->projectTSGaleryViewRepository = $projectTSGaleryViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryViews = $this->projectTSGaleryViewRepository->all();
    
            return view('project_t_s_galery_views.index')
                ->with('projectTSGaleryViews', $projectTSGaleryViews);
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
            return view('project_t_s_galery_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSGaleryView = $this->projectTSGaleryViewRepository->create($input);
                
                Flash::success('Project T S Galery View saved successfully.');
                return redirect(route('projectTSGaleryViews.index'));
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
            $projectTSGaleryView = $this->projectTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryView))
            {
                Flash::error('Project T S Galery View not found');
                return redirect(route('projectTSGaleryViews.index'));
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
            
            if($user_id == $projectTSGaleryView -> user_id || $isShared)
            {
                return view('project_t_s_galery_views.show')->with('projectTSGaleryView', $projectTSGaleryView);
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
            $projectTSGaleryView = $this->projectTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryView))
            {
                Flash::error('Project T S Galery View not found');
                return redirect(route('projectTSGaleryViews.index'));
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
            
            if($user_id == $projectTSGaleryView -> user_id || $isShared)
            {
                return view('project_t_s_galery_views.edit')->with('projectTSGaleryView', $projectTSGaleryView);
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

    public function update($id, UpdateProjectTSGaleryViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryView = $this->projectTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryView))
            {
                Flash::error('Project T S Galery View not found');
                return redirect(route('projectTSGaleryViews.index'));
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
            
            if($user_id == $projectTSGaleryView -> user_id || $isShared)
            {
                $projectTSGaleryView = $this->projectTSGaleryViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery View updated successfully.');
                return redirect(route('projectTSGaleryViews.index'));
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
            $projectTSGaleryView = $this->projectTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryView))
            {
                Flash::error('Project T S Galery View not found');
                return redirect(route('projectTSGaleryViews.index'));
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
            
            if($user_id == $projectTSGaleryView -> user_id || $isShared)
            {
                $this->projectTSGaleryViewRepository->delete($id);
                
                Flash::success('Project T S Galery View deleted successfully.');
                return redirect(route('projectTSGaleryViews.index'));
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