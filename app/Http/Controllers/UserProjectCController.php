<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectCRequest;
use App\Http\Requests\UpdateUserProjectCRequest;
use App\Repositories\UserProjectCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectCController extends AppBaseController
{
    private $userProjectCRepository;

    public function __construct(UserProjectCRepository $userProjectCRepo)
    {
        $this->userProjectCRepository = $userProjectCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectCRepository->pushCriteria(new RequestCriteria($request));
            $userProjectCs = $this->userProjectCRepository->all();
    
            return view('user_project_cs.index')
                ->with('userProjectCs', $userProjectCs);
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
            return view('user_project_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectC = $this->userProjectCRepository->create($input);
            
                Flash::success('User Project C saved successfully.');
                return redirect(route('userProjectCs.index'));
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
            $userProjectC = $this->userProjectCRepository->findWithoutFail($id);
    
            if(empty($userProjectC))
            {
                Flash::error('User Project C not found');
                return redirect(route('userProjectCs.index'));
            }
    
            if($userProjectC -> user_id == $user_id)
            {
                return view('user_project_cs.show')
                    ->with('userProjectC', $userProjectC);
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
            $userProjectC = $this->userProjectCRepository->findWithoutFail($id);
    
            if(empty($userProjectC))
            {
                Flash::error('User Project C not found');
                return redirect(route('userProjectCs.index'));
            }
    
            if($userProjectC -> user_id == $user_id)
            {
                return view('user_project_cs.edit')
                    ->with('userProjectC', $userProjectC);
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

    public function update($id, UpdateUserProjectCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectC = $this->userProjectCRepository->findWithoutFail($id);
    
            if(empty($userProjectC))
            {
                Flash::error('User Project C not found');
                return redirect(route('userProjectCs.index'));
            }
    
            if($userProjectC -> user_id == $user_id)
            {
                $userProjectC = $this->userProjectCRepository->update($request->all(), $id);
            
                Flash::success('User Project C updated successfully.');
                return redirect(route('userProjectCs.index'));
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
            $userProjectC = $this->userProjectCRepository->findWithoutFail($id);
    
            if(empty($userProjectC))
            {
                Flash::error('User Project C not found');
                return redirect(route('userProjectCs.index'));
            }
    
            if($userProjectC -> user_id == $user_id)
            {
                $this->userProjectCRepository->delete($id);
            
                Flash::success('User Project C deleted successfully.');
                return redirect(route('userProjectCs.index'));
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