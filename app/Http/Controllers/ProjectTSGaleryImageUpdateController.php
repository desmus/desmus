<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryImageUpdateRequest;
use App\Http\Requests\UpdateProjectTSGaleryImageUpdateRequest;
use App\Repositories\ProjectTSGaleryImageUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryImageUpdateController extends AppBaseController
{
    private $projectTSGaleryImageUpdateRepository;

    public function __construct(ProjectTSGaleryImageUpdateRepository $projectTSGaleryImageUpdateRepo)
    {
        $this->projectTSGaleryImageUpdateRepository = $projectTSGaleryImageUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryImageUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryImageUpdates = $this->projectTSGaleryImageUpdateRepository->all();
    
            return view('project_t_s_galery_image_updates.index')
                ->with('projectTSGaleryImageUpdates', $projectTSGaleryImageUpdates);
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
            return view('project_t_s_galery_image_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSGaleryImageUpdate = $this->projectTSGaleryImageUpdateRepository->create($input);
                
                Flash::success('Project T S Galery Image Update saved successfully.');
                return redirect(route('projectTSGaleryImageUpdates.index'));
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
            $projectTSGaleryImageUpdate = $this->projectTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageUpdate))
            {
                Flash::error('Project T S Galery Image Update not found');
                return redirect(route('projectTSGaleryImageUpdates.index'));
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
            
            if($user_id == $projectTSGaleryImageUpdate -> user_id || $isShared)
            {
                return view('project_t_s_galery_image_updates.show')->with('projectTSGaleryImageUpdate', $projectTSGaleryImageUpdate);
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
            $projectTSGaleryImageUpdate = $this->projectTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageUpdate))
            {
                Flash::error('Project T S Galery Image Update not found');
                return redirect(route('projectTSGaleryImageUpdates.index'));
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
            
            if($user_id == $projectTSGaleryImageUpdate -> user_id || $isShared)
            {
                return view('project_t_s_galery_image_updates.edit')->with('projectTSGaleryImageUpdate', $projectTSGaleryImageUpdate);
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

    public function update($id, UpdateProjectTSGaleryImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryImageUpdate = $this->projectTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageUpdate))
            {
                Flash::error('Project T S Galery Image Update not found');
                return redirect(route('projectTSGaleryImageUpdates.index'));
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
            
            if($user_id == $projectTSGaleryImageUpdate -> user_id || $isShared)
            {
                $projectTSGaleryImageUpdate = $this->projectTSGaleryImageUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery Image Update updated successfully.');
                return redirect(route('projectTSGaleryImageUpdates.index'));
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
            $projectTSGaleryImageUpdate = $this->projectTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryImageUpdate))
            {
                Flash::error('Project T S Galery Image Update not found');
                return redirect(route('projectTSGaleryImageUpdates.index'));
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
            
            if($user_id == $projectTSGaleryImageUpdate -> user_id || $isShared)
            {
                $this->projectTSGaleryImageUpdateRepository->delete($id);
                
                Flash::success('Project T S Galery Image Update deleted successfully.');
                return redirect(route('projectTSGaleryImageUpdates.index'));
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