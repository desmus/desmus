<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTodolistUpdateRequest;
use App\Http\Requests\UpdateProjectTodolistUpdateRequest;
use App\Repositories\ProjectTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTodolistUpdateController extends AppBaseController
{
    private $projectTodolistUpdateRepository;

    public function __construct(ProjectTodolistUpdateRepository $projectTodolistUpdateRepo)
    {
        $this->projectTodolistUpdateRepository = $projectTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTodolistUpdates = $this->projectTodolistUpdateRepository->all();
    
            return view('project_todolist_updates.index')
                ->with('projectTodolistUpdates', $projectTodolistUpdates);
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
            return view('project_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTodolistUpdate = $this->projectTodolistUpdateRepository->create($input);
    
            Flash::success('Project Todolist Update saved successfully.');
            return redirect(route('projectTodolistUpdates.index'));
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
            $projectTodolistUpdate = $this->projectTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTodolistUpdate))
            {
                Flash::error('Project Todolist Update not found');
                return redirect(route('projectTodolistUpdates.index'));
            }
            
            if($projectTodolistUpdate -> user_id == $user_id)
            {
                return view('project_todolist_updates.show')->with('projectTodolistUpdate', $projectTodolistUpdate);
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
            $projectTodolistUpdate = $this->projectTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTodolistUpdate))
            {
                Flash::error('Project Todolist Update not found');
                return redirect(route('projectTodolistUpdates.index'));
            }
            
            if($projectTodolistUpdate -> user_id == $user_id)
            {
                return view('project_todolist_updates.edit')->with('projectTodolistUpdate', $projectTodolistUpdate);
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

    public function update($id, UpdateProjectTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTodolistUpdate = $this->projectTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTodolistUpdate))
            {
                Flash::error('Project Todolist Update not found');
                return redirect(route('projectTodolistUpdates.index'));
            }
            
            if($projectTodolistUpdate -> user_id == $user_id)
            {
                $projectTodolistUpdate = $this->projectTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('Project Todolist Update updated successfully.');
                return redirect(route('projectTodolistUpdates.index'));
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
            $projectTodolistUpdate = $this->projectTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTodolistUpdate))
            {
                Flash::error('Project Todolist Update not found');
                return redirect(route('projectTodolistUpdates.index'));
            }
    
            if($projectTodolistUpdate -> user_id == $user_id)
            {
                $this->projectTodolistUpdateRepository->delete($id);
            
                Flash::success('Project Todolist Update deleted successfully.');
                return redirect(route('projectTodolistUpdates.index'));
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