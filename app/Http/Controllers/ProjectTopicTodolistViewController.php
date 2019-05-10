<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicTodolistViewRequest;
use App\Http\Requests\UpdateProjectTopicTodolistViewRequest;
use App\Repositories\ProjectTopicTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicTodolistViewController extends AppBaseController
{
    private $projectTopicTodolistViewRepository;

    public function __construct(ProjectTopicTodolistViewRepository $projectTopicTodolistViewRepo)
    {
        $this->projectTopicTodolistViewRepository = $projectTopicTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicTodolistViews = $this->projectTopicTodolistViewRepository->all();
    
            return view('project_topic_todolist_views.index')
                ->with('projectTopicTodolistViews', $projectTopicTodolistViews);
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
            return view('project_topic_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTopicTodolistView = $this->projectTopicTodolistViewRepository->create($input);
    
            Flash::success('Project Topic Todolist View saved successfully.');
            return redirect(route('projectTopicTodolistViews.index'));
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
            $projectTopicTodolistView = $this->projectTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistView))
            {
                Flash::error('Project Topic Todolist View not found');
                return redirect(route('projectTopicTodolistViews.index'));
            }
            
            if($projectTopicTodolistView -> user_id == $user_id)
            {
                return view('project_topic_todolist_views.show')
                    ->with('projectTopicTodolistView', $projectTopicTodolistView);
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
            $projectTopicTodolistView = $this->projectTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistView))
            {
                Flash::error('Project Topic Todolist View not found');
                return redirect(route('projectTopicTodolistViews.index'));
            }
    
            if($projectTopicTodolistView -> user_id == $user_id)
            {
                return view('project_topic_todolist_views.edit')
                    ->with('projectTopicTodolistView', $projectTopicTodolistView);
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

    public function update($id, UpdateProjectTopicTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicTodolistView = $this->projectTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistView))
            {
                Flash::error('Project Topic Todolist View not found');
                return redirect(route('projectTopicTodolistViews.index'));
            }
            
            if($projectTopicTodolistView -> user_id == $user_id)
            {
                $projectTopicTodolistView = $this->projectTopicTodolistViewRepository->update($request->all(), $id);
                
                Flash::success('Project Topic Todolist View updated successfully.');
                return redirect(route('projectTopicTodolistViews.index'));
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
            $projectTopicTodolistView = $this->projectTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistView))
            {
                Flash::error('Project Topic Todolist View not found');
                return redirect(route('projectTopicTodolistViews.index'));
            }
    
            if($projectTopicTodolistView -> user_id == $user_id)
            {
                $this->projectTopicTodolistViewRepository->delete($id);
                
                Flash::success('Project Topic Todolist View deleted successfully.');
                return redirect(route('projectTopicTodolistViews.index'));
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