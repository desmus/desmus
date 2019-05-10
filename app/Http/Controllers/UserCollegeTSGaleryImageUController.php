<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSGaleryImageURequest;
use App\Http\Requests\UpdateUserCollegeTSGaleryImageURequest;
use App\Repositories\UserCollegeTSGaleryImageURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSGaleryImageUController extends AppBaseController
{
    private $userCollegeTSGaleryImageURepository;

    public function __construct(UserCollegeTSGaleryImageURepository $userCollegeTSGaleryImageURepo)
    {
        $this->userCollegeTSGaleryImageURepository = $userCollegeTSGaleryImageURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSGaleryImageURepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSGaleryImageUs = $this->userCollegeTSGaleryImageURepository->all();
    
            return view('user_college_t_s_galery_image_us.index')
                ->with('userCollegeTSGaleryImageUs', $userCollegeTSGaleryImageUs);
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
            return view('user_college_t_s_galery_image_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSGaleryImageURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSGaleryImageU = $this->userCollegeTSGaleryImageURepository->create($input);
            
                Flash::success('User College T S Galery Image U saved successfully.');
                return redirect(route('userCollegeTSGaleryImageUs.index'));
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
            $userCollegeTSGaleryImageU = $this->userCollegeTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageU))
            {
                Flash::error('User College T S Galery Image U not found');
                return redirect(route('userCollegeTSGaleryImageUs.index'));
            }
    
            if($userCollegeTSGaleryImageU -> user_id == $user_id)
            {
                return view('user_college_t_s_galery_image_us.show')
                    ->with('userCollegeTSGaleryImageU', $userCollegeTSGaleryImageU);
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
            $userCollegeTSGaleryImageU = $this->userCollegeTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageU))
            {
                Flash::error('User College T S Galery Image U not found');
                return redirect(route('userCollegeTSGaleryImageUs.index'));
            }
            
            if($userCollegeTSGaleryImageU -> user_id == $user_id)
            {
                return view('user_college_t_s_galery_image_us.edit')
                    ->with('userCollegeTSGaleryImageU', $userCollegeTSGaleryImageU);
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

    public function update($id, UpdateUserCollegeTSGaleryImageURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSGaleryImageU = $this->userCollegeTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageU))
            {
                Flash::error('User College T S Galery Image U not found');
                return redirect(route('userCollegeTSGaleryImageUs.index'));
            }
    
            if($userCollegeTSGaleryImageU -> user_id == $user_id)
            {
                $userCollegeTSGaleryImageU = $this->userCollegeTSGaleryImageURepository->update($request->all(), $id);
            
                Flash::success('User College T S Galery Image U updated successfully.');
                return redirect(route('userCollegeTSGaleryImageUs.index'));
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
            $userCollegeTSGaleryImageU = $this->userCollegeTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageU))
            {
                Flash::error('User College T S Galery Image U not found');
                return redirect(route('userCollegeTSGaleryImageUs.index'));
            }
    
            if($userCollegeTSGaleryImageU -> user_id == $user_id)
            {
                $this->userCollegeTSGaleryImageURepository->delete($id);
            
                Flash::success('User College T S Galery Image U deleted successfully.');
                return redirect(route('userCollegeTSGaleryImageUs.index'));
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