<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicSectionUpdateRequest;
use App\Http\Requests\UpdateProjectTopicSectionUpdateRequest;
use App\Repositories\ProjectTopicSectionUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicSectionUpdateController extends AppBaseController
{
    private $projectTopicSectionUpdateRepository;

    public function __construct(ProjectTopicSectionUpdateRepository $projectTopicSectionUpdateRepo)
    {
        $this->projectTopicSectionUpdateRepository = $projectTopicSectionUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicSectionUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicSectionUpdates = $this->projectTopicSectionUpdateRepository->all();
    
            return view('project_topic_section_updates.index')
                ->with('projectTopicSectionUpdates', $projectTopicSectionUpdates);
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
            return view('project_topic_section_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicSectionUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTopicSectionUpdate = $this->projectTopicSectionUpdateRepository->create($input);
            
                Flash::success('Project Topic Section Update saved successfully.');
                return redirect(route('projectTopicSectionUpdates.index'));
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
            $projectTopicSectionUpdate = $this->projectTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionUpdate))
            {
                Flash::error('Project Topic Section Update not found');
                return redirect(route('projectTopicSectionUpdates.index'));
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
            
            if($user_id == $projectTopicSectionUpdate -> user_id || $isShared)
            {
                return view('project_topic_section_updates.show')
                    ->with('projectTopicSectionUpdate', $projectTopicSectionUpdate);
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
            $projectTopicSectionUpdate = $this->projectTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionUpdate))
            {
                Flash::error('Project Topic Section Update not found');
                return redirect(route('projectTopicSectionUpdates.index'));
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
            
            if($user_id == $projectTopicSectionUpdate -> user_id || $isShared)
            {
                return view('project_topic_section_updates.edit')
                    ->with('projectTopicSectionUpdate', $projectTopicSectionUpdate);
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

    public function update($id, UpdateProjectTopicSectionUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicSectionUpdate = $this->projectTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionUpdate))
            {
                Flash::error('Project Topic Section Update not found');
                return redirect(route('projectTopicSectionUpdates.index'));
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
            
            if($user_id == $projectTopicSectionUpdate -> user_id || $isShared)
            {
                $projectTopicSectionUpdate = $this->projectTopicSectionUpdateRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Section Update updated successfully.');
                return redirect(route('projectTopicSectionUpdates.index'));
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
            $projectTopicSectionUpdate = $this->projectTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionUpdate))
            {
                Flash::error('Project Topic Section Update not found');
                return redirect(route('projectTopicSectionUpdates.index'));
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
            
            if($user_id == $projectTopicSectionUpdate -> user_id || $isShared)
            {
                $this->projectTopicSectionUpdateRepository->delete($id);
            
                Flash::success('Project Topic Section Update deleted successfully.');
                return redirect(route('projectTopicSectionUpdates.index'));
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