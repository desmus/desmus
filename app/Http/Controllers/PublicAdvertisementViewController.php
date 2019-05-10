<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicAdvertisementViewRequest;
use App\Http\Requests\UpdatePublicAdvertisementViewRequest;
use App\Repositories\PublicAdvertisementViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAdvertisementViewController extends AppBaseController
{
    private $publicAdvertisementViewRepository;

    public function __construct(PublicAdvertisementViewRepository $publicAdvertisementViewRepo)
    {
        $this->publicAdvertisementViewRepository = $publicAdvertisementViewRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAdvertisementViewRepository->pushCriteria(new RequestCriteria($request));
            $publicAdvertisementViews = $this->publicAdvertisementViewRepository->all();
    
            return view('public_advertisement_views.index')
                ->with('publicAdvertisementViews', $publicAdvertisementViews);
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
            return view('public_advertisement_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicAdvertisementViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicAdvertisementView = $this->publicAdvertisementViewRepository->create($input);
                
                Flash::success('Public Advertisement View saved successfully.');
                return redirect(route('publicAdvertisementViews.index'));
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
            $publicAdvertisementView = $this->publicAdvertisementViewRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementView))
            {
                Flash::error('Public Advertisement View not found');
                return redirect(route('publicAdvertisementViews.index'));
            }
            
            if($user_id == $publicAdvertisementView -> user_id)
            {
                return view('public_advertisement_views.show')->with('publicAdvertisementView', $publicAdvertisementView);
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
            $publicAdvertisementView = $this->publicAdvertisementViewRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementView))
            {
                Flash::error('Public Advertisement View not found');
                return redirect(route('publicAdvertisementViews.index'));
            }
            
            if($user_id == $publicAdvertisementView -> user_id)
            {
                return view('public_advertisement_views.edit')->with('publicAdvertisementView', $publicAdvertisementView);
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

    public function update($id, UpdatePublicAdvertisementViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicAdvertisementView = $this->publicAdvertisementViewRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementView))
            {
                Flash::error('Public Advertisement View not found');
                return redirect(route('publicAdvertisementViews.index'));
            }
    
            if($user_id == $publicAdvertisementView -> user_id)
            {
                $publicAdvertisementView = $this->publicAdvertisementViewRepository->update($request->all(), $id);
                
                Flash::success('Public Advertisement View updated successfully.');
                return redirect(route('publicAdvertisementViews.index'));
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
            $publicAdvertisementView = $this->publicAdvertisementViewRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementView))
            {
                Flash::error('Public Advertisement View not found');
                return redirect(route('publicAdvertisementViews.index'));
            }
    
            if($user_id == $publicAdvertisementView -> user_id)
            {
                $this->publicAdvertisementViewRepository->delete($id);
                
                Flash::success('Public Advertisement View deleted successfully.');
                return redirect(route('publicAdvertisementViews.index'));
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