<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSTFTodolistRequest;
use App\Http\Requests\UpdatePersonalDataTSTFTodolistRequest;
use App\Repositories\PersonalDataTSTFTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSTFTodolistController extends AppBaseController
{
    private $personalDataTSTFTodolistRepository;

    public function __construct(PersonalDataTSTFTodolistRepository $personalDataTSTFTodolistRepo)
    {
        $this->personalDataTSTFTodolistRepository = $personalDataTSTFTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSTFTodolistRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSTFTodolists = $this->personalDataTSTFTodolistRepository->all();
    
            return view('personal_data_t_s_t_f_todolists.index')
                ->with('personalDataTSTFTodolists', $personalDataTSTFTodolists);
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
            return view('personal_data_t_s_t_f_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSTFTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSTFTodolist = $this->personalDataTSTFTodolistRepository->create($input);
    
            Flash::success('PersonalData T S Tool File Todolist saved successfully.');
            return redirect(route('personalDataTSTFTodolists.index'));
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
            $personalDataTSTFTodolist = $this->personalDataTSTFTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolist))
            {
                Flash::error('PersonalData T S Tool File Todolist not found');
                return redirect(route('personalDataTSTFTodolists.index'));
            }
    
            return view('personal_data_t_s_t_f_todolists.show')->with('personalDataTSTFTodolist', $personalDataTSTFTodolist);
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
            $personalDataTSTFTodolist = $this->personalDataTSTFTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolist))
            {
                Flash::error('PersonalData T S Tool File Todolist not found');
                return redirect(route('personalDataTSTFTodolists.index'));
            }
    
            return view('personal_data_t_s_t_f_todolists.edit')->with('personalDataTSTFTodolist', $personalDataTSTFTodolist);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdatePersonalDataTSTFTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $personalDataTSTFTodolist = $this->personalDataTSTFTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolist))
            {
                Flash::error('PersonalData T S Tool File Todolist not found');
                return redirect(route('personalDataTSTFTodolists.index'));
            }
    
            $personalDataTSTFTodolist = $this->personalDataTSTFTodolistRepository->update($request->all(), $id);
    
            Flash::success('PersonalData T S Tool File Todolist updated successfully.');
            return redirect(route('personalDataTSTFTodolists.index'));
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
            $personalDataTSTFTodolist = $this->personalDataTSTFTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolist))
            {
                Flash::error('PersonalData T S Tool File Todolist not found');
                return redirect(route('personalDataTSTFTodolists.index'));
            }
    
            $this->personalDataTSTFTodolistRepository->delete($id);
    
            Flash::success('PersonalData T S Tool File Todolist deleted successfully.');
            return redirect(route('personalDataTSTFTodolists.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}