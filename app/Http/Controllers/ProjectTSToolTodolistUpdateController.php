<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolTodolistUpdateRequest;
use App\Http\Requests\UpdateProjectTSToolTodolistUpdateRequest;
use App\Repositories\ProjectTSToolTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolTodolistUpdateController extends AppBaseController
{
    private $projectTSToolTodolistUpdateRepository;

    public function __construct(ProjectTSToolTodolistUpdateRepository $projectTSToolTodolistUpdateRepo)
    {
        $this->projectTSToolTodolistUpdateRepository = $projectTSToolTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolTodolistUpdates = $this->projectTSToolTodolistUpdateRepository->all();
    
            return view('project_t_s_tool_todolist_updates.index')
                ->with('projectTSToolTodolistUpdates', $projectTSToolTodolistUpdates);
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
            return view('project_t_s_tool_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSToolTodolistUpdate = $this->projectTSToolTodolistUpdateRepository->create($input);
    
            Flash::success('Project T S Tool Todolist Update saved successfully.');
            return redirect(route('projectTSToolTodolistUpdates.index'));
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
            $projectTSToolTodolistUpdate = $this->projectTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistUpdate))
            {
                Flash::error('Project T S Tool Todolist Update not found');
                return redirect(route('projectTSToolTodolistUpdates.index'));
            }
            
            if($projectTSToolTodolistUpdate -> user_id == $user_id)
            {
                return view('project_t_s_tool_todolist_updates.show')->with('projectTSToolTodolistUpdate', $projectTSToolTodolistUpdate);
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
            $projectTSToolTodolistUpdate = $this->projectTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistUpdate))
            {
                Flash::error('Project T S Tool Todolist Update not found');
                return redirect(route('projectTSToolTodolistUpdates.index'));
            }
    
            if($projectTSToolTodolistUpdate -> user_id == $user_id)
            {
                return view('project_t_s_tool_todolist_updates.edit')->with('projectTSToolTodolistUpdate', $projectTSToolTodolistUpdate);
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

    public function update($id, UpdateProjectTSToolTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolTodolistUpdate = $this->projectTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistUpdate))
            {
                Flash::error('Project T S Tool Todolist Update not found');
                return redirect(route('projectTSToolTodolistUpdates.index'));
            }
    
            if($projectTSToolTodolistUpdate -> user_id == $user_id)
            {
                $projectTSToolTodolistUpdate = $this->projectTSToolTodolistUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool Todolist Update updated successfully.');
                return redirect(route('projectTSToolTodolistUpdates.index'));
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
            $projectTSToolTodolistUpdate = $this->projectTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistUpdate))
            {
                Flash::error('Project T S Tool Todolist Update not found');
                return redirect(route('projectTSToolTodolistUpdates.index'));
            }
            
            if($projectTSToolTodolistUpdate -> user_id == $user_id)
            {
                $this->projectTSToolTodolistUpdateRepository->delete($id);
                
                Flash::success('Project T S Tool Todolist Update deleted successfully.');
                return redirect(route('projectTSToolTodolistUpdates.index'));
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