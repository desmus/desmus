<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolTodolistUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSToolTodolistUpdateRequest;
use App\Repositories\PersonalDataTSToolTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolTodolistUpdateController extends AppBaseController
{
    private $personalDataTSToolTodolistUpdateRepository;

    public function __construct(PersonalDataTSToolTodolistUpdateRepository $personalDataTSToolTodolistUpdateRepo)
    {
        $this->personalDataTSToolTodolistUpdateRepository = $personalDataTSToolTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolTodolistUpdates = $this->personalDataTSToolTodolistUpdateRepository->all();
    
            return view('personal_data_t_s_tool_todolist_updates.index')
                ->with('personalDataTSToolTodolistUpdates', $personalDataTSToolTodolistUpdates);
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
            return view('personal_data_t_s_tool_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSToolTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSToolTodolistUpdate = $this->personalDataTSToolTodolistUpdateRepository->create($input);
    
            Flash::success('PersonalData T S Tool Todolist Update saved successfully.');
            return redirect(route('personalDataTSToolTodolistUpdates.index'));
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
            $personalDataTSToolTodolistUpdate = $this->personalDataTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistUpdate))
            {
                Flash::error('PersonalData T S Tool Todolist Update not found');
                return redirect(route('personalDataTSToolTodolistUpdates.index'));
            }
            
            if($personalDataTSToolTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_tool_todolist_updates.show')->with('personalDataTSToolTodolistUpdate', $personalDataTSToolTodolistUpdate);
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
            $personalDataTSToolTodolistUpdate = $this->personalDataTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistUpdate))
            {
                Flash::error('PersonalData T S Tool Todolist Update not found');
                return redirect(route('personalDataTSToolTodolistUpdates.index'));
            }
            
            if($personalDataTSToolTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_tool_todolist_updates.edit')->with('personalDataTSToolTodolistUpdate', $personalDataTSToolTodolistUpdate);
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

    public function update($id, UpdatePersonalDataTSToolTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolTodolistUpdate = $this->personalDataTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistUpdate))
            {
                Flash::error('PersonalData T S Tool Todolist Update not found');
                return redirect(route('personalDataTSToolTodolistUpdates.index'));
            }
    
            if($personalDataTSToolTodolistUpdate -> user_id == $user_id)
            {
                $personalDataTSToolTodolistUpdate = $this->personalDataTSToolTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool Todolist Update updated successfully.');
                return redirect(route('personalDataTSToolTodolistUpdates.index'));
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
            $personalDataTSToolTodolistUpdate = $this->personalDataTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistUpdate))
            {
                Flash::error('PersonalData T S Tool Todolist Update not found');
                return redirect(route('personalDataTSToolTodolistUpdates.index'));
            }
    
            if($personalDataTSToolTodolistUpdate -> user_id == $user_id)
            {
                $this->personalDataTSToolTodolistUpdateRepository->delete($id);
            
                Flash::success('PersonalData T S Tool Todolist Update deleted successfully.');
                return redirect(route('personalDataTSToolTodolistUpdates.index'));
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