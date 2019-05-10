<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolFileTodolistCreateRequest;
use App\Http\Requests\UpdateProjectTSToolFileTodolistCreateRequest;
use App\Repositories\ProjectTSToolFileTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolFileTodolistCreateController extends AppBaseController
{
    private $projectTSToolFileTodolistCreateRepository;

    public function __construct(ProjectTSToolFileTodolistCreateRepository $projectTSToolFileTodolistCreateRepo)
    {
        $this->projectTSToolFileTodolistCreateRepository = $projectTSToolFileTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolFileTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolFileTodolistCreates = $this->projectTSToolFileTodolistCreateRepository->all();
    
            return view('project_t_s_tool_file_todolist_creates.index')
                ->with('projectTSToolFileTodolistCreates', $projectTSToolFileTodolistCreates);
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
            return view('project_t_s_tool_file_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSToolFileTodolistCreate = $this->projectTSToolFileTodolistCreateRepository->create($input);
    
            Flash::success('Project T S Tool File Todolist Create saved successfully.');
            return redirect(route('projectTSToolFileTodolistCreates.index'));
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
            $projectTSToolFileTodolistCreate = $this->projectTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistCreate))
            {
                Flash::error('Project T S Tool File Todolist Create not found');
                return redirect(route('projectTSToolFileTodolistCreates.index'));
            }
    
            if($projectTSToolFileTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_tool_file_todolist_creates.show')->with('projectTSToolFileTodolistCreate', $projectTSToolFileTodolistCreate);
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
            $projectTSToolFileTodolistCreate = $this->projectTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistCreate))
            {
                Flash::error('Project T S Tool File Todolist Create not found');
                return redirect(route('projectTSToolFileTodolistCreates.index'));
            }
    
            if($projectTSToolFileTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_tool_file_todolist_creates.edit')->with('projectTSToolFileTodolistCreate', $projectTSToolFileTodolistCreate);
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

    public function update($id, UpdateProjectTSToolFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolFileTodolistCreate = $this->projectTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistCreate))
            {
                Flash::error('Project T S Tool File Todolist Create not found');
                return redirect(route('projectTSToolFileTodolistCreates.index'));
            }
            
            if($projectTSToolFileTodolistCreate -> user_id == $user_id)
            {
                $projectTSToolFileTodolistCreate = $this->projectTSToolFileTodolistCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool File Todolist Create updated successfully.');
                return redirect(route('projectTSToolFileTodolistCreates.index'));
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
            $projectTSToolFileTodolistCreate = $this->projectTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistCreate))
            {
                Flash::error('Project T S Tool File Todolist Create not found');
                return redirect(route('projectTSToolFileTodolistCreates.index'));
            }
    
            if($projectTSToolFileTodolistCreate -> user_id == $user_id)
            {
                $this->projectTSToolFileTodolistCreateRepository->delete($id);
                
                Flash::success('Project T S Tool File Todolist Create deleted successfully.');
                return redirect(route('projectTSToolFileTodolistCreates.index'));
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