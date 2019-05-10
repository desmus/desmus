<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectDRequest;
use App\Http\Requests\UpdateUserProjectDRequest;
use App\Repositories\UserProjectDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectDController extends AppBaseController
{
    private $userProjectDRepository;

    public function __construct(UserProjectDRepository $userProjectDRepo)
    {
        $this->userProjectDRepository = $userProjectDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectDRepository->pushCriteria(new RequestCriteria($request));
            $userProjectDs = $this->userProjectDRepository->all();
    
            return view('user_project_ds.index')
                ->with('userProjectDs', $userProjectDs);
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
            return view('user_project_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectD = $this->userProjectDRepository->create($input);
            
                Flash::success('User Project D saved successfully.');
                return redirect(route('userProjectDs.index'));
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
            $userProjectD = $this->userProjectDRepository->findWithoutFail($id);
    
            if(empty($userProjectD))
            {
                Flash::error('User Project D not found');
                return redirect(route('userProjectDs.index'));
            }
    
            if($userProjectD -> user_id == $user_id)
            {
                return view('user_project_ds.show')
                    ->with('userProjectD', $userProjectD);
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
            $userProjectD = $this->userProjectDRepository->findWithoutFail($id);
    
            if(empty($userProjectD))
            {
                Flash::error('User Project D not found');
                return redirect(route('userProjectDs.index'));
            }
    
            if($userProjectD -> user_id == $user_id)
            {
                return view('user_project_ds.edit')
                    ->with('userProjectD', $userProjectD);
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

    public function update($id, UpdateUserProjectDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectD = $this->userProjectDRepository->findWithoutFail($id);
    
            if(empty($userProjectD))
            {
                Flash::error('User Project D not found');
                return redirect(route('userProjectDs.index'));
            }
    
            if($userProjectD -> user_id == $user_id)
            {
                $userProjectD = $this->userProjectDRepository->update($request->all(), $id);
            
                Flash::success('User Project D updated successfully.');
                return redirect(route('userProjectDs.index'));
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
            $userProjectD = $this->userProjectDRepository->findWithoutFail($id);
    
            if(empty($userProjectD))
            {
                Flash::error('User Project D not found');
                return redirect(route('userProjectDs.index'));
            }
    
            if($userProjectD -> user_id == $user_id)
            {
                $this->userProjectDRepository->delete($id);
            
                Flash::success('User Project D deleted successfully.');
                return redirect(route('userProjectDs.index'));
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