<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicAudioUpdateRequest;
use App\Http\Requests\UpdatePublicAudioUpdateRequest;
use App\Repositories\PublicAudioUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAudioUpdateController extends AppBaseController
{
    private $publicAudioUpdateRepository;

    public function __construct(PublicAudioUpdateRepository $publicAudioUpdateRepo)
    {
        $this->publicAudioUpdateRepository = $publicAudioUpdateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAudioUpdateRepository->pushCriteria(new RequestCriteria($request));
            $publicAudioUpdates = $this->publicAudioUpdateRepository->all();
    
            return update('public_audio_updates.index')
                ->with('publicAudioUpdates', $publicAudioUpdates);
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
            return update('public_audio_updates.create');
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function store(CreatePublicAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicAudioUpdate = $this->publicAudioUpdateRepository->create($input);
                
                Flash::success('Public Audio Update saved successfully.');
                return redirect(route('publicAudioUpdates.index'));
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
            $publicAudioUpdate = $this->publicAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($publicAudioUpdate))
            {
                Flash::error('Public Audio Update not found');
                return redirect(route('publicAudioUpdates.index'));
            }
            
            if($user_id == $publicAudioUpdate -> user_id)
            {
                return update('public_audio_updates.show')->with('publicAudioUpdate', $publicAudioUpdate);
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
            $publicAudioUpdate = $this->publicAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($publicAudioUpdate))
            {
                Flash::error('Public Audio Update not found');
                return redirect(route('publicAudioUpdates.index'));
            }
            
            if($user_id == $publicAudioUpdate -> user_id)
            {
                return update('public_audio_updates.edit')->with('publicAudioUpdate', $publicAudioUpdate);
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

    public function update($id, UpdatePublicAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicAudioUpdate = $this->publicAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($publicAudioUpdate))
            {
                Flash::error('Public Audio Update not found');
                return redirect(route('publicAudioUpdates.index'));
            }
    
            if($user_id == $publicAudioUpdate -> user_id)
            {
                $publicAudioUpdate = $this->publicAudioUpdateRepository->update($request->all(), $id);
                
                Flash::success('Public Audio Update updated successfully.');
                return redirect(route('publicAudioUpdates.index'));
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
            $publicAudioUpdate = $this->publicAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($publicAudioUpdate))
            {
                Flash::error('Public Audio Update not found');
                return redirect(route('publicAudioUpdates.index'));
            }
    
            if($user_id == $publicAudioUpdate -> user_id)
            {
                $this->publicAudioUpdateRepository->delete($id);
                
                Flash::success('Public Audio Update deleted successfully.');
                return redirect(route('publicAudioUpdates.index'));
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