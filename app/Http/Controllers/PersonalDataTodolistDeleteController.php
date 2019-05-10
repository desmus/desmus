<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTodolistDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTodolistDeleteRequest;
use App\Repositories\PersonalDataTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTodolistDeleteController extends AppBaseController
{
    private $personalDataTodolistDeleteRepository;

    public function __construct(PersonalDataTodolistDeleteRepository $personalDataTodolistDeleteRepo)
    {
        $this->personalDataTodolistDeleteRepository = $personalDataTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTodolistDeletes = $this->personalDataTodolistDeleteRepository->all();
    
            return view('personal_data_todolist_deletes.index')
                ->with('personalDataTodolistDeletes', $personalDataTodolistDeletes);
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
            return view('personal_data_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTodolistDelete = $this->personalDataTodolistDeleteRepository->delete($input);
    
            Flash::success('PersonalData Todolist Delete saved successfully.');
            return redirect(route('personalDataTodolistDeletes.index'));
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
            $personalDataTodolistDelete = $this->personalDataTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistDelete))
            {
                Flash::error('PersonalData Todolist Delete not found');
                return redirect(route('personalDataTodolistDeletes.index'));
            }
            
            if($personalDataTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_todolist_deletes.show')
                    ->with('personalDataTodolistDelete', $personalDataTodolistDelete);
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
            $personalDataTodolistDelete = $this->personalDataTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistDelete))
            {
                Flash::error('PersonalData Todolist Delete not found');
                return redirect(route('personalDataTodolistDeletes.index'));
            }
    
            if($personalDataTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_todolist_deletes.edit')->with('personalDataTodolistDelete', $personalDataTodolistDelete);
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

    public function update($id, UpdatePersonalDataTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTodolistDelete = $this->personalDataTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistDelete))
            {
                Flash::error('PersonalData Todolist Delete not found');
                return redirect(route('personalDataTodolistDeletes.index'));
            }
    
            if($personalDataTodolistDelete -> user_id == $user_id)
            {
                $personalDataTodolistDelete = $this->personalDataTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Todolist Delete updated successfully.');
                return redirect(route('personalDataTodolistDeletes.index'));
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
            $personalDataTodolistDelete = $this->personalDataTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistDelete))
            {
                Flash::error('PersonalData Todolist Delete not found');
                return redirect(route('personalDataTodolistDeletes.index'));
            }
            
            if($personalDataTodolistDelete -> user_id == $user_id)
            {
                $this->personalDataTodolistDeleteRepository->delete($id);
            
                Flash::success('PersonalData Todolist Delete deleted successfully.');
                return redirect(route('personalDataTodolistDeletes.index'));
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