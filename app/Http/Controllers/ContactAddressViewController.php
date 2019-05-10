<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactAddressViewRequest;
use App\Http\Requests\UpdateContactAddressViewRequest;
use App\Repositories\ContactAddressViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactAddressViewController extends AppBaseController
{
    private $contactAddressViewRepository;

    public function __construct(ContactAddressViewRepository $contactAddressViewRepo)
    {
        $this->contactAddressViewRepository = $contactAddressViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactAddressViewRepository->pushCriteria(new RequestCriteria($request));
            $contactAddressViews = $this->contactAddressViewRepository->all();
    
            return view('contact_address_views.index')
                ->with('contactAddressViews', $contactAddressViews);
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
            return view('contact_address_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactAddressViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactAddressView = $this->contactAddressViewRepository->create($input);
    
            Flash::success('Contact Address View saved successfully.');
            return redirect(route('contactAddressViews.index'));
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
            $contactAddressView = $this->contactAddressViewRepository->findWithoutFail($id);
    
            if(empty($contactAddressView))
            {
                Flash::error('Contact Address View not found');
                return redirect(route('contactAddressViews.index'));
            }
            
            $user = DB::table('contact_address_views')->join('contact_addresses', 'contact_address_views.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_address_views.show')
                    ->with('contactAddressView', $contactAddressView);
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
            $contactAddressView = $this->contactAddressViewRepository->findWithoutFail($id);
    
            if(empty($contactAddressView))
            {
                Flash::error('Contact Address View not found');
                return redirect(route('contactAddressViews.index'));
            }
            
            $user = DB::table('contact_address_views')->join('contact_addresses', 'contact_address_views.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_address_views.edit')
                    ->with('contactAddressView', $contactAddressView);
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

    public function update($id, UpdateContactAddressViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactAddressView = $this->contactAddressViewRepository->findWithoutFail($id);
    
            if(empty($contactAddressView))
            {
                Flash::error('Contact Address View not found');
                return redirect(route('contactAddressViews.index'));
            }
            
            $user = DB::table('contact_address_views')->join('contact_addresses', 'contact_address_views.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactAddressView = $this->contactAddressViewRepository->update($request->all(), $id);
            
                Flash::success('Contact Address View updated successfully.');
                return redirect(route('contactAddressViews.index'));
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
            $contactAddressView = $this->contactAddressViewRepository->findWithoutFail($id);
    
            if(empty($contactAddressView))
            {
                Flash::error('Contact Address View not found');
                return redirect(route('contactAddressViews.index'));
            }
    
            $user = DB::table('contact_address_views')->join('contact_addresses', 'contact_address_views.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactAddressViewRepository->delete($id);
            
                Flash::success('Contact Address View deleted successfully.');
                return redirect(route('contactAddressViews.index'));
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