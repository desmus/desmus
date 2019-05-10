<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGImageTodolistUpdateRequest;
use App\Http\Requests\UpdateProjectTSGImageTodolistUpdateRequest;
use App\Repositories\ProjectTSGImageTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGImageTodolistUpdateController extends AppBaseController
{
    private $projectTSGImageTodolistUpdateRepository;

    public function __construct(ProjectTSGImageTodolistUpdateRepository $projectTSGImageTodolistUpdateRepo)
    {
        $this->projectTSGImageTodolistUpdateRepository = $projectTSGImageTodolistUpdateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSGImageTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGImageTodolistUpdates = $this->projectTSGImageTodolistUpdateRepository->all();
    
            return view('project_t_s_g_image_todolist_updates.index')
                ->with('projectTSGImageTodolistUpdates', $projectTSGImageTodolistUpdates);
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
            return view('project_t_s_g_image_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGImageTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSGImageTodolistUpdate = $this->projectTSGImageTodolistUpdateRepository->create($input);
    
            Flash::success('Project T S G Image Todolist Update saved successfully.');
            return redirect(route('projectTSGImageTodolistUpdates.index'));
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
            $projectTSGImageTodolistUpdate = $this->projectTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistUpdate))
            {
                Flash::error('Project T S G Image Todolist Update not found');
                return redirect(route('projectTSGImageTodolistUpdates.index'));
            }
            
            if($projectTSGImageTodolistUpdate -> user_id == $user_id)
            {
                return view('project_t_s_g_image_todolist_updates.show')
                    ->with('projectTSGImageTodolistUpdate', $projectTSGImageTodolistUpdate);
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
            $projectTSGImageTodolistUpdate = $this->projectTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistUpdate))
            {
                Flash::error('Project T S G Image Todolist Update not found');
                return redirect(route('projectTSGImageTodolistUpdates.index'));
            }
    
            if($projectTSGImageTodolistUpdate -> user_id == $user_id)
            {
                return view('project_t_s_g_image_todolist_updates.edit')->with('projectTSGImageTodolistUpdate', $projectTSGImageTodolistUpdate);
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

    public function update($id, UpdateProjectTSGImageTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSGImageTodolistUpdate = $this->projectTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistUpdate))
            {
                Flash::error('Project T S G Image Todolist Update not found');
                return redirect(route('projectTSGImageTodolistUpdates.index'));
            }
    
            if($projectTSGImageTodolistUpdate -> user_id == $user_id)
            {
                $projectTSGImageTodolistUpdate = $this->projectTSGImageTodolistUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S G Image Todolist Update updated successfully.');
                return redirect(route('projectTSGImageTodolistUpdates.index'));
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
            $projectTSGImageTodolistUpdate = $this->projectTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSGImageTodolistUpdate))
            {
                Flash::error('Project T S G Image Todolist Update not found');
                return redirect(route('projectTSGImageTodolistUpdates.index'));
            }
            
            if($projectTSGImageTodolistUpdate -> user_id == $user_id)
            {
                $this->projectTSGImageTodolistUpdateRepository->delete($id);
                
                Flash::success('Project T S G Image Todolist Update deleted successfully.');
                return redirect(route('projectTSGImageTodolistUpdates.index'));
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