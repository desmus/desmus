<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolFileTodolistViewRequest;
use App\Http\Requests\UpdateProjectTSToolFileTodolistViewRequest;
use App\Repositories\ProjectTSToolFileTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolFileTodolistViewController extends AppBaseController
{
    private $projectTSToolFileTodolistViewRepository;

    public function __construct(ProjectTSToolFileTodolistViewRepository $projectTSToolFileTodolistViewRepo)
    {
        $this->projectTSToolFileTodolistViewRepository = $projectTSToolFileTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolFileTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolFileTodolistViews = $this->projectTSToolFileTodolistViewRepository->all();
    
            return view('project_t_s_tool_file_todolist_views.index')
                ->with('projectTSToolFileTodolistViews', $projectTSToolFileTodolistViews);
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
            return view('project_t_s_tool_file_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSToolFileTodolistView = $this->projectTSToolFileTodolistViewRepository->create($input);
    
            Flash::success('Project T S Tool File Todolist View saved successfully.');
            return redirect(route('projectTSToolFileTodolistViews.index'));
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
            $projectTSToolFileTodolistView = $this->projectTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistView))
            {
                Flash::error('Project T S Tool File Todolist View not found');
                return redirect(route('projectTSToolFileTodolistViews.index'));
            }
            
            if($projectTSToolFileTodolistView -> user_id == $user_id)
            {  
                return view('project_t_s_tool_file_todolist_views.show')->with('projectTSToolFileTodolistView', $projectTSToolFileTodolistView);
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
            $projectTSToolFileTodolistView = $this->projectTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistView))
            {
                Flash::error('Project T S Tool File Todolist View not found');
                return redirect(route('projectTSToolFileTodolistViews.index'));
            }
    
            if($projectTSToolFileTodolistView -> user_id == $user_id)
            {
                return view('project_t_s_tool_file_todolist_views.edit')->with('projectTSToolFileTodolistView', $projectTSToolFileTodolistView);
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

    public function update($id, UpdateProjectTSToolFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolFileTodolistView = $this->projectTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistView))
            {
                Flash::error('Project T S Tool File Todolist View not found');
                return redirect(route('projectTSToolFileTodolistViews.index'));
            }
    
            if($projectTSToolFileTodolistView -> user_id == $user_id)
            {
                $projectTSToolFileTodolistView = $this->projectTSToolFileTodolistViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool File Todolist View updated successfully.');
                return redirect(route('projectTSToolFileTodolistViews.index'));
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
            $projectTSToolFileTodolistView = $this->projectTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolFileTodolistView))
            {
                Flash::error('Project T S Tool File Todolist View not found');
                return redirect(route('projectTSToolFileTodolistViews.index'));
            }
            
            if($projectTSToolFileTodolistView -> user_id == $user_id)
            {
                $this->projectTSToolFileTodolistViewRepository->delete($id);
                
                Flash::success('Project T S Tool File Todolist View deleted successfully.');
                return redirect(route('projectTSToolFileTodolistViews.index'));
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