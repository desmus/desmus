<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSToolTodolistViewRequest;
use App\Http\Requests\UpdateProjectTSToolTodolistViewRequest;
use App\Repositories\ProjectTSToolTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSToolTodolistViewController extends AppBaseController
{
    private $projectTSToolTodolistViewRepository;

    public function __construct(ProjectTSToolTodolistViewRepository $projectTSToolTodolistViewRepo)
    {
        $this->projectTSToolTodolistViewRepository = $projectTSToolTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSToolTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSToolTodolistViews = $this->projectTSToolTodolistViewRepository->all();
    
            return view('project_t_s_tool_todolist_views.index')
                ->with('projectTSToolTodolistViews', $projectTSToolTodolistViews);
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
            return view('project_t_s_tool_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSToolTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSToolTodolistView = $this->projectTSToolTodolistViewRepository->create($input);
    
            Flash::success('Project T S Tool Todolist View saved successfully.');
            return redirect(route('projectTSToolTodolistViews.index'));
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
            $projectTSToolTodolistView = $this->projectTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistView))
            {
                Flash::error('Project T S Tool Todolist View not found');
                return redirect(route('projectTSToolTodolistViews.index'));
            }
            
            if($projectTSToolTodolistView -> user_id == $user_id)
            {
                return view('project_t_s_tool_todolist_views.show')->with('projectTSToolTodolistView', $projectTSToolTodolistView);
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
            $projectTSToolTodolistView = $this->projectTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistView))
            {
                Flash::error('Project T S Tool Todolist View not found');
                return redirect(route('projectTSToolTodolistViews.index'));
            }
            
            if($projectTSToolTodolistView -> user_id == $user_id)
            {
                return view('project_t_s_tool_todolist_views.edit')->with('projectTSToolTodolistView', $projectTSToolTodolistView);
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

    public function update($id, UpdateProjectTSToolTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSToolTodolistView = $this->projectTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistView))
            {
                Flash::error('Project T S Tool Todolist View not found');
                return redirect(route('projectTSToolTodolistViews.index'));
            }
            
            if($projectTSToolTodolistView -> user_id == $user_id)
            {
                $projectTSToolTodolistView = $this->projectTSToolTodolistViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S Tool Todolist View updated successfully.');
                return redirect(route('projectTSToolTodolistViews.index'));
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
            $projectTSToolTodolistView = $this->projectTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSToolTodolistView))
            {
                Flash::error('Project T S Tool Todolist View not found');
                return redirect(route('projectTSToolTodolistViews.index'));
            }
            
            if($projectTSToolTodolistView -> user_id == $user_id)
            {
                $this->projectTSToolTodolistViewRepository->delete($id);
                
                Flash::success('Project T S Tool Todolist View deleted successfully.');
                return redirect(route('projectTSToolTodolistViews.index'));
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