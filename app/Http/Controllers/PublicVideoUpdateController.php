<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicVideoUpdateRequest;
use App\Http\Requests\UpdatePublicVideoUpdateRequest;
use App\Repositories\PublicVideoUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicVideoUpdateController extends AppBaseController
{
    private $publicVideoUpdateRepository;

    public function __construct(PublicVideoUpdateRepository $publicVideoUpdateRepo)
    {
        $this->publicVideoUpdateRepository = $publicVideoUpdateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicVideoUpdateRepository->pushCriteria(new RequestCriteria($request));
            $publicVideoUpdates = $this->publicVideoUpdateRepository->all();
    
            return update('public_video_updates.index')
                ->with('publicVideoUpdates', $publicVideoUpdates);
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
            return update('public_video_updates.create');
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function store(CreatePublicVideoUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicVideoUpdate = $this->publicVideoUpdateRepository->create($input);
                
                Flash::success('Public Video Update saved successfully.');
                return redirect(route('publicVideoUpdates.index'));
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
            $publicVideoUpdate = $this->publicVideoUpdateRepository->findWithoutFail($id);
    
            if(empty($publicVideoUpdate))
            {
                Flash::error('Public Video Update not found');
                return redirect(route('publicVideoUpdates.index'));
            }
            
            if($user_id == $publicVideoUpdate -> user_id)
            {
                return update('public_video_updates.show')->with('publicVideoUpdate', $publicVideoUpdate);
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
            $publicVideoUpdate = $this->publicVideoUpdateRepository->findWithoutFail($id);
    
            if(empty($publicVideoUpdate))
            {
                Flash::error('Public Video Update not found');
                return redirect(route('publicVideoUpdates.index'));
            }
            
            if($user_id == $publicVideoUpdate -> user_id)
            {
                return update('public_video_updates.edit')->with('publicVideoUpdate', $publicVideoUpdate);
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

    public function update($id, UpdatePublicVideoUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicVideoUpdate = $this->publicVideoUpdateRepository->findWithoutFail($id);
    
            if(empty($publicVideoUpdate))
            {
                Flash::error('Public Video Update not found');
                return redirect(route('publicVideoUpdates.index'));
            }
    
            if($user_id == $publicVideoUpdate -> user_id)
            {
                $publicVideoUpdate = $this->publicVideoUpdateRepository->update($request->all(), $id);
                
                Flash::success('Public Video Update updated successfully.');
                return redirect(route('publicVideoUpdates.index'));
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
            $publicVideoUpdate = $this->publicVideoUpdateRepository->findWithoutFail($id);
    
            if(empty($publicVideoUpdate))
            {
                Flash::error('Public Video Update not found');
                return redirect(route('publicVideoUpdates.index'));
            }
    
            if($user_id == $publicVideoUpdate -> user_id)
            {
                $this->publicVideoUpdateRepository->delete($id);
                
                Flash::success('Public Video Update deleted successfully.');
                return redirect(route('publicVideoUpdates.index'));
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