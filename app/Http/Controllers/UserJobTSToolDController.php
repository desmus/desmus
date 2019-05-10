<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSToolDRequest;
use App\Http\Requests\UpdateUserJobTSToolDRequest;
use App\Repositories\UserJobTSToolDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSToolDController extends AppBaseController
{
    private $userJobTSToolDRepository;

    public function __construct(UserJobTSToolDRepository $userJobTSToolDRepo)
    {
        $this->userJobTSToolDRepository = $userJobTSToolDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSToolDRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSToolDs = $this->userJobTSToolDRepository->all();
    
            return view('user_job_t_s_tool_ds.index')
                ->with('userJobTSToolDs', $userJobTSToolDs);
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
            return view('user_job_t_s_tool_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSToolDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSToolD = $this->userJobTSToolDRepository->create($input);
                
                Flash::success('User Job T S Tool D saved successfully.');
                return redirect(route('userJobTSToolDs.index'));
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
            $userJobTSToolD = $this->userJobTSToolDRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolD))
            {
                Flash::error('User Job T S Tool D not found');
                return redirect(route('userJobTSToolDs.index'));
            }
    
            if($userJobTSToolD -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_ds.show')
                    ->with('userJobTSToolD', $userJobTSToolD);
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
            $userJobTSToolD = $this->userJobTSToolDRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolD))
            {
                Flash::error('User Job T S Tool D not found');
                return redirect(route('userJobTSToolDs.index'));
            }
    
            if($userJobTSToolD -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_ds.edit')
                    ->with('userJobTSToolD', $userJobTSToolD);
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

    public function update($id, UpdateUserJobTSToolDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSToolD = $this->userJobTSToolDRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolD))
            {
                Flash::error('User Job T S Tool D not found');
                return redirect(route('userJobTSToolDs.index'));
            }
    
            if($userJobTSToolD -> user_id == $user_id)
            {
                $userJobTSToolD = $this->userJobTSToolDRepository->update($request->all(), $id);
            
                Flash::success('User Job T S Tool D updated successfully.');
                return redirect(route('userJobTSToolDs.index'));
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
            $userJobTSToolD = $this->userJobTSToolDRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolD))
            {
                Flash::error('User Job T S Tool D not found');
                return redirect(route('userJobTSToolDs.index'));
            }
    
            if($userJobTSToolD -> user_id == $user_id)
            {
                $this->userJobTSToolDRepository->delete($id);
            
                Flash::success('User Job T S Tool D deleted successfully.');
                return redirect(route('userJobTSToolDs.index'));
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