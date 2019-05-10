<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicFileUpdateRequest;
use App\Http\Requests\UpdatePublicFileUpdateRequest;
use App\Repositories\PublicFileUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicFileUpdateController extends AppBaseController
{
    private $publicFileUpdateRepository;

    public function __construct(PublicFileUpdateRepository $publicFileUpdateRepo)
    {
        $this->publicFileUpdateRepository = $publicFileUpdateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicFileUpdateRepository->pushCriteria(new RequestCriteria($request));
            $publicFileUpdates = $this->publicFileUpdateRepository->all();
    
            return update('public_file_updates.index')
                ->with('publicFileUpdates', $publicFileUpdates);
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
            return update('public_file_updates.create');
        }
        
        else
        {
            return update('deniedAccess');
        }
    }

    public function store(CreatePublicFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicFileUpdate = $this->publicFileUpdateRepository->create($input);
                
                Flash::success('Public File Update saved successfully.');
                return redirect(route('publicFileUpdates.index'));
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
            $publicFileUpdate = $this->publicFileUpdateRepository->findWithoutFail($id);
    
            if(empty($publicFileUpdate))
            {
                Flash::error('Public File Update not found');
                return redirect(route('publicFileUpdates.index'));
            }
            
            if($user_id == $publicFileUpdate -> user_id)
            {
                return update('public_file_updates.show')->with('publicFileUpdate', $publicFileUpdate);
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
            $publicFileUpdate = $this->publicFileUpdateRepository->findWithoutFail($id);
    
            if(empty($publicFileUpdate))
            {
                Flash::error('Public File Update not found');
                return redirect(route('publicFileUpdates.index'));
            }
            
            if($user_id == $publicFileUpdate -> user_id)
            {
                return update('public_file_updates.edit')->with('publicFileUpdate', $publicFileUpdate);
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

    public function update($id, UpdatePublicFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicFileUpdate = $this->publicFileUpdateRepository->findWithoutFail($id);
    
            if(empty($publicFileUpdate))
            {
                Flash::error('Public File Update not found');
                return redirect(route('publicFileUpdates.index'));
            }
    
            if($user_id == $publicFileUpdate -> user_id)
            {
                $publicFileUpdate = $this->publicFileUpdateRepository->update($request->all(), $id);
                
                Flash::success('Public File Update updated successfully.');
                return redirect(route('publicFileUpdates.index'));
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
            $publicFileUpdate = $this->publicFileUpdateRepository->findWithoutFail($id);
    
            if(empty($publicFileUpdate))
            {
                Flash::error('Public File Update not found');
                return redirect(route('publicFileUpdates.index'));
            }
    
            if($user_id == $publicFileUpdate -> user_id)
            {
                $this->publicFileUpdateRepository->delete($id);
                
                Flash::success('Public File Update deleted successfully.');
                return redirect(route('publicFileUpdates.index'));
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