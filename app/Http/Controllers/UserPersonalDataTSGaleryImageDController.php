<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSGaleryImageDRequest;
use App\Http\Requests\UpdateUserPersonalDataTSGaleryImageDRequest;
use App\Repositories\UserPersonalDataTSGaleryImageDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSGaleryImageDController extends AppBaseController
{
    private $userPersonalDataTSGaleryImageDRepository;

    public function __construct(UserPersonalDataTSGaleryImageDRepository $userPersonalDataTSGaleryImageDRepo)
    {
        $this->userPersonalDataTSGaleryImageDRepository = $userPersonalDataTSGaleryImageDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSGaleryImageDRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSGaleryImageDs = $this->userPersonalDataTSGaleryImageDRepository->all();
    
            return view('user_personal_data_t_s_galery_image_ds.index')
                ->with('userPersonalDataTSGaleryImageDs', $userPersonalDataTSGaleryImageDs);
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
            return view('user_personal_data_t_s_galery_image_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSGaleryImageDRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSGaleryImageD = $this->userPersonalDataTSGaleryImageDRepository->create($input);
            
                Flash::success('User Personal Data T S Galery Image D saved successfully.');
                return redirect(route('userPersonalDataTSGaleryImageDs.index'));
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
            $userPersonalDataTSGaleryImageD = $this->userPersonalDataTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageD))
            {
                Flash::error('User Personal Data T S Galery Image D not found');
                return redirect(route('userPersonalDataTSGaleryImageDs.index'));
            }
    
            if($userPersonalDataTSGaleryImageD -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galery_image_ds.show')
                    ->with('userPersonalDataTSGaleryImageD', $userPersonalDataTSGaleryImageD);
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
            $userPersonalDataTSGaleryImageD = $this->userPersonalDataTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageD))
            {
                Flash::error('User Personal Data T S Galery Image D not found');
                return redirect(route('userPersonalDataTSGaleryImageDs.index'));
            }
    
            if($userPersonalDataTSGaleryImageD -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galery_image_ds.edit')
                    ->with('userPersonalDataTSGaleryImageD', $userPersonalDataTSGaleryImageD);
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

    public function update($id, UpdateUserPersonalDataTSGaleryImageDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSGaleryImageD = $this->userPersonalDataTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageD))
            {
                Flash::error('User Personal Data T S Galery Image D not found');
                return redirect(route('userPersonalDataTSGaleryImageDs.index'));
            }
    
            if($userPersonalDataTSGaleryImageD -> user_id == $user_id)
            {
                $userPersonalDataTSGaleryImageD = $this->userPersonalDataTSGaleryImageDRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Galery Image D updated successfully.');
                return redirect(route('userPersonalDataTSGaleryImageDs.index'));
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
            $userPersonalDataTSGaleryImageD = $this->userPersonalDataTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageD))
            {
                Flash::error('User Personal Data T S Galery Image D not found');
                return redirect(route('userPersonalDataTSGaleryImageDs.index'));
            }
    
            if($userPersonalDataTSGaleryImageD -> user_id == $user_id)
            {
                $this->userPersonalDataTSGaleryImageDRepository->delete($id);
            
                Flash::success('User Personal Data T S Galery Image D deleted successfully.');
                return redirect(route('userPersonalDataTSGaleryImageDs.index'));
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