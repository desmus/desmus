<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactAddressCreateRequest;
use App\Http\Requests\UpdateContactAddressCreateRequest;
use App\Repositories\ContactAddressCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactAddressCreateController extends AppBaseController
{
    private $contactAddressCreateRepository;

    public function __construct(ContactAddressCreateRepository $contactAddressCreateRepo)
    {
        $this->contactAddressCreateRepository = $contactAddressCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactAddressCreateRepository->pushCriteria(new RequestCriteria($request));
            $contactAddressCreates = $this->contactAddressCreateRepository->all();
    
            return view('contact_address_creates.index')
                ->with('contactAddressCreates', $contactAddressCreates);
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
            return view('contact_address_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactAddressCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactAddressCreate = $this->contactAddressCreateRepository->create($input);
    
            Flash::success('Contact Address Create saved successfully.');
            return redirect(route('contactAddressCreates.index'));
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
            $contactAddressCreate = $this->contactAddressCreateRepository->findWithoutFail($id);
    
            if(empty($contactAddressCreate))
            {
                Flash::error('Contact Address Create not found');
                return redirect(route('contactAddressCreates.index'));
            }
            
            $user = DB::table('contact_address_creates')->join('contact_addresses', 'contact_address_creates.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_address_creates.show')
                    ->with('contactAddressCreate', $contactAddressCreate);
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
            $contactAddressCreate = $this->contactAddressCreateRepository->findWithoutFail($id);
    
            if(empty($contactAddressCreate))
            {
                Flash::error('Contact Address Create not found');
                return redirect(route('contactAddressCreates.index'));
            }
    
            $user = DB::table('contact_address_creates')->join('contact_addresses', 'contact_address_creates.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_address_creates.edit')
                    ->with('contactAddressCreate', $contactAddressCreate);
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

    public function update($id, UpdateContactAddressCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactAddressCreate = $this->contactAddressCreateRepository->findWithoutFail($id);
    
            if(empty($contactAddressCreate))
            {
                Flash::error('Contact Address Create not found');
                return redirect(route('contactAddressCreates.index'));
            }
            
            $user = DB::table('contact_address_creates')->join('contact_addresses', 'contact_address_creates.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactAddressCreate = $this->contactAddressCreateRepository->update($request->all(), $id);
            
                Flash::success('Contact Address Create updated successfully.');
                return redirect(route('contactAddressCreates.index'));
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
            $contactAddressCreate = $this->contactAddressCreateRepository->findWithoutFail($id);
    
            if(empty($contactAddressCreate))
            {
                Flash::error('Contact Address Create not found');
                return redirect(route('contactAddressCreates.index'));
            }
    
            $user = DB::table('contact_address_creates')->join('contact_addresses', 'contact_address_creates.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactAddressCreateRepository->delete($id);
            
                Flash::success('Contact Address Create deleted successfully.');
                return redirect(route('contactAddressCreates.index'));
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