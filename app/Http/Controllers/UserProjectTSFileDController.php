<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSFileDRequest;
use App\Http\Requests\UpdateUserProjectTSFileDRequest;
use App\Repositories\UserProjectTSFileDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSFileDController extends AppBaseController
{
    private $userProjectTSFileDRepository;

    public function __construct(UserProjectTSFileDRepository $userProjectTSFileDRepo)
    {
        $this->userProjectTSFileDRepository = $userProjectTSFileDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSFileDRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSFileDs = $this->userProjectTSFileDRepository->all();
    
            return view('user_project_t_s_file_ds.index')
                ->with('userProjectTSFileDs', $userProjectTSFileDs);
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
            return view('user_project_t_s_file_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSFileD = $this->userProjectTSFileDRepository->create($input);
            
                Flash::success('User Project T S File D saved successfully.');
                return redirect(route('userProjectTSFileDs.index'));
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
            $userProjectTSFileD = $this->userProjectTSFileDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileD))
            {
                Flash::error('User Project T S File D not found');
                return redirect(route('userProjectTSFileDs.index'));
            }
            
            if($userProjectTSFileD -> user_id == $user_id)
            {
                return view('user_project_t_s_file_ds.show')
                    ->with('userProjectTSFileD', $userProjectTSFileD);
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
            $userProjectTSFileD = $this->userProjectTSFileDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileD))
            {
                Flash::error('User Project T S File D not found');
                return redirect(route('userProjectTSFileDs.index'));
            }
    
            if($userProjectTSFileD -> user_id == $user_id)
            {
                return view('user_project_t_s_file_ds.edit')
                    ->with('userProjectTSFileD', $userProjectTSFileD);
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

    public function update($id, UpdateUserProjectTSFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSFileD = $this->userProjectTSFileDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileD))
            {
                Flash::error('User Project T S File D not found');
                return redirect(route('userProjectTSFileDs.index'));
            }
    
            if($userProjectTSFileD -> user_id == $user_id)
            {
                $userProjectTSFileD = $this->userProjectTSFileDRepository->update($request->all(), $id);
            
                Flash::success('User Project T S File D updated successfully.');
                return redirect(route('userProjectTSFileDs.index'));
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
            $userProjectTSFileD = $this->userProjectTSFileDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileD))
            {
                Flash::error('User Project T S File D not found');
                return redirect(route('userProjectTSFileDs.index'));
            }
    
            if($userProjectTSFileD -> user_id == $user_id)
            {
                $this->userProjectTSFileDRepository->delete($id);
            
                Flash::success('User Project T S File D deleted successfully.');
                return redirect(route('userProjectTSFileDs.index'));
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