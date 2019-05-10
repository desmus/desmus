<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGImageTodolistDeleteRequest;
use App\Http\Requests\UpdateProjectTSGImageTodolistDeleteRequest;
use App\Repositories\ProjectTSGImageTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGImageTodolistDeleteController extends AppBaseController
{
    private $projectTSGImageTodolistDeleteRepository;

    public function __construct(ProjectTSGImageTodolistDeleteRepository $projectTSGImageTodolistDeleteRepo)
    {
        $this->projectTSGImageTodolistDeleteRepository = $projectTSGImageTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGImageTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGImageTodolistDeletes = $this->projectTSGImageTodolistDeleteRepository->all();
    
            return view('project_t_s_g_image_todolist_deletes.index')
                ->with('projectTSGImageTodolistDeletes', $projectTSGImageTodolistDeletes);
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
            return view('project_t_s_g_image_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGImageTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSGImageTodolistDelete = $this->projectTSGImageTodolistDeleteRepository->create($input);
    
            Flash::success('Project T S G Image Todolist Delete saved successfully.');
            return redirect(route('projectTSGImageTodolistDeletes.index'));
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
            $projectTSGImageTodolistDelete = $this->projectTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistDelete))
            {
                Flash::error('Project T S G Image Todolist Delete not found');
                return redirect(route('projectTSGImageTodolistDeletes.index'));
            }
            
            if($projectTSGImageTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_g_image_todolist_deletes.show')->with('projectTSGImageTodolistDelete', $projectTSGImageTodolistDelete);
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
            $projectTSGImageTodolistDelete = $this->projectTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistDelete))
            {
                Flash::error('Project T S G Image Todolist Delete not found');
                return redirect(route('projectTSGImageTodolistDeletes.index'));
            }
    
            if($projectTSGImageTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_g_image_todolist_deletes.edit')
                    ->with('projectTSGImageTodolistDelete', $projectTSGImageTodolistDelete);
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

    public function update($id, UpdateProjectTSGImageTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGImageTodolistDelete = $this->projectTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistDelete))
            {
                Flash::error('Project T S G Image Todolist Delete not found');
                return redirect(route('projectTSGImageTodolistDeletes.index'));
            }
            
            if($projectTSGImageTodolistDelete -> user_id == $user_id)
            {
                $projectTSGImageTodolistDelete = $this->projectTSGImageTodolistDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S G Image Todolist Delete updated successfully.');
                return redirect(route('projectTSGImageTodolistDeletes.index'));
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
            $projectTSGImageTodolistDelete = $this->projectTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistDelete))
            {
                Flash::error('Project T S G Image Todolist Delete not found');
                return redirect(route('projectTSGImageTodolistDeletes.index'));
            }
            
            if($projectTSGImageTodolistDelete -> user_id == $user_id)
            {
                $this->projectTSGImageTodolistDeleteRepository->delete($id);
                
                Flash::success('Project T S G Image Todolist Delete deleted successfully.');
                return redirect(route('projectTSGImageTodolistDeletes.index'));
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