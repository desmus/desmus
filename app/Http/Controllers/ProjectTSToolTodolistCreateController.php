<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolTodolistCreateRequest;
use App\Http\Requests\UpdateProjectTSToolTodolistCreateRequest;
use App\Repositories\ProjectTSToolTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolTodolistCreateController extends AppBaseController
{
    private $projectTSToolTodolistCreateRepository;

    public function __construct(ProjectTSToolTodolistCreateRepository $projectTSToolTodolistCreateRepo)
    {
        $this->projectTSToolTodolistCreateRepository = $projectTSToolTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolTodolistCreates = $this->projectTSToolTodolistCreateRepository->all();
    
            return view('project_t_s_tool_todolist_creates.index')
                ->with('projectTSToolTodolistCreates', $projectTSToolTodolistCreates);
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
            return view('project_t_s_tool_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSToolTodolistCreate = $this->projectTSToolTodolistCreateRepository->create($input);
    
            Flash::success('Project T S Tool Todolist Create saved successfully.');
            return redirect(route('projectTSToolTodolistCreates.index'));
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
            $projectTSToolTodolistCreate = $this->projectTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistCreate))
            {
                Flash::error('Project T S Tool Todolist Create not found');
                return redirect(route('projectTSToolTodolistCreates.index'));
            }
            
            if($projectTSToolTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_tool_todolist_creates.show')->with('projectTSToolTodolistCreate', $projectTSToolTodolistCreate);
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
            $projectTSToolTodolistCreate = $this->projectTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistCreate))
            {
                Flash::error('Project T S Tool Todolist Create not found');
                return redirect(route('projectTSToolTodolistCreates.index'));
            }
            
            if($projectTSToolTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_tool_todolist_creates.edit')->with('projectTSToolTodolistCreate', $projectTSToolTodolistCreate);
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

    public function update($id, UpdateProjectTSToolTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolTodolistCreate = $this->projectTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistCreate))
            {
                Flash::error('Project T S Tool Todolist Create not found');
                return redirect(route('projectTSToolTodolistCreates.index'));
            }
    
            if($projectTSToolTodolistCreate -> user_id == $user_id)
            {
                $projectTSToolTodolistCreate = $this->projectTSToolTodolistCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool Todolist Create updated successfully.');
                return redirect(route('projectTSToolTodolistCreates.index'));
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
            $projectTSToolTodolistCreate = $this->projectTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistCreate))
            {
                Flash::error('Project T S Tool Todolist Create not found');
                return redirect(route('projectTSToolTodolistCreates.index'));
            }
    
            if($projectTSToolTodolistCreate -> user_id == $user_id)
            {
                $this->projectTSToolTodolistCreateRepository->delete($id);
                
                Flash::success('Project T S Tool Todolist Create deleted successfully.');
                return redirect(route('projectTSToolTodolistCreates.index'));
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