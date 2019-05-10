<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactSocialRequest;
use App\Http\Requests\UpdateContactSocialRequest;
use App\Repositories\ContactSocialRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactSocialController extends AppBaseController
{
    private $contactSocialRepository;

    public function __construct(ContactSocialRepository $contactSocialRepo)
    {
        $this->contactSocialRepository = $contactSocialRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactSocialRepository->pushCriteria(new RequestCriteria($request));
            $contactSocials = $this->contactSocialRepository->all();
    
            return view('contact_socials.index')
                ->with('contactSocials', $contactSocials);
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

            return view('contact_socials.create')
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
    
    public function store(CreateContactSocialRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $contactSocial = $this->contactSocialRepository->create($input);
            
            DB::table('contact_social_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_social_id' => $contactSocial -> id]);
    
            Flash::success('Contact Social saved successfully.');
            return redirect(route('contacts.show', [$contactSocial -> contact_id]));
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
            $contactSocial = $this->contactSocialRepository->findWithoutFail($id);
    
            if(empty($contactSocial))
            {
                Flash::error('Contact Social not found');
                return redirect(route('contactSocials.index'));
            }
            
            $user = DB::table('contact_socials')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_socials.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_social_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_social_id' => $contactSocial -> id]);
                
                $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->limit(10)->orderBy('id', 'desc')->get();
                $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();
    
                return view('contact_socials.show')
                    ->with('contactSocial', $contactSocial)
                    ->with('id', $contactSocial -> contact_id)
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
            $contactSocial = $this->contactSocialRepository->findWithoutFail($id);
    
            if(empty($contactSocial))
            {
                Flash::error('Contact Social not found');
                return redirect(route('contactSocials.index'));
            }
    
            $user = DB::table('contact_socials')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_socials.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->limit(10)->orderBy('id', 'desc')->get();
                $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();

                return view('contact_socials.edit')
                    ->with('contactSocial', $contactSocial)
                    ->with('id', $contactSocial -> contact_id)
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

    public function update($id, UpdateContactSocialRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contactSocial = $this->contactSocialRepository->findWithoutFail($id);
    
            if(empty($contactSocial))
            {
                Flash::error('Contact Social not found');
                return redirect(route('contactSocials.index'));
            }
    
            $user = DB::table('contact_socials')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_socials.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_social_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_social_id' => $contactSocial -> id]);
    
                $contactSocial = $this->contactSocialRepository->update($request->all(), $id);
            
                Flash::success('Contact Social updated successfully.');
                return redirect(route('contacts.show', [$contactSocial -> contact_id]));
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
            $contactSocial = $this->contactSocialRepository->findWithoutFail($id);
    
            if(empty($contactSocial))
            {
                Flash::error('Contact Social not found');
                return redirect(route('contactSocials.index'));
            }
    
            $user = DB::table('contact_socials')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_socials.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_social_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_social_id' => $contactSocial -> id]);
    
                $this->contactSocialRepository->delete($id);
            
                Flash::success('Contact Social deleted successfully.');
                return redirect(route('contacts.show', [$contactSocial -> contact_id]));
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