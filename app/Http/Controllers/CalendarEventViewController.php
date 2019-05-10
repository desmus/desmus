<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCalendarEventViewRequest;
use App\Http\Requests\UpdateCalendarEventViewRequest;
use App\Repositories\CalendarEventViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CalendarEventViewController extends AppBaseController
{
    private $calendarEventViewRepository;

    public function __construct(CalendarEventViewRepository $calendarEventViewRepo)
    {
        $this->calendarEventViewRepository = $calendarEventViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->calendarEventViewRepository->pushCriteria(new RequestCriteria($request));
            $calendarEventViews = $this->calendarEventViewRepository->all();
    
            return view('calendar_event_views.index')
                ->with('calendarEventViews', $calendarEventViews);
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
            return view('calendar_event_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCalendarEventViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $calendarEventView = $this->calendarEventViewRepository->create($input);
    
            Flash::success('Calendar Event View saved successfully.');
            return redirect(route('calendarEventViews.index'));
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
            $calendarEventView = $this->calendarEventViewRepository->findWithoutFail($id);
    
            if(empty($calendarEventView))
            {
                Flash::error('Calendar Event View not found');
                return redirect(route('calendarEventViews.index'));
            }
            
            if($calendarEventView -> user_id == $user_id)
            {
                return view('calendar_event_views.show')->with('calendarEventView', $calendarEventView);
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
            $calendarEventView = $this->calendarEventViewRepository->findWithoutFail($id);
    
            if(empty($calendarEventView))
            {
                Flash::error('Calendar Event View not found');
                return redirect(route('calendarEventViews.index'));
            }
    
            if($calendarEventView -> user_id == $user_id)
            {
                return view('calendar_event_views.edit')->with('calendarEventView', $calendarEventView);
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

    public function update($id, UpdateCalendarEventViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $calendarEventView = $this->calendarEventViewRepository->findWithoutFail($id);
    
            if(empty($calendarEventView))
            {
                Flash::error('Calendar Event View not found');
                return redirect(route('calendarEventViews.index'));
            }
    
            if($calendarEventView -> user_id == $user_id)
            {
                $calendarEventView = $this->calendarEventViewRepository->update($request->all(), $id);
            
                Flash::success('Calendar Event View updated successfully.');
                return redirect(route('calendarEventViews.index'));
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
            $calendarEventView = $this->calendarEventViewRepository->findWithoutFail($id);
    
            if(empty($calendarEventView))
            {
                Flash::error('Calendar Event View not found');
                return redirect(route('calendarEventViews.index'));
            }
    
            if($calendarEventView -> user_id == $user_id)
            {
                $this->calendarEventViewRepository->delete($id);
            
                Flash::success('Calendar Event View deleted successfully.');
                return redirect(route('calendarEventViews.index'));
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