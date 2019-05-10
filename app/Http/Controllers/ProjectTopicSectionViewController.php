<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicSectionViewRequest;
use App\Http\Requests\UpdateProjectTopicSectionViewRequest;
use App\Repositories\ProjectTopicSectionViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicSectionViewController extends AppBaseController
{
    private $projectTopicSectionViewRepository;

    public function __construct(ProjectTopicSectionViewRepository $projectTopicSectionViewRepo)
    {
        $this->projectTopicSectionViewRepository = $projectTopicSectionViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicSectionViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicSectionViews = $this->projectTopicSectionViewRepository->all();
    
            return view('project_topic_section_views.index')
                ->with('projectTopicSectionViews', $projectTopicSectionViews);
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
            return view('project_topic_section_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicSectionViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTopicSectionView = $this->projectTopicSectionViewRepository->create($input);
            
                Flash::success('Project Topic Section View saved successfully.');
                return redirect(route('projectTopicSectionViews.index'));
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
            $projectTopicSectionView = $this->projectTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionView))
            {
                Flash::error('Project Topic Section View not found');
                return redirect(route('projectTopicSectionViews.index'));
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
            
            if($user_id == $projectTopicSectionView -> user_id || $isShared)
            {
                return view('project_topic_section_views.show')->with('projectTopicSectionView', $projectTopicSectionView);
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
            $projectTopicSectionView = $this->projectTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionView))
            {
                Flash::error('Project Topic Section View not found');
                return redirect(route('projectTopicSectionViews.index'));
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
            
            if($user_id == $projectTopicSectionView -> user_id || $isShared)
            {
                return view('project_topic_section_views.edit')->with('projectTopicSectionView', $projectTopicSectionView);
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

    public function update($id, UpdateProjectTopicSectionViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicSectionView = $this->projectTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionView))
            {
                Flash::error('Project Topic Section View not found');
                return redirect(route('projectTopicSectionViews.index'));
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
            
            if($user_id == $projectTopicSectionView -> user_id || $isShared)
            {
                $projectTopicSectionView = $this->projectTopicSectionViewRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Section View updated successfully.');
                return redirect(route('projectTopicSectionViews.index'));
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
            $projectTopicSectionView = $this->projectTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionView))
            {
                Flash::error('Project Topic Section View not found');
                return redirect(route('projectTopicSectionViews.index'));
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
            
            if($user_id == $projectTopicSectionView -> user_id || $isShared)
            {
                $this->projectTopicSectionViewRepository->delete($id);
            
                Flash::success('Project Topic Section View deleted successfully.');
                return redirect(route('projectTopicSectionViews.index'));
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