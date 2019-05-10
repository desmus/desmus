<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolTodolistDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSToolTodolistDeleteRequest;
use App\Repositories\PersonalDataTSToolTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolTodolistDeleteController extends AppBaseController
{
    private $personalDataTSToolTodolistDeleteRepository;

    public function __construct(PersonalDataTSToolTodolistDeleteRepository $personalDataTSToolTodolistDeleteRepo)
    {
        $this->personalDataTSToolTodolistDeleteRepository = $personalDataTSToolTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolTodolistDeletes = $this->personalDataTSToolTodolistDeleteRepository->all();
    
            return view('personal_data_t_s_tool_todolist_deletes.index')
                ->with('personalDataTSToolTodolistDeletes', $personalDataTSToolTodolistDeletes);
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
            return view('personal_data_t_s_tool_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSToolTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSToolTodolistDelete = $this->personalDataTSToolTodolistDeleteRepository->create($input);
    
            Flash::success('PersonalData T S Tool Todolist Delete saved successfully.');
            return redirect(route('personalDataTSToolTodolistDeletes.index'));
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
            $personalDataTSToolTodolistDelete = $this->personalDataTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistDelete))
            {
                Flash::error('PersonalData T S Tool Todolist Delete not found');
                return redirect(route('personalDataTSToolTodolistDeletes.index'));
            }
            
            if($personalDataTSToolTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_tool_todolist_deletes.show')->with('personalDataTSToolTodolistDelete', $personalDataTSToolTodolistDelete);
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
            $personalDataTSToolTodolistDelete = $this->personalDataTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistDelete))
            {
                Flash::error('PersonalData T S Tool Todolist Delete not found');
                return redirect(route('personalDataTSToolTodolistDeletes.index'));
            }
            
            if($personalDataTSToolTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_tool_todolist_deletes.edit')->with('personalDataTSToolTodolistDelete', $personalDataTSToolTodolistDelete);
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

    public function update($id, UpdatePersonalDataTSToolTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolTodolistDelete = $this->personalDataTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistDelete))
            {
                Flash::error('PersonalData T S Tool Todolist Delete not found');
                return redirect(route('personalDataTSToolTodolistDeletes.index'));
            }
    
            if($personalDataTSToolTodolistDelete -> user_id == $user_id)
            {
                $personalDataTSToolTodolistDelete = $this->personalDataTSToolTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool Todolist Delete updated successfully.');
                return redirect(route('personalDataTSToolTodolistDeletes.index'));
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
            $personalDataTSToolTodolistDelete = $this->personalDataTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistDelete))
            {
                Flash::error('PersonalData T S Tool Todolist Delete not found');
                return redirect(route('personalDataTSToolTodolistDeletes.index'));
            }
    
            if($personalDataTSToolTodolistDelete -> user_id == $user_id)
            {
                $this->personalDataTSToolTodolistDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S Tool Todolist Delete deleted successfully.');
                return redirect(route('personalDataTSToolTodolistDeletes.index'));
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