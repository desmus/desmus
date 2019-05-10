<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSGaleryImageCRequest;
use App\Http\Requests\UpdateUserProjectTSGaleryImageCRequest;
use App\Repositories\UserProjectTSGaleryImageCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSGaleryImageCController extends AppBaseController
{
    private $userProjectTSGaleryImageCRepository;

    public function __construct(UserProjectTSGaleryImageCRepository $userProjectTSGaleryImageCRepo)
    {
        $this->userProjectTSGaleryImageCRepository = $userProjectTSGaleryImageCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSGaleryImageCRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSGaleryImageCs = $this->userProjectTSGaleryImageCRepository->all();
    
            return view('user_project_t_s_galery_image_cs.index')
                ->with('userProjectTSGaleryImageCs', $userProjectTSGaleryImageCs);
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
            return view('user_project_t_s_galery_image_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSGaleryImageCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSGaleryImageC = $this->userProjectTSGaleryImageCRepository->create($input);
            
                Flash::success('User Project T S Galery Image C saved successfully.');
                return redirect(route('userProjectTSGaleryImageCs.index'));
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
            $userProjectTSGaleryImageC = $this->userProjectTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageC))
            {
                Flash::error('User Project T S Galery Image C not found');
                return redirect(route('userProjectTSGaleryImageCs.index'));
            }
    
            if($userProjectTSGaleryImageD -> user_id == $user_id)
            {
                return view('user_project_t_s_galery_image_cs.show')
                    ->with('userProjectTSGaleryImageC', $userProjectTSGaleryImageC);
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
            $userProjectTSGaleryImageC = $this->userProjectTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageC))
            {
                Flash::error('User Project T S Galery Image C not found');
                return redirect(route('userProjectTSGaleryImageCs.index'));
            }
    
            if($userProjectTSGaleryImageD -> user_id == $user_id)
            {
                return view('user_project_t_s_galery_image_cs.edit')
                    ->with('userProjectTSGaleryImageC', $userProjectTSGaleryImageC);
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

    public function update($id, UpdateUserProjectTSGaleryImageCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSGaleryImageC = $this->userProjectTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageC))
            {
                Flash::error('User Project T S Galery Image C not found');
                return redirect(route('userProjectTSGaleryImageCs.index'));
            }
    
            if($userProjectTSGaleryImageD -> user_id == $user_id)
            {
                $userProjectTSGaleryImageC = $this->userProjectTSGaleryImageCRepository->update($request->all(), $id);
            
                Flash::success('User Project T S Galery Image C updated successfully.');
                return redirect(route('userProjectTSGaleryImageCs.index'));
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
            $userProjectTSGaleryImageC = $this->userProjectTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImageC))
            {
                Flash::error('User Project T S Galery Image C not found');
                return redirect(route('userProjectTSGaleryImageCs.index'));
            }
    
            if($userProjectTSGaleryImageD -> user_id == $user_id)
            {
                $this->userProjectTSGaleryImageCRepository->delete($id);
            
                Flash::success('User Project T S Galery Image C deleted successfully.');
                return redirect(route('userProjectTSGaleryImageCs.index'));
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