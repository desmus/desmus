<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactWebRequest;
use App\Http\Requests\UpdateContactWebRequest;
use App\Repositories\ContactWebRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactWebController extends AppBaseController
{
    private $contactWebRepository;

    public function __construct(ContactWebRepository $contactWebRepo)
    {
        $this->contactWebRepository = $contactWebRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactWebRepository->pushCriteria(new RequestCriteria($request));
            $contactWebs = $this->contactWebRepository->all();
    
            return view('contact_webs.index')
                ->with('contactWebs', $contactWebs);
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

            return view('contact_webs.create')
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

    public function store(CreateContactWebRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $contactWeb = $this->contactWebRepository->create($input);
            
            DB::table('contact_web_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_web_id' => $contactWeb -> id]);
    
            Flash::success('Contact Web saved successfully.');
            return redirect(route('contacts.show', [$contactWeb -> contact_id]));
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
            $contactWeb = $this->contactWebRepository->findWithoutFail($id);
    
            if(empty($contactWeb))
            {
                Flash::error('Contact Web not found');
                return redirect(route('contactWebs.index'));
            }
            
            $user = DB::table('contact_webs')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_webs.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_web_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_web_id' => $contactWeb -> id]);
    
                $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->limit(10)->orderBy('id', 'desc')->get();
                $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();
    
                return view('contact_webs.show')
                    ->with('contactWeb', $contactWeb)
                    ->with('id', $contactWeb -> contact_id)
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
            $user_id = Auth::user()->id;
            $contactWeb = $this->contactWebRepository->findWithoutFail($id);
    
            if(empty($contactWeb))
            {
                Flash::error('Contact Web not found');
                return redirect(route('contactWebs.index'));
            }
    
            $user = DB::table('contact_webs')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_webs.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->limit(10)->orderBy('id', 'desc')->get();
                $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
                $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();

                return view('contact_webs.edit')
                    ->with('contactWeb', $contactWeb)
                    ->with('id', $contactWeb -> contact_id)
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

    public function update($id, UpdateContactWebRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $contactWeb = $this->contactWebRepository->findWithoutFail($id);
    
            if(empty($contactWeb))
            {
                Flash::error('Contact Web not found');
                return redirect(route('contactWebs.index'));
            }
    
            $user = DB::table('contact_webs')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_webs.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_web_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_web_id' => $contactWeb -> id]);
    
                $contactWeb = $this->contactWebRepository->update($request->all(), $id);
            
                Flash::success('Contact Web updated successfully.');
                return redirect(route('contacts.show', [$contactWeb -> contact_id]));
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
            $contactWeb = $this->contactWebRepository->findWithoutFail($id);
    
            if(empty($contactWeb))
            {
                Flash::error('Contact Web not found');
                return redirect(route('contactWebs.index'));
            }
    
            $user = DB::table('contact_webs')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_webs.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                DB::table('contact_web_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'contact_web_id' => $contactWeb -> id]);
    
                $this->contactWebRepository->delete($id);
            
                Flash::success('Contact Web deleted successfully.');
                return redirect(route('contacts.show', [$contactWeb -> contact_id]));
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