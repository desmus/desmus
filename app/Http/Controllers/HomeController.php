<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\CalendarEvent;
use Illuminate\Support\Carbon;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getEvents()
    {
        $user_id = Auth::user()->id;
        $events = CalendarEvent::where('user_id', '=', $user_id)->select("id", "name as title", "start_date as start", "finish_date as end", "color")->get()->toArray();
    
        return response()->json($events);
    }

    public function index(Request $request)
    {
        if(Auth::user() != null)
        {
            $recent_activity_p = $request -> recent_activity_p;
            $r_message_p = $request -> r_message_p;
            $s_message_p = $request -> s_message_p;
            $contact_p = $request -> contact_p;
            
            $user_id = Auth::user()->id;
            $now = Carbon::now();
            
            $contacts = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->orderBy('name', 'asc')->paginate(50, ['*'], 'contact_p');
            $r_messages = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->paginate(50, ['*'], 'r_message_p');
            $s_messages = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->paginate(50, ['*'], 's_message_p');
            $t_messages = DB::table('users')->join('messages',function($join){$join->on('users.id','=','messages.s_user_id'); $join->orOn('users.id','=','messages.d_user_id');})->where('users.id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '!=', null);})->orderBy('messages.datetime', 'desc')->get();
            $count_r_messages = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->count();
            $count_s_messages = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->count();
            $count_t_messages = DB::table('users')->join('messages',function($join){$join->on('users.id','=','messages.s_user_id'); $join->orOn('users.id','=','messages.d_user_id');})->where('users.id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '!=', null);})->count();
            $recent_activities = DB::table('recent_activities')->join('users', 'users.id', '=', 'recent_activities.user_id')->where('recent_activities.user_id', '=', $user_id)->select('recent_activities.id', 'recent_activities.name', 'recent_activities.status', 'recent_activities.type', 'recent_activities.entity_id', 'recent_activities.user_id', 'recent_activities.created_at', 'users.name AS username')->orderBy('created_at', 'desc')->paginate(200, ['*'], 'recent_activity_p');
            
            $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('calendar_events.deleted_at', '=', null);})->limit(10)->orderBy('id', 'desc')->get();
            $r_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('d_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
            $s_messages_list = DB::table('users')->join('messages', 'messages.d_user_id', '=', 'users.id')->where('s_user_id', '=', $user_id)->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->orderBy('messages.datetime', 'desc')->limit(5)->get();
            $contacts_list = DB::table('users')->join('contacts', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->select('users.name', 'users.email', 'users.image_type', 'contacts.id', 'contacts.contact_id')->orderBy('contacts.created_at', 'desc')->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->limit(10)->get();
            
            $user = DB::table('users')->where('id', '=', $user_id)->get();
            
            return view('home')
                ->with('user_id', $user_id)->with('contacts', $contacts)
                ->with('now', $now)
                ->with('r_messages', $r_messages)
                ->with('s_messages', $s_messages)
                ->with('t_messages', $t_messages)
                ->with('count_r_messages', $count_r_messages)
                ->with('count_s_messages', $count_s_messages)
                ->with('count_t_messages', $count_t_messages)
                ->with('recent_activities', $recent_activities)
                ->with('recent_activity_p', $recent_activity_p)
                ->with('r_message_p', $r_message_p)
                ->with('s_message_p', $s_message_p)
                ->with('contact_p', $contact_p)
                ->with('user', $user)
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
}