<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCalendarEventUpdateRequest;
use App\Http\Requests\UpdateUserCalendarEventUpdateRequest;
use App\Repositories\UserCalendarEventUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCalendarEventUpdateController extends AppBaseController
{
    private $userCalendarEventUpdateRepository;

    public function __construct(UserCalendarEventUpdateRepository $userCalendarEventUpdateRepo)
    {
        $this->userCalendarEventUpdateRepository = $userCalendarEventUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCalendarEventUpdateRepository->pushCriteria(new RequestCriteria($request));
            $userCalendarEventUpdates = $this->userCalendarEventUpdateRepository->all();
    
            return view('user_calendar_event_updates.index')
                ->with('userCalendarEventUpdates', $userCalendarEventUpdates);
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
            return view('user_calendar_event_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCalendarEventUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCalendarEventUpdate = $this->userCalendarEventUpdateRepository->create($input);
            }
            
            else
            {
                return view('deniedAccess');
            }
    
            Flash::success('User Calendar Event Update saved successfully.');
            return redirect(route('userCalendarEventUpdates.index'));
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
            $userCalendarEventUpdate = $this->userCalendarEventUpdateRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventUpdate))
            {
                Flash::error('User Calendar Event Update not found');
                return redirect(route('userCalendarEventUpdates.index'));
            }
            
            if($userCalendarEventUpdate -> user_id == $user_id)
            {
                return view('user_calendar_event_updates.show')
                    ->with('userCalendarEventUpdate', $userCalendarEventUpdate);
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
            $userCalendarEventUpdate = $this->userCalendarEventUpdateRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventUpdate))
            {
                Flash::error('User Calendar Event Update not found');
                return redirect(route('userCalendarEventUpdates.index'));
            }
    
            if($userCalendarEventUpdate -> user_id == $user_id)
            {
                return view('user_calendar_event_updates.edit')
                    ->with('userCalendarEventUpdate', $userCalendarEventUpdate);
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

    public function update($id, UpdateUserCalendarEventUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCalendarEventUpdate = $this->userCalendarEventUpdateRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventUpdate))
            {
                Flash::error('User Calendar Event Update not found');
                return redirect(route('userCalendarEventUpdates.index'));
            }
    
            if($userCalendarEventUpdate -> user_id == $user_id)
            {
                $userCalendarEventUpdate = $this->userCalendarEventUpdateRepository->update($request->all(), $id);
            
                Flash::success('User Calendar Event Update updated successfully.');
                return redirect(route('userCalendarEventUpdates.index'));
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
            $userCalendarEventUpdate = $this->userCalendarEventUpdateRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventUpdate))
            {
                Flash::error('User Calendar Event Update not found');
                return redirect(route('userCalendarEventUpdates.index'));
            }
    
            if($userCalendarEventUpdate -> user_id == $user_id)
            {
                $this->userCalendarEventUpdateRepository->delete($id);
            
                Flash::success('User Calendar Event Update deleted successfully.');
                return redirect(route('userCalendarEventUpdates.index'));
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