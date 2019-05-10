<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSGalerieURequest;
use App\Http\Requests\UpdateUserProjectTSGalerieURequest;
use App\Repositories\UserProjectTSGalerieURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSGalerieUController extends AppBaseController
{
    private $userProjectTSGalerieURepository;

    public function __construct(UserProjectTSGalerieURepository $userProjectTSGalerieURepo)
    {
        $this->userProjectTSGalerieURepository = $userProjectTSGalerieURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSGalerieURepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSGalerieUs = $this->userProjectTSGalerieURepository->all();
    
            return view('user_project_t_s_galerie_us.index')
                ->with('userProjectTSGalerieUs', $userProjectTSGalerieUs);
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
            return view('user_project_t_s_galerie_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSGalerieURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSGalerieU = $this->userProjectTSGalerieURepository->create($input);
                
                Flash::success('User Project T S Galerie U saved successfully.');
                return redirect(route('userProjectTSGalerieUs.index'));
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
            $userProjectTSGalerieU = $this->userProjectTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieU))
            {
                Flash::error('User Project T S Galerie U not found');
                return redirect(route('userProjectTSGalerieUs.index'));
            }
    
            if($userProjectTSGalerieU -> user_id == $user_id)
            {
                return view('user_project_t_s_galerie_us.show')
                    ->with('userProjectTSGalerieU', $userProjectTSGalerieU);
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
            $userProjectTSGalerieU = $this->userProjectTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieU))
            {
                Flash::error('User Project T S Galerie U not found');
                return redirect(route('userProjectTSGalerieUs.index'));
            }
    
            if($userProjectTSGalerieU -> user_id == $user_id)
            {
                return view('user_project_t_s_galerie_us.edit')
                    ->with('userProjectTSGalerieU', $userProjectTSGalerieU);
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

    public function update($id, UpdateUserProjectTSGalerieURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSGalerieU = $this->userProjectTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieU))
            {
                Flash::error('User Project T S Galerie U not found');
                return redirect(route('userProjectTSGalerieUs.index'));
            }
    
            if($userProjectTSGalerieU -> user_id == $user_id)
            {
                $userProjectTSGalerieU = $this->userProjectTSGalerieURepository->update($request->all(), $id);
            
                Flash::success('User Project T S Galerie U updated successfully.');
                return redirect(route('userProjectTSGalerieUs.index'));
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
            $userProjectTSGalerieU = $this->userProjectTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerieU))
            {
                Flash::error('User Project T S Galerie U not found');
                return redirect(route('userProjectTSGalerieUs.index'));
            }
    
            if($userProjectTSGalerieU -> user_id == $user_id)
            {
                $this->userProjectTSGalerieURepository->delete($id);
            
                Flash::success('User Project T S Galerie U deleted successfully.');
                return redirect(route('userProjectTSGalerieUs.index'));
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