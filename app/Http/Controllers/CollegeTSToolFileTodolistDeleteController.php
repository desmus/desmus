<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolFileTodolistDeleteRequest;
use App\Http\Requests\UpdateCollegeTSToolFileTodolistDeleteRequest;
use App\Repositories\CollegeTSToolFileTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolFileTodolistDeleteController extends AppBaseController
{
    private $collegeTSToolFileTodolistDeleteRepository;

    public function __construct(CollegeTSToolFileTodolistDeleteRepository $collegeTSToolFileTodolistDeleteRepo)
    {
        $this->collegeTSToolFileTodolistDeleteRepository = $collegeTSToolFileTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolFileTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolFileTodolistDeletes = $this->collegeTSToolFileTodolistDeleteRepository->all();
    
            return view('college_t_s_tool_file_todolist_deletes.index')
                ->with('collegeTSToolFileTodolistDeletes', $collegeTSToolFileTodolistDeletes);
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
            return view('college_t_s_tool_file_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSToolFileTodolistDelete = $this->collegeTSToolFileTodolistDeleteRepository->create($input);
    
            Flash::success('College T S Tool File Todolist Delete saved successfully.');
            return redirect(route('collegeTSToolFileTodolistDeletes.index'));
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
            $collegeTSToolFileTodolistDelete = $this->collegeTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistDelete))
            {
                Flash::error('College T S Tool File Todolist Delete not found');
                return redirect(route('collegeTSToolFileTodolistDeletes.index'));
            }
            
            if($collegeTSToolFileTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_tool_file_todolist_deletes.show')->with('collegeTSToolFileTodolistDelete', $collegeTSToolFileTodolistDelete);
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
            $collegeTSToolFileTodolistDelete = $this->collegeTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistDelete))
            {
                Flash::error('College T S Tool File Todolist Delete not found');
                return redirect(route('collegeTSToolFileTodolistDeletes.index'));
            }
    
            if($collegeTSToolFileTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_tool_file_todolist_deletes.edit')->with('collegeTSToolFileTodolistDelete', $collegeTSToolFileTodolistDelete);
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

    public function update($id, UpdateCollegeTSToolFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolFileTodolistDelete = $this->collegeTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistDelete))
            {
                Flash::error('College T S Tool File Todolist Delete not found');
                return redirect(route('collegeTSToolFileTodolistDeletes.index'));
            }
    
            if($collegeTSToolFileTodolistDelete -> user_id == $user_id)
            {
                $collegeTSToolFileTodolistDelete = $this->collegeTSToolFileTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool File Todolist Delete updated successfully.');
                return redirect(route('collegeTSToolFileTodolistDeletes.index'));
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
            $collegeTSToolFileTodolistDelete = $this->collegeTSToolFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistDelete))
            {
                Flash::error('College T S Tool File Todolist Delete not found');
                return redirect(route('collegeTSToolFileTodolistDeletes.index'));
            }
    
            if($collegeTSToolFileTodolistDelete -> user_id == $user_id)
            {
                $this->collegeTSToolFileTodolistDeleteRepository->delete($id);
            
                Flash::success('College T S Tool File Todolist Delete deleted successfully.');
                return redirect(route('collegeTSToolFileTodolistDeletes.index'));
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