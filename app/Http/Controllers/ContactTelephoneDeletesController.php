<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactTelephoneDeletesRequest;
use App\Http\Requests\UpdateContactTelephoneDeletesRequest;
use App\Repositories\ContactTelephoneDeletesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactTelephoneDeletesController extends AppBaseController
{
    private $contactTelephoneDeletesRepository;

    public function __construct(ContactTelephoneDeletesRepository $contactTelephoneDeletesRepo)
    {
        $this->contactTelephoneDeletesRepository = $contactTelephoneDeletesRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactTelephoneDeletesRepository->pushCriteria(new RequestCriteria($request));
            $contactTelephoneDeletes = $this->contactTelephoneDeletesRepository->all();
    
            return view('contact_telephone_deletes.index')
                ->with('contactTelephoneDeletes', $contactTelephoneDeletes);
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
            return view('contact_telephone_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactTelephoneDeletesRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactTelephoneDeletes = $this->contactTelephoneDeletesRepository->create($input);
    
            Flash::success('Contact Telephone Deletes saved successfully.');
            return redirect(route('contactTelephoneDeletes.index'));
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
            $contactTelephoneDeletes = $this->contactTelephoneDeletesRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneDeletes))
            {
                Flash::error('Contact Telephone Deletes not found');
                return redirect(route('contactTelephoneDeletes.index'));
            }
    
            $user = DB::table('contact_telephone_deletes')->join('contact_telephones', 'contact_telephone_deletes.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_telephone_deletes.show')
                    ->with('contactTelephoneDeletes', $contactTelephoneDeletes);
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
            $contactTelephoneDeletes = $this->contactTelephoneDeletesRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneDeletes))
            {
                Flash::error('Contact Telephone Deletes not found');
                return redirect(route('contactTelephoneDeletes.index'));
            }
            
            $user = DB::table('contact_telephone_deletes')->join('contact_telephones', 'contact_telephone_deletes.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_telephone_deletes.edit')
                    ->with('contactTelephoneDeletes', $contactTelephoneDeletes);
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

    public function update($id, UpdateContactTelephoneDeletesRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactTelephoneDeletes = $this->contactTelephoneDeletesRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneDeletes))
            {
                Flash::error('Contact Telephone Deletes not found');
                return redirect(route('contactTelephoneDeletes.index'));
            }
    
            $user = DB::table('contact_telephone_deletes')->join('contact_telephones', 'contact_telephone_deletes.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactTelephoneDeletes = $this->contactTelephoneDeletesRepository->update($request->all(), $id);
            
                Flash::success('Contact Telephone Deletes updated successfully.');
                return redirect(route('contactTelephoneDeletes.index'));
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
            $contactTelephoneDeletes = $this->contactTelephoneDeletesRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneDeletes))
            {
                Flash::error('Contact Telephone Deletes not found');
                return redirect(route('contactTelephoneDeletes.index'));
            }
            
            $user = DB::table('contact_telephone_deletes')->join('contact_telephones', 'contact_telephone_deletes.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactTelephoneDeletesRepository->delete($id);
            
                Flash::success('Contact Telephone Deletes deleted successfully.');
                return redirect(route('contactTelephoneDeletes.index'));
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