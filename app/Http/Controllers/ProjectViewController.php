<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectViewRequest;
use App\Http\Requests\UpdateProjectViewRequest;
use App\Repositories\ProjectViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectViewController extends AppBaseController
{
    private $projectViewRepository;

    public function __construct(ProjectViewRepository $projectViewRepo)
    {
        $this->projectViewRepository = $projectViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectViewRepository->pushCriteria(new RequestCriteria($request));
            $projectViews = $this->projectViewRepository->all();
    
            return view('project_views.index')
                ->with('projectViews', $projectViews);
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
            return view('project_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectView = $this->projectViewRepository->create($input);
                
                Flash::success('Project View saved successfully.');
                return redirect(route('projectViews.index'));
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

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectView = $this->projectViewRepository->findWithoutFail($id);
    
            if(empty($projectView))
            {
                Flash::error('Project View not found');
                return redirect(route('projectViews.index'));
            }
            
            $userProjects = DB::table('user_projects')->where('project_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjects as $userProject)
            {
                if($userProject -> user_id == $user_id && $userProject -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $projectView -> user_id || $isShared)
            {
                return view('project_views.show')
                    ->with('projectView', $projectView);
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
            $projectView = $this->projectViewRepository->findWithoutFail($id);
    
            if(empty($projectView))
            {
                Flash::error('Project View not found');
                return redirect(route('projectViews.index'));
            }
    
            $userProjects = DB::table('user_projects')->where('project_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjects as $userProject)
            {
                if($userProject -> user_id == $user_id && $userProject -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $projectView -> user_id || $isShared)
            {
                return view('project_views.edit')
                    ->with('projectView', $projectView);
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

    public function update($id, UpdateProjectViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectView = $this->projectViewRepository->findWithoutFail($id);
    
            if(empty($projectView))
            {
                Flash::error('Project View not found');
                return redirect(route('projectViews.index'));
            }
            
            $userProjects = DB::table('user_projects')->where('project_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjects as $userProject)
            {
                if($userProject -> user_id == $user_id && $userProject -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $projectView -> user_id || $isShared)
            {
                $projectView = $this->projectViewRepository->update($request->all(), $id);
                
                Flash::success('Project View updated successfully.');
                return redirect(route('projectViews.index'));
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
            $projectView = $this->projectViewRepository->findWithoutFail($id);
    
            if(empty($projectView))
            {
                Flash::error('Project View not found');
                return redirect(route('projectViews.index'));
            }
            
            $userProjects = DB::table('user_projects')->where('project_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjects as $userProject)
            {
                if($userProject -> user_id == $user_id && $userProject -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $projectView -> user_id || $isShared)
            {
                $this->projectViewRepository->delete($id);
                
                Flash::success('Project View deleted successfully.');
                return redirect(route('projectViews.index'));
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