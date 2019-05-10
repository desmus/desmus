<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileVideoViewRequest;
use App\Http\Requests\UpdateSharedProfileVideoViewRequest;
use App\Repositories\SharedProfileVideoViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileVideoViewController extends AppBaseController
{
    /** @var  SharedProfileVideoViewRepository */
    private $sharedProfileVideoViewRepository;

    public function __construct(SharedProfileVideoViewRepository $sharedProfileVideoViewRepo)
    {
        $this->sharedProfileVideoViewRepository = $sharedProfileVideoViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileVideoViewRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileVideoViews = $this->sharedProfileVideoViewRepository->all();
    
            return view('shared_profile_video_views.index')
                ->with('sharedProfileVideoViews', $sharedProfileVideoViews);
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
            return view('shared_profile_video_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileVideoViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $sharedProfileVideoView = $this->sharedProfileVideoViewRepository->create($input);
                
                Flash::success('Shared Profile Video View saved successfully.');
                return redirect(route('sharedProfileVideoViews.index'));
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
            $sharedProfileVideoView = $this->sharedProfileVideoViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoView))
            {
                Flash::error('Shared Profile Video View not found');
                return redirect(route('sharedProfileVideoViews.index'));
            }
            
            if($user_id == $sharedProfileVideoView -> user_id)
            {
                return view('shared_profile_video_views.show')->with('sharedProfileVideoView', $sharedProfileVideoView);
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
            $sharedProfileVideoView = $this->sharedProfileVideoViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoView))
            {
                Flash::error('Shared Profile Video View not found');
                return redirect(route('sharedProfileVideoViews.index'));
            }
            
            if($user_id == $sharedProfileVideoView -> user_id)
            {
                return view('shared_profile_video_views.edit')->with('sharedProfileVideoView', $sharedProfileVideoView);
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

    public function update($id, UpdateSharedProfileVideoViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileVideoView = $this->sharedProfileVideoViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoView))
            {
                Flash::error('Shared Profile Video View not found');
                return redirect(route('sharedProfileVideoViews.index'));
            }
    
            if($user_id == $sharedProfileVideoView -> user_id)
            {
                $sharedProfileVideoView = $this->sharedProfileVideoViewRepository->update($request->all(), $id);
                
                Flash::success('Shared Profile Video View updated successfully.');
                return redirect(route('sharedProfileVideoViews.index'));
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
            $sharedProfileVideoView = $this->sharedProfileVideoViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoView))
            {
                Flash::error('Shared Profile Video View not found');
                return redirect(route('sharedProfileVideoViews.index'));
            }
    
            if($user_id == $sharedProfileVideoView -> user_id)
            {
                $this->sharedProfileVideoViewRepository->delete($id);
                
                Flash::success('Shared Profile Video View deleted successfully.');
                return redirect(route('sharedProfileVideoViews.index'));
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