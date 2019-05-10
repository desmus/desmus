<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSGaleryImageDRequest;
use App\Http\Requests\UpdateUserProjectTSGaleryImageDRequest;
use App\Repositories\UserProjectTSGaleryImageDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSGaleryImageDController extends AppBaseController
{
    private $userProjectTSGaleryImageDRepository;

    public function __construct(UserProjectTSGaleryImageDRepository $userProjectTSGaleryImageDRepo)
    {
        $this->userProjectTSGaleryImageDRepository = $userProjectTSGaleryImageDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSGaleryImageDRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSGaleryImageDs = $this->userProjectTSGaleryImageDRepository->all();
    
            return view('user_project_t_s_galery_image_ds.index')
                ->with('userProjectTSGaleryImageDs', $userProjectTSGaleryImageDs);
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
            return view('user_project_t_s_galery_image_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSGaleryImageDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSGaleryImageD = $this->userProjectTSGaleryImageDRepository->create($input);
                
                Flash::success('User Project T S Galery Image D saved successfully.');
                return redirect(route('userProjectTSGaleryImageDs.index'));
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
            $userProjectTSGaleryImageD = $this->userProjectTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageD))
            {
                Flash::error('User Project T S Galery Image D not found');
                return redirect(route('userProjectTSGaleryImageDs.index'));
            }
    
            if($userProjectTSGaleryImageD -> user_id == $user_id)
            {
                return view('user_project_t_s_galery_image_ds.show')
                    ->with('userProjectTSGaleryImageD', $userProjectTSGaleryImageD);
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
            $userProjectTSGaleryImageD = $this->userProjectTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageD))
            {
                Flash::error('User Project T S Galery Image D not found');
                return redirect(route('userProjectTSGaleryImageDs.index'));
            }
    
            if($userProjectTSGaleryImageD -> user_id == $user_id)
            {
                return view('user_project_t_s_galery_image_ds.edit')
                    ->with('userProjectTSGaleryImageD', $userProjectTSGaleryImageD);
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

    public function update($id, UpdateUserProjectTSGaleryImageDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSGaleryImageD = $this->userProjectTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageD))
            {
                Flash::error('User Project T S Galery Image D not found');
                return redirect(route('userProjectTSGaleryImageDs.index'));
            }
    
            if($userProjectTSGaleryImageD -> user_id == $user_id)
            {
                $userProjectTSGaleryImageD = $this->userProjectTSGaleryImageDRepository->update($request->all(), $id);
            
                Flash::success('User Project T S Galery Image D updated successfully.');
                return redirect(route('userProjectTSGaleryImageDs.index'));
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
            $userProjectTSGaleryImageD = $this->userProjectTSGaleryImageDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageD))
            {
                Flash::error('User Project T S Galery Image D not found');
                return redirect(route('userProjectTSGaleryImageDs.index'));
            }
    
            if($userProjectTSGaleryImageD -> user_id == $user_id)
            {
                $this->userProjectTSGaleryImageDRepository->delete($id);
            
                Flash::success('User Project T S Galery Image D deleted successfully.');
                return redirect(route('userProjectTSGaleryImageDs.index'));
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