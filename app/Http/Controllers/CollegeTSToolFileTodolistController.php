<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolFileTodolistRequest;
use App\Http\Requests\UpdateCollegeTSToolFileTodolistRequest;
use App\Repositories\CollegeTSToolFileTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolFileTodolistController extends AppBaseController
{
    private $collegeTSToolFileTodolistRepository;

    public function __construct(CollegeTSToolFileTodolistRepository $collegeTSToolFileTodolistRepo)
    {
        $this->collegeTSToolFileTodolistRepository = $collegeTSToolFileTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolFileTodolistRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolFileTodolists = $this->collegeTSToolFileTodolistRepository->all();
    
            return view('college_t_s_tool_file_todolists.index')
                ->with('collegeTSToolFileTodolists', $collegeTSToolFileTodolists);
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
            return view('college_t_s_tool_file_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSToolFileTodolist = $this->collegeTSToolFileTodolistRepository->create($input);
    
            Flash::success('College T S Tool File Todolist saved successfully.');
            return redirect(route('collegeTSToolFileTodolists.index'));
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
            $collegeTSToolFileTodolist = $this->collegeTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolist))
            {
                Flash::error('College T S Tool File Todolist not found');
                return redirect(route('collegeTSToolFileTodolists.index'));
            }
    
            return view('college_t_s_tool_file_todolists.show')->with('collegeTSToolFileTodolist', $collegeTSToolFileTodolist);
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
            $collegeTSToolFileTodolist = $this->collegeTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolist))
            {
                Flash::error('College T S Tool File Todolist not found');
                return redirect(route('collegeTSToolFileTodolists.index'));
            }
    
            return view('college_t_s_tool_file_todolists.edit')->with('collegeTSToolFileTodolist', $collegeTSToolFileTodolist);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateCollegeTSToolFileTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $collegeTSToolFileTodolist = $this->collegeTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolist))
            {
                Flash::error('College T S Tool File Todolist not found');
                return redirect(route('collegeTSToolFileTodolists.index'));
            }
    
            $collegeTSToolFileTodolist = $this->collegeTSToolFileTodolistRepository->update($request->all(), $id);
    
            Flash::success('College T S Tool File Todolist updated successfully.');
            return redirect(route('collegeTSToolFileTodolists.index'));
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
            $collegeTSToolFileTodolist = $this->collegeTSToolFileTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolist))
            {
                Flash::error('College T S Tool File Todolist not found');
                return redirect(route('collegeTSToolFileTodolists.index'));
            }
    
            $this->collegeTSToolFileTodolistRepository->delete($id);
    
            Flash::success('College T S Tool File Todolist deleted successfully.');
            return redirect(route('collegeTSToolFileTodolists.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}