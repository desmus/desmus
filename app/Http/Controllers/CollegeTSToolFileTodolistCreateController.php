<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolFileTodolistCreateRequest;
use App\Http\Requests\UpdateCollegeTSToolFileTodolistCreateRequest;
use App\Repositories\CollegeTSToolFileTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolFileTodolistCreateController extends AppBaseController
{
    private $collegeTSToolFileTodolistCreateRepository;

    public function __construct(CollegeTSToolFileTodolistCreateRepository $collegeTSToolFileTodolistCreateRepo)
    {
        $this->collegeTSToolFileTodolistCreateRepository = $collegeTSToolFileTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolFileTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolFileTodolistCreates = $this->collegeTSToolFileTodolistCreateRepository->all();
    
            return view('college_t_s_tool_file_todolist_creates.index')
                ->with('collegeTSToolFileTodolistCreates', $collegeTSToolFileTodolistCreates);
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
            return view('college_t_s_tool_file_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSToolFileTodolistCreate = $this->collegeTSToolFileTodolistCreateRepository->create($input);
    
            Flash::success('College T S Tool File Todolist Create saved successfully.');
            return redirect(route('collegeTSToolFileTodolistCreates.index'));
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
            $collegeTSToolFileTodolistCreate = $this->collegeTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistCreate))
            {
                Flash::error('College T S Tool File Todolist Create not found');
                return redirect(route('collegeTSToolFileTodolistCreates.index'));
            }
    
            if($collegeTSToolFileTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_tool_file_todolist_creates.show')->with('collegeTSToolFileTodolistCreate', $collegeTSToolFileTodolistCreate);
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
            $collegeTSToolFileTodolistCreate = $this->collegeTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistCreate))
            {
                Flash::error('College T S Tool File Todolist Create not found');
                return redirect(route('collegeTSToolFileTodolistCreates.index'));
            }
    
            if($collegeTSToolFileTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_tool_file_todolist_creates.edit')->with('collegeTSToolFileTodolistCreate', $collegeTSToolFileTodolistCreate);
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

    public function update($id, UpdateCollegeTSToolFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolFileTodolistCreate = $this->collegeTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistCreate))
            {
                Flash::error('College T S Tool File Todolist Create not found');
                return redirect(route('collegeTSToolFileTodolistCreates.index'));
            }
            
            if($collegeTSToolFileTodolistCreate -> user_id == $user_id)
            {
                $collegeTSToolFileTodolistCreate = $this->collegeTSToolFileTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool File Todolist Create updated successfully.');
                return redirect(route('collegeTSToolFileTodolistCreates.index'));
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
            $collegeTSToolFileTodolistCreate = $this->collegeTSToolFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistCreate))
            {
                Flash::error('College T S Tool File Todolist Create not found');
                return redirect(route('collegeTSToolFileTodolistCreates.index'));
            }
    
            if($collegeTSToolFileTodolistCreate -> user_id == $user_id)
            {
                $this->collegeTSToolFileTodolistCreateRepository->delete($id);
            
                Flash::success('College T S Tool File Todolist Create deleted successfully.');
                return redirect(route('collegeTSToolFileTodolistCreates.index'));
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