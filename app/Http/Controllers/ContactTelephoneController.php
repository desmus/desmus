<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactTelephoneRequest;
use App\Http\Requests\UpdateContactTelephoneRequest;
use App\Repositories\ContactTelephoneRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactTelephoneController extends AppBaseController
{
    private $contactTelephoneRepository;

    public function __construct(ContactTelephoneRepository $contactTelephoneRepo)
    {
        $this->contactTelephoneRepository = $contactTelephoneRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactTelephoneRepository->pushCriteria(new RequestCriteria($request));
            $contactTelephones = $this->contactTelephoneRepository->all();
    
            return view('contact_telephones.index')
                ->with('contactTelephones', $contactTelephones);
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

            return view('contact_telephones.create')
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

    public function store(CreateContactTelephoneRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $contactTelephone = $this->contactTelephoneRepository->create($input);
    
            DB::table('contact_telephone_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_telephone_id' => $contactTelephone -> id]);
    
            Flash::success('Contact Telephone saved successfully.');
            return redirect(route('contacts.show', [$contactTelephone -> contact_id]));
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
            $contactTelephone = $this->contactTelephoneRepository->findWithoutFail($id);
    
            if(empty($contactTelephone))
            {
                Flash::error('Contact Telephone not found');
                return redirect(route('contactTelephones.index'));
            }
    
            $user = DB::table('contact_telephones')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephones.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_telephone_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_telephone_id' => $contactTelephone -> id]);
    
                $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->limit(10)->orderBy('id', 'desc')->get();
                $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();
    
                return view('contact_telephones.show')
                    ->with('contactTelephone', $contactTelephone)
                    ->with('id', $contactTelephone -> contact_id)
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
            $contactTelephone = $this->contactTelephoneRepository->findWithoutFail($id);
    
            if(empty($contactTelephone))
            {
                Flash::error('Contact Telephone not found');
                return redirect(route('contactTelephones.index'));
            }
            
            $user = DB::table('contact_telephones')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephones.id', '=', $id)->get();
            
            $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->limit(10)->orderBy('id', 'desc')->get();
            $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
            $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
            $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_telephones.edit')
                    ->with('contactTelephone', $contactTelephone)
                    ->with('id', $contactTelephone -> contact_id)
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

    public function update($id, UpdateContactTelephoneRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contactTelephone = $this->contactTelephoneRepository->findWithoutFail($id);
    
            if(empty($contactTelephone))
            {
                Flash::error('Contact Telephone not found');
                return redirect(route('contactTelephones.index'));
            }
            
            $user = DB::table('contact_telephones')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephones.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_telephone_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_telephone_id' => $contactTelephone -> id]);
    
                $contactTelephone = $this->contactTelephoneRepository->update($request->all(), $id);
            
                Flash::success('Contact Telephone updated successfully.');
                return redirect(route('contacts.show', [$contactTelephone -> contact_id]));
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
            $contactTelephone = $this->contactTelephoneRepository->findWithoutFail($id);
    
            if(empty($contactTelephone))
            {
                Flash::error('Contact Telephone not found');
                return redirect(route('contactTelephones.index'));
            }
            
            $user = DB::table('contact_telephones')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephones.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_telephone_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_telephone_id' => $contactTelephone -> id]);
    
                $this->contactTelephoneRepository->delete($id);
            
                Flash::success('Contact Telephone deleted successfully.');
                return redirect(route('contacts.show', $contactTelephone -> contact_id));
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