<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicNoteUpdateRequest;
use App\Http\Requests\UpdatePublicNoteUpdateRequest;
use App\Repositories\PublicNoteUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicNoteUpdateController extends AppBaseController
{
    private $publicNoteUpdateRepository;

    public function __construct(PublicNoteUpdateRepository $publicNoteUpdateRepo)
    {
        $this->publicNoteUpdateRepository = $publicNoteUpdateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicNoteUpdateRepository->pushCriteria(new RequestCriteria($request));
            $publicNoteUpdates = $this->publicNoteUpdateRepository->all();
    
            return update('public_note_updates.index')
                ->with('publicNoteUpdates', $publicNoteUpdates);
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
            return update('public_note_updates.create');
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function store(CreatePublicNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicNoteUpdate = $this->publicNoteUpdateRepository->create($input);
                
                Flash::success('Public Note Update saved successfully.');
                return redirect(route('publicNoteUpdates.index'));
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
            $publicNoteUpdate = $this->publicNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($publicNoteUpdate))
            {
                Flash::error('Public Note Update not found');
                return redirect(route('publicNoteUpdates.index'));
            }
            
            if($user_id == $publicNoteUpdate -> user_id)
            {
                return update('public_note_updates.show')->with('publicNoteUpdate', $publicNoteUpdate);
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
            $publicNoteUpdate = $this->publicNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($publicNoteUpdate))
            {
                Flash::error('Public Note Update not found');
                return redirect(route('publicNoteUpdates.index'));
            }
            
            if($user_id == $publicNoteUpdate -> user_id)
            {
                return update('public_note_updates.edit')->with('publicNoteUpdate', $publicNoteUpdate);
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

    public function update($id, UpdatePublicNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicNoteUpdate = $this->publicNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($publicNoteUpdate))
            {
                Flash::error('Public Note Update not found');
                return redirect(route('publicNoteUpdates.index'));
            }
    
            if($user_id == $publicNoteUpdate -> user_id)
            {
                $publicNoteUpdate = $this->publicNoteUpdateRepository->update($request->all(), $id);
                
                Flash::success('Public Note Update updated successfully.');
                return redirect(route('publicNoteUpdates.index'));
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
            $publicNoteUpdate = $this->publicNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($publicNoteUpdate))
            {
                Flash::error('Public Note Update not found');
                return redirect(route('publicNoteUpdates.index'));
            }
    
            if($user_id == $publicNoteUpdate -> user_id)
            {
                $this->publicNoteUpdateRepository->delete($id);
                
                Flash::success('Public Note Update deleted successfully.');
                return redirect(route('publicNoteUpdates.index'));
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