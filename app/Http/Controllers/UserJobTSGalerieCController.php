<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSGalerieCRequest;
use App\Http\Requests\UpdateUserJobTSGalerieCRequest;
use App\Repositories\UserJobTSGalerieCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSGalerieCController extends AppBaseController
{
    private $userJobTSGalerieCRepository;

    public function __construct(UserJobTSGalerieCRepository $userJobTSGalerieCRepo)
    {
        $this->userJobTSGalerieCRepository = $userJobTSGalerieCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSGalerieCRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSGalerieCs = $this->userJobTSGalerieCRepository->all();
    
            return view('user_job_t_s_galerie_cs.index')
                ->with('userJobTSGalerieCs', $userJobTSGalerieCs);
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
            return view('user_job_t_s_galerie_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSGalerieCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSGalerieC = $this->userJobTSGalerieCRepository->create($input);
            }
            
            else
            {
                return view('deniedAccess');
            }
    
            Flash::success('User Job T S Galerie C saved successfully.');
            return redirect(route('userJobTSGalerieCs.index'));
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
            $userJobTSGalerieC = $this->userJobTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerieC))
            {
                Flash::error('User Job T S Galerie C not found');
                return redirect(route('userJobTSGalerieCs.index'));
            }
    
            if($userJobTSGalerieC -> user_id == $user_id)
            {
                return view('user_job_t_s_galerie_cs.show')
                    ->with('userJobTSGalerieC', $userJobTSGalerieC);
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
            $userJobTSGalerieC = $this->userJobTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerieC))
            {
                Flash::error('User Job T S Galerie C not found');
                return redirect(route('userJobTSGalerieCs.index'));
            }
    
            if($userJobTSGalerieC -> user_id == $user_id)
            {
                return view('user_job_t_s_galerie_cs.edit')
                    ->with('userJobTSGalerieC', $userJobTSGalerieC);
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

    public function update($id, UpdateUserJobTSGalerieCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSGalerieC = $this->userJobTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerieC))
            {
                Flash::error('User Job T S Galerie C not found');
                return redirect(route('userJobTSGalerieCs.index'));
            }
    
            if($userJobTSGalerieC -> user_id == $user_id)
            {
                $userJobTSGalerieC = $this->userJobTSGalerieCRepository->update($request->all(), $id);
                
                Flash::success('User Job T S Galerie C updated successfully.');
                return redirect(route('userJobTSGalerieCs.index'));
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
            $userJobTSGalerieC = $this->userJobTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerieC))
            {
                Flash::error('User Job T S Galerie C not found');
                return redirect(route('userJobTSGalerieCs.index'));
            }
    
            if($userJobTSGalerieC -> user_id == $user_id)
            {
                $this->userJobTSGalerieCRepository->delete($id);
            
                Flash::success('User Job T S Galerie C deleted successfully.');
                return redirect(route('userJobTSGalerieCs.index'));
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