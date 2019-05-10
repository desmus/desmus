<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTodolistDeleteRequest;
use App\Http\Requests\UpdateCollegeTodolistDeleteRequest;
use App\Repositories\CollegeTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTodolistDeleteController extends AppBaseController
{
    private $collegeTodolistDeleteRepository;

    public function __construct(CollegeTodolistDeleteRepository $collegeTodolistDeleteRepo)
    {
        $this->collegeTodolistDeleteRepository = $collegeTodolistDeleteRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTodolistDeletes = $this->collegeTodolistDeleteRepository->all();
    
            return view('college_todolist_deletes.index')
                ->with('collegeTodolistDeletes', $collegeTodolistDeletes);
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
            return view('college_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTodolistDelete = $this->collegeTodolistDeleteRepository->create($input);
    
            Flash::success('College Todolist Delete saved successfully.');
            return redirect(route('collegeTodolistDeletes.index'));
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
            $collegeTodolistDelete = $this->collegeTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistDelete))
            {
                Flash::error('College Todolist Delete not found');
                return redirect(route('collegeTodolistDeletes.index'));
            }
            
            if($collegeTodolistDelete -> user_id == $user_id)
            {   
                return view('college_todolist_deletes.show')->with('collegeTodolistDelete', $collegeTodolistDelete);
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
            $collegeTodolistDelete = $this->collegeTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistDelete))
            {
                Flash::error('College Todolist Delete not found');
                return redirect(route('collegeTodolistDeletes.index'));
            }
            
            if($collegeTodolistDelete -> user_id == $user_id)
            {
                return view('college_todolist_deletes.edit')->with('collegeTodolistDelete', $collegeTodolistDelete);
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

    public function update($id, UpdateCollegeTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTodolistDelete = $this->collegeTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistDelete))
            {
                Flash::error('College Todolist Delete not found');
                return redirect(route('collegeTodolistDeletes.index'));
            }
            
            if($collegeTodolistDelete -> user_id == $user_id)
            {
                $collegeTodolistDelete = $this->collegeTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('College Todolist Delete updated successfully.');
                return redirect(route('collegeTodolistDeletes.index'));
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
            $collegeTodolistDelete = $this->collegeTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistDelete))
            {
                Flash::error('College Todolist Delete not found');
                return redirect(route('collegeTodolistDeletes.index'));
            }
            
            if($collegeTodolistDelete -> user_id == $user_id)
            {
                $this->collegeTodolistDeleteRepository->delete($id);
            
                Flash::success('College Todolist Delete deleted successfully.');
                return redirect(route('collegeTodolistDeletes.index'));
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