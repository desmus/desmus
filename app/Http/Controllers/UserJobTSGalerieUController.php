<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSGalerieURequest;
use App\Http\Requests\UpdateUserJobTSGalerieURequest;
use App\Repositories\UserJobTSGalerieURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSGalerieUController extends AppBaseController
{
    private $userJobTSGalerieURepository;

    public function __construct(UserJobTSGalerieURepository $userJobTSGalerieURepo)
    {
        $this->userJobTSGalerieURepository = $userJobTSGalerieURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSGalerieURepository->pushCriteria(new RequestCriteria($request));
            $userJobTSGalerieUs = $this->userJobTSGalerieURepository->all();
    
            return view('user_job_t_s_galerie_us.index')
                ->with('userJobTSGalerieUs', $userJobTSGalerieUs);
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
            return view('user_job_t_s_galerie_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSGalerieURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSGalerieU = $this->userJobTSGalerieURepository->create($input);
            
                Flash::success('User Job T S Galerie U saved successfully.');
                return redirect(route('userJobTSGalerieUs.index'));
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
            $userJobTSGalerieU = $this->userJobTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerieU))
            {
                Flash::error('User Job T S Galerie U not found');
                return redirect(route('userJobTSGalerieUs.index'));
            }
            
            if($userJobTSGalerieU -> user_id == $user_id)
            {
                return view('user_job_t_s_galerie_us.show')
                    ->with('userJobTSGalerieU', $userJobTSGalerieU);
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
            $userJobTSGalerieU = $this->userJobTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerieU))
            {
                Flash::error('User Job T S Galerie U not found');
                return redirect(route('userJobTSGalerieUs.index'));
            }
    
            if($userJobTSGalerieU -> user_id == $user_id)
            {
                return view('user_job_t_s_galerie_us.edit')
                    ->with('userJobTSGalerieU', $userJobTSGalerieU);
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

    public function update($id, UpdateUserJobTSGalerieURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSGalerieU = $this->userJobTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerieU))
            {
                Flash::error('User Job T S Galerie U not found');
                return redirect(route('userJobTSGalerieUs.index'));
            }
    
            if($userJobTSGalerieU -> user_id == $user_id)
            {
                $userJobTSGalerieU = $this->userJobTSGalerieURepository->update($request->all(), $id);
                
                Flash::success('User Job T S Galerie U updated successfully.');
                return redirect(route('userJobTSGalerieUs.index'));
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
            $userJobTSGalerieU = $this->userJobTSGalerieURepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerieU))
            {
                Flash::error('User Job T S Galerie U not found');
                return redirect(route('userJobTSGalerieUs.index'));
            }
    
            if($userJobTSGalerieU -> user_id == $user_id)
            {
                $this->userJobTSGalerieURepository->delete($id);
            
                Flash::success('User Job T S Galerie U deleted successfully.');
                return redirect(route('userJobTSGalerieUs.index'));
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