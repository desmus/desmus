<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSFileTodolistViewRequest;
use App\Http\Requests\UpdateProjectTSFileTodolistViewRequest;
use App\Repositories\ProjectTSFileTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSFileTodolistViewController extends AppBaseController
{
    private $projectTSFileTodolistViewRepository;

    public function __construct(ProjectTSFileTodolistViewRepository $projectTSFileTodolistViewRepo)
    {
        $this->projectTSFileTodolistViewRepository = $projectTSFileTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSFileTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSFileTodolistViews = $this->projectTSFileTodolistViewRepository->all();
    
            return view('project_t_s_file_todolist_views.index')
                ->with('projectTSFileTodolistViews', $projectTSFileTodolistViews);
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
            return view('project_t_s_file_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSFileTodolistView = $this->projectTSFileTodolistViewRepository->create($input);
    
            Flash::success('Project T S File Todolist View saved successfully.');
            return redirect(route('projectTSFileTodolistViews.index'));
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
            $projectTSFileTodolistView = $this->projectTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistView))
            {
                Flash::error('Project T S File Todolist View not found');
                return redirect(route('projectTSFileTodolistViews.index'));
            }
            
            if($projectTSFileTodolistView -> user_id == $user_id)
            {
                return view('project_t_s_file_todolist_views.show')
                    ->with('projectTSFileTodolistView', $projectTSFileTodolistView);
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
            $projectTSFileTodolistView = $this->projectTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistView))
            {
                Flash::error('Project T S File Todolist View not found');
                return redirect(route('projectTSFileTodolistViews.index'));
            }
            
            if($projectTSFileTodolistView -> user_id == $user_id)
            {
                return view('project_t_s_file_todolist_views.edit')
                    ->with('projectTSFileTodolistView', $projectTSFileTodolistView);
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
    
    public function update($id, UpdateProjectTSFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $projectTSFileTodolistView = $this->projectTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistView))
            {
                Flash::error('Project T S File Todolist View not found');
                return redirect(route('projectTSFileTodolistViews.index'));
            }
            
            if($projectTSFileTodolistView -> user_id == $user_id)
            {
                $projectTSFileTodolistView = $this->projectTSFileTodolistViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S File Todolist View updated successfully.');
                return redirect(route('projectTSFileTodolistViews.index'));
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
            $projectTSFileTodolistView = $this->projectTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSFileTodolistView))
            {
                Flash::error('Project T S File Todolist View not found');
                return redirect(route('projectTSFileTodolistViews.index'));
            }
            
            if($projectTSFileTodolistView -> user_id == $user_id)
            {
                $this->projectTSFileTodolistViewRepository->delete($id);
                
                Flash::success('Project T S File Todolist View deleted successfully.');
                return redirect(route('projectTSFileTodolistViews.index'));
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