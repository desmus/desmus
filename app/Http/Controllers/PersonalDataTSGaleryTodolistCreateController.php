<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryTodolistCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryTodolistCreateRequest;
use App\Repositories\PersonalDataTSGaleryTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryTodolistCreateController extends AppBaseController
{
    private $personalDataTSGaleryTodolistCreateRepository;

    public function __construct(PersonalDataTSGaleryTodolistCreateRepository $personalDataTSGaleryTodolistCreateRepo)
    {
        $this->personalDataTSGaleryTodolistCreateRepository = $personalDataTSGaleryTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryTodolistCreates = $this->personalDataTSGaleryTodolistCreateRepository->all();
    
            return view('personal_data_t_s_galery_todolist_creates.index')
                ->with('personalDataTSGaleryTodolistCreates', $personalDataTSGaleryTodolistCreates);
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
            return view('personal_data_t_s_galery_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSGaleryTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSGaleryTodolistCreate = $this->personalDataTSGaleryTodolistCreateRepository->create($input);
    
            Flash::success('PersonalData T S Galery Todolist Create saved successfully.');
            return redirect(route('personalDataTSGaleryTodolistCreates.index'));
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
            $personalDataTSGaleryTodolistCreate = $this->personalDataTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistCreate))
            {
                Flash::error('PersonalData T S Galery Todolist Create not found');
                return redirect(route('personalDataTSGaleryTodolistCreates.index'));
            }
            
            if($personalDataTSGaleryTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_galery_todolist_creates.show')->with('personalDataTSGaleryTodolistCreate', $personalDataTSGaleryTodolistCreate);
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
            $personalDataTSGaleryTodolistCreate = $this->personalDataTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistCreate))
            {
                Flash::error('PersonalData T S Galery Todolist Create not found');
                return redirect(route('personalDataTSGaleryTodolistCreates.index'));
            }
    
            if($personalDataTSGaleryTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_galery_todolist_creates.edit')->with('personalDataTSGaleryTodolistCreate', $personalDataTSGaleryTodolistCreate);
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

    public function update($id, UpdatePersonalDataTSGaleryTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryTodolistCreate = $this->personalDataTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistCreate))
            {
                Flash::error('PersonalData T S Galery Todolist Create not found');
                return redirect(route('personalDataTSGaleryTodolistCreates.index'));
            }
            
            if($personalDataTSGaleryTodolistCreate -> user_id == $user_id)
            {
                $personalDataTSGaleryTodolistCreate = $this->personalDataTSGaleryTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery Todolist Create updated successfully.');
                return redirect(route('personalDataTSGaleryTodolistCreates.index'));
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
            $personalDataTSGaleryTodolistCreate = $this->personalDataTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistCreate))
            {
                Flash::error('PersonalData T S Galery Todolist Create not found');
                return redirect(route('personalDataTSGaleryTodolistCreates.index'));
            }
    
            if($personalDataTSGaleryTodolistCreate -> user_id == $user_id)
            {
                $this->personalDataTSGaleryTodolistCreateRepository->delete($id);
            
                Flash::success('PersonalData T S Galery Todolist Create deleted successfully.');
                return redirect(route('personalDataTSGaleryTodolistCreates.index'));
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