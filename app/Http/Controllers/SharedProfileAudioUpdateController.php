<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileAudioUpdateRequest;
use App\Http\Requests\UpdateSharedProfileAudioUpdateRequest;
use App\Repositories\SharedProfileAudioUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileAudioUpdateController extends AppBaseController
{
    private $sharedProfileAudioUpdateRepository;

    public function __construct(SharedProfileAudioUpdateRepository $sharedProfileAudioUpdateRepo)
    {
        $this->sharedProfileAudioUpdateRepository = $sharedProfileAudioUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileAudioUpdateRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileAudioUpdates = $this->sharedProfileAudioUpdateRepository->all();
    
            return update('shared_profile_audio_updates.index')
                ->with('sharedProfileAudioUpdates', $sharedProfileAudioUpdates);
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
            return update('shared_profile_audio_updates.create');
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function store(CreateSharedProfileAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $sharedProfileAudioUpdate = $this->sharedProfileAudioUpdateRepository->create($input);
                
                Flash::success('Shared Profile Audio Update saved successfully.');
                return redirect(route('sharedProfileAudioUpdates.index'));
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
            $sharedProfileAudioUpdate = $this->sharedProfileAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioUpdate))
            {
                Flash::error('Shared Profile Audio Update not found');
                return redirect(route('sharedProfileAudioUpdates.index'));
            }
            
            if($user_id == $sharedProfileAudioUpdate -> user_id)
            {
                return update('shared_profile_audio_updates.show')->with('sharedProfileAudioUpdate', $sharedProfileAudioUpdate);
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
            $sharedProfileAudioUpdate = $this->sharedProfileAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioUpdate))
            {
                Flash::error('Shared Profile Audio Update not found');
                return redirect(route('sharedProfileAudioUpdates.index'));
            }
            
            if($user_id == $sharedProfileAudioUpdate -> user_id)
            {
                return update('shared_profile_audio_updates.edit')->with('sharedProfileAudioUpdate', $sharedProfileAudioUpdate);
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

    public function update($id, UpdateSharedProfileAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileAudioUpdate = $this->sharedProfileAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioUpdate))
            {
                Flash::error('Shared Profile Audio Update not found');
                return redirect(route('sharedProfileAudioUpdates.index'));
            }
    
            if($user_id == $sharedProfileAudioUpdate -> user_id)
            {
                $sharedProfileAudioUpdate = $this->sharedProfileAudioUpdateRepository->update($request->all(), $id);
                
                Flash::success('Shared Profile Audio Update updated successfully.');
                return redirect(route('sharedProfileAudioUpdates.index'));
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
            $sharedProfileAudioUpdate = $this->sharedProfileAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioUpdate))
            {
                Flash::error('Shared Profile Audio Update not found');
                return redirect(route('sharedProfileAudioUpdates.index'));
            }
    
            if($user_id == $sharedProfileAudioUpdate -> user_id)
            {
                $this->sharedProfileAudioUpdateRepository->delete($id);
                
                Flash::success('Shared Profile Audio Update deleted successfully.');
                return redirect(route('sharedProfileAudioUpdates.index'));
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