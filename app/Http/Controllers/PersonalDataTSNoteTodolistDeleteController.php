<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSNoteTodolistDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSNoteTodolistDeleteRequest;
use App\Repositories\PersonalDataTSNoteTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSNoteTodolistDeleteController extends AppBaseController
{
    private $personalDataTSNoteTodolistDeleteRepository;

    public function __construct(PersonalDataTSNoteTodolistDeleteRepository $personalDataTSNoteTodolistDeleteRepo)
    {
        $this->personalDataTSNoteTodolistDeleteRepository = $personalDataTSNoteTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSNoteTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSNoteTodolistDeletes = $this->personalDataTSNoteTodolistDeleteRepository->all();
    
            return view('personal_data_t_s_note_todolist_deletes.index')
                ->with('personalDataTSNoteTodolistDeletes', $personalDataTSNoteTodolistDeletes);
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
            return view('personal_data_t_s_note_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSNoteTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSNoteTodolistDelete = $this->personalDataTSNoteTodolistDeleteRepository->create($input);
    
            Flash::success('PersonalData T S Note Todolist Delete saved successfully.');
            return redirect(route('personalDataTSNoteTodolistDeletes.index'));
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
            $personalDataTSNoteTodolistDelete = $this->personalDataTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistDelete))
            {
                Flash::error('PersonalData T S Note Todolist Delete not found');
                return redirect(route('personalDataTSNoteTodolistDeletes.index'));
            }
    
            if($personalDataTSNoteTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_note_todolist_deletes.show')->with('personalDataTSNoteTodolistDelete', $personalDataTSNoteTodolistDelete);
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
            $personalDataTSNoteTodolistDelete = $this->personalDataTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistDelete))
            {
                Flash::error('PersonalData T S Note Todolist Delete not found');
                return redirect(route('personalDataTSNoteTodolistDeletes.index'));
            }
    
            if($personalDataTSNoteTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_note_todolist_deletes.edit')->with('personalDataTSNoteTodolistDelete', $personalDataTSNoteTodolistDelete);
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

    public function update($id, UpdatePersonalDataTSNoteTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSNoteTodolistDelete = $this->personalDataTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistDelete))
            {
                Flash::error('PersonalData T S Note Todolist Delete not found');
                return redirect(route('personalDataTSNoteTodolistDeletes.index'));
            }
            
            if($personalDataTSNoteTodolistDelete -> user_id == $user_id)
            {
                $personalDataTSNoteTodolistDelete = $this->personalDataTSNoteTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Note Todolist Delete updated successfully.');
                return redirect(route('personalDataTSNoteTodolistDeletes.index'));
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
            $personalDataTSNoteTodolistDelete = $this->personalDataTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistDelete))
            {
                Flash::error('PersonalData T S Note Todolist Delete not found');
                return redirect(route('personalDataTSNoteTodolistDeletes.index'));
            }
            
            if($personalDataTSNoteTodolistDelete -> user_id == $user_id)
            {
                $this->personalDataTSNoteTodolistDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S Note Todolist Delete deleted successfully.');
                return redirect(route('personalDataTSNoteTodolistDeletes.index'));
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