<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCalendarEventRequest;
use App\Http\Requests\UpdateUserCalendarEventRequest;
use App\Repositories\UserCalendarEventRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCalendarEventController extends AppBaseController
{
    private $userCalendarEventRepository;

    public function __construct(UserCalendarEventRepository $userCalendarEventRepo)
    {
        $this->userCalendarEventRepository = $userCalendarEventRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCalendarEventRepository->pushCriteria(new RequestCriteria($request));
            $userCalendarEvents = $this->userCalendarEventRepository->all();
    
            return view('user_calendar_events.index')
                ->with('userCalendarEvents', $userCalendarEvents);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $users = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->select('name', 'contacts.user_id', 'users.id')->where('contacts.user_id', '=', $user_id)->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->orderBy('name', 'asc')->get();
            $select = [];
                
            foreach($users as $user)
            {
                $select[$user->id] = $user->name;
            }
            
            $userCalendarEventsList = DB::table('user_calendar_events')->join('users', 'user_calendar_events.user_id', '=', 'users.id')->select('name', 'email', 'user_calendar_events.description', 'permissions', 'user_calendar_events.datetime', 'user_calendar_events.id', 'calendar_event_id', 'users.id as user_id')->where('calendar_event_id', $id)->where(function ($query) {$query->where('user_calendar_events.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $calendarEventViewsList = DB::table('users')->join('calendar_event_views', 'users.id', '=', 'calendar_event_views.user_id')->where('calendar_event_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $calendarEventUpdatesList = DB::table('users')->join('calendar_event_updates', 'users.id', '=', 'calendar_event_updates.user_id')->where('calendar_event_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_calendar_events.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userCalendarEventsList', $userCalendarEventsList)
                ->with('calendarEventViewsList', $calendarEventViewsList)
                ->with('calendarEventUpdatesList', $calendarEventUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCalendarEventRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('calendar_events')->where('calendar_events.id', '=', $request -> calendar_event_id)->get();
            
            $userCalendarEventCheck = DB::table('user_calendar_events')->where('user_id', '=', $request -> user_id)->where('calendar_event_id', '=', $request -> calendar_event_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userCalendarEventCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userCalendarEvent = $this->userCalendarEventRepository->create($input);
                    $user = DB::table('user_calendar_events')->join('users', 'users.id', '=', 'user_calendar_events.user_id')->where('user_calendar_events.id', '=', $userCalendarEvent -> id)->select('name')->get();
                   
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_e_c', 'user_id' => $user_id, 'entity_id' => $userCalendarEvent -> calendar_event_id, 'created_at' => $now]);
                    DB::table('user_calendar_event_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_e_id' => $userCalendarEvent -> id]);
                
                    Flash::success('User Calendar Event saved successfully.');
                    return redirect(route('userCalendarEvents.show', [$userCalendarEvent -> calendar_event_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userCalendarEvents.show', [$request -> calendar_event_id]));
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
            $userCalendarEvent = $this->userCalendarEventRepository->findWithoutFail($id);
            $userCalendarEvents = DB::table('user_calendar_events')->join('users', 'user_calendar_events.user_id', '=', 'users.id')->select('name', 'email', 'user_calendar_events.description', 'permissions', 'user_calendar_events.datetime', 'user_calendar_events.id', 'calendar_event_id')->where('calendar_event_id', $id)->where(function ($query) {$query->where('user_calendar_events.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userCalendarEvents[0]))
            {
                Flash::error('User Calendar Event not found');
                return redirect(route('userCalendarEvents.create', [$id]));
            }
    
            $user = DB::table('calendar_events')->where('calendar_events.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $calendarEvent = DB::table('calendar_events')->where('id', '=', $userCalendarEvents[0] -> calendar_event_id)->get();
    
                $userCalendarEventsList = DB::table('user_calendar_events')->join('users', 'user_calendar_events.user_id', '=', 'users.id')->select('name', 'email', 'user_calendar_events.description', 'permissions', 'user_calendar_events.datetime', 'user_calendar_events.id', 'calendar_event_id', 'users.id as user_id')->where('calendar_event_id', $id)->where(function ($query) {$query->where('user_calendar_events.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $calendarEventViewsList = DB::table('users')->join('calendar_event_views', 'users.id', '=', 'calendar_event_views.user_id')->where('calendar_event_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $calendarEventUpdatesList = DB::table('users')->join('calendar_event_updates', 'users.id', '=', 'calendar_event_updates.user_id')->where('calendar_event_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                
                return view('user_calendar_events.show')
                    ->with('userCalendarEvents', $userCalendarEvents)
                    ->with('id', $id)
                    ->with('calendarEvent', $calendarEvent)
                    ->with('userCalendarEventsList', $userCalendarEventsList)
                    ->with('calendarEventViewsList', $calendarEventViewsList)
                    ->with('calendarEventUpdatesList', $calendarEventUpdatesList);
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
            $userCalendarEvent = DB::table('users')->join('user_calendar_events', 'user_calendar_events.user_id', '=', 'users.id')->where('user_calendar_events.id', $id)->where(function ($query) {$query->where('user_calendar_events.deleted_at', '=', null);})->get();
    
            if(empty($userCalendarEvent[0]))
            {
                Flash::error('User Calendar Event not found');
                return redirect(route('userCalendarEvents.index'));
            }
    
            $user = DB::table('calendar_events')->where('calendar_events.id', '=', $userCalendarEvent[0] -> calendar_event_id)->get();
            
            $userCalendarEventsList = DB::table('user_calendar_events')->join('users', 'user_calendar_events.user_id', '=', 'users.id')->select('name', 'email', 'user_calendar_events.description', 'permissions', 'user_calendar_events.datetime', 'user_calendar_events.id', 'calendar_event_id', 'users.id as user_id')->where('calendar_event_id', $id)->where(function ($query) {$query->where('user_calendar_events.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $calendarEventViewsList = DB::table('users')->join('calendar_event_views', 'users.id', '=', 'calendar_event_views.user_id')->where('calendar_event_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $calendarEventUpdatesList = DB::table('users')->join('calendar_event_updates', 'users.id', '=', 'calendar_event_updates.user_id')->where('calendar_event_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                return view('user_calendar_events.edit')
                    ->with('userCalendarEvent', $userCalendarEvent)
                    ->with('id', $userCalendarEvent[0] -> calendar_event_id)
                    ->with('userCalendarEventsList', $userCalendarEventsList)
                    ->with('calendarEventViewsList', $calendarEventViewsList)
                    ->with('calendarEventUpdatesList', $calendarEventUpdatesList); 
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

    public function update($id, UpdateUserCalendarEventRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userCalendarEvent = $this->userCalendarEventRepository->findWithoutFail($id);
    
            if(empty($userCalendarEvent))
            {
                Flash::error('User Calendar Event not found');
                return redirect(route('userCalendarEvents.index'));
            }
    
            $user = DB::table('calendar_events')->where('calendar_events.id', '=', $userCalendarEvent -> calendar_event_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $userCalendarEvent = $this->userCalendarEventRepository->update($request->all(), $id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_calendar_events')->join('users', 'users.id', '=', 'user_calendar_events.user_id')->where('user_calendar_events.id', '=', $userCalendarEvent -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_e_u', 'user_id' => $user_id, 'entity_id' => $userCalendarEvent -> calendar_event_id, 'created_at' => $now]);
                DB::table('user_calendar_event_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_e_id' => $userCalendarEvent -> id]);
            
                Flash::success('User Calendar Event updated successfully.');
                return redirect(route('userCalendarEvents.show', [$userCalendarEvent -> calendar_event_id]));
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
            $userCalendarEvent = $this->userCalendarEventRepository->findWithoutFail($id);
    
            if(empty($userCalendarEvent))
            {
                Flash::error('User Calendar Event not found');
                return redirect(route('userCalendarEvents.index'));
            }
            
            $user = DB::table('calendar_events')->where('calendar_events.id', '=', $userCalendarEvent -> calendar_event_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $this->userCalendarEventRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_calendar_events')->join('users', 'users.id', '=', 'user_calendar_events.user_id')->where('user_calendar_events.id', '=', $userCalendarEvent -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_e_d', 'user_id' => $user_id, 'entity_id' => $userCalendarEvent -> calendar_event_id, 'created_at' => $now]);
                DB::table('user_calendar_event_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_e_id' => $userCalendarEvent -> id]);
            
                Flash::success('User Calendar Event deleted successfully.');
                return redirect(route('userCalendarEvents.show', [$userCalendarEvent -> calendar_event_id]));
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}