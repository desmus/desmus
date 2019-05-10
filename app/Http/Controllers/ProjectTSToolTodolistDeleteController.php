<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolTodolistDeleteRequest;
use App\Http\Requests\UpdateProjectTSToolTodolistDeleteRequest;
use App\Repositories\ProjectTSToolTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolTodolistDeleteController extends AppBaseController
{
    private $projectTSToolTodolistDeleteRepository;

    public function __construct(ProjectTSToolTodolistDeleteRepository $projectTSToolTodolistDeleteRepo)
    {
        $this->projectTSToolTodolistDeleteRepository = $projectTSToolTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolTodolistDeletes = $this->projectTSToolTodolistDeleteRepository->all();
    
            return view('project_t_s_tool_todolist_deletes.index')
                ->with('projectTSToolTodolistDeletes', $projectTSToolTodolistDeletes);
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
            return view('project_t_s_tool_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSToolTodolistDelete = $this->projectTSToolTodolistDeleteRepository->create($input);
    
            Flash::success('Project T S Tool Todolist Delete saved successfully.');
            return redirect(route('projectTSToolTodolistDeletes.index'));
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
            $projectTSToolTodolistDelete = $this->projectTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistDelete))
            {
                Flash::error('Project T S Tool Todolist Delete not found');
                return redirect(route('projectTSToolTodolistDeletes.index'));
            }
            
            if($projectTSToolTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_tool_todolist_deletes.show')->with('projectTSToolTodolistDelete', $projectTSToolTodolistDelete);
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
            $projectTSToolTodolistDelete = $this->projectTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistDelete))
            {
                Flash::error('Project T S Tool Todolist Delete not found');
                return redirect(route('projectTSToolTodolistDeletes.index'));
            }
            
            if($projectTSToolTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_tool_todolist_deletes.edit')->with('projectTSToolTodolistDelete', $projectTSToolTodolistDelete);
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

    public function update($id, UpdateProjectTSToolTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolTodolistDelete = $this->projectTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistDelete))
            {
                Flash::error('Project T S Tool Todolist Delete not found');
                return redirect(route('projectTSToolTodolistDeletes.index'));
            }
    
            if($projectTSToolTodolistDelete -> user_id == $user_id)
            {
                $projectTSToolTodolistDelete = $this->projectTSToolTodolistDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool Todolist Delete updated successfully.');
                return redirect(route('projectTSToolTodolistDeletes.index'));
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
            $projectTSToolTodolistDelete = $this->projectTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistDelete))
            {
                Flash::error('Project T S Tool Todolist Delete not found');
                return redirect(route('projectTSToolTodolistDeletes.index'));
            }
    
            if($projectTSToolTodolistDelete -> user_id == $user_id)
            {
                $this->projectTSToolTodolistDeleteRepository->delete($id);
                
                Flash::success('Project T S Tool Todolist Delete deleted successfully.');
                return redirect(route('projectTSToolTodolistDeletes.index'));
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