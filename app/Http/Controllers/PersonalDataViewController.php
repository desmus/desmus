<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataViewRequest;
use App\Http\Requests\UpdatePersonalDataViewRequest;
use App\Repositories\PersonalDataViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataViewController extends AppBaseController
{
    private $personalDataViewRepository;

    public function __construct(PersonalDataViewRepository $personalDataViewRepo)
    {
        $this->personalDataViewRepository = $personalDataViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataViews = $this->personalDataViewRepository->all();
    
            return view('personal_data_views.index')
                ->with('personalDataViews', $personalDataViews);
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
            return view('personal_data_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataView = $this->personalDataViewRepository->create($input);
            
                Flash::success('PersonalData View saved successfully.');
                return redirect(route('personalDataViews.index'));
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
            $personalDataView = $this->personalDataViewRepository->findWithoutFail($id);
    
            if(empty($personalDataView))
            {
                Flash::error('PersonalData View not found');
                return redirect(route('personalDataViews.index'));
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
            
            if($user_id == $personalDataView -> user_id || $isShared)
            {
                return view('personal_data_views.show')->with('personalDataView', $personalDataView);
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
            $personalDataView = $this->personalDataViewRepository->findWithoutFail($id);
    
            if(empty($personalDataView))
            {
                Flash::error('PersonalData View not found');
                return redirect(route('personalDataViews.index'));
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
            
            if($user_id == $personalDataView -> user_id || $isShared)
            {
                return view('personal_data_views.edit')->with('personalDataView', $personalDataView);
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

    public function update($id, UpdatePersonalDataViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataView = $this->personalDataViewRepository->findWithoutFail($id);
    
            if(empty($personalDataView))
            {
                Flash::error('PersonalData View not found');
                return redirect(route('personalDataViews.index'));
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
            
            if($user_id == $personalDataView -> user_id || $isShared)
            {
                $personalDataView = $this->personalDataViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData View updated successfully.');
                return redirect(route('personalDataViews.index'));
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
            $personalDataView = $this->personalDataViewRepository->findWithoutFail($id);
    
            if(empty($personalDataView))
            {
                Flash::error('PersonalData View not found');
                return redirect(route('personalDataViews.index'));
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
            
            if($user_id == $personalDataView -> user_id || $isShared)
            {
                $this->personalDataViewRepository->delete($id);
            
                Flash::success('PersonalData View deleted successfully.');
                return redirect(route('personalDataViews.index'));
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