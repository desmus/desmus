<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryTodolistCreateRequest;
use App\Http\Requests\UpdateProjectTSGaleryTodolistCreateRequest;
use App\Repositories\ProjectTSGaleryTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryTodolistCreateController extends AppBaseController
{
    private $projectTSGaleryTodolistCreateRepository;

    public function __construct(ProjectTSGaleryTodolistCreateRepository $projectTSGaleryTodolistCreateRepo)
    {
        $this->projectTSGaleryTodolistCreateRepository = $projectTSGaleryTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryTodolistCreates = $this->projectTSGaleryTodolistCreateRepository->all();
    
            return view('project_t_s_galery_todolist_creates.index')
                ->with('projectTSGaleryTodolistCreates', $projectTSGaleryTodolistCreates);
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
            return view('project_t_s_galery_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSGaleryTodolistCreate = $this->projectTSGaleryTodolistCreateRepository->create($input);
    
            Flash::success('Project T S Galery Todolist Create saved successfully.');
            return redirect(route('projectTSGaleryTodolistCreates.index'));
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
            $projectTSGaleryTodolistCreate = $this->projectTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistCreate))
            {
                Flash::error('Project T S Galery Todolist Create not found');
                return redirect(route('projectTSGaleryTodolistCreates.index'));
            }
            
            if($projectTSGaleryTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_galery_todolist_creates.show')->with('projectTSGaleryTodolistCreate', $projectTSGaleryTodolistCreate);
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
            $projectTSGaleryTodolistCreate = $this->projectTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistCreate))
            {
                Flash::error('Project T S Galery Todolist Create not found');
                return redirect(route('projectTSGaleryTodolistCreates.index'));
            }
    
            if($projectTSGaleryTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_galery_todolist_creates.edit')->with('projectTSGaleryTodolistCreate', $projectTSGaleryTodolistCreate);
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

    public function update($id, UpdateProjectTSGaleryTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryTodolistCreate = $this->projectTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistCreate))
            {
                Flash::error('Project T S Galery Todolist Create not found');
                return redirect(route('projectTSGaleryTodolistCreates.index'));
            }
            
            if($projectTSGaleryTodolistCreate -> user_id == $user_id)
            {
                $projectTSGaleryTodolistCreate = $this->projectTSGaleryTodolistCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery Todolist Create updated successfully.');
                return redirect(route('projectTSGaleryTodolistCreates.index'));
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
            $projectTSGaleryTodolistCreate = $this->projectTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistCreate))
            {
                Flash::error('Project T S Galery Todolist Create not found');
                return redirect(route('projectTSGaleryTodolistCreates.index'));
            }
    
            if($projectTSGaleryTodolistCreate -> user_id == $user_id)
            {
                $this->projectTSGaleryTodolistCreateRepository->delete($id);
                
                Flash::success('Project T S Galery Todolist Create deleted successfully.');
                return redirect(route('projectTSGaleryTodolistCreates.index'));
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