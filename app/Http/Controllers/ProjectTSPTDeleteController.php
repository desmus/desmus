<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateProjectTSPTDeleteRequest;
use App\Repositories\ProjectTSPTDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPTDeleteController extends AppBaseController
{
    private $projectTSPTDeleteRepository;

    public function __construct(ProjectTSPTDeleteRepository $projectTSPTDeleteRepo)
    {
        $this->projectTSPTDeleteRepository = $projectTSPTDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPTDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPTDeletes = $this->projectTSPTDeleteRepository->all();
    
            return view('project_t_s_p_t_deletes.index')
                ->with('projectTSPTDeletes', $projectTSPTDeletes);
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
            return view('project_t_s_p_t_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPTDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSPTDelete = $this->projectTSPTDeleteRepository->create($input);
    
            Flash::success('Project T S P T Delete saved successfully.');
            return redirect(route('projectTSPTDeletes.index'));
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
            $projectTSPTDelete = $this->projectTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPTDelete))
            {
                Flash::error('Project T S P T Delete not found');
                return redirect(route('projectTSPTDeletes.index'));
            }
            
            if($projectTSPTDelete -> user_id == $user_id)
            {
                return view('project_t_s_p_t_deletes.show')->with('projectTSPTDelete', $projectTSPTDelete);
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
            $projectTSPTDelete = $this->projectTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPTDelete))
            {
                Flash::error('Project T S P T Delete not found');
                return redirect(route('projectTSPTDeletes.index'));
            }
    
            if($projectTSPTDelete -> user_id == $user_id)
            {
                return view('project_t_s_p_t_deletes.edit')->with('projectTSPTDelete', $projectTSPTDelete);
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

    public function update($id, UpdateProjectTSPTDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPTDelete = $this->projectTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPTDelete))
            {
                Flash::error('Project T S P T Delete not found');
                return redirect(route('projectTSPTDeletes.index'));
            }
            
            if($projectTSPTDelete -> user_id == $user_id)
            {
                $projectTSPTDelete = $this->projectTSPTDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S P T Delete updated successfully.');
                return redirect(route('projectTSPTDeletes.index'));
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
            $projectTSPTDelete = $this->projectTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSPTDelete))
            {
                Flash::error('Project T S P T Delete not found');
                return redirect(route('projectTSPTDeletes.index'));
            }
    
            if($projectTSPTDelete -> user_id == $user_id)
            {
                $this->projectTSPTDeleteRepository->delete($id);
                
                Flash::success('Project T S P T Delete deleted successfully.');
                return redirect(route('projectTSPTDeletes.index'));
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