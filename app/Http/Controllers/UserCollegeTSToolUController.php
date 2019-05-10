<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSToolURequest;
use App\Http\Requests\UpdateUserCollegeTSToolURequest;
use App\Repositories\UserCollegeTSToolURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSToolUController extends AppBaseController
{
    private $userCollegeTSToolURepository;

    public function __construct(UserCollegeTSToolURepository $userCollegeTSToolURepo)
    {
        $this->userCollegeTSToolURepository = $userCollegeTSToolURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSToolURepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSToolUs = $this->userCollegeTSToolURepository->all();
    
            return view('user_college_t_s_tool_us.index')
                ->with('userCollegeTSToolUs', $userCollegeTSToolUs);
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
            return view('user_college_t_s_tool_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSToolURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSToolU = $this->userCollegeTSToolURepository->create($input);
            
                Flash::success('User College T S Tool U saved successfully.');
                return redirect(route('userCollegeTSToolUs.index'));
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
            $userCollegeTSToolU = $this->userCollegeTSToolURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolU))
            {
                Flash::error('User College T S Tool U not found');
                return redirect(route('userCollegeTSToolUs.index'));
            }
            
            if($userCollegeTSToolU -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_us.show')
                    ->with('userCollegeTSToolU', $userCollegeTSToolU);
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
            $userCollegeTSToolU = $this->userCollegeTSToolURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolU))
            {
                Flash::error('User College T S Tool U not found');
                return redirect(route('userCollegeTSToolUs.index'));
            }
    
            if($userCollegeTSToolU -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_us.edit')
                    ->with('userCollegeTSToolU', $userCollegeTSToolU);
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

    public function update($id, UpdateUserCollegeTSToolURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSToolU = $this->userCollegeTSToolURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolU))
            {
                Flash::error('User College T S Tool U not found');
                return redirect(route('userCollegeTSToolUs.index'));
            }
    
            if($userCollegeTSToolU -> user_id == $user_id)
            {
                $userCollegeTSToolU = $this->userCollegeTSToolURepository->update($request->all(), $id);
            
                Flash::success('User College T S Tool U updated successfully.');
                return redirect(route('userCollegeTSToolUs.index'));
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
            $userCollegeTSToolU = $this->userCollegeTSToolURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolU))
            {
                Flash::error('User College T S Tool U not found');
                return redirect(route('userCollegeTSToolUs.index'));
            }
    
            if($userCollegeTSToolU -> user_id == $user_id)
            {
                $this->userCollegeTSToolURepository->delete($id);
            
                Flash::success('User College T S Tool U deleted successfully.');
                return redirect(route('userCollegeTSToolUs.index'));
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