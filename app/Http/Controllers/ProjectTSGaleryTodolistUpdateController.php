<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryTodolistUpdateRequest;
use App\Http\Requests\UpdateProjectTSGaleryTodolistUpdateRequest;
use App\Repositories\ProjectTSGaleryTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryTodolistUpdateController extends AppBaseController
{
    private $projectTSGaleryTodolistUpdateRepository;

    public function __construct(ProjectTSGaleryTodolistUpdateRepository $projectTSGaleryTodolistUpdateRepo)
    {
        $this->projectTSGaleryTodolistUpdateRepository = $projectTSGaleryTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryTodolistUpdates = $this->projectTSGaleryTodolistUpdateRepository->all();
    
            return view('project_t_s_galery_todolist_updates.index')
                ->with('projectTSGaleryTodolistUpdates', $projectTSGaleryTodolistUpdates);
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
            return view('project_t_s_galery_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSGaleryTodolistUpdate = $this->projectTSGaleryTodolistUpdateRepository->create($input);
    
            Flash::success('Project T S Galery Todolist Update saved successfully.');
            return redirect(route('projectTSGaleryTodolistUpdates.index'));
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
            $projectTSGaleryTodolistUpdate = $this->projectTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistUpdate))
            {
                Flash::error('Project T S Galery Todolist Update not found');
                return redirect(route('projectTSGaleryTodolistUpdates.index'));
            }
    
            if($projectTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                return view('project_t_s_galery_todolist_updates.show')->with('projectTSGaleryTodolistUpdate', $projectTSGaleryTodolistUpdate);
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
            $projectTSGaleryTodolistUpdate = $this->projectTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistUpdate))
            {
                Flash::error('Project T S Galery Todolist Update not found');
                return redirect(route('projectTSGaleryTodolistUpdates.index'));
            }
            
            if($projectTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                return view('project_t_s_galery_todolist_updates.edit')->with('projectTSGaleryTodolistUpdate', $projectTSGaleryTodolistUpdate);
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

    public function update($id, UpdateProjectTSGaleryTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryTodolistUpdate = $this->projectTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistUpdate))
            {
                Flash::error('Project T S Galery Todolist Update not found');
                return redirect(route('projectTSGaleryTodolistUpdates.index'));
            }
    
            if($projectTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                $projectTSGaleryTodolistUpdate = $this->projectTSGaleryTodolistUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery Todolist Update updated successfully.');
                return redirect(route('projectTSGaleryTodolistUpdates.index'));
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
            $projectTSGaleryTodolistUpdate = $this->projectTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistUpdate))
            {
                Flash::error('Project T S Galery Todolist Update not found');
                return redirect(route('projectTSGaleryTodolistUpdates.index'));
            }
    
            if($projectTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                $this->projectTSGaleryTodolistUpdateRepository->delete($id);
                
                Flash::success('Project T S Galery Todolist Update deleted successfully.');
                return redirect(route('projectTSGaleryTodolistUpdates.index'));
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