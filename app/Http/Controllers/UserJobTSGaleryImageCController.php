<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSGaleryImageCRequest;
use App\Http\Requests\UpdateUserJobTSGaleryImageCRequest;
use App\Repositories\UserJobTSGaleryImageCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSGaleryImageCController extends AppBaseController
{
    private $userJobTSGaleryImageCRepository;

    public function __construct(UserJobTSGaleryImageCRepository $userJobTSGaleryImageCRepo)
    {
        $this->userJobTSGaleryImageCRepository = $userJobTSGaleryImageCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSGaleryImageCRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSGaleryImageCs = $this->userJobTSGaleryImageCRepository->all();
    
            return view('user_job_t_s_galery_image_cs.index')
                ->with('userJobTSGaleryImageCs', $userJobTSGaleryImageCs);
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
            return view('user_job_t_s_galery_image_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSGaleryImageCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSGaleryImageC = $this->userJobTSGaleryImageCRepository->create($input);
            
                Flash::success('User Job T S Galery Image C saved successfully.');
                return redirect(route('userJobTSGaleryImageCs.index'));
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
            $userJobTSGaleryImageC = $this->userJobTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageC))
            {
                Flash::error('User Job T S Galery Image C not found');
                return redirect(route('userJobTSGaleryImageCs.index'));
            }
    
            if($userJobTSGaleryImageC -> user_id == $user_id)
            {
                return view('user_job_t_s_galery_image_cs.show')
                    ->with('userJobTSGaleryImageC', $userJobTSGaleryImageC);
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
            $userJobTSGaleryImageC = $this->userJobTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageC))
            {
                Flash::error('User Job T S Galery Image C not found');
                return redirect(route('userJobTSGaleryImageCs.index'));
            }
    
            if($userJobTSGaleryImageC -> user_id == $user_id)
            {
                return view('user_job_t_s_galery_image_cs.edit')
                    ->with('userJobTSGaleryImageC', $userJobTSGaleryImageC);
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

    public function update($id, UpdateUserJobTSGaleryImageCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSGaleryImageC = $this->userJobTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageC))
            {
                Flash::error('User Job T S Galery Image C not found');
                return redirect(route('userJobTSGaleryImageCs.index'));
            }
    
            if($userJobTSGaleryImageC -> user_id == $user_id)
            {
                $userJobTSGaleryImageC = $this->userJobTSGaleryImageCRepository->update($request->all(), $id);
            
                Flash::success('User Job T S Galery Image C updated successfully.');
                return redirect(route('userJobTSGaleryImageCs.index'));
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
            $userJobTSGaleryImageC = $this->userJobTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImageC))
            {
                Flash::error('User Job T S Galery Image C not found');
                return redirect(route('userJobTSGaleryImageCs.index'));
            }
    
            if($userJobTSGaleryImageC -> user_id == $user_id)
            {
                $this->userJobTSGaleryImageCRepository->delete($id);
            
                Flash::success('User Job T S Galery Image C deleted successfully.');
                return redirect(route('userJobTSGaleryImageCs.index'));
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