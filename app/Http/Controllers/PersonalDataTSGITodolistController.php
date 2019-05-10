<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGITodolistRequest;
use App\Http\Requests\UpdatePersonalDataTSGITodolistRequest;
use App\Repositories\PersonalDataTSGITodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGITodolistController extends AppBaseController
{
    private $personalDataTSGImageTodolistRepository;

    public function __construct(PersonalDataTSGITodolistRepository $personalDataTSGImageTodolistRepo)
    {
        $this->personalDataTSGImageTodolistRepository = $personalDataTSGImageTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGImageTodolistRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGITodolists = $this->personalDataTSGImageTodolistRepository->all();
    
            return view('personal_data_t_s_g_i_todolists.index')
                ->with('personalDataTSGITodolists', $personalDataTSGITodolists);
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
            return view('personal_data_t_s_g_i_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSGITodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSGImageTodolist = $this->personalDataTSGImageTodolistRepository->create($input);
    
            Flash::success('PersonalData T S G Image Todolist saved successfully.');
            return redirect(route('personalDataTSGITodolists.index'));
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
            $personalDataTSGImageTodolist = $this->personalDataTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGImageTodolist))
            {
                Flash::error('PersonalData T S G Image Todolist not found');
                return redirect(route('personalDataTSGITodolists.index'));
            }
    
            return view('personal_data_t_s_g_i_todolists.show')->with('personalDataTSGImageTodolist', $personalDataTSGImageTodolist);
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
            $personalDataTSGImageTodolist = $this->personalDataTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGImageTodolist))
            {
                Flash::error('PersonalData T S G Image Todolist not found');
                return redirect(route('personalDataTSGITodolists.index'));
            }
    
            return view('personal_data_t_s_g_i_todolists.edit')->with('personalDataTSGImageTodolist', $personalDataTSGImageTodolist);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdatePersonalDataTSGITodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $personalDataTSGImageTodolist = $this->personalDataTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGImageTodolist))
            {
                Flash::error('PersonalData T S G Image Todolist not found');
                return redirect(route('personalDataTSGITodolists.index'));
            }
    
            $personalDataTSGImageTodolist = $this->personalDataTSGImageTodolistRepository->update($request->all(), $id);
    
            Flash::success('PersonalData T S G Image Todolist updated successfully.');
            return redirect(route('personalDataTSGITodolists.index'));
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
            $personalDataTSGImageTodolist = $this->personalDataTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGImageTodolist))
            {
                Flash::error('PersonalData T S G Image Todolist not found');
                return redirect(route('personalDataTSGITodolists.index'));
            }
    
            $this->personalDataTSGImageTodolistRepository->delete($id);
    
            Flash::success('PersonalData T S G Image Todolist deleted successfully.');
            return redirect(route('personalDataTSGITodolists.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}