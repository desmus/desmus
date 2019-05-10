<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPTCreateRequest;
use App\Http\Requests\UpdateProjectTSPTCreateRequest;
use App\Repositories\ProjectTSPTCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPTCreateController extends AppBaseController
{
    private $projectTSPTCreateRepository;

    public function __construct(ProjectTSPTCreateRepository $projectTSPTCreateRepo)
    {
        $this->projectTSPTCreateRepository = $projectTSPTCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPTCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPTCreates = $this->projectTSPTCreateRepository->all();
    
            return view('project_t_s_p_t_creates.index')
                ->with('projectTSPTCreates', $projectTSPTCreates);
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
            return view('project_t_s_p_t_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPTCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSPTCreate = $this->projectTSPTCreateRepository->create($input);
    
            Flash::success('Project T S P T Create saved successfully.');
            return redirect(route('projectTSPTCreates.index'));
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
            $projectTSPTCreate = $this->projectTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPTCreate))
            {
                Flash::error('Project T S P T Create not found');
                return redirect(route('projectTSPTCreates.index'));
            }
            
            if($projectTSPTCreate -> user_id == $user_id)
            {
                return view('project_t_s_p_t_creates.show')->with('projectTSPTCreate', $projectTSPTCreate);
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
            $projectTSPTCreate = $this->projectTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPTCreate))
            {
                Flash::error('Project T S P T Create not found');
                return redirect(route('projectTSPTCreates.index'));
            }
    
            if($projectTSPTCreate -> user_id == $user_id)
            {
                return view('project_t_s_p_t_creates.edit')->with('projectTSPTCreate', $projectTSPTCreate);
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

    public function update($id, UpdateProjectTSPTCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPTCreate = $this->projectTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPTCreate))
            {
                Flash::error('Project T S P T Create not found');
                return redirect(route('projectTSPTCreates.index'));
            }
            
            if($projectTSPTCreate -> user_id == $user_id)
            {
                $projectTSPTCreate = $this->projectTSPTCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S P T Create updated successfully.');
                return redirect(route('projectTSPTCreates.index'));
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
            $projectTSPTCreate = $this->projectTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSPTCreate))
            {
                Flash::error('Project T S P T Create not found');
                return redirect(route('projectTSPTCreates.index'));
            }
    
            if($projectTSPTCreate -> user_id == $user_id)
            {
                $this->projectTSPTCreateRepository->delete($id);
                
                Flash::success('Project T S P T Create deleted successfully.');
                return redirect(route('projectTSPTCreates.index'));
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