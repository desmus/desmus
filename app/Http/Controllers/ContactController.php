<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Repositories\ContactRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactController extends AppBaseController
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepository = $contactRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->contactRepository->pushCriteria(new RequestCriteria($request));
            $contacts = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->orderBy('name', 'asc')->get();
    
            return view('contacts.index')
                ->with('contacts', $contacts);
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
            $user_id = Auth::user()->id;
            
            $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();
            
            return view('contacts.create')
                ->with('user_id', $user_id)
                ->with('contacts_list', $contacts_list);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $contact = $this->contactRepository->create($input);
            $user = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->where('contacts.id', '=', $contact -> id)->select('name', 'user_id')->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_id' => $contact -> id]);
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'contact_c', 'user_id' => $user_id, 'entity_id' => $contact -> id, 'created_at' => $now]);
            
                Flash::success('Contact saved successfully.');
                return redirect(route('homes.index'));
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

    public function show($id, Request $request)
    {
        if(Auth::user() != null)
        {
            $contact_address_p = $request -> contact_address_p;
            $contact_email_p = $request -> contact_email_p;
            $contact_social_p = $request -> contact_social_p;
            $contact_telephone_p = $request -> contact_telephone_p;
            $contact_web_p = $request -> contact_web_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contact = $this->contactRepository->findWithoutFail($id);
                        
            if(empty($contact))
            {
                Flash::error('Contact not found');
                return redirect(route('homes.index'));
            }
            
            $contact = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('contacts.id', '=', $id)->get();
            $user = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->where('contacts.id', '=', $contact[0] -> id)->select('name', 'user_id')->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_id' => $id]);
                DB::table('contacts')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
                
                $contact = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('contacts.id', '=', $id)->get();
                $contactViews = DB::table('contacts')->join('contact_views', 'contacts.id', '=', 'contact_views.contact_id')->where('contact_views.contact_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $contactUpdates = DB::table('contacts')->join('contact_updates', 'contacts.id', '=', 'contact_updates.contact_id')->where('contact_updates.contact_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $contactAddresses = DB::table('contact_addresses')->where('contact_addresses.contact_id', '=', $id)->where(function ($query) {$query->where('contact_addresses.deleted_at', '=', null);})->paginate(50, ['*'], 'contact_address_p');
                $contactEmails = DB::table('contact_emails')->where('contact_emails.contact_id', '=', $id)->where(function ($query) {$query->where('contact_emails.deleted_at', '=', null);})->paginate(50, ['*'], 'contact_email_p');
                $contactSocials = DB::table('contact_socials')->where('contact_socials.contact_id', '=', $id)->where(function ($query) {$query->where('contact_socials.deleted_at', '=', null);})->paginate(50, ['*'], 'contact_social_p');
                $contactTelephones = DB::table('contact_telephones')->where('contact_telephones.contact_id', '=', $id)->where(function ($query) {$query->where('contact_telephones.deleted_at', '=', null);})->paginate(50, ['*'], 'contact_telephone_p');
                $contactWebs = DB::table('contact_webs')->where('contact_webs.contact_id', '=', $id)->where(function ($query) {$query->where('contact_webs.deleted_at', '=', null);})->paginate(50, ['*'], 'contact_web_p');

                $contactAddressesList = DB::table('contact_addresses')->where('contact_addresses.contact_id', '=', $id)->where(function ($query) {$query->where('contact_addresses.deleted_at', '=', null);})->limit(10)->get();
                $contactEmailsList = DB::table('contact_emails')->where('contact_emails.contact_id', '=', $id)->where(function ($query) {$query->where('contact_emails.deleted_at', '=', null);})->limit(10)->get();
                $contactSocialsList = DB::table('contact_socials')->where('contact_socials.contact_id', '=', $id)->where(function ($query) {$query->where('contact_socials.deleted_at', '=', null);})->limit(10)->get();
                $contactTelephonesList = DB::table('contact_telephones')->where('contact_telephones.contact_id', '=', $id)->where(function ($query) {$query->where('contact_telephones.deleted_at', '=', null);})->limit(10)->get();
                $contactWebsList = DB::table('contact_webs')->where('contact_webs.contact_id', '=', $id)->where(function ($query) {$query->where('contact_webs.deleted_at', '=', null);})->limit(10)->get();
                $contactViewsList = DB::table('users')->join('contact_views', 'users.id', '=', 'contact_views.user_id')->where('contact_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $contactUpdatesList = DB::table('users')->join('contact_updates', 'users.id', '=', 'contact_updates.user_id')->where('contact_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('contacts.show')
                    ->with('contact', $contact)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('contactViews', $contactViews)
                    ->with('contactUpdates', $contactUpdates)
                    ->with('contactAddresses', $contactAddresses)
                    ->with('contactEmails', $contactEmails)
                    ->with('contactSocials', $contactSocials)
                    ->with('contactTelephones', $contactTelephones)
                    ->with('contactWebs', $contactWebs)
                    ->with('contact_address_p', $contact_address_p)
                    ->with('contact_email_p', $contact_email_p)
                    ->with('contact_social_p', $contact_social_p)
                    ->with('contact_telephone_p', $contact_telephone_p)
                    ->with('contact_web_p', $contact_web_p)
                    ->with('contactAddressesList', $contactAddressesList)
                    ->with('contactEmailsList', $contactEmailsList)
                    ->with('contactSocialsList', $contactSocialsList)
                    ->with('contactTelephonesList', $contactTelephonesList)
                    ->with('contactWebsList', $contactWebsList)
                    ->with('contactViewsList', $contactViewsList)
                    ->with('contactUpdatesList', $contactUpdatesList);
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
            $contact = $this->contactRepository->findWithoutFail($id);
            $user = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->where('contacts.id', '=', $contact -> id)->select('name', 'user_id')->get();
    
            if(empty($contact))
            {
                Flash::error('Contact not found');
                return redirect(route('homes.index'));
            }
    
            if($user[0] -> user_id == $user_id)
            {
                $contactAddressesList = DB::table('contact_addresses')->where('contact_addresses.contact_id', '=', $id)->where(function ($query) {$query->where('contact_addresses.deleted_at', '=', null);})->limit(10)->get();
                $contactEmailsList = DB::table('contact_emails')->where('contact_emails.contact_id', '=', $id)->where(function ($query) {$query->where('contact_emails.deleted_at', '=', null);})->limit(10)->get();
                $contactSocialsList = DB::table('contact_socials')->where('contact_socials.contact_id', '=', $id)->where(function ($query) {$query->where('contact_socials.deleted_at', '=', null);})->limit(10)->get();
                $contactTelephonesList = DB::table('contact_telephones')->where('contact_telephones.contact_id', '=', $id)->where(function ($query) {$query->where('contact_telephones.deleted_at', '=', null);})->limit(10)->get();
                $contactWebsList = DB::table('contact_webs')->where('contact_webs.contact_id', '=', $id)->where(function ($query) {$query->where('contact_webs.deleted_at', '=', null);})->limit(10)->get();
                $contactViewsList = DB::table('users')->join('contact_views', 'users.id', '=', 'contact_views.user_id')->where('contact_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $contactUpdatesList = DB::table('users')->join('contact_updates', 'users.id', '=', 'contact_updates.user_id')->where('contact_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                
                return view('contacts.edit')
                    ->with('contact', $contact)
                    ->with('user_id', $user_id)
                    ->with('contactAddressesList', $contactAddressesList)
                    ->with('contactEmailsList', $contactEmailsList)
                    ->with('contactSocialsList', $contactSocialsList)
                    ->with('contactTelephonesList', $contactTelephonesList)
                    ->with('contactWebsList', $contactWebsList)
                    ->with('contactViewsList', $contactViewsList)
                    ->with('contactUpdatesList', $contactUpdatesList);
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

    public function update($id, UpdateContactRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contact = $this->contactRepository->findWithoutFail($id);
            $user = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->where('contacts.id', '=', $contact -> id)->select('name', 'user_id')->get();
    
            if(empty($contact))
            {
                Flash::error('Contact not found');
                return redirect(route('homes.index'));
            }
            
            if($user[0] -> user_id == $user_id)
            {
                $newContact = $this->contactRepository->update($request->all(), $id);
                $user = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->where('contacts.id', '=', $contact -> id)->select('name')->get();
        
                DB::table('contacts')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('contact_updates')->insert(['datetime' => $now, 'contact_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'contact_u', 'user_id' => $user_id, 'entity_id' => $contact -> id, 'created_at' => $now]);
            
                Flash::success('Contact updated successfully.');
                return redirect(route('contacts.show', [$id])); 
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
            $contact = $this->contactRepository->findWithoutFail($id);
            $user = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->where('contacts.id', '=', $contact -> id)->select('name', 'user_id')->get();
    
            if(empty($contact))
            {
                Flash::error('Contact not found');
                return redirect(route('homes.index'));
            }
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactRepository->delete($id);
                $user = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->where('contacts.id', '=', $contact -> id)->select('name')->get();
               
                DB::table('contact_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_id' => $contact -> id]);
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'contact_d', 'user_id' => $user_id, 'entity_id' => $contact -> id, 'created_at' => $now]);
            
                Flash::success('Contact deleted successfully.');
                return redirect(route('homes.index'));
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