<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactEmailCreateRequest;
use App\Http\Requests\UpdateContactEmailCreateRequest;
use App\Repositories\ContactEmailCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactEmailCreateController extends AppBaseController
{
    private $contactEmailCreateRepository;

    public function __construct(ContactEmailCreateRepository $contactEmailCreateRepo)
    {
        $this->contactEmailCreateRepository = $contactEmailCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactEmailCreateRepository->pushCriteria(new RequestCriteria($request));
            $contactEmailCreates = $this->contactEmailCreateRepository->all();
    
            return view('contact_email_creates.index')
                ->with('contactEmailCreates', $contactEmailCreates);
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
            return view('contact_email_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactEmailCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactEmailCreate = $this->contactEmailCreateRepository->create($input);
    
            Flash::success('Contact Email Create saved successfully.');
            return redirect(route('contactEmailCreates.index'));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contactEmailCreate = $this->contactEmailCreateRepository->findWithoutFail($id);
    
            if(empty($contactEmailCreate))
            {
                Flash::error('Contact Email Create not found');
                return redirect(route('contactEmailCreates.index'));
            }
            
            $user = DB::table('contact_email_creates')->join('contact_emails', 'contact_email_creates.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_email_creates.show')->with('contactEmailCreate', $contactEmailCreate);
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contactEmailCreate = $this->contactEmailCreateRepository->findWithoutFail($id);
    
            if(empty($contactEmailCreate))
            {
                Flash::error('Contact Email Create not found');
                return redirect(route('contactEmailCreates.index'));
            }
    
            $user = DB::table('contact_email_creates')->join('contact_emails', 'contact_email_creates.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_email_creates.edit')->with('contactEmailCreate', $contactEmailCreate);
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

    public function update($id, UpdateContactEmailCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contactEmailCreate = $this->contactEmailCreateRepository->findWithoutFail($id);
    
            if(empty($contactEmailCreate))
            {
                Flash::error('Contact Email Create not found');
                return redirect(route('contactEmailCreates.index'));
            }
            
            $user = DB::table('contact_email_creates')->join('contact_emails', 'contact_email_creates.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactEmailCreate = $this->contactEmailCreateRepository->update($request->all(), $id);
            
                Flash::success('Contact Email Create updated successfully.');
                return redirect(route('contactEmailCreates.index'));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contactEmailCreate = $this->contactEmailCreateRepository->findWithoutFail($id);
    
            if(empty($contactEmailCreate))
            {
                Flash::error('Contact Email Create not found');
                return redirect(route('contactEmailCreates.index'));
            }
    
            $user = DB::table('contact_email_creates')->join('contact_emails', 'contact_email_creates.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactEmailCreateRepository->delete($id);
            
                Flash::success('Contact Email Create deleted successfully.');
                return redirect(route('contactEmailCreates.index'));    
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