<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSToolFileCRequest;
use App\Http\Requests\UpdateUserCollegeTSToolFileCRequest;
use App\Repositories\UserCollegeTSToolFileCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSToolFileCController extends AppBaseController
{
    private $userCollegeTSToolFileCRepository;

    public function __construct(UserCollegeTSToolFileCRepository $userCollegeTSToolFileCRepo)
    {
        $this->userCollegeTSToolFileCRepository = $userCollegeTSToolFileCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSToolFileCRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSToolFileCs = $this->userCollegeTSToolFileCRepository->all();
    
            return view('user_college_t_s_tool_file_cs.index')
                ->with('userCollegeTSToolFileCs', $userCollegeTSToolFileCs);
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
            return view('user_college_t_s_tool_file_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSToolFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSToolFileC = $this->userCollegeTSToolFileCRepository->create($input);
            
                Flash::success('User College T S Tool File C saved successfully.');
                return redirect(route('userCollegeTSToolFileCs.index'));
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
            $userCollegeTSToolFileC = $this->userCollegeTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileC))
            {
                Flash::error('User College T S Tool File C not found');
                return redirect(route('userCollegeTSToolFileCs.index'));
            }
    
            if($userCollegeTSToolFileC -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_file_cs.show')
                    ->with('userCollegeTSToolFileC', $userCollegeTSToolFileC);
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
            $userCollegeTSToolFileC = $this->userCollegeTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileC))
            {
                Flash::error('User College T S Tool File C not found');
                return redirect(route('userCollegeTSToolFileCs.index'));
            }
    
            if($userCollegeTSToolFileC -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_file_cs.edit')
                    ->with('userCollegeTSToolFileC', $userCollegeTSToolFileC);
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

    public function update($id, UpdateUserCollegeTSToolFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSToolFileC = $this->userCollegeTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileC))
            {
                Flash::error('User College T S Tool File C not found');
                return redirect(route('userCollegeTSToolFileCs.index'));
            }
    
            if($userCollegeTSToolFileC -> user_id == $user_id)
            {
                $userCollegeTSToolFileC = $this->userCollegeTSToolFileCRepository->update($request->all(), $id);
            
                Flash::success('User College T S Tool File C updated successfully.');
                return redirect(route('userCollegeTSToolFileCs.index'));
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
            $userCollegeTSToolFileC = $this->userCollegeTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileC))
            {
                Flash::error('User College T S Tool File C not found');
                return redirect(route('userCollegeTSToolFileCs.index'));
            }
    
            if($userCollegeTSToolFileC -> user_id == $user_id)
            {
                $this->userCollegeTSToolFileCRepository->delete($id);
            
                Flash::success('User College T S Tool File C deleted successfully.');
                return redirect(route('userCollegeTSToolFileCs.index'));
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