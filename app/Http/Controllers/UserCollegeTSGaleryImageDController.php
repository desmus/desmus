<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSGaleryImageDRequest;
use App\Http\Requests\UpdateUserCollegeTSGaleryImageDRequest;
use App\Repositories\UserCollegeTSGaleryImageDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSGaleryImageDController extends AppBaseController
{
    private $userCollegeTSGaleryImageDRepository;

    public function __construct(UserCollegeTSGaleryImageDRepository $userCollegeTSGaleryImageDRepo)
    {
        $this->userCollegeTSGaleryImageDRepository = $userCollegeTSGaleryImageDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSGaleryImageDRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSGaleryImageDs = $this->userCollegeTSGaleryImageDRepository->all();
    
            return view('user_college_t_s_galery_image_ds.index')
                ->with('userCollegeTSGaleryImageDs', $userCollegeTSGaleryImageDs);
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
            return view('user_college_t_s_galery_image_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSGaleryImageDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSGaleryImageD = $this->userCollegeTSGaleryImageDRepository->create($input);
            
                Flash::success('User College T S Galery Image D saved successfully.');
                return redirect(route('userCollegeTSGaleryImageDs.index'));
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
            $userCollegeTSGaleryImageD = $this->userCollegeTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageD))
            {
                Flash::error('User College T S Galery Image D not found');
                return redirect(route('userCollegeTSGaleryImageDs.index'));
            }
    
            if($userCollegeTSGaleryImageD -> user_id == $user_id)
            {
                return view('user_college_t_s_galery_image_ds.show')
                    ->with('userCollegeTSGaleryImageD', $userCollegeTSGaleryImageD);
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
            $userCollegeTSGaleryImageD = $this->userCollegeTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageD))
            {
                Flash::error('User College T S Galery Image D not found');
                return redirect(route('userCollegeTSGaleryImageDs.index'));
            }
    
            if($userCollegeTSGaleryImageD -> user_id == $user_id)
            {
                return view('user_college_t_s_galery_image_ds.edit')
                    ->with('userCollegeTSGaleryImageD', $userCollegeTSGaleryImageD);
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

    public function update($id, UpdateUserCollegeTSGaleryImageDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSGaleryImageD = $this->userCollegeTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageD))
            {
                Flash::error('User College T S Galery Image D not found');
                return redirect(route('userCollegeTSGaleryImageDs.index'));
            }
    
            if($userCollegeTSGaleryImageD -> user_id == $user_id)
            {
                $userCollegeTSGaleryImageD = $this->userCollegeTSGaleryImageDRepository->update($request->all(), $id);
            
                Flash::success('User College T S Galery Image D updated successfully.');
                return redirect(route('userCollegeTSGaleryImageDs.index'));
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
            $userCollegeTSGaleryImageD = $this->userCollegeTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageD))
            {
                Flash::error('User College T S Galery Image D not found');
                return redirect(route('userCollegeTSGaleryImageDs.index'));
            }
    
            if($userCollegeTSGaleryImageD -> user_id == $user_id)
            {
                $this->userCollegeTSGaleryImageDRepository->delete($id);
            
                Flash::success('User College T S Galery Image D deleted successfully.');
                return redirect(route('userCollegeTSGaleryImageDs.index'));
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