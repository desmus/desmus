<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPTViewRequest;
use App\Http\Requests\UpdateProjectTSPTViewRequest;
use App\Repositories\ProjectTSPTViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPTViewController extends AppBaseController
{
    private $projectTSPTViewRepository;

    public function __construct(ProjectTSPTViewRepository $projectTSPTViewRepo)
    {
        $this->projectTSPTViewRepository = $projectTSPTViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPTViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPTViews = $this->projectTSPTViewRepository->all();
    
            return view('project_t_s_p_t_views.index')
                ->with('projectTSPTViews', $projectTSPTViews);
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
            return view('project_t_s_p_t_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPTViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $projectTSPTView = $this->projectTSPTViewRepository->create($input);
    
            Flash::success('Project T S P T View saved successfully.');
            return redirect(route('projectTSPTViews.index'));
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
            $projectTSPTView = $this->projectTSPTViewRepository->findWithoutFail($id);
    
            if(empty($projectTSPTView))
            {
                Flash::error('Project T S P T View not found');
                return redirect(route('projectTSPTViews.index'));
            }
    
            if($projectTSPTView -> user_id == $user_id)
            {
                return view('project_t_s_p_t_views.show')->with('projectTSPTView', $projectTSPTView);
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
            $projectTSPTView = $this->projectTSPTViewRepository->findWithoutFail($id);
    
            if(empty($projectTSPTView))
            {
                Flash::error('Project T S P T View not found');
                return redirect(route('projectTSPTViews.index'));
            }
    
            if($projectTSPTView -> user_id == $user_id)
            {
                return view('project_t_s_p_t_views.edit')->with('projectTSPTView', $projectTSPTView);
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

    public function update($id, UpdateProjectTSPTViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSPTView = $this->projectTSPTViewRepository->findWithoutFail($id);
    
            if(empty($projectTSPTView))
            {
                Flash::error('Project T S P T View not found');
                return redirect(route('projectTSPTViews.index'));
            }
    
            if($projectTSPTView -> user_id == $user_id)
            {
                $projectTSPTView = $this->projectTSPTViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S P T View updated successfully.');
                return redirect(route('projectTSPTViews.index'));
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
            $projectTSPTView = $this->projectTSPTViewRepository->findWithoutFail($id);
    
            if(empty($projectTSPTView))
            {
                Flash::error('Project T S P T View not found');
                return redirect(route('projectTSPTViews.index'));
            }
    
            if($projectTSPTView -> user_id == $user_id)
            {
                $this->projectTSPTViewRepository->delete($id);
                
                Flash::success('Project T S P T View deleted successfully.');
                return redirect(route('projectTSPTViews.index'));
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