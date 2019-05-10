<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSFileDRequest;
use App\Http\Requests\UpdateUserPersonalDataTSFileDRequest;
use App\Repositories\UserPersonalDataTSFileDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSFileDController extends AppBaseController
{
    private $userPersonalDataTSFileDRepository;

    public function __construct(UserPersonalDataTSFileDRepository $userPersonalDataTSFileDRepo)
    {
        $this->userPersonalDataTSFileDRepository = $userPersonalDataTSFileDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSFileDRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSFileDs = $this->userPersonalDataTSFileDRepository->all();
    
            return view('user_personal_data_t_s_file_ds.index')
                ->with('userPersonalDataTSFileDs', $userPersonalDataTSFileDs);
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
            return view('user_personal_data_t_s_file_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSFileD = $this->userPersonalDataTSFileDRepository->create($input);
            
                Flash::success('User Personal Data T S File D saved successfully.');
                return redirect(route('userPersonalDataTSFileDs.index'));
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
            $userPersonalDataTSFileD = $this->userPersonalDataTSFileDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileD))
            {
                Flash::error('User Personal Data T S File D not found');
                return redirect(route('userPersonalDataTSFileDs.index'));
            }
    
            if($userPersonalDataTSFileD -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_file_ds.show')
                    ->with('userPersonalDataTSFileD', $userPersonalDataTSFileD);
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
            $userPersonalDataTSFileD = $this->userPersonalDataTSFileDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileD))
            {
                Flash::error('User Personal Data T S File D not found');
                return redirect(route('userPersonalDataTSFileDs.index'));
            }
    
            if($userPersonalDataTSFileD -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_file_ds.edit')
                    ->with('userPersonalDataTSFileD', $userPersonalDataTSFileD);
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

    public function update($id, UpdateUserPersonalDataTSFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSFileD = $this->userPersonalDataTSFileDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileD))
            {
                Flash::error('User Personal Data T S File D not found');
                return redirect(route('userPersonalDataTSFileDs.index'));
            }
    
            if($userPersonalDataTSFileD -> user_id == $user_id)
            {
                $userPersonalDataTSFileD = $this->userPersonalDataTSFileDRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S File D updated successfully.');
                return redirect(route('userPersonalDataTSFileDs.index'));
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
            $userPersonalDataTSFileD = $this->userPersonalDataTSFileDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileD))
            {
                Flash::error('User Personal Data T S File D not found');
                return redirect(route('userPersonalDataTSFileDs.index'));
            }
    
            if($userPersonalDataTSFileD -> user_id == $user_id)
            {
                $this->userPersonalDataTSFileDRepository->delete($id);
            
                Flash::success('User Personal Data T S File D deleted successfully.');
                return redirect(route('userPersonalDataTSFileDs.index'));
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