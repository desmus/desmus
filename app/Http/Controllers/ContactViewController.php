<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactViewRequest;
use App\Http\Requests\UpdateContactViewRequest;
use App\Repositories\ContactViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactViewController extends AppBaseController
{
    private $contactViewRepository;

    public function __construct(ContactViewRepository $contactViewRepo)
    {
        $this->contactViewRepository = $contactViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactViewRepository->pushCriteria(new RequestCriteria($request));
            $contactViews = $this->contactViewRepository->all();
    
            return view('contact_views.index')
                ->with('contactViews', $contactViews);
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
            return view('contact_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactView = $this->contactViewRepository->create($input);
    
            Flash::success('Contact View saved successfully.');
            return redirect(route('contactViews.index'));
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
            $contactView = $this->contactViewRepository->findWithoutFail($id);
    
            if(empty($contactView))
            {
                Flash::error('Contact View not found');
                return redirect(route('contactViews.index'));
            }
    
            $user = DB::table('contact_views')->join('contacts', 'contact_views.contact_id', '=', 'contacts.id')->where('contact_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_views.show')
                    ->with('contactView', $contactView);
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
            $contactView = $this->contactViewRepository->findWithoutFail($id);
    
            if(empty($contactView))
            {
                Flash::error('Contact View not found');
                return redirect(route('contactViews.index'));
            }
    
            $user = DB::table('contact_views')->join('contacts', 'contact_views.contact_id', '=', 'contacts.id')->where('contact_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_views.edit')
                    ->with('contactView', $contactView);
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

    public function update($id, UpdateContactViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactView = $this->contactViewRepository->findWithoutFail($id);
    
            if(empty($contactView))
            {
                Flash::error('Contact View not found');
                return redirect(route('contactViews.index'));
            }
    
            $user = DB::table('contact_views')->join('contacts', 'contact_views.contact_id', '=', 'contacts.id')->where('contact_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactView = $this->contactViewRepository->update($request->all(), $id);
            
                Flash::success('Contact View updated successfully.');
                return redirect(route('contactViews.index'));
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
            $contactView = $this->contactViewRepository->findWithoutFail($id);
    
            if(empty($contactView))
            {
                Flash::error('Contact View not found');
                return redirect(route('contactViews.index'));
            }
    
            $user = DB::table('contact_views')->join('contacts', 'contact_views.contact_id', '=', 'contacts.id')->where('contact_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactViewRepository->delete($id);
            
                Flash::success('Contact View deleted successfully.');
                return redirect(route('contactViews.index'));
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