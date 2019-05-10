<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSToolFileDRequest;
use App\Http\Requests\UpdateUserJobTSToolFileDRequest;
use App\Repositories\UserJobTSToolFileDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSToolFileDController extends AppBaseController
{
    private $userJobTSToolFileDRepository;

    public function __construct(UserJobTSToolFileDRepository $userJobTSToolFileDRepo)
    {
        $this->userJobTSToolFileDRepository = $userJobTSToolFileDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSToolFileDRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSToolFileDs = $this->userJobTSToolFileDRepository->all();
    
            return view('user_job_t_s_tool_file_ds.index')
                ->with('userJobTSToolFileDs', $userJobTSToolFileDs);
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
            return view('user_job_t_s_tool_file_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSToolFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userJobTSToolFileD = $this->userJobTSToolFileDRepository->create($input);
            
                Flash::success('User Job T S Tool File D saved successfully.');
                return redirect(route('userJobTSToolFileDs.index'));
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
            $userJobTSToolFileD = $this->userJobTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileD))
            {
                Flash::error('User Job T S Tool File D not found');
                return redirect(route('userJobTSToolFileDs.index'));
            }
    
            if($userJobTSToolFileD -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_file_ds.show')
                    ->with('userJobTSToolFileD', $userJobTSToolFileD);
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
            $userJobTSToolFileD = $this->userJobTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileD))
            {
                Flash::error('User Job T S Tool File D not found');
                return redirect(route('userJobTSToolFileDs.index'));
            }
    
            if($userJobTSToolFileD -> user_id == $user_id)
            {
                return view('user_job_t_s_tool_file_ds.edit')
                    ->with('userJobTSToolFileD', $userJobTSToolFileD);
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

    public function update($id, UpdateUserJobTSToolFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSToolFileD = $this->userJobTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileD))
            {
                Flash::error('User Job T S Tool File D not found');
                return redirect(route('userJobTSToolFileDs.index'));
            }
    
            if($userJobTSToolFileD -> user_id == $user_id)
            {
                $userJobTSToolFileD = $this->userJobTSToolFileDRepository->update($request->all(), $id);
            
                Flash::success('User Job T S Tool File D updated successfully.');
                return redirect(route('userJobTSToolFileDs.index'));
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
            $userJobTSToolFileD = $this->userJobTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFileD))
            {
                Flash::error('User Job T S Tool File D not found');
                return redirect(route('userJobTSToolFileDs.index'));
            }
    
            if($userJobTSToolFileD -> user_id == $user_id)
            {
                $this->userJobTSToolFileDRepository->delete($id);
            
                Flash::success('User Job T S Tool File D deleted successfully.');
                return redirect(route('userJobTSToolFileDs.index'));
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