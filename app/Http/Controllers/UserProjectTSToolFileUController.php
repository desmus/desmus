<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSToolFileURequest;
use App\Http\Requests\UpdateUserProjectTSToolFileURequest;
use App\Repositories\UserProjectTSToolFileURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSToolFileUController extends AppBaseController
{
    private $userProjectTSToolFileURepository;

    public function __construct(UserProjectTSToolFileURepository $userProjectTSToolFileURepo)
    {
        $this->userProjectTSToolFileURepository = $userProjectTSToolFileURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSToolFileURepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSToolFileUs = $this->userProjectTSToolFileURepository->all();
    
            return view('user_project_t_s_tool_file_us.index')
                ->with('userProjectTSToolFileUs', $userProjectTSToolFileUs);
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
            return view('user_project_t_s_tool_file_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSToolFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSToolFileU = $this->userProjectTSToolFileURepository->create($input);
            
                Flash::success('User Project T S Tool File U saved successfully.');
                return redirect(route('userProjectTSToolFileUs.index'));
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
            $userProjectTSToolFileU = $this->userProjectTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileU))
            {
                Flash::error('User Project T S Tool File U not found');
                return redirect(route('userProjectTSToolFileUs.index'));
            }
    
            if($userProjectTSToolFileU -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_file_us.show')
                    ->with('userProjectTSToolFileU', $userProjectTSToolFileU);
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
            $userProjectTSToolFileU = $this->userProjectTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileU))
            {
                Flash::error('User Project T S Tool File U not found');
                return redirect(route('userProjectTSToolFileUs.index'));
            }
    
            if($userProjectTSToolFileU -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_file_us.edit')
                    ->with('userProjectTSToolFileU', $userProjectTSToolFileU);
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

    public function update($id, UpdateUserProjectTSToolFileURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSToolFileU = $this->userProjectTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileU))
            {
                Flash::error('User Project T S Tool File U not found');
                return redirect(route('userProjectTSToolFileUs.index'));
            }
    
            if($userProjectTSToolFileU -> user_id == $user_id)
            {
                $userProjectTSToolFileU = $this->userProjectTSToolFileURepository->update($request->all(), $id);
            
                Flash::success('User Project T S Tool File U updated successfully.');
                return redirect(route('userProjectTSToolFileUs.index'));
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
            $userProjectTSToolFileU = $this->userProjectTSToolFileURepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFileU))
            {
                Flash::error('User Project T S Tool File U not found');
                return redirect(route('userProjectTSToolFileUs.index'));
            }
    
            if($userProjectTSToolFileU -> user_id == $user_id)
            {
                $this->userProjectTSToolFileURepository->delete($id);
            
                Flash::success('User Project T S Tool File U deleted successfully.');
                return redirect(route('userProjectTSToolFileUs.index'));
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