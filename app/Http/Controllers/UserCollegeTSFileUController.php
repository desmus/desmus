<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSFileURequest;
use App\Http\Requests\UpdateUserCollegeTSFileURequest;
use App\Repositories\UserCollegeTSFileURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSFileUController extends AppBaseController
{
    private $userCollegeTSFileURepository;

    public function __construct(UserCollegeTSFileURepository $userCollegeTSFileURepo)
    {
        $this->userCollegeTSFileURepository = $userCollegeTSFileURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSFileURepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSFileUs = $this->userCollegeTSFileURepository->all();
    
            return view('user_college_t_s_file_us.index')
                ->with('userCollegeTSFileUs', $userCollegeTSFileUs);
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
            return view('user_college_t_s_file_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSFileU = $this->userCollegeTSFileURepository->create($input);
            
                Flash::success('User College T S File U saved successfully.');
                return redirect(route('userCollegeTSFileUs.index'));
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
            $userCollegeTSFileU = $this->userCollegeTSFileURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileU))
            {
                Flash::error('User College T S File U not found');
                return redirect(route('userCollegeTSFileUs.index'));
            }
            
            if($userCollegeTSFileU -> user_id == $user_id)
            {
                return view('user_college_t_s_file_us.show')
                    ->with('userCollegeTSFileU', $userCollegeTSFileU);
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
            $userCollegeTSFileU = $this->userCollegeTSFileURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileU))
            {
                Flash::error('User College T S File U not found');
                return redirect(route('userCollegeTSFileUs.index'));
            }
    
            if($userCollegeTSFileU -> user_id == $user_id)
            {
                return view('user_college_t_s_file_us.edit')
                    ->with('userCollegeTSFileU', $userCollegeTSFileU);
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

    public function update($id, UpdateUserCollegeTSFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSFileU = $this->userCollegeTSFileURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileU))
            {
                Flash::error('User College T S File U not found');
                return redirect(route('userCollegeTSFileUs.index'));
            }
    
            if($userCollegeTSFileU -> user_id == $user_id)
            {
                $userCollegeTSFileU = $this->userCollegeTSFileURepository->update($request->all(), $id);
            
                Flash::success('User College T S File U updated successfully.');
                return redirect(route('userCollegeTSFileUs.index'));
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
            $userCollegeTSFileU = $this->userCollegeTSFileURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileU))
            {
                Flash::error('User College T S File U not found');
                return redirect(route('userCollegeTSFileUs.index'));
            }
    
            if($userCollegeTSFileU -> user_id == $user_id)
            {
                $this->userCollegeTSFileURepository->delete($id);
            
                Flash::success('User College T S File U deleted successfully.');
                return redirect(route('userCollegeTSFileUs.index'));
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