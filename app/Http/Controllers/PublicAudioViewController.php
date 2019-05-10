<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicAudioViewRequest;
use App\Http\Requests\UpdatePublicAudioViewRequest;
use App\Repositories\PublicAudioViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAudioViewController extends AppBaseController
{
    private $publicAudioViewRepository;

    public function __construct(PublicAudioViewRepository $publicAudioViewRepo)
    {
        $this->publicAudioViewRepository = $publicAudioViewRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAudioViewRepository->pushCriteria(new RequestCriteria($request));
            $publicAudioViews = $this->publicAudioViewRepository->all();
    
            return view('public_audio_views.index')
                ->with('publicAudioViews', $publicAudioViews);
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
            return view('public_audio_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicAudioView = $this->publicAudioViewRepository->create($input);
                
                Flash::success('Public Audio View saved successfully.');
                return redirect(route('publicAudioViews.index'));
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
            $publicAudioView = $this->publicAudioViewRepository->findWithoutFail($id);
    
            if(empty($publicAudioView))
            {
                Flash::error('Public Audio View not found');
                return redirect(route('publicAudioViews.index'));
            }
            
            if($user_id == $publicAudioView -> user_id)
            {
                return view('public_audio_views.show')->with('publicAudioView', $publicAudioView);
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
            $publicAudioView = $this->publicAudioViewRepository->findWithoutFail($id);
    
            if(empty($publicAudioView))
            {
                Flash::error('Public Audio View not found');
                return redirect(route('publicAudioViews.index'));
            }
            
            if($user_id == $publicAudioView -> user_id)
            {
                return view('public_audio_views.edit')->with('publicAudioView', $publicAudioView);
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

    public function update($id, UpdatePublicAudioViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicAudioView = $this->publicAudioViewRepository->findWithoutFail($id);
    
            if(empty($publicAudioView))
            {
                Flash::error('Public Audio View not found');
                return redirect(route('publicAudioViews.index'));
            }
    
            if($user_id == $publicAudioView -> user_id)
            {
                $publicAudioView = $this->publicAudioViewRepository->update($request->all(), $id);
                
                Flash::success('Public Audio View updated successfully.');
                return redirect(route('publicAudioViews.index'));
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
            $publicAudioView = $this->publicAudioViewRepository->findWithoutFail($id);
    
            if(empty($publicAudioView))
            {
                Flash::error('Public Audio View not found');
                return redirect(route('publicAudioViews.index'));
            }
    
            if($user_id == $publicAudioView -> user_id)
            {
                $this->publicAudioViewRepository->delete($id);
                
                Flash::success('Public Audio View deleted successfully.');
                return redirect(route('publicAudioViews.index'));
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