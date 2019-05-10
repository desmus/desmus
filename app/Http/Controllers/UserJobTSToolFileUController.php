<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSToolFileURequest;
use App\Http\Requests\UpdateUserJobTSToolFileURequest;
use App\Repositories\UserJobTSToolFileURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSToolFileUController extends AppBaseController
{
    private $userJobTSToolFileURepository;

    public function __construct(UserJobTSToolFileURepository $userJobTSToolFileURepo)
    {
        $this->userJobTSToolFileURepository = $userJobTSToolFileURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSToolFileURepository->pushCriteria(new RequestCriteria($request));
            $userJobTSToolFileUs = $this->userJobTSToolFileURepository->all();
    
            return view('user_job_t_s_tool_file_us.index')
                ->with('userJobTSToolFileUs', $userJobTSToolFileUs);
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
            return view('user_job_t_s_tool_file_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSToolFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userJobTSToolFileU = $this->userJobTSToolFileURepository->create($input);
            
                Flash::success('User Job T S Tool File U saved successfully.');
                return redirect(route('userJobTSToolFileUs.index'));
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
            $input = $request->all();
            $user_id = Auth::user()->id;
            $userJobTSToolFileU = $this->userJobTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileU))
            {
                Flash::error('User Job T S Tool File U not found');
                return redirect(route('userJobTSToolFileUs.index'));
            }
    
            if($userJobTSToolFileU -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_file_us.show')
                    ->with('userJobTSToolFileU', $userJobTSToolFileU);
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
            $userJobTSToolFileU = $this->userJobTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileU))
            {
                Flash::error('User Job T S Tool File U not found');
                return redirect(route('userJobTSToolFileUs.index'));
            }
    
            if($userJobTSToolFileU -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_file_us.edit')
                    ->with('userJobTSToolFileU', $userJobTSToolFileU);
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

    public function update($id, UpdateUserJobTSToolFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSToolFileU = $this->userJobTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileU))
            {
                Flash::error('User Job T S Tool File U not found');
                return redirect(route('userJobTSToolFileUs.index'));
            }
    
            if($userJobTSToolFileU -> user_id == $user_id)
            {
                $userJobTSToolFileU = $this->userJobTSToolFileURepository->update($request->all(), $id);
            
                Flash::success('User Job T S Tool File U updated successfully.');
                return redirect(route('userJobTSToolFileUs.index'));
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
            $userJobTSToolFileU = $this->userJobTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileU))
            {
                Flash::error('User Job T S Tool File U not found');
                return redirect(route('userJobTSToolFileUs.index'));
            }
    
            if($userJobTSToolFileU -> user_id == $user_id)
            {
                $this->userJobTSToolFileURepository->delete($id);
            
                Flash::success('User Job T S Tool File U deleted successfully.');
                return redirect(route('userJobTSToolFileUs.index'));
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