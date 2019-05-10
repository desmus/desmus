<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeDRequest;
use App\Http\Requests\UpdateUserCollegeDRequest;
use App\Repositories\UserCollegeDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeDController extends AppBaseController
{
    private $userCollegeDRepository;

    public function __construct(UserCollegeDRepository $userCollegeDRepo)
    {
        $this->userCollegeDRepository = $userCollegeDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeDRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeDs = $this->userCollegeDRepository->all();
    
            return view('user_college_ds.index')
                ->with('userCollegeDs', $userCollegeDs);
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
            return view('user_college_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeD = $this->userCollegeDRepository->create($input);
            
                Flash::success('User College D saved successfully.');
                return redirect(route('userCollegeDeletes.index'));
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
            $userCollegeD = $this->userCollegeDRepository->findWithoutFail($id);
    
            if(empty($userCollegeD))
            {
                Flash::error('User College D not found');
                return redirect(route('userCollegeDeletes.index'));
            }
    
            if($userCollegeD -> user_id == $user_id)
            {
                return view('user_college_ds.show')
                    ->with('userCollegeD', $userCollegeD);
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
            $userCollegeD = $this->userCollegeDRepository->findWithoutFail($id);
    
            if(empty($userCollegeD))
            {
                Flash::error('User College D not found');
                return redirect(route('userCollegeDeletes.index'));
            }
    
            if($userCollegeD -> user_id == $user_id)
            {
                return view('user_college_ds.edit')
                    ->with('userCollegeD', $userCollegeD);
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

    public function update($id, UpdateUserCollegeDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeD = $this->userCollegeDRepository->findWithoutFail($id);
    
            if(empty($userCollegeD))
            {
                Flash::error('User College D not found');
                return redirect(route('userCollegeDeletes.index'));
            }
    
            if($userCollegeD -> user_id == $user_id)
            {
                $userCollegeD = $this->userCollegeDRepository->update($request->all(), $id);
            
                Flash::success('User College D updated successfully.');
                return redirect(route('userCollegeDeletes.index'));
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
            $userCollegeD = $this->userCollegeDRepository->findWithoutFail($id);
    
            if(empty($userCollegeD))
            {
                Flash::error('User College D not found');
                return redirect(route('userCollegeDeletes.index'));
            }
    
            if($userCollegeD -> user_id == $user_id)
            {
                $this->userCollegeDRepository->delete($id);
            
                Flash::success('User College D deleted successfully.');
                return redirect(route('userCollegeDeletes.index'));
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