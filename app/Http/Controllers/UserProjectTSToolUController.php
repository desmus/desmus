<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSToolURequest;
use App\Http\Requests\UpdateUserProjectTSToolURequest;
use App\Repositories\UserProjectTSToolURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSToolUController extends AppBaseController
{
    private $userProjectTSToolURepository;

    public function __construct(UserProjectTSToolURepository $userProjectTSToolURepo)
    {
        $this->userProjectTSToolURepository = $userProjectTSToolURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSToolURepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSToolUs = $this->userProjectTSToolURepository->all();
    
            return view('user_project_t_s_tool_us.index')
                ->with('userProjectTSToolUs', $userProjectTSToolUs);
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
            return view('user_project_t_s_tool_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSToolURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSToolU = $this->userProjectTSToolURepository->create($input);
            
                Flash::success('User Project T S Tool U saved successfully.');
                return redirect(route('userProjectTSToolUs.index'));
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
            $userProjectTSToolU = $this->userProjectTSToolURepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolU))
            {
                Flash::error('User Project T S Tool U not found');
                return redirect(route('userProjectTSToolUs.index'));
            }
    
            if($userProjectTSToolU -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_us.show')
                    ->with('userProjectTSToolU', $userProjectTSToolU);
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
            $userProjectTSToolU = $this->userProjectTSToolURepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolU))
            {
                Flash::error('User Project T S Tool U not found');
                return redirect(route('userProjectTSToolUs.index'));
            }
    
            if($userProjectTSToolU -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_us.edit')
                    ->with('userProjectTSToolU', $userProjectTSToolU);
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

    public function update($id, UpdateUserProjectTSToolURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSToolU = $this->userProjectTSToolURepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolU))
            {
                Flash::error('User Project T S Tool U not found');
                return redirect(route('userProjectTSToolUs.index'));
            }
    
            if($userProjectTSToolU -> user_id == $user_id)
            {
                $userProjectTSToolU = $this->userProjectTSToolURepository->update($request->all(), $id);
            
                Flash::success('User Project T S Tool U updated successfully.');
                return redirect(route('userProjectTSToolUs.index'));
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
            $userProjectTSToolU = $this->userProjectTSToolURepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolU))
            {
                Flash::error('User Project T S Tool U not found');
                return redirect(route('userProjectTSToolUs.index'));
            }
    
            if($userProjectTSToolU -> user_id == $user_id)
            {
                $this->userProjectTSToolURepository->delete($id);
            
                Flash::success('User Project T S Tool U deleted successfully.');
                return redirect(route('userProjectTSToolUs.index'));
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