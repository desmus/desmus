<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGITodolistDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSGITodolistDeleteRequest;
use App\Repositories\PersonalDataTSGITodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGITodolistDeleteController extends AppBaseController
{
    private $personalDataTSGITodolistDeleteRepository;

    public function __construct(PersonalDataTSGITodolistDeleteRepository $personalDataTSGITodolistDeleteRepo)
    {
        $this->personalDataTSGITodolistDeleteRepository = $personalDataTSGITodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGITodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGITodolistDeletes = $this->personalDataTSGITodolistDeleteRepository->all();
    
            return view('personal_data_t_s_g_i_todolist_deletes.index')
                ->with('personalDataTSGITodolistDeletes', $personalDataTSGITodolistDeletes);
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
            return view('personal_data_t_s_g_i_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSGITodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSGITodolistDelete = $this->personalDataTSGITodolistDeleteRepository->create($input);
    
            Flash::success('PersonalData T S G Image Todolist Delete saved successfully.');
            return redirect(route('personalDataTSGITodolistDeletes.index'));
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
            $personalDataTSGITodolistDelete = $this->personalDataTSGITodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistDelete))
            {
                Flash::error('PersonalData T S G Image Todolist Delete not found');
                return redirect(route('personalDataTSGITodolistDeletes.index'));
            }
            
            if($personalDataTSGITodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_g_i_todolist_deletes.show')->with('personalDataTSGITodolistDelete', $personalDataTSGITodolistDelete);
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
            $personalDataTSGITodolistDelete = $this->personalDataTSGITodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistDelete))
            {
                Flash::error('PersonalData T S G Image Todolist Delete not found');
                return redirect(route('personalDataTSGITodolistDeletes.index'));
            }
            
            if($personalDataTSGITodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_g_i_todolist_deletes.edit')->with('personalDataTSGITodolistDelete', $personalDataTSGITodolistDelete);
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

    public function update($id, UpdatePersonalDataTSGITodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGITodolistDelete = $this->personalDataTSGITodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistDelete))
            {
                Flash::error('PersonalData T S G Image Todolist Delete not found');
                return redirect(route('personalDataTSGITodolistDeletes.index'));
            }
            
            if($personalDataTSGITodolistDelete -> user_id == $user_id)
            {
                $personalDataTSGITodolistDelete = $this->personalDataTSGITodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S G Image Todolist Delete updated successfully.');
                return redirect(route('personalDataTSGITodolistDeletes.index'));
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
            $personalDataTSGITodolistDelete = $this->personalDataTSGITodolistDeleteRepository->findWithoutFail($id);
    
            if (empty($personalDataTSGITodolistDelete))
            {
                Flash::error('PersonalData T S G Image Todolist Delete not found');
                return redirect(route('personalDataTSGITodolistDeletes.index'));
            }
    
            if($personalDataTSGITodolistDelete -> user_id == $user_id)
            {
                $this->personalDataTSGITodolistDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S G Image Todolist Delete deleted successfully.');
                return redirect(route('personalDataTSGITodolistDeletes.index'));
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