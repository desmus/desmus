<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryTodolistViewRequest;
use App\Http\Requests\UpdateProjectTSGaleryTodolistViewRequest;
use App\Repositories\ProjectTSGaleryTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryTodolistViewController extends AppBaseController
{
    private $projectTSGaleryTodolistViewRepository;

    public function __construct(ProjectTSGaleryTodolistViewRepository $projectTSGaleryTodolistViewRepo)
    {
        $this->projectTSGaleryTodolistViewRepository = $projectTSGaleryTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGaleryTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryTodolistViews = $this->projectTSGaleryTodolistViewRepository->all();
    
            return view('project_t_s_galery_todolist_views.index')
                ->with('projectTSGaleryTodolistViews', $projectTSGaleryTodolistViews);
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
            return view('project_t_s_galery_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSGaleryTodolistView = $this->projectTSGaleryTodolistViewRepository->create($input);
    
            Flash::success('Project T S Galery Todolist View saved successfully.');
            return redirect(route('projectTSGaleryTodolistViews.index'));
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
            $projectTSGaleryTodolistView = $this->projectTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistView))
            {
                Flash::error('Project T S Galery Todolist View not found');
                return redirect(route('projectTSGaleryTodolistViews.index'));
            }
            
            if($projectTSGaleryTodolistView -> user_id == $user_id)
            {
                return view('project_t_s_galery_todolist_views.show')->with('projectTSGaleryTodolistView', $projectTSGaleryTodolistView);
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
            $projectTSGaleryTodolistView = $this->projectTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistView))
            {
                Flash::error('Project T S Galery Todolist View not found');
                return redirect(route('projectTSGaleryTodolistViews.index'));
            }
    
            if($projectTSGaleryTodolistView -> user_id == $user_id)
            {
                return view('project_t_s_galery_todolist_views.edit')->with('projectTSGaleryTodolistView', $projectTSGaleryTodolistView);
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

    public function update($id, UpdateProjectTSGaleryTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGaleryTodolistView = $this->projectTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistView))
            {
                Flash::error('Project T S Galery Todolist View not found');
                return redirect(route('projectTSGaleryTodolistViews.index'));
            }
    
            if($projectTSGaleryTodolistView -> user_id == $user_id)
            {
                $projectTSGaleryTodolistView = $this->projectTSGaleryTodolistViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S Galery Todolist View updated successfully.');
                return redirect(route('projectTSGaleryTodolistViews.index'));
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
            $projectTSGaleryTodolistView = $this->projectTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolistView))
            {
                Flash::error('Project T S Galery Todolist View not found');
                return redirect(route('projectTSGaleryTodolistViews.index'));
            }
    
            if($projectTSGaleryTodolistView -> user_id == $user_id)
            {
                $this->projectTSGaleryTodolistViewRepository->delete($id);
                
                Flash::success('Project T S Galery Todolist View deleted successfully.');
                return redirect(route('projectTSGaleryTodolistViews.index'));
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