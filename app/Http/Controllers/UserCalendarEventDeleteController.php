<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCalendarEventDeleteRequest;
use App\Http\Requests\UpdateUserCalendarEventDeleteRequest;
use App\Repositories\UserCalendarEventDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCalendarEventDeleteController extends AppBaseController
{
    private $userCalendarEventDeleteRepository;

    public function __construct(UserCalendarEventDeleteRepository $userCalendarEventDeleteRepo)
    {
        $this->userCalendarEventDeleteRepository = $userCalendarEventDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCalendarEventDeleteRepository->pushCriteria(new RequestCriteria($request));
            $userCalendarEventDeletes = $this->userCalendarEventDeleteRepository->all();
    
            return view('user_calendar_event_deletes.index')
                ->with('userCalendarEventDeletes', $userCalendarEventDeletes);
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
            return view('user_calendar_event_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCalendarEventDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCalendarEventDelete = $this->userCalendarEventDeleteRepository->create($input);
            
                Flash::success('User Calendar Event Delete saved successfully.');
                return redirect(route('userCalendarEventDeletes.index'));
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
            $userCalendarEventDelete = $this->userCalendarEventDeleteRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventDelete))
            {
                Flash::error('User Calendar Event Delete not found');
                return redirect(route('userCalendarEventDeletes.index'));
            }
            
            if($userCalendarEventDelete -> user_id == $user_id)
            {
                return view('user_calendar_event_deletes.show')
                    ->with('userCalendarEventDelete', $userCalendarEventDelete);
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
            $userCalendarEventDelete = $this->userCalendarEventDeleteRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventDelete))
            {
                Flash::error('User Calendar Event Delete not found');
                return redirect(route('userCalendarEventDeletes.index'));
            }
    
            if($userCalendarEventDelete -> user_id == $user_id)
            {
                return view('user_calendar_event_deletes.edit')
                    ->with('userCalendarEventDelete', $userCalendarEventDelete);
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

    public function update($id, UpdateUserCalendarEventDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCalendarEventDelete = $this->userCalendarEventDeleteRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventDelete))
            {
                Flash::error('User Calendar Event Delete not found');
                return redirect(route('userCalendarEventDeletes.index'));
            }
    
            if($userCalendarEventDelete -> user_id == $user_id)
            {
                $userCalendarEventDelete = $this->userCalendarEventDeleteRepository->update($request->all(), $id);
            
                Flash::success('User Calendar Event Delete updated successfully.');
                return redirect(route('userCalendarEventDeletes.index'));
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
            $userCalendarEventDelete = $this->userCalendarEventDeleteRepository->findWithoutFail($id);
    
            if(empty($userCalendarEventDelete))
            {
                Flash::error('User Calendar Event Delete not found');
                return redirect(route('userCalendarEventDeletes.index'));
            }
    
            if($userCalendarEventDelete -> user_id == $user_id)
            {
                $this->userCalendarEventDeleteRepository->delete($id);
            
                Flash::success('User Calendar Event Delete deleted successfully.');
                return redirect(route('userCalendarEventDeletes.index'));
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