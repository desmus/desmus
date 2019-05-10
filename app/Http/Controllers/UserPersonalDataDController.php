<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataDRequest;
use App\Http\Requests\UpdateUserPersonalDataDRequest;
use App\Repositories\UserPersonalDataDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataDController extends AppBaseController
{
    private $userPersonalDataDRepository;

    public function __construct(UserPersonalDataDRepository $userPersonalDataDRepo)
    {
        $this->userPersonalDataDRepository = $userPersonalDataDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataDRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataDs = $this->userPersonalDataDRepository->all();
    
            return view('user_personal_data_ds.index')
                ->with('userPersonalDataDs', $userPersonalDataDs);
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
            return view('user_personal_data_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataDRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataD = $this->userPersonalDataDRepository->create($input);
            
                Flash::success('User Personal Data D saved successfully.');
                return redirect(route('userPersonalDataDs.index'));
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
            $userPersonalDataD = $this->userPersonalDataDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataD))
            {
                Flash::error('User Personal Data D not found');
                return redirect(route('userPersonalDataDs.index'));
            }
            
            if($userPersonalDataD -> user_id == $user_id)
            {
                return view('user_personal_data_ds.show')
                    ->with('userPersonalDataD', $userPersonalDataD);
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
            $userPersonalDataD = $this->userPersonalDataDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataD))
            {
                Flash::error('User Personal Data D not found');
                return redirect(route('userPersonalDataDs.index'));
            }
    
            if($userPersonalDataD -> user_id == $user_id)
            {
                return view('user_personal_data_ds.edit')
                    ->with('userPersonalDataD', $userPersonalDataD);
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

    public function update($id, UpdateUserPersonalDataDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataD = $this->userPersonalDataDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataD))
            {
                Flash::error('User Personal Data D not found');
                return redirect(route('userPersonalDataDs.index'));
            }
    
            if($userPersonalDataD -> user_id == $user_id)
            {
                $userPersonalDataD = $this->userPersonalDataDRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data D updated successfully.');
                return redirect(route('userPersonalDataDs.index'));
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
            $userPersonalDataD = $this->userPersonalDataDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataD))
            {
                Flash::error('User Personal Data D not found');
                return redirect(route('userPersonalDataDs.index'));
            }
    
            if($userPersonalDataD -> user_id == $user_id)
            {
                $this->userPersonalDataDRepository->delete($id);
            
                Flash::success('User Personal Data D deleted successfully.');
                return redirect(route('userPersonalDataDs.index'));
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