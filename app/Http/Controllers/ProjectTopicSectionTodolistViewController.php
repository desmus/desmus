<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicSectionTodolistViewRequest;
use App\Http\Requests\UpdateProjectTopicSectionTodolistViewRequest;
use App\Repositories\ProjectTopicSectionTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicSectionTodolistViewController extends AppBaseController
{
    private $projectTopicSectionTodolistViewRepository;

    public function __construct(ProjectTopicSectionTodolistViewRepository $projectTopicSectionTodolistViewRepo)
    {
        $this->projectTopicSectionTodolistViewRepository = $projectTopicSectionTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicSectionTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicSectionTodolistViews = $this->projectTopicSectionTodolistViewRepository->all();
    
            return view('project_topic_section_todolist_views.index')
                ->with('projectTopicSectionTodolistViews', $projectTopicSectionTodolistViews);
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
            return view('project_topic_section_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicSectionTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTopicSectionTodolistView = $this->projectTopicSectionTodolistViewRepository->create($input);
    
            Flash::success('Project Topic Section Todolist View saved successfully.');
            return redirect(route('projectTSTodolistViews.index'));
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
            $projectTopicSectionTodolistView = $this->projectTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistView))
            {
                Flash::error('Project Topic Section Todolist View not found');
                return redirect(route('projectTSTodolistViews.index'));
            }
            
            if($projectTopicSectionTodolistView -> user_id == $user_id)
            {
                return view('project_topic_section_todolist_views.show')->with('projectTopicSectionTodolistView', $projectTopicSectionTodolistView);
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
            $projectTopicSectionTodolistView = $this->projectTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistView))
            {
                Flash::error('Project Topic Section Todolist View not found');
                return redirect(route('projectTSTodolistViews.index'));
            }
    
            if($projectTopicSectionTodolistView -> user_id == $user_id)
            {
                return view('project_topic_section_todolist_views.edit')->with('projectTopicSectionTodolistView', $projectTopicSectionTodolistView);
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

    public function update($id, UpdateProjectTopicSectionTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicSectionTodolistView = $this->projectTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistView))
            {
                Flash::error('Project Topic Section Todolist View not found');
                return redirect(route('projectTSTodolistViews.index'));
            }
    
            if($projectTopicSectionTodolistView -> user_id == $user_id)
            {
                $projectTopicSectionTodolistView = $this->projectTopicSectionTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Section Todolist View updated successfully.');
                return redirect(route('projectTSTodolistViews.index'));
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
            $projectTopicSectionTodolistView = $this->projectTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistView))
            {
                Flash::error('Project Topic Section Todolist View not found');
                return redirect(route('projectTSTodolistViews.index'));
            }
            
            if($projectTopicSectionTodolistView -> user_id == $user_id)
            {
                $this->projectTopicSectionTodolistViewRepository->delete($id);
            
                Flash::success('Project Topic Section Todolist View deleted successfully.');
                return redirect(route('projectTSTodolistViews.index'));
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