<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryTodolistDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryTodolistDeleteRequest;
use App\Repositories\PersonalDataTSGaleryTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryTodolistDeleteController extends AppBaseController
{
    private $personalDataTSGaleryTodolistDeleteRepository;

    public function __construct(PersonalDataTSGaleryTodolistDeleteRepository $personalDataTSGaleryTodolistDeleteRepo)
    {
        $this->personalDataTSGaleryTodolistDeleteRepository = $personalDataTSGaleryTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryTodolistDeletes = $this->personalDataTSGaleryTodolistDeleteRepository->all();
    
            return view('personal_data_t_s_galery_todolist_deletes.index')
                ->with('personalDataTSGaleryTodolistDeletes', $personalDataTSGaleryTodolistDeletes);
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
           return view('personal_data_t_s_galery_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSGaleryTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSGaleryTodolistDelete = $this->personalDataTSGaleryTodolistDeleteRepository->create($input);
    
            Flash::success('PersonalData T S Galery Todolist Delete saved successfully.');
            return redirect(route('personalDataTSGaleryTodolistDeletes.index'));
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
            $personalDataTSGaleryTodolistDelete = $this->personalDataTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistDelete))
            {
                Flash::error('PersonalData T S Galery Todolist Delete not found');
                return redirect(route('personalDataTSGaleryTodolistDeletes.index'));
            }
            
            if($personalDataTSGaleryTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_galery_todolist_deletes.show')->with('personalDataTSGaleryTodolistDelete', $personalDataTSGaleryTodolistDelete);
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
            $personalDataTSGaleryTodolistDelete = $this->personalDataTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistDelete))
            {
                Flash::error('PersonalData T S Galery Todolist Delete not found');
                return redirect(route('personalDataTSGaleryTodolistDeletes.index'));
            }
    
            if($personalDataTSGaleryTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_galery_todolist_deletes.edit')->with('personalDataTSGaleryTodolistDelete', $personalDataTSGaleryTodolistDelete);
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

    public function update($id, UpdatePersonalDataTSGaleryTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryTodolistDelete = $this->personalDataTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistDelete))
            {
                Flash::error('PersonalData T S Galery Todolist Delete not found');
                return redirect(route('personalDataTSGaleryTodolistDeletes.index'));
            }
            
            if($personalDataTSGaleryTodolistDelete -> user_id == $user_id)
            {
                $personalDataTSGaleryTodolistDelete = $this->personalDataTSGaleryTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery Todolist Delete updated successfully.');
                return redirect(route('personalDataTSGaleryTodolistDeletes.index'));
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
            $personalDataTSGaleryTodolistDelete = $this->personalDataTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistDelete))
            {
                Flash::error('PersonalData T S Galery Todolist Delete not found');
                return redirect(route('personalDataTSGaleryTodolistDeletes.index'));
            }
    
            if($personalDataTSGaleryTodolistDelete -> user_id == $user_id)
            {
                $this->personalDataTSGaleryTodolistDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S Galery Todolist Delete deleted successfully.');
                return redirect(route('personalDataTSGaleryTodolistDeletes.index'));
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