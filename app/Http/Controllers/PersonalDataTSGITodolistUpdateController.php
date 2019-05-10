<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGITodolistUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSGITodolistUpdateRequest;
use App\Repositories\PersonalDataTSGITodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGITodolistUpdateController extends AppBaseController
{
    private $personalDataTSGITodolistUpdateRepository;

    public function __construct(PersonalDataTSGITodolistUpdateRepository $personalDataTSGITodolistUpdateRepo)
    {
        $this->personalDataTSGITodolistUpdateRepository = $personalDataTSGITodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGITodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGITodolistUpdates = $this->personalDataTSGITodolistUpdateRepository->all();
    
            return view('personal_data_t_s_g_i_todolist_updates.index')
                ->with('personalDataTSGITodolistUpdates', $personalDataTSGITodolistUpdates);
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
            return view('personal_data_t_s_g_i_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSGITodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSGITodolistUpdate = $this->personalDataTSGITodolistUpdateRepository->create($input);
    
            Flash::success('PersonalData T S G Image Todolist Update saved successfully.');
            return redirect(route('personalDataTSGITodolistUpdates.index'));
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
            $personalDataTSGITodolistUpdate = $this->personalDataTSGITodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistUpdate))
            {
                Flash::error('PersonalData T S G Image Todolist Update not found');
                return redirect(route('personalDataTSGITodolistUpdates.index'));
            }
            
            if($personalDataTSGITodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_g_i_todolist_updates.show')->with('personalDataTSGITodolistUpdate', $personalDataTSGITodolistUpdate);
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
            $personalDataTSGITodolistUpdate = $this->personalDataTSGITodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistUpdate))
            {
                Flash::error('PersonalData T S G Image Todolist Update not found');
                return redirect(route('personalDataTSGITodolistUpdates.index'));
            }
            
            if($personalDataTSGITodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_g_i_todolist_updates.edit')->with('personalDataTSGITodolistUpdate', $personalDataTSGITodolistUpdate);
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

    public function update($id, UpdatePersonalDataTSGITodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGITodolistUpdate = $this->personalDataTSGITodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistUpdate))
            {
                Flash::error('PersonalData T S G Image Todolist Update not found');
                return redirect(route('personalDataTSGITodolistUpdates.index'));
            }
            
            if($personalDataTSGITodolistUpdate -> user_id == $user_id)
            {
                $personalDataTSGITodolistUpdate = $this->personalDataTSGITodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S G Image Todolist Update updated successfully.');
                return redirect(route('personalDataTSGITodolistUpdates.index'));
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
            $personalDataTSGITodolistUpdate = $this->personalDataTSGITodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistUpdate))
            {
                Flash::error('PersonalData T S G Image Todolist Update not found');
                return redirect(route('personalDataTSGITodolistUpdates.index'));
            }
    
            if($personalDataTSGITodolistUpdate -> user_id == $user_id)
            {
                $this->personalDataTSGITodolistUpdateRepository->delete($id);
            
                Flash::success('PersonalData T S G Image Todolist Update deleted successfully.');
                return redirect(route('personalDataTSGITodolistUpdates.index'));
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