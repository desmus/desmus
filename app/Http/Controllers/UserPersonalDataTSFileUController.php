<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSFileURequest;
use App\Http\Requests\UpdateUserPersonalDataTSFileURequest;
use App\Repositories\UserPersonalDataTSFileURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSFileUController extends AppBaseController
{
    private $userPersonalDataTSFileURepository;

    public function __construct(UserPersonalDataTSFileURepository $userPersonalDataTSFileURepo)
    {
        $this->userPersonalDataTSFileURepository = $userPersonalDataTSFileURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSFileURepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSFileUs = $this->userPersonalDataTSFileURepository->all();
    
            return view('user_personal_data_t_s_file_us.index')
                ->with('userPersonalDataTSFileUs', $userPersonalDataTSFileUs);
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
            return view('user_personal_data_t_s_file_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSFileU = $this->userPersonalDataTSFileURepository->create($input);
            
                Flash::success('User Personal Data T S File U saved successfully.');
                return redirect(route('userPersonalDataTSFileUs.index'));
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
            $userPersonalDataTSFileU = $this->userPersonalDataTSFileURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileU))
            {
                Flash::error('User Personal Data T S File U not found');
                return redirect(route('userPersonalDataTSFileUs.index'));
            }
    
            if($userPersonalDataTSFileU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_file_us.show')
                    ->with('userPersonalDataTSFileU', $userPersonalDataTSFileU);
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
            $userPersonalDataTSFileU = $this->userPersonalDataTSFileURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileU))
            {
                Flash::error('User Personal Data T S File U not found');
                return redirect(route('userPersonalDataTSFileUs.index'));
            }
    
            if($userPersonalDataTSFileU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_file_us.edit')
                    ->with('userPersonalDataTSFileU', $userPersonalDataTSFileU);
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

    public function update($id, UpdateUserPersonalDataTSFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSFileU = $this->userPersonalDataTSFileURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileU))
            {
                Flash::error('User Personal Data T S File U not found');
                return redirect(route('userPersonalDataTSFileUs.index'));
            }
    
            if($userPersonalDataTSFileU -> user_id == $user_id)
            {
                $userPersonalDataTSFileU = $this->userPersonalDataTSFileURepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S File U updated successfully.');
                return redirect(route('userPersonalDataTSFileUs.index'));
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
            $userPersonalDataTSFileU = $this->userPersonalDataTSFileURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFileU))
            {
                Flash::error('User Personal Data T S File U not found');
                return redirect(route('userPersonalDataTSFileUs.index'));
            }
    
            if($userPersonalDataTSFileU -> user_id == $user_id)
            {
                $this->userPersonalDataTSFileURepository->delete($id);
            
                Flash::success('User Personal Data T S File U deleted successfully.');
                return redirect(route('userPersonalDataTSFileUs.index'));
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