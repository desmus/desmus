<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSToolCRequest;
use App\Http\Requests\UpdateUserCollegeTSToolCRequest;
use App\Repositories\UserCollegeTSToolCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSToolCController extends AppBaseController
{
    private $userCollegeTSToolCRepository;

    public function __construct(UserCollegeTSToolCRepository $userCollegeTSToolCRepo)
    {
        $this->userCollegeTSToolCRepository = $userCollegeTSToolCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSToolCRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSToolCs = $this->userCollegeTSToolCRepository->all();
    
            return view('user_college_t_s_tool_cs.index')
                ->with('userCollegeTSToolCs', $userCollegeTSToolCs);
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
            return view('user_college_t_s_tool_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSToolCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSToolC = $this->userCollegeTSToolCRepository->create($input);
            
                Flash::success('User College T S Tool C saved successfully.');
                return redirect(route('userCollegeTSToolCs.index'));
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
            $userCollegeTSToolC = $this->userCollegeTSToolCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolC))
            {
                Flash::error('User College T S Tool C not found');
                return redirect(route('userCollegeTSToolCs.index'));
            }
    
            if($userCollegeTSToolC -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_cs.show')
                    ->with('userCollegeTSToolC', $userCollegeTSToolC);
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
            $userCollegeTSToolC = $this->userCollegeTSToolCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolC))
            {
                Flash::error('User College T S Tool C not found');
                return redirect(route('userCollegeTSToolCs.index'));
            }
    
            if($userCollegeTSToolC -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_cs.edit')
                    ->with('userCollegeTSToolC', $userCollegeTSToolC);
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

    public function update($id, UpdateUserCollegeTSToolCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSToolC = $this->userCollegeTSToolCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolC))
            {
                Flash::error('User College T S Tool C not found');
                return redirect(route('userCollegeTSToolCs.index'));
            }
    
            if($userCollegeTSToolC -> user_id == $user_id)
            {
                $userCollegeTSToolC = $this->userCollegeTSToolCRepository->update($request->all(), $id);
            
                Flash::success('User College T S Tool C updated successfully.');
                return redirect(route('userCollegeTSToolCs.index'));
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
            $userCollegeTSToolC = $this->userCollegeTSToolCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolC))
            {
                Flash::error('User College T S Tool C not found');
                return redirect(route('userCollegeTSToolCs.index'));
            }
    
            if($userCollegeTSToolC -> user_id == $user_id)
            {
                $this->userCollegeTSToolCRepository->delete($id);
            
                Flash::success('User College T S Tool C deleted successfully.');
                return redirect(route('userCollegeTSToolCs.index'));
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