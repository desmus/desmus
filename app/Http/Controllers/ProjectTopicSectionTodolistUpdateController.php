<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicSectionTodolistUpdateRequest;
use App\Http\Requests\UpdateProjectTopicSectionTodolistUpdateRequest;
use App\Repositories\ProjectTopicSectionTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicSectionTodolistUpdateController extends AppBaseController
{
    private $projectTopicSectionTodolistUpdateRepository;

    public function __construct(ProjectTopicSectionTodolistUpdateRepository $projectTopicSectionTodolistUpdateRepo)
    {
        $this->projectTopicSectionTodolistUpdateRepository = $projectTopicSectionTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicSectionTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicSectionTodolistUpdates = $this->projectTopicSectionTodolistUpdateRepository->all();
    
            return view('project_topic_section_todolist_updates.index')
                ->with('projectTopicSectionTodolistUpdates', $projectTopicSectionTodolistUpdates);
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
            return view('project_topic_section_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicSectionTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTopicSectionTodolistUpdate = $this->projectTopicSectionTodolistUpdateRepository->create($input);
    
            Flash::success('Project Topic Section Todolist Update saved successfully.');
            return redirect(route('projectTSTodolistUpdates.index'));
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
            $projectTopicSectionTodolistUpdate = $this->projectTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistUpdate))
            {
                Flash::error('Project Topic Section Todolist Update not found');
                return redirect(route('projectTSTodolistUpdates.index'));
            }
            
            if($projectTopicSectionTodolistUpdate -> user_id == $user_id)
            {
                return view('project_topic_section_todolist_updates.show')
                    ->with('projectTopicSectionTodolistUpdate', $projectTopicSectionTodolistUpdate);
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
            $projectTopicSectionTodolistUpdate = $this->projectTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistUpdate))
            {
                Flash::error('Project Topic Section Todolist Update not found');
                return redirect(route('projectTSTodolistUpdates.index'));
            }
            
            if($projectTopicSectionTodolistUpdate -> user_id == $user_id)
            {
                return view('project_topic_section_todolist_updates.edit')
                    ->with('projectTopicSectionTodolistUpdate', $projectTopicSectionTodolistUpdate);
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

    public function update($id, UpdateProjectTopicSectionTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicSectionTodolistUpdate = $this->projectTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistUpdate))
            {
                Flash::error('Project Topic Section Todolist Update not found');
                return redirect(route('projectTSTodolistUpdates.index'));
            }
            
            if($projectTopicSectionTodolistUpdate -> user_id == $user_id)
            {  
                $projectTopicSectionTodolistUpdate = $this->projectTopicSectionTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Section Todolist Update updated successfully.');
                return redirect(route('projectTSTodolistUpdates.index'));
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
            $projectTopicSectionTodolistUpdate = $this->projectTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistUpdate))
            {
                Flash::error('Project Topic Section Todolist Update not found');
                return redirect(route('projectTSTodolistUpdates.index'));
            }
    
            if($projectTopicSectionTodolistUpdate -> user_id == $user_id)
            { 
                $this->projectTopicSectionTodolistUpdateRepository->delete($id);
            
                Flash::success('Project Topic Section Todolist Update deleted successfully.');
                return redirect(route('projectTSTodolistUpdates.index'));
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