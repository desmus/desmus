<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSGaleryImageCRequest;
use App\Http\Requests\UpdateUserCollegeTSGaleryImageCRequest;
use App\Repositories\UserCollegeTSGaleryImageCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSGaleryImageCController extends AppBaseController
{
    private $userCollegeTSGaleryImageCRepository;

    public function __construct(UserCollegeTSGaleryImageCRepository $userCollegeTSGaleryImageCRepo)
    {
        $this->userCollegeTSGaleryImageCRepository = $userCollegeTSGaleryImageCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSGaleryImageCRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSGaleryImageCs = $this->userCollegeTSGaleryImageCRepository->all();
    
            return view('user_college_t_s_galery_image_cs.index')
                ->with('userCollegeTSGaleryImageCs', $userCollegeTSGaleryImageCs);
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
            return view('user_college_t_s_galery_image_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSGaleryImageCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSGaleryImageC = $this->userCollegeTSGaleryImageCRepository->create($input);
            
                Flash::success('User College T S Galery Image C saved successfully.');
                return redirect(route('userCollegeTSGaleryImageCs.index'));
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
            $userCollegeTSGaleryImageC = $this->userCollegeTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageC))
            {
                Flash::error('User College T S Galery Image C not found');
                return redirect(route('userCollegeTSGaleryImageCs.index'));
            }
    
            if($userCollegeTSGaleryImageC -> user_id == $user_id)
            {
                return view('user_college_t_s_galery_image_cs.show')
                    ->with('userCollegeTSGaleryImageC', $userCollegeTSGaleryImageC);
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
            $userCollegeTSGaleryImageC = $this->userCollegeTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageC))
            {
                Flash::error('User College T S Galery Image C not found');
                return redirect(route('userCollegeTSGaleryImageCs.index'));
            }
    
            if($userCollegeTSGaleryImageC -> user_id == $user_id)
            {
                return view('user_college_t_s_galery_image_cs.edit')
                    ->with('userCollegeTSGaleryImageC', $userCollegeTSGaleryImageC);
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

    public function update($id, UpdateUserCollegeTSGaleryImageCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSGaleryImageC = $this->userCollegeTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageC))
            {
                Flash::error('User College T S Galery Image C not found');
                return redirect(route('userCollegeTSGaleryImageCs.index'));
            }
    
            if($userCollegeTSGaleryImageC -> user_id == $user_id)
            {
                $userCollegeTSGaleryImageC = $this->userCollegeTSGaleryImageCRepository->update($request->all(), $id);
            
                Flash::success('User College T S Galery Image C updated successfully.');
                return redirect(route('userCollegeTSGaleryImageCs.index'));
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
            $userCollegeTSGaleryImageC = $this->userCollegeTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImageC))
            {
                Flash::error('User College T S Galery Image C not found');
                return redirect(route('userCollegeTSGaleryImageCs.index'));
            }
    
            if($userCollegeTSGaleryImageC -> user_id == $user_id)
            {
                $this->userCollegeTSGaleryImageCRepository->delete($id);
            
                Flash::success('User College T S Galery Image C deleted successfully.');
                return redirect(route('userCollegeTSGaleryImageCs.index'));
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