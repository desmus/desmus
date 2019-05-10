<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactAddressRequest;
use App\Http\Requests\UpdateContactAddressRequest;
use App\Repositories\ContactAddressRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactAddressController extends AppBaseController
{
    private $contactAddressRepository;

    public function __construct(ContactAddressRepository $contactAddressRepo)
    {
        $this->contactAddressRepository = $contactAddressRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactAddressRepository->pushCriteria(new RequestCriteria($request));
            $contactAddresses = $this->contactAddressRepository->all();
    
            return view('contact_addresses.index')
                ->with('contactAddresses', $contactAddresses);
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

            return view('contact_addresses.create')
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

    public function store(CreateContactAddressRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $contactAddress = $this->contactAddressRepository->create($input);
            
            DB::table('contact_address_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_address_id' => $contactAddress -> id]);
    
            Flash::success('Contact Address saved successfully.');
            return redirect(route('contacts.show', [$contactAddress -> contact_id]));
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
            $contactAddress = $this->contactAddressRepository->findWithoutFail($id);
            
            if(empty($contactAddress))
            {
                Flash::error('Contact Address not found');
                return redirect(route('contactAddresses.index'));
            }
            
            $user = DB::table('contact_addresses')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_addresses.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_address_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_address_id' => $contactAddress -> id]);
    
                $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->limit(10)->orderBy('id', 'desc')->get();
                $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();
    
                return view('contact_addresses.show')
                    ->with('contactAddress', $contactAddress)
                    ->with('id', $contactAddress -> contact_id)
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
            $contactAddress = $this->contactAddressRepository->findWithoutFail($id);
    
            if(empty($contactAddress))
            {
                Flash::error('Contact Address not found');
                return redirect(route('contactAddresses.index'));
            }
            
            $user = DB::table('contact_addresses')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_addresses.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->limit(10)->orderBy('id', 'desc')->get();
                $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();

                return view('contact_addresses.edit')
                    ->with('contactAddress', $contactAddress)
                    ->with('id', $contactAddress -> contact_id)
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

    public function update($id, UpdateContactAddressRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contactAddress = $this->contactAddressRepository->findWithoutFail($id);
    
            if(empty($contactAddress))
            {
                Flash::error('Contact Address not found');
                return redirect(route('contactAddresses.index'));
            }
    
            $user = DB::table('contact_addresses')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_addresses.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_address_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_address_id' => $contactAddress -> id]);
    
                $contactAddress = $this->contactAddressRepository->update($request->all(), $id);
            
                Flash::success('Contact Address updated successfully.');
                return redirect(route('contacts.show', [$contactAddress -> contact_id]));
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
            $contactAddress = $this->contactAddressRepository->findWithoutFail($id);
    
            if(empty($contactAddress))
            {
                Flash::error('Contact Address not found');
                return redirect(route('contactAddresses.index'));
            }
    
            $user = DB::table('contact_addresses')->join('contacts', 'contact_addresses.contact_id', '=', 'contacts.id')->where('contact_addresses.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_address_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_address_id' => $contactAddress -> id]);
    
                $this->contactAddressRepository->delete($id);
            
                Flash::success('Contact Address deleted successfully.');
                return redirect(route('contacts.show', $contactAddress -> contact_id));
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