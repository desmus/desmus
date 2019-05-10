<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserSharedProfileCreateRequest;
use App\Http\Requests\UpdateUserSharedProfileCreateRequest;
use App\Repositories\UserSharedProfileCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserSharedProfileCreateController extends AppBaseController
{
    /** @var  UserSharedProfileCreateRepository */
    private $userSharedProfileCreateRepository;

    public function __construct(UserSharedProfileCreateRepository $userSharedProfileCreateRepo)
    {
        $this->userSharedProfileCreateRepository = $userSharedProfileCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userSharedProfileCreateRepository->pushCriteria(new RequestCriteria($request));
            $userSharedProfileCreates = $this->userSharedProfileCreateRepository->all();
    
            return view('user_shared_profile_creates.index')
                ->with('userSharedProfileCreates', $userSharedProfileCreates);
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
            return view('user_shared_profile_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserSharedProfileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();

            if($input -> user_id == $user_id)
            {
                $userSharedProfileCreate = $this->userSharedProfileCreateRepository->create($input);
                
                Flash::success('User Shared Profile Create saved successfully.');
                return redirect(route('userSharedProfileCreates.index'));
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
            $userSharedProfileCreate = $this->userSharedProfileCreateRepository->findWithoutFail($id);

            if(empty($userSharedProfileCreate))
            {
                Flash::error('User Shared Profile Create not found');
                return redirect(route('userSharedProfileCreates.index'));
            }
        
            if($userSharedProfileCreate -> user_id == $user_id)
            {
                return view('user_shared_profile_creates.show')
                    ->with('userSharedProfileCreate', $userSharedProfileCreate);
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
            $userSharedProfileCreate = $this->userSharedProfileCreateRepository->findWithoutFail($id);

            if(empty($userSharedProfileCreate))
            {
                Flash::error('User Shared Profile Create not found');
                return redirect(route('userSharedProfileCreates.index'));
            }
            
            if($userSharedProfileCreate -> user_id == $user_id)
            {
                return view('user_shared_profile_creates.edit')
                    ->with('userSharedProfileCreate', $userSharedProfileCreate);
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

    public function update($id, UpdateUserSharedProfileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userSharedProfileCreate = $this->userSharedProfileCreateRepository->findWithoutFail($id);
    
            if(empty($userSharedProfileCreate))
            {
                Flash::error('User Shared Profile Create not found');
                return redirect(route('userSharedProfileCreates.index'));
            }
    
            if($userSharedProfileCreate -> user_id == $user_id)
            {
                $userSharedProfileCreate = $this->userSharedProfileCreateRepository->update($request->all(), $id);
        
                Flash::success('User Shared Profile Create updated successfully.');
                return redirect(route('userSharedProfileCreates.index'));
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
            $userSharedProfileCreate = $this->userSharedProfileCreateRepository->findWithoutFail($id);

            if(empty($userSharedProfileCreate))
            {
                Flash::error('User Shared Profile Create not found');
                return redirect(route('userSharedProfileCreates.index'));
            }

            if($userSharedProfileCreate -> user_id == $user_id)
            {
                $this->userSharedProfileCreateRepository->delete($id);
        
                Flash::success('User Shared Profile Create deleted successfully.');
                return redirect(route('userSharedProfileCreates.index'));
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