<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSGaleryImageDRequest;
use App\Http\Requests\UpdateUserJobTSGaleryImageDRequest;
use App\Repositories\UserJobTSGaleryImageDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSGaleryImageDController extends AppBaseController
{
    private $userJobTSGaleryImageDRepository;

    public function __construct(UserJobTSGaleryImageDRepository $userJobTSGaleryImageDRepo)
    {
        $this->userJobTSGaleryImageDRepository = $userJobTSGaleryImageDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSGaleryImageDRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSGaleryImageDs = $this->userJobTSGaleryImageDRepository->all();
    
            return view('user_job_t_s_galery_image_ds.index')
                ->with('userJobTSGaleryImageDs', $userJobTSGaleryImageDs);
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
            return view('user_job_t_s_galery_image_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSGaleryImageDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSGaleryImageD = $this->userJobTSGaleryImageDRepository->create($input);
                
                Flash::success('User Job T S Galery Image D saved successfully.');
                return redirect(route('userJobTSGaleryImageDs.index'));
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
            $userJobTSGaleryImageD = $this->userJobTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageD))
            {
                Flash::error('User Job T S Galery Image D not found');
                return redirect(route('userJobTSGaleryImageDs.index'));
            }
    
            if($userJobTSGaleryImageD -> user_id == $user_id)
            {
                return view('user_job_t_s_galery_image_ds.show')
                    ->with('userJobTSGaleryImageD', $userJobTSGaleryImageD);
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
            $userJobTSGaleryImageD = $this->userJobTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageD))
            {
                Flash::error('User Job T S Galery Image D not found');
                return redirect(route('userJobTSGaleryImageDs.index'));
            }
    
            if($userJobTSGaleryImageD -> user_id == $user_id)
            {
                return view('user_job_t_s_galery_image_ds.edit')
                    ->with('userJobTSGaleryImageD', $userJobTSGaleryImageD);
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

    public function update($id, UpdateUserJobTSGaleryImageDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSGaleryImageD = $this->userJobTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageD))
            {
                Flash::error('User Job T S Galery Image D not found');
                return redirect(route('userJobTSGaleryImageDs.index'));
            }
    
            if($userJobTSGaleryImageD -> user_id == $user_id)
            {
                $userJobTSGaleryImageD = $this->userJobTSGaleryImageDRepository->update($request->all(), $id);
            
                Flash::success('User Job T S Galery Image D updated successfully.');
                return redirect(route('userJobTSGaleryImageDs.index'));
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
            $userJobTSGaleryImageD = $this->userJobTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageD))
            {
                Flash::error('User Job T S Galery Image D not found');
                return redirect(route('userJobTSGaleryImageDs.index'));
            }
    
            if($userJobTSGaleryImageD -> user_id == $user_id)
            {
                $this->userJobTSGaleryImageDRepository->delete($id);
            
                Flash::success('User Job T S Galery Image D deleted successfully.');
                return redirect(route('userJobTSGaleryImageDs.index'));
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