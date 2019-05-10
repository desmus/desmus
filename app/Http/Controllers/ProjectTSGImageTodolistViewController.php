<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectTSGImageTodolistViewRequest;
use App\Http\Requests\UpdateProjectTSGImageTodolistViewRequest;
use App\Repositories\ProjectTSGImageTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGImageTodolistViewController extends AppBaseController
{
    private $projectTSGImageTodolistViewRepository;

    public function __construct(ProjectTSGImageTodolistViewRepository $projectTSGImageTodolistViewRepo)
    {
        $this->projectTSGImageTodolistViewRepository = $projectTSGImageTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGImageTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGImageTodolistViews = $this->projectTSGImageTodolistViewRepository->all();
    
            return view('project_t_s_g_image_todolist_views.index')
                ->with('projectTSGImageTodolistViews', $projectTSGImageTodolistViews);
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
            return view('project_t_s_g_image_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGImageTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSGImageTodolistView = $this->projectTSGImageTodolistViewRepository->create($input);
    
            Flash::success('Project T S G Image Todolist View saved successfully.');
            return redirect(route('projectTSGImageTodolistViews.index'));
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
            $projectTSGImageTodolistView = $this->projectTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistView))
            {
                Flash::error('Project T S G Image Todolist View not found');
                return redirect(route('projectTSGImageTodolistViews.index'));
            }
    
            if($projectTSGImageTodolistView -> user_id == $user_id)
            {
                return view('project_t_s_g_image_todolist_views.show')
                    ->with('projectTSGImageTodolistView', $projectTSGImageTodolistView);
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
            $projectTSGImageTodolistView = $this->projectTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistView))
            {
                Flash::error('Project T S G Image Todolist View not found');
                return redirect(route('projectTSGImageTodolistViews.index'));
            }
    
            if($projectTSGImageTodolistView -> user_id == $user_id)
            {
                return view('project_t_s_g_image_todolist_views.edit')
                    ->with('projectTSGImageTodolistView', $projectTSGImageTodolistView);
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

    public function update($id, UpdateProjectTSGImageTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGImageTodolistView = $this->projectTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistView))
            {
                Flash::error('Project T S G Image Todolist View not found');
                return redirect(route('projectTSGImageTodolistViews.index'));
            }
            
            if($projectTSGImageTodolistView -> user_id == $user_id)
            {
                $projectTSGImageTodolistView = $this->projectTSGImageTodolistViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S G Image Todolist View updated successfully.');
                return redirect(route('projectTSGImageTodolistViews.index'));
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
            $projectTSGImageTodolistView = $this->projectTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistView))
            {
                Flash::error('Project T S G Image Todolist View not found');
                return redirect(route('projectTSGImageTodolistViews.index'));
            }
            
            if($projectTSGImageTodolistView -> user_id == $user_id)
            {
                $this->projectTSGImageTodolistViewRepository->delete($id);
                
                Flash::success('Project T S G Image Todolist View deleted successfully.');
                return redirect(route('projectTSGImageTodolistViews.index'));
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