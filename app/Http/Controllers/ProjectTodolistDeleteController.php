<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTodolistDeleteRequest;
use App\Http\Requests\UpdateProjectTodolistDeleteRequest;
use App\Repositories\ProjectTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTodolistDeleteController extends AppBaseController
{
    private $projectTodolistDeleteRepository;

    public function __construct(ProjectTodolistDeleteRepository $projectTodolistDeleteRepo)
    {
        $this->projectTodolistDeleteRepository = $projectTodolistDeleteRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTodolistDeletes = $this->projectTodolistDeleteRepository->all();
    
            return view('project_todolist_deletes.index')
                ->with('projectTodolistDeletes', $projectTodolistDeletes);
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
            return view('project_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTodolistDelete = $this->projectTodolistDeleteRepository->create($input);
    
            Flash::success('Project Todolist Delete saved successfully.');
            return redirect(route('projectTodolistDeletes.index'));
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
            $projectTodolistDelete = $this->projectTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTodolistDelete))
            {
                Flash::error('Project Todolist Delete not found');
                return redirect(route('projectTodolistDeletes.index'));
            }
            
            if($projectTodolistDelete -> user_id == $user_id)
            {   
                return view('project_todolist_deletes.show')->with('projectTodolistDelete', $projectTodolistDelete);
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
            $projectTodolistDelete = $this->projectTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTodolistDelete))
            {
                Flash::error('Project Todolist Delete not found');
                return redirect(route('projectTodolistDeletes.index'));
            }
            
            if($projectTodolistDelete -> user_id == $user_id)
            {
                return view('project_todolist_deletes.edit')->with('projectTodolistDelete', $projectTodolistDelete);
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

    public function update($id, UpdateProjectTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTodolistDelete = $this->projectTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTodolistDelete))
            {
                Flash::error('Project Todolist Delete not found');
                return redirect(route('projectTodolistDeletes.index'));
            }
            
            if($projectTodolistDelete -> user_id == $user_id)
            {
                $projectTodolistDelete = $this->projectTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Project Todolist Delete updated successfully.');
                return redirect(route('projectTodolistDeletes.index'));
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
            $projectTodolistDelete = $this->projectTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTodolistDelete))
            {
                Flash::error('Project Todolist Delete not found');
                return redirect(route('projectTodolistDeletes.index'));
            }
            
            if($projectTodolistDelete -> user_id == $user_id)
            {
                $this->projectTodolistDeleteRepository->delete($id);
            
                Flash::success('Project Todolist Delete deleted successfully.');
                return redirect(route('projectTodolistDeletes.index'));
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