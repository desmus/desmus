<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicTodolistCreateRequest;
use App\Http\Requests\UpdateProjectTopicTodolistCreateRequest;
use App\Repositories\ProjectTopicTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicTodolistCreateController extends AppBaseController
{
    private $projectTopicTodolistCreateRepository;

    public function __construct(ProjectTopicTodolistCreateRepository $projectTopicTodolistCreateRepo)
    {
        $this->projectTopicTodolistCreateRepository = $projectTopicTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicTodolistCreates = $this->projectTopicTodolistCreateRepository->all();
    
            return view('project_topic_todolist_creates.index')
                ->with('projectTopicTodolistCreates', $projectTopicTodolistCreates);
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
            return view('project_topic_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTopicTodolistCreate = $this->projectTopicTodolistCreateRepository->create($input);
    
            Flash::success('Project Topic Todolist Create saved successfully.');
            return redirect(route('projectTopicTodolistCreates.index'));
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
            $projectTopicTodolistCreate = $this->projectTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistCreate))
            {
                Flash::error('Project Topic Todolist Create not found');
                return redirect(route('projectTopicTodolistCreates.index'));
            }
            
            if($projectTopicTodolistCreate -> user_id == $user_id)
            {
                return view('project_topic_todolist_creates.show')
                    ->with('projectTopicTodolistCreate', $projectTopicTodolistCreate);
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
            $projectTopicTodolistCreate = $this->projectTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistCreate))
            {
                Flash::error('Project Topic Todolist Create not found');
                return redirect(route('projectTopicTodolistCreates.index'));
            }
            
            if($projectTopicTodolistCreate -> user_id == $user_id)
            {
                return view('project_topic_todolist_creates.edit')
                    ->with('projectTopicTodolistCreate', $projectTopicTodolistCreate);
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

    public function update($id, UpdateProjectTopicTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicTodolistCreate = $this->projectTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistCreate))
            {
                Flash::error('Project Topic Todolist Create not found');
                return redirect(route('projectTopicTodolistCreates.index'));
            }
    
            if($projectTopicTodolistCreate -> user_id == $user_id)
            {
                $projectTopicTodolistCreate = $this->projectTopicTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Todolist Create updated successfully.');
                return redirect(route('projectTopicTodolistCreates.index'));
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
            $projectTopicTodolistCreate = $this->projectTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistCreate))
            {
                Flash::error('Project Topic Todolist Create not found');
                return redirect(route('projectTopicTodolistCreates.index'));
            }
    
            if($projectTopicTodolistCreate -> user_id == $user_id)
            {
                $this->projectTopicTodolistCreateRepository->delete($id);
            
                Flash::success('Project Topic Todolist Create deleted successfully.');
                return redirect(route('projectTopicTodolistCreates.index'));
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