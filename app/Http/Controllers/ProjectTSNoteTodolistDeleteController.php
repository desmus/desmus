<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSNoteTodolistDeleteRequest;
use App\Http\Requests\UpdateProjectTSNoteTodolistDeleteRequest;
use App\Repositories\ProjectTSNoteTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSNoteTodolistDeleteController extends AppBaseController
{
    private $projectTSNoteTodolistDeleteRepository;

    public function __construct(ProjectTSNoteTodolistDeleteRepository $projectTSNoteTodolistDeleteRepo)
    {
        $this->projectTSNoteTodolistDeleteRepository = $projectTSNoteTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSNoteTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSNoteTodolistDeletes = $this->projectTSNoteTodolistDeleteRepository->all();
    
            return view('project_t_s_note_todolist_deletes.index')
                ->with('projectTSNoteTodolistDeletes', $projectTSNoteTodolistDeletes);
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
            return view('project_t_s_note_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSNoteTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSNoteTodolistDelete = $this->projectTSNoteTodolistDeleteRepository->create($input);
    
            Flash::success('Project T S Note Todolist Delete saved successfully.');
            return redirect(route('projectTSNoteTodolistDeletes.index'));
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
            $projectTSNoteTodolistDelete = $this->projectTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistDelete))
            {
                Flash::error('Project T S Note Todolist Delete not found');
                return redirect(route('projectTSNoteTodolistDeletes.index'));
            }
            
            if($projectTSNoteTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_note_todolist_deletes.show')->with('projectTSNoteTodolistDelete', $projectTSNoteTodolistDelete);
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
            $projectTSNoteTodolistDelete = $this->projectTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistDelete))
            {
                Flash::error('Project T S Note Todolist Delete not found');
                return redirect(route('projectTSNoteTodolistDeletes.index'));
            }
    
            if($projectTSNoteTodolistDelete -> user_id == $user_id)
            {
                return view('project_t_s_note_todolist_deletes.edit')->with('projectTSNoteTodolistDelete', $projectTSNoteTodolistDelete);
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

    public function update($id, UpdateProjectTSNoteTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSNoteTodolistDelete = $this->projectTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistDelete))
            {
                Flash::error('Project T S Note Todolist Delete not found');
                return redirect(route('projectTSNoteTodolistDeletes.index'));
            }
            
            if($projectTSNoteTodolistDelete -> user_id == $user_id)
            {
                $projectTSNoteTodolistDelete = $this->projectTSNoteTodolistDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S Note Todolist Delete updated successfully.');
                return redirect(route('projectTSNoteTodolistDeletes.index'));
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
            $projectTSNoteTodolistDelete = $this->projectTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistDelete))
            {
                Flash::error('Project T S Note Todolist Delete not found');
                return redirect(route('projectTSNoteTodolistDeletes.index'));
            }
    
            if($projectTSNoteTodolistDelete -> user_id == $user_id)
            {
                $this->projectTSNoteTodolistDeleteRepository->delete($id);
                
                Flash::success('Project T S Note Todolist Delete deleted successfully.');
                return redirect(route('projectTSNoteTodolistDeletes.index'));
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