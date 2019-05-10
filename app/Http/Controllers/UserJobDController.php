<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobDRequest;
use App\Http\Requests\UpdateUserJobDRequest;
use App\Repositories\UserJobDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobDController extends AppBaseController
{
    private $userJobDRepository;

    public function __construct(UserJobDRepository $userJobDRepo)
    {
        $this->userJobDRepository = $userJobDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobDRepository->pushCriteria(new RequestCriteria($request));
            $userJobDs = $this->userJobDRepository->all();
    
            return view('user_job_ds.index')
                ->with('userJobDs', $userJobDs);
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
            return view('user_job_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobD = $this->userJobDRepository->create($input);
            
                Flash::success('User Job D saved successfully.');
                return redirect(route('userJobDs.index'));
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
            $userJobD = $this->userJobDRepository->findWithoutFail($id);
    
            if(empty($userJobD))
            {
                Flash::error('User Job D not found');
                return redirect(route('userJobDs.index'));
            }
    
            if($userJobD -> user_id == $user_id)
            {
                return view('user_job_ds.show')
                    ->with('userJobD', $userJobD);
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
            $userJobD = $this->userJobDRepository->findWithoutFail($id);
    
            if(empty($userJobD))
            {
                Flash::error('User Job D not found');
                return redirect(route('userJobDs.index'));
            }
    
            if($userJobD -> user_id == $user_id)
            {
                return view('user_job_ds.edit')
                    ->with('userJobD', $userJobD);
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

    public function update($id, UpdateUserJobDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobD = $this->userJobDRepository->findWithoutFail($id);
    
            if(empty($userJobD))
            {
                Flash::error('User Job D not found');
                return redirect(route('userJobDs.index'));
            }
    
            if($userJobD -> user_id == $user_id)
            {
                $userJobD = $this->userJobDRepository->update($request->all(), $id);
            
                Flash::success('User Job D updated successfully.');
                return redirect(route('userJobDs.index'));
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
            $userJobD = $this->userJobDRepository->findWithoutFail($id);
    
            if (empty($userJobD))
            {
                Flash::error('User Job D not found');
                return redirect(route('userJobDs.index'));
            }
    
            if($userJobD -> user_id == $user_id)
            {
                $this->userJobDRepository->delete($id);
            
                Flash::success('User Job D deleted successfully.');
                return redirect(route('userJobDs.index'));
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