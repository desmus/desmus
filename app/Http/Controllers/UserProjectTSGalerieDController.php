<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSGalerieDRequest;
use App\Http\Requests\UpdateUserProjectTSGalerieDRequest;
use App\Repositories\UserProjectTSGalerieDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSGalerieDController extends AppBaseController
{
    private $userProjectTSGalerieDRepository;

    public function __construct(UserProjectTSGalerieDRepository $userProjectTSGalerieDRepo)
    {
        $this->userProjectTSGalerieDRepository = $userProjectTSGalerieDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSGalerieDRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSGalerieDs = $this->userProjectTSGalerieDRepository->all();
    
            return view('user_project_t_s_galerie_ds.index')
                ->with('userProjectTSGalerieDs', $userProjectTSGalerieDs);
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
            return view('user_project_t_s_galerie_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSGalerieDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSGalerieD = $this->userProjectTSGalerieDRepository->create($input);
            
                Flash::success('User Project T S Galerie D saved successfully.');
                return redirect(route('userProjectTSGalerieDs.index'));
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
            $userProjectTSGalerieD = $this->userProjectTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieD))
            {
                Flash::error('User Project T S Galerie D not found');
                return redirect(route('userProjectTSGalerieDs.index'));
            }
    
            if($userProjectTSGalerieD -> user_id == $user_id)
            {
                return view('user_project_t_s_galerie_ds.show')
                    ->with('userProjectTSGalerieD', $userProjectTSGalerieD);
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
            $userProjectTSGalerieD = $this->userProjectTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieD))
            {
                Flash::error('User Project T S Galerie D not found');
                return redirect(route('userProjectTSGalerieDs.index'));
            }
    
            if($userProjectTSGalerieD -> user_id == $user_id)
            {
                return view('user_project_t_s_galerie_ds.edit')
                    ->with('userProjectTSGalerieD', $userProjectTSGalerieD);
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

    public function update($id, UpdateUserProjectTSGalerieDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSGalerieD = $this->userProjectTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieD))
            {
                Flash::error('User Project T S Galerie D not found');
                return redirect(route('userProjectTSGalerieDs.index'));
            }
    
            if($userProjectTSGalerieD -> user_id == $user_id)
            {
                $userProjectTSGalerieD = $this->userProjectTSGalerieDRepository->update($request->all(), $id);
            
                Flash::success('User Project T S Galerie D updated successfully.');
                return redirect(route('userProjectTSGalerieDs.index'));
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
            $userProjectTSGalerieD = $this->userProjectTSGalerieDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieD))
            {
                Flash::error('User Project T S Galerie D not found');
                return redirect(route('userProjectTSGalerieDs.index'));
            }
    
            if($userProjectTSGalerieD -> user_id == $user_id)
            {
                $this->userProjectTSGalerieDRepository->delete($id);
            
                Flash::success('User Project T S Galerie D deleted successfully.');
                return redirect(route('userProjectTSGalerieDs.index'));
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