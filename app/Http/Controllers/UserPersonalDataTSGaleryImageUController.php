<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSGaleryImageURequest;
use App\Http\Requests\UpdateUserPersonalDataTSGaleryImageURequest;
use App\Repositories\UserPersonalDataTSGaleryImageURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSGaleryImageUController extends AppBaseController
{
    private $userPersonalDataTSGaleryImageURepository;

    public function __construct(UserPersonalDataTSGaleryImageURepository $userPersonalDataTSGaleryImageURepo)
    {
        $this->userPersonalDataTSGaleryImageURepository = $userPersonalDataTSGaleryImageURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSGaleryImageURepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSGaleryImageUs = $this->userPersonalDataTSGaleryImageURepository->all();
    
            return view('user_personal_data_t_s_galery_image_us.index')
                ->with('userPersonalDataTSGaleryImageUs', $userPersonalDataTSGaleryImageUs);
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
            return view('user_personal_data_t_s_galery_image_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSGaleryImageURequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSGaleryImageU = $this->userPersonalDataTSGaleryImageURepository->create($input);
            
                Flash::success('User Personal Data T S Galery Image U saved successfully.');
                return redirect(route('userPersonalDataTSGaleryImageUs.index'));
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
            $userPersonalDataTSGaleryImageU = $this->userPersonalDataTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageU))
            {
                Flash::error('User Personal Data T S Galery Image U not found');
                return redirect(route('userPersonalDataTSGaleryImageUs.index'));
            }
    
            if($userPersonalDataTSGaleryImageU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galery_image_us.show')
                    ->with('userPersonalDataTSGaleryImageU', $userPersonalDataTSGaleryImageU);
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
            $userPersonalDataTSGaleryImageU = $this->userPersonalDataTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageU))
            {
                Flash::error('User Personal Data T S Galery Image U not found');
                return redirect(route('userPersonalDataTSGaleryImageUs.index'));
            }
    
            if($userPersonalDataTSGaleryImageU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galery_image_us.edit')
                    ->with('userPersonalDataTSGaleryImageU', $userPersonalDataTSGaleryImageU);
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

    public function update($id, UpdateUserPersonalDataTSGaleryImageURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSGaleryImageU = $this->userPersonalDataTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageU))
            {
                Flash::error('User Personal Data T S Galery Image U not found');
                return redirect(route('userPersonalDataTSGaleryImageUs.index'));
            }
    
            if($userPersonalDataTSGaleryImageU -> user_id == $user_id)
            {
                $userPersonalDataTSGaleryImageU = $this->userPersonalDataTSGaleryImageURepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Galery Image U updated successfully.');
                return redirect(route('userPersonalDataTSGaleryImageUs.index'));
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
            $userPersonalDataTSGaleryImageU = $this->userPersonalDataTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageU))
            {
                Flash::error('User Personal Data T S Galery Image U not found');
                return redirect(route('userPersonalDataTSGaleryImageUs.index'));
            }
    
            if($userPersonalDataTSGaleryImageU -> user_id == $user_id)
            {
                $this->userPersonalDataTSGaleryImageURepository->delete($id);
            
                Flash::success('User Personal Data T S Galery Image U deleted successfully.');
                return redirect(route('userPersonalDataTSGaleryImageUs.index'));
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