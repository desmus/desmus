<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGImageTodolistRequest;
use App\Http\Requests\UpdateProjectTSGImageTodolistRequest;
use App\Repositories\ProjectTSGImageTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGImageTodolistController extends AppBaseController
{
    private $projectTSGImageTodolistRepository;

    public function __construct(ProjectTSGImageTodolistRepository $projectTSGImageTodolistRepo)
    {
        $this->projectTSGImageTodolistRepository = $projectTSGImageTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGImageTodolistRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGImageTodolists = $this->projectTSGImageTodolistRepository->all();
    
            return view('project_t_s_g_image_todolists.index')
                ->with('projectTSGImageTodolists', $projectTSGImageTodolists);
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
            return view('project_t_s_g_image_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGImageTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSGImageTodolist = $this->projectTSGImageTodolistRepository->create($input);
    
            Flash::success('Project T S G Image Todolist saved successfully.');
            return redirect(route('projectTSGImageTodolists.index'));
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
            $projectTSGImageTodolist = $this->projectTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolist))
            {
                Flash::error('Project T S G Image Todolist not found');
                return redirect(route('projectTSGImageTodolists.index'));
            }
    
            return view('project_t_s_g_image_todolists.show')->with('projectTSGImageTodolist', $projectTSGImageTodolist);
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
            $projectTSGImageTodolist = $this->projectTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolist))
            {
                Flash::error('Project T S G Image Todolist not found');
                return redirect(route('projectTSGImageTodolists.index'));
            }
    
            return view('project_t_s_g_image_todolists.edit')->with('projectTSGImageTodolist', $projectTSGImageTodolist);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateProjectTSGImageTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $projectTSGImageTodolist = $this->projectTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolist))
            {
                Flash::error('Project T S G Image Todolist not found');
                return redirect(route('projectTSGImageTodolists.index'));
            }
    
            $projectTSGImageTodolist = $this->projectTSGImageTodolistRepository->update($request->all(), $id);
    
            Flash::success('Project T S G Image Todolist updated successfully.');
            return redirect(route('projectTSGImageTodolists.index'));
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
            $projectTSGImageTodolist = $this->projectTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolist))
            {
                Flash::error('Project T S G Image Todolist not found');
                return redirect(route('projectTSGImageTodolists.index'));
            }
    
            $this->projectTSGImageTodolistRepository->delete($id);
    
            Flash::success('Project T S G Image Todolist deleted successfully.');
            return redirect(route('projectTSGImageTodolists.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}