<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSToolCRequest;
use App\Http\Requests\UpdateUserProjectTSToolCRequest;
use App\Repositories\UserProjectTSToolCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSToolCController extends AppBaseController
{
    private $userProjectTSToolCRepository;

    public function __construct(UserProjectTSToolCRepository $userProjectTSToolCRepo)
    {
        $this->userProjectTSToolCRepository = $userProjectTSToolCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSToolCRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSToolCs = $this->userProjectTSToolCRepository->all();
    
            return view('user_project_t_s_tool_cs.index')
                ->with('userProjectTSToolCs', $userProjectTSToolCs);
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
            return view('user_project_t_s_tool_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSToolCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSToolC = $this->userProjectTSToolCRepository->create($input);
            
                Flash::success('User Project T S Tool C saved successfully.');
                return redirect(route('userProjectTSToolCs.index'));
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
            $userProjectTSToolC = $this->userProjectTSToolCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolC))
            {
                Flash::error('User Project T S Tool C not found');
                return redirect(route('userProjectTSToolCs.index'));
            }
    
            if($userProjectTSToolC -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_cs.show')
                    ->with('userProjectTSToolC', $userProjectTSToolC);
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
            $userProjectTSToolC = $this->userProjectTSToolCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolC))
            {
                Flash::error('User Project T S Tool C not found');
                return redirect(route('userProjectTSToolCs.index'));
            }
    
            if($userProjectTSToolC -> user_id == $user_id)
            {
                return view('user_project_t_s_tool_cs.edit')
                    ->with('userProjectTSToolC', $userProjectTSToolC);
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

    public function update($id, UpdateUserProjectTSToolCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSToolC = $this->userProjectTSToolCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolC))
            {
                Flash::error('User Project T S Tool C not found');
                return redirect(route('userProjectTSToolCs.index'));
            }
    
            if($userProjectTSToolC -> user_id == $user_id)
            {
                $userProjectTSToolC = $this->userProjectTSToolCRepository->update($request->all(), $id);
            
                Flash::success('User Project T S Tool C updated successfully.');
                return redirect(route('userProjectTSToolCs.index'));
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
            $userProjectTSToolC = $this->userProjectTSToolCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolC))
            {
                Flash::error('User Project T S Tool C not found');
                return redirect(route('userProjectTSToolCs.index'));
            }
    
            if($userProjectTSToolC -> user_id == $user_id)
            {
                $this->userProjectTSToolCRepository->delete($id);
            
                Flash::success('User Project T S Tool C deleted successfully.');
                return redirect(route('userProjectTSToolCs.index'));
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