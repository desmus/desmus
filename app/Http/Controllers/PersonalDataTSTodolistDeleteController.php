<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSTodolistDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSTodolistDeleteRequest;
use App\Repositories\PersonalDataTSTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSTodolistDeleteController extends AppBaseController
{
    private $personalDataTSTodolistDeleteRepository;

    public function __construct(PersonalDataTSTodolistDeleteRepository $personalDataTSTodolistDeleteRepo)
    {
        $this->personalDataTSTodolistDeleteRepository = $personalDataTSTodolistDeleteRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSTodolistDeletes = $this->personalDataTSTodolistDeleteRepository->all();
    
            return view('personal_data_t_s_todolist_deletes.index')
                ->with('personalDataTSTodolistDeletes', $personalDataTSTodolistDeletes);
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
            return view('personal_data_t_s_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(DeletePersonalDataTSTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSTodolistDelete = $this->personalDataTSTodolistDeleteRepository->create($input);
    
            Flash::success('PersonalData Topic Section Todolist Delete saved successfully.');
            return redirect(route('personalDataTSTodolistDeletes.index'));
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
            $personalDataTSTodolistDelete = $this->personalDataTSTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistDelete))
            {
                Flash::error('PersonalData Topic Section Todolist Delete not found');
                return redirect(route('personalDataTSTodolistDeletes.index'));
            }
            
            if($personalDataTSTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_todolist_deletes.show')
                    ->with('personalDataTSTodolistDelete', $personalDataTSTodolistDelete);
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
            $personalDataTSTodolistDelete = $this->personalDataTSTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistDelete))
            {
                Flash::error('PersonalData Topic Section Todolist Delete not found');
                return redirect(route('personalDataTSTodolistDeletes.index'));
            }
    
            if($personalDataTSTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_todolist_deletes.edit')
                    ->with('personalDataTSTodolistDelete', $personalDataTSTodolistDelete);
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

    public function update($id, UpdatePersonalDataTSTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSTodolistDelete = $this->personalDataTSTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistDelete))
            {
                Flash::error('PersonalData Topic Section Todolist Delete not found');
                return redirect(route('personalDataTSTodolistDeletes.index'));
            }
    
            if($personalDataTSTodolistDelete -> user_id == $user_id)
            {
                $personalDataTSTodolistDelete = $this->personalDataTSTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Section Todolist Delete updated successfully.');
                return redirect(route('personalDataTSTodolistDeletes.index'));
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
            $personalDataTSTodolistDelete = $this->personalDataTSTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistDelete))
            {
                Flash::error('PersonalData Topic Section Todolist Delete not found');
                return redirect(route('personalDataTSTodolistDeletes.index'));
            }
    
            if($personalDataTSTodolistDelete -> user_id == $user_id)
            {
                $this->personalDataTSTodolistDeleteRepository->delete($id);
            
                Flash::success('PersonalData Topic Section Todolist Delete deleted successfully.');
                return redirect(route('personalDataTSTodolistDeletes.index'));
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