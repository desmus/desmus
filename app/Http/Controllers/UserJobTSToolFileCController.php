<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSToolFileCRequest;
use App\Http\Requests\UpdateUserJobTSToolFileCRequest;
use App\Repositories\UserJobTSToolFileCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSToolFileCController extends AppBaseController
{
    private $userJobTSToolFileCRepository;

    public function __construct(UserJobTSToolFileCRepository $userJobTSToolFileCRepo)
    {
        $this->userJobTSToolFileCRepository = $userJobTSToolFileCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSToolFileCRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSToolFileCs = $this->userJobTSToolFileCRepository->all();
    
            return view('user_job_t_s_tool_file_cs.index')
                ->with('userJobTSToolFileCs', $userJobTSToolFileCs);
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
            return view('user_job_t_s_tool_file_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSToolFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSToolFileC = $this->userJobTSToolFileCRepository->create($input);
            
                Flash::success('User Job T S Tool File C saved successfully.');
                return redirect(route('userJobTSToolFileCs.index'));
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
            $userJobTSToolFileC = $this->userJobTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileC))
            {
                Flash::error('User Job T S Tool File C not found');
                return redirect(route('userJobTSToolFileCs.index'));
            }
            
            if($userJobTSToolFileC -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_file_cs.show')
                    ->with('userJobTSToolFileC', $userJobTSToolFileC);
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
            $userJobTSToolFileC = $this->userJobTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileC))
            {
                Flash::error('User Job T S Tool File C not found');
                return redirect(route('userJobTSToolFileCs.index'));
            }
    
            if($userJobTSToolFileC -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_file_cs.edit')
                    ->with('userJobTSToolFileC', $userJobTSToolFileC);
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

    public function update($id, UpdateUserJobTSToolFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSToolFileC = $this->userJobTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileC))
            {
                Flash::error('User Job T S Tool File C not found');
                return redirect(route('userJobTSToolFileCs.index'));
            }
    
            if($userJobTSToolFileC -> user_id == $user_id)
            {
                $userJobTSToolFileC = $this->userJobTSToolFileCRepository->update($request->all(), $id);
            
                Flash::success('User Job T S Tool File C updated successfully.');
                return redirect(route('userJobTSToolFileCs.index'));
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
            $userJobTSToolFileC = $this->userJobTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileC))
            {
                Flash::error('User Job T S Tool File C not found');
                return redirect(route('userJobTSToolFileCs.index'));
            }
    
            if($userJobTSToolFileC -> user_id == $user_id)
            {
                $this->userJobTSToolFileCRepository->delete($id);
            
                Flash::success('User Job T S Tool File C deleted successfully.');
                return redirect(route('userJobTSToolFileCs.index'));
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