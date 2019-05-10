<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeURequest;
use App\Http\Requests\UpdateUserCollegeURequest;
use App\Repositories\UserCollegeURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeUController extends AppBaseController
{
    private $userCollegeURepository;

    public function __construct(UserCollegeURepository $userCollegeURepo)
    {
        $this->userCollegeURepository = $userCollegeURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeURepository->pushCriteria(new RequestCriteria($request));
            $userCollegeUs = $this->userCollegeURepository->all();
    
            return view('user_college_us.index')
                ->with('userCollegeUs', $userCollegeUs);
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
            return view('user_college_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeU = $this->userCollegeURepository->create($input);
            
                Flash::success('User College U saved successfully.');
                return redirect(route('userCollegeUpdates.index'));
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
            $userCollegeU = $this->userCollegeURepository->findWithoutFail($id);
    
            if(empty($userCollegeU))
            {
                Flash::error('User College U not found');
                return redirect(route('userCollegeUpdates.index'));
            }
            
            if($userCollegeU -> user_id == $user_id)
            {
                return view('user_college_us.show')
                    ->with('userCollegeU', $userCollegeU);
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
            $userCollegeU = $this->userCollegeURepository->findWithoutFail($id);
    
            if(empty($userCollegeU))
            {
                Flash::error('User College U not found');
                return redirect(route('userCollegeUpdates.index'));
            }
    
            if($userCollegeU -> user_id == $user_id)
            {
                return view('user_college_us.edit')
                    ->with('userCollegeU', $userCollegeU);
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

    public function update($id, UpdateUserCollegeURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeU = $this->userCollegeURepository->findWithoutFail($id);
    
            if(empty($userCollegeU))
            {
                Flash::error('User College U not found');
                return redirect(route('userCollegeUpdates.index'));
            }
    
            if($userCollegeU -> user_id == $user_id)
            {
                $userCollegeU = $this->userCollegeURepository->update($request->all(), $id);
            
                Flash::success('User College U updated successfully.');
                return redirect(route('userCollegeUpdates.index'));
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
            $userCollegeU = $this->userCollegeURepository->findWithoutFail($id);
    
            if(empty($userCollegeU))
            {
                Flash::error('User College U not found');
                return redirect(route('userCollegeUpdates.index'));
            }
    
            if($userCollegeU -> user_id == $user_id)
            {
                $this->userCollegeURepository->delete($id);
            
                Flash::success('User College U deleted successfully.');
                return redirect(route('userCollegeUpdates.index'));
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