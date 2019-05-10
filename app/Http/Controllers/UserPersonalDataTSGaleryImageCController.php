<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSGaleryImageCRequest;
use App\Http\Requests\UpdateUserPersonalDataTSGaleryImageCRequest;
use App\Repositories\UserPersonalDataTSGaleryImageCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSGaleryImageCController extends AppBaseController
{
    private $userPersonalDataTSGaleryImageCRepository;

    public function __construct(UserPersonalDataTSGaleryImageCRepository $userPersonalDataTSGaleryImageCRepo)
    {
        $this->userPersonalDataTSGaleryImageCRepository = $userPersonalDataTSGaleryImageCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSGaleryImageCRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSGaleryImageCs = $this->userPersonalDataTSGaleryImageCRepository->all();
    
            return view('user_personal_data_t_s_galery_image_cs.index')
                ->with('userPersonalDataTSGaleryImageCs', $userPersonalDataTSGaleryImageCs);
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
            return view('user_personal_data_t_s_galery_image_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSGaleryImageCRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSGaleryImageC = $this->userPersonalDataTSGaleryImageCRepository->create($input);
            
                Flash::success('User Personal Data T S Galery Image C saved successfully.');
                return redirect(route('userPersonalDataTSGaleryImageCs.index'));
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
            $userPersonalDataTSGaleryImageC = $this->userPersonalDataTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageC))
            {
                Flash::error('User Personal Data T S Galery Image C not found');
                return redirect(route('userPersonalDataTSGaleryImageCs.index'));
            }
    
            if($userPersonalDataTSGaleryImageC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galery_image_cs.show')
                    ->with('userPersonalDataTSGaleryImageC', $userPersonalDataTSGaleryImageC);
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
            $userPersonalDataTSGaleryImageC = $this->userPersonalDataTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageC))
            {
                Flash::error('User Personal Data T S Galery Image C not found');
                return redirect(route('userPersonalDataTSGaleryImageCs.index'));
            }
    
            if($userPersonalDataTSGaleryImageC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galery_image_cs.edit')
                    ->with('userPersonalDataTSGaleryImageC', $userPersonalDataTSGaleryImageC);
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

    public function update($id, UpdateUserPersonalDataTSGaleryImageCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSGaleryImageC = $this->userPersonalDataTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageC))
            {
                Flash::error('User Personal Data T S Galery Image C not found');
                return redirect(route('userPersonalDataTSGaleryImageCs.index'));
            }
    
            if($userPersonalDataTSGaleryImageC -> user_id == $user_id)
            {
                $userPersonalDataTSGaleryImageC = $this->userPersonalDataTSGaleryImageCRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Galery Image C updated successfully.');
                return redirect(route('userPersonalDataTSGaleryImageCs.index'));
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
            $userPersonalDataTSGaleryImageC = $this->userPersonalDataTSGaleryImageCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImageC))
            {
                Flash::error('User Personal Data T S Galery Image C not found');
                return redirect(route('userPersonalDataTSGaleryImageCs.index'));
            }
    
            if($userPersonalDataTSGaleryImageC -> user_id == $user_id)
            {
                $this->userPersonalDataTSGaleryImageCRepository->delete($id);
            
                Flash::success('User Personal Data T S Galery Image C deleted successfully.');
                return redirect(route('userPersonalDataTSGaleryImageCs.index'));
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