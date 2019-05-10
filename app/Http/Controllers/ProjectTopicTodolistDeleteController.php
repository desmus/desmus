<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicTodolistDeleteRequest;
use App\Http\Requests\UpdateProjectTopicTodolistDeleteRequest;
use App\Repositories\ProjectTopicTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicTodolistDeleteController extends AppBaseController
{
    private $projectTopicTodolistDeleteRepository;

    public function __construct(ProjectTopicTodolistDeleteRepository $projectTopicTodolistDeleteRepo)
    {
        $this->projectTopicTodolistDeleteRepository = $projectTopicTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicTodolistDeletes = $this->projectTopicTodolistDeleteRepository->all();
    
            return view('project_topic_todolist_deletes.index')
                ->with('projectTopicTodolistDeletes', $projectTopicTodolistDeletes);
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
            return view('project_topic_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTopicTodolistDelete = $this->projectTopicTodolistDeleteRepository->create($input);
    
            Flash::success('Project Topic Todolist Delete saved successfully.');
            return redirect(route('projectTopicTodolistDeletes.index'));
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
            $projectTopicTodolistDelete = $this->projectTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistDelete))
            {
                Flash::error('Project Topic Todolist Delete not found');
                return redirect(route('projectTopicTodolistDeletes.index'));
            }
    
            if($projectTopicTodolistDelete -> user_id == $user_id)
            {
                return view('project_topic_todolist_deletes.show')
                    ->with('projectTopicTodolistDelete', $projectTopicTodolistDelete);
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
            $projectTopicTodolistDelete = $this->projectTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistDelete))
            {
                Flash::error('Project Topic Todolist Delete not found');
                return redirect(route('projectTopicTodolistDeletes.index'));
            }
            
            if($projectTopicTodolistDelete -> user_id == $user_id)
            {
                return view('project_topic_todolist_deletes.edit')
                    ->with('projectTopicTodolistDelete', $projectTopicTodolistDelete);
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

    public function update($id, UpdateProjectTopicTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicTodolistDelete = $this->projectTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistDelete))
            {
                Flash::error('Project Topic Todolist Delete not found');
                return redirect(route('projectTopicTodolistDeletes.index'));
            }
    
            if($projectTopicTodolistDelete -> user_id == $user_id)
            {
                $projectTopicTodolistDelete = $this->projectTopicTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Todolist Delete updated successfully.');
                return redirect(route('projectTopicTodolistDeletes.index'));
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
            $projectTopicTodolistDelete = $this->projectTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicTodolistDelete))
            {
                Flash::error('Project Topic Todolist Delete not found');
                return redirect(route('projectTopicTodolistDeletes.index'));
            }
    
            if($projectTopicTodolistDelete -> user_id == $user_id)
            {
                $this->projectTopicTodolistDeleteRepository->delete($id);
            
                Flash::success('Project Topic Todolist Delete deleted successfully.');
                return redirect(route('projectTopicTodolistDeletes.index'));
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