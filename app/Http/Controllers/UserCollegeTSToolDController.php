<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSToolDRequest;
use App\Http\Requests\UpdateUserCollegeTSToolDRequest;
use App\Repositories\UserCollegeTSToolDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSToolDController extends AppBaseController
{
    private $userCollegeTSToolDRepository;

    public function __construct(UserCollegeTSToolDRepository $userCollegeTSToolDRepo)
    {
        $this->userCollegeTSToolDRepository = $userCollegeTSToolDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSToolDRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSToolDs = $this->userCollegeTSToolDRepository->all();
    
            return view('user_college_t_s_tool_ds.index')
                ->with('userCollegeTSToolDs', $userCollegeTSToolDs);
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
            return view('user_college_t_s_tool_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSToolDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSToolD = $this->userCollegeTSToolDRepository->create($input);
                
                Flash::success('User College T S Tool D saved successfully.');
                return redirect(route('userCollegeTSToolDs.index'));
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
            $userCollegeTSToolD = $this->userCollegeTSToolDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolD))
            {
                Flash::error('User College T S Tool D not found');
                return redirect(route('userCollegeTSToolDs.index'));
            }
            
            if($userCollegeTSToolD -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_ds.show')
                    ->with('userCollegeTSToolD', $userCollegeTSToolD);
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
            $userCollegeTSToolD = $this->userCollegeTSToolDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolD))
            {
                Flash::error('User College T S Tool D not found');
                return redirect(route('userCollegeTSToolDs.index'));
            }
    
            if($userCollegeTSToolD -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_ds.edit')
                    ->with('userCollegeTSToolD', $userCollegeTSToolD);
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

    public function update($id, UpdateUserCollegeTSToolDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSToolD = $this->userCollegeTSToolDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolD))
            {
                Flash::error('User College T S Tool D not found');
                return redirect(route('userCollegeTSToolDs.index'));
            }
    
            if($userCollegeTSToolD -> user_id == $user_id)
            {
                $userCollegeTSToolD = $this->userCollegeTSToolDRepository->update($request->all(), $id);
                
                Flash::success('User College T S Tool D updated successfully.');
                return redirect(route('userCollegeTSToolDs.index'));
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
            $userCollegeTSToolD = $this->userCollegeTSToolDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolD))
            {
                Flash::error('User College T S Tool D not found');
                return redirect(route('userCollegeTSToolDs.index'));
            }
    
            if($userCollegeTSToolD -> user_id == $user_id)
            {
                $this->userCollegeTSToolDRepository->delete($id);
            
                Flash::success('User College T S Tool D deleted successfully.');
                return redirect(route('userCollegeTSToolDs.index'));
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