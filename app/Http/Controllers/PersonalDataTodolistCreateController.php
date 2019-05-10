<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTodolistCreateRequest;
use App\Http\Requests\UpdatePersonalDataTodolistCreateRequest;
use App\Repositories\PersonalDataTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTodolistCreateController extends AppBaseController
{
    private $personalDataTodolistCreateRepository;

    public function __construct(PersonalDataTodolistCreateRepository $personalDataTodolistCreateRepo)
    {
        $this->personalDataTodolistCreateRepository = $personalDataTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTodolistCreates = $this->personalDataTodolistCreateRepository->all();
    
            return view('personal_data_todolist_creates.index')
                ->with('personalDataTodolistCreates', $personalDataTodolistCreates);
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
            return view('personal_data_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTodolistCreate = $this->personalDataTodolistCreateRepository->create($input);
    
            Flash::success('PersonalData Todolist Create saved successfully.');
            return redirect(route('personalDataTodolistCreates.index'));
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
            $personalDataTodolistCreate = $this->personalDataTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistCreate))
            {
                Flash::error('PersonalData Todolist Create not found');
                return redirect(route('personalDataTodolistCreates.index'));
            }
            
            if($personalDataTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_todolist_creates.show')
                    ->with('personalDataTodolistCreate', $personalDataTodolistCreate);
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
            $personalDataTodolistCreate = $this->personalDataTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistCreate))
            {
                Flash::error('PersonalData Todolist Create not found');
                return redirect(route('personalDataTodolistCreates.index'));
            }
    
            if($personalDataTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_todolist_creates.edit')->with('personalDataTodolistCreate', $personalDataTodolistCreate);
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

    public function update($id, UpdatePersonalDataTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTodolistCreate = $this->personalDataTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistCreate))
            {
                Flash::error('PersonalData Todolist Create not found');
                return redirect(route('personalDataTodolistCreates.index'));
            }
    
            if($personalDataTodolistCreate -> user_id == $user_id)
            {
                $personalDataTodolistCreate = $this->personalDataTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Todolist Create updated successfully.');
                return redirect(route('personalDataTodolistCreates.index'));
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
            $personalDataTodolistCreate = $this->personalDataTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistCreate))
            {
                Flash::error('PersonalData Todolist Create not found');
                return redirect(route('personalDataTodolistCreates.index'));
            }
            
            if($personalDataTodolistCreate -> user_id == $user_id)
            {
                $this->personalDataTodolistCreateRepository->delete($id);
            
                Flash::success('PersonalData Todolist Create deleted successfully.');
                return redirect(route('personalDataTodolistCreates.index'));
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