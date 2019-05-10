<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolTodolistCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSToolTodolistCreateRequest;
use App\Repositories\PersonalDataTSToolTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolTodolistCreateController extends AppBaseController
{
    private $personalDataTSToolTodolistCreateRepository;

    public function __construct(PersonalDataTSToolTodolistCreateRepository $personalDataTSToolTodolistCreateRepo)
    {
        $this->personalDataTSToolTodolistCreateRepository = $personalDataTSToolTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolTodolistCreates = $this->personalDataTSToolTodolistCreateRepository->all();
    
            return view('personal_data_t_s_tool_todolist_creates.index')
                ->with('personalDataTSToolTodolistCreates', $personalDataTSToolTodolistCreates);
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
            return view('personal_data_t_s_tool_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSToolTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSToolTodolistCreate = $this->personalDataTSToolTodolistCreateRepository->create($input);
    
            Flash::success('PersonalData T S Tool Todolist Create saved successfully.');
            return redirect(route('personalDataTSToolTodolistCreates.index'));
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
            $personalDataTSToolTodolistCreate = $this->personalDataTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistCreate))
            {
                Flash::error('PersonalData T S Tool Todolist Create not found');
                return redirect(route('personalDataTSToolTodolistCreates.index'));
            }
            
            if($personalDataTSToolTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_tool_todolist_creates.show')->with('personalDataTSToolTodolistCreate', $personalDataTSToolTodolistCreate);
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
            $personalDataTSToolTodolistCreate = $this->personalDataTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistCreate))
            {
                Flash::error('PersonalData T S Tool Todolist Create not found');
                return redirect(route('personalDataTSToolTodolistCreates.index'));
            }
            
            if($personalDataTSToolTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_tool_todolist_creates.edit')->with('personalDataTSToolTodolistCreate', $personalDataTSToolTodolistCreate);
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

    public function update($id, UpdatePersonalDataTSToolTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolTodolistCreate = $this->personalDataTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistCreate))
            {
                Flash::error('PersonalData T S Tool Todolist Create not found');
                return redirect(route('personalDataTSToolTodolistCreates.index'));
            }
    
            if($personalDataTSToolTodolistCreate -> user_id == $user_id)
            {
                $personalDataTSToolTodolistCreate = $this->personalDataTSToolTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool Todolist Create updated successfully.');
                return redirect(route('personalDataTSToolTodolistCreates.index'));
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
            $personalDataTSToolTodolistCreate = $this->personalDataTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistCreate))
            {
                Flash::error('PersonalData T S Tool Todolist Create not found');
                return redirect(route('personalDataTSToolTodolistCreates.index'));
            }
    
            if($personalDataTSToolTodolistCreate -> user_id == $user_id)
            {
                $this->personalDataTSToolTodolistCreateRepository->delete($id);
            
                Flash::success('PersonalData T S Tool Todolist Create deleted successfully.');
                return redirect(route('personalDataTSToolTodolistCreates.index'));
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