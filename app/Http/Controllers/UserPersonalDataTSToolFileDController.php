<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSToolFileDRequest;
use App\Http\Requests\UpdateUserPersonalDataTSToolFileDRequest;
use App\Repositories\UserPersonalDataTSToolFileDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSToolFileDController extends AppBaseController
{
    private $userPersonalDataTSToolFileDRepository;

    public function __construct(UserPersonalDataTSToolFileDRepository $userPersonalDataTSToolFileDRepo)
    {
        $this->userPersonalDataTSToolFileDRepository = $userPersonalDataTSToolFileDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSToolFileDRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSToolFileDs = $this->userPersonalDataTSToolFileDRepository->all();
    
            return view('user_personal_data_t_s_tool_file_ds.index')
                ->with('userPersonalDataTSToolFileDs', $userPersonalDataTSToolFileDs);
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
            return view('user_personal_data_t_s_tool_file_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSToolFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSToolFileD = $this->userPersonalDataTSToolFileDRepository->create($input);
            
                Flash::success('User Personal Data T S Tool File D saved successfully.');
                return redirect(route('userPersonalDataTSToolFileDs.index'));
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
            $userPersonalDataTSToolFileD = $this->userPersonalDataTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileD))
            {
                Flash::error('User Personal Data T S Tool File D not found');
                return redirect(route('userPersonalDataTSToolFileDs.index'));
            }
    
            if($userPersonalDataTSToolFileD -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_file_ds.show')
                    ->with('userPersonalDataTSToolFileD', $userPersonalDataTSToolFileD);
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
            $userPersonalDataTSToolFileD = $this->userPersonalDataTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileD))
            {
                Flash::error('User Personal Data T S Tool File D not found');
                return redirect(route('userPersonalDataTSToolFileDs.index'));
            }
    
            if($userPersonalDataTSToolFileD -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_file_ds.edit')
                    ->with('userPersonalDataTSToolFileD', $userPersonalDataTSToolFileD);
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

    public function update($id, UpdateUserPersonalDataTSToolFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSToolFileD = $this->userPersonalDataTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileD))
            {
                Flash::error('User Personal Data T S Tool File D not found');
                return redirect(route('userPersonalDataTSToolFileDs.index'));
            }
    
            if($userPersonalDataTSToolFileD -> user_id == $user_id)
            {
                $userPersonalDataTSToolFileD = $this->userPersonalDataTSToolFileDRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Tool File D updated successfully.');
                return redirect(route('userPersonalDataTSToolFileDs.index'));
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
            $userPersonalDataTSToolFileD = $this->userPersonalDataTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileD))
            {
                Flash::error('User Personal Data T S Tool File D not found');
                return redirect(route('userPersonalDataTSToolFileDs.index'));
            }
    
            if($userPersonalDataTSToolFileD -> user_id == $user_id)
            {
                $this->userPersonalDataTSToolFileDRepository->delete($id);
            
                Flash::success('User Personal Data T S Tool File D deleted successfully.');
                return redirect(route('userPersonalDataTSToolFileDs.index'));
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