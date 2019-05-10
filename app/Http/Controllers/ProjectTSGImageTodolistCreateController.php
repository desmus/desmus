<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGImageTodolistCreateRequest;
use App\Http\Requests\UpdateProjectTSGImageTodolistCreateRequest;
use App\Repositories\ProjectTSGImageTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGImageTodolistCreateController extends AppBaseController
{
    private $projectTSGImageTodolistCreateRepository;

    public function __construct(ProjectTSGImageTodolistCreateRepository $projectTSGImageTodolistCreateRepo)
    {
        $this->projectTSGImageTodolistCreateRepository = $projectTSGImageTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGImageTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGImageTodolistCreates = $this->projectTSGImageTodolistCreateRepository->all();
    
            return view('project_t_s_g_image_todolist_creates.index')
                ->with('projectTSGImageTodolistCreates', $projectTSGImageTodolistCreates);
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
            return view('project_t_s_g_image_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGImageTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSGImageTodolistCreate = $this->projectTSGImageTodolistCreateRepository->create($input);
    
            Flash::success('Project T S G Image Todolist Create saved successfully.');
            return redirect(route('projectTSGImageTodolistCreates.index'));
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
            $projectTSGImageTodolistCreate = $this->projectTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistCreate))
            {
                Flash::error('Project T S G Image Todolist Create not found');
                return redirect(route('projectTSGImageTodolistCreates.index'));
            }
            
            if($projectTSGImageTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_g_image_todolist_creates.show')->with('projectTSGImageTodolistCreate', $projectTSGImageTodolistCreate);
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
            $projectTSGImageTodolistCreate = $this->projectTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistCreate))
            {
                Flash::error('Project T S G Image Todolist Create not found');
                return redirect(route('projectTSGImageTodolistCreates.index'));
            }
            
            if($projectTSGImageTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_g_image_todolist_creates.edit')->with('projectTSGImageTodolistCreate', $projectTSGImageTodolistCreate);
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

    public function update($id, UpdateProjectTSGImageTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGImageTodolistCreate = $this->projectTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistCreate))
            {
                Flash::error('Project T S G Image Todolist Create not found');
                return redirect(route('projectTSGImageTodolistCreates.index'));
            }
            
            if($projectTSGImageTodolistCreate -> user_id == $user_id)
            {
                $projectTSGImageTodolistCreate = $this->projectTSGImageTodolistCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S G Image Todolist Create updated successfully.');
                return redirect(route('projectTSGImageTodolistCreates.index'));
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
            $projectTSGImageTodolistCreate = $this->projectTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistCreate))
            {
                Flash::error('Project T S G Image Todolist Create not found');
                return redirect(route('projectTSGImageTodolistCreates.index'));
            }
    
            if($projectTSGImageTodolistCreate -> user_id == $user_id)
            {
                $this->projectTSGImageTodolistCreateRepository->delete($id);
                
                Flash::success('Project T S G Image Todolist Create deleted successfully.');
                return redirect(route('projectTSGImageTodolistCreates.index'));
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