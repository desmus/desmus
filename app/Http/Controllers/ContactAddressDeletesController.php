<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactAddressDeletesRequest;
use App\Http\Requests\UpdateContactAddressDeletesRequest;
use App\Repositories\ContactAddressDeletesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactAddressDeletesController extends AppBaseController
{
    private $contactAddressDeletesRepository;

    public function __construct(ContactAddressDeletesRepository $contactAddressDeletesRepo)
    {
        $this->contactAddressDeletesRepository = $contactAddressDeletesRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactAddressDeletesRepository->pushCriteria(new RequestCriteria($request));
            $contactAddressDeletes = $this->contactAddressDeletesRepository->all();
    
            return view('contact_address_deletes.index')
                ->with('contactAddressDeletes', $contactAddressDeletes);
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
            return view('contact_address_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactAddressDeletesRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactAddressDeletes = $this->contactAddressDeletesRepository->create($input);
    
            Flash::success('Contact Address Deletes saved successfully.');
            return redirect(route('contactAddressDeletes.index'));
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
            $contactAddressDeletes = $this->contactAddressDeletesRepository->findWithoutFail($id);
    
            if(empty($contactAddressDeletes))
            {
                Flash::error('Contact Address Deletes not found');
                return redirect(route('contactAddressDeletes.index'));
            }
            
            $user = DB::table('contact_address_deletes')->join('contact_addresses', 'contact_address_deletes.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_address_deletes.show')
                    ->with('contactAddressDeletes', $contactAddressDeletes);
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
            $contactAddressDeletes = $this->contactAddressDeletesRepository->findWithoutFail($id);
    
            if(empty($contactAddressDeletes))
            {
                Flash::error('Contact Address Deletes not found');
                return redirect(route('contactAddressDeletes.index'));
            }
            
            $user = DB::table('contact_address_deletes')->join('contact_addresses', 'contact_address_deletes.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_address_deletes.edit')
                    ->with('contactAddressDeletes', $contactAddressDeletes);
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

    public function update($id, UpdateContactAddressDeletesRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactAddressDeletes = $this->contactAddressDeletesRepository->findWithoutFail($id);
    
            if(empty($contactAddressDeletes))
            {
                Flash::error('Contact Address Deletes not found');
                return redirect(route('contactAddressDeletes.index'));
            }
    
            $user = DB::table('contact_address_deletes')->join('contact_addresses', 'contact_address_deletes.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactAddressDeletes = $this->contactAddressDeletesRepository->update($request->all(), $id);
            
                Flash::success('Contact Address Deletes updated successfully.');
                return redirect(route('contactAddressDeletes.index'));
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
            $contactAddressDeletes = $this->contactAddressDeletesRepository->findWithoutFail($id);
    
            if(empty($contactAddressDeletes))
            {
                Flash::error('Contact Address Deletes not found');
                return redirect(route('contactAddressDeletes.index'));
            }
            
            $user = DB::table('contact_address_deletes')->join('contact_addresses', 'contact_address_deletes.contact_address_id', '=', 'contact_addresses.id')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_address_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactAddressDeletesRepository->delete($id);
            
                Flash::success('Contact Address Deletes deleted successfully.');
                return redirect(route('contactAddressDeletes.index'));
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