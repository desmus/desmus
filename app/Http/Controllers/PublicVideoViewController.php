<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicVideoViewRequest;
use App\Http\Requests\UpdatePublicVideoViewRequest;
use App\Repositories\PublicVideoViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicVideoViewController extends AppBaseController
{
    private $publicVideoViewRepository;

    public function __construct(PublicVideoViewRepository $publicVideoViewRepo)
    {
        $this->publicVideoViewRepository = $publicVideoViewRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicVideoViewRepository->pushCriteria(new RequestCriteria($request));
            $publicVideoViews = $this->publicVideoViewRepository->all();
    
            return view('public_video_views.index')
                ->with('publicVideoViews', $publicVideoViews);
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
            return view('public_video_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicVideoViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicVideoView = $this->publicVideoViewRepository->create($input);
                
                Flash::success('Public Video View saved successfully.');
                return redirect(route('publicVideoViews.index'));
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
            $publicVideoView = $this->publicVideoViewRepository->findWithoutFail($id);
    
            if(empty($publicVideoView))
            {
                Flash::error('Public Video View not found');
                return redirect(route('publicVideoViews.index'));
            }
            
            if($user_id == $publicVideoView -> user_id)
            {
                return view('public_video_views.show')->with('publicVideoView', $publicVideoView);
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
            $publicVideoView = $this->publicVideoViewRepository->findWithoutFail($id);
    
            if(empty($publicVideoView))
            {
                Flash::error('Public Video View not found');
                return redirect(route('publicVideoViews.index'));
            }
            
            if($user_id == $publicVideoView -> user_id)
            {
                return view('public_video_views.edit')->with('publicVideoView', $publicVideoView);
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

    public function update($id, UpdatePublicVideoViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicVideoView = $this->publicVideoViewRepository->findWithoutFail($id);
    
            if(empty($publicVideoView))
            {
                Flash::error('Public Video View not found');
                return redirect(route('publicVideoViews.index'));
            }
    
            if($user_id == $publicVideoView -> user_id)
            {
                $publicVideoView = $this->publicVideoViewRepository->update($request->all(), $id);
                
                Flash::success('Public Video View updated successfully.');
                return redirect(route('publicVideoViews.index'));
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
            $publicVideoView = $this->publicVideoViewRepository->findWithoutFail($id);
    
            if(empty($publicVideoView))
            {
                Flash::error('Public Video View not found');
                return redirect(route('publicVideoViews.index'));
            }
    
            if($user_id == $publicVideoView -> user_id)
            {
                $this->publicVideoViewRepository->delete($id);
                
                Flash::success('Public Video View deleted successfully.');
                return redirect(route('publicVideoViews.index'));
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