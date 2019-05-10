<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryTodolistUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryTodolistUpdateRequest;
use App\Repositories\PersonalDataTSGaleryTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryTodolistUpdateController extends AppBaseController
{
    private $personalDataTSGaleryTodolistUpdateRepository;

    public function __construct(PersonalDataTSGaleryTodolistUpdateRepository $personalDataTSGaleryTodolistUpdateRepo)
    {
        $this->personalDataTSGaleryTodolistUpdateRepository = $personalDataTSGaleryTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryTodolistUpdates = $this->personalDataTSGaleryTodolistUpdateRepository->all();
    
            return view('personal_data_t_s_galery_todolist_updates.index')
                ->with('personalDataTSGaleryTodolistUpdates', $personalDataTSGaleryTodolistUpdates);
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
            return view('personal_data_t_s_galery_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSGaleryTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSGaleryTodolistUpdate = $this->personalDataTSGaleryTodolistUpdateRepository->create($input);
    
            Flash::success('PersonalData T S Galery Todolist Update saved successfully.');
            return redirect(route('personalDataTSGaleryTodolistUpdates.index'));
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
            $personalDataTSGaleryTodolistUpdate = $this->personalDataTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistUpdate))
            {
                Flash::error('PersonalData T S Galery Todolist Update not found');
                return redirect(route('personalDataTSGaleryTodolistUpdates.index'));
            }
            
            if($personalDataTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_galery_todolist_updates.show')->with('personalDataTSGaleryTodolistUpdate', $personalDataTSGaleryTodolistUpdate);
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
            $personalDataTSGaleryTodolistUpdate = $this->personalDataTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistUpdate))
            {
                Flash::error('PersonalData T S Galery Todolist Update not found');
                return redirect(route('personalDataTSGaleryTodolistUpdates.index'));
            }
    
            if($personalDataTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_galery_todolist_updates.edit')->with('personalDataTSGaleryTodolistUpdate', $personalDataTSGaleryTodolistUpdate);
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

    public function update($id, UpdatePersonalDataTSGaleryTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryTodolistUpdate = $this->personalDataTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistUpdate))
            {
                Flash::error('PersonalData T S Galery Todolist Update not found');
                return redirect(route('personalDataTSGaleryTodolistUpdates.index'));
            }
            
            if($personalDataTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                $personalDataTSGaleryTodolistUpdate = $this->personalDataTSGaleryTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery Todolist Update updated successfully.');
                return redirect(route('personalDataTSGaleryTodolistUpdates.index'));
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
            $personalDataTSGaleryTodolistUpdate = $this->personalDataTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistUpdate))
            {
                Flash::error('PersonalData T S Galery Todolist Update not found');
                return redirect(route('personalDataTSGaleryTodolistUpdates.index'));
            }
    
            if($personalDataTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                $this->personalDataTSGaleryTodolistUpdateRepository->delete($id);
            
                Flash::success('PersonalData T S Galery Todolist Update deleted successfully.');
                return redirect(route('personalDataTSGaleryTodolistUpdates.index'));
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