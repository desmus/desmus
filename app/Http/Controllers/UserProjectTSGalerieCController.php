<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSGalerieCRequest;
use App\Http\Requests\UpdateUserProjectTSGalerieCRequest;
use App\Repositories\UserProjectTSGalerieCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSGalerieCController extends AppBaseController
{
    private $userProjectTSGalerieCRepository;

    public function __construct(UserProjectTSGalerieCRepository $userProjectTSGalerieCRepo)
    {
        $this->userProjectTSGalerieCRepository = $userProjectTSGalerieCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSGalerieCRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSGalerieCs = $this->userProjectTSGalerieCRepository->all();
    
            return view('user_project_t_s_galerie_cs.index')
                ->with('userProjectTSGalerieCs', $userProjectTSGalerieCs);
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
            return view('user_project_t_s_galerie_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSGalerieCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSGalerieC = $this->userProjectTSGalerieCRepository->create($input);
            
                Flash::success('User Project T S Galerie C saved successfully.');
                return redirect(route('userProjectTSGalerieCs.index'));
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
            $userProjectTSGalerieC = $this->userProjectTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieC))
            {
                Flash::error('User Project T S Galerie C not found');
                return redirect(route('userProjectTSGalerieCs.index'));
            }
    
            if($userProjectTSGalerieC -> user_id == $user_id)
            {
                return view('user_project_t_s_galerie_cs.show')
                    ->with('userProjectTSGalerieC', $userProjectTSGalerieC);
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
            $userProjectTSGalerieC = $this->userProjectTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieC))
            {
                Flash::error('User Project T S Galerie C not found');
                return redirect(route('userProjectTSGalerieCs.index'));
            }
    
            if($userProjectTSGalerieC -> user_id == $user_id)
            {
                return view('user_project_t_s_galerie_cs.edit')
                    ->with('userProjectTSGalerieC', $userProjectTSGalerieC);
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

    public function update($id, UpdateUserProjectTSGalerieCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSGalerieC = $this->userProjectTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieC))
            {
                Flash::error('User Project T S Galerie C not found');
                return redirect(route('userProjectTSGalerieCs.index'));
            }
    
            if($userProjectTSGalerieC -> user_id == $user_id)
            {
                $userProjectTSGalerieC = $this->userProjectTSGalerieCRepository->update($request->all(), $id);
            
                Flash::success('User Project T S Galerie C updated successfully.');
                return redirect(route('userProjectTSGalerieCs.index'));
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
            $userProjectTSGalerieC = $this->userProjectTSGalerieCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieC))
            {
                Flash::error('User Project T S Galerie C not found');
                return redirect(route('userProjectTSGalerieCs.index'));
            }
    
            if($userProjectTSGalerieC -> user_id == $user_id)
            {
                $this->userProjectTSGalerieCRepository->delete($id);
            
                Flash::success('User Project T S Galerie C deleted successfully.');
                return redirect(route('userProjectTSGalerieCs.index'));
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