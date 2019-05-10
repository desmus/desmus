<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSFileDRequest;
use App\Http\Requests\UpdateUserJobTSFileDRequest;
use App\Repositories\UserJobTSFileDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSFileDController extends AppBaseController
{
    private $userJobTSFileDRepository;

    public function __construct(UserJobTSFileDRepository $userJobTSFileDRepo)
    {
        $this->userJobTSFileDRepository = $userJobTSFileDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSFileDRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSFileDs = $this->userJobTSFileDRepository->all();
    
            return view('user_job_t_s_file_ds.index')
                ->with('userJobTSFileDs', $userJobTSFileDs);
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
            return view('user_job_t_s_file_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSFileD = $this->userJobTSFileDRepository->create($input);
            
                Flash::success('User Job T S File D saved successfully.');
                return redirect(route('userJobTSFileDs.index'));
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
            $userJobTSFileD = $this->userJobTSFileDRepository->findWithoutFail($id);
    
            if(empty($userJobTSFileD))
            {
                Flash::error('User Job T S File D not found');
                return redirect(route('userJobTSFileDs.index'));
            }
    
            if($userJobTSFileD -> user_id == $user_id)
            {
                return view('user_job_t_s_file_ds.show')
                    ->with('userJobTSFileD', $userJobTSFileD);
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
            $userJobTSFileD = $this->userJobTSFileDRepository->findWithoutFail($id);
    
            if(empty($userJobTSFileD))
            {
                Flash::error('User Job T S File D not found');
                return redirect(route('userJobTSFileDs.index'));
            }
    
            if($userJobTSFileD -> user_id == $user_id)
            {
                return view('user_job_t_s_file_ds.edit')
                    ->with('userJobTSFileD', $userJobTSFileD);
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

    public function update($id, UpdateUserJobTSFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSFileD = $this->userJobTSFileDRepository->findWithoutFail($id);
    
            if(empty($userJobTSFileD))
            {
                Flash::error('User Job T S File D not found');
                return redirect(route('userJobTSFileDs.index'));
            }
    
            if($userJobTSFileD -> user_id == $user_id)
            {
                $userJobTSFileD = $this->userJobTSFileDRepository->update($request->all(), $id);
            
                Flash::success('User Job T S File D updated successfully.');
                return redirect(route('userJobTSFileDs.index'));
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
            $userJobTSFileD = $this->userJobTSFileDRepository->findWithoutFail($id);
    
            if(empty($userJobTSFileD))
            {
                Flash::error('User Job T S File D not found');
                return redirect(route('userJobTSFileDs.index'));
            }
    
            if($userJobTSFileD -> user_id == $user_id)
            {
                $this->userJobTSFileDRepository->delete($id);
            
                Flash::success('User Job T S File D deleted successfully.');
                return redirect(route('userJobTSFileDs.index'));
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