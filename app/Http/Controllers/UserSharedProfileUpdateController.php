<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserSharedProfileUpdateRequest;
use App\Http\Requests\UpdateUserSharedProfileUpdateRequest;
use App\Repositories\UserSharedProfileUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserSharedProfileUpdateController extends AppBaseController
{
    /** @var  UserSharedProfileUpdateRepository */
    private $userSharedProfileUpdateRepository;

    public function __construct(UserSharedProfileUpdateRepository $userSharedProfileUpdateRepo)
    {
        $this->userSharedProfileUpdateRepository = $userSharedProfileUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userSharedProfileUpdateRepository->pushCriteria(new RequestCriteria($request));
            $userSharedProfileUpdates = $this->userSharedProfileUpdateRepository->all();
    
            return view('user_shared_profile_updates.index')
                ->with('userSharedProfileUpdates', $userSharedProfileUpdates);
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
            return view('user_shared_profile_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserSharedProfileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $userSharedProfileUpdate = $this->userSharedProfileUpdateRepository->create($input);
    
                Flash::success('User Shared Profile Update saved successfully.');
                return redirect(route('userSharedProfileUpdates.index'));
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
            $userSharedProfileUpdate = $this->userSharedProfileUpdateRepository->findWithoutFail($id);
    
            if(empty($userSharedProfileUpdate))
            {
                Flash::error('User Shared Profile Update not found');
                return redirect(route('userSharedProfileUpdates.index'));
            }
    
            if($userSharedProfileUpdate -> user_id == $user_id)
            {
                return view('user_shared_profile_updates.show')
                    ->with('userSharedProfileUpdate', $userSharedProfileUpdate);
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
            $userSharedProfileUpdate = $this->userSharedProfileUpdateRepository->findWithoutFail($id);
    
            if(empty($userSharedProfileUpdate))
            {
                Flash::error('User Shared Profile Update not found');
                return redirect(route('userSharedProfileUpdates.index'));
            }
    
            if($userSharedProfileUpdate -> user_id == $user_id)
            {
                return view('user_shared_profile_updates.edit')
                    ->with('userSharedProfileUpdate', $userSharedProfileUpdate);
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

    public function update($id, UpdateUserSharedProfileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userSharedProfileUpdate = $this->userSharedProfileUpdateRepository->findWithoutFail($id);
    
            if(empty($userSharedProfileUpdate))
            {
                Flash::error('User Shared Profile Update not found');
                return redirect(route('userSharedProfileUpdates.index'));
            }
    
            if($userSharedProfileUpdate -> user_id == $user_id)
            {
                $userSharedProfileUpdate = $this->userSharedProfileUpdateRepository->update($request->all(), $id);
        
                Flash::success('User Shared Profile Update updated successfully.');
                return redirect(route('userSharedProfileUpdates.index'));
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
            $userSharedProfileUpdate = $this->userSharedProfileUpdateRepository->findWithoutFail($id);
    
            if(empty($userSharedProfileUpdate))
            {
                Flash::error('User Shared Profile Update not found');
                return redirect(route('userSharedProfileUpdates.index'));
            }
    
            if($userSharedProfileUpdate -> user_id == $user_id)
            {
                $this->userSharedProfileUpdateRepository->delete($id);
    
                Flash::success('User Shared Profile Update deleted successfully.');
                return redirect(route('userSharedProfileUpdates.index'));
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