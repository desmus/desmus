<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileFileUpdateRequest;
use App\Http\Requests\UpdateSharedProfileFileUpdateRequest;
use App\Repositories\SharedProfileFileUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileFileUpdateController extends AppBaseController
{
    /** @var  SharedProfileFileUpdateRepository */
    private $sharedProfileFileUpdateRepository;

    public function __construct(SharedProfileFileUpdateRepository $sharedProfileFileUpdateRepo)
    {
        $this->sharedProfileFileUpdateRepository = $sharedProfileFileUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileFileUpdateRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileFileUpdates = $this->sharedProfileFileUpdateRepository->all();
    
            return update('shared_profile_file_updates.index')
                ->with('sharedProfileFileUpdates', $sharedProfileFileUpdates);
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
            return update('shared_profile_file_updates.create');
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function store(CreateSharedProfileFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $sharedProfileFileUpdate = $this->sharedProfileFileUpdateRepository->create($input);
                
                Flash::success('Shared Profile File Update saved successfully.');
                return redirect(route('sharedProfileFileUpdates.index'));
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
            $sharedProfileFileUpdate = $this->sharedProfileFileUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileUpdate))
            {
                Flash::error('Shared Profile File Update not found');
                return redirect(route('sharedProfileFileUpdates.index'));
            }
            
            if($user_id == $sharedProfileFileUpdate -> user_id)
            {
                return update('shared_profile_file_updates.show')->with('sharedProfileFileUpdate', $sharedProfileFileUpdate);
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
            $sharedProfileFileUpdate = $this->sharedProfileFileUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileUpdate))
            {
                Flash::error('Shared Profile File Update not found');
                return redirect(route('sharedProfileFileUpdates.index'));
            }
            
            if($user_id == $sharedProfileFileUpdate -> user_id)
            {
                return update('shared_profile_file_updates.edit')->with('sharedProfileFileUpdate', $sharedProfileFileUpdate);
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

    public function update($id, UpdateSharedProfileFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileFileUpdate = $this->sharedProfileFileUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileUpdate))
            {
                Flash::error('Shared Profile File Update not found');
                return redirect(route('sharedProfileFileUpdates.index'));
            }
    
            if($user_id == $sharedProfileFileUpdate -> user_id)
            {
                $sharedProfileFileUpdate = $this->sharedProfileFileUpdateRepository->update($request->all(), $id);
                
                Flash::success('Shared Profile File Update updated successfully.');
                return redirect(route('sharedProfileFileUpdates.index'));
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
            $sharedProfileFileUpdate = $this->sharedProfileFileUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileUpdate))
            {
                Flash::error('Shared Profile File Update not found');
                return redirect(route('sharedProfileFileUpdates.index'));
            }
    
            if($user_id == $sharedProfileFileUpdate -> user_id)
            {
                $this->sharedProfileFileUpdateRepository->delete($id);
                
                Flash::success('Shared Profile File Update deleted successfully.');
                return redirect(route('sharedProfileFileUpdates.index'));
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