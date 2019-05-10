<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSFileTodolistCreateRequest;
use App\Http\Requests\UpdateCollegeTSFileTodolistCreateRequest;
use App\Repositories\CollegeTSFileTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSFileTodolistCreateController extends AppBaseController
{
    private $collegeTSFileTodolistCreateRepository;

    public function __construct(CollegeTSFileTodolistCreateRepository $collegeTSFileTodolistCreateRepo)
    {
        $this->collegeTSFileTodolistCreateRepository = $collegeTSFileTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSFileTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSFileTodolistCreates = $this->collegeTSFileTodolistCreateRepository->all();
    
            return view('college_t_s_file_todolist_creates.index')
                ->with('collegeTSFileTodolistCreates', $collegeTSFileTodolistCreates);
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
            return view('college_t_s_file_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSFileTodolistCreate = $this->collegeTSFileTodolistCreateRepository->create($input);
    
            Flash::success('College T S File Todolist Create saved successfully.');
            return redirect(route('collegeTSFileTodolistCreates.index'));
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
            $collegeTSFileTodolistCreate = $this->collegeTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistCreate))
            {
                Flash::error('College T S File Todolist Create not found');
                return redirect(route('collegeTSFileTodolistCreates.index'));
            }
            
            if($collegeTSFileTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_file_todolist_creates.show')
                    ->with('collegeTSFileTodolistCreate', $collegeTSFileTodolistCreate);
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
            $collegeTSFileTodolistCreate = $this->collegeTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistCreate))
            {
                Flash::error('College T S File Todolist Create not found');
                return redirect(route('collegeTSFileTodolistCreates.index'));
            }
            
            if($collegeTSFileTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_file_todolist_creates.edit')->with('collegeTSFileTodolistCreate', $collegeTSFileTodolistCreate);
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

    public function update($id, UpdateCollegeTSFileTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSFileTodolistCreate = $this->collegeTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistCreate))
            {
                Flash::error('College T S File Todolist Create not found');
                return redirect(route('collegeTSFileTodolistCreates.index'));
            }
            
            if($collegeTSFileTodolistCreate -> user_id == $user_id)
            {
                $collegeTSFileTodolistCreate = $this->collegeTSFileTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S File Todolist Create updated successfully.');
                return redirect(route('collegeTSFileTodolistCreates.index'));
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
            $collegeTSFileTodolistCreate = $this->collegeTSFileTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistCreate))
            {
                Flash::error('College T S File Todolist Create not found');
                return redirect(route('collegeTSFileTodolistCreates.index'));
            }
            
            if($collegeTSFileTodolistCreate -> user_id == $user_id)
            {
                $this->collegeTSFileTodolistCreateRepository->delete($id);
            
                Flash::success('College T S File Todolist Create deleted successfully.');
                return redirect(route('collegeTSFileTodolistCreates.index'));
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