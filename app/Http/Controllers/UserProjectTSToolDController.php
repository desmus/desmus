<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSToolDRequest;
use App\Http\Requests\UpdateUserProjectTSToolDRequest;
use App\Repositories\UserProjectTSToolDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSToolDController extends AppBaseController
{
    private $userProjectTSToolDRepository;

    public function __construct(UserProjectTSToolDRepository $userProjectTSToolDRepo)
    {
        $this->userProjectTSToolDRepository = $userProjectTSToolDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSToolDRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSToolDs = $this->userProjectTSToolDRepository->all();
    
            return view('user_project_t_s_tool_ds.index')
                ->with('userProjectTSToolDs', $userProjectTSToolDs);
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
            return view('user_project_t_s_tool_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSToolDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSToolD = $this->userProjectTSToolDRepository->create($input);
                
                Flash::success('User Project T S Tool D saved successfully.');
                return redirect(route('userProjectTSToolDs.index'));
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
            $userProjectTSToolD = $this->userProjectTSToolDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolD))
            {
                Flash::error('User Project T S Tool D not found');
                return redirect(route('userProjectTSToolDs.index'));
            }
    
            if($userProjectTSToolD -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_ds.show')
                    ->with('userProjectTSToolD', $userProjectTSToolD);
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
            $userProjectTSToolD = $this->userProjectTSToolDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolD))
            {
                Flash::error('User Project T S Tool D not found');
                return redirect(route('userProjectTSToolDs.index'));
            }
    
            if($userProjectTSToolD -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_ds.edit')
                    ->with('userProjectTSToolD', $userProjectTSToolD);
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

    public function update($id, UpdateUserProjectTSToolDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSToolD = $this->userProjectTSToolDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolD))
            {
                Flash::error('User Project T S Tool D not found');
                return redirect(route('userProjectTSToolDs.index'));
            }
    
            if($userProjectTSToolD -> user_id == $user_id)
            {
                $userProjectTSToolD = $this->userProjectTSToolDRepository->update($request->all(), $id);
            
                Flash::success('User Project T S Tool D updated successfully.');
                return redirect(route('userProjectTSToolDs.index'));
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
            $userProjectTSToolD = $this->userProjectTSToolDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolD))
            {
                Flash::error('User Project T S Tool D not found');
                return redirect(route('userProjectTSToolDs.index'));
            }
    
            if($userProjectTSToolD -> user_id == $user_id)
            {
                $this->userProjectTSToolDRepository->delete($id);
            
                Flash::success('User Project T S Tool D deleted successfully.');
                return redirect(route('userProjectTSToolDs.index'));
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