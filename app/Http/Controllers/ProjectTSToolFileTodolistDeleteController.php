<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolFileTodolistDeleteRequest;
use App\Http\Requests\UpdateProjectTSToolFileTodolistDeleteRequest;
use App\Repositories\ProjectTSToolFileTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolFileTodolistDeleteController extends AppBaseController
{
    private $projectTSToolFileTodolistDeleteRepository;

    public function __construct(ProjectTSToolFileTodolistDeleteRepository $projectTSToolFileTodolistDeleteRepo)
    {
        $this->projectTSToolFileTodolistDeleteRepository = $projectTSToolFileTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolFileTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolFileTodolistDeletes = $this->projectTSToolFileTodolistDeleteRepository->all();
    
            return view('project_t_s_tool_file_todolist_deletes.index')
                ->with('projectTSToolFileTodolistDeletes', $projectTSToolFileTodolistDeletes);
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
            return view('project_t_s_tool_file_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(CreateProjectTSToolFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSToolFileTodolistDelete = $this->projectTSToolFileTodolistDeleteRepository->create($input);
    
            Flash::success('Project T S Tool File Todolist Delete saved successfully.');
            return redirect(route('projectTSToolFileTodolistDeletes.index'));
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
            $projectTSToolFileTodolistDelete = $this->projectTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistDelete))
            {
                Flash::error('Project T S Tool File Todolist Delete not found');
                return redirect(route('projectTSToolFileTodolistDeletes.index'));
            }
            
            if($projectTSToolFileTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_tool_file_todolist_deletes.show')->with('projectTSToolFileTodolistDelete', $projectTSToolFileTodolistDelete);
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
            $projectTSToolFileTodolistDelete = $this->projectTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistDelete))
            {
                Flash::error('Project T S Tool File Todolist Delete not found');
                return redirect(route('projectTSToolFileTodolistDeletes.index'));
            }
    
            if($projectTSToolFileTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_tool_file_todolist_deletes.edit')->with('projectTSToolFileTodolistDelete', $projectTSToolFileTodolistDelete);
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

    public function update($id, UpdateProjectTSToolFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolFileTodolistDelete = $this->projectTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistDelete))
            {
                Flash::error('Project T S Tool File Todolist Delete not found');
                return redirect(route('projectTSToolFileTodolistDeletes.index'));
            }
    
            if($projectTSToolFileTodolistDelete -> user_id == $user_id)
            {
                $projectTSToolFileTodolistDelete = $this->projectTSToolFileTodolistDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool File Todolist Delete updated successfully.');
                return redirect(route('projectTSToolFileTodolistDeletes.index'));
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
            $projectTSToolFileTodolistDelete = $this->projectTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistDelete))
            {
                Flash::error('Project T S Tool File Todolist Delete not found');
                return redirect(route('projectTSToolFileTodolistDeletes.index'));
            }
    
            if($projectTSToolFileTodolistDelete -> user_id == $user_id)
            {
                $this->projectTSToolFileTodolistDeleteRepository->delete($id);
                
                Flash::success('Project T S Tool File Todolist Delete deleted successfully.');
                return redirect(route('projectTSToolFileTodolistDeletes.index'));
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