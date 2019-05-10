<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTodolistCreateRequest;
use App\Http\Requests\UpdateProjectTodolistCreateRequest;
use App\Repositories\ProjectTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTodolistCreateController extends AppBaseController
{
    private $projectTodolistCreateRepository;

    public function __construct(ProjectTodolistCreateRepository $projectTodolistCreateRepo)
    {
        $this->projectTodolistCreateRepository = $projectTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTodolistCreates = $this->projectTodolistCreateRepository->all();
    
            return view('project_todolist_creates.index')
                ->with('projectTodolistCreates', $projectTodolistCreates);
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
            return view('project_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTodolistCreate = $this->projectTodolistCreateRepository->create($input);
    
            Flash::success('Project Todolist Create saved successfully.');
            return redirect(route('projectTodolistCreates.index'));
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
            $projectTodolistCreate = $this->projectTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTodolistCreate))
            {
                Flash::error('Project Todolist Create not found');
                return redirect(route('projectTodolistCreates.index'));
            }
            
            if($projectTodolistCreate -> user_id == $user_id)
            {
                return view('project_todolist_creates.show')
                    ->with('projectTodolistCreate', $projectTodolistCreate);
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
            $projectTodolistCreate = $this->projectTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTodolistCreate))
            {
                Flash::error('Project Todolist Create not found');
                return redirect(route('projectTodolistCreates.index'));
            }
    
            if($projectTodolistCreate -> user_id == $user_id)
            {
                return view('project_todolist_creates.edit')->with('projectTodolistCreate', $projectTodolistCreate);
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

    public function update($id, UpdateProjectTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTodolistCreate = $this->projectTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTodolistCreate))
            {
                Flash::error('Project Todolist Create not found');
                return redirect(route('projectTodolistCreates.index'));
            }
    
            if($projectTodolistCreate -> user_id == $user_id)
            {
                $projectTodolistCreate = $this->projectTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Project Todolist Create updated successfully.');
                return redirect(route('projectTodolistCreates.index'));
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
            $projectTodolistCreate = $this->projectTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTodolistCreate))
            {
                Flash::error('Project Todolist Create not found');
                return redirect(route('projectTodolistCreates.index'));
            }
            
            if($projectTodolistCreate -> user_id == $user_id)
            {
                $this->projectTodolistCreateRepository->delete($id);
            
                Flash::success('Project Todolist Create deleted successfully.');
                return redirect(route('projectTodolistCreates.index'));
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