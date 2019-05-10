<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTodolistViewRequest;
use App\Http\Requests\UpdateProjectTodolistViewRequest;
use App\Repositories\ProjectTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTodolistViewController extends AppBaseController
{
    private $projectTodolistViewRepository;

    public function __construct(ProjectTodolistViewRepository $projectTodolistViewRepo)
    {
        $this->projectTodolistViewRepository = $projectTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTodolistViews = $this->projectTodolistViewRepository->all();
    
            return view('project_todolist_views.index')
                ->with('projectTodolistViews', $projectTodolistViews);
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
            return view('project_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTodolistView = $this->projectTodolistViewRepository->create($input);
    
            Flash::success('Project Todolist View saved successfully.');
            return redirect(route('projectTodolistViews.index'));
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
            $projectTodolistView = $this->projectTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTodolistView))
            {
                Flash::error('Project Todolist View not found');
                return redirect(route('projectTodolistViews.index'));
            }
    
            if($projectTodolistView -> user_id == $user_id)
            {  
                return view('project_todolist_views.show')->with('projectTodolistView', $projectTodolistView);
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
            $projectTodolistView = $this->projectTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTodolistView))
            {
                Flash::error('Project Todolist View not found');
                return redirect(route('projectTodolistViews.index'));
            }
            
            if($projectTodolistView -> user_id == $user_id)
            {
                return view('project_todolist_views.edit')->with('projectTodolistView', $projectTodolistView);
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

    public function update($id, UpdateProjectTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTodolistView = $this->projectTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTodolistView))
            {
                Flash::error('Project Todolist View not found');
                return redirect(route('projectTodolistViews.index'));
            }
    
            if($projectTodolistView -> user_id == $user_id)
            {
                $projectTodolistView = $this->projectTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('Project Todolist View updated successfully.');
                return redirect(route('projectTodolistViews.index'));
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
            $projectTodolistView = $this->projectTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTodolistView))
            {
                Flash::error('Project Todolist View not found');
                return redirect(route('projectTodolistViews.index'));
            }
            
            if($projectTodolistView -> user_id == $user_id)
            {
                $this->projectTodolistViewRepository->delete($id);
            
                Flash::success('Project Todolist View deleted successfully.');
                return redirect(route('projectTodolistViews.index'));
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