<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSFileCRequest;
use App\Http\Requests\UpdateUserPersonalDataTSFileCRequest;
use App\Repositories\UserPersonalDataTSFileCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSFileCController extends AppBaseController
{
    private $userPersonalDataTSFileCRepository;

    public function __construct(UserPersonalDataTSFileCRepository $userPersonalDataTSFileCRepo)
    {
        $this->userPersonalDataTSFileCRepository = $userPersonalDataTSFileCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSFileCRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSFileCs = $this->userPersonalDataTSFileCRepository->all();
    
            return view('user_personal_data_t_s_file_cs.index')
                ->with('userPersonalDataTSFileCs', $userPersonalDataTSFileCs);
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
            return view('user_personal_data_t_s_file_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSFileC = $this->userPersonalDataTSFileCRepository->create($input);
            
                Flash::success('User Personal Data T S File C saved successfully.');
                return redirect(route('userPersonalDataTSFileCs.index'));
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
            $userPersonalDataTSFileC = $this->userPersonalDataTSFileCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileC))
            {
                Flash::error('User Personal Data T S File C not found');
                return redirect(route('userPersonalDataTSFileCs.index'));
            }
    
            if($userPersonalDataTSFileC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_file_cs.show')
                    ->with('userPersonalDataTSFileC', $userPersonalDataTSFileC);
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
            $userPersonalDataTSFileC = $this->userPersonalDataTSFileCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileC))
            {
                Flash::error('User Personal Data T S File C not found');
                return redirect(route('userPersonalDataTSFileCs.index'));
            }
    
            if($userPersonalDataTSFileC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_file_cs.edit')
                    ->with('userPersonalDataTSFileC', $userPersonalDataTSFileC);
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

    public function update($id, UpdateUserPersonalDataTSFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSFileC = $this->userPersonalDataTSFileCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileC))
            {
                Flash::error('User Personal Data T S File C not found');
                return redirect(route('userPersonalDataTSFileCs.index'));
            }
    
            if($userPersonalDataTSFileC -> user_id == $user_id)
            {
                $userPersonalDataTSFileC = $this->userPersonalDataTSFileCRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S File C updated successfully.');
                return redirect(route('userPersonalDataTSFileCs.index'));
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
            $userPersonalDataTSFileC = $this->userPersonalDataTSFileCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileC))
            {
                Flash::error('User Personal Data T S File C not found');
                return redirect(route('userPersonalDataTSFileCs.index'));
            }
    
            if($userPersonalDataTSFileC -> user_id == $user_id)
            {
                $this->userPersonalDataTSFileCRepository->delete($id);
            
                Flash::success('User Personal Data T S File C deleted successfully.');
                return redirect(route('userPersonalDataTSFileCs.index'));
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