<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSNoteTodolistCreateRequest;
use App\Http\Requests\UpdateCollegeTSNoteTodolistCreateRequest;
use App\Repositories\CollegeTSNoteTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSNoteTodolistCreateController extends AppBaseController
{
    private $collegeTSNoteTodolistCreateRepository;

    public function __construct(CollegeTSNoteTodolistCreateRepository $collegeTSNoteTodolistCreateRepo)
    {
        $this->collegeTSNoteTodolistCreateRepository = $collegeTSNoteTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSNoteTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSNoteTodolistCreates = $this->collegeTSNoteTodolistCreateRepository->all();
    
            return view('college_t_s_note_todolist_creates.index')
                ->with('collegeTSNoteTodolistCreates', $collegeTSNoteTodolistCreates);
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
            return view('college_t_s_note_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSNoteTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSNoteTodolistCreate = $this->collegeTSNoteTodolistCreateRepository->create($input);
    
            Flash::success('College T S Note Todolist Create saved successfully.');
            return redirect(route('collegeTSNoteTodolistCreates.index'));
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
            $collegeTSNoteTodolistCreate = $this->collegeTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistCreate))
            {
                Flash::error('College T S Note Todolist Create not found');
                return redirect(route('collegeTSNoteTodolistCreates.index'));
            }
    
            if($collegeTSNoteTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_note_todolist_creates.show')->with('collegeTSNoteTodolistCreate', $collegeTSNoteTodolistCreate);
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
            $collegeTSNoteTodolistCreate = $this->collegeTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistCreate))
            {
                Flash::error('College T S Note Todolist Create not found');
                return redirect(route('collegeTSNoteTodolistCreates.index'));
            }
    
            if($collegeTSNoteTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_note_todolist_creates.edit')->with('collegeTSNoteTodolistCreate', $collegeTSNoteTodolistCreate);
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

    public function update($id, UpdateCollegeTSNoteTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSNoteTodolistCreate = $this->collegeTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistCreate))
            {
                Flash::error('College T S Note Todolist Create not found');
                return redirect(route('collegeTSNoteTodolistCreates.index'));
            }
            
            if($collegeTSNoteTodolistCreate -> user_id == $user_id)
            {
                $collegeTSNoteTodolistCreate = $this->collegeTSNoteTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S Note Todolist Create updated successfully.');
                return redirect(route('collegeTSNoteTodolistCreates.index'));
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
            $collegeTSNoteTodolistCreate = $this->collegeTSNoteTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistCreate))
            {
                Flash::error('College T S Note Todolist Create not found');
                return redirect(route('collegeTSNoteTodolistCreates.index'));
            }
            
            if($collegeTSNoteTodolistCreate -> user_id == $user_id)
            {
                $this->collegeTSNoteTodolistCreateRepository->delete($id);
            
                Flash::success('College T S Note Todolist Create deleted successfully.');
                return redirect(route('collegeTSNoteTodolistCreates.index'));
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