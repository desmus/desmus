<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSTFTodolistUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSTFTodolistUpdateRequest;
use App\Repositories\PersonalDataTSTFTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSTFTodolistUpdateController extends AppBaseController
{
    private $personalDataTSTFTodolistUpdateRepository;

    public function __construct(PersonalDataTSTFTodolistUpdateRepository $personalDataTSTFTodolistUpdateRepo)
    {
        $this->personalDataTSTFTodolistUpdateRepository = $personalDataTSTFTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSTFTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSTFTodolistUpdates = $this->personalDataTSTFTodolistUpdateRepository->all();
    
            return view('personal_data_t_s_t_f_todolist_updates.index')
                ->with('personalDataTSTFTodolistUpdates', $personalDataTSTFTodolistUpdates);
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
            return view('personal_data_t_s_t_f_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSTFTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSTFTodolistUpdate = $this->personalDataTSTFTodolistUpdateRepository->create($input);
    
            Flash::success('PersonalData T S Tool File Todolist Update saved successfully.');
            return redirect(route('personalDataTSTFTodolistUpdates.index'));
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
            $personalDataTSTFTodolistUpdate = $this->personalDataTSTFTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistUpdate))
            {
                Flash::error('PersonalData T S Tool File Todolist Update not found');
                return redirect(route('personalDataTSTFTodolistUpdates.index'));
            }
    
            if($personalDataTSTFTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_t_f_todolist_updates.show')->with('personalDataTSTFTodolistUpdate', $personalDataTSTFTodolistUpdate);
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
            $personalDataTSTFTodolistUpdate = $this->personalDataTSTFTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistUpdate))
            {
                Flash::error('PersonalData T S Tool File Todolist Update not found');
                return redirect(route('personalDataTSTFTodolistUpdates.index'));
            }
    
            if($personalDataTSTFTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_t_f_todolist_updates.edit')->with('personalDataTSTFTodolistUpdate', $personalDataTSTFTodolistUpdate);
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

    public function update($id, UpdatePersonalDataTSTFTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSTFTodolistUpdate = $this->personalDataTSTFTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistUpdate))
            {
                Flash::error('PersonalData T S Tool File Todolist Update not found');
                return redirect(route('personalDataTSTFTodolistUpdates.index'));
            }
            
            if($personalDataTSTFTodolistUpdate -> user_id == $user_id)
            {
                $personalDataTSTFTodolistUpdate = $this->personalDataTSTFTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool File Todolist Update updated successfully.');
                return redirect(route('personalDataTSTFTodolistUpdates.index'));
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
            $personalDataTSTFTodolistUpdate = $this->personalDataTSTFTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistUpdate))
            {
                Flash::error('PersonalData T S Tool File Todolist Update not found');
                return redirect(route('personalDataTSTFTodolistUpdates.index'));
            }
    
            if($personalDataTSTFTodolistUpdate -> user_id == $user_id)
            {
                $this->personalDataTSTFTodolistUpdateRepository->delete($id);
            
                Flash::success('PersonalData T S Tool File Todolist Update deleted successfully.');
                return redirect(route('personalDataTSTFTodolistUpdates.index'));
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