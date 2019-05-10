<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSToolURequest;
use App\Http\Requests\UpdateUserJobTSToolURequest;
use App\Repositories\UserJobTSToolURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSToolUController extends AppBaseController
{
    private $userJobTSToolURepository;

    public function __construct(UserJobTSToolURepository $userJobTSToolURepo)
    {
        $this->userJobTSToolURepository = $userJobTSToolURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSToolURepository->pushCriteria(new RequestCriteria($request));
            $userJobTSToolUs = $this->userJobTSToolURepository->all();
    
            return view('user_job_t_s_tool_us.index')
                ->with('userJobTSToolUs', $userJobTSToolUs);
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
            return view('user_job_t_s_tool_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSToolURequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userJobTSToolU = $this->userJobTSToolURepository->create($input);
            
                Flash::success('User Job T S Tool U saved successfully.');
                return redirect(route('userJobTSToolUs.index'));
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
            $userJobTSToolU = $this->userJobTSToolURepository->findWithoutFail($id);
    
            if(empty($userJobTSToolU))
            {
                Flash::error('User Job T S Tool U not found');
                return redirect(route('userJobTSToolUs.index'));
            }
    
            if($userJobTSToolU -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_us.show')
                    ->with('userJobTSToolU', $userJobTSToolU);
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
            $userJobTSToolU = $this->userJobTSToolURepository->findWithoutFail($id);
    
            if(empty($userJobTSToolU))
            {
                Flash::error('User Job T S Tool U not found');
                return redirect(route('userJobTSToolUs.index'));
            }
    
            if($userJobTSToolU -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_us.edit')
                    ->with('userJobTSToolU', $userJobTSToolU);
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

    public function update($id, UpdateUserJobTSToolURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSToolU = $this->userJobTSToolURepository->findWithoutFail($id);
    
            if(empty($userJobTSToolU))
            {
                Flash::error('User Job T S Tool U not found');
                return redirect(route('userJobTSToolUs.index'));
            }
    
            if($userJobTSToolU -> user_id == $user_id)
            {
                $userJobTSToolU = $this->userJobTSToolURepository->update($request->all(), $id);
            
                Flash::success('User Job T S Tool U updated successfully.');
                return redirect(route('userJobTSToolUs.index'));
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
            $userJobTSToolU = $this->userJobTSToolURepository->findWithoutFail($id);
    
            if(empty($userJobTSToolU))
            {
                Flash::error('User Job T S Tool U not found');
                return redirect(route('userJobTSToolUs.index'));
            }
    
            if($userJobTSToolU -> user_id == $user_id)
            {
                $this->userJobTSToolURepository->delete($id);
            
                Flash::success('User Job T S Tool U deleted successfully.');
                return redirect(route('userJobTSToolUs.index'));
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