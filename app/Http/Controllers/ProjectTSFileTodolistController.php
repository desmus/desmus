<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSFileTodolistRequest;
use App\Http\Requests\UpdateProjectTSFileTodolistRequest;
use App\Repositories\ProjectTSFileTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSFileTodolistController extends AppBaseController
{
    private $projectTSFileTodolistRepository;

    public function __construct(ProjectTSFileTodolistRepository $projectTSFileTodolistRepo)
    {
        $this->projectTSFileTodolistRepository = $projectTSFileTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSFileTodolistRepository->pushCriteria(new RequestCriteria($request));
            $projectTSFileTodolists = $this->projectTSFileTodolistRepository->all();
    
            return view('project_t_s_file_todolists.index')
                ->with('projectTSFileTodolists', $projectTSFileTodolists);
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
            return view('project_t_s_file_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSFileTodolist = $this->projectTSFileTodolistRepository->create($input);
    
            Flash::success('Project T S File Todolist saved successfully.');
            return redirect(route('projectTSFileTodolists.index'));
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
            $projectTSFileTodolist = $this->projectTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolist))
            {
                Flash::error('Project T S File Todolist not found');
                return redirect(route('projectTSFileTodolists.index'));
            }
    
            return view('project_t_s_file_todolists.show')->with('projectTSFileTodolist', $projectTSFileTodolist);
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
            $projectTSFileTodolist = $this->projectTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolist))
            {
                Flash::error('Project T S File Todolist not found');
                return redirect(route('projectTSFileTodolists.index'));
            }
    
            return view('project_t_s_file_todolists.edit')->with('projectTSFileTodolist', $projectTSFileTodolist);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateProjectTSFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $projectTSFileTodolist = $this->projectTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolist))
            {
                Flash::error('Project T S File Todolist not found');
                return redirect(route('projectTSFileTodolists.index'));
            }
    
            $projectTSFileTodolist = $this->projectTSFileTodolistRepository->update($request->all(), $id);
    
            Flash::success('Project T S File Todolist updated successfully.');
            return redirect(route('projectTSFileTodolists.index'));
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
            $projectTSFileTodolist = $this->projectTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolist))
            {
                Flash::error('Project T S File Todolist not found');
                return redirect(route('projectTSFileTodolists.index'));
            }
    
            $this->projectTSFileTodolistRepository->delete($id);
    
            Flash::success('Project T S File Todolist deleted successfully.');
            return redirect(route('projectTSFileTodolists.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}