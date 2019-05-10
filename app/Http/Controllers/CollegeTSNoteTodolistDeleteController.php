<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSNoteTodolistDeleteRequest;
use App\Http\Requests\UpdateCollegeTSNoteTodolistDeleteRequest;
use App\Repositories\CollegeTSNoteTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSNoteTodolistDeleteController extends AppBaseController
{
    private $collegeTSNoteTodolistDeleteRepository;

    public function __construct(CollegeTSNoteTodolistDeleteRepository $collegeTSNoteTodolistDeleteRepo)
    {
        $this->collegeTSNoteTodolistDeleteRepository = $collegeTSNoteTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSNoteTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSNoteTodolistDeletes = $this->collegeTSNoteTodolistDeleteRepository->all();
    
            return view('college_t_s_note_todolist_deletes.index')
                ->with('collegeTSNoteTodolistDeletes', $collegeTSNoteTodolistDeletes);
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
            return view('college_t_s_note_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSNoteTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSNoteTodolistDelete = $this->collegeTSNoteTodolistDeleteRepository->create($input);
    
            Flash::success('College T S Note Todolist Delete saved successfully.');
            return redirect(route('collegeTSNoteTodolistDeletes.index'));
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
            $collegeTSNoteTodolistDelete = $this->collegeTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistDelete))
            {
                Flash::error('College T S Note Todolist Delete not found');
                return redirect(route('collegeTSNoteTodolistDeletes.index'));
            }
            
            if($collegeTSNoteTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_note_todolist_deletes.show')->with('collegeTSNoteTodolistDelete', $collegeTSNoteTodolistDelete);
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
            $collegeTSNoteTodolistDelete = $this->collegeTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistDelete))
            {
                Flash::error('College T S Note Todolist Delete not found');
                return redirect(route('collegeTSNoteTodolistDeletes.index'));
            }
    
            if($collegeTSNoteTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_note_todolist_deletes.edit')->with('collegeTSNoteTodolistDelete', $collegeTSNoteTodolistDelete);
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

    public function update($id, UpdateCollegeTSNoteTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSNoteTodolistDelete = $this->collegeTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistDelete))
            {
                Flash::error('College T S Note Todolist Delete not found');
                return redirect(route('collegeTSNoteTodolistDeletes.index'));
            }
            
            if($collegeTSNoteTodolistDelete -> user_id == $user_id)
            {
                $collegeTSNoteTodolistDelete = $this->collegeTSNoteTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S Note Todolist Delete updated successfully.');
                return redirect(route('collegeTSNoteTodolistDeletes.index'));
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
            $collegeTSNoteTodolistDelete = $this->collegeTSNoteTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistDelete))
            {
                Flash::error('College T S Note Todolist Delete not found');
                return redirect(route('collegeTSNoteTodolistDeletes.index'));
            }
    
            if($collegeTSNoteTodolistDelete -> user_id == $user_id)
            {
                $this->collegeTSNoteTodolistDeleteRepository->delete($id);
            
                Flash::success('College T S Note Todolist Delete deleted successfully.');
                return redirect(route('collegeTSNoteTodolistDeletes.index'));
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