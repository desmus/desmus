<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSToolFileCRequest;
use App\Http\Requests\UpdateUserPersonalDataTSToolFileCRequest;
use App\Repositories\UserPersonalDataTSToolFileCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSToolFileCController extends AppBaseController
{
    private $userPersonalDataTSToolFileCRepository;

    public function __construct(UserPersonalDataTSToolFileCRepository $userPersonalDataTSToolFileCRepo)
    {
        $this->userPersonalDataTSToolFileCRepository = $userPersonalDataTSToolFileCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSToolFileCRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSToolFileCs = $this->userPersonalDataTSToolFileCRepository->all();
    
            return view('user_personal_data_t_s_tool_file_cs.index')
                ->with('userPersonalDataTSToolFileCs', $userPersonalDataTSToolFileCs);
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
            return view('user_personal_data_t_s_tool_file_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSToolFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSToolFileC = $this->userPersonalDataTSToolFileCRepository->create($input);
            
                Flash::success('User Personal Data T S Tool File C saved successfully.');
                return redirect(route('userPersonalDataTSToolFileCs.index'));
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
            $userPersonalDataTSToolFileC = $this->userPersonalDataTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileC))
            {
                Flash::error('User Personal Data T S Tool File C not found');
                return redirect(route('userPersonalDataTSToolFileCs.index'));
            }
    
            if($userPersonalDataTSToolFileC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_file_cs.show')
                    ->with('userPersonalDataTSToolFileC', $userPersonalDataTSToolFileC);
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
            $userPersonalDataTSToolFileC = $this->userPersonalDataTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileC))
            {
                Flash::error('User Personal Data T S Tool File C not found');
                return redirect(route('userPersonalDataTSToolFileCs.index'));
            }
    
            if($userPersonalDataTSToolFileC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_tool_file_cs.edit')
                    ->with('userPersonalDataTSToolFileC', $userPersonalDataTSToolFileC);
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

    public function update($id, UpdateUserPersonalDataTSToolFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSToolFileC = $this->userPersonalDataTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileC))
            {
                Flash::error('User Personal Data T S Tool File C not found');
                return redirect(route('userPersonalDataTSToolFileCs.index'));
            }
    
            if($userPersonalDataTSToolFileC -> user_id == $user_id)
            {
                $userPersonalDataTSToolFileC = $this->userPersonalDataTSToolFileCRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Tool File C updated successfully.');
                return redirect(route('userPersonalDataTSToolFileCs.index'));
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
            $userPersonalDataTSToolFileC = $this->userPersonalDataTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFileC))
            {
                Flash::error('User Personal Data T S Tool File C not found');
                return redirect(route('userPersonalDataTSToolFileCs.index'));
            }
    
            if($userPersonalDataTSToolFileC -> user_id == $user_id)
            {
                $this->userPersonalDataTSToolFileCRepository->delete($id);
            
                Flash::success('User Personal Data T S Tool File C deleted successfully.');
                return redirect(route('userPersonalDataTSToolFileCs.index'));
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