<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSTFTodolistCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSTFTodolistCreateRequest;
use App\Repositories\PersonalDataTSTFTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSTFTodolistCreateController extends AppBaseController
{
    private $personalDataTSTFTodolistCreateRepository;

    public function __construct(PersonalDataTSTFTodolistCreateRepository $personalDataTSTFTodolistCreateRepo)
    {
        $this->personalDataTSTFTodolistCreateRepository = $personalDataTSTFTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSTFTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSTFTodolistCreates = $this->personalDataTSTFTodolistCreateRepository->all();
    
            return view('personal_data_t_s_t_f_todolist_creates.index')
                ->with('personalDataTSTFTodolistCreates', $personalDataTSTFTodolistCreates);
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
            return view('personal_data_t_s_t_f_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSTFTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSTFTodolistCreate = $this->personalDataTSTFTodolistCreateRepository->create($input);
    
            Flash::success('PersonalData T S Tool File Todolist Create saved successfully.');
            return redirect(route('personalDataTSTFTodolistCreates.index'));
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
            $personalDataTSTFTodolistCreate = $this->personalDataTSTFTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistCreate))
            {
                Flash::error('PersonalData T S Tool File Todolist Create not found');
                return redirect(route('personalDataTSTFTodolistCreates.index'));
            }
    
            if($personalDataTSTFTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_t_f_todolist_creates.show')->with('personalDataTSTFTodolistCreate', $personalDataTSTFTodolistCreate);
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
            $personalDataTSTFTodolistCreate = $this->personalDataTSTFTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistCreate))
            {
                Flash::error('PersonalData T S Tool File Todolist Create not found');
                return redirect(route('personalDataTSTFTodolistCreates.index'));
            }
    
            if($personalDataTSTFTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_t_f_todolist_creates.edit')->with('personalDataTSTFTodolistCreate', $personalDataTSTFTodolistCreate);
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

    public function update($id, UpdatePersonalDataTSTFTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSTFTodolistCreate = $this->personalDataTSTFTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistCreate))
            {
                Flash::error('PersonalData T S Tool File Todolist Create not found');
                return redirect(route('personalDataTSTFTodolistCreates.index'));
            }
            
            if($personalDataTSTFTodolistCreate -> user_id == $user_id)
            {
                $personalDataTSTFTodolistCreate = $this->personalDataTSTFTodolistCreateRepository->update($request->all(), $id);
                
                Flash::success('PersonalData T S Tool File Todolist Create updated successfully.');
                return redirect(route('personalDataTSTFTodolistCreates.index'));
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
            $personalDataTSTFTodolistCreate = $this->personalDataTSTFTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistCreate))
            {
                Flash::error('PersonalData T S Tool File Todolist Create not found');
                return redirect(route('personalDataTSTFTodolistCreates.index'));
            }
    
            if($personalDataTSTFTodolistCreate -> user_id == $user_id)
            {
                $this->personalDataTSTFTodolistCreateRepository->delete($id);
            
                Flash::success('PersonalData T S Tool File Todolist Create deleted successfully.');
                return redirect(route('personalDataTSTFTodolistCreates.index'));
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