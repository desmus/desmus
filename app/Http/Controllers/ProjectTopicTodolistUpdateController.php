<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicTodolistUpdateRequest;
use App\Http\Requests\UpdateProjectTopicTodolistUpdateRequest;
use App\Repositories\ProjectTopicTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicTodolistUpdateController extends AppBaseController
{
    private $projectTopicTodolistUpdateRepository;

    public function __construct(ProjectTopicTodolistUpdateRepository $projectTopicTodolistUpdateRepo)
    {
        $this->projectTopicTodolistUpdateRepository = $projectTopicTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicTodolistUpdates = $this->projectTopicTodolistUpdateRepository->all();
    
            return view('project_topic_todolist_updates.index')
                ->with('projectTopicTodolistUpdates', $projectTopicTodolistUpdates);
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
            return view('project_topic_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTopicTodolistUpdate = $this->projectTopicTodolistUpdateRepository->create($input);
    
            Flash::success('Project Topic Todolist Update saved successfully.');
            return redirect(route('projectTopicTodolistUpdates.index'));
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
            $projectTopicTodolistUpdate = $this->projectTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistUpdate))
            {
                Flash::error('Project Topic Todolist Update not found');
                return redirect(route('projectTopicTodolistUpdates.index'));
            }
            
            if($projectTopicTodolistUpdate -> user_id == $user_id)
            {
                return view('project_topic_todolist_updates.show')->with('projectTopicTodolistUpdate', $projectTopicTodolistUpdate);
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
            $projectTopicTodolistUpdate = $this->projectTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistUpdate))
            {
                Flash::error('Project Topic Todolist Update not found');
                return redirect(route('projectTopicTodolistUpdates.index'));
            }
    
            if($projectTopicTodolistUpdate -> user_id == $user_id)
            {
                return view('project_topic_todolist_updates.edit')->with('projectTopicTodolistUpdate', $projectTopicTodolistUpdate);
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

    public function update($id, UpdateProjectTopicTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicTodolistUpdate = $this->projectTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistUpdate))
            {
                Flash::error('Project Topic Todolist Update not found');
                return redirect(route('projectTopicTodolistUpdates.index'));
            }
            
            if($projectTopicTodolistUpdate -> user_id == $user_id)
            {
                $projectTopicTodolistUpdate = $this->projectTopicTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Todolist Update updated successfully.');
                return redirect(route('projectTopicTodolistUpdates.index'));
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
            $projectTopicTodolistUpdate = $this->projectTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistUpdate))
            {
                Flash::error('Project Topic Todolist Update not found');
                return redirect(route('projectTopicTodolistUpdates.index'));
            }
            
            if($projectTopicTodolistUpdate -> user_id == $user_id)
            {
                $this->projectTopicTodolistUpdateRepository->delete($id);
            
                Flash::success('Project Topic Todolist Update deleted successfully.');
                return redirect(route('projectTopicTodolistUpdates.index'));
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