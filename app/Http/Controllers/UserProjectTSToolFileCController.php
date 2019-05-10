<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSToolFileCRequest;
use App\Http\Requests\UpdateUserProjectTSToolFileCRequest;
use App\Repositories\UserProjectTSToolFileCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSToolFileCController extends AppBaseController
{
    private $userProjectTSToolFileCRepository;

    public function __construct(UserProjectTSToolFileCRepository $userProjectTSToolFileCRepo)
    {
        $this->userProjectTSToolFileCRepository = $userProjectTSToolFileCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSToolFileCRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSToolFileCs = $this->userProjectTSToolFileCRepository->all();
    
            return view('user_project_t_s_tool_file_cs.index')
                ->with('userProjectTSToolFileCs', $userProjectTSToolFileCs);
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
            return view('user_project_t_s_tool_file_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSToolFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSToolFileC = $this->userProjectTSToolFileCRepository->create($input);
            
                Flash::success('User Project T S Tool File C saved successfully.');
                return redirect(route('userProjectTSToolFileCs.index'));
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
            $userProjectTSToolFileC = $this->userProjectTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileC))
            {
                Flash::error('User Project T S Tool File C not found');
                return redirect(route('userProjectTSToolFileCs.index'));
            }
    
            if($userProjectTSToolFileC -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_file_cs.show')
                    ->with('userProjectTSToolFileC', $userProjectTSToolFileC);
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
            $userProjectTSToolFileC = $this->userProjectTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileC))
            {
                Flash::error('User Project T S Tool File C not found');
                return redirect(route('userProjectTSToolFileCs.index'));
            }
    
            if($userProjectTSToolFileC -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_file_cs.edit')
                    ->with('userProjectTSToolFileC', $userProjectTSToolFileC);
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

    public function update($id, UpdateUserProjectTSToolFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSToolFileC = $this->userProjectTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileC))
            {
                Flash::error('User Project T S Tool File C not found');
                return redirect(route('userProjectTSToolFileCs.index'));
            }
    
            if($userProjectTSToolFileC -> user_id == $user_id)
            {
                $userProjectTSToolFileC = $this->userProjectTSToolFileCRepository->update($request->all(), $id);
            
                Flash::success('User Project T S Tool File C updated successfully.');
                return redirect(route('userProjectTSToolFileCs.index'));
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
            $userProjectTSToolFileC = $this->userProjectTSToolFileCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileC))
            {
                Flash::error('User Project T S Tool File C not found');
                return redirect(route('userProjectTSToolFileCs.index'));
            }
    
            if($userProjectTSToolFileC -> user_id == $user_id)
            {
                $this->userProjectTSToolFileCRepository->delete($id);
            
                Flash::success('User Project T S Tool File C deleted successfully.');
                return redirect(route('userProjectTSToolFileCs.index'));
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