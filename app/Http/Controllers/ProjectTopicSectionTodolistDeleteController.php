<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicSectionTodolistDeleteRequest;
use App\Http\Requests\UpdateProjectTopicSectionTodolistDeleteRequest;
use App\Repositories\ProjectTopicSectionTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicSectionTodolistDeleteController extends AppBaseController
{
    private $projectTopicSectionTodolistDeleteRepository;

    public function __construct(ProjectTopicSectionTodolistDeleteRepository $projectTopicSectionTodolistDeleteRepo)
    {
        $this->projectTopicSectionTodolistDeleteRepository = $projectTopicSectionTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicSectionTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicSectionTodolistDeletes = $this->projectTopicSectionTodolistDeleteRepository->all();
    
            return view('project_topic_section_todolist_deletes.index')
                ->with('projectTopicSectionTodolistDeletes', $projectTopicSectionTodolistDeletes);
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
            return view('project_topic_section_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicSectionTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTopicSectionTodolistDelete = $this->projectTopicSectionTodolistDeleteRepository->create($input);
    
            Flash::success('Project Topic Section Todolist Delete saved successfully.');
            return redirect(route('projectTSTodolistDeletes.index'));
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
            $projectTopicSectionTodolistDelete = $this->projectTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistDelete))
            {
                Flash::error('Project Topic Section Todolist Delete not found');
                return redirect(route('projectTSTodolistDeletes.index'));
            }
            
            if($projectTopicSectionTodolistDelete -> user_id == $user_id)
            {
                return view('project_topic_section_todolist_deletes.show')
                    ->with('projectTopicSectionTodolistDelete', $projectTopicSectionTodolistDelete);
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
            $projectTopicSectionTodolistDelete = $this->projectTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistDelete))
            {
                Flash::error('Project Topic Section Todolist Delete not found');
                return redirect(route('projectTSTodolistDeletes.index'));
            }
    
            if($projectTopicSectionTodolistDelete -> user_id == $user_id)
            {
                return view('project_topic_section_todolist_deletes.edit')->with('projectTopicSectionTodolistDelete', $projectTopicSectionTodolistDelete);
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

    public function update($id, UpdateProjectTopicSectionTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicSectionTodolistDelete = $this->projectTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistDelete))
            {
                Flash::error('Project Topic Section Todolist Delete not found');
                return redirect(route('projectTSTodolistDeletes.index'));
            }
            
            if($projectTopicSectionTodolistDelete -> user_id == $user_id)
            {
                $projectTopicSectionTodolistDelete = $this->projectTopicSectionTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Section Todolist Delete updated successfully.');
                return redirect(route('projectTSTodolistDeletes.index'));
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
            $projectTopicSectionTodolistDelete = $this->projectTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistDelete))
            {
                Flash::error('Project Topic Section Todolist Delete not found');
                return redirect(route('projectTSTodolistDeletes.index'));
            }
    
            if($projectTopicSectionTodolistDelete -> user_id == $user_id)
            {
                $this->projectTopicSectionTodolistDeleteRepository->delete($id);
            
                Flash::success('Project Topic Section Todolist Delete deleted successfully.');
                return redirect(route('projectTSTodolistDeletes.index'));
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