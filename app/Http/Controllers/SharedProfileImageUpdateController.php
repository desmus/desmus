<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileImageUpdateRequest;
use App\Http\Requests\UpdateSharedProfileImageUpdateRequest;
use App\Repositories\SharedProfileImageUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileImageUpdateController extends AppBaseController
{
    /** @var  SharedProfileImageUpdateRepository */
    private $sharedProfileImageUpdateRepository;

    public function __construct(SharedProfileImageUpdateRepository $sharedProfileImageUpdateRepo)
    {
        $this->sharedProfileImageUpdateRepository = $sharedProfileImageUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileImageUpdateRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileImageUpdates = $this->sharedProfileImageUpdateRepository->all();
    
            return update('shared_profile_image_updates.index')
                ->with('sharedProfileImageUpdates', $sharedProfileImageUpdates);
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function create()
    {
        if(Auth::user() != null)
        {
            return update('shared_profile_image_updates.create');
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function store(CreateSharedProfileImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $sharedProfileImageUpdate = $this->sharedProfileImageUpdateRepository->create($input);
                
                Flash::success('Shared Profile Image Update saved successfully.');
                return redirect(route('sharedProfileImageUpdates.index'));
            }
            
            else
            {
                return update('deniedAccess');
            }
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileImageUpdate = $this->sharedProfileImageUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageUpdate))
            {
                Flash::error('Shared Profile Image Update not found');
                return redirect(route('sharedProfileImageUpdates.index'));
            }
            
            if($user_id == $sharedProfileImageUpdate -> user_id)
            {
                return update('shared_profile_image_updates.show')->with('sharedProfileImageUpdate', $sharedProfileImageUpdate);
            }
            
            else
            {
                return update('deniedAccess');
            }
        }
    
        else
        {
            return update('deniedAccess');
        }   
    }

    public function edit($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileImageUpdate = $this->sharedProfileImageUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageUpdate))
            {
                Flash::error('Shared Profile Image Update not found');
                return redirect(route('sharedProfileImageUpdates.index'));
            }
            
            if($user_id == $sharedProfileImageUpdate -> user_id)
            {
                return update('shared_profile_image_updates.edit')->with('sharedProfileImageUpdate', $sharedProfileImageUpdate);
            }
            
            else
            {
                return update('deniedAccess');
            }
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function update($id, UpdateSharedProfileImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileImageUpdate = $this->sharedProfileImageUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageUpdate))
            {
                Flash::error('Shared Profile Image Update not found');
                return redirect(route('sharedProfileImageUpdates.index'));
            }
    
            if($user_id == $sharedProfileImageUpdate -> user_id)
            {
                $sharedProfileImageUpdate = $this->sharedProfileImageUpdateRepository->update($request->all(), $id);
                
                Flash::success('Shared Profile Image Update updated successfully.');
                return redirect(route('sharedProfileImageUpdates.index'));
            }
            
            else
            {
                return update('deniedAccess');
            }
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function destroy($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileImageUpdate = $this->sharedProfileImageUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageUpdate))
            {
                Flash::error('Shared Profile Image Update not found');
                return redirect(route('sharedProfileImageUpdates.index'));
            }
    
            if($user_id == $sharedProfileImageUpdate -> user_id)
            {
                $this->sharedProfileImageUpdateRepository->delete($id);
                
                Flash::success('Shared Profile Image Update deleted successfully.');
                return redirect(route('sharedProfileImageUpdates.index'));
            }
            
            else
            {
                return update('deniedAccess');
            }
        }
        
        else
        {
            return update('deniedAccess');
        }
    }
}