<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactEmailViewRequest;
use App\Http\Requests\UpdateContactEmailViewRequest;
use App\Repositories\ContactEmailViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactEmailViewController extends AppBaseController
{
    private $contactEmailViewRepository;

    public function __construct(ContactEmailViewRepository $contactEmailViewRepo)
    {
        $this->contactEmailViewRepository = $contactEmailViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactEmailViewRepository->pushCriteria(new RequestCriteria($request));
            $contactEmailViews = $this->contactEmailViewRepository->all();
    
            return view('contact_email_views.index')
                ->with('contactEmailViews', $contactEmailViews);
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
            return view('contact_email_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactEmailViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactEmailView = $this->contactEmailViewRepository->create($input);
    
            Flash::success('Contact Email View saved successfully.');
            return redirect(route('contactEmailViews.index'));
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
            $contactEmailView = $this->contactEmailViewRepository->findWithoutFail($id);
    
            if(empty($contactEmailView))
            {
                Flash::error('Contact Email View not found');
                return redirect(route('contactEmailViews.index'));
            }
    
            $user = DB::table('contact_email_views')->join('contact_emails', 'contact_email_views.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_email_views.show')->with('contactEmailView', $contactEmailView);
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
            $contactEmailView = $this->contactEmailViewRepository->findWithoutFail($id);
    
            if(empty($contactEmailView))
            {
                Flash::error('Contact Email View not found');
                return redirect(route('contactEmailViews.index'));
            }
    
            $user = DB::table('contact_email_views')->join('contact_emails', 'contact_email_views.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_email_views.edit')->with('contactEmailView', $contactEmailView);
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

    public function update($id, UpdateContactEmailViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactEmailView = $this->contactEmailViewRepository->findWithoutFail($id);
    
            if(empty($contactEmailView))
            {
                Flash::error('Contact Email View not found');
                return redirect(route('contactEmailViews.index'));
            }
    
            $user = DB::table('contact_email_views')->join('contact_emails', 'contact_email_views.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactEmailView = $this->contactEmailViewRepository->update($request->all(), $id);
            
                Flash::success('Contact Email View updated successfully.');
                return redirect(route('contactEmailViews.index'));
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
            $contactEmailView = $this->contactEmailViewRepository->findWithoutFail($id);
    
            if(empty($contactEmailView))
            {
                Flash::error('Contact Email View not found');
                return redirect(route('contactEmailViews.index'));
            }
    
            $user = DB::table('contact_email_views')->join('contact_emails', 'contact_email_views.contact_email_id', '=', 'contact_emails.id')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_email_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactEmailViewRepository->delete($id);
            
                Flash::success('Contact Email View deleted successfully.');
                return redirect(route('contactEmailViews.index'));
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