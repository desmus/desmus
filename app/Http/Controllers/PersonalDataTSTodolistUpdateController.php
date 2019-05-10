<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSTodolistUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSTodolistUpdateRequest;
use App\Repositories\PersonalDataTSTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSTodolistUpdateController extends AppBaseController
{
    private $personalDataTSTodolistUpdateRepository;

    public function __construct(PersonalDataTSTodolistUpdateRepository $personalDataTSTodolistUpdateRepo)
    {
        $this->personalDataTSTodolistUpdateRepository = $personalDataTSTodolistUpdateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSTodolistUpdates = $this->personalDataTSTodolistUpdateRepository->all();
    
            return view('personal_data_t_s_todolist_updates.index')
                ->with('personalDataTSTodolistUpdates', $personalDataTSTodolistUpdates);
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
            return view('personal_data_t_s_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(UpdatePersonalDataTSTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSTodolistUpdate = $this->personalDataTSTodolistUpdateRepository->create($input);
    
            Flash::success('PersonalData Topic Section Todolist Update saved successfully.');
            return redirect(route('personalDataTSTodolistUpdates.index'));
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
            $personalDataTSTodolistUpdate = $this->personalDataTSTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistUpdate))
            {
                Flash::error('PersonalData Topic Section Todolist Update not found');
                return redirect(route('personalDataTSTodolistUpdates.index'));
            }
            
            if($personalDataTSTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_todolist_updates.show')
                    ->with('personalDataTSTodolistUpdate', $personalDataTSTodolistUpdate);
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
            $personalDataTSTodolistUpdate = $this->personalDataTSTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistUpdate))
            {
                Flash::error('PersonalData Topic Section Todolist Update not found');
                return redirect(route('personalDataTSTodolistUpdates.index'));
            }
    
            if($personalDataTSTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_todolist_updates.edit')
                    ->with('personalDataTSTodolistUpdate', $personalDataTSTodolistUpdate);
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

    public function update($id, UpdatePersonalDataTSTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSTodolistUpdate = $this->personalDataTSTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistUpdate))
            {
                Flash::error('PersonalData Topic Section Todolist Update not found');
                return redirect(route('personalDataTSTodolistUpdates.index'));
            }
    
            if($personalDataTSTodolistUpdate -> user_id == $user_id)
            {
                $personalDataTSTodolistUpdate = $this->personalDataTSTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Section Todolist Update updated successfully.');
                return redirect(route('personalDataTSTodolistUpdates.index'));
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
            $personalDataTSTodolistUpdate = $this->personalDataTSTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistUpdate))
            {
                Flash::error('PersonalData Topic Section Todolist Update not found');
                return redirect(route('personalDataTSTodolistUpdates.index'));
            }
    
            if($personalDataTSTodolistUpdate -> user_id == $user_id)
            {
                $this->personalDataTSTodolistUpdateRepository->delete($id);
            
                Flash::success('PersonalData Topic Section Todolist Update deleted successfully.');
                return redirect(route('personalDataTSTodolistUpdates.index'));
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