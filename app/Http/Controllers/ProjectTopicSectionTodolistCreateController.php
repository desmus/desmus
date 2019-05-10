<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicSectionTodolistCreateRequest;
use App\Http\Requests\UpdateProjectTopicSectionTodolistCreateRequest;
use App\Repositories\ProjectTopicSectionTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTopicSectionTodolistCreateController extends AppBaseController
{
    private $projectTopicSectionTodolistCreateRepository;

    public function __construct(ProjectTopicSectionTodolistCreateRepository $projectTopicSectionTodolistCreateRepo)
    {
        $this->projectTopicSectionTodolistCreateRepository = $projectTopicSectionTodolistCreateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicSectionTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTopicSectionTodolistCreates = $this->projectTopicSectionTodolistCreateRepository->all();
    
            return view('project_topic_section_todolist_creates.index')
                ->with('projectTopicSectionTodolistCreates', $projectTopicSectionTodolistCreates);
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
            return view('project_topic_section_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(CreateProjectTopicSectionTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTopicSectionTodolistCreate = $this->projectTopicSectionTodolistCreateRepository->create($input);
    
            Flash::success('Project Topic Section Todolist Create saved successfully.');
            return redirect(route('projectTSTodolistCreates.index'));
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
            $projectTopicSectionTodolistCreate = $this->projectTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistCreate))
            {
                Flash::error('Project Topic Section Todolist Create not found');
                return redirect(route('projectTSTodolistCreates.index'));
            }
            
            if($projectTopicSectionTodolistCreate -> user_id == $user_id)
            {
                return view('project_topic_section_todolist_creates.show')
                    ->with('projectTopicSectionTodolistCreate', $projectTopicSectionTodolistCreate);
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
            $projectTopicSectionTodolistCreate = $this->projectTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistCreate))
            {
                Flash::error('Project Topic Section Todolist Create not found');
                return redirect(route('projectTSTodolistCreates.index'));
            }
    
            if($projectTopicSectionTodolistCreate -> user_id == $user_id)
            {
                return view('project_topic_section_todolist_creates.edit')
                    ->with('projectTopicSectionTodolistCreate', $projectTopicSectionTodolistCreate);
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

    public function update($id, UpdateProjectTopicSectionTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTopicSectionTodolistCreate = $this->projectTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistCreate))
            {
                Flash::error('Project Topic Section Todolist Create not found');
                return redirect(route('projectTSTodolistCreates.index'));
            }
    
            if($projectTopicSectionTodolistCreate -> user_id == $user_id)
            {
                $projectTopicSectionTodolistCreate = $this->projectTopicSectionTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Project Topic Section Todolist Create updated successfully.');
                return redirect(route('projectTSTodolistCreates.index'));
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
            $projectTopicSectionTodolistCreate = $this->projectTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($projectTopicSectionTodolistCreate))
            {
                Flash::error('Project Topic Section Todolist Create not found');
                return redirect(route('projectTSTodolistCreates.index'));
            }
    
            if($projectTopicSectionTodolistCreate -> user_id == $user_id)
            {
                $this->projectTopicSectionTodolistCreateRepository->delete($id);
            
                Flash::success('Project Topic Section Todolist Create deleted successfully.');
                return redirect(route('projectTSTodolistCreates.index'));
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