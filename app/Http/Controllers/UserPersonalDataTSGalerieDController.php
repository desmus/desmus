<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSGalerieDRequest;
use App\Http\Requests\UpdateUserPersonalDataTSGalerieDRequest;
use App\Repositories\UserPersonalDataTSGalerieDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSGalerieDController extends AppBaseController
{
    private $userPersonalDataTSGalerieDRepository;

    public function __construct(UserPersonalDataTSGalerieDRepository $userPersonalDataTSGalerieDRepo)
    {
        $this->userPersonalDataTSGalerieDRepository = $userPersonalDataTSGalerieDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSGalerieDRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSGalerieDs = $this->userPersonalDataTSGalerieDRepository->all();
    
            return view('user_personal_data_t_s_galerie_ds.index')
                ->with('userPersonalDataTSGalerieDs', $userPersonalDataTSGalerieDs);
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
            return view('user_personal_data_t_s_galerie_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSGalerieDRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSGalerieD = $this->userPersonalDataTSGalerieDRepository->create($input);
            
                Flash::success('User Personal Data T S Galerie D saved successfully.');
                return redirect(route('userPersonalDataTSGalerieDs.index'));
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
            $userPersonalDataTSGalerieD = $this->userPersonalDataTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieD))
            {
                Flash::error('User Personal Data T S Galerie D not found');
                return redirect(route('userPersonalDataTSGalerieDs.index'));
            }
    
            if($userPersonalDataTSGalerieD -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galerie_ds.show')
                    ->with('userPersonalDataTSGalerieD', $userPersonalDataTSGalerieD);
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
            $userPersonalDataTSGalerieD = $this->userPersonalDataTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieD))
            {
                Flash::error('User Personal Data T S Galerie D not found');
                return redirect(route('userPersonalDataTSGalerieDs.index'));
            }
    
            if($userPersonalDataTSGalerieD -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galerie_ds.edit')
                    ->with('userPersonalDataTSGalerieD', $userPersonalDataTSGalerieD);
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

    public function update($id, UpdateUserPersonalDataTSGalerieDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSGalerieD = $this->userPersonalDataTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieD))
            {
                Flash::error('User Personal Data T S Galerie D not found');
                return redirect(route('userPersonalDataTSGalerieDs.index'));
            }
    
            if($userPersonalDataTSGalerieD -> user_id == $user_id)
            {
                $userPersonalDataTSGalerieD = $this->userPersonalDataTSGalerieDRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Galerie D updated successfully.');
                return redirect(route('userPersonalDataTSGalerieDs.index'));
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
            $userPersonalDataTSGalerieD = $this->userPersonalDataTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieD))
            {
                Flash::error('User Personal Data T S Galerie D not found');
                return redirect(route('userPersonalDataTSGalerieDs.index'));
            }
    
            if($userPersonalDataTSGalerieD -> user_id == $user_id)
            {
                $this->userPersonalDataTSGalerieDRepository->delete($id);
            
                Flash::success('User Personal Data T S Galerie D deleted successfully.');
                return redirect(route('userPersonalDataTSGalerieDs.index'));
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