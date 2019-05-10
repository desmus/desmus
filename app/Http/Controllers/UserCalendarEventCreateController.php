<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCalendarEventCreateRequest;
use App\Http\Requests\UpdateUserCalendarEventCreateRequest;
use App\Repositories\UserCalendarEventCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCalendarEventCreateController extends AppBaseController
{
    private $userCalendarEventCreateRepository;

    public function __construct(UserCalendarEventCreateRepository $userCalendarEventCreateRepo)
    {
        $this->userCalendarEventCreateRepository = $userCalendarEventCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCalendarEventCreateRepository->pushCriteria(new RequestCriteria($request));
            $userCalendarEventCreates = $this->userCalendarEventCreateRepository->all();
    
            return view('user_calendar_event_t_s_file_cs.index')
                ->with('userCalendarEventCreates', $userCalendarEventCreates);
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
            return view('user_calendar_event_t_s_file_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCalendarEventCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userCalendarEventCreate = $this->userCalendarEventCreateRepository->create($input);
            
                Flash::success('User Calendar Event Create saved successfully.');
                return redirect(route('userCalendarEventCreates.index'));
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

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCalendarEventCreate = $this->userCalendarEventCreateRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventCreate))
            {
                Flash::error('User Calendar Event Create not found');
                return redirect(route('userCalendarEventCreates.index'));
            }
    
            if($userCalendarEventCreate -> user_id == $user_id)
            {
                return view('user_calendar_event_t_s_file_cs.show')
                    ->with('userCalendarEventCreate', $userCalendarEventCreate);
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
            $userCalendarEventCreate = $this->userCalendarEventCreateRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventCreate))
            {
                Flash::error('User Calendar Event Create not found');
                return redirect(route('userCalendarEventCreates.index'));
            }
    
            if($userCalendarEventCreate -> user_id == $user_id)
            {
                return view('user_calendar_event_t_s_file_cs.edit')
                    ->with('userCalendarEventCreate', $userCalendarEventCreate);
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

    public function update($id, UpdateUserCalendarEventCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $userCalendarEventCreate = $this->userCalendarEventCreateRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventCreate))
            {
                Flash::error('User Calendar Event Create not found');
                return redirect(route('userCalendarEventCreates.index'));
            }
    
            if($userCalendarEventCreate -> user_id == $user_id)
            {
                $userCalendarEventCreate = $this->userCalendarEventCreateRepository->update($request->all(), $id);
            
                Flash::success('User Calendar Event Create updated successfully.');
                return redirect(route('userCalendarEventCreates.index'));
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
            $userCalendarEventCreate = $this->userCalendarEventCreateRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventCreate))
            {
                Flash::error('User Calendar Event Create not found');
                return redirect(route('userCalendarEventCreates.index'));
            }
    
            if($userCalendarEventCreate -> user_id == $user_id)
            {
                $this->userCalendarEventCreateRepository->delete($id);
            
                Flash::success('User Calendar Event Create deleted successfully.');
                return redirect(route('userCalendarEventCreates.index'));
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