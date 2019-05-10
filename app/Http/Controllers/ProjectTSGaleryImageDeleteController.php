<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryImageDeleteRequest;
use App\Http\Requests\UpdateProjectTSGaleryImageDeleteRequest;
use App\Repositories\ProjectTSGaleryImageDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryImageDeleteController extends AppBaseController
{
    private $projectTSGaleryImageDeleteRepository;

    public function __construct(ProjectTSGaleryImageDeleteRepository $projectTSGaleryImageDeleteRepo)
    {
        $this->projectTSGaleryImageDeleteRepository = $projectTSGaleryImageDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryImageDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryImageDeletes = $this->projectTSGaleryImageDeleteRepository->all();
    
            return view('project_t_s_galery_image_deletes.index')
                ->with('projectTSGaleryImageDeletes', $projectTSGaleryImageDeletes);
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
            return view('project_t_s_galery_image_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryImageDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSGaleryImageDelete = $this->projectTSGaleryImageDeleteRepository->create($input);
                
                Flash::success('Project T S Galery Image Delete saved successfully.');
                return redirect(route('projectTSGaleryImageDeletes.index'));
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
            $projectTSGaleryImageDelete = $this->projectTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageDelete))
            {
                Flash::error('Project T S Galery Image Delete not found');
                return redirect(route('projectTSGaleryImageDeletes.index'));
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
            
            if($user_id == $projectTSGaleryImageDelete -> user_id || $isShared)
            {
                return view('project_t_s_galery_image_deletes.show')->with('projectTSGaleryImageDelete', $projectTSGaleryImageDelete);
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
            $projectTSGaleryImageDelete = $this->projectTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageDelete))
            {
                Flash::error('Project T S Galery Image Delete not found');
                return redirect(route('projectTSGaleryImageDeletes.index'));
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
            
            if($user_id == $projectTSGaleryImageDelete -> user_id || $isShared)
            {
                return view('project_t_s_galery_image_deletes.edit')->with('projectTSGaleryImageDelete', $projectTSGaleryImageDelete);
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

    public function update($id, UpdateProjectTSGaleryImageDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryImageDelete = $this->projectTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageDelete))
            {
                Flash::error('Project T S Galery Image Delete not found');
                return redirect(route('projectTSGaleryImageDeletes.index'));
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
            
            if($user_id == $projectTSGaleryImageDelete -> user_id || $isShared)
            {
                $projectTSGaleryImageDelete = $this->projectTSGaleryImageDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery Image Delete updated successfully.');
                return redirect(route('projectTSGaleryImageDeletes.index'));
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
            $projectTSGaleryImageDelete = $this->projectTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageDelete))
            {
                Flash::error('Project T S Galery Image Delete not found');
                return redirect(route('projectTSGaleryImageDeletes.index'));
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
            
            if($user_id == $projectTSGaleryImageDelete -> user_id || $isShared)
            {
                $this->projectTSGaleryImageDeleteRepository->delete($id);
                
                Flash::success('Project T S Galery Image Delete deleted successfully.');
                return redirect(route('projectTSGaleryImageDeletes.index'));
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