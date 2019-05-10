<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSFileTodolistRequest;
use App\Http\Requests\UpdateCollegeTSFileTodolistRequest;
use App\Repositories\CollegeTSFileTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSFileTodolistController extends AppBaseController
{
    private $collegeTSFileTodolistRepository;

    public function __construct(CollegeTSFileTodolistRepository $collegeTSFileTodolistRepo)
    {
        $this->collegeTSFileTodolistRepository = $collegeTSFileTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSFileTodolistRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSFileTodolists = $this->collegeTSFileTodolistRepository->all();
    
            return view('college_t_s_file_todolists.index')
                ->with('collegeTSFileTodolists', $collegeTSFileTodolists);
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
            return view('college_t_s_file_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSFileTodolist = $this->collegeTSFileTodolistRepository->create($input);
    
            Flash::success('College T S File Todolist saved successfully.');
            return redirect(route('collegeTSFileTodolists.index'));
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
            $collegeTSFileTodolist = $this->collegeTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolist))
            {
                Flash::error('College T S File Todolist not found');
                return redirect(route('collegeTSFileTodolists.index'));
            }
    
            return view('college_t_s_file_todolists.show')->with('collegeTSFileTodolist', $collegeTSFileTodolist);
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
            $collegeTSFileTodolist = $this->collegeTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolist))
            {
                Flash::error('College T S File Todolist not found');
                return redirect(route('collegeTSFileTodolists.index'));
            }
    
            return view('college_t_s_file_todolists.edit')->with('collegeTSFileTodolist', $collegeTSFileTodolist);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateCollegeTSFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $collegeTSFileTodolist = $this->collegeTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolist))
            {
                Flash::error('College T S File Todolist not found');
                return redirect(route('collegeTSFileTodolists.index'));
            }
    
            $collegeTSFileTodolist = $this->collegeTSFileTodolistRepository->update($request->all(), $id);
    
            Flash::success('College T S File Todolist updated successfully.');
            return redirect(route('collegeTSFileTodolists.index'));
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
            $collegeTSFileTodolist = $this->collegeTSFileTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolist))
            {
                Flash::error('College T S File Todolist not found');
                return redirect(route('collegeTSFileTodolists.index'));
            }
    
            $this->collegeTSFileTodolistRepository->delete($id);
    
            Flash::success('College T S File Todolist deleted successfully.');
            return redirect(route('collegeTSFileTodolists.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}