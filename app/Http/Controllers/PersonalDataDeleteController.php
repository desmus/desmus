<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\DeletePersonalDataDeleteRequest;
use App\Http\Requests\UpdatePersonalDataDeleteRequest;
use App\Repositories\PersonalDataDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataDeleteController extends AppBaseController
{
    private $personalDataDeleteRepository;

    public function __construct(PersonalDataDeleteRepository $personalDataDeleteRepo)
    {
        $this->personalDataDeleteRepository = $personalDataDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataDeletes = $this->personalDataDeleteRepository->all();
    
            return view('personal_data_deletes.index')
                ->with('personalDataDeletes', $personalDataDeletes);
                
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function delete()
    {
        if(Auth::user() != null)
        {
            return view('personal_data_deletes.delete');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataDelete = $this->personalDataDeleteRepository->delete($input);
            
                Flash::success('PersonalData Delete saved successfully.');
                return redirect(route('personalDataDeletes.index'));
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
            $personalDataDelete = $this->personalDataDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataDelete))
            {
                Flash::error('PersonalData Delete not found');
                return redirect(route('personalDataDeletes.index'));
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
            
            if($user_id == $personalDataDelete -> user_id || $isShared)
            {
                return view('personal_data_deletes.show')->with('personalDataDelete', $personalDataDelete);
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
            $personalDataDelete = $this->personalDataDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataDelete))
            {
                Flash::error('PersonalData Delete not found');
                return redirect(route('personalDataDeletes.index'));
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
            
            if($user_id == $personalDataDelete -> user_id || $isShared)
            {
                return view('personal_data_deletes.edit')->with('personalDataDelete', $personalDataDelete);
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

    public function update($id, UpdatePersonalDataDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataDelete = $this->personalDataDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataDelete))
            {
                Flash::error('PersonalData Delete not found');
                return redirect(route('personalDataDeletes.index'));
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
            
            if($user_id == $personalDataDelete -> user_id || $isShared)
            {
                $personalDataDelete = $this->personalDataDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Delete updated successfully.');
                return redirect(route('personalDataDeletes.index'));
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
            $personalDataDelete = $this->personalDataDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataDelete))
            {
                Flash::error('PersonalData Delete not found');
                return redirect(route('personalDataDeletes.index'));
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
            
            if($user_id == $personalDataDelete -> user_id || $isShared)
            {
                $this->personalDataDeleteRepository->delete($id);
            
                Flash::success('PersonalData Delete deleted successfully.');
                return redirect(route('personalDataDeletes.index'));
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