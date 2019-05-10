<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCalendarEventCreateRequest;
use App\Http\Requests\UpdateCalendarEventCreateRequest;
use App\Repositories\CalendarEventCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CalendarEventCreateController extends AppBaseController
{
    private $calendarEventCreateRepository;

    public function __construct(CalendarEventCreateRepository $calendarEventCreateRepo)
    {
        $this->calendarEventCreateRepository = $calendarEventCreateRepo;
    }
        
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->calendarEventCreateRepository->pushCriteria(new RequestCriteria($request));
            $calendarEventCreates = $this->calendarEventCreateRepository->all();
    
            return view('calendar_event_creates.index')
                ->with('calendarEventCreates', $calendarEventCreates);
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
            return view('calendar_event_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCalendarEventCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $calendarEventCreate = $this->calendarEventCreateRepository->create($input);
    
            Flash::success('Calendar Event Create saved successfully.');
            return redirect(route('calendarEventCreates.index'));
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
            $calendarEventCreate = $this->calendarEventCreateRepository->findWithoutFail($id);
    
            if(empty($calendarEventCreate))
            {
                Flash::error('Calendar Event Create not found');
                return redirect(route('calendarEventCreates.index'));
            }
            
            if($calendarEventCreate -> user_id == $user_id)
            {
                return view('calendar_event_creates.show')
                    ->with('calendarEventCreate', $calendarEventCreate);
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
            $calendarEventCreate = $this->calendarEventCreateRepository->findWithoutFail($id);
    
            if(empty($calendarEventCreate))
            {
                Flash::error('Calendar Event Create not found');
                return redirect(route('calendarEventCreates.index'));
            }
    
            if($calendarEventCreate -> user_id == $user_id)
            {
                return view('calendar_event_creates.edit')
                    ->with('calendarEventCreate', $calendarEventCreate);
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

    public function update($id, UpdateCalendarEventCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $calendarEventCreate = $this->calendarEventCreateRepository->findWithoutFail($id);
    
            if(empty($calendarEventCreate))
            {
                Flash::error('Calendar Event Create not found');
                return redirect(route('calendarEventCreates.index'));
            }
    
            if($calendarEventCreate -> user_id == $user_id)
            {
                $calendarEventCreate = $this->calendarEventCreateRepository->update($request->all(), $id);
            
                Flash::success('Calendar Event Create updated successfully.');
                return redirect(route('calendarEventCreates.index'));
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
            $calendarEventCreate = $this->calendarEventCreateRepository->findWithoutFail($id);
    
            if(empty($calendarEventCreate))
            {
                Flash::error('Calendar Event Create not found');
                return redirect(route('calendarEventCreates.index'));
            }
    
            if($calendarEventCreate -> user_id == $user_id)
            {
                $this->calendarEventCreateRepository->delete($id);
            
                Flash::success('Calendar Event Create deleted successfully.');
                return redirect(route('calendarEventCreates.index'));
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