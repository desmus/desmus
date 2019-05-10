<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCalendarEventUpdateRequest;
use App\Http\Requests\UpdateCalendarEventUpdateRequest;
use App\Repositories\CalendarEventUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CalendarEventUpdateController extends AppBaseController
{
    private $calendarEventUpdateRepository;

    public function __construct(CalendarEventUpdateRepository $calendarEventUpdateRepo)
    {
        $this->calendarEventUpdateRepository = $calendarEventUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->calendarEventUpdateRepository->pushCriteria(new RequestCriteria($request));
            $calendarEventUpdates = $this->calendarEventUpdateRepository->all();
    
            return view('calendar_event_updates.index')
                ->with('calendarEventUpdates', $calendarEventUpdates);
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
            return view('calendar_event_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCalendarEventUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $calendarEventUpdate = $this->calendarEventUpdateRepository->create($input);
    
            Flash::success('Calendar Event Update saved successfully.');
            return redirect(route('calendarEventUpdates.index'));
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
            $calendarEventUpdate = $this->calendarEventUpdateRepository->findWithoutFail($id);
    
            if(empty($calendarEventUpdate))
            {
                Flash::error('Calendar Event Update not found');
                return redirect(route('calendarEventUpdates.index'));
            }
            
            if($calendarEventUpdate -> user_id == $user_id)
            {
                return view('calendar_event_updates.show')->with('calendarEventUpdate', $calendarEventUpdate);
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
            $calendarEventUpdate = $this->calendarEventUpdateRepository->findWithoutFail($id);
    
            if(empty($calendarEventUpdate))
            {
                Flash::error('Calendar Event Update not found');
                return redirect(route('calendarEventUpdates.index'));
            }
    
            if($calendarEventUpdate -> user_id == $user_id)
            {
                return view('calendar_event_updates.edit')->with('calendarEventUpdate', $calendarEventUpdate);
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

    public function update($id, UpdateCalendarEventUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $calendarEventUpdate = $this->calendarEventUpdateRepository->findWithoutFail($id);
    
            if(empty($calendarEventUpdate))
            {
                Flash::error('Calendar Event Update not found');
                return redirect(route('calendarEventUpdates.index'));
            }
    
            if($calendarEventUpdate -> user_id == $user_id)
            {
                $calendarEventUpdate = $this->calendarEventUpdateRepository->update($request->all(), $id);
            
                Flash::success('Calendar Event Update updated successfully.');
                return redirect(route('calendarEventUpdates.index'));
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
            $calendarEventUpdate = $this->calendarEventUpdateRepository->findWithoutFail($id);
    
            if(empty($calendarEventUpdate))
            {
                Flash::error('Calendar Event Update not found');
                return redirect(route('calendarEventUpdates.index'));
            }
    
            if($calendarEventUpdate -> user_id == $user_id)
            {
                $this->calendarEventUpdateRepository->delete($id);
            
                Flash::success('Calendar Event Update deleted successfully.');
                return redirect(route('calendarEventUpdates.index'));
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