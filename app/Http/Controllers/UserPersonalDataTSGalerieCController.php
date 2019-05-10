<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSGalerieCRequest;
use App\Http\Requests\UpdateUserPersonalDataTSGalerieCRequest;
use App\Repositories\UserPersonalDataTSGalerieCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSGalerieCController extends AppBaseController
{
    private $userPersonalDataTSGalerieCRepository;

    public function __construct(UserPersonalDataTSGalerieCRepository $userPersonalDataTSGalerieCRepo)
    {
        $this->userPersonalDataTSGalerieCRepository = $userPersonalDataTSGalerieCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSGalerieCRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSGalerieCs = $this->userPersonalDataTSGalerieCRepository->all();
    
            return view('user_personal_data_t_s_galerie_cs.index')
                ->with('userPersonalDataTSGalerieCs', $userPersonalDataTSGalerieCs);
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
            return view('user_personal_data_t_s_galerie_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSGalerieCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSGalerieC = $this->userPersonalDataTSGalerieCRepository->create($input);
            
                Flash::success('User Personal Data T S Galerie C saved successfully.');
                return redirect(route('userPersonalDataTSGalerieCs.index'));
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
            $userPersonalDataTSGalerieC = $this->userPersonalDataTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieC))
            {
                Flash::error('User Personal Data T S Galerie C not found');
                return redirect(route('userPersonalDataTSGalerieCs.index'));
            }
    
            if($userPersonalDataTSGalerieC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galerie_cs.show')
                    ->with('userPersonalDataTSGalerieC', $userPersonalDataTSGalerieC);
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
            $userPersonalDataTSGalerieC = $this->userPersonalDataTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieC))
            {
                Flash::error('User Personal Data T S Galerie C not found');
                return redirect(route('userPersonalDataTSGalerieCs.index'));
            }
    
            if($userPersonalDataTSGalerieC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galerie_cs.edit')
                    ->with('userPersonalDataTSGalerieC', $userPersonalDataTSGalerieC);
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

    public function update($id, UpdateUserPersonalDataTSGalerieCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSGalerieC = $this->userPersonalDataTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieC))
            {
                Flash::error('User Personal Data T S Galerie C not found');
                return redirect(route('userPersonalDataTSGalerieCs.index'));
            }
    
            if($userPersonalDataTSGalerieC -> user_id == $user_id)
            {
                $userPersonalDataTSGalerieC = $this->userPersonalDataTSGalerieCRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Galerie C updated successfully.');
                return redirect(route('userPersonalDataTSGalerieCs.index'));
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
            $userPersonalDataTSGalerieC = $this->userPersonalDataTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieC))
            {
                Flash::error('User Personal Data T S Galerie C not found');
                return redirect(route('userPersonalDataTSGalerieCs.index'));
            }
    
            if($userPersonalDataTSGalerieC -> user_id == $user_id)
            {
                $this->userPersonalDataTSGalerieCRepository->delete($id);
            
                Flash::success('User Personal Data T S Galerie C deleted successfully.');
                return redirect(route('userPersonalDataTSGalerieCs.index'));
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