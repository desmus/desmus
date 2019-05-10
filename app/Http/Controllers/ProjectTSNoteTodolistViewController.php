<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSNoteTodolistViewRequest;
use App\Http\Requests\UpdateProjectTSNoteTodolistViewRequest;
use App\Repositories\ProjectTSNoteTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSNoteTodolistViewController extends AppBaseController
{
    private $projectTSNoteTodolistViewRepository;

    public function __construct(ProjectTSNoteTodolistViewRepository $projectTSNoteTodolistViewRepo)
    {
        $this->projectTSNoteTodolistViewRepository = $projectTSNoteTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSNoteTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSNoteTodolistViews = $this->projectTSNoteTodolistViewRepository->all();
    
            return view('project_t_s_note_todolist_views.index')
                ->with('projectTSNoteTodolistViews', $projectTSNoteTodolistViews);
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
            return view('project_t_s_note_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSNoteTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSNoteTodolistView = $this->projectTSNoteTodolistViewRepository->create($input);
    
            Flash::success('Project T S Note Todolist View saved successfully.');
            return redirect(route('projectTSNoteTodolistViews.index'));
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
            $projectTSNoteTodolistView = $this->projectTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistView))
            {
                Flash::error('Project T S Note Todolist View not found');
                return redirect(route('projectTSNoteTodolistViews.index'));
            }
    
            if($projectTSNoteTodolistView -> user_id == $user_id)
            {
                return view('project_t_s_note_todolist_views.show')->with('projectTSNoteTodolistView', $projectTSNoteTodolistView);
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
            $projectTSNoteTodolistView = $this->projectTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistView))
            {
                Flash::error('Project T S Note Todolist View not found');
                return redirect(route('projectTSNoteTodolistViews.index'));
            }
    
            if($projectTSNoteTodolistView -> user_id == $user_id)
            {
                return view('project_t_s_note_todolist_views.edit')->with('projectTSNoteTodolistView', $projectTSNoteTodolistView);
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

    public function update($id, UpdateProjectTSNoteTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSNoteTodolistView = $this->projectTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistView))
            {
                Flash::error('Project T S Note Todolist View not found');
                return redirect(route('projectTSNoteTodolistViews.index'));
            }
    
            if($projectTSNoteTodolistView -> user_id == $user_id)
            {
                $projectTSNoteTodolistView = $this->projectTSNoteTodolistViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S Note Todolist View updated successfully.');
                return redirect(route('projectTSNoteTodolistViews.index'));
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
            $projectTSNoteTodolistView = $this->projectTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteTodolistView))
            {
                Flash::error('Project T S Note Todolist View not found');
                return redirect(route('projectTSNoteTodolistViews.index'));
            }
    
            if($projectTSNoteTodolistView -> user_id == $user_id)
            {
                $this->projectTSNoteTodolistViewRepository->delete($id);
                
                Flash::success('Project T S Note Todolist View deleted successfully.');
                return redirect(route('projectTSNoteTodolistViews.index'));
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