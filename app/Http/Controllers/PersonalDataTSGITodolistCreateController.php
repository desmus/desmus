<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGITodolistCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSGITodolistCreateRequest;
use App\Repositories\PersonalDataTSGITodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGITodolistCreateController extends AppBaseController
{
    private $personalDataTSGITodolistCreateRepository;

    public function __construct(PersonalDataTSGITodolistCreateRepository $personalDataTSGITodolistCreateRepo)
    {
        $this->personalDataTSGITodolistCreateRepository = $personalDataTSGITodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGITodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGITodolistCreates = $this->personalDataTSGITodolistCreateRepository->all();
    
            return view('personal_data_t_s_g_i_todolist_creates.index')
                ->with('personalDataTSGITodolistCreates', $personalDataTSGITodolistCreates);
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
            return view('personal_data_t_s_g_i_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSGITodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSGITodolistCreate = $this->personalDataTSGITodolistCreateRepository->create($input);
    
            Flash::success('PersonalData T S G Image Todolist Create saved successfully.');
            return redirect(route('personalDataTSGITodolistCreates.index'));
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
            $personalDataTSGITodolistCreate = $this->personalDataTSGITodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistCreate))
            {
                Flash::error('PersonalData T S G Image Todolist Create not found');
                return redirect(route('personalDataTSGITodolistCreates.index'));
            }
            
            if($personalDataTSGITodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_g_i_todolist_creates.show')->with('personalDataTSGITodolistCreate', $personalDataTSGITodolistCreate);
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
            $personalDataTSGITodolistCreate = $this->personalDataTSGITodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistCreate))
            {
                Flash::error('PersonalData T S G Image Todolist Create not found');
                return redirect(route('personalDataTSGITodolistCreates.index'));
            }
            
            if($personalDataTSGITodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_g_i_todolist_creates.edit')->with('personalDataTSGITodolistCreate', $personalDataTSGITodolistCreate);
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

    public function update($id, UpdatePersonalDataTSGITodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGITodolistCreate = $this->personalDataTSGITodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistCreate))
            {
                Flash::error('PersonalData T S G Image Todolist Create not found');
                return redirect(route('personalDataTSGITodolistCreates.index'));
            }
            
            if($personalDataTSGITodolistCreate -> user_id == $user_id)
            {
                $personalDataTSGITodolistCreate = $this->personalDataTSGITodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S G Image Todolist Create updated successfully.');
                return redirect(route('personalDataTSGITodolistCreates.index'));
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
            $personalDataTSGITodolistCreate = $this->personalDataTSGITodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistCreate))
            {
                Flash::error('PersonalData T S G Image Todolist Create not found');
                return redirect(route('personalDataTSGITodolistCreates.index'));
            }
    
            if($personalDataTSGITodolistCreate -> user_id == $user_id)
            {
                $this->personalDataTSGITodolistCreateRepository->delete($id);
            
                Flash::success('PersonalData T S G Image Todolist Create deleted successfully.');
                return redirect(route('personalDataTSGITodolistCreates.index'));
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