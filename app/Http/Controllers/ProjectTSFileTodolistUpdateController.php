<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSFileTodolistUpdateRequest;
use App\Http\Requests\UpdateProjectTSFileTodolistUpdateRequest;
use App\Repositories\ProjectTSFileTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSFileTodolistUpdateController extends AppBaseController
{
    private $projectTSFileTodolistUpdateRepository;

    public function __construct(ProjectTSFileTodolistUpdateRepository $projectTSFileTodolistUpdateRepo)
    {
        $this->projectTSFileTodolistUpdateRepository = $projectTSFileTodolistUpdateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSFileTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSFileTodolistUpdates = $this->projectTSFileTodolistUpdateRepository->all();
    
            return view('project_t_s_file_todolist_updates.index')
                ->with('projectTSFileTodolistUpdates', $projectTSFileTodolistUpdates);
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
            return view('project_t_s_file_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(CreateProjectTSFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSFileTodolistUpdate = $this->projectTSFileTodolistUpdateRepository->create($input);
    
            Flash::success('Project T S File Todolist Update saved successfully.');
            return redirect(route('projectTSFileTodolistUpdates.index'));
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
            $projectTSFileTodolistUpdate = $this->projectTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistUpdate))
            {
                Flash::error('Project T S File Todolist Update not found');
                return redirect(route('projectTSFileTodolistUpdates.index'));
            }
    
            if($projectTSFileTodolistUpdate -> user_id == $user_id)
            {
                return view('project_t_s_file_todolist_updates.show')->with('projectTSFileTodolistUpdate', $projectTSFileTodolistUpdate);
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
            $projectTSFileTodolistUpdate = $this->projectTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistUpdate))
            {
                Flash::error('Project T S File Todolist Update not found');
                return redirect(route('projectTSFileTodolistUpdates.index'));
            }
    
            if($projectTSFileTodolistUpdate -> user_id == $user_id)
            {
                return view('project_t_s_file_todolist_updates.edit')->with('projectTSFileTodolistUpdate', $projectTSFileTodolistUpdate);
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
    
    public function update($id, UpdateProjectTSFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSFileTodolistUpdate = $this->projectTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistUpdate))
            {
                Flash::error('Project T S File Todolist Update not found');
                return redirect(route('projectTSFileTodolistUpdates.index'));
            }
    
            if($projectTSFileTodolistUpdate -> user_id == $user_id)
            {
                $projectTSFileTodolistUpdate = $this->projectTSFileTodolistUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S File Todolist Update updated successfully.');
                return redirect(route('projectTSFileTodolistUpdates.index'));
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
            $projectTSFileTodolistUpdate = $this->projectTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistUpdate))
            {
                Flash::error('Project T S File Todolist Update not found');
                return redirect(route('projectTSFileTodolistUpdates.index'));
            }
            
            if($projectTSFileTodolistUpdate -> user_id == $user_id)
            {
                $this->projectTSFileTodolistUpdateRepository->delete($id);
                
                Flash::success('Project T S File Todolist Update deleted successfully.');
                return redirect(route('projectTSFileTodolistUpdates.index'));
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