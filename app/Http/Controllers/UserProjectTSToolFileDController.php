<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSToolFileDRequest;
use App\Http\Requests\UpdateUserProjectTSToolFileDRequest;
use App\Repositories\UserProjectTSToolFileDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSToolFileDController extends AppBaseController
{
    private $userProjectTSToolFileDRepository;

    public function __construct(UserProjectTSToolFileDRepository $userProjectTSToolFileDRepo)
    {
        $this->userProjectTSToolFileDRepository = $userProjectTSToolFileDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSToolFileDRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSToolFileDs = $this->userProjectTSToolFileDRepository->all();
    
            return view('user_project_t_s_tool_file_ds.index')
                ->with('userProjectTSToolFileDs', $userProjectTSToolFileDs);
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
            return view('user_project_t_s_tool_file_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSToolFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSToolFileD = $this->userProjectTSToolFileDRepository->create($input);
            
                Flash::success('User Project T S Tool File D saved successfully.');
                return redirect(route('userProjectTSToolFileDs.index'));
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
            $userProjectTSToolFileD = $this->userProjectTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileD))
            {
                Flash::error('User Project T S Tool File D not found');
                return redirect(route('userProjectTSToolFileDs.index'));
            }
    
            if($userProjectTSToolFileD -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_file_ds.show')
                    ->with('userProjectTSToolFileD', $userProjectTSToolFileD);
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
            $userProjectTSToolFileD = $this->userProjectTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileD))
            {
                Flash::error('User Project T S Tool File D not found');
                return redirect(route('userProjectTSToolFileDs.index'));
            }
    
            if($userProjectTSToolFileD -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_file_ds.edit')
                    ->with('userProjectTSToolFileD', $userProjectTSToolFileD);
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

    public function update($id, UpdateUserProjectTSToolFileDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSToolFileD = $this->userProjectTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileD))
            {
                Flash::error('User Project T S Tool File D not found');
                return redirect(route('userProjectTSToolFileDs.index'));
            }
    
            if($userProjectTSToolFileD -> user_id == $user_id)
            {
                $userProjectTSToolFileD = $this->userProjectTSToolFileDRepository->update($request->all(), $id);
            
                Flash::success('User Project T S Tool File D updated successfully.');
                return redirect(route('userProjectTSToolFileDs.index'));
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
            $userProjectTSToolFileD = $this->userProjectTSToolFileDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileD))
            {
                Flash::error('User Project T S Tool File D not found');
                return redirect(route('userProjectTSToolFileDs.index'));
            }
    
            if($userProjectTSToolFileD -> user_id == $user_id)
            {
                $this->userProjectTSToolFileDRepository->delete($id);
            
                Flash::success('User Project T S Tool File D deleted successfully.');
                return redirect(route('userProjectTSToolFileDs.index'));
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