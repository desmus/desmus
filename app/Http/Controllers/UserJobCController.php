<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobCRequest;
use App\Http\Requests\UpdateUserJobCRequest;
use App\Repositories\UserJobCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobCController extends AppBaseController
{
    private $userJobCRepository;

    public function __construct(UserJobCRepository $userJobCRepo)
    {
        $this->userJobCRepository = $userJobCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobCRepository->pushCriteria(new RequestCriteria($request));
            $userJobCs = $this->userJobCRepository->all();
    
            return view('user_job_cs.index')
                ->with('userJobCs', $userJobCs);
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
            return view('user_job_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobC = $this->userJobCRepository->create($input);
            
                Flash::success('User Job C saved successfully.');
                return redirect(route('userJobCs.index'));
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
            $userJobC = $this->userJobCRepository->findWithoutFail($id);
    
            if(empty($userJobC))
            {
                Flash::error('User Job C not found');
                return redirect(route('userJobCs.index'));
            }
    
            if($userJobC -> user_id == $user_id)
            {
                return view('user_job_cs.show')
                    ->with('userJobC', $userJobC);
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
            $userJobC = $this->userJobCRepository->findWithoutFail($id);
    
            if(empty($userJobC))
            {
                Flash::error('User Job C not found');
                return redirect(route('userJobCs.index'));
            }
    
            if($userJobC -> user_id == $user_id)
            {
                return view('user_job_cs.edit')
                    ->with('userJobC', $userJobC);
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

    public function update($id, UpdateUserJobCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobC = $this->userJobCRepository->findWithoutFail($id);
    
            if(empty($userJobC))
            {
                Flash::error('User Job C not found');
                return redirect(route('userJobCs.index'));
            }
    
            if($userJobC -> user_id == $user_id)
            {
                $userJobC = $this->userJobCRepository->update($request->all(), $id);
            
                Flash::success('User Job C updated successfully.');
                return redirect(route('userJobCs.index'));
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
            $userJobC = $this->userJobCRepository->findWithoutFail($id);
    
            if (empty($userJobC))
            {
                Flash::error('User Job C not found');
                return redirect(route('userJobCs.index'));
            }
    
            if($userJobC -> user_id == $user_id)
            {
                $this->userJobCRepository->delete($id);
            
                Flash::success('User Job C deleted successfully.');
                return redirect(route('userJobCs.index'));
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