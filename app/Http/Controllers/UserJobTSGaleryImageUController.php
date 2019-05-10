<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSGaleryImageURequest;
use App\Http\Requests\UpdateUserJobTSGaleryImageURequest;
use App\Repositories\UserJobTSGaleryImageURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSGaleryImageUController extends AppBaseController
{
    private $userJobTSGaleryImageURepository;

    public function __construct(UserJobTSGaleryImageURepository $userJobTSGaleryImageURepo)
    {
        $this->userJobTSGaleryImageURepository = $userJobTSGaleryImageURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSGaleryImageURepository->pushCriteria(new RequestCriteria($request));
            $userJobTSGaleryImageUs = $this->userJobTSGaleryImageURepository->all();
    
            return view('user_job_t_s_galery_image_us.index')
                ->with('userJobTSGaleryImageUs', $userJobTSGaleryImageUs);
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
            return view('user_job_t_s_galery_image_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSGaleryImageURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSGaleryImageU = $this->userJobTSGaleryImageURepository->create($input);
            
                Flash::success('User Job T S Galery Image U saved successfully.');
                return redirect(route('userJobTSGaleryImageUs.index'));
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
            $userJobTSGaleryImageU = $this->userJobTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageU))
            {
                Flash::error('User Job T S Galery Image U not found');
                return redirect(route('userJobTSGaleryImageUs.index'));
            }
    
            if($userJobTSGaleryImageU -> user_id == $user_id)
            {
                return view('user_job_t_s_galery_image_us.show')
                    ->with('userJobTSGaleryImageU', $userJobTSGaleryImageU);
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
            $userJobTSGaleryImageU = $this->userJobTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageU))
            {
                Flash::error('User Job T S Galery Image U not found');
                return redirect(route('userJobTSGaleryImageUs.index'));
            }
    
            if($userJobTSGaleryImageU -> user_id == $user_id)
            {
                return view('user_job_t_s_galery_image_us.edit')
                    ->with('userJobTSGaleryImageU', $userJobTSGaleryImageU);
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

    public function update($id, UpdateUserJobTSGaleryImageURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSGaleryImageU = $this->userJobTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageU))
            {
                Flash::error('User Job T S Galery Image U not found');
                return redirect(route('userJobTSGaleryImageUs.index'));
            }
    
            if($userJobTSGaleryImageU -> user_id == $user_id)
            {
                $userJobTSGaleryImageU = $this->userJobTSGaleryImageURepository->update($request->all(), $id);
            
                Flash::success('User Job T S Galery Image U updated successfully.');
                return redirect(route('userJobTSGaleryImageUs.index'));
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
            $userJobTSGaleryImageU = $this->userJobTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageU))
            {
                Flash::error('User Job T S Galery Image U not found');
                return redirect(route('userJobTSGaleryImageUs.index'));
            }
    
            if($userJobTSGaleryImageU -> user_id == $user_id)
            {
                $this->userJobTSGaleryImageURepository->delete($id);
            
                Flash::success('User Job T S Galery Image U deleted successfully.');
                return redirect(route('userJobTSGaleryImageUs.index'));
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