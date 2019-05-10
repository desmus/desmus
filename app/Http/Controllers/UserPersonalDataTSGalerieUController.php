<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSGalerieURequest;
use App\Http\Requests\UpdateUserPersonalDataTSGalerieURequest;
use App\Repositories\UserPersonalDataTSGalerieURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSGalerieUController extends AppBaseController
{
    private $userPersonalDataTSGalerieURepository;

    public function __construct(UserPersonalDataTSGalerieURepository $userPersonalDataTSGalerieURepo)
    {
        $this->userPersonalDataTSGalerieURepository = $userPersonalDataTSGalerieURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSGalerieURepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSGalerieUs = $this->userPersonalDataTSGalerieURepository->all();
    
            return view('user_personal_data_t_s_galerie_us.index')
                ->with('userPersonalDataTSGalerieUs', $userPersonalDataTSGalerieUs);
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
            return view('user_personal_data_t_s_galerie_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSGalerieURequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSGalerieU = $this->userPersonalDataTSGalerieURepository->create($input);
            
                Flash::success('User Personal Data T S Galerie U saved successfully.');
                return redirect(route('userPersonalDataTSGalerieUs.index'));
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
            $userPersonalDataTSGalerieU = $this->userPersonalDataTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieU))
            {
                Flash::error('User Personal Data T S Galerie U not found');
                return redirect(route('userPersonalDataTSGalerieUs.index'));
            }
    
            if($userPersonalDataTSGalerieU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galerie_us.show')
                    ->with('userPersonalDataTSGalerieU', $userPersonalDataTSGalerieU);
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
            $userPersonalDataTSGalerieU = $this->userPersonalDataTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieU))
            {
                Flash::error('User Personal Data T S Galerie U not found');
                return redirect(route('userPersonalDataTSGalerieUs.index'));
            }
    
            if($userPersonalDataTSGalerieU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galerie_us.edit')
                    ->with('userPersonalDataTSGalerieU', $userPersonalDataTSGalerieU);
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

    public function update($id, UpdateUserPersonalDataTSGalerieURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSGalerieU = $this->userPersonalDataTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieU))
            {
                Flash::error('User Personal Data T S Galerie U not found');
                return redirect(route('userPersonalDataTSGalerieUs.index'));
            }
    
            if($userPersonalDataTSGalerieU -> user_id == $user_id)
            {
                $userPersonalDataTSGalerieU = $this->userPersonalDataTSGalerieURepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Galerie U updated successfully.');
                return redirect(route('userPersonalDataTSGalerieUs.index'));
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
            $userPersonalDataTSGalerieU = $this->userPersonalDataTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGalerieU))
            {
                Flash::error('User Personal Data T S Galerie U not found');
                return redirect(route('userPersonalDataTSGalerieUs.index'));
            }
    
            if($userPersonalDataTSGalerieU -> user_id == $user_id)
            {
                $this->userPersonalDataTSGalerieURepository->delete($id);
            
                Flash::success('User Personal Data T S Galerie U deleted successfully.');
                return redirect(route('userPersonalDataTSGalerieUs.index'));
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