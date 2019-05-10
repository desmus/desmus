<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryImageCreateRequest;
use App\Http\Requests\UpdateProjectTSGaleryImageCreateRequest;
use App\Repositories\ProjectTSGaleryImageCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryImageCreateController extends AppBaseController
{
    private $projectTSGaleryImageCreateRepository;

    public function __construct(ProjectTSGaleryImageCreateRepository $projectTSGaleryImageCreateRepo)
    {
        $this->projectTSGaleryImageCreateRepository = $projectTSGaleryImageCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryImageCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryImageCreates = $this->projectTSGaleryImageCreateRepository->all();
    
            return view('project_t_s_galery_image_creates.index')
                ->with('projectTSGaleryImageCreates', $projectTSGaleryImageCreates);
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
            return view('project_t_s_galery_image_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryImageCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSGaleryImageCreate = $this->projectTSGaleryImageCreateRepository->create($input);
                
                Flash::success('Project T S Galery Image Create saved successfully.');
                return redirect(route('projectTSGaleryImageCreates.index'));
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
            $projectTSGaleryImageCreate = $this->projectTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageCreate))
            {
                Flash::error('Project T S Galery Image Create not found');
                return redirect(route('projectTSGaleryImageCreates.index'));
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
            
            if($user_id == $projectTSGaleryImageCreate -> user_id || $isShared)
            {
                return view('project_t_s_galery_image_creates.show')->with('projectTSGaleryImageCreate', $projectTSGaleryImageCreate);
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
            $projectTSGaleryImageCreate = $this->projectTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageCreate))
            {
                Flash::error('Project T S Galery Image Create not found');
                return redirect(route('projectTSGaleryImageCreates.index'));
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
            
            if($user_id == $projectTSGaleryImageCreate -> user_id || $isShared)
            {
                return view('project_t_s_galery_image_creates.edit')->with('projectTSGaleryImageCreate', $projectTSGaleryImageCreate);
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

    public function update($id, UpdateProjectTSGaleryImageCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryImageCreate = $this->projectTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageCreate))
            {
                Flash::error('Project T S Galery Image Create not found');
                return redirect(route('projectTSGaleryImageCreates.index'));
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
            
            if($user_id == $projectTSGaleryImageCreate -> user_id || $isShared)
            {
                $projectTSGaleryImageCreate = $this->projectTSGaleryImageCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery Image Create updated successfully.');
                return redirect(route('projectTSGaleryImageCreates.index'));
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
            $projectTSGaleryImageCreate = $this->projectTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageCreate))
            {
                Flash::error('Project T S Galery Image Create not found');
                return redirect(route('projectTSGaleryImageCreates.index'));
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
            
            if($user_id == $projectTSGaleryImageCreate -> user_id || $isShared)
            {
                $this->projectTSGaleryImageCreateRepository->delete($id);
                
                Flash::success('Project T S Galery Image Create deleted successfully.');
                return redirect(route('projectTSGaleryImageCreates.index'));
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