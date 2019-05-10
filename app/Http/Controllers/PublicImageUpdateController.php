<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicImageUpdateRequest;
use App\Http\Requests\UpdatePublicImageUpdateRequest;
use App\Repositories\PublicImageUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicImageUpdateController extends AppBaseController
{
    private $publicImageUpdateRepository;

    public function __construct(PublicImageUpdateRepository $publicImageUpdateRepo)
    {
        $this->publicImageUpdateRepository = $publicImageUpdateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicImageUpdateRepository->pushCriteria(new RequestCriteria($request));
            $publicImageUpdates = $this->publicImageUpdateRepository->all();
    
            return update('public_image_updates.index')
                ->with('publicImageUpdates', $publicImageUpdates);
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
            return update('public_image_updates.create');
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function store(CreatePublicImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicImageUpdate = $this->publicImageUpdateRepository->create($input);
                
                Flash::success('Public Image Update saved successfully.');
                return redirect(route('publicImageUpdates.index'));
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
            $publicImageUpdate = $this->publicImageUpdateRepository->findWithoutFail($id);
    
            if(empty($publicImageUpdate))
            {
                Flash::error('Public Image Update not found');
                return redirect(route('publicImageUpdates.index'));
            }
            
            if($user_id == $publicImageUpdate -> user_id)
            {
                return update('public_image_updates.show')->with('publicImageUpdate', $publicImageUpdate);
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
            $publicImageUpdate = $this->publicImageUpdateRepository->findWithoutFail($id);
    
            if(empty($publicImageUpdate))
            {
                Flash::error('Public Image Update not found');
                return redirect(route('publicImageUpdates.index'));
            }
            
            if($user_id == $publicImageUpdate -> user_id)
            {
                return update('public_image_updates.edit')->with('publicImageUpdate', $publicImageUpdate);
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

    public function update($id, UpdatePublicImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicImageUpdate = $this->publicImageUpdateRepository->findWithoutFail($id);
    
            if(empty($publicImageUpdate))
            {
                Flash::error('Public Image Update not found');
                return redirect(route('publicImageUpdates.index'));
            }
    
            if($user_id == $publicImageUpdate -> user_id)
            {
                $publicImageUpdate = $this->publicImageUpdateRepository->update($request->all(), $id);
                
                Flash::success('Public Image Update updated successfully.');
                return redirect(route('publicImageUpdates.index'));
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
            $publicImageUpdate = $this->publicImageUpdateRepository->findWithoutFail($id);
    
            if(empty($publicImageUpdate))
            {
                Flash::error('Public Image Update not found');
                return redirect(route('publicImageUpdates.index'));
            }
    
            if($user_id == $publicImageUpdate -> user_id)
            {
                $this->publicImageUpdateRepository->delete($id);
                
                Flash::success('Public Image Update deleted successfully.');
                return redirect(route('publicImageUpdates.index'));
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