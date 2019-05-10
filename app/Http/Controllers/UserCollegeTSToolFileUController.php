<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSToolFileURequest;
use App\Http\Requests\UpdateUserCollegeTSToolFileURequest;
use App\Repositories\UserCollegeTSToolFileURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSToolFileUController extends AppBaseController
{
    private $userCollegeTSToolFileURepository;

    public function __construct(UserCollegeTSToolFileURepository $userCollegeTSToolFileURepo)
    {
        $this->userCollegeTSToolFileURepository = $userCollegeTSToolFileURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSToolFileURepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSToolFileUs = $this->userCollegeTSToolFileURepository->all();
    
            return view('user_college_t_s_tool_file_us.index')
                ->with('userCollegeTSToolFileUs', $userCollegeTSToolFileUs);
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
            return view('user_college_t_s_tool_file_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSToolFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSToolFileU = $this->userCollegeTSToolFileURepository->create($input);
            
                Flash::success('User College T S Tool File U saved successfully.');
                return redirect(route('userCollegeTSToolFileUs.index'));
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
            $userCollegeTSToolFileU = $this->userCollegeTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileU))
            {
                Flash::error('User College T S Tool File U not found');
                return redirect(route('userCollegeTSToolFileUs.index'));
            }
    
            if($userCollegeTSToolFileU -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_file_us.show')
                    ->with('userCollegeTSToolFileU', $userCollegeTSToolFileU);
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
            $userCollegeTSToolFileU = $this->userCollegeTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileU))
            {
                Flash::error('User College T S Tool File U not found');
                return redirect(route('userCollegeTSToolFileUs.index'));
            }
    
            if($userCollegeTSToolFileU -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_file_us.edit')
                    ->with('userCollegeTSToolFileU', $userCollegeTSToolFileU);
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

    public function update($id, UpdateUserCollegeTSToolFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSToolFileU = $this->userCollegeTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileU))
            {
                Flash::error('User College T S Tool File U not found');
                return redirect(route('userCollegeTSToolFileUs.index'));
            }
    
            if($userCollegeTSToolFileU -> user_id == $user_id)
            {
                $userCollegeTSToolFileU = $this->userCollegeTSToolFileURepository->update($request->all(), $id);
            
                Flash::success('User College T S Tool File U updated successfully.');
                return redirect(route('userCollegeTSToolFileUs.index'));
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
            $userCollegeTSToolFileU = $this->userCollegeTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileU))
            {
                Flash::error('User College T S Tool File U not found');
                return redirect(route('userCollegeTSToolFileUs.index'));
            }
    
            if($userCollegeTSToolFileU -> user_id == $user_id)
            {
                $this->userCollegeTSToolFileURepository->delete($id);
            
                Flash::success('User College T S Tool File U deleted successfully.');
                return redirect(route('userCollegeTSToolFileUs.index'));
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