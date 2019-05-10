<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicSectionDeleteRequest;
use App\Http\Requests\UpdateProjectTopicSectionDeleteRequest;
use App\Repositories\ProjectTopicSectionDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicSectionDeleteController extends AppBaseController
{
    private $projectTopicSectionDeleteRepository;

    public function __construct(ProjectTopicSectionDeleteRepository $projectTopicSectionDeleteRepo)
    {
        $this->projectTopicSectionDeleteRepository = $projectTopicSectionDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicSectionDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicSectionDeletes = $this->projectTopicSectionDeleteRepository->all();
    
            return view('project_topic_section_deletes.index')
                ->with('projectTopicSectionDeletes', $projectTopicSectionDeletes);
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
            return view('project_topic_section_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicSectionDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTopicSectionDelete = $this->projectTopicSectionDeleteRepository->create($input);
            
                Flash::success('Project Topic Section Delete saved successfully.');
                return redirect(route('projectTopicSectionDeletes.index'));
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
            $projectTopicSectionDelete = $this->projectTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionDelete))
            {
                Flash::error('Project Topic Section Delete not found');
                return redirect(route('projectTopicSectionDeletes.index'));
            }
            
            $userProjectTopicSections = DB::table('user_project_topic_sections')->where('project_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTopicSections as $userProjectTopicSection)
            {
                if($userProjectTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_topic_sections')->join('project_topics', 'project_topic_sections.project_topic_id', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_topic_sections.id', '=', $id)->get();
            
            if($user_id == $projectTopicSectionDelete -> user_id || $isShared)
            {
                return view('project_topic_section_deletes.show')->with('projectTopicSectionDelete', $projectTopicSectionDelete);
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
            $projectTopicSectionDelete = $this->projectTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionDelete))
            {
                Flash::error('Project Topic Section Delete not found');
                return redirect(route('projectTopicSectionDeletes.index'));
            }
            
            $userProjectTopicSections = DB::table('user_project_topic_sections')->where('project_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTopicSections as $userProjectTopicSection)
            {
                if($userProjectTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_topic_sections')->join('project_topics', 'project_topic_sections.project_topic_id', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_topic_sections.id', '=', $id)->get();
            
            if($user_id == $projectTopicSectionDelete -> user_id || $isShared)
            {
                return view('project_topic_section_deletes.edit')->with('projectTopicSectionDelete', $projectTopicSectionDelete);
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

    public function update($id, UpdateProjectTopicSectionDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicSectionDelete = $this->projectTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionDelete))
            {
                Flash::error('Project Topic Section Delete not found');
                return redirect(route('projectTopicSectionDeletes.index'));
            }
            
            $userProjectTopicSections = DB::table('user_project_topic_sections')->where('project_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTopicSections as $userProjectTopicSection)
            {
                if($userProjectTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_topic_sections')->join('project_topics', 'project_topic_sections.project_topic_id', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_topic_sections.id', '=', $id)->get();
            
            if($user_id == $projectTopicSectionDelete -> user_id || $isShared)
            {
                $projectTopicSectionDelete = $this->projectTopicSectionDeleteRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Section Delete updated successfully.');
                return redirect(route('projectTopicSectionDeletes.index'));
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
            $projectTopicSectionDelete = $this->projectTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionDelete))
            {
                Flash::error('Project Topic Section Delete not found');
                return redirect(route('projectTopicSectionDeletes.index'));
            }
            
            $userProjectTopicSections = DB::table('user_project_topic_sections')->where('project_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTopicSections as $userProjectTopicSection)
            {
                if($userProjectTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_topic_sections')->join('project_topics', 'project_topic_sections.project_topic_id', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_topic_sections.id', '=', $id)->get();
            
            if($user_id == $projectTopicSectionDelete -> user_id || $isShared)
            {
                $this->projectTopicSectionDeleteRepository->delete($id);
            
                Flash::success('Project Topic Section Delete deleted successfully.');
                return redirect(route('projectTopicSectionDeletes.index'));
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