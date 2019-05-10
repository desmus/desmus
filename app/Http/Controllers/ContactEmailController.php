<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactEmailRequest;
use App\Http\Requests\UpdateContactEmailRequest;
use App\Repositories\ContactEmailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactEmailController extends AppBaseController
{
    private $contactEmailRepository;

    public function __construct(ContactEmailRepository $contactEmailRepo)
    {
        $this->contactEmailRepository = $contactEmailRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactEmailRepository->pushCriteria(new RequestCriteria($request));
            $contactEmails = $this->contactEmailRepository->all();
    
            return view('contact_emails.index')
                ->with('contactEmails', $contactEmails);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create($id)
    {
        $user_id = Auth::user()->id;
        
        if(Auth::user() != null)
        {
            $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->limit(10)->orderBy('id', 'desc')->get();
            $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
            $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
            $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();
            
            return view('contact_emails.create')
                ->with('id', $id)
                ->with('calendar_events', $calendar_events)
                ->with('r_messages_list', $r_messages_list)
                ->with('s_messages_list', $s_messages_list)
                ->with('contacts_list', $contacts_list);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactEmailRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $contactEmail = $this->contactEmailRepository->create($input);
            
            DB::table('contact_email_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_email_id' => $contactEmail -> id]);
    
            Flash::success('Contact Email saved successfully.');
            return redirect(route('contacts.show', [$contactEmail -> contact_id]));
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
            $contactEmail = $this->contactEmailRepository->findWithoutFail($id);
    
            if(empty($contactEmail))
            {
                Flash::error('Contact Email not found');
                return redirect(route('contactEmails.index'));
            }
    
            $user = DB::table('contact_emails')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_emails.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_email_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_email_id' => $contactEmail -> id]);
    
                $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->limit(10)->orderBy('id', 'desc')->get();
                $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();
    
                return view('contact_emails.show')
                    ->with('contactEmail', $contactEmail)
                    ->with('id', $contactEmail -> contact_id)
                    ->with('calendar_events', $calendar_events)
                    ->with('r_messages_list', $r_messages_list)
                    ->with('s_messages_list', $s_messages_list)
                    ->with('contacts_list', $contacts_list);
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
            $contactEmail = $this->contactEmailRepository->findWithoutFail($id);
    
            if(empty($contactEmail))
            {
                Flash::error('Contact Email not found');
                return redirect(route('contactEmails.index'));
            }
    
            $user = DB::table('contact_emails')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_emails.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->limit(10)->orderBy('id', 'desc')->get();
                $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();

                return view('contact_emails.edit')
                    ->with('contactEmail', $contactEmail)
                    ->with('id', $contactEmail -> contact_id)
                    ->with('calendar_events', $calendar_events)
                    ->with('r_messages_list', $r_messages_list)
                    ->with('s_messages_list', $s_messages_list)
                    ->with('contacts_list', $contacts_list);
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

    public function update($id, UpdateContactEmailRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contactEmail = $this->contactEmailRepository->findWithoutFail($id);
    
            if(empty($contactEmail))
            {
                Flash::error('Contact Email not found');
                return redirect(route('contactEmails.index'));
            }
            
            $user = DB::table('contact_emails')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_emails.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_email_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_email_id' => $contactEmail -> id]);
    
                $contactEmail = $this->contactEmailRepository->update($request->all(), $id);
            
                Flash::success('Contact Email updated successfully.');
                return redirect(route('contacts.show', [$contactEmail -> contact_id]));
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
            $contactEmail = $this->contactEmailRepository->findWithoutFail($id);
    
            if(empty($contactEmail))
            {
                Flash::error('Contact Email not found');
                return redirect(route('contactEmails.index'));
            }
    
            $user = DB::table('contact_emails')->join('contacts', 'contact_emails.contact_id', '=', 'contacts.id')->where('contact_emails.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_email_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_email_id' => $contactEmail -> id]);
    
                $this->contactEmailRepository->delete($id);
            
                Flash::success('Contact Email deleted successfully.');
                return redirect(route('contacts.show', $contactEmail -> contact_id));
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