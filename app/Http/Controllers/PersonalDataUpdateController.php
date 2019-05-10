<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataUpdateRequest;
use App\Http\Requests\UpdatePersonalDataUpdateRequest;
use App\Repositories\PersonalDataUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataUpdateController extends AppBaseController
{
    private $personalDataUpdateRepository;

    public function __construct(PersonalDataUpdateRepository $personalDataUpdateRepo)
    {
        $this->personalDataUpdateRepository = $personalDataUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataUpdates = $this->personalDataUpdateRepository->all();
    
            return view('personal_data_updates.index')
                ->with('personalDataUpdates', $personalDataUpdates);
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
            return view('personal_data_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataUpdate = $this->personalDataUpdateRepository->create($input);
            
                Flash::success('PersonalData Update saved successfully.');
                return redirect(route('personalDataUpdates.index'));
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
            $personalDataUpdate = $this->personalDataUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataUpdate))
            {
                Flash::error('PersonalData Update not found');
                return redirect(route('personalDataUpdates.index'));
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
            
            if($user_id == $personalDataUpdate -> user_id || $isShared)
            {
                return view('personal_data_updates.show')->with('personalDataUpdate', $personalDataUpdate);
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
            $personalDataUpdate = $this->personalDataUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataUpdate))
            {
                Flash::error('PersonalData Update not found');
                return redirect(route('personalDataUpdates.index'));
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
            
            if($user_id == $personalDataUpdate -> user_id || $isShared)
            {
                return view('personal_data_updates.edit')->with('personalDataUpdate', $personalDataUpdate);
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

    public function update($id, UpdatePersonalDataUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataUpdate = $this->personalDataUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataUpdate))
            {
                Flash::error('PersonalData Update not found');
                return redirect(route('personalDataUpdates.index'));
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
            
            if($user_id == $personalDataUpdate -> user_id || $isShared)
            {
                $personalDataUpdate = $this->personalDataUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Update updated successfully.');
                return redirect(route('personalDataUpdates.index'));
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
            $personalDataUpdate = $this->personalDataUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataUpdate))
            {
                Flash::error('PersonalData Update not found');
                return redirect(route('personalDataUpdates.index'));
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
            
            if($user_id == $personalDataUpdate -> user_id || $isShared)
            {
                $this->personalDataUpdateRepository->delete($id);
            
                Flash::success('PersonalData Update deleted successfully.');
                return redirect(route('personalDataUpdates.index'));
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