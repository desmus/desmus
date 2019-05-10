<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectUpdateRequest;
use App\Http\Requests\UpdateProjectUpdateRequest;
use App\Repositories\ProjectUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectUpdateController extends AppBaseController
{
    private $projectUpdateRepository;

    public function __construct(ProjectUpdateRepository $projectUpdateRepo)
    {
        $this->projectUpdateRepository = $projectUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectUpdates = $this->projectUpdateRepository->all();
    
            return view('project_updates.index')
                ->with('projectUpdates', $projectUpdates);
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
            return view('project_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectUpdate = $this->projectUpdateRepository->create($input);
                
                Flash::success('Project Update saved successfully.');
                return redirect(route('projectUpdates.index'));
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
            $projectUpdate = $this->projectUpdateRepository->findWithoutFail($id);
    
            if(empty($projectUpdate))
            {
                Flash::error('Project Update not found');
                return redirect(route('projectUpdates.index'));
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
            
            if($user_id == $projectUpdate -> user_id || $isShared)
            {
                return view('project_updates.show')
                    ->with('projectUpdate', $projectUpdate);
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
            $projectUpdate = $this->projectUpdateRepository->findWithoutFail($id);
    
            if(empty($projectUpdate))
            {
                Flash::error('Project Update not found');
                return redirect(route('projectUpdates.index'));
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
            
            if($user_id == $projectUpdate -> user_id || $isShared)
            {
                return view('project_updates.edit')
                    ->with('projectUpdate', $projectUpdate);
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

    public function update($id, UpdateProjectUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectUpdate = $this->projectUpdateRepository->findWithoutFail($id);
    
            if(empty($projectUpdate))
            {
                Flash::error('Project Update not found');
                return redirect(route('projectUpdates.index'));
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
            
            if($user_id == $projectUpdate -> user_id || $isShared)
            {
                $projectUpdate = $this->projectUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project Update updated successfully.');
                return redirect(route('projectUpdates.index'));
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
            $projectUpdate = $this->projectUpdateRepository->findWithoutFail($id);
    
            if(empty($projectUpdate))
            {
                Flash::error('Project Update not found');
                return redirect(route('projectUpdates.index'));
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
            
            if($user_id == $projectUpdate -> user_id || $isShared)
            {
                $this->projectUpdateRepository->delete($id);
                
                Flash::success('Project Update deleted successfully.');
                return redirect(route('projectUpdates.index'));
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