<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSNoteTodolistCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSNoteTodolistCreateRequest;
use App\Repositories\PersonalDataTSNoteTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSNoteTodolistCreateController extends AppBaseController
{
    private $personalDataTSNoteTodolistCreateRepository;

    public function __construct(PersonalDataTSNoteTodolistCreateRepository $personalDataTSNoteTodolistCreateRepo)
    {
        $this->personalDataTSNoteTodolistCreateRepository = $personalDataTSNoteTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSNoteTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSNoteTodolistCreates = $this->personalDataTSNoteTodolistCreateRepository->all();
    
            return view('personal_data_t_s_note_todolist_creates.index')
                ->with('personalDataTSNoteTodolistCreates', $personalDataTSNoteTodolistCreates);
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
            return view('personal_data_t_s_note_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSNoteTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSNoteTodolistCreate = $this->personalDataTSNoteTodolistCreateRepository->create($input);
    
            Flash::success('PersonalData T S Note Todolist Create saved successfully.');
            return redirect(route('personalDataTSNoteTodolistCreates.index'));
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
            $personalDataTSNoteTodolistCreate = $this->personalDataTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistCreate))
            {
                Flash::error('PersonalData T S Note Todolist Create not found');
                return redirect(route('personalDataTSNoteTodolistCreates.index'));
            }
    
            if($personalDataTSNoteTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_note_todolist_creates.show')->with('personalDataTSNoteTodolistCreate', $personalDataTSNoteTodolistCreate);
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
            $personalDataTSNoteTodolistCreate = $this->personalDataTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistCreate))
            {
                Flash::error('PersonalData T S Note Todolist Create not found');
                return redirect(route('personalDataTSNoteTodolistCreates.index'));
            }
    
            if($personalDataTSNoteTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_note_todolist_creates.edit')->with('personalDataTSNoteTodolistCreate', $personalDataTSNoteTodolistCreate);
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

    public function update($id, UpdatePersonalDataTSNoteTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSNoteTodolistCreate = $this->personalDataTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistCreate))
            {
                Flash::error('PersonalData T S Note Todolist Create not found');
                return redirect(route('personalDataTSNoteTodolistCreates.index'));
            }
            
            if($personalDataTSNoteTodolistCreate -> user_id == $user_id)
            {
                $personalDataTSNoteTodolistCreate = $this->personalDataTSNoteTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Note Todolist Create updated successfully.');
                return redirect(route('personalDataTSNoteTodolistCreates.index'));
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
            $personalDataTSNoteTodolistCreate = $this->personalDataTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistCreate))
            {
                Flash::error('PersonalData T S Note Todolist Create not found');
                return redirect(route('personalDataTSNoteTodolistCreates.index'));
            }
            
            if($personalDataTSNoteTodolistCreate -> user_id == $user_id)
            {
                $this->personalDataTSNoteTodolistCreateRepository->delete($id);
            
                Flash::success('PersonalData T S Note Todolist Create deleted successfully.');
                return redirect(route('personalDataTSNoteTodolistCreates.index'));
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