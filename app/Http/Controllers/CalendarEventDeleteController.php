<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCalendarEventDeleteRequest;
use App\Http\Requests\UpdateCalendarEventDeleteRequest;
use App\Repositories\CalendarEventDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CalendarEventDeleteController extends AppBaseController
{
    private $calendarEventDeleteRepository;

    public function __construct(CalendarEventDeleteRepository $calendarEventDeleteRepo)
    {
        $this->calendarEventDeleteRepository = $calendarEventDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->calendarEventDeleteRepository->pushCriteria(new RequestCriteria($request));
            $calendarEventDeletes = $this->calendarEventDeleteRepository->all();

            return view('calendar_event_deletes.index')
                ->with('calendarEventDeletes', $calendarEventDeletes);
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
            return view('calendar_event_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCalendarEventDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $calendarEventDelete = $this->calendarEventDeleteRepository->create($input);

            Flash::success('Calendar Event Delete saved successfully.');
            return redirect(route('calendarEventDeletes.index'));
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
            $calendarEventDelete = $this->calendarEventDeleteRepository->findWithoutFail($id);
    
            if(empty($calendarEventDelete))
            {
                Flash::error('Calendar Event Delete not found');
                return redirect(route('calendarEventDeletes.index'));
            }
            
            if($calendarEventDelete -> user_id == $user_id)
            {
                return view('calendar_event_deletes.show')->with('calendarEventDelete', $calendarEventDelete);
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
            $calendarEventDelete = $this->calendarEventDeleteRepository->findWithoutFail($id);
    
            if(empty($calendarEventDelete))
            {
                Flash::error('Calendar Event Delete not found');
                return redirect(route('calendarEventDeletes.index'));
            }
            
            if($calendarEventDelete -> user_id == $user_id)
            {
                return view('calendar_event_deletes.edit')->with('calendarEventDelete', $calendarEventDelete);
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

    public function update($id, UpdateCalendarEventDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $calendarEventDelete = $this->calendarEventDeleteRepository->findWithoutFail($id);
    
            if(empty($calendarEventDelete))
            {
                Flash::error('Calendar Event Delete not found');
                return redirect(route('calendarEventDeletes.index'));
            }
    
            if($calendarEventDelete -> user_id == $user_id)
            {
                $calendarEventDelete = $this->calendarEventDeleteRepository->update($request->all(), $id);
            
                Flash::success('Calendar Event Delete updated successfully.');
                return redirect(route('calendarEventDeletes.index'));
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
            $calendarEventDelete = $this->calendarEventDeleteRepository->findWithoutFail($id);
    
            if(empty($calendarEventDelete))
            {
                Flash::error('Calendar Event Delete not found');
                return redirect(route('calendarEventDeletes.index'));
            }
    
            if($calendarEventDelete -> user_id == $user_id)
            {
                $this->calendarEventDeleteRepository->delete($id);
            
                Flash::success('Calendar Event Delete deleted successfully.');
                return redirect(route('calendarEventDeletes.index'));
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