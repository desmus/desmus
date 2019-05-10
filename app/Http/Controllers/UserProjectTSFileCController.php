<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSFileCRequest;
use App\Http\Requests\UpdateUserProjectTSFileCRequest;
use App\Repositories\UserProjectTSFileCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSFileCController extends AppBaseController
{
    private $userProjectTSFileCRepository;

    public function __construct(UserProjectTSFileCRepository $userProjectTSFileCRepo)
    {
        $this->userProjectTSFileCRepository = $userProjectTSFileCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSFileCRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSFileCs = $this->userProjectTSFileCRepository->all();
    
            return view('user_project_t_s_file_cs.index')
                ->with('userProjectTSFileCs', $userProjectTSFileCs);
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
            return view('user_project_t_s_file_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSFileC = $this->userProjectTSFileCRepository->create($input);
                
                Flash::success('User Project T S File C saved successfully.');
                return redirect(route('userProjectTSFileCs.index'));
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
            $userProjectTSFileC = $this->userProjectTSFileCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileC))
            {
                Flash::error('User Project T S File C not found');
                return redirect(route('userProjectTSFileCs.index'));
            }
    
            if($userProjectTSFileC -> user_id == $user_id)
            {
                return view('user_project_t_s_file_cs.show')
                    ->with('userProjectTSFileC', $userProjectTSFileC);
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
            $userProjectTSFileC = $this->userProjectTSFileCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileC))
            {
                Flash::error('User Project T S File C not found');
                return redirect(route('userProjectTSFileCs.index'));
            }
    
            if($userProjectTSFileC -> user_id == $user_id)
            {
                return view('user_project_t_s_file_cs.edit')
                    ->with('userProjectTSFileC', $userProjectTSFileC);
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

    public function update($id, UpdateUserProjectTSFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $userProjectTSFileC = $this->userProjectTSFileCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileC))
            {
                Flash::error('User Project T S File C not found');
                return redirect(route('userProjectTSFileCs.index'));
            }
    
            if($userProjectTSFileC -> user_id == $user_id)
            {
                $userProjectTSFileC = $this->userProjectTSFileCRepository->update($request->all(), $id);
            
                Flash::success('User Project T S File C updated successfully.');
                return redirect(route('userProjectTSFileCs.index'));
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
            $userProjectTSFileC = $this->userProjectTSFileCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSFileC))
            {
                Flash::error('User Project T S File C not found');
                return redirect(route('userProjectTSFileCs.index'));
            }
    
            if($userProjectTSFileC -> user_id == $user_id)
            {
                $this->userProjectTSFileCRepository->delete($id);
            
                Flash::success('User Project T S File C deleted successfully.');
                return redirect(route('userProjectTSFileCs.index'));
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