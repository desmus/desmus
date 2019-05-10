<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeCRequest;
use App\Http\Requests\UpdateUserCollegeCRequest;
use App\Repositories\UserCollegeCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeCController extends AppBaseController
{
    private $userCollegeCRepository;

    public function __construct(UserCollegeCRepository $userCollegeCRepo)
    {
        $this->userCollegeCRepository = $userCollegeCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeCRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeCs = $this->userCollegeCRepository->all();
    
            return view('user_college_cs.index')
                ->with('userCollegeCs', $userCollegeCs);
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
            return view('user_college_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeC = $this->userCollegeCRepository->create($input);
            
                Flash::success('User College C saved successfully.');
                return redirect(route('userCollegeCreates.index'));
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
            $userCollegeC = $this->userCollegeCRepository->findWithoutFail($id);
    
            if(empty($userCollegeC))
            {
                Flash::error('User College C not found');
                return redirect(route('userCollegeCreates.index'));
            }
            
            if($userCollegeC -> user_id == $user_id)
            {
                return view('user_college_cs.show')
                    ->with('userCollegeC', $userCollegeC);
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
            $userCollegeC = $this->userCollegeCRepository->findWithoutFail($id);
    
            if(empty($userCollegeC))
            {
                Flash::error('User College C not found');
                return redirect(route('userCollegeCreates.index'));
            }
    
            if($userCollegeC -> user_id == $user_id)
            {
                return view('user_college_cs.edit')
                    ->with('userCollegeC', $userCollegeC);
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

    public function update($id, UpdateUserCollegeCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeC = $this->userCollegeCRepository->findWithoutFail($id);
    
            if(empty($userCollegeC))
            {
                Flash::error('User College C not found');
                return redirect(route('userCollegeCreates.index'));
            }
    
            if($userCollegeC -> user_id == $user_id)
            {
                $userCollegeC = $this->userCollegeCRepository->update($request->all(), $id);
            
                Flash::success('User College C updated successfully.');
                return redirect(route('userCollegeCreates.index'));
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
            $userCollegeC = $this->userCollegeCRepository->findWithoutFail($id);
    
            if(empty($userCollegeC))
            {
                Flash::error('User College C not found');
                return redirect(route('userCollegeCreates.index'));
            }
    
            if($userCollegeC -> user_id == $user_id)
            {
                $this->userCollegeCRepository->delete($id);
            
                Flash::success('User College C deleted successfully.');
                return redirect(route('userCollegeCreates.index'));
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