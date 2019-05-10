<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataCRequest;
use App\Http\Requests\UpdateUserPersonalDataCRequest;
use App\Repositories\UserPersonalDataCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataCController extends AppBaseController
{
    private $userPersonalDataCRepository;

    public function __construct(UserPersonalDataCRepository $userPersonalDataCRepo)
    {
        $this->userPersonalDataCRepository = $userPersonalDataCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataCRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataCs = $this->userPersonalDataCRepository->all();
    
            return view('user_personal_data_cs.index')
                ->with('userPersonalDataCs', $userPersonalDataCs);
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
            return view('user_personal_data_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataCRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataC = $this->userPersonalDataCRepository->create($input);
            
                Flash::success('User Personal Data C saved successfully.');
                return redirect(route('userPersonalDataCs.index'));
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
            $userPersonalDataC = $this->userPersonalDataCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataC))
            {
                Flash::error('User Personal Data C not found');
                return redirect(route('userPersonalDataCs.index'));
            }
    
            if($userPDTSPAudio -> user_id == $user_id)
            {
                return view('user_personal_data_cs.show')
                    ->with('userPersonalDataC', $userPersonalDataC);
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
            $userPersonalDataC = $this->userPersonalDataCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataC))
            {
                Flash::error('User Personal Data C not found');
                return redirect(route('userPersonalDataCs.index'));
            }
    
            if($userPDTSPAudio -> user_id == $user_id)
            {
                return view('user_personal_data_cs.edit')
                    ->with('userPersonalDataC', $userPersonalDataC);
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

    public function update($id, UpdateUserPersonalDataCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataC = $this->userPersonalDataCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataC))
            {
                Flash::error('User Personal Data C not found');
                return redirect(route('userPersonalDataCs.index'));
            }
    
            if($userPDTSPAudio -> user_id == $user_id)
            {
                $userPersonalDataC = $this->userPersonalDataCRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data C updated successfully.');
                return redirect(route('userPersonalDataCs.index'));
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
            $userPersonalDataC = $this->userPersonalDataCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataC))
            {
                Flash::error('User Personal Data C not found');
                return redirect(route('userPersonalDataCs.index'));
            }
    
            if($userPDTSPAudio -> user_id == $user_id)
            {
                $this->userPersonalDataCRepository->delete($id);
            
                Flash::success('User Personal Data C deleted successfully.');
                return redirect(route('userPersonalDataCs.index'));
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