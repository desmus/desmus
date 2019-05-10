<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSGalerieDRequest;
use App\Http\Requests\UpdateUserJobTSGalerieDRequest;
use App\Repositories\UserJobTSGalerieDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSGalerieDController extends AppBaseController
{
    private $userJobTSGalerieDRepository;

    public function __construct(UserJobTSGalerieDRepository $userJobTSGalerieDRepo)
    {
        $this->userJobTSGalerieDRepository = $userJobTSGalerieDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSGalerieDRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSGalerieDs = $this->userJobTSGalerieDRepository->all();
    
            return view('user_job_t_s_galerie_ds.index')
                ->with('userJobTSGalerieDs', $userJobTSGalerieDs);
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
            return view('user_job_t_s_galerie_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSGalerieDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSGalerieD = $this->userJobTSGalerieDRepository->create($input);
            
                Flash::success('User Job T S Galerie D saved successfully.');
                return redirect(route('userJobTSGalerieDs.index'));
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
            $userJobTSGalerieD = $this->userJobTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerieD))
            {
                Flash::error('User Job T S Galerie D not found');
                return redirect(route('userJobTSGalerieDs.index'));
            }
            
            if($userJobTSGalerieD -> user_id == $user_id)
            {
                return view('user_job_t_s_galerie_ds.show')
                    ->with('userJobTSGalerieD', $userJobTSGalerieD);
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
            $userJobTSGalerieD = $this->userJobTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerieD))
            {
                Flash::error('User Job T S Galerie D not found');
                return redirect(route('userJobTSGalerieDs.index'));
            }
    
            if($userJobTSGalerieD -> user_id == $user_id)
            {
                return view('user_job_t_s_galerie_ds.edit')
                    ->with('userJobTSGalerieD', $userJobTSGalerieD);
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

    public function update($id, UpdateUserJobTSGalerieDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSGalerieD = $this->userJobTSGalerieDRepository->findWithoutFail($id);
    
            if (empty($userJobTSGalerieD))
            {
                Flash::error('User Job T S Galerie D not found');
                return redirect(route('userJobTSGalerieDs.index'));
            }
    
            if($userJobTSGalerieD -> user_id == $user_id)
            {
                $userJobTSGalerieD = $this->userJobTSGalerieDRepository->update($request->all(), $id);
            
                Flash::success('User Job T S Galerie D updated successfully.');
                return redirect(route('userJobTSGalerieDs.index'));
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
            $userJobTSGalerieD = $this->userJobTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerieD))
            {
                Flash::error('User Job T S Galerie D not found');
                return redirect(route('userJobTSGalerieDs.index'));
            }
    
            if($userJobTSGalerieD -> user_id == $user_id)
            {
                $this->userJobTSGalerieDRepository->delete($id);
            
                Flash::success('User Job T S Galerie D deleted successfully.');
                return redirect(route('userJobTSGalerieDs.index'));
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