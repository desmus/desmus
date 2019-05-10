<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSNoteTodolistUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSNoteTodolistUpdateRequest;
use App\Repositories\PersonalDataTSNoteTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSNoteTodolistUpdateController extends AppBaseController
{
    private $personalDataTSNoteTodolistUpdateRepository;

    public function __construct(PersonalDataTSNoteTodolistUpdateRepository $personalDataTSNoteTodolistUpdateRepo)
    {
        $this->personalDataTSNoteTodolistUpdateRepository = $personalDataTSNoteTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSNoteTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSNoteTodolistUpdates = $this->personalDataTSNoteTodolistUpdateRepository->all();
    
            return view('personal_data_t_s_note_todolist_updates.index')
                ->with('personalDataTSNoteTodolistUpdates', $personalDataTSNoteTodolistUpdates);
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
            return view('personal_data_t_s_note_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSNoteTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSNoteTodolistUpdate = $this->personalDataTSNoteTodolistUpdateRepository->create($input);
    
            Flash::success('PersonalData T S Note Todolist Update saved successfully.');
            return redirect(route('personalDataTSNoteTodolistUpdates.index'));
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
            $personalDataTSNoteTodolistUpdate = $this->personalDataTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistUpdate))
            {
                Flash::error('PersonalData T S Note Todolist Update not found');
                return redirect(route('personalDataTSNoteTodolistUpdates.index'));
            }
    
            if($personalDataTSNoteTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_note_todolist_updates.show')->with('personalDataTSNoteTodolistUpdate', $personalDataTSNoteTodolistUpdate);
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
            $personalDataTSNoteTodolistUpdate = $this->personalDataTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistUpdate))
            {
                Flash::error('PersonalData T S Note Todolist Update not found');
                return redirect(route('personalDataTSNoteTodolistUpdates.index'));
            }
    
            if($personalDataTSNoteTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_note_todolist_updates.edit')->with('personalDataTSNoteTodolistUpdate', $personalDataTSNoteTodolistUpdate);
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

    public function update($id, UpdatePersonalDataTSNoteTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSNoteTodolistUpdate = $this->personalDataTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistUpdate))
            {
                Flash::error('PersonalData T S Note Todolist Update not found');
                return redirect(route('personalDataTSNoteTodolistUpdates.index'));
            }
            
            if($personalDataTSNoteTodolistUpdate -> user_id == $user_id)
            {
                $personalDataTSNoteTodolistUpdate = $this->personalDataTSNoteTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Note Todolist Update updated successfully.');
                return redirect(route('personalDataTSNoteTodolistUpdates.index'));
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
            $personalDataTSNoteTodolistUpdate = $this->personalDataTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistUpdate))
            {
                Flash::error('PersonalData T S Note Todolist Update not found');
                return redirect(route('personalDataTSNoteTodolistUpdates.index'));
            }
            
            if($personalDataTSNoteTodolistUpdate -> user_id == $user_id)
            {
                $this->personalDataTSNoteTodolistUpdateRepository->delete($id);
            
                Flash::success('PersonalData T S Note Todolist Update deleted successfully.');
                return redirect(route('personalDataTSNoteTodolistUpdates.index'));
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