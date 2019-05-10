<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryUpdateRequest;
use App\Http\Requests\UpdateProjectTSGaleryUpdateRequest;
use App\Repositories\ProjectTSGaleryUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryUpdateController extends AppBaseController
{
    private $projectTSGaleryUpdateRepository;

    public function __construct(ProjectTSGaleryUpdateRepository $projectTSGaleryUpdateRepo)
    {
        $this->projectTSGaleryUpdateRepository = $projectTSGaleryUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryUpdates = $this->projectTSGaleryUpdateRepository->all();
    
            return view('project_t_s_galery_updates.index')
                ->with('projectTSGaleryUpdates', $projectTSGaleryUpdates);
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
            return view('project_t_s_galery_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSGaleryUpdate = $this->projectTSGaleryUpdateRepository->create($input);
                
                Flash::success('Project T S Galery Update saved successfully.');
                return redirect(route('projectTSGaleryUpdates.index'));
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
            $projectTSGaleryUpdate = $this->projectTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryUpdate))
            {
                Flash::error('Project T S Galery Update not found');
                return redirect(route('projectTSGaleryUpdates.index'));
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
            
            if($user_id == $projectTSGaleryUpdate -> user_id || $isShared)
            {
                return view('project_t_s_galery_updates.show')->with('projectTSGaleryUpdate', $projectTSGaleryUpdate);
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
            $projectTSGaleryUpdate = $this->projectTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryUpdate))
            {
                Flash::error('Project T S Galery Update not found');
                return redirect(route('projectTSGaleryUpdates.index'));
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
            
            if($user_id == $projectTSGaleryUpdate -> user_id || $isShared)
            {
                return view('project_t_s_galery_updates.edit')->with('projectTSGaleryUpdate', $projectTSGaleryUpdate);
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

    public function update($id, UpdateProjectTSGaleryUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryUpdate = $this->projectTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryUpdate))
            {
                Flash::error('Project T S Galery Update not found');
                return redirect(route('projectTSGaleryUpdates.index'));
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
            
            if($user_id == $projectTSGaleryUpdate -> user_id || $isShared)
            {
                $projectTSGaleryUpdate = $this->projectTSGaleryUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery Update updated successfully.');
                return redirect(route('projectTSGaleryUpdates.index'));
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
            $projectTSGaleryUpdate = $this->projectTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryUpdate))
            {
                Flash::error('Project T S Galery Update not found');
                return redirect(route('projectTSGaleryUpdates.index'));
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
            
            if($user_id == $projectTSGaleryUpdate -> user_id || $isShared)
            {
                $this->projectTSGaleryUpdateRepository->delete($id);
                
                Flash::success('Project T S Galery Update deleted successfully.');
                return redirect(route('projectTSGaleryUpdates.index'));
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