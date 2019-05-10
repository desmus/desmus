<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolTodolistDeleteRequest;
use App\Http\Requests\UpdateCollegeTSToolTodolistDeleteRequest;
use App\Repositories\CollegeTSToolTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolTodolistDeleteController extends AppBaseController
{
    private $collegeTSToolTodolistDeleteRepository;

    public function __construct(CollegeTSToolTodolistDeleteRepository $collegeTSToolTodolistDeleteRepo)
    {
        $this->collegeTSToolTodolistDeleteRepository = $collegeTSToolTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolTodolistDeletes = $this->collegeTSToolTodolistDeleteRepository->all();
    
            return view('college_t_s_tool_todolist_deletes.index')
                ->with('collegeTSToolTodolistDeletes', $collegeTSToolTodolistDeletes);
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
            return view('college_t_s_tool_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSToolTodolistDelete = $this->collegeTSToolTodolistDeleteRepository->create($input);
    
            Flash::success('College T S Tool Todolist Delete saved successfully.');
            return redirect(route('collegeTSToolTodolistDeletes.index'));
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
            $collegeTSToolTodolistDelete = $this->collegeTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistDelete))
            {
                Flash::error('College T S Tool Todolist Delete not found');
                return redirect(route('collegeTSToolTodolistDeletes.index'));
            }
            
            if($collegeTSToolTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_tool_todolist_deletes.show')->with('collegeTSToolTodolistDelete', $collegeTSToolTodolistDelete);
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
            $collegeTSToolTodolistDelete = $this->collegeTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistDelete))
            {
                Flash::error('College T S Tool Todolist Delete not found');
                return redirect(route('collegeTSToolTodolistDeletes.index'));
            }
            
            if($collegeTSToolTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_tool_todolist_deletes.edit')->with('collegeTSToolTodolistDelete', $collegeTSToolTodolistDelete);
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

    public function update($id, UpdateCollegeTSToolTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolTodolistDelete = $this->collegeTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistDelete))
            {
                Flash::error('College T S Tool Todolist Delete not found');
                return redirect(route('collegeTSToolTodolistDeletes.index'));
            }
    
            if($collegeTSToolTodolistDelete -> user_id == $user_id)
            {
                $collegeTSToolTodolistDelete = $this->collegeTSToolTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool Todolist Delete updated successfully.');
                return redirect(route('collegeTSToolTodolistDeletes.index'));
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
            $collegeTSToolTodolistDelete = $this->collegeTSToolTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistDelete))
            {
                Flash::error('College T S Tool Todolist Delete not found');
                return redirect(route('collegeTSToolTodolistDeletes.index'));
            }
    
            if($collegeTSToolTodolistDelete -> user_id == $user_id)
            {
                $this->collegeTSToolTodolistDeleteRepository->delete($id);
            
                Flash::success('College T S Tool Todolist Delete deleted successfully.');
                return redirect(route('collegeTSToolTodolistDeletes.index'));
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