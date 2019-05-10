<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSFileCRequest;
use App\Http\Requests\UpdateUserCollegeTSFileCRequest;
use App\Repositories\UserCollegeTSFileCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSFileCController extends AppBaseController
{
    private $userCollegeTSFileCRepository;

    public function __construct(UserCollegeTSFileCRepository $userCollegeTSFileCRepo)
    {
        $this->userCollegeTSFileCRepository = $userCollegeTSFileCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSFileCRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSFileCs = $this->userCollegeTSFileCRepository->all();
    
            return view('user_college_t_s_file_cs.index')
                ->with('userCollegeTSFileCs', $userCollegeTSFileCs);
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
            return view('user_college_t_s_file_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSFileC = $this->userCollegeTSFileCRepository->create($input);
            
                Flash::success('User College T S File C saved successfully.');
                return redirect(route('userCollegeTSFileCs.index'));
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
            $userCollegeTSFileC = $this->userCollegeTSFileCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileC))
            {
                Flash::error('User College T S File C not found');
                return redirect(route('userCollegeTSFileCs.index'));
            }
    
            if($userCollegeTSFileC -> user_id == $user_id)
            {
                return view('user_college_t_s_file_cs.show')
                    ->with('userCollegeTSFileC', $userCollegeTSFileC);
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
            $userCollegeTSFileC = $this->userCollegeTSFileCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileC))
            {
                Flash::error('User College T S File C not found');
                return redirect(route('userCollegeTSFileCs.index'));
            }
    
            if($userCollegeTSFileC -> user_id == $user_id)
            {
                return view('user_college_t_s_file_cs.edit')
                    ->with('userCollegeTSFileC', $userCollegeTSFileC);
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

    public function update($id, UpdateUserCollegeTSFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $userCollegeTSFileC = $this->userCollegeTSFileCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileC))
            {
                Flash::error('User College T S File C not found');
                return redirect(route('userCollegeTSFileCs.index'));
            }
    
            if($userCollegeTSFileC -> user_id == $user_id)
            {
                $userCollegeTSFileC = $this->userCollegeTSFileCRepository->update($request->all(), $id);
            
                Flash::success('User College T S File C updated successfully.');
                return redirect(route('userCollegeTSFileCs.index'));
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
            $userCollegeTSFileC = $this->userCollegeTSFileCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileC))
            {
                Flash::error('User College T S File C not found');
                return redirect(route('userCollegeTSFileCs.index'));
            }
    
            if($userCollegeTSFileC -> user_id == $user_id)
            {
                $this->userCollegeTSFileCRepository->delete($id);
            
                Flash::success('User College T S File C deleted successfully.');
                return redirect(route('userCollegeTSFileCs.index'));
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