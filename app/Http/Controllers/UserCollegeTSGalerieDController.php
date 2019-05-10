<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSGalerieDRequest;
use App\Http\Requests\UpdateUserCollegeTSGalerieDRequest;
use App\Repositories\UserCollegeTSGalerieDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSGalerieDController extends AppBaseController
{
    private $userCollegeTSGalerieDRepository;

    public function __construct(UserCollegeTSGalerieDRepository $userCollegeTSGalerieDRepo)
    {
        $this->userCollegeTSGalerieDRepository = $userCollegeTSGalerieDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSGalerieDRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSGalerieDs = $this->userCollegeTSGalerieDRepository->all();
    
            return view('user_college_t_s_galerie_ds.index')
                ->with('userCollegeTSGalerieDs', $userCollegeTSGalerieDs);
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
            return view('user_college_t_s_galerie_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSGalerieDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSGalerieD = $this->userCollegeTSGalerieDRepository->create($input);
                
                Flash::success('User College T S Galerie D saved successfully.');
                return redirect(route('userCollegeTSGalerieDs.index'));
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
            $userCollegeTSGalerieD = $this->userCollegeTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerieD))
            {
                Flash::error('User College T S Galerie D not found');
                return redirect(route('userCollegeTSGalerieDs.index'));
            }
    
            if($userCollegeTSGalerieD -> user_id == $user_id)
            {
                return view('user_college_t_s_galerie_ds.show')
                    ->with('userCollegeTSGalerieD', $userCollegeTSGalerieD);
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
            $userCollegeTSGalerieD = $this->userCollegeTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerieD))
            {
                Flash::error('User College T S Galerie D not found');
                return redirect(route('userCollegeTSGalerieDs.index'));
            }
    
            if($userCollegeTSGalerieD -> user_id == $user_id)
            {
                return view('user_college_t_s_galerie_ds.edit')
                    ->with('userCollegeTSGalerieD', $userCollegeTSGalerieD);
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

    public function update($id, UpdateUserCollegeTSGalerieDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSGalerieD = $this->userCollegeTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerieD))
            {
                Flash::error('User College T S Galerie D not found');
                return redirect(route('userCollegeTSGalerieDs.index'));
            }
    
            if($userCollegeTSGalerieD -> user_id == $user_id)
            {
                $userCollegeTSGalerieD = $this->userCollegeTSGalerieDRepository->update($request->all(), $id);
            
                Flash::success('User College T S Galerie D updated successfully.');
                return redirect(route('userCollegeTSGalerieDs.index'));
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
            $userCollegeTSGalerieD = $this->userCollegeTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerieD))
            {
                Flash::error('User College T S Galerie D not found');
                return redirect(route('userCollegeTSGalerieDs.index'));
            }
    
            if($userCollegeTSGalerieD -> user_id == $user_id)
            {
                $this->userCollegeTSGalerieDRepository->delete($id);
            
                Flash::success('User College T S Galerie D deleted successfully.');
                return redirect(route('userCollegeTSGalerieDs.index'));
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