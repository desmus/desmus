<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactEmailDeletesRequest;
use App\Http\Requests\UpdateContactEmailDeletesRequest;
use App\Repositories\ContactEmailDeletesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactEmailDeletesController extends AppBaseController
{
    private $contactEmailDeletesRepository;

    public function __construct(ContactEmailDeletesRepository $contactEmailDeletesRepo)
    {
        $this->contactEmailDeletesRepository = $contactEmailDeletesRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactEmailDeletesRepository->pushCriteria(new RequestCriteria($request));
            $contactEmailDeletes = $this->contactEmailDeletesRepository->all();
    
            return view('contact_email_deletes.index')
                ->with('contactEmailDeletes', $contactEmailDeletes);
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
            return view('contact_email_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactEmailDeletesRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactEmailDeletes = $this->contactEmailDeletesRepository->create($input);
    
            Flash::success('Contact Email Deletes saved successfully.');
            return redirect(route('contactEmailDeletes.index'));
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
            $contactEmailDeletes = $this->contactEmailDeletesRepository->findWithoutFail($id);
    
            if(empty($contactEmailDeletes))
            {
                Flash::error('Contact Email Deletes not found');
                return redirect(route('contactEmailDeletes.index'));
            }
    
            $user = DB::table('contact_email_deletes')->join('contact_emails', 'contact_email_deletes.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_email_deletes.show')
                    ->with('contactEmailDeletes', $contactEmailDeletes);
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
            $contactEmailDeletes = $this->contactEmailDeletesRepository->findWithoutFail($id);
    
            if(empty($contactEmailDeletes))
            {
                Flash::error('Contact Email Deletes not found');
                return redirect(route('contactEmailDeletes.index'));
            }
            
            $user = DB::table('contact_email_deletes')->join('contact_emails', 'contact_email_deletes.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_email_deletes.edit')
                    ->with('contactEmailDeletes', $contactEmailDeletes);
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

    public function update($id, UpdateContactEmailDeletesRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contactEmailDeletes = $this->contactEmailDeletesRepository->findWithoutFail($id);
    
            if(empty($contactEmailDeletes))
            {
                Flash::error('Contact Email Deletes not found');
                return redirect(route('contactEmailDeletes.index'));
            }
    
            $user = DB::table('contact_email_deletes')->join('contact_emails', 'contact_email_deletes.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactEmailDeletes = $this->contactEmailDeletesRepository->update($request->all(), $id);
            
                Flash::success('Contact Email Deletes updated successfully.');
                return redirect(route('contactEmailDeletes.index'));
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
            $contactEmailDeletes = $this->contactEmailDeletesRepository->findWithoutFail($id);
    
            if(empty($contactEmailDeletes))
            {
                Flash::error('Contact Email Deletes not found');
                return redirect(route('contactEmailDeletes.index'));
            }
    
            $user = DB::table('contact_email_deletes')->join('contact_emails', 'contact_email_deletes.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactEmailDeletesRepository->delete($id);
            
                Flash::success('Contact Email Deletes deleted successfully.');
                return redirect(route('contactEmailDeletes.index'));
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