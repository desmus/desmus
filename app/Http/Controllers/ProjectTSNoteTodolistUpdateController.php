<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSNoteTodolistUpdateRequest;
use App\Http\Requests\UpdateProjectTSNoteTodolistUpdateRequest;
use App\Repositories\ProjectTSNoteTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSNoteTodolistUpdateController extends AppBaseController
{
    private $projectTSNoteTodolistUpdateRepository;

    public function __construct(ProjectTSNoteTodolistUpdateRepository $projectTSNoteTodolistUpdateRepo)
    {
        $this->projectTSNoteTodolistUpdateRepository = $projectTSNoteTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSNoteTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSNoteTodolistUpdates = $this->projectTSNoteTodolistUpdateRepository->all();
    
            return view('project_t_s_note_todolist_updates.index')
                ->with('projectTSNoteTodolistUpdates', $projectTSNoteTodolistUpdates);
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
            return view('project_t_s_note_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSNoteTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSNoteTodolistUpdate = $this->projectTSNoteTodolistUpdateRepository->create($input);
    
            Flash::success('Project T S Note Todolist Update saved successfully.');
            return redirect(route('projectTSNoteTodolistUpdates.index'));
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
            $projectTSNoteTodolistUpdate = $this->projectTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistUpdate))
            {
                Flash::error('Project T S Note Todolist Update not found');
                return redirect(route('projectTSNoteTodolistUpdates.index'));
            }
    
            if($projectTSNoteTodolistUpdate -> user_id == $user_id)
            {
              return view('project_t_s_note_todolist_updates.show')->with('projectTSNoteTodolistUpdate', $projectTSNoteTodolistUpdate);
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
            $projectTSNoteTodolistUpdate = $this->projectTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistUpdate))
            {
                Flash::error('Project T S Note Todolist Update not found');
                return redirect(route('projectTSNoteTodolistUpdates.index'));
            }
    
            if($projectTSNoteTodolistUpdate -> user_id == $user_id)
            {
              return view('project_t_s_note_todolist_updates.edit')->with('projectTSNoteTodolistUpdate', $projectTSNoteTodolistUpdate);
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

    public function update($id, UpdateProjectTSNoteTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSNoteTodolistUpdate = $this->projectTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistUpdate))
            {
                Flash::error('Project T S Note Todolist Update not found');
                return redirect(route('projectTSNoteTodolistUpdates.index'));
            }
    
            if($projectTSNoteTodolistUpdate -> user_id == $user_id)
            {
                $projectTSNoteTodolistUpdate = $this->projectTSNoteTodolistUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Note Todolist Update updated successfully.');
                return redirect(route('projectTSNoteTodolistUpdates.index'));
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
            $projectTSNoteTodolistUpdate = $this->projectTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistUpdate))
            {
                Flash::error('Project T S Note Todolist Update not found');
                return redirect(route('projectTSNoteTodolistUpdates.index'));
            }
    
            if($projectTSNoteTodolistUpdate -> user_id == $user_id)
            {
                $this->projectTSNoteTodolistUpdateRepository->delete($id);
                
                Flash::success('Project T S Note Todolist Update deleted successfully.');
                return redirect(route('projectTSNoteTodolistUpdates.index'));
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