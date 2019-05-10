<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSNoteTodolistCreateRequest;
use App\Http\Requests\UpdateProjectTSNoteTodolistCreateRequest;
use App\Repositories\ProjectTSNoteTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSNoteTodolistCreateController extends AppBaseController
{
    private $projectTSNoteTodolistCreateRepository;

    public function __construct(ProjectTSNoteTodolistCreateRepository $projectTSNoteTodolistCreateRepo)
    {
        $this->projectTSNoteTodolistCreateRepository = $projectTSNoteTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSNoteTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSNoteTodolistCreates = $this->projectTSNoteTodolistCreateRepository->all();
    
            return view('project_t_s_note_todolist_creates.index')
                ->with('projectTSNoteTodolistCreates', $projectTSNoteTodolistCreates);
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
            return view('project_t_s_note_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSNoteTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSNoteTodolistCreate = $this->projectTSNoteTodolistCreateRepository->create($input);
    
            Flash::success('Project T S Note Todolist Create saved successfully.');
            return redirect(route('projectTSNoteTodolistCreates.index'));
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
            $projectTSNoteTodolistCreate = $this->projectTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistCreate))
            {
                Flash::error('Project T S Note Todolist Create not found');
                return redirect(route('projectTSNoteTodolistCreates.index'));
            }
    
            if($projectTSNoteTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_note_todolist_creates.show')->with('projectTSNoteTodolistCreate', $projectTSNoteTodolistCreate);
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
            $projectTSNoteTodolistCreate = $this->projectTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistCreate))
            {
                Flash::error('Project T S Note Todolist Create not found');
                return redirect(route('projectTSNoteTodolistCreates.index'));
            }
    
            if($projectTSNoteTodolistCreate -> user_id == $user_id)
            {
                return view('project_t_s_note_todolist_creates.edit')->with('projectTSNoteTodolistCreate', $projectTSNoteTodolistCreate);
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

    public function update($id, UpdateProjectTSNoteTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSNoteTodolistCreate = $this->projectTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistCreate))
            {
                Flash::error('Project T S Note Todolist Create not found');
                return redirect(route('projectTSNoteTodolistCreates.index'));
            }
            
            if($projectTSNoteTodolistCreate -> user_id == $user_id)
            {
                $projectTSNoteTodolistCreate = $this->projectTSNoteTodolistCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Note Todolist Create updated successfully.');
                return redirect(route('projectTSNoteTodolistCreates.index'));
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
            $projectTSNoteTodolistCreate = $this->projectTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistCreate))
            {
                Flash::error('Project T S Note Todolist Create not found');
                return redirect(route('projectTSNoteTodolistCreates.index'));
            }
            
            if($projectTSNoteTodolistCreate -> user_id == $user_id)
            {
                $this->projectTSNoteTodolistCreateRepository->delete($id);
                
                Flash::success('Project T S Note Todolist Create deleted successfully.');
                return redirect(route('projectTSNoteTodolistCreates.index'));
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