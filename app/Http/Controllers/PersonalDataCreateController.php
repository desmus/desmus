<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataCreateRequest;
use App\Http\Requests\UpdatePersonalDataCreateRequest;
use App\Repositories\PersonalDataCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataCreateController extends AppBaseController
{
    private $personalDataCreateRepository;

    public function __construct(PersonalDataCreateRepository $personalDataCreateRepo)
    {
        $this->personalDataCreateRepository = $personalDataCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataCreates = $this->personalDataCreateRepository->all();
    
            return view('personal_data_creates.index')
                ->with('personalDataCreates', $personalDataCreates);
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
            return view('personal_data_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataCreate = $this->personalDataCreateRepository->create($input);
            
                Flash::success('PersonalData Create saved successfully.');
                return redirect(route('personalDataCreates.index'));
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
            $personalDataCreate = $this->personalDataCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataCreate))
            {
                Flash::error('PersonalData Create not found');
                return redirect(route('personalDataCreates.index'));
            }
            
            $userPersonalDatas = DB::table('user_personal_datas')->where('personal_data_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDatas as $userPersonalData)
            {
                if($userPersonalData -> user_id == $user_id && $userPersonalData -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $personalDataCreate -> user_id || $isShared)
            {
                return view('personal_data_creates.show')->with('personalDataCreate', $personalDataCreate);
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
            $personalDataCreate = $this->personalDataCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataCreate))
            {
                Flash::error('PersonalData Create not found');
                return redirect(route('personalDataCreates.index'));
            }
            
            $userPersonalDatas = DB::table('user_personal_datas')->where('personal_data_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDatas as $userPersonalData)
            {
                if($userPersonalData -> user_id == $user_id && $userPersonalData -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $personalDataCreate -> user_id || $isShared)
            {
                return view('personal_data_creates.edit')->with('personalDataCreate', $personalDataCreate);
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

    public function update($id, UpdatePersonalDataCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataCreate = $this->personalDataCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataCreate))
            {
                Flash::error('PersonalData Create not found');
                return redirect(route('personalDataCreates.index'));
            }
            
            $userPersonalDatas = DB::table('user_personal_datas')->where('personal_data_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDatas as $userPersonalData)
            {
                if($userPersonalData -> user_id == $user_id && $userPersonalData -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $personalDataCreate -> user_id || $isShared)
            {
                $personalDataCreate = $this->personalDataCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Create updated successfully.');
                return redirect(route('personalDataCreates.index'));
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
            $personalDataCreate = $this->personalDataCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataCreate))
            {
                Flash::error('PersonalData Create not found');
                return redirect(route('personalDataCreates.index'));
            }
            
            $userPersonalDatas = DB::table('user_personal_datas')->where('personal_data_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDatas as $userPersonalData)
            {
                if($userPersonalData -> user_id == $user_id && $userPersonalData -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $personalDataCreate -> user_id || $isShared)
            {
                $this->personalDataCreateRepository->delete($id);
            
                Flash::success('PersonalData Create deleted successfully.');
                return redirect(route('personalDataCreates.index'));
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