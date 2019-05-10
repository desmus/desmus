<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicAdvertisementUpdateRequest;
use App\Http\Requests\UpdatePublicAdvertisementUpdateRequest;
use App\Repositories\PublicAdvertisementUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAdvertisementUpdateController extends AppBaseController
{
    private $publicAdvertisementUpdateRepository;

    public function __construct(PublicAdvertisementUpdateRepository $publicAdvertisementUpdateRepo)
    {
        $this->publicAdvertisementUpdateRepository = $publicAdvertisementUpdateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAdvertisementUpdateRepository->pushCriteria(new RequestCriteria($request));
            $publicAdvertisementUpdates = $this->publicAdvertisementUpdateRepository->all();
    
            return update('public_advertisement_updates.index')
                ->with('publicAdvertisementUpdates', $publicAdvertisementUpdates);
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
            return update('public_advertisement_updates.create');
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function store(CreatePublicAdvertisementUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicAdvertisementUpdate = $this->publicAdvertisementUpdateRepository->create($input);
                
                Flash::success('Public Advertisement Update saved successfully.');
                return redirect(route('publicAdvertisementUpdates.index'));
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
            $publicAdvertisementUpdate = $this->publicAdvertisementUpdateRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementUpdate))
            {
                Flash::error('Public Advertisement Update not found');
                return redirect(route('publicAdvertisementUpdates.index'));
            }
            
            if($user_id == $publicAdvertisementUpdate -> user_id)
            {
                return update('public_advertisement_updates.show')->with('publicAdvertisementUpdate', $publicAdvertisementUpdate);
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
            $publicAdvertisementUpdate = $this->publicAdvertisementUpdateRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementUpdate))
            {
                Flash::error('Public Advertisement Update not found');
                return redirect(route('publicAdvertisementUpdates.index'));
            }
            
            if($user_id == $publicAdvertisementUpdate -> user_id)
            {
                return update('public_advertisement_updates.edit')->with('publicAdvertisementUpdate', $publicAdvertisementUpdate);
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

    public function update($id, UpdatePublicAdvertisementUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicAdvertisementUpdate = $this->publicAdvertisementUpdateRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementUpdate))
            {
                Flash::error('Public Advertisement Update not found');
                return redirect(route('publicAdvertisementUpdates.index'));
            }
    
            if($user_id == $publicAdvertisementUpdate -> user_id)
            {
                $publicAdvertisementUpdate = $this->publicAdvertisementUpdateRepository->update($request->all(), $id);
                
                Flash::success('Public Advertisement Update updated successfully.');
                return redirect(route('publicAdvertisementUpdates.index'));
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
            $publicAdvertisementUpdate = $this->publicAdvertisementUpdateRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementUpdate))
            {
                Flash::error('Public Advertisement Update not found');
                return redirect(route('publicAdvertisementUpdates.index'));
            }
    
            if($user_id == $publicAdvertisementUpdate -> user_id)
            {
                $this->publicAdvertisementUpdateRepository->delete($id);
            
                Flash::success('Public Advertisement Update deleted successfully.');
                return redirect(route('publicAdvertisementUpdates.index'));
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