<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolFileTodolistUpdateRequest;
use App\Http\Requests\UpdateProjectTSToolFileTodolistUpdateRequest;
use App\Repositories\ProjectTSToolFileTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolFileTodolistUpdateController extends AppBaseController
{
    private $projectTSToolFileTodolistUpdateRepository;

    public function __construct(ProjectTSToolFileTodolistUpdateRepository $projectTSToolFileTodolistUpdateRepo)
    {
        $this->projectTSToolFileTodolistUpdateRepository = $projectTSToolFileTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolFileTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolFileTodolistUpdates = $this->projectTSToolFileTodolistUpdateRepository->all();
    
            return view('project_t_s_tool_file_todolist_updates.index')
                ->with('projectTSToolFileTodolistUpdates', $projectTSToolFileTodolistUpdates);
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
            return view('project_t_s_tool_file_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSToolFileTodolistUpdate = $this->projectTSToolFileTodolistUpdateRepository->create($input);
    
            Flash::success('Project T S Tool File Todolist Update saved successfully.');
            return redirect(route('projectTSToolFileTodolistUpdates.index'));
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
            $projectTSToolFileTodolistUpdate = $this->projectTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistUpdate))
            {
                Flash::error('Project T S Tool File Todolist Update not found');
                return redirect(route('projectTSToolFileTodolistUpdates.index'));
            }
            
            if($projectTSToolFileTodolistUpdate -> user_id == $user_id)
            {
                return view('project_t_s_tool_file_todolist_updates.show')->with('projectTSToolFileTodolistUpdate', $projectTSToolFileTodolistUpdate);
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
            $projectTSToolFileTodolistUpdate = $this->projectTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistUpdate))
            {
                Flash::error('Project T S Tool File Todolist Update not found');
                return redirect(route('projectTSToolFileTodolistUpdates.index'));
            }
    
            if($projectTSToolFileTodolistUpdate -> user_id == $user_id)
            {
                return view('project_t_s_tool_file_todolist_updates.edit')->with('projectTSToolFileTodolistUpdate', $projectTSToolFileTodolistUpdate);
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

    public function update($id, UpdateProjectTSToolFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolFileTodolistUpdate = $this->projectTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistUpdate))
            {
                Flash::error('Project T S Tool File Todolist Update not found');
                return redirect(route('projectTSToolFileTodolistUpdates.index'));
            }
    
            if($projectTSToolFileTodolistUpdate -> user_id == $user_id)
            {
                $projectTSToolFileTodolistUpdate = $this->projectTSToolFileTodolistUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool File Todolist Update updated successfully.');
                return redirect(route('projectTSToolFileTodolistUpdates.index'));
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
            $projectTSToolFileTodolistUpdate = $this->projectTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistUpdate))
            {
                Flash::error('Project T S Tool File Todolist Update not found');
                return redirect(route('projectTSToolFileTodolistUpdates.index'));
            }
    
            if($projectTSToolFileTodolistUpdate -> user_id == $user_id)
            {
                $this->projectTSToolFileTodolistUpdateRepository->delete($id);
            
                Flash::success('Project T S Tool File Todolist Update deleted successfully.');
                return redirect(route('projectTSToolFileTodolistUpdates.index'));
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