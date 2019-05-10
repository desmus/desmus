<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactWebViewRequest;
use App\Http\Requests\UpdateContactWebViewRequest;
use App\Repositories\ContactWebViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactWebViewController extends AppBaseController
{
    private $contactWebViewRepository;

    public function __construct(ContactWebViewRepository $contactWebViewRepo)
    {
        $this->contactWebViewRepository = $contactWebViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactWebViewRepository->pushCriteria(new RequestCriteria($request));
            $contactWebViews = $this->contactWebViewRepository->all();
    
            return view('contact_web_views.index')
                ->with('contactWebViews', $contactWebViews);
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
            return view('contact_web_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactWebViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactWebView = $this->contactWebViewRepository->create($input);
    
            Flash::success('Contact Web View saved successfully.');
            return redirect(route('contactWebViews.index'));
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
            $contactWebView = $this->contactWebViewRepository->findWithoutFail($id);
    
            if(empty($contactWebView))
            {
                Flash::error('Contact Web View not found');
                return redirect(route('contactWebViews.index'));
            }
    
            return view('contact_web_views.show')
                ->with('contactWebView', $contactWebView);
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
            $contactWebView = $this->contactWebViewRepository->findWithoutFail($id);
    
            if(empty($contactWebView))
            {
                Flash::error('Contact Web View not found');
                return redirect(route('contactWebViews.index'));
            }
    
            return view('contact_web_views.edit')
                ->with('contactWebView', $contactWebView);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateContactWebViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $contactWebView = $this->contactWebViewRepository->findWithoutFail($id);
    
            if(empty($contactWebView))
            {
                Flash::error('Contact Web View not found');
                return redirect(route('contactWebViews.index'));
            }
    
            $contactWebView = $this->contactWebViewRepository->update($request->all(), $id);
    
            Flash::success('Contact Web View updated successfully.');
            return redirect(route('contactWebViews.index'));
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
            $contactWebView = $this->contactWebViewRepository->findWithoutFail($id);
    
            if(empty($contactWebView))
            {
                Flash::error('Contact Web View not found');
                return redirect(route('contactWebViews.index'));
            }
    
            $this->contactWebViewRepository->delete($id);
    
            Flash::success('Contact Web View deleted successfully.');
            return redirect(route('contactWebViews.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}