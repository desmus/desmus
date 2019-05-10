<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicSectionCreateRequest;
use App\Http\Requests\UpdateProjectTopicSectionCreateRequest;
use App\Repositories\ProjectTopicSectionCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicSectionCreateController extends AppBaseController
{
    private $projectTopicSectionCreateRepository;

    public function __construct(ProjectTopicSectionCreateRepository $projectTopicSectionCreateRepo)
    {
        $this->projectTopicSectionCreateRepository = $projectTopicSectionCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicSectionCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicSectionCreates = $this->projectTopicSectionCreateRepository->all();
    
            return view('project_topic_section_creates.index')
                ->with('projectTopicSectionCreates', $projectTopicSectionCreates);
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
            return view('project_topic_section_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicSectionCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTopicSectionCreate = $this->projectTopicSectionCreateRepository->create($input);
            
                Flash::success('Project Topic Section Create saved successfully.');
                return redirect(route('projectTopicSectionCreates.index'));
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
            $projectTopicSectionCreate = $this->projectTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionCreate))
            {
                Flash::error('Project Topic Section Create not found');
                return redirect(route('projectTopicSectionCreates.index'));
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
            
            if($user_id == $projectTopicSectionCreate -> user_id || $isShared)
            {
                return view('project_topic_section_creates.show')
                    ->with('projectTopicSectionCreate', $projectTopicSectionCreate);
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
            $projectTopicSectionCreate = $this->projectTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionCreate))
            {
                Flash::error('Project Topic Section Create not found');
                return redirect(route('projectTopicSectionCreates.index'));
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
            
            if($user_id == $projectTopicSectionCreate -> user_id || $isShared)
            {
                return view('project_topic_section_creates.edit')
                    ->with('projectTopicSectionCreate', $projectTopicSectionCreate);
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

    public function update($id, UpdateProjectTopicSectionCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicSectionCreate = $this->projectTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionCreate))
            {
                Flash::error('Project Topic Section Create not found');
                return redirect(route('projectTopicSectionCreates.index'));
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
            
            if($user_id == $projectTopicSectionCreate -> user_id || $isShared)
            {
                $projectTopicSectionCreate = $this->projectTopicSectionCreateRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Section Create updated successfully.');
                return redirect(route('projectTopicSectionCreates.index'));
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
            $projectTopicSectionCreate = $this->projectTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionCreate))
            {
                Flash::error('Project Topic Section Create not found');
                return redirect(route('projectTopicSectionCreates.index'));
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
            
            if($user_id == $projectTopicSectionCreate -> user_id || $isShared)
            {
                $this->projectTopicSectionCreateRepository->delete($id);
            
                Flash::success('Project Topic Section Create deleted successfully.');
                return redirect(route('projectTopicSectionCreates.index'));
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