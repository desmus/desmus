<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicUpdateRequest;
use App\Http\Requests\UpdateProjectTopicUpdateRequest;
use App\Repositories\ProjectTopicUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicUpdateController extends AppBaseController
{
    private $projectTopicUpdateRepository;

    public function __construct(ProjectTopicUpdateRepository $projectTopicUpdateRepo)
    {
        $this->projectTopicUpdateRepository = $projectTopicUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicUpdates = $this->projectTopicUpdateRepository->all();
    
            return view('project_topic_updates.index')
                ->with('projectTopicUpdates', $projectTopicUpdates);
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
            return view('project_topic_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTopicUpdate = $this->projectTopicUpdateRepository->create($input);
            
                Flash::success('Project Topic Update saved successfully.');
                return redirect(route('projectTopicUpdates.index'));
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
            $projectTopicUpdate = $this->projectTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicUpdate))
            {
                Flash::error('Project Topic Update not found');
                return redirect(route('projectTopicUpdates.index'));
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
            
            if($user_id == $projectTopicUpdate -> user_id || $isShared)
            {
                return view('project_topic_updates.show')
                    ->with('projectTopicUpdate', $projectTopicUpdate);
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
            $projectTopicUpdate = $this->projectTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicUpdate))
            {
                Flash::error('Project Topic Update not found');
                return redirect(route('projectTopicUpdates.index'));
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
            
            if($user_id == $projectTopicUpdate -> user_id || $isShared)
            {
                return view('project_topic_updates.edit')
                    ->with('projectTopicUpdate', $projectTopicUpdate);
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

    public function update($id, UpdateProjectTopicUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicUpdate = $this->projectTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicUpdate))
            {
                Flash::error('Project Topic Update not found');
                return redirect(route('projectTopicUpdates.index'));
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
            
            if($user_id == $projectTopicUpdate -> user_id || $isShared)
            {
                $projectTopicUpdate = $this->projectTopicUpdateRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Update updated successfully.');
                return redirect(route('projectTopicUpdates.index'));
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
            $projectTopicUpdate = $this->projectTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicUpdate))
            {
                Flash::error('Project Topic Update not found');
                return redirect(route('projectTopicUpdates.index'));
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
            
            if($user_id == $projectTopicUpdate -> user_id || $isShared)
            {
                $this->projectTopicUpdateRepository->delete($id);
            
                Flash::success('Project Topic Update deleted successfully.');
                return redirect(route('projectTopicUpdates.index'));
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