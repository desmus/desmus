<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSFileDRequest;
use App\Http\Requests\UpdateUserCollegeTSFileDRequest;
use App\Repositories\UserCollegeTSFileDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSFileDController extends AppBaseController
{
    private $userCollegeTSFileDRepository;

    public function __construct(UserCollegeTSFileDRepository $userCollegeTSFileDRepo)
    {
        $this->userCollegeTSFileDRepository = $userCollegeTSFileDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSFileDRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSFileDs = $this->userCollegeTSFileDRepository->all();
    
            return view('user_college_t_s_file_ds.index')
                ->with('userCollegeTSFileDs', $userCollegeTSFileDs);
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
            return view('user_college_t_s_file_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSFileD = $this->userCollegeTSFileDRepository->create($input);
                
                Flash::success('User College T S File D saved successfully.');
                return redirect(route('userCollegeTSFileDs.index'));
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
            $userCollegeTSFileD = $this->userCollegeTSFileDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileD))
            {
                Flash::error('User College T S File D not found');
                return redirect(route('userCollegeTSFileDs.index'));
            }
            
            if($userCollegeTSFileD -> user_id == $user_id)
            {
                return view('user_college_t_s_file_ds.show')
                    ->with('userCollegeTSFileD', $userCollegeTSFileD);
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
            $userCollegeTSFileD = $this->userCollegeTSFileDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileD))
            {
                Flash::error('User College T S File D not found');
                return redirect(route('userCollegeTSFileDs.index'));
            }
    
            if($userCollegeTSFileD -> user_id == $user_id)
            {
                return view('user_college_t_s_file_ds.edit')
                    ->with('userCollegeTSFileD', $userCollegeTSFileD);
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

    public function update($id, UpdateUserCollegeTSFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSFileD = $this->userCollegeTSFileDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileD))
            {
                Flash::error('User College T S File D not found');
                return redirect(route('userCollegeTSFileDs.index'));
            }
    
            if($userCollegeTSFileD -> user_id == $user_id)
            {
                $userCollegeTSFileD = $this->userCollegeTSFileDRepository->update($request->all(), $id);
            
                Flash::success('User College T S File D updated successfully.');
                return redirect(route('userCollegeTSFileDs.index'));
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
            $userCollegeTSFileD = $this->userCollegeTSFileDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFileD))
            {
                Flash::error('User College T S File D not found');
                return redirect(route('userCollegeTSFileDs.index'));
            }
    
            if($userCollegeTSFileD -> user_id == $user_id)
            {
                $this->userCollegeTSFileDRepository->delete($id);
            
                Flash::success('User College T S File D deleted successfully.');
                return redirect(route('userCollegeTSFileDs.index'));
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