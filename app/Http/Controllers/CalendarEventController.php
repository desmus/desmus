<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCalendarEventRequest;
use App\Http\Requests\UpdateCalendarEventRequest;
use App\Repositories\CalendarEventRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\CalendarEvent;
use Illuminate\Support\Carbon;

class CalendarEventController extends AppBaseController
{
    private $calendarEventRepository;

    public function __construct(CalendarEventRepository $calendarEventRepo)
    {
        $this->calendarEventRepository = $calendarEventRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->calendarEventRepository->pushCriteria(new RequestCriteria($request));
            $calendarEvents = $this->calendarEventRepository->all();

            return view('calendar_events.index')
                ->with('calendarEvents', $calendarEvents);
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
            return view('calendar_events.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCalendarEventRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            $input['start_date'] = $input['start_date'].' '.$input['start_time'];
            $input['finish_date'] = $input['finish_date'].' '.$input['finish_time'];
    
            $calendarEvent = $this->calendarEventRepository->create($input);
            
            DB::table('calendar_event_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'calendar_event_id' => $calendarEvent -> id, 'created_at' => $now]);
            DB::table('recent_activities')->insert(['name' => $calendarEvent -> name, 'status' => 'active', 'type' => 'c_e_c', 'user_id' => $user_id, 'entity_id' => $calendarEvent -> id, 'created_at' => $now]);
    
            Flash::success('Calendar Event saved successfully.');
            return redirect(route('homes.index'));
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
            $calendarEvent = $this->calendarEventRepository->findWithoutFail($id);
            
            if(empty($calendarEvent))
            {
                Flash::error('Calendar Event not found');
                return redirect(route('homes.index'));
            }
            
            $userCalendarEvents = DB::table('user_calendar_events')->where('calendar_event_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCalendarEvents as $userCalendarEvent)
            {
                if($userCalendarEvent -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($calendarEvent -> user_id == $user_id || $isShared)
            {
                DB::table('calendar_event_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'calendar_event_id' => $id]);
                DB::table('calendar_events')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
    
                $calendarEvent = $this->calendarEventRepository->findWithoutFail($id);
                $calendarEventViews = DB::table('users')->join('calendar_event_views', 'users.id', '=', 'calendar_event_views.user_id')->where('calendar_event_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $calendarEventUpdates = DB::table('users')->join('calendar_event_updates', 'users.id', '=', 'calendar_event_updates.user_id')->where('calendar_event_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                
                $user = DB::table('calendar_events')->join('users', 'calendar_events.user_id', '=', 'users.id')->where('calendar_events.id', '=', $id)->get();
                
                $userCalendarEventsList = DB::table('user_calendar_events')->join('users', 'user_calendar_events.user_id', '=', 'users.id')->select('name', 'email', 'user_calendar_events.description', 'permissions', 'user_calendar_events.datetime', 'user_calendar_events.id', 'calendar_event_id', 'users.id as user_id')->where('calendar_event_id', $id)->where(function ($query) {$query->where('user_calendar_events.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $calendarEventViewsList = DB::table('users')->join('calendar_event_views', 'users.id', '=', 'calendar_event_views.user_id')->where('calendar_event_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $calendarEventUpdatesList = DB::table('users')->join('calendar_event_updates', 'users.id', '=', 'calendar_event_updates.user_id')->where('calendar_event_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                
                $timestamp = $calendarEvent -> start_date;
                $start_date = explode(" ",$timestamp);
                
                $s_date = $start_date[0];
                $s_time = substr($start_date[1], 0, 5);
                
                $timestamp = $calendarEvent -> finish_date;
                $end_date = explode(" ",$timestamp);
                
                $e_date = $end_date[0];
                $e_time = substr($end_date[1], 0, 5);
                
                return view('calendar_events.show')
                    ->with('calendarEvent', $calendarEvent)
                    ->with('calendarEventViews', $calendarEventViews)
                    ->with('calendarEventUpdates', $calendarEventUpdates)
                    ->with('user', $user)
                    ->with('user_id', $user_id)
                    ->with('s_date', $s_date)
                    ->with('s_time', $s_time)
                    ->with('e_date', $e_date)
                    ->with('e_time', $e_time)
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
            $calendarEvent = $this->calendarEventRepository->findWithoutFail($id);
    
            if(empty($calendarEvent))
            {
                Flash::error('Calendar Event not found');
                return redirect(route('calendarEvents.index'));
            }
            
            $userCalendarEvents = DB::table('user_calendar_events')->where('calendar_event_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCalendarEvents as $userCalendarEvent)
            {
                if($userCalendarEvent -> user_id == $user_id && $userCalendarEvent -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
    
            if($calendarEvent -> user_id == $user_id || $isShared)
            {
                return view('calendar_events.edit')
                    ->with('calendarEvent', $calendarEvent);
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

    public function update($id, UpdateCalendarEventRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $calendarEvent = $this->calendarEventRepository->findWithoutFail($id);
    
            if(empty($calendarEvent))
            {
                Flash::error('Calendar Event not found');
                return redirect(route('homes.index'));
            }
            
            $userCalendarEvents = DB::table('user_calendar_events')->where('calendar_event_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCalendarEvents as $userCalendarEvent)
            {
                if($userCalendarEvent -> user_id == $user_id && $userCalendarEvent -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($calendarEvent -> user_id == $user_id || $isShared)
            {
                $input = $request->all();
                
                $input['start_date'] = $input['start_date'].' '.$input['start_time'];
                $input['finish_date'] = $input['finish_date'].' '.$input['finish_time'];
        
                $newCalendarEvent = $this->calendarEventRepository->update($input, $id);
        
                DB::table('calendar_events')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('calendar_event_updates')->insert(['actual_name' => $newCalendarEvent -> name, 'past_name' => $calendarEvent -> name, 'datetime' => $now, 'calendar_event_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $calendarEvent -> name, 'status' => 'active', 'type' => 'c_e_u', 'user_id' => $user_id, 'entity_id' => $calendarEvent -> id, 'created_at' => $now]);
            
                Flash::success('Calendar Event updated successfully.');
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

    public function destroy($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $calendarEvent = $this->calendarEventRepository->findWithoutFail($id);
            
            if(empty($calendarEvent))
            {
                Flash::error('Calendar Event not found');
                return redirect(route('homes.index'));
            }
            
            if($calendarEvent -> user_id == $user_id)
            {
                $this->calendarEventRepository->delete($id);
                
                DB::table('calendar_event_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'calendar_event_id' => $calendarEvent -> id]);
                DB::table('recent_activities')->insert(['name' => $calendarEvent -> name, 'status' => 'active', 'type' => 'c_e_d', 'user_id' => $user_id, 'entity_id' => $calendarEvent -> id, 'created_at' => $now]);
            
                Flash::success('Calendar Event deleted successfully.');
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