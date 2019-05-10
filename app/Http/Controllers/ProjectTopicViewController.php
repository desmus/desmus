<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicViewRequest;
use App\Http\Requests\UpdateProjectTopicViewRequest;
use App\Repositories\ProjectTopicViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicViewController extends AppBaseController
{
    private $projectTopicViewRepository;

    public function __construct(ProjectTopicViewRepository $projectTopicViewRepo)
    {
        $this->projectTopicViewRepository = $projectTopicViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicViews = $this->projectTopicViewRepository->all();
    
            return view('project_topic_views.index')
                ->with('projectTopicViews', $projectTopicViews);
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
            return view('project_topic_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTopicView = $this->projectTopicViewRepository->create($input);
            
                Flash::success('Project Topic View saved successfully.');
                return redirect(route('projectTopicViews.index'));
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
            $projectTopicView = $this->projectTopicViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicView))
            {
                Flash::error('Project Topic View not found');
                return redirect(route('projectTopicViews.index'));
            }
            
            $userProjectTopics = DB::table('user_project_topics')->where('project_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTopics as $userProjectTopic)
            {
                if($userProjectTopic -> user_id == $user_id && $userProject -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $projectTopicView -> user_id || $isShared)
            {
                return view('project_topic_views.show')
                    ->with('projectTopicView', $projectTopicView);
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
            $projectTopicView = $this->projectTopicViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicView))
            {
                Flash::error('Project Topic View not found');
                return redirect(route('projectTopicViews.index'));
            }
            
            $userProjectTopics = DB::table('user_project_topics')->where('project_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTopics as $userProjectTopic)
            {
                if($userProjectTopic -> user_id == $user_id && $userProject -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $projectTopicView -> user_id || $isShared)
            {
                return view('project_topic_views.edit')
                    ->with('projectTopicView', $projectTopicView);
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

    public function update($id, UpdateProjectTopicViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicView = $this->projectTopicViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicView))
            {
                Flash::error('Project Topic View not found');
                return redirect(route('projectTopicViews.index'));
            }
            
            $userProjectTopics = DB::table('user_project_topics')->where('project_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTopics as $userProjectTopic)
            {
                if($userProjectTopic -> user_id == $user_id && $userProject -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $projectTopicView -> user_id || $isShared)
            {
                $projectTopicView = $this->projectTopicViewRepository->update($request->all(), $id);
            
                Flash::success('Project Topic View updated successfully.');
                return redirect(route('projectTopicViews.index'));
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
            $projectTopicView = $this->projectTopicViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicView))
            {
                Flash::error('Project Topic View not found');
                return redirect(route('projectTopicViews.index'));
            }
    
            $userProjectTopics = DB::table('user_project_topics')->where('project_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTopics as $userProjectTopic)
            {
                if($userProjectTopic -> user_id == $user_id && $userProject -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $projectTopicView -> user_id || $isShared)
            {
                $this->projectTopicViewRepository->delete($id);
                
                Flash::success('Project Topic View deleted successfully.');
                return redirect(route('projectTopicViews.index'));
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