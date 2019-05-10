<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryImageViewRequest;
use App\Http\Requests\UpdateProjectTSGaleryImageViewRequest;
use App\Repositories\ProjectTSGaleryImageViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryImageViewController extends AppBaseController
{
    private $projectTSGaleryImageViewRepository;

    public function __construct(ProjectTSGaleryImageViewRepository $projectTSGaleryImageViewRepo)
    {
        $this->projectTSGaleryImageViewRepository = $projectTSGaleryImageViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryImageViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryImageViews = $this->projectTSGaleryImageViewRepository->all();
    
            return view('project_t_s_galery_image_views.index')
                ->with('projectTSGaleryImageViews', $projectTSGaleryImageViews);
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
            return view('project_t_s_galery_image_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSGaleryImageView = $this->projectTSGaleryImageViewRepository->create($input);
                
                Flash::success('Project T S Galery Image View saved successfully.');
                return redirect(route('projectTSGaleryImageViews.index'));
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
            $projectTSGaleryImageView = $this->projectTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageView))
            {
                Flash::error('Project T S Galery Image View not found');
                return redirect(route('projectTSGaleryImageViews.index'));
            }
            
            $userProjectTSGaleryImages = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSGaleryImages as $userProjectTSGaleryImage)
            {
                if($userProjectTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_galery_images')->join('project_t_s_galeries', 'project_t_s_galery_images.project_t_s_g_id', '=', 'project_t_s_galeries.id')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $projectTSGaleryImageView -> user_id || $isShared)
            {
                return view('project_t_s_galery_image_views.show')->with('projectTSGaleryImageView', $projectTSGaleryImageView);
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
            $projectTSGaleryImageView = $this->projectTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageView))
            {
                Flash::error('Project T S Galery Image View not found');
                return redirect(route('projectTSGaleryImageViews.index'));
            }
    
            $userProjectTSGaleryImages = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSGaleryImages as $userProjectTSGaleryImage)
            {
                if($userProjectTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_galery_images')->join('project_t_s_galeries', 'project_t_s_galery_images.project_t_s_g_id', '=', 'project_t_s_galeries.id')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $projectTSGaleryImageView -> user_id || $isShared)
            {
                return view('project_t_s_galery_image_views.edit')->with('projectTSGaleryImageView', $projectTSGaleryImageView);
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

    public function update($id, UpdateProjectTSGaleryImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryImageView = $this->projectTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageView))
            {
                Flash::error('Project T S Galery Image View not found');
                return redirect(route('projectTSGaleryImageViews.index'));
            }
            
            $userProjectTSGaleryImages = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSGaleryImages as $userProjectTSGaleryImage)
            {
                if($userProjectTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_galery_images')->join('project_t_s_galeries', 'project_t_s_galery_images.project_t_s_g_id', '=', 'project_t_s_galeries.id')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $projectTSGaleryImageView -> user_id || $isShared)
            {
                $projectTSGaleryImageView = $this->projectTSGaleryImageViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery Image View updated successfully.');
                return redirect(route('projectTSGaleryImageViews.index'));
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
            $projectTSGaleryImageView = $this->projectTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageView))
            {
                Flash::error('Project T S Galery Image View not found');
                return redirect(route('projectTSGaleryImageViews.index'));
            }
    
            $userProjectTSGaleryImages = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSGaleryImages as $userProjectTSGaleryImage)
            {
                if($userProjectTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_galery_images')->join('project_t_s_galeries', 'project_t_s_galery_images.project_t_s_g_id', '=', 'project_t_s_galeries.id')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $projectTSGaleryImageView -> user_id || $isShared)
            {
                $this->projectTSGaleryImageViewRepository->delete($id);
                
                Flash::success('Project T S Galery Image View deleted successfully.');
                return redirect(route('projectTSGaleryImageViews.index'));
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