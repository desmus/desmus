<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileImageViewRequest;
use App\Http\Requests\UpdateSharedProfileImageViewRequest;
use App\Repositories\SharedProfileImageViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileImageViewController extends AppBaseController
{
    /** @var  SharedProfileImageViewRepository */
    private $sharedProfileImageViewRepository;

    public function __construct(SharedProfileImageViewRepository $sharedProfileImageViewRepo)
    {
        $this->sharedProfileImageViewRepository = $sharedProfileImageViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileImageViewRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileImageViews = $this->sharedProfileImageViewRepository->all();
    
            return view('shared_profile_image_views.index')
                ->with('sharedProfileImageViews', $sharedProfileImageViews);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        if(Auth::user() != null)
        {
            return view('shared_profile_image_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $sharedProfileImageView = $this->sharedProfileImageViewRepository->create($input);
                
                Flash::success('Shared Profile Image View saved successfully.');
                return redirect(route('sharedProfileImageViews.index'));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileImageView = $this->sharedProfileImageViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageView))
            {
                Flash::error('Shared Profile Image View not found');
                return redirect(route('sharedProfileImageViews.index'));
            }
            
            if($user_id == $sharedProfileImageView -> user_id)
            {
                return view('shared_profile_image_views.show')->with('sharedProfileImageView', $sharedProfileImageView);
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
    
        else
        {
            return view('deniedAccess');
        }   
    }

    public function edit($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileImageView = $this->sharedProfileImageViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageView))
            {
                Flash::error('Shared Profile Image View not found');
                return redirect(route('sharedProfileImageViews.index'));
            }
            
            if($user_id == $sharedProfileImageView -> user_id)
            {
                return view('shared_profile_image_views.edit')->with('sharedProfileImageView', $sharedProfileImageView);
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateSharedProfileImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileImageView = $this->sharedProfileImageViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageView))
            {
                Flash::error('Shared Profile Image View not found');
                return redirect(route('sharedProfileImageViews.index'));
            }
    
            if($user_id == $sharedProfileImageView -> user_id)
            {
                $sharedProfileImageView = $this->sharedProfileImageViewRepository->update($request->all(), $id);
                
                Flash::success('Shared Profile Image View updated successfully.');
                return redirect(route('sharedProfileImageViews.index'));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileImageView = $this->sharedProfileImageViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageView))
            {
                Flash::error('Shared Profile Image View not found');
                return redirect(route('sharedProfileImageViews.index'));
            }
    
            if($user_id == $sharedProfileImageView -> user_id)
            {
                $this->sharedProfileImageViewRepository->delete($id);
                
                Flash::success('Shared Profile Image View deleted successfully.');
                return redirect(route('sharedProfileImageViews.index'));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}