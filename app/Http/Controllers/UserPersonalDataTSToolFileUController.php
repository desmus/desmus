<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSToolFileURequest;
use App\Http\Requests\UpdateUserPersonalDataTSToolFileURequest;
use App\Repositories\UserPersonalDataTSToolFileURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSToolFileUController extends AppBaseController
{
    private $userPersonalDataTSToolFileURepository;

    public function __construct(UserPersonalDataTSToolFileURepository $userPersonalDataTSToolFileURepo)
    {
        $this->userPersonalDataTSToolFileURepository = $userPersonalDataTSToolFileURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSToolFileURepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSToolFileUs = $this->userPersonalDataTSToolFileURepository->all();
    
            return view('user_personal_data_t_s_tool_file_us.index')
                ->with('userPersonalDataTSToolFileUs', $userPersonalDataTSToolFileUs);
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
            return view('user_personal_data_t_s_tool_file_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSToolFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSToolFileU = $this->userPersonalDataTSToolFileURepository->create($input);
            
                Flash::success('User Personal Data T S Tool File U saved successfully.');
                return redirect(route('userPersonalDataTSToolFileUs.index'));
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
            $userPersonalDataTSToolFileU = $this->userPersonalDataTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileU))
            {
                Flash::error('User Personal Data T S Tool File U not found');
                return redirect(route('userPersonalDataTSToolFileUs.index'));
            }
    
            if($userPersonalDataTSToolFileU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_file_us.show')
                    ->with('userPersonalDataTSToolFileU', $userPersonalDataTSToolFileU);
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
            $userPersonalDataTSToolFileU = $this->userPersonalDataTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileU))
            {
                Flash::error('User Personal Data T S Tool File U not found');
                return redirect(route('userPersonalDataTSToolFileUs.index'));
            }
    
            if($userPersonalDataTSToolFileU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_file_us.edit')
                    ->with('userPersonalDataTSToolFileU', $userPersonalDataTSToolFileU);
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

    public function update($id, UpdateUserPersonalDataTSToolFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSToolFileU = $this->userPersonalDataTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileU))
            {
                Flash::error('User Personal Data T S Tool File U not found');
                return redirect(route('userPersonalDataTSToolFileUs.index'));
            }
    
            if($userPersonalDataTSToolFileU -> user_id == $user_id)
            {
                $userPersonalDataTSToolFileU = $this->userPersonalDataTSToolFileURepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Tool File U updated successfully.');
                return redirect(route('userPersonalDataTSToolFileUs.index'));
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
            $userPersonalDataTSToolFileU = $this->userPersonalDataTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileU))
            {
                Flash::error('User Personal Data T S Tool File U not found');
                return redirect(route('userPersonalDataTSToolFileUs.index'));
            }
    
            if($userPersonalDataTSToolFileU -> user_id == $user_id)
            {
                $this->userPersonalDataTSToolFileURepository->delete($id);
            
                Flash::success('User Personal Data T S Tool File U deleted successfully.');
                return redirect(route('userPersonalDataTSToolFileUs.index'));
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