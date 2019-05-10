<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolTodolistCreateRequest;
use App\Http\Requests\UpdateCollegeTSToolTodolistCreateRequest;
use App\Repositories\CollegeTSToolTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolTodolistCreateController extends AppBaseController
{
    private $collegeTSToolTodolistCreateRepository;

    public function __construct(CollegeTSToolTodolistCreateRepository $collegeTSToolTodolistCreateRepo)
    {
        $this->collegeTSToolTodolistCreateRepository = $collegeTSToolTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolTodolistCreates = $this->collegeTSToolTodolistCreateRepository->all();
    
            return view('college_t_s_tool_todolist_creates.index')
                ->with('collegeTSToolTodolistCreates', $collegeTSToolTodolistCreates);
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
            return view('college_t_s_tool_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSToolTodolistCreate = $this->collegeTSToolTodolistCreateRepository->create($input);
    
            Flash::success('College T S Tool Todolist Create saved successfully.');
            return redirect(route('collegeTSToolTodolistCreates.index'));
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
            $collegeTSToolTodolistCreate = $this->collegeTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistCreate))
            {
                Flash::error('College T S Tool Todolist Create not found');
                return redirect(route('collegeTSToolTodolistCreates.index'));
            }
            
            if($collegeTSToolTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_tool_todolist_creates.show')->with('collegeTSToolTodolistCreate', $collegeTSToolTodolistCreate);
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
            $collegeTSToolTodolistCreate = $this->collegeTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistCreate))
            {
                Flash::error('College T S Tool Todolist Create not found');
                return redirect(route('collegeTSToolTodolistCreates.index'));
            }
            
            if($collegeTSToolTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_tool_todolist_creates.edit')->with('collegeTSToolTodolistCreate', $collegeTSToolTodolistCreate);
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

    public function update($id, UpdateCollegeTSToolTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolTodolistCreate = $this->collegeTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistCreate))
            {
                Flash::error('College T S Tool Todolist Create not found');
                return redirect(route('collegeTSToolTodolistCreates.index'));
            }
    
            if($collegeTSToolTodolistCreate -> user_id == $user_id)
            {
                $collegeTSToolTodolistCreate = $this->collegeTSToolTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool Todolist Create updated successfully.');
                return redirect(route('collegeTSToolTodolistCreates.index'));
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
            $collegeTSToolTodolistCreate = $this->collegeTSToolTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistCreate))
            {
                Flash::error('College T S Tool Todolist Create not found');
                return redirect(route('collegeTSToolTodolistCreates.index'));
            }
    
            if($collegeTSToolTodolistCreate -> user_id == $user_id)
            {
                $this->collegeTSToolTodolistCreateRepository->delete($id);
            
                Flash::success('College T S Tool Todolist Create deleted successfully.');
                return redirect(route('collegeTSToolTodolistCreates.index'));
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