<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSFileTodolistCreateRequest;
use App\Http\Requests\UpdateProjectTSFileTodolistCreateRequest;
use App\Repositories\ProjectTSFileTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSFileTodolistCreateController extends AppBaseController
{
    private $projectTSFileTodolistCreateRepository;

    public function __construct(ProjectTSFileTodolistCreateRepository $projectTSFileTodolistCreateRepo)
    {
        $this->projectTSFileTodolistCreateRepository = $projectTSFileTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSFileTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSFileTodolistCreates = $this->projectTSFileTodolistCreateRepository->all();
    
            return view('project_t_s_file_todolist_creates.index')
                ->with('projectTSFileTodolistCreates', $projectTSFileTodolistCreates);
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
            return view('project_t_s_file_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSFileTodolistCreate = $this->projectTSFileTodolistCreateRepository->create($input);
    
            Flash::success('Project T S File Todolist Create saved successfully.');
            return redirect(route('projectTSFileTodolistCreates.index'));
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
            $projectTSFileTodolistCreate = $this->projectTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistCreate))
            {
                Flash::error('Project T S File Todolist Create not found');
                return redirect(route('projectTSFileTodolistCreates.index'));
            }
            
            if($projectTSFileTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_file_todolist_creates.show')
                    ->with('projectTSFileTodolistCreate', $projectTSFileTodolistCreate);
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
            $projectTSFileTodolistCreate = $this->projectTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistCreate))
            {
                Flash::error('Project T S File Todolist Create not found');
                return redirect(route('projectTSFileTodolistCreates.index'));
            }
            
            if($projectTSFileTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_file_todolist_creates.edit')->with('projectTSFileTodolistCreate', $projectTSFileTodolistCreate);
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

    public function update($id, UpdateProjectTSFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSFileTodolistCreate = $this->projectTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistCreate))
            {
                Flash::error('Project T S File Todolist Create not found');
                return redirect(route('projectTSFileTodolistCreates.index'));
            }
            
            if($projectTSFileTodolistCreate -> user_id == $user_id)
            {
                $projectTSFileTodolistCreate = $this->projectTSFileTodolistCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S File Todolist Create updated successfully.');
                return redirect(route('projectTSFileTodolistCreates.index'));
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
            $projectTSFileTodolistCreate = $this->projectTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistCreate))
            {
                Flash::error('Project T S File Todolist Create not found');
                return redirect(route('projectTSFileTodolistCreates.index'));
            }
            
            if($projectTSFileTodolistCreate -> user_id == $user_id)
            {
                $this->projectTSFileTodolistCreateRepository->delete($id);
                
                Flash::success('Project T S File Todolist Create deleted successfully.');
                return redirect(route('projectTSFileTodolistCreates.index'));
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