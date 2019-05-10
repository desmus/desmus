<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectURequest;
use App\Http\Requests\UpdateUserProjectURequest;
use App\Repositories\UserProjectURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectUController extends AppBaseController
{
    private $userProjectURepository;

    public function __construct(UserProjectURepository $userProjectURepo)
    {
        $this->userProjectURepository = $userProjectURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectURepository->pushCriteria(new RequestCriteria($request));
            $userProjectUs = $this->userProjectURepository->all();
    
            return view('user_project_us.index')
                ->with('userProjectUs', $userProjectUs);
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
            return view('user_project_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectU = $this->userProjectURepository->create($input);
            
                Flash::success('User Project U saved successfully.');
                return redirect(route('userProjectUs.index'));
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
            $userProjectU = $this->userProjectURepository->findWithoutFail($id);
    
            if(empty($userProjectU))
            {
                Flash::error('User Project U not found');
                return redirect(route('userProjectUs.index'));
            }
    
            if($userProjectU -> user_id == $user_id)
            {
                return view('user_project_us.show')
                    ->with('userProjectU', $userProjectU);
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
            $userProjectU = $this->userProjectURepository->findWithoutFail($id);
    
            if(empty($userProjectU))
            {
                Flash::error('User Project U not found');
                return redirect(route('userProjectUs.index'));
            }
    
            if($userProjectU -> user_id == $user_id)
            {
                return view('user_project_us.edit')
                    ->with('userProjectU', $userProjectU);
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

    public function update($id, UpdateUserProjectURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectU = $this->userProjectURepository->findWithoutFail($id);
    
            if(empty($userProjectU))
            {
                Flash::error('User Project U not found');
                return redirect(route('userProjectUs.index'));
            }
    
            if($userProjectU -> user_id == $user_id)
            {
                $userProjectU = $this->userProjectURepository->update($request->all(), $id);
            
                Flash::success('User Project U updated successfully.');
                return redirect(route('userProjectUs.index'));
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
            $userProjectU = $this->userProjectURepository->findWithoutFail($id);
    
            if(empty($userProjectU))
            {
                Flash::error('User Project U not found');
                return redirect(route('userProjectUs.index'));
            }
    
            if($userProjectU -> user_id == $user_id)
            {
                $this->userProjectURepository->delete($id);
            
                Flash::success('User Project U deleted successfully.');
                return redirect(route('userProjectUs.index'));
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