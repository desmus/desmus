<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileAudioViewRequest;
use App\Http\Requests\UpdateSharedProfileAudioViewRequest;
use App\Repositories\SharedProfileAudioViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileAudioViewController extends AppBaseController
{
    /** @var  SharedProfileAudioViewRepository */
    private $sharedProfileAudioViewRepository;

    public function __construct(SharedProfileAudioViewRepository $sharedProfileAudioViewRepo)
    {
        $this->sharedProfileAudioViewRepository = $sharedProfileAudioViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileAudioViewRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileAudioViews = $this->sharedProfileAudioViewRepository->all();
    
            return view('shared_profile_audio_views.index')
                ->with('sharedProfileAudioViews', $sharedProfileAudioViews);
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
            return view('shared_profile_audio_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $sharedProfileAudioView = $this->sharedProfileAudioViewRepository->create($input);
                
                Flash::success('Shared Profile Audio View saved successfully.');
                return redirect(route('sharedProfileAudioViews.index'));
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
            $sharedProfileAudioView = $this->sharedProfileAudioViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioView))
            {
                Flash::error('Shared Profile Audio View not found');
                return redirect(route('sharedProfileAudioViews.index'));
            }
            
            if($user_id == $sharedProfileAudioView -> user_id)
            {
                return view('shared_profile_audio_views.show')->with('sharedProfileAudioView', $sharedProfileAudioView);
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
            $sharedProfileAudioView = $this->sharedProfileAudioViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioView))
            {
                Flash::error('Shared Profile Audio View not found');
                return redirect(route('sharedProfileAudioViews.index'));
            }
            
            if($user_id == $sharedProfileAudioView -> user_id)
            {
                return view('shared_profile_audio_views.edit')->with('sharedProfileAudioView', $sharedProfileAudioView);
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

    public function update($id, UpdateSharedProfileAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileAudioView = $this->sharedProfileAudioViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioView))
            {
                Flash::error('Shared Profile Audio View not found');
                return redirect(route('sharedProfileAudioViews.index'));
            }
    
            if($user_id == $sharedProfileAudioView -> user_id)
            {
                $sharedProfileAudioView = $this->sharedProfileAudioViewRepository->update($request->all(), $id);
                
                Flash::success('Shared Profile Audio View updated successfully.');
                return redirect(route('sharedProfileAudioViews.index'));
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
            $sharedProfileAudioView = $this->sharedProfileAudioViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioView))
            {
                Flash::error('Shared Profile Audio View not found');
                return redirect(route('sharedProfileAudioViews.index'));
            }
    
            if($user_id == $sharedProfileAudioView -> user_id)
            {
                $this->sharedProfileAudioViewRepository->delete($id);
                
                Flash::success('Shared Profile Audio View deleted successfully.');
                return redirect(route('sharedProfileAudioViews.index'));
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