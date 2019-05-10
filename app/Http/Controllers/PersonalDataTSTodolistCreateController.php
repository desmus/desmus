<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSTodolistCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSTodolistCreateRequest;
use App\Repositories\PersonalDataTSTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSTodolistCreateController extends AppBaseController
{
    private $personalDataTSTodolistCreateRepository;

    public function __construct(PersonalDataTSTodolistCreateRepository $personalDataTSTodolistCreateRepo)
    {
        $this->personalDataTSTodolistCreateRepository = $personalDataTSTodolistCreateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSTodolistCreates = $this->personalDataTSTodolistCreateRepository->all();
    
            return view('personal_data_t_s_todolist_creates.index')
                ->with('personalDataTSTodolistCreates', $personalDataTSTodolistCreates);
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
            return view('personal_data_t_s_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(CreatePersonalDataTSTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSTodolistCreate = $this->personalDataTSTodolistCreateRepository->create($input);
    
            Flash::success('PersonalData Topic Section Todolist Create saved successfully.');
            return redirect(route('personalDataTSTodolistCreates.index'));
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
            $personalDataTSTodolistCreate = $this->personalDataTSTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistCreate))
            {
                Flash::error('PersonalData Topic Section Todolist Create not found');
                return redirect(route('personalDataTSTodolistCreates.index'));
            }
            
            if($personalDataTSTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_todolist_creates.show')
                    ->with('personalDataTSTodolistCreate', $personalDataTSTodolistCreate);
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
            $personalDataTSTodolistCreate = $this->personalDataTSTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistCreate))
            {
                Flash::error('PersonalData Topic Section Todolist Create not found');
                return redirect(route('personalDataTSTodolistCreates.index'));
            }
    
            if($personalDataTSTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_todolist_creates.edit')
                    ->with('personalDataTSTodolistCreate', $personalDataTSTodolistCreate);
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

    public function update($id, UpdatePersonalDataTSTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSTodolistCreate = $this->personalDataTSTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistCreate))
            {
                Flash::error('PersonalData Topic Section Todolist Create not found');
                return redirect(route('personalDataTSTodolistCreates.index'));
            }
    
            if($personalDataTSTodolistCreate -> user_id == $user_id)
            {
                $personalDataTSTodolistCreate = $this->personalDataTSTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Section Todolist Create updated successfully.');
                return redirect(route('personalDataTSTodolistCreates.index'));
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
            $personalDataTSTodolistCreate = $this->personalDataTSTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistCreate))
            {
                Flash::error('PersonalData Topic Section Todolist Create not found');
                return redirect(route('personalDataTSTodolistCreates.index'));
            }
    
            if($personalDataTSTodolistCreate -> user_id == $user_id)
            {
                $this->personalDataTSTodolistCreateRepository->delete($id);
            
                Flash::success('PersonalData Topic Section Todolist Create deleted successfully.');
                return redirect(route('personalDataTSTodolistCreates.index'));
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