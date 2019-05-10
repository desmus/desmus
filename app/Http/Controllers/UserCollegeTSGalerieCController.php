<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSGalerieCRequest;
use App\Http\Requests\UpdateUserCollegeTSGalerieCRequest;
use App\Repositories\UserCollegeTSGalerieCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSGalerieCController extends AppBaseController
{
    private $userCollegeTSGalerieCRepository;

    public function __construct(UserCollegeTSGalerieCRepository $userCollegeTSGalerieCRepo)
    {
        $this->userCollegeTSGalerieCRepository = $userCollegeTSGalerieCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSGalerieCRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSGalerieCs = $this->userCollegeTSGalerieCRepository->all();
    
            return view('user_college_t_s_galerie_cs.index')
                ->with('userCollegeTSGalerieCs', $userCollegeTSGalerieCs);
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
            return view('user_college_t_s_galerie_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSGalerieCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSGalerieC = $this->userCollegeTSGalerieCRepository->create($input);
            
                Flash::success('User College T S Galerie C saved successfully.');
                return redirect(route('userCollegeTSGalerieCs.index'));
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
            $userCollegeTSGalerieC = $this->userCollegeTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerieC))
            {
                Flash::error('User College T S Galerie C not found');
                return redirect(route('userCollegeTSGalerieCs.index'));
            }
            
            if($userCollegeTSGalerieC -> user_id == $user_id)
            {
                return view('user_college_t_s_galerie_cs.show')
                    ->with('userCollegeTSGalerieC', $userCollegeTSGalerieC);
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
            $userCollegeTSGalerieC = $this->userCollegeTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerieC))
            {
                Flash::error('User College T S Galerie C not found');
                return redirect(route('userCollegeTSGalerieCs.index'));
            }
    
            if($userCollegeTSGalerieC -> user_id == $user_id)
            {
                return view('user_college_t_s_galerie_cs.edit')
                    ->with('userCollegeTSGalerieC', $userCollegeTSGalerieC);
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

    public function update($id, UpdateUserCollegeTSGalerieCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSGalerieC = $this->userCollegeTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerieC))
            {
                Flash::error('User College T S Galerie C not found');
                return redirect(route('userCollegeTSGalerieCs.index'));
            }
    
            if($userCollegeTSGalerieC -> user_id == $user_id)
            {
                $userCollegeTSGalerieC = $this->userCollegeTSGalerieCRepository->update($request->all(), $id);
            
                Flash::success('User College T S Galerie C updated successfully.');
                return redirect(route('userCollegeTSGalerieCs.index'));
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
            $userCollegeTSGalerieC = $this->userCollegeTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerieC))
            {
                Flash::error('User College T S Galerie C not found');
                return redirect(route('userCollegeTSGalerieCs.index'));
            }
    
            if($userCollegeTSGalerieC -> user_id == $user_id)
            {
                $this->userCollegeTSGalerieCRepository->delete($id);
            
                Flash::success('User College T S Galerie C deleted successfully.');
                return redirect(route('userCollegeTSGalerieCs.index'));
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