<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserSharedProfileDeleteRequest;
use App\Http\Requests\UpdateUserSharedProfileDeleteRequest;
use App\Repositories\UserSharedProfileDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserSharedProfileDeleteController extends AppBaseController
{
    /** @var  UserSharedProfileDeleteRepository */
    private $userSharedProfileDeleteRepository;

    public function __construct(UserSharedProfileDeleteRepository $userSharedProfileDeleteRepo)
    {
        $this->userSharedProfileDeleteRepository = $userSharedProfileDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userSharedProfileDeleteRepository->pushCriteria(new RequestCriteria($request));
            $userSharedProfileDeletes = $this->userSharedProfileDeleteRepository->all();
    
            return view('user_shared_profile_deletes.index')
                ->with('userSharedProfileDeletes', $userSharedProfileDeletes);
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
            return view('user_shared_profile_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserSharedProfileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userSharedProfileDelete = $this->userSharedProfileDeleteRepository->create($input);
        
                Flash::success('User Shared Profile Delete saved successfully.');
                return redirect(route('userSharedProfileDeletes.index'));
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
            $userSharedProfileDelete = $this->userSharedProfileDeleteRepository->findWithoutFail($id);
    
            if(empty($userSharedProfileDelete))
            {
                Flash::error('User Shared Profile Delete not found');
                return redirect(route('userSharedProfileDeletes.index'));
            }
    
            if($userSharedProfileDelete -> user_id == $user_id)
            {
                return view('user_shared_profile_deletes.show')
                    ->with('userSharedProfileDelete', $userSharedProfileDelete);
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
            $userSharedProfileDelete = $this->userSharedProfileDeleteRepository->findWithoutFail($id);
    
            if(empty($userSharedProfileDelete))
            {
                Flash::error('User Shared Profile Delete not found');
                return redirect(route('userSharedProfileDeletes.index'));
            }
    
            if($userSharedProfileDelete -> user_id == $user_id)
            {
                return view('user_shared_profile_deletes.edit')
                    ->with('userSharedProfileDelete', $userSharedProfileDelete);
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

    public function update($id, UpdateUserSharedProfileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userSharedProfileDelete = $this->userSharedProfileDeleteRepository->findWithoutFail($id);
    
            if(empty($userSharedProfileDelete))
            {
                Flash::error('User Shared Profile Delete not found');
                return redirect(route('userSharedProfileDeletes.index'));
            }
    
            if($userSharedProfileDelete -> user_id == $user_id)
            {
                $userSharedProfileDelete = $this->userSharedProfileDeleteRepository->update($request->all(), $id);
    
                Flash::success('User Shared Profile Delete updated successfully.');
                return redirect(route('userSharedProfileDeletes.index'));
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
            $userSharedProfileDelete = $this->userSharedProfileDeleteRepository->findWithoutFail($id);
    
            if(empty($userSharedProfileDelete))
            {
                Flash::error('User Shared Profile Delete not found');
                return redirect(route('userSharedProfileDeletes.index'));
            }
    
            if($userSharedProfileDelete -> user_id == $user_id)
            {
                $this->userSharedProfileDeleteRepository->delete($id);
    
                Flash::success('User Shared Profile Delete deleted successfully.');
                return redirect(route('userSharedProfileDeletes.index'));
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