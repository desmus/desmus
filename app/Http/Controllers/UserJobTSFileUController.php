<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSFileURequest;
use App\Http\Requests\UpdateUserJobTSFileURequest;
use App\Repositories\UserJobTSFileURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSFileUController extends AppBaseController
{
    private $userJobTSFileURepository;

    public function __construct(UserJobTSFileURepository $userJobTSFileURepo)
    {
        $this->userJobTSFileURepository = $userJobTSFileURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSFileURepository->pushCriteria(new RequestCriteria($request));
            $userJobTSFileUs = $this->userJobTSFileURepository->all();
    
            return view('user_job_t_s_file_us.index')
                ->with('userJobTSFileUs', $userJobTSFileUs);
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
            return view('user_job_t_s_file_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSFileU = $this->userJobTSFileURepository->create($input);
            
                Flash::success('User Job T S File U saved successfully.');
                return redirect(route('userJobTSFileUs.index'));
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
            $userJobTSFileU = $this->userJobTSFileURepository->findWithoutFail($id);
    
            if(empty($userJobTSFileU))
            {
                Flash::error('User Job T S File U not found');
                return redirect(route('userJobTSFileUs.index'));
            }
    
            if($userJobTSFileU -> user_id == $user_id)
            {
                return view('user_job_t_s_file_us.show')
                    ->with('userJobTSFileU', $userJobTSFileU);
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
            $userJobTSFileU = $this->userJobTSFileURepository->findWithoutFail($id);
    
            if(empty($userJobTSFileU))
            {
                Flash::error('User Job T S File U not found');
                return redirect(route('userJobTSFileUs.index'));
            }
    
            if($userJobTSFileU -> user_id == $user_id)
            {
                return view('user_job_t_s_file_us.edit')
                    ->with('userJobTSFileU', $userJobTSFileU);
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

    public function update($id, UpdateUserJobTSFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSFileU = $this->userJobTSFileURepository->findWithoutFail($id);
    
            if(empty($userJobTSFileU))
            {
                Flash::error('User Job T S File U not found');
                return redirect(route('userJobTSFileUs.index'));
            }
    
            if($userJobTSFileU -> user_id == $user_id)
            {
                $userJobTSFileU = $this->userJobTSFileURepository->update($request->all(), $id);
            
                Flash::success('User Job T S File U updated successfully.');
                return redirect(route('userJobTSFileUs.index'));
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
            $userJobTSFileU = $this->userJobTSFileURepository->findWithoutFail($id);
    
            if(empty($userJobTSFileU))
            {
                Flash::error('User Job T S File U not found');
                return redirect(route('userJobTSFileUs.index'));
            }
    
            if($userJobTSFileU -> user_id == $user_id)
            {
                $this->userJobTSFileURepository->delete($id);
            
                Flash::success('User Job T S File U deleted successfully.');
                return redirect(route('userJobTSFileUs.index'));
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