<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSGalerieURequest;
use App\Http\Requests\UpdateUserCollegeTSGalerieURequest;
use App\Repositories\UserCollegeTSGalerieURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSGalerieUController extends AppBaseController
{
    private $userCollegeTSGalerieURepository;

    public function __construct(UserCollegeTSGalerieURepository $userCollegeTSGalerieURepo)
    {
        $this->userCollegeTSGalerieURepository = $userCollegeTSGalerieURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSGalerieURepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSGalerieUs = $this->userCollegeTSGalerieURepository->all();
    
            return view('user_college_t_s_galerie_us.index')
                ->with('userCollegeTSGalerieUs', $userCollegeTSGalerieUs);
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
            return view('user_college_t_s_galerie_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSGalerieURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSGalerieU = $this->userCollegeTSGalerieURepository->create($input);
            
                Flash::success('User College T S Galerie U saved successfully.');
                return redirect(route('userCollegeTSGalerieUs.index'));
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
            $userCollegeTSGalerieU = $this->userCollegeTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerieU))
            {
                Flash::error('User College T S Galerie U not found');
                return redirect(route('userCollegeTSGalerieUs.index'));
            }
            
            if($userCollegeTSGalerieU -> user_id == $user_id)
            {
                return view('user_college_t_s_galerie_us.show')
                    ->with('userCollegeTSGalerieU', $userCollegeTSGalerieU);
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
            $userCollegeTSGalerieU = $this->userCollegeTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerieU))
            {
                Flash::error('User College T S Galerie U not found');
                return redirect(route('userCollegeTSGalerieUs.index'));
            }
    
            if($userCollegeTSGalerieU -> user_id == $user_id)
            {
                return view('user_college_t_s_galerie_us.edit')
                    ->with('userCollegeTSGalerieU', $userCollegeTSGalerieU);
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

    public function update($id, UpdateUserCollegeTSGalerieURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSGalerieU = $this->userCollegeTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerieU))
            {
                Flash::error('User College T S Galerie U not found');
                return redirect(route('userCollegeTSGalerieUs.index'));
            }
    
            if($userCollegeTSGalerieU -> user_id == $user_id)
            {
                $userCollegeTSGalerieU = $this->userCollegeTSGalerieURepository->update($request->all(), $id);
            
                Flash::success('User College T S Galerie U updated successfully.');
                return redirect(route('userCollegeTSGalerieUs.index'));
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
            $userCollegeTSGalerieU = $this->userCollegeTSGalerieURepository->findWithoutFail($id);
    
            if (empty($userCollegeTSGalerieU))
            {
                Flash::error('User College T S Galerie U not found');
                return redirect(route('userCollegeTSGalerieUs.index'));
            }
    
            if($userCollegeTSGalerieU -> user_id == $user_id)
            {
                $this->userCollegeTSGalerieURepository->delete($id);
            
                Flash::success('User College T S Galerie U deleted successfully.');
                return redirect(route('userCollegeTSGalerieUs.index'));
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