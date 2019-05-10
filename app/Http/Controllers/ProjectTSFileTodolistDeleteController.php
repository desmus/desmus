<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSFileTodolistDeleteRequest;
use App\Http\Requests\UpdateProjectTSFileTodolistDeleteRequest;
use App\Repositories\ProjectTSFileTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSFileTodolistDeleteController extends AppBaseController
{
    private $projectTSFileTodolistDeleteRepository;

    public function __construct(ProjectTSFileTodolistDeleteRepository $projectTSFileTodolistDeleteRepo)
    {
        $this->projectTSFileTodolistDeleteRepository = $projectTSFileTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSFileTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSFileTodolistDeletes = $this->projectTSFileTodolistDeleteRepository->all();
    
            return view('project_t_s_file_todolist_deletes.index')
                ->with('projectTSFileTodolistDeletes', $projectTSFileTodolistDeletes);
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
            return view('project_t_s_file_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSFileTodolistDelete = $this->projectTSFileTodolistDeleteRepository->create($input);
    
            Flash::success('Project T S File Todolist Delete saved successfully.');
            return redirect(route('projectTSFileTodolistDeletes.index'));
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
            $projectTSFileTodolistDelete = $this->projectTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistDelete))
            {
                Flash::error('Project T S File Todolist Delete not found');
                return redirect(route('projectTSFileTodolistDeletes.index'));
            }
            
            if($projectTSFileTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_file_todolist_deletes.show')->with('projectTSFileTodolistDelete', $projectTSFileTodolistDelete);
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
            $projectTSFileTodolistDelete = $this->projectTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistDelete))
            {
                Flash::error('Project T S File Todolist Delete not found');
                return redirect(route('projectTSFileTodolistDeletes.index'));
            }
    
            if($projectTSFileTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_file_todolist_deletes.edit')->with('projectTSFileTodolistDelete', $projectTSFileTodolistDelete);
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

    public function update($id, UpdateProjectTSFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSFileTodolistDelete = $this->projectTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistDelete))
            {
                Flash::error('Project T S File Todolist Delete not found');
                return redirect(route('projectTSFileTodolistDeletes.index'));
            }
    
            if($projectTSFileTodolistDelete -> user_id == $user_id)
            {
                $projectTSFileTodolistDelete = $this->projectTSFileTodolistDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S File Todolist Delete updated successfully.');
                return redirect(route('projectTSFileTodolistDeletes.index'));
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
            $projectTSFileTodolistDelete = $this->projectTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistDelete))
            {
                Flash::error('Project T S File Todolist Delete not found');
                return redirect(route('projectTSFileTodolistDeletes.index'));
            }
    
            if($projectTSFileTodolistDelete -> user_id == $user_id)
            {
                $this->projectTSFileTodolistDeleteRepository->delete($id);
                
                Flash::success('Project T S File Todolist Delete deleted successfully.');
                return redirect(route('projectTSFileTodolistDeletes.index'));
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