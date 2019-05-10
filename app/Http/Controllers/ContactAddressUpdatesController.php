<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactAddressUpdatesRequest;
use App\Http\Requests\UpdateContactAddressUpdatesRequest;
use App\Repositories\ContactAddressUpdatesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactAddressUpdatesController extends AppBaseController
{
    private $contactAddressUpdatesRepository;

    public function __construct(ContactAddressUpdatesRepository $contactAddressUpdatesRepo)
    {
        $this->contactAddressUpdatesRepository = $contactAddressUpdatesRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactAddressUpdatesRepository->pushCriteria(new RequestCriteria($request));
            $contactAddressUpdates = $this->contactAddressUpdatesRepository->all();
    
            return view('contact_address_updates.index')
                ->with('contactAddressUpdates', $contactAddressUpdates);
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
            return view('contact_address_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactAddressUpdatesRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactAddressUpdates = $this->contactAddressUpdatesRepository->create($input);
    
            Flash::success('Contact Address Updates saved successfully.');
            return redirect(route('contactAddressUpdates.index'));
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
            $contactAddressUpdates = $this->contactAddressUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactAddressUpdates))
            {
                Flash::error('Contact Address Updates not found');
                return redirect(route('contactAddressUpdates.index'));
            }
            
            $user = DB::table('contact_address_updates')->join('contact_addresses', 'contact_address_updates.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_address_updates.show')->with('contactAddressUpdates', $contactAddressUpdates);
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
            $contactAddressUpdates = $this->contactAddressUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactAddressUpdates))
            {
                Flash::error('Contact Address Updates not found');
                return redirect(route('contactAddressUpdates.index'));
            }
            
            $user = DB::table('contact_address_updates')->join('contact_addresses', 'contact_address_updates.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_address_updates.edit')->with('contactAddressUpdates', $contactAddressUpdates);
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

    public function update($id, UpdateContactAddressUpdatesRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactAddressUpdates = $this->contactAddressUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactAddressUpdates))
            {
                Flash::error('Contact Address Updates not found');
                return redirect(route('contactAddressUpdates.index'));
            }
            
            $user = DB::table('contact_address_updates')->join('contact_addresses', 'contact_address_updates.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactAddressUpdates = $this->contactAddressUpdatesRepository->update($request->all(), $id);
            
                Flash::success('Contact Address Updates updated successfully.');
                return redirect(route('contactAddressUpdates.index'));
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
            $contactAddressUpdates = $this->contactAddressUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactAddressUpdates))
            {
                Flash::error('Contact Address Updates not found');
                return redirect(route('contactAddressUpdates.index'));
            }
            
            $user = DB::table('contact_address_updates')->join('contact_addresses', 'contact_address_updates.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactAddressUpdatesRepository->delete($id);
            
                Flash::success('Contact Address Updates deleted successfully.');
                return redirect(route('contactAddressUpdates.index'));
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