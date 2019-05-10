<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTodolistUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTodolistUpdateRequest;
use App\Repositories\PersonalDataTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTodolistUpdateController extends AppBaseController
{
    private $personalDataTodolistUpdateRepository;

    public function __construct(PersonalDataTodolistUpdateRepository $personalDataTodolistUpdateRepo)
    {
        $this->personalDataTodolistUpdateRepository = $personalDataTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTodolistUpdates = $this->personalDataTodolistUpdateRepository->all();
    
            return view('personal_data_todolist_updates.index')
                ->with('personalDataTodolistUpdates', $personalDataTodolistUpdates);
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
            return view('personal_data_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTodolistUpdate = $this->personalDataTodolistUpdateRepository->update($input);
    
            Flash::success('PersonalData Todolist Update saved successfully.');
            return redirect(route('personalDataTodolistUpdates.index'));
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
            $personalDataTodolistUpdate = $this->personalDataTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistUpdate))
            {
                Flash::error('PersonalData Todolist Update not found');
                return redirect(route('personalDataTodolistUpdates.index'));
            }
            
            if($personalDataTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_todolist_updates.show')
                    ->with('personalDataTodolistUpdate', $personalDataTodolistUpdate);
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
            $personalDataTodolistUpdate = $this->personalDataTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistUpdate))
            {
                Flash::error('PersonalData Todolist Update not found');
                return redirect(route('personalDataTodolistUpdates.index'));
            }
    
            if($personalDataTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_todolist_updates.edit')->with('personalDataTodolistUpdate', $personalDataTodolistUpdate);
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

    public function update($id, UpdatePersonalDataTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTodolistUpdate = $this->personalDataTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistUpdate))
            {
                Flash::error('PersonalData Todolist Update not found');
                return redirect(route('personalDataTodolistUpdates.index'));
            }
    
            if($personalDataTodolistUpdate -> user_id == $user_id)
            {
                $personalDataTodolistUpdate = $this->personalDataTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Todolist Update updated successfully.');
                return redirect(route('personalDataTodolistUpdates.index'));
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
            $personalDataTodolistUpdate = $this->personalDataTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistUpdate))
            {
                Flash::error('PersonalData Todolist Update not found');
                return redirect(route('personalDataTodolistUpdates.index'));
            }
            
            if($personalDataTodolistUpdate -> user_id == $user_id)
            {
                $this->personalDataTodolistUpdateRepository->delete($id);
            
                Flash::success('PersonalData Todolist Update deleted successfully.');
                return redirect(route('personalDataTodolistUpdates.index'));
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