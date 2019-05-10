<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryTodolistDeleteRequest;
use App\Http\Requests\UpdateCollegeTSGaleryTodolistDeleteRequest;
use App\Repositories\CollegeTSGaleryTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryTodolistDeleteController extends AppBaseController
{
    private $collegeTSGaleryTodolistDeleteRepository;

    public function __construct(CollegeTSGaleryTodolistDeleteRepository $collegeTSGaleryTodolistDeleteRepo)
    {
        $this->collegeTSGaleryTodolistDeleteRepository = $collegeTSGaleryTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGaleryTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryTodolistDeletes = $this->collegeTSGaleryTodolistDeleteRepository->all();
    
            return view('college_t_s_galery_todolist_deletes.index')
                ->with('collegeTSGaleryTodolistDeletes', $collegeTSGaleryTodolistDeletes);
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
            return view('college_t_s_galery_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSGaleryTodolistDelete = $this->collegeTSGaleryTodolistDeleteRepository->create($input);
    
            Flash::success('College T S Galery Todolist Delete saved successfully.');
            return redirect(route('collegeTSGaleryTodolistDeletes.index'));
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
            $collegeTSGaleryTodolistDelete = $this->collegeTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistDelete))
            {
                Flash::error('College T S Galery Todolist Delete not found');
                return redirect(route('collegeTSGaleryTodolistDeletes.index'));
            }
            
            if($collegeTSGaleryTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_galery_todolist_deletes.show')->with('collegeTSGaleryTodolistDelete', $collegeTSGaleryTodolistDelete);
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
            $collegeTSGaleryTodolistDelete = $this->collegeTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistDelete))
            {
                Flash::error('College T S Galery Todolist Delete not found');
                return redirect(route('collegeTSGaleryTodolistDeletes.index'));
            }
    
            if($collegeTSGaleryTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_galery_todolist_deletes.edit')->with('collegeTSGaleryTodolistDelete', $collegeTSGaleryTodolistDelete);
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

    public function update($id, UpdateCollegeTSGaleryTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGaleryTodolistDelete = $this->collegeTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistDelete))
            {
                Flash::error('College T S Galery Todolist Delete not found');
                return redirect(route('collegeTSGaleryTodolistDeletes.index'));
            }
    
            if($collegeTSGaleryTodolistDelete -> user_id == $user_id)
            {
                $collegeTSGaleryTodolistDelete = $this->collegeTSGaleryTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S Galery Todolist Delete updated successfully.');
                return redirect(route('collegeTSGaleryTodolistDeletes.index'));
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
            $collegeTSGaleryTodolistDelete = $this->collegeTSGaleryTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistDelete))
            {
                Flash::error('College T S Galery Todolist Delete not found');
                return redirect(route('collegeTSGaleryTodolistDeletes.index'));
            }
    
            if($collegeTSGaleryTodolistDelete -> user_id == $user_id)
            {
                $this->collegeTSGaleryTodolistDeleteRepository->delete($id);
            
                Flash::success('College T S Galery Todolist Delete deleted successfully.');
                return redirect(route('collegeTSGaleryTodolistDeletes.index'));
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