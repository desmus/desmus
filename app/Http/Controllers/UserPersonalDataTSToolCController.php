<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSToolCRequest;
use App\Http\Requests\UpdateUserPersonalDataTSToolCRequest;
use App\Repositories\UserPersonalDataTSToolCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSToolCController extends AppBaseController
{
    private $userPersonalDataTSToolCRepository;

    public function __construct(UserPersonalDataTSToolCRepository $userPersonalDataTSToolCRepo)
    {
        $this->userPersonalDataTSToolCRepository = $userPersonalDataTSToolCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSToolCRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSToolCs = $this->userPersonalDataTSToolCRepository->all();
    
            return view('user_personal_data_t_s_tool_cs.index')
                ->with('userPersonalDataTSToolCs', $userPersonalDataTSToolCs);
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
            return view('user_personal_data_t_s_tool_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSToolCRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSToolC = $this->userPersonalDataTSToolCRepository->create($input);
            
                Flash::success('User Personal Data T S Tool C saved successfully.');
                return redirect(route('userPersonalDataTSToolCs.index'));
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
            $userPersonalDataTSToolC = $this->userPersonalDataTSToolCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolC))
            {
                Flash::error('User Personal Data T S Tool C not found');
                return redirect(route('userPersonalDataTSToolCs.index'));
            }
    
            if($userPersonalDataTSToolC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_cs.show')
                    ->with('userPersonalDataTSToolC', $userPersonalDataTSToolC);
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
            $userPersonalDataTSToolC = $this->userPersonalDataTSToolCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolC))
            {
                Flash::error('User Personal Data T S Tool C not found');
                return redirect(route('userPersonalDataTSToolCs.index'));
            }
    
            if($userPersonalDataTSToolC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_cs.edit')
                    ->with('userPersonalDataTSToolC', $userPersonalDataTSToolC);
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

    public function update($id, UpdateUserPersonalDataTSToolCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSToolC = $this->userPersonalDataTSToolCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolC))
            {
                Flash::error('User Personal Data T S Tool C not found');
                return redirect(route('userPersonalDataTSToolCs.index'));
            }
    
            if($userPersonalDataTSToolC -> user_id == $user_id)
            {
                $userPersonalDataTSToolC = $this->userPersonalDataTSToolCRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Tool C updated successfully.');
                return redirect(route('userPersonalDataTSToolCs.index'));
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
            $userPersonalDataTSToolC = $this->userPersonalDataTSToolCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolC))
            {
                Flash::error('User Personal Data T S Tool C not found');
                return redirect(route('userPersonalDataTSToolCs.index'));
            }
    
            if($userPersonalDataTSToolC -> user_id == $user_id)
            {
                $this->userPersonalDataTSToolCRepository->delete($id);
            
                Flash::success('User Personal Data T S Tool C deleted successfully.');
                return redirect(route('userPersonalDataTSToolCs.index'));
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