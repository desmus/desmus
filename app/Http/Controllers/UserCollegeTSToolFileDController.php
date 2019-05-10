<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSToolFileDRequest;
use App\Http\Requests\UpdateUserCollegeTSToolFileDRequest;
use App\Repositories\UserCollegeTSToolFileDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSToolFileDController extends AppBaseController
{
    private $userCollegeTSToolFileDRepository;

    public function __construct(UserCollegeTSToolFileDRepository $userCollegeTSToolFileDRepo)
    {
        $this->userCollegeTSToolFileDRepository = $userCollegeTSToolFileDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSToolFileDRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSToolFileDs = $this->userCollegeTSToolFileDRepository->all();
    
            return view('user_college_t_s_tool_file_ds.index')
                ->with('userCollegeTSToolFileDs', $userCollegeTSToolFileDs);
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
            return view('user_college_t_s_tool_file_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSToolFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSToolFileD = $this->userCollegeTSToolFileDRepository->create($input);
            
                Flash::success('User College T S Tool File D saved successfully.');
                return redirect(route('userCollegeTSToolFileDs.index'));
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
            $userCollegeTSToolFileD = $this->userCollegeTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileD))
            {
                Flash::error('User College T S Tool File D not found');
                return redirect(route('userCollegeTSToolFileDs.index'));
            }
            
            if($userCollegeTSToolFileD -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_file_ds.show')
                    ->with('userCollegeTSToolFileD', $userCollegeTSToolFileD);
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
            $userCollegeTSToolFileD = $this->userCollegeTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileD))
            {
                Flash::error('User College T S Tool File D not found');
                return redirect(route('userCollegeTSToolFileDs.index'));
            }
    
            if($userCollegeTSToolFileD -> user_id == $user_id)
            {
                return view('user_college_t_s_tool_file_ds.edit')
                    ->with('userCollegeTSToolFileD', $userCollegeTSToolFileD);
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

    public function update($id, UpdateUserCollegeTSToolFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSToolFileD = $this->userCollegeTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileD))
            {
                Flash::error('User College T S Tool File D not found');
                return redirect(route('userCollegeTSToolFileDs.index'));
            }
            
            if($userCollegeTSToolFileD -> user_id == $user_id)
            {
                $userCollegeTSToolFileD = $this->userCollegeTSToolFileDRepository->update($request->all(), $id);
            
                Flash::success('User College T S Tool File D updated successfully.');
                return redirect(route('userCollegeTSToolFileDs.index'));
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
            $userCollegeTSToolFileD = $this->userCollegeTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFileD))
            {
                Flash::error('User College T S Tool File D not found');
                return redirect(route('userCollegeTSToolFileDs.index'));
            }
    
            if($userCollegeTSToolFileD -> user_id == $user_id)
            {
                $this->userCollegeTSToolFileDRepository->delete($id);
            
                Flash::success('User College T S Tool File D deleted successfully.');
                return redirect(route('userCollegeTSToolFileDs.index'));
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