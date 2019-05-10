<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactTelephoneCreateRequest;
use App\Http\Requests\UpdateContactTelephoneCreateRequest;
use App\Repositories\ContactTelephoneCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactTelephoneCreateController extends AppBaseController
{
    private $contactTelephoneCreateRepository;

    public function __construct(ContactTelephoneCreateRepository $contactTelephoneCreateRepo)
    {
        $this->contactTelephoneCreateRepository = $contactTelephoneCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactTelephoneCreateRepository->pushCriteria(new RequestCriteria($request));
            $contactTelephoneCreates = $this->contactTelephoneCreateRepository->all();
    
            return view('contact_telephone_creates.index')
                ->with('contactTelephoneCreates', $contactTelephoneCreates);
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
            return view('contact_telephone_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactTelephoneCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactTelephoneCreate = $this->contactTelephoneCreateRepository->create($input);
    
            Flash::success('Contact Telephone Create saved successfully.');
            return redirect(route('contactTelephoneCreates.index'));
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
            $contactTelephoneCreate = $this->contactTelephoneCreateRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneCreate))
            {
                Flash::error('Contact Telephone Create not found');
                return redirect(route('contactTelephoneCreates.index'));
            }
            
            $user = DB::table('contact_telephone_creates')->join('contact_telephones', 'contact_telephone_creates.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_telephone_creates.show')
                    ->with('contactTelephoneCreate', $contactTelephoneCreate);
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
            $contactTelephoneCreate = $this->contactTelephoneCreateRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneCreate))
            {
                Flash::error('Contact Telephone Create not found');
                return redirect(route('contactTelephoneCreates.index'));
            }
            
            $user = DB::table('contact_telephone_creates')->join('contact_telephones', 'contact_telephone_creates.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_telephone_creates.edit')
                    ->with('contactTelephoneCreate', $contactTelephoneCreate);
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

    public function update($id, UpdateContactTelephoneCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactTelephoneCreate = $this->contactTelephoneCreateRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneCreate))
            {
                Flash::error('Contact Telephone Create not found');
                return redirect(route('contactTelephoneCreates.index'));
            }
    
            $user = DB::table('contact_telephone_creates')->join('contact_telephones', 'contact_telephone_creates.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactTelephoneCreate = $this->contactTelephoneCreateRepository->update($request->all(), $id);
            
                Flash::success('Contact Telephone Create updated successfully.');
                return redirect(route('contactTelephoneCreates.index'));
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
            $contactTelephoneCreate = $this->contactTelephoneCreateRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneCreate))
            {
                Flash::error('Contact Telephone Create not found');
                return redirect(route('contactTelephoneCreates.index'));
            }
    
            $user = DB::table('contact_telephone_creates')->join('contact_telephones', 'contact_telephone_creates.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactTelephoneCreateRepository->delete($id);
            
                Flash::success('Contact Telephone Create deleted successfully.');
                return redirect(route('contactTelephoneCreates.index'));
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