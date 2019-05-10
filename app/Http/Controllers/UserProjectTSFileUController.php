<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSFileURequest;
use App\Http\Requests\UpdateUserProjectTSFileURequest;
use App\Repositories\UserProjectTSFileURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSFileUController extends AppBaseController
{
    private $userProjectTSFileURepository;

    public function __construct(UserProjectTSFileURepository $userProjectTSFileURepo)
    {
        $this->userProjectTSFileURepository = $userProjectTSFileURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSFileURepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSFileUs = $this->userProjectTSFileURepository->all();
    
            return view('user_project_t_s_file_us.index')
                ->with('userProjectTSFileUs', $userProjectTSFileUs);
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
            return view('user_project_t_s_file_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSFileU = $this->userProjectTSFileURepository->create($input);
            
                Flash::success('User Project T S File U saved successfully.');
                return redirect(route('userProjectTSFileUs.index'));
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
            $userProjectTSFileU = $this->userProjectTSFileURepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileU))
            {
                Flash::error('User Project T S File U not found');
                return redirect(route('userProjectTSFileUs.index'));
            }
            
            if($userProjectTSFileU -> user_id == $user_id)
            {
                return view('user_project_t_s_file_us.show')
                    ->with('userProjectTSFileU', $userProjectTSFileU);
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
            $userProjectTSFileU = $this->userProjectTSFileURepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileU))
            {
                Flash::error('User Project T S File U not found');
                return redirect(route('userProjectTSFileUs.index'));
            }
    
            if($userProjectTSFileU -> user_id == $user_id)
            {
                return view('user_project_t_s_file_us.edit')
                    ->with('userProjectTSFileU', $userProjectTSFileU);
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

    public function update($id, UpdateUserProjectTSFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSFileU = $this->userProjectTSFileURepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileU))
            {
                Flash::error('User Project T S File U not found');
                return redirect(route('userProjectTSFileUs.index'));
            }
    
            if($userProjectTSFileU -> user_id == $user_id)
            {
                $userProjectTSFileU = $this->userProjectTSFileURepository->update($request->all(), $id);
            
                Flash::success('User Project T S File U updated successfully.');
                return redirect(route('userProjectTSFileUs.index'));
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
            $userProjectTSFileU = $this->userProjectTSFileURepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileU))
            {
                Flash::error('User Project T S File U not found');
                return redirect(route('userProjectTSFileUs.index'));
            }
    
            if($userProjectTSFileU -> user_id == $user_id)
            {
                $this->userProjectTSFileURepository->delete($id);
            
                Flash::success('User Project T S File U deleted successfully.');
                return redirect(route('userProjectTSFileUs.index'));
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