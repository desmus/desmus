<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileNoteUpdateRequest;
use App\Http\Requests\UpdateSharedProfileNoteUpdateRequest;
use App\Repositories\SharedProfileNoteUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileNoteUpdateController extends AppBaseController
{
    /** @var  SharedProfileNoteUpdateRepository */
    private $sharedProfileNoteUpdateRepository;

    public function __construct(SharedProfileNoteUpdateRepository $sharedProfileNoteUpdateRepo)
    {
        $this->sharedProfileNoteUpdateRepository = $sharedProfileNoteUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileNoteUpdateRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileNoteUpdates = $this->sharedProfileNoteUpdateRepository->all();
    
            return update('shared_profile_note_updates.index')
                ->with('sharedProfileNoteUpdates', $sharedProfileNoteUpdates);
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
            return update('shared_profile_note_updates.create');
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function store(CreateSharedProfileNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $sharedProfileNoteUpdate = $this->sharedProfileNoteUpdateRepository->create($input);
                
                Flash::success('Shared Profile Note Update saved successfully.');
                return redirect(route('sharedProfileNoteUpdates.index'));
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
            $sharedProfileNoteUpdate = $this->sharedProfileNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteUpdate))
            {
                Flash::error('Shared Profile Note Update not found');
                return redirect(route('sharedProfileNoteUpdates.index'));
            }
            
            if($user_id == $sharedProfileNoteUpdate -> user_id)
            {
                return update('shared_profile_note_updates.show')->with('sharedProfileNoteUpdate', $sharedProfileNoteUpdate);
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
            $sharedProfileNoteUpdate = $this->sharedProfileNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteUpdate))
            {
                Flash::error('Shared Profile Note Update not found');
                return redirect(route('sharedProfileNoteUpdates.index'));
            }
            
            if($user_id == $sharedProfileNoteUpdate -> user_id)
            {
                return update('shared_profile_note_updates.edit')->with('sharedProfileNoteUpdate', $sharedProfileNoteUpdate);
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

    public function update($id, UpdateSharedProfileNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileNoteUpdate = $this->sharedProfileNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteUpdate))
            {
                Flash::error('Shared Profile Note Update not found');
                return redirect(route('sharedProfileNoteUpdates.index'));
            }
    
            if($user_id == $sharedProfileNoteUpdate -> user_id)
            {
                $sharedProfileNoteUpdate = $this->sharedProfileNoteUpdateRepository->update($request->all(), $id);
                
                Flash::success('Shared Profile Note Update updated successfully.');
                return redirect(route('sharedProfileNoteUpdates.index'));
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
            $sharedProfileNoteUpdate = $this->sharedProfileNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteUpdate))
            {
                Flash::error('Shared Profile Note Update not found');
                return redirect(route('sharedProfileNoteUpdates.index'));
            }
    
            if($user_id == $sharedProfileNoteUpdate -> user_id)
            {
                $this->sharedProfileNoteUpdateRepository->delete($id);
                
                Flash::success('Shared Profile Note Update deleted successfully.');
                return redirect(route('sharedProfileNoteUpdates.index'));
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