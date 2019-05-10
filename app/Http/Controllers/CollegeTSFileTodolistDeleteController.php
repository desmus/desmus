<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSFileTodolistDeleteRequest;
use App\Http\Requests\UpdateCollegeTSFileTodolistDeleteRequest;
use App\Repositories\CollegeTSFileTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSFileTodolistDeleteController extends AppBaseController
{
    private $collegeTSFileTodolistDeleteRepository;

    public function __construct(CollegeTSFileTodolistDeleteRepository $collegeTSFileTodolistDeleteRepo)
    {
        $this->collegeTSFileTodolistDeleteRepository = $collegeTSFileTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSFileTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSFileTodolistDeletes = $this->collegeTSFileTodolistDeleteRepository->all();
    
            return view('college_t_s_file_todolist_deletes.index')
                ->with('collegeTSFileTodolistDeletes', $collegeTSFileTodolistDeletes);
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
            return view('college_t_s_file_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSFileTodolistDelete = $this->collegeTSFileTodolistDeleteRepository->create($input);
    
            Flash::success('College T S File Todolist Delete saved successfully.');
            return redirect(route('collegeTSFileTodolistDeletes.index'));
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
            $collegeTSFileTodolistDelete = $this->collegeTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistDelete))
            {
                Flash::error('College T S File Todolist Delete not found');
                return redirect(route('collegeTSFileTodolistDeletes.index'));
            }
            
            if($collegeTSFileTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_file_todolist_deletes.show')->with('collegeTSFileTodolistDelete', $collegeTSFileTodolistDelete);
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
            $collegeTSFileTodolistDelete = $this->collegeTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistDelete))
            {
                Flash::error('College T S File Todolist Delete not found');
                return redirect(route('collegeTSFileTodolistDeletes.index'));
            }
    
            if($collegeTSFileTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_file_todolist_deletes.edit')->with('collegeTSFileTodolistDelete', $collegeTSFileTodolistDelete);
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

    public function update($id, UpdateCollegeTSFileTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSFileTodolistDelete = $this->collegeTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistDelete))
            {
                Flash::error('College T S File Todolist Delete not found');
                return redirect(route('collegeTSFileTodolistDeletes.index'));
            }
    
            if($collegeTSFileTodolistDelete -> user_id == $user_id)
            {
                $collegeTSFileTodolistDelete = $this->collegeTSFileTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S File Todolist Delete updated successfully.');
                return redirect(route('collegeTSFileTodolistDeletes.index'));
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
            $collegeTSFileTodolistDelete = $this->collegeTSFileTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistDelete))
            {
                Flash::error('College T S File Todolist Delete not found');
                return redirect(route('collegeTSFileTodolistDeletes.index'));
            }
    
            if($collegeTSFileTodolistDelete -> user_id == $user_id)
            {
                $this->collegeTSFileTodolistDeleteRepository->delete($id);
            
                Flash::success('College T S File Todolist Delete deleted successfully.');
                return redirect(route('collegeTSFileTodolistDeletes.index'));
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