<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSToolDRequest;
use App\Http\Requests\UpdateUserPersonalDataTSToolDRequest;
use App\Repositories\UserPersonalDataTSToolDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSToolDController extends AppBaseController
{
    private $userPersonalDataTSToolDRepository;

    public function __construct(UserPersonalDataTSToolDRepository $userPersonalDataTSToolDRepo)
    {
        $this->userPersonalDataTSToolDRepository = $userPersonalDataTSToolDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSToolDRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSToolDs = $this->userPersonalDataTSToolDRepository->all();
    
            return view('user_personal_data_t_s_tool_ds.index')
                ->with('userPersonalDataTSToolDs', $userPersonalDataTSToolDs);
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
            return view('user_personal_data_t_s_tool_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSToolDRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSToolD = $this->userPersonalDataTSToolDRepository->create($input);
            
                Flash::success('User Personal Data T S Tool D saved successfully.');
                return redirect(route('userPersonalDataTSToolDs.index'));
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
            $userPersonalDataTSToolD = $this->userPersonalDataTSToolDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolD))
            {
                Flash::error('User Personal Data T S Tool D not found');
                return redirect(route('userPersonalDataTSToolDs.index'));
            }
            
            if($userPersonalDataTSToolD -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_ds.show')
                    ->with('userPersonalDataTSToolD', $userPersonalDataTSToolD);
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
            $userPersonalDataTSToolD = $this->userPersonalDataTSToolDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolD))
            {
                Flash::error('User Personal Data T S Tool D not found');
                return redirect(route('userPersonalDataTSToolDs.index'));
            }
    
            if($userPersonalDataTSToolD -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_ds.edit')
                    ->with('userPersonalDataTSToolD', $userPersonalDataTSToolD);
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

    public function update($id, UpdateUserPersonalDataTSToolDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSToolD = $this->userPersonalDataTSToolDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolD))
            {
                Flash::error('User Personal Data T S Tool D not found');
                return redirect(route('userPersonalDataTSToolDs.index'));
            }
    
            if($userPersonalDataTSToolD -> user_id == $user_id)
            {
                $userPersonalDataTSToolD = $this->userPersonalDataTSToolDRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Tool D updated successfully.');
                return redirect(route('userPersonalDataTSToolDs.index'));
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
            $userPersonalDataTSToolD = $this->userPersonalDataTSToolDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolD))
            {
                Flash::error('User Personal Data T S Tool D not found');
                return redirect(route('userPersonalDataTSToolDs.index'));
            }
    
            if($userPersonalDataTSToolD -> user_id == $user_id)
            {
                $this->userPersonalDataTSToolDRepository->delete($id);
            
                Flash::success('User Personal Data T S Tool D deleted successfully.');
                return redirect(route('userPersonalDataTSToolDs.index'));
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