<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectCreateRequest;
use App\Http\Requests\UpdateProjectCreateRequest;
use App\Repositories\ProjectCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectCreateController extends AppBaseController
{
    private $projectCreateRepository;

    public function __construct(ProjectCreateRepository $projectCreateRepo)
    {
        $this->projectCreateRepository = $projectCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectCreates = $this->projectCreateRepository->all();
    
            return view('project_creates.index')
                ->with('projectCreates', $projectCreates);
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
            return view('project_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectCreate = $this->projectCreateRepository->create($input);
            
                Flash::success('Project Create saved successfully.');
                return redirect(route('projectCreates.index'));
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
            $projectCreate = $this->projectCreateRepository->findWithoutFail($id);
    
            if(empty($projectCreate))
            {
                Flash::error('Project Create not found');
                return redirect(route('projectCreates.index'));
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
            
            if($user_id == $projectCreate -> user_id || $isShared)
            {
                return view('project_creates.show')->with('projectCreate', $projectCreate);
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
            $projectCreate = $this->projectCreateRepository->findWithoutFail($id);
    
            if(empty($projectCreate))
            {
                Flash::error('Project Create not found');
                return redirect(route('projectCreates.index'));
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
            
            if($user_id == $projectCreate -> user_id || $isShared)
            {
                return view('project_creates.edit')->with('projectCreate', $projectCreate);
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

    public function update($id, UpdateProjectCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectCreate = $this->projectCreateRepository->findWithoutFail($id);
    
            if(empty($projectCreate))
            {
                Flash::error('Project Create not found');
                return redirect(route('projectCreates.index'));
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
            
            if($user_id == $projectCreate -> user_id || $isShared)
            {
                $projectCreate = $this->projectCreateRepository->update($request->all(), $id);
            
                Flash::success('Project Create updated successfully.');
                return redirect(route('projectCreates.index'));
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
            $projectCreate = $this->projectCreateRepository->findWithoutFail($id);
    
            if(empty($projectCreate))
            {
                Flash::error('Project Create not found');
                return redirect(route('projectCreates.index'));
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
            
            if($user_id == $projectCreate -> user_id || $isShared)
            {
                $this->projectCreateRepository->delete($id);
            
                Flash::success('Project Create deleted successfully.');
                return redirect(route('projectCreates.index'));
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