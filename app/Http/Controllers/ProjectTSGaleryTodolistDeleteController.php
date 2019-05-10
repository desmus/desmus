<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryTodolistDeleteRequest;
use App\Http\Requests\UpdateProjectTSGaleryTodolistDeleteRequest;
use App\Repositories\ProjectTSGaleryTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryTodolistDeleteController extends AppBaseController
{
    private $projectTSGaleryTodolistDeleteRepository;

    public function __construct(ProjectTSGaleryTodolistDeleteRepository $projectTSGaleryTodolistDeleteRepo)
    {
        $this->projectTSGaleryTodolistDeleteRepository = $projectTSGaleryTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryTodolistDeletes = $this->projectTSGaleryTodolistDeleteRepository->all();
    
            return view('project_t_s_galery_todolist_deletes.index')
                ->with('projectTSGaleryTodolistDeletes', $projectTSGaleryTodolistDeletes);
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
            return view('project_t_s_galery_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSGaleryTodolistDelete = $this->projectTSGaleryTodolistDeleteRepository->create($input);
    
            Flash::success('Project T S Galery Todolist Delete saved successfully.');
            return redirect(route('projectTSGaleryTodolistDeletes.index'));
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
            $projectTSGaleryTodolistDelete = $this->projectTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistDelete))
            {
                Flash::error('Project T S Galery Todolist Delete not found');
                return redirect(route('projectTSGaleryTodolistDeletes.index'));
            }
            
            if($projectTSGaleryTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_galery_todolist_deletes.show')->with('projectTSGaleryTodolistDelete', $projectTSGaleryTodolistDelete);
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
            $projectTSGaleryTodolistDelete = $this->projectTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistDelete))
            {
                Flash::error('Project T S Galery Todolist Delete not found');
                return redirect(route('projectTSGaleryTodolistDeletes.index'));
            }
    
            if($projectTSGaleryTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_galery_todolist_deletes.edit')->with('projectTSGaleryTodolistDelete', $projectTSGaleryTodolistDelete);
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

    public function update($id, UpdateProjectTSGaleryTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryTodolistDelete = $this->projectTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistDelete))
            {
                Flash::error('Project T S Galery Todolist Delete not found');
                return redirect(route('projectTSGaleryTodolistDeletes.index'));
            }
    
            if($projectTSGaleryTodolistDelete -> user_id == $user_id)
            {
                $projectTSGaleryTodolistDelete = $this->projectTSGaleryTodolistDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery Todolist Delete updated successfully.');
                return redirect(route('projectTSGaleryTodolistDeletes.index'));
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
            $projectTSGaleryTodolistDelete = $this->projectTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistDelete))
            {
                Flash::error('Project T S Galery Todolist Delete not found');
                return redirect(route('projectTSGaleryTodolistDeletes.index'));
            }
    
            if($projectTSGaleryTodolistDelete -> user_id == $user_id)
            {
                $this->projectTSGaleryTodolistDeleteRepository->delete($id);
                
                Flash::success('Project T S Galery Todolist Delete deleted successfully.');
                return redirect(route('projectTSGaleryTodolistDeletes.index'));
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