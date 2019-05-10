<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolFileTodolistRequest;
use App\Http\Requests\UpdateProjectTSToolFileTodolistRequest;
use App\Repositories\ProjectTSToolFileTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolFileTodolistController extends AppBaseController
{
    private $projectTSToolFileTodolistRepository;

    public function __construct(ProjectTSToolFileTodolistRepository $projectTSToolFileTodolistRepo)
    {
        $this->projectTSToolFileTodolistRepository = $projectTSToolFileTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolFileTodolistRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolFileTodolists = $this->projectTSToolFileTodolistRepository->all();
    
            return view('project_t_s_tool_file_todolists.index')
                ->with('projectTSToolFileTodolists', $projectTSToolFileTodolists);
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
            return view('project_t_s_tool_file_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSToolFileTodolist = $this->projectTSToolFileTodolistRepository->create($input);
    
            Flash::success('Project T S Tool File Todolist saved successfully.');
            return redirect(route('projectTSToolFileTodolists.index'));
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
            $projectTSToolFileTodolist = $this->projectTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolist))
            {
                Flash::error('Project T S Tool File Todolist not found');
                return redirect(route('projectTSToolFileTodolists.index'));
            }
    
            return view('project_t_s_tool_file_todolists.show')->with('projectTSToolFileTodolist', $projectTSToolFileTodolist);
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
            $projectTSToolFileTodolist = $this->projectTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolist))
            {
                Flash::error('Project T S Tool File Todolist not found');
                return redirect(route('projectTSToolFileTodolists.index'));
            }
    
            return view('project_t_s_tool_file_todolists.edit')->with('projectTSToolFileTodolist', $projectTSToolFileTodolist);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateProjectTSToolFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $projectTSToolFileTodolist = $this->projectTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolist))
            {
                Flash::error('Project T S Tool File Todolist not found');
                return redirect(route('projectTSToolFileTodolists.index'));
            }
    
            $projectTSToolFileTodolist = $this->projectTSToolFileTodolistRepository->update($request->all(), $id);
    
            Flash::success('Project T S Tool File Todolist updated successfully.');
            return redirect(route('projectTSToolFileTodolists.index'));
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
            $projectTSToolFileTodolist = $this->projectTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolist))
            {
                Flash::error('Project T S Tool File Todolist not found');
                return redirect(route('projectTSToolFileTodolists.index'));
            }
    
            $this->projectTSToolFileTodolistRepository->delete($id);
    
            Flash::success('Project T S Tool File Todolist deleted successfully.');
            return redirect(route('projectTSToolFileTodolists.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}