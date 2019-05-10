<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicImageViewRequest;
use App\Http\Requests\UpdatePublicImageViewRequest;
use App\Repositories\PublicImageViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicImageViewController extends AppBaseController
{
    private $publicImageViewRepository;

    public function __construct(PublicImageViewRepository $publicImageViewRepo)
    {
        $this->publicImageViewRepository = $publicImageViewRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicImageViewRepository->pushCriteria(new RequestCriteria($request));
            $publicImageViews = $this->publicImageViewRepository->all();
    
            return view('public_image_views.index')
                ->with('publicImageViews', $publicImageViews);
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
            return view('public_image_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicImageView = $this->publicImageViewRepository->create($input);
                
                Flash::success('Public Image View saved successfully.');
                return redirect(route('publicImageViews.index'));
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
            $publicImageView = $this->publicImageViewRepository->findWithoutFail($id);
    
            if(empty($publicImageView))
            {
                Flash::error('Public Image View not found');
                return redirect(route('publicImageViews.index'));
            }
            
            if($user_id == $publicImageView -> user_id)
            {
                return view('public_image_views.show')->with('publicImageView', $publicImageView);
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
            $publicImageView = $this->publicImageViewRepository->findWithoutFail($id);
    
            if(empty($publicImageView))
            {
                Flash::error('Public Image View not found');
                return redirect(route('publicImageViews.index'));
            }
            
            if($user_id == $publicImageView -> user_id)
            {
                return view('public_image_views.edit')->with('publicImageView', $publicImageView);
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

    public function update($id, UpdatePublicImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicImageView = $this->publicImageViewRepository->findWithoutFail($id);
    
            if(empty($publicImageView))
            {
                Flash::error('Public Image View not found');
                return redirect(route('publicImageViews.index'));
            }
    
            if($user_id == $publicImageView -> user_id)
            {
                $publicImageView = $this->publicImageViewRepository->update($request->all(), $id);
                
                Flash::success('Public Image View updated successfully.');
                return redirect(route('publicImageViews.index'));
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
            $publicImageView = $this->publicImageViewRepository->findWithoutFail($id);
    
            if(empty($publicImageView))
            {
                Flash::error('Public Image View not found');
                return redirect(route('publicImageViews.index'));
            }
    
            if($user_id == $publicImageView -> user_id)
            {
                $this->publicImageViewRepository->delete($id);
                
                Flash::success('Public Image View deleted successfully.');
                return redirect(route('publicImageViews.index'));
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