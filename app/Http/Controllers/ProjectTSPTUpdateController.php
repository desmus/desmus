<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPTUpdateRequest;
use App\Http\Requests\UpdateProjectTSPTUpdateRequest;
use App\Repositories\ProjectTSPTUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPTUpdateController extends AppBaseController
{
    private $projectTSPTUpdateRepository;

    public function __construct(ProjectTSPTUpdateRepository $projectTSPTUpdateRepo)
    {
        $this->projectTSPTUpdateRepository = $projectTSPTUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPTUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPTUpdates = $this->projectTSPTUpdateRepository->all();
    
            return view('project_t_s_p_t_updates.index')
                ->with('projectTSPTUpdates', $projectTSPTUpdates);
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
            return view('project_t_s_p_t_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPTUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSPTUpdate = $this->projectTSPTUpdateRepository->create($input);
    
            Flash::success('Project T S P T Update saved successfully.');
            return redirect(route('projectTSPTUpdates.index'));
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
            $projectTSPTUpdate = $this->projectTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPTUpdate))
            {
                Flash::error('Project T S P T Update not found');
                return redirect(route('projectTSPTUpdates.index'));
            }
    
            if($projectTSPTUpdate -> user_id == $user_id)
            {
                return view('project_t_s_p_t_updates.show')->with('projectTSPTUpdate', $projectTSPTUpdate);
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
            $projectTSPTUpdate = $this->projectTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPTUpdate))
            {
                Flash::error('Project T S P T Update not found');
                return redirect(route('projectTSPTUpdates.index'));
            }
    
            if($projectTSPTUpdate -> user_id == $user_id)
            {
                return view('project_t_s_p_t_updates.edit')->with('projectTSPTUpdate', $projectTSPTUpdate);
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

    public function update($id, UpdateProjectTSPTUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPTUpdate = $this->projectTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPTUpdate))
            {
                Flash::error('Project T S P T Update not found');
                return redirect(route('projectTSPTUpdates.index'));
            }
    
            if($projectTSPTUpdate -> user_id == $user_id)
            {
                $projectTSPTUpdate = $this->projectTSPTUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S P T Update updated successfully.');
                return redirect(route('projectTSPTUpdates.index'));
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
            $projectTSPTUpdate = $this->projectTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSPTUpdate))
            {
                Flash::error('Project T S P T Update not found');
                return redirect(route('projectTSPTUpdates.index'));
            }
    
            if($projectTSPTUpdate -> user_id == $user_id)
            {
                $this->projectTSPTUpdateRepository->delete($id);
                
                Flash::success('Project T S P T Update deleted successfully.');
                return redirect(route('projectTSPTUpdates.index'));
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