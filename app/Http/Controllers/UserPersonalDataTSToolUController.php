<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSToolURequest;
use App\Http\Requests\UpdateUserPersonalDataTSToolURequest;
use App\Repositories\UserPersonalDataTSToolURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSToolUController extends AppBaseController
{
    private $userPersonalDataTSToolURepository;

    public function __construct(UserPersonalDataTSToolURepository $userPersonalDataTSToolURepo)
    {
        $this->userPersonalDataTSToolURepository = $userPersonalDataTSToolURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSToolURepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSToolUs = $this->userPersonalDataTSToolURepository->all();
    
            return view('user_personal_data_t_s_tool_us.index')
                ->with('userPersonalDataTSToolUs', $userPersonalDataTSToolUs);
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
            return view('user_personal_data_t_s_tool_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSToolURequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSToolU = $this->userPersonalDataTSToolURepository->create($input);
            
                Flash::success('User Personal Data T S Tool U saved successfully.');
                return redirect(route('userPersonalDataTSToolUs.index'));
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
            $userPersonalDataTSToolU = $this->userPersonalDataTSToolURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolU))
            {
                Flash::error('User Personal Data T S Tool U not found');
                return redirect(route('userPersonalDataTSToolUs.index'));
            }
    
            if($userPersonalDataTSToolU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_us.show')
                    ->with('userPersonalDataTSToolU', $userPersonalDataTSToolU);
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
            $userPersonalDataTSToolU = $this->userPersonalDataTSToolURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolU))
            {
                Flash::error('User Personal Data T S Tool U not found');
                return redirect(route('userPersonalDataTSToolUs.index'));
            }
    
            if($userPersonalDataTSToolU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_us.edit')
                    ->with('userPersonalDataTSToolU', $userPersonalDataTSToolU);
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

    public function update($id, UpdateUserPersonalDataTSToolURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSToolU = $this->userPersonalDataTSToolURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolU))
            {
                Flash::error('User Personal Data T S Tool U not found');
                return redirect(route('userPersonalDataTSToolUs.index'));
            }
    
            if($userPersonalDataTSToolU -> user_id == $user_id)
            {
                $userPersonalDataTSToolU = $this->userPersonalDataTSToolURepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Tool U updated successfully.');
                return redirect(route('userPersonalDataTSToolUs.index'));
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
            $userPersonalDataTSToolU = $this->userPersonalDataTSToolURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolU))
            {
                Flash::error('User Personal Data T S Tool U not found');
                return redirect(route('userPersonalDataTSToolUs.index'));
            }
    
            if($userPersonalDataTSToolU -> user_id == $user_id)
            {
                $this->userPersonalDataTSToolURepository->delete($id);
            
                Flash::success('User Personal Data T S Tool U deleted successfully.');
                return redirect(route('userPersonalDataTSToolUs.index'));
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