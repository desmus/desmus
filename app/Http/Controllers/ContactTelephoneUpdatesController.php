<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactTelephoneUpdatesRequest;
use App\Http\Requests\UpdateContactTelephoneUpdatesRequest;
use App\Repositories\ContactTelephoneUpdatesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactTelephoneUpdatesController extends AppBaseController
{
    private $contactTelephoneUpdatesRepository;

    public function __construct(ContactTelephoneUpdatesRepository $contactTelephoneUpdatesRepo)
    {
        $this->contactTelephoneUpdatesRepository = $contactTelephoneUpdatesRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactTelephoneUpdatesRepository->pushCriteria(new RequestCriteria($request));
            $contactTelephoneUpdates = $this->contactTelephoneUpdatesRepository->all();
    
            return view('contact_telephone_updates.index')
                ->with('contactTelephoneUpdates', $contactTelephoneUpdates);
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
            return view('contact_telephone_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactTelephoneUpdatesRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactTelephoneUpdates = $this->contactTelephoneUpdatesRepository->create($input);
    
            Flash::success('Contact Telephone Updates saved successfully.');
            return redirect(route('contactTelephoneUpdates.index'));
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
            $contactTelephoneUpdates = $this->contactTelephoneUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneUpdates))
            {
                Flash::error('Contact Telephone Updates not found');
                return redirect(route('contactTelephoneUpdates.index'));
            }
            
            $user = DB::table('contact_telephone_updates')->join('contact_telephones', 'contact_telephone_updates.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_telephone_updates.show')
                    ->with('contactTelephoneUpdates', $contactTelephoneUpdates);
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
            $contactTelephoneUpdates = $this->contactTelephoneUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneUpdates))
            {
                Flash::error('Contact Telephone Updates not found');
                return redirect(route('contactTelephoneUpdates.index'));
            }
    
            $user = DB::table('contact_telephone_updates')->join('contact_telephones', 'contact_telephone_updates.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_telephone_updates.edit')
                    ->with('contactTelephoneUpdates', $contactTelephoneUpdates);
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

    public function update($id, UpdateContactTelephoneUpdatesRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactTelephoneUpdates = $this->contactTelephoneUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneUpdates))
            {
                Flash::error('Contact Telephone Updates not found');
                return redirect(route('contactTelephoneUpdates.index'));
            }
    
            $user = DB::table('contact_telephone_updates')->join('contact_telephones', 'contact_telephone_updates.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactTelephoneUpdates = $this->contactTelephoneUpdatesRepository->update($request->all(), $id);
            
                Flash::success('Contact Telephone Updates updated successfully.');
                return redirect(route('contactTelephoneUpdates.index'));
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
            $contactTelephoneUpdates = $this->contactTelephoneUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneUpdates))
            {
                Flash::error('Contact Telephone Updates not found');
                return redirect(route('contactTelephoneUpdates.index'));
            }
            
            $user = DB::table('contact_telephone_updates')->join('contact_telephones', 'contact_telephone_updates.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactTelephoneUpdatesRepository->delete($id);
            
                Flash::success('Contact Telephone Updates deleted successfully.');
                return redirect(route('contactTelephoneUpdates.index'));
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