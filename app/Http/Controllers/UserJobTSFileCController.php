<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSFileCRequest;
use App\Http\Requests\UpdateUserJobTSFileCRequest;
use App\Repositories\UserJobTSFileCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSFileCController extends AppBaseController
{
    private $userJobTSFileCRepository;

    public function __construct(UserJobTSFileCRepository $userJobTSFileCRepo)
    {
        $this->userJobTSFileCRepository = $userJobTSFileCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSFileCRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSFileCs = $this->userJobTSFileCRepository->all();
    
            return view('user_job_t_s_file_cs.index')
                ->with('userJobTSFileCs', $userJobTSFileCs);
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
            return view('user_job_t_s_file_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSFileC = $this->userJobTSFileCRepository->create($input);
                
                Flash::success('User Job T S File C saved successfully.');
                return redirect(route('userJobTSFileCs.index'));
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
            $userJobTSFileC = $this->userJobTSFileCRepository->findWithoutFail($id);
    
            if(empty($userJobTSFileC))
            {
                Flash::error('User Job T S File C not found');
                return redirect(route('userJobTSFileCs.index'));
            }
    
            if($userJobTSFileC -> user_id == $user_id)
            {
                return view('user_job_t_s_file_cs.show')
                    ->with('userJobTSFileC', $userJobTSFileC);
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
            $userJobTSFileC = $this->userJobTSFileCRepository->findWithoutFail($id);
    
            if(empty($userJobTSFileC))
            {
                Flash::error('User Job T S File C not found');
                return redirect(route('userJobTSFileCs.index'));
            }
    
            if($userJobTSFileC -> user_id == $user_id)
            {
                return view('user_job_t_s_file_cs.edit')
                    ->with('userJobTSFileC', $userJobTSFileC);
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

    public function update($id, UpdateUserJobTSFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSFileC = $this->userJobTSFileCRepository->findWithoutFail($id);
    
            if(empty($userJobTSFileC))
            {
                Flash::error('User Job T S File C not found');
                return redirect(route('userJobTSFileCs.index'));
            }
    
            if($userJobTSFileC -> user_id == $user_id)
            {
                $userJobTSFileC = $this->userJobTSFileCRepository->update($request->all(), $id);
            
                Flash::success('User Job T S File C updated successfully.');
                return redirect(route('userJobTSFileCs.index'));
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
            $userJobTSFileC = $this->userJobTSFileCRepository->findWithoutFail($id);
    
            if(empty($userJobTSFileC))
            {
                Flash::error('User Job T S File C not found');
                return redirect(route('userJobTSFileCs.index'));
            }
    
            if($userJobTSFileC -> user_id == $user_id)
            {
                $this->userJobTSFileCRepository->delete($id);
            
                Flash::success('User Job T S File C deleted successfully.');
                return redirect(route('userJobTSFileCs.index'));
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