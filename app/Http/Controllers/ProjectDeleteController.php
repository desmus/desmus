<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectDeleteRequest;
use App\Http\Requests\UpdateProjectDeleteRequest;
use App\Repositories\ProjectDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectDeleteController extends AppBaseController
{
    private $projectDeleteRepository;

    public function __construct(ProjectDeleteRepository $projectDeleteRepo)
    {
        $this->projectDeleteRepository = $projectDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectDeletes = $this->projectDeleteRepository->all();
    
            return view('project_deletes.index')
                ->with('projectDeletes', $projectDeletes);
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
            return view('project_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectDelete = $this->projectDeleteRepository->create($input);
            
                Flash::success('Project Delete saved successfully.');
                return redirect(route('projectDeletes.index'));
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
            $projectDelete = $this->projectDeleteRepository->findWithoutFail($id);
    
            if(empty($projectDelete))
            {
                Flash::error('Project Delete not found');
                return redirect(route('projectDeletes.index'));
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
            
            if($user_id == $projectDelete -> user_id || $isShared)
            {
                return view('project_deletes.show')
                    ->with('projectDelete', $projectDelete);
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
            $projectDelete = $this->projectDeleteRepository->findWithoutFail($id);
    
            if(empty($projectDelete))
            {
                Flash::error('Project Delete not found');
                return redirect(route('projectDeletes.index'));
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
            
            if($user_id == $projectDelete -> user_id || $isShared)
            {
                return view('project_deletes.edit')->with('projectDelete', $projectDelete);
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

    public function update($id, UpdateProjectDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectDelete = $this->projectDeleteRepository->findWithoutFail($id);
    
            if(empty($projectDelete))
            {
                Flash::error('Project Delete not found');
                return redirect(route('projectDeletes.index'));
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
            
            if($user_id == $projectDelete -> user_id || $isShared)
            {
                $projectDelete = $this->projectDeleteRepository->update($request->all(), $id);
            
                Flash::success('Project Delete updated successfully.');
                return redirect(route('projectDeletes.index'));
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
            $projectDelete = $this->projectDeleteRepository->findWithoutFail($id);
    
            if(empty($projectDelete))
            {
                Flash::error('Project Delete not found');
                return redirect(route('projectDeletes.index'));
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
            
            if($user_id == $projectDelete -> user_id || $isShared)
            {
                $this->projectDeleteRepository->delete($id);
            
                Flash::success('Project Delete deleted successfully.');
                return redirect(route('projectDeletes.index'));
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