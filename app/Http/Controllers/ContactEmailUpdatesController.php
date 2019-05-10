<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactEmailUpdatesRequest;
use App\Http\Requests\UpdateContactEmailUpdatesRequest;
use App\Repositories\ContactEmailUpdatesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactEmailUpdatesController extends AppBaseController
{
    private $contactEmailUpdatesRepository;

    public function __construct(ContactEmailUpdatesRepository $contactEmailUpdatesRepo)
    {
        $this->contactEmailUpdatesRepository = $contactEmailUpdatesRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactEmailUpdatesRepository->pushCriteria(new RequestCriteria($request));
            $contactEmailUpdates = $this->contactEmailUpdatesRepository->all();
    
            return view('contact_email_updates.index')
                ->with('contactEmailUpdates', $contactEmailUpdates);
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
            return view('contact_email_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactEmailUpdatesRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactEmailUpdates = $this->contactEmailUpdatesRepository->create($input);
    
            Flash::success('Contact Email Updates saved successfully.');
            return redirect(route('contactEmailUpdates.index'));
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
            $contactEmailUpdates = $this->contactEmailUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactEmailUpdates))
            {
                Flash::error('Contact Email Updates not found');
                return redirect(route('contactEmailUpdates.index'));
            }
    
            $user = DB::table('contact_email_updates')->join('contact_emails', 'contact_email_updates.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_email_updates.show')->with('contactEmailUpdates', $contactEmailUpdates);
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
            $contactEmailUpdates = $this->contactEmailUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactEmailUpdates))
            {
                Flash::error('Contact Email Updates not found');
                return redirect(route('contactEmailUpdates.index'));
            }
    
            $user = DB::table('contact_email_updates')->join('contact_emails', 'contact_email_updates.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_email_updates.edit')->with('contactEmailUpdates', $contactEmailUpdates);
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

    public function update($id, UpdateContactEmailUpdatesRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactEmailUpdates = $this->contactEmailUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactEmailUpdates))
            {
                Flash::error('Contact Email Updates not found');
                return redirect(route('contactEmailUpdates.index'));
            }
    
            $user = DB::table('contact_email_updates')->join('contact_emails', 'contact_email_updates.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactEmailUpdates = $this->contactEmailUpdatesRepository->update($request->all(), $id);
            
                Flash::success('Contact Email Updates updated successfully.');
                return redirect(route('contactEmailUpdates.index'));
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
            $contactEmailUpdates = $this->contactEmailUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactEmailUpdates))
            {
                Flash::error('Contact Email Updates not found');
                return redirect(route('contactEmailUpdates.index'));
            }
    
            $user = DB::table('contact_email_updates')->join('contact_emails', 'contact_email_updates.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactEmailUpdatesRepository->delete($id);
            
                Flash::success('Contact Email Updates deleted successfully.');
                return redirect(route('contactEmailUpdates.index'));
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