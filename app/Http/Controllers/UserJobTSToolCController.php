<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSToolCRequest;
use App\Http\Requests\UpdateUserJobTSToolCRequest;
use App\Repositories\UserJobTSToolCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserJobTSToolCController extends AppBaseController
{
    private $userJobTSToolCRepository;

    public function __construct(UserJobTSToolCRepository $userJobTSToolCRepo)
    {
        $this->userJobTSToolCRepository = $userJobTSToolCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSToolCRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSToolCs = $this->userJobTSToolCRepository->all();
    
            return view('user_job_t_s_tool_cs.index')
                ->with('userJobTSToolCs', $userJobTSToolCs);
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
            return view('user_job_t_s_tool_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSToolCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSToolC = $this->userJobTSToolCRepository->create($input);
                
                Flash::success('User Job T S Tool C saved successfully.');
                return redirect(route('userJobTSToolCs.index'));
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
            $userJobTSToolC = $this->userJobTSToolCRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolC))
            {
                Flash::error('User Job T S Tool C not found');
                return redirect(route('userJobTSToolCs.index'));
            }
    
            if($userJobTSToolC -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_cs.show')
                    ->with('userJobTSToolC', $userJobTSToolC);
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
            $userJobTSToolC = $this->userJobTSToolCRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolC))
            {
                Flash::error('User Job T S Tool C not found');
                return redirect(route('userJobTSToolCs.index'));
            }
    
            if($userJobTSToolC -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_cs.edit')
                    ->with('userJobTSToolC', $userJobTSToolC);
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

    public function update($id, UpdateUserJobTSToolCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSToolC = $this->userJobTSToolCRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolC))
            {
                Flash::error('User Job T S Tool C not found');
                return redirect(route('userJobTSToolCs.index'));
            }
    
            if($userJobTSToolC -> user_id == $user_id)
            {
                $userJobTSToolC = $this->userJobTSToolCRepository->update($request->all(), $id);
            
                Flash::success('User Job T S Tool C updated successfully.');
                return redirect(route('userJobTSToolCs.index'));
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
            $userJobTSToolC = $this->userJobTSToolCRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolC))
            {
                Flash::error('User Job T S Tool C not found');
                return redirect(route('userJobTSToolCs.index'));
            }
    
            if($userJobTSToolC -> user_id == $user_id)
            {
                $this->userJobTSToolCRepository->delete($id);
            
                Flash::success('User Job T S Tool C deleted successfully.');
                return redirect(route('userJobTSToolCs.index'));
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