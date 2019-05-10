<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSTFTodolistDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSTFTodolistDeleteRequest;
use App\Repositories\PersonalDataTSTFTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSTFTodolistDeleteController extends AppBaseController
{
    private $personalDataTSTFTodolistDeleteRepository;

    public function __construct(PersonalDataTSTFTodolistDeleteRepository $personalDataTSTFTodolistDeleteRepo)
    {
        $this->personalDataTSTFTodolistDeleteRepository = $personalDataTSTFTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSTFTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSTFTodolistDeletes = $this->personalDataTSTFTodolistDeleteRepository->all();
    
            return view('personal_data_t_s_t_f_todolist_deletes.index')
                ->with('personalDataTSTFTodolistDeletes', $personalDataTSTFTodolistDeletes);
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
            return view('personal_data_t_s_t_f_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSTFTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSTFTodolistDelete = $this->personalDataTSTFTodolistDeleteRepository->create($input);
    
            Flash::success('PersonalData T S Tool File Todolist Delete saved successfully.');
            return redirect(route('personalDataTSTFTodolistDeletes.index'));
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
            $personalDataTSTFTodolistDelete = $this->personalDataTSTFTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistDelete))
            {
                Flash::error('PersonalData T S Tool File Todolist Delete not found');
                return redirect(route('personalDataTSTFTodolistDeletes.index'));
            }
    
            if($personalDataTSTFTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_t_f_todolist_deletes.show')->with('personalDataTSTFTodolistDelete', $personalDataTSTFTodolistDelete);
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
            $personalDataTSTFTodolistDelete = $this->personalDataTSTFTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistDelete))
            {
                Flash::error('PersonalData T S Tool File Todolist Delete not found');
                return redirect(route('personalDataTSTFTodolistDeletes.index'));
            }
    
            if($personalDataTSTFTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_t_f_todolist_deletes.edit')->with('personalDataTSTFTodolistDelete', $personalDataTSTFTodolistDelete);
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

    public function update($id, UpdatePersonalDataTSTFTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSTFTodolistDelete = $this->personalDataTSTFTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistDelete))
            {
                Flash::error('PersonalData T S Tool File Todolist Delete not found');
                return redirect(route('personalDataTSTFTodolistDeletes.index'));
            }
            
            if($personalDataTSTFTodolistDelete -> user_id == $user_id)
            {
                $personalDataTSTFTodolistDelete = $this->personalDataTSTFTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool File Todolist Delete updated successfully.');
                return redirect(route('personalDataTSTFTodolistDeletes.index'));
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
            $personalDataTSTFTodolistDelete = $this->personalDataTSTFTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistDelete))
            {
                Flash::error('PersonalData T S Tool File Todolist Delete not found');
                return redirect(route('personalDataTSTFTodolistDeletes.index'));
            }
    
            if($personalDataTSTFTodolistDelete -> user_id == $user_id)
            {
                $this->personalDataTSTFTodolistDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S Tool File Todolist Delete deleted successfully.');
                return redirect(route('personalDataTSTFTodolistDeletes.index'));
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