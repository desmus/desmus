<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileVideoUpdateRequest;
use App\Http\Requests\UpdateSharedProfileVideoUpdateRequest;
use App\Repositories\SharedProfileVideoUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileVideoUpdateController extends AppBaseController
{
    /** @var  SharedProfileVideoUpdateRepository */
    private $sharedProfileVideoUpdateRepository;

    public function __construct(SharedProfileVideoUpdateRepository $sharedProfileVideoUpdateRepo)
    {
        $this->sharedProfileVideoUpdateRepository = $sharedProfileVideoUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileVideoUpdateRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileVideoUpdates = $this->sharedProfileVideoUpdateRepository->all();
    
            return update('shared_profile_video_updates.index')
                ->with('sharedProfileVideoUpdates', $sharedProfileVideoUpdates);
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
            return update('shared_profile_video_updates.create');
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function store(CreateSharedProfileVideoUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $sharedProfileVideoUpdate = $this->sharedProfileVideoUpdateRepository->create($input);
                
                Flash::success('Shared Profile Video Update saved successfully.');
                return redirect(route('sharedProfileVideoUpdates.index'));
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
            $sharedProfileVideoUpdate = $this->sharedProfileVideoUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoUpdate))
            {
                Flash::error('Shared Profile Video Update not found');
                return redirect(route('sharedProfileVideoUpdates.index'));
            }
            
            if($user_id == $sharedProfileVideoUpdate -> user_id)
            {
                return update('shared_profile_video_updates.show')->with('sharedProfileVideoUpdate', $sharedProfileVideoUpdate);
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
            $sharedProfileVideoUpdate = $this->sharedProfileVideoUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoUpdate))
            {
                Flash::error('Shared Profile Video Update not found');
                return redirect(route('sharedProfileVideoUpdates.index'));
            }
            
            if($user_id == $sharedProfileVideoUpdate -> user_id)
            {
                return update('shared_profile_video_updates.edit')->with('sharedProfileVideoUpdate', $sharedProfileVideoUpdate);
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

    public function update($id, UpdateSharedProfileVideoUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileVideoUpdate = $this->sharedProfileVideoUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoUpdate))
            {
                Flash::error('Shared Profile Video Update not found');
                return redirect(route('sharedProfileVideoUpdates.index'));
            }
    
            if($user_id == $sharedProfileVideoUpdate -> user_id)
            {
                $sharedProfileVideoUpdate = $this->sharedProfileVideoUpdateRepository->update($request->all(), $id);
                
                Flash::success('Shared Profile Video Update updated successfully.');
                return redirect(route('sharedProfileVideoUpdates.index'));
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
            $sharedProfileVideoUpdate = $this->sharedProfileVideoUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoUpdate))
            {
                Flash::error('Shared Profile Video Update not found');
                return redirect(route('sharedProfileVideoUpdates.index'));
            }
    
            if($user_id == $sharedProfileVideoUpdate -> user_id)
            {
                $this->sharedProfileVideoUpdateRepository->delete($id);
                
                Flash::success('Shared Profile Video Update deleted successfully.');
                return redirect(route('sharedProfileVideoUpdates.index'));
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