<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobURequest;
use App\Http\Requests\UpdateUserJobURequest;
use App\Repositories\UserJobURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobUController extends AppBaseController
{
    private $userJobURepository;

    public function __construct(UserJobURepository $userJobURepo)
    {
        $this->userJobURepository = $userJobURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobURepository->pushCriteria(new RequestCriteria($request));
            $userJobUs = $this->userJobURepository->all();
    
            return view('user_job_us.index')
                ->with('userJobUs', $userJobUs);
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
            return view('user_job_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobU = $this->userJobURepository->create($input);
            
                Flash::success('User Job U saved successfully.');
                return redirect(route('userJobUs.index'));
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
            $userJobU = $this->userJobURepository->findWithoutFail($id);
    
            if(empty($userJobU))
            {
                Flash::error('User Job U not found');
                return redirect(route('userJobUs.index'));
            }
    
            if($userJobU -> user_id == $user_id)
            {
                return view('user_job_us.show')
                    ->with('userJobU', $userJobU);
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
            $userJobU = $this->userJobURepository->findWithoutFail($id);
    
            if(empty($userJobU))
            {
                Flash::error('User Job U not found');
                return redirect(route('userJobUs.index'));
            }
    
            if($userJobU -> user_id == $user_id)
            {
                return view('user_job_us.edit')
                    ->with('userJobU', $userJobU);
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

    public function update($id, UpdateUserJobURequest $request)
    {
        if(Auth::user() != null)
        {
            $userJobU = $this->userJobURepository->findWithoutFail($id);
    
            if(empty($userJobU))
            {
                Flash::error('User Job U not found');
                return redirect(route('userJobUs.index'));
            }
    
            if($userJobU -> user_id == $user_id)
            {
                $userJobU = $this->userJobURepository->update($request->all(), $id);
            
                Flash::success('User Job U updated successfully.');
                return redirect(route('userJobUs.index'));
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
            $userJobU = $this->userJobURepository->findWithoutFail($id);
    
            if(empty($userJobU))
            {
                Flash::error('User Job U not found');
                return redirect(route('userJobUs.index'));
            }
    
            if($userJobU -> user_id == $user_id)
            {
                $this->userJobURepository->delete($id);
            
                Flash::success('User Job U deleted successfully.');
                return redirect(route('userJobUs.index'));
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