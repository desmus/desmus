<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicCreateRequest;
use App\Http\Requests\UpdateProjectTopicCreateRequest;
use App\Repositories\ProjectTopicCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicCreateController extends AppBaseController
{
    private $projectTopicCreateRepository;

    public function __construct(ProjectTopicCreateRepository $projectTopicCreateRepo)
    {
        $this->projectTopicCreateRepository = $projectTopicCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicCreates = $this->projectTopicCreateRepository->all();
    
            return view('project_topic_creates.index')
                ->with('projectTopicCreates', $projectTopicCreates);
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
            return view('project_topic_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTopicCreate = $this->projectTopicCreateRepository->create($input);
            
                Flash::success('Project Topic Create saved successfully.');
                return redirect(route('projectTopicCreates.index'));
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
            $projectTopicCreate = $this->projectTopicCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicCreate))
            {
                Flash::error('Project Topic Create not found');
                return redirect(route('projectTopicCreates.index'));
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
            
            if($user_id == $projectTopicCreate -> user_id || $isShared)
            {
                return view('project_topic_creates.show')->with('projectTopicCreate', $projectTopicCreate);
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
            $projectTopicCreate = $this->projectTopicCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicCreate))
            {
                Flash::error('Project Topic Create not found');
                return redirect(route('projectTopicCreates.index'));
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
            
            if($user_id == $projectTopicCreate -> user_id || $isShared)
            {
                return view('project_topic_creates.edit')->with('projectTopicCreate', $projectTopicCreate);
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

    public function update($id, UpdateProjectTopicCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicCreate = $this->projectTopicCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicCreate))
            {
                Flash::error('Project Topic Create not found');
                return redirect(route('projectTopicCreates.index'));
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
    
            if($user_id == $projectTopicCreate -> user_id || $isShared)
            {
                $projectTopicCreate = $this->projectTopicCreateRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Create updated successfully.');
                return redirect(route('projectTopicCreates.index'));
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
            $projectTopicCreate = $this->projectTopicCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicCreate))
            {
                Flash::error('Project Topic Create not found');
                return redirect(route('projectTopicCreates.index'));
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
    
            if($user_id == $projectTopicCreate -> user_id || $isShared)
            {
                $this->projectTopicCreateRepository->delete($id);
            
                Flash::success('Project Topic Create deleted successfully.');
                return redirect(route('projectTopicCreates.index'));
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