<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSGaleryImageURequest;
use App\Http\Requests\UpdateUserProjectTSGaleryImageURequest;
use App\Repositories\UserProjectTSGaleryImageURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSGaleryImageUController extends AppBaseController
{
    private $userProjectTSGaleryImageURepository;

    public function __construct(UserProjectTSGaleryImageURepository $userProjectTSGaleryImageURepo)
    {
        $this->userProjectTSGaleryImageURepository = $userProjectTSGaleryImageURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSGaleryImageURepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSGaleryImageUs = $this->userProjectTSGaleryImageURepository->all();
    
            return view('user_project_t_s_galery_image_us.index')
                ->with('userProjectTSGaleryImageUs', $userProjectTSGaleryImageUs);
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
            return view('user_project_t_s_galery_image_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSGaleryImageURequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $userProjectTSGaleryImageU = $this->userProjectTSGaleryImageURepository->create($input);
    
            Flash::success('User Project T S Galery Image U saved successfully.');
            return redirect(route('userProjectTSGaleryImageUs.index'));
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
            $userProjectTSGaleryImageU = $this->userProjectTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageU))
            {
                Flash::error('User Project T S Galery Image U not found');
                return redirect(route('userProjectTSGaleryImageUs.index'));
            }
    
            return view('user_project_t_s_galery_image_us.show')
                ->with('userProjectTSGaleryImageU', $userProjectTSGaleryImageU);
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
            $userProjectTSGaleryImageU = $this->userProjectTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageU))
            {
                Flash::error('User Project T S Galery Image U not found');
                return redirect(route('userProjectTSGaleryImageUs.index'));
            }
    
            return view('user_project_t_s_galery_image_us.edit')
                ->with('userProjectTSGaleryImageU', $userProjectTSGaleryImageU);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateUserProjectTSGaleryImageURequest $request)
    {
        if(Auth::user() != null)
        {
            $userProjectTSGaleryImageU = $this->userProjectTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageU))
            {
                Flash::error('User Project T S Galery Image U not found');
                return redirect(route('userProjectTSGaleryImageUs.index'));
            }
    
            $userProjectTSGaleryImageU = $this->userProjectTSGaleryImageURepository->update($request->all(), $id);
    
            Flash::success('User Project T S Galery Image U updated successfully.');
            return redirect(route('userProjectTSGaleryImageUs.index'));
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
            $userProjectTSGaleryImageU = $this->userProjectTSGaleryImageURepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageU))
            {
                Flash::error('User Project T S Galery Image U not found');
                return redirect(route('userProjectTSGaleryImageUs.index'));
            }
    
            $this->userProjectTSGaleryImageURepository->delete($id);
    
            Flash::success('User Project T S Galery Image U deleted successfully.');
            return redirect(route('userProjectTSGaleryImageUs.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}