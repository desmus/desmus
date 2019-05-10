<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataURequest;
use App\Http\Requests\UpdateUserPersonalDataURequest;
use App\Repositories\UserPersonalDataURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataUController extends AppBaseController
{
    private $userPersonalDataURepository;

    public function __construct(UserPersonalDataURepository $userPersonalDataURepo)
    {
        $this->userPersonalDataURepository = $userPersonalDataURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataURepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataUs = $this->userPersonalDataURepository->all();
    
            return view('user_personal_data_us.index')
                ->with('userPersonalDataUs', $userPersonalDataUs);
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
            return view('user_personal_data_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataURequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataU = $this->userPersonalDataURepository->create($input);
            
                Flash::success('User Personal Data U saved successfully.');
                return redirect(route('userPersonalDataUs.index'));
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
            $userPersonalDataU = $this->userPersonalDataURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataU))
            {
                Flash::error('User Personal Data U not found');
                return redirect(route('userPersonalDataUs.index'));
            }
    
            if($userPersonalDataU -> user_id == $user_id)
            {
                return view('user_personal_data_us.show')
                    ->with('userPersonalDataU', $userPersonalDataU);
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
            $userPersonalDataU = $this->userPersonalDataURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataU))
            {
                Flash::error('User Personal Data U not found');
                return redirect(route('userPersonalDataUs.index'));
            }
    
            if($userPersonalDataU -> user_id == $user_id)
            {
                return view('user_personal_data_us.edit')
                    ->with('userPersonalDataU', $userPersonalDataU);
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

    public function update($id, UpdateUserPersonalDataURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataU = $this->userPersonalDataURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataU))
            {
                Flash::error('User Personal Data U not found');
                return redirect(route('userPersonalDataUs.index'));
            }
    
            if($userPersonalDataU -> user_id == $user_id)
            {
                $userPersonalDataU = $this->userPersonalDataURepository->update($request->all(), $id);
            
                Flash::success('User Personal Data U updated successfully.');
                return redirect(route('userPersonalDataUs.index'));
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
            $userPersonalDataU = $this->userPersonalDataURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataU))
            {
                Flash::error('User Personal Data U not found');
                return redirect(route('userPersonalDataUs.index'));
            }
    
            if($userPersonalDataU -> user_id == $user_id)
            {
                $this->userPersonalDataURepository->delete($id);
            
                Flash::success('User Personal Data U deleted successfully.');
                return redirect(route('userPersonalDataUs.index'));
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