<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGImageTodolistDeleteRequest;
use App\Http\Requests\UpdateCollegeTSGImageTodolistDeleteRequest;
use App\Repositories\CollegeTSGImageTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGImageTodolistDeleteController extends AppBaseController
{
    private $collegeTSGImageTodolistDeleteRepository;

    public function __construct(CollegeTSGImageTodolistDeleteRepository $collegeTSGImageTodolistDeleteRepo)
    {
        $this->collegeTSGImageTodolistDeleteRepository = $collegeTSGImageTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGImageTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGImageTodolistDeletes = $this->collegeTSGImageTodolistDeleteRepository->all();
    
            return view('college_t_s_g_image_todolist_deletes.index')
                ->with('collegeTSGImageTodolistDeletes', $collegeTSGImageTodolistDeletes);
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
            return view('college_t_s_g_image_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGImageTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSGImageTodolistDelete = $this->collegeTSGImageTodolistDeleteRepository->create($input);
    
            Flash::success('College T S G Image Todolist Delete saved successfully.');
            return redirect(route('collegeTSGImageTodolistDeletes.index'));
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
            $collegeTSGImageTodolistDelete = $this->collegeTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistDelete))
            {
                Flash::error('College T S G Image Todolist Delete not found');
                return redirect(route('collegeTSGImageTodolistDeletes.index'));
            }
            
            if($collegeTSGImageTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_g_image_todolist_deletes.show')->with('collegeTSGImageTodolistDelete', $collegeTSGImageTodolistDelete);
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
            $collegeTSGImageTodolistDelete = $this->collegeTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistDelete))
            {
                Flash::error('College T S G Image Todolist Delete not found');
                return redirect(route('collegeTSGImageTodolistDeletes.index'));
            }
    
            if($collegeTSGImageTodolistDelete -> user_id == $user_id)
            {
                return view('college_t_s_g_image_todolist_deletes.edit')
                    ->with('collegeTSGImageTodolistDelete', $collegeTSGImageTodolistDelete);
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

    public function update($id, UpdateCollegeTSGImageTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGImageTodolistDelete = $this->collegeTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistDelete))
            {
                Flash::error('College T S G Image Todolist Delete not found');
                return redirect(route('collegeTSGImageTodolistDeletes.index'));
            }
            
            if($collegeTSGImageTodolistDelete -> user_id == $user_id)
            {
                $collegeTSGImageTodolistDelete = $this->collegeTSGImageTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S G Image Todolist Delete updated successfully.');
                return redirect(route('collegeTSGImageTodolistDeletes.index'));
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
            $collegeTSGImageTodolistDelete = $this->collegeTSGImageTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistDelete))
            {
                Flash::error('College T S G Image Todolist Delete not found');
                return redirect(route('collegeTSGImageTodolistDeletes.index'));
            }
            
            if($collegeTSGImageTodolistDelete -> user_id == $user_id)
            {
                $this->collegeTSGImageTodolistDeleteRepository->delete($id);
            
                Flash::success('College T S G Image Todolist Delete deleted successfully.');
                return redirect(route('collegeTSGImageTodolistDeletes.index'));
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