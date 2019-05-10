<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicDeleteRequest;
use App\Http\Requests\UpdateProjectTopicDeleteRequest;
use App\Repositories\ProjectTopicDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicDeleteController extends AppBaseController
{
    private $projectTopicDeleteRepository;

    public function __construct(ProjectTopicDeleteRepository $projectTopicDeleteRepo)
    {
        $this->projectTopicDeleteRepository = $projectTopicDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicDeletes = $this->projectTopicDeleteRepository->all();
    
            return view('project_topic_deletes.index')
                ->with('projectTopicDeletes', $projectTopicDeletes);
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
            return view('project_topic_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTopicDelete = $this->projectTopicDeleteRepository->create($input);
            
                Flash::success('Project Topic Delete saved successfully.');
                return redirect(route('projectTopicDeletes.index'));
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
            $projectTopicDelete = $this->projectTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicDelete))
            {
                Flash::error('Project Topic Delete not found');
                return redirect(route('projectTopicDeletes.index'));
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
            
            if($user_id == $projectTopicDelete -> user_id || $isShared)
            {
                return view('project_topic_deletes.show')->with('projectTopicDelete', $projectTopicDelete);
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
            $projectTopicDelete = $this->projectTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicDelete))
            {
                Flash::error('Project Topic Delete not found');
                return redirect(route('projectTopicDeletes.index'));
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
            
            if($user_id == $projectTopicDelete -> user_id || $isShared)
            {
                return view('project_topic_deletes.edit')->with('projectTopicDelete', $projectTopicDelete);
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

    public function update($id, UpdateProjectTopicDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicDelete = $this->projectTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicDelete))
            {
                Flash::error('Project Topic Delete not found');
                return redirect(route('projectTopicDeletes.index'));
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
            
            if($user_id == $projectTopicDelete -> user_id || $isShared)
            {
                $projectTopicDelete = $this->projectTopicDeleteRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Delete updated successfully.');
                return redirect(route('projectTopicDeletes.index'));
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
            $projectTopicDelete = $this->projectTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicDelete))
            {
                Flash::error('Project Topic Delete not found');
                return redirect(route('projectTopicDeletes.index'));
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
            
            if($user_id == $projectTopicDelete -> user_id || $isShared)
            {
                $this->projectTopicDeleteRepository->delete($id);
            
                Flash::success('Project Topic Delete deleted successfully.');
                return redirect(route('projectTopicDeletes.index'));
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