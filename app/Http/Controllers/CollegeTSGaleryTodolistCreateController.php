<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryTodolistCreateRequest;
use App\Http\Requests\UpdateCollegeTSGaleryTodolistCreateRequest;
use App\Repositories\CollegeTSGaleryTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryTodolistCreateController extends AppBaseController
{
    private $collegeTSGaleryTodolistCreateRepository;

    public function __construct(CollegeTSGaleryTodolistCreateRepository $collegeTSGaleryTodolistCreateRepo)
    {
        $this->collegeTSGaleryTodolistCreateRepository = $collegeTSGaleryTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGaleryTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryTodolistCreates = $this->collegeTSGaleryTodolistCreateRepository->all();
    
            return view('college_t_s_galery_todolist_creates.index')
                ->with('collegeTSGaleryTodolistCreates', $collegeTSGaleryTodolistCreates);
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
            return view('college_t_s_galery_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSGaleryTodolistCreate = $this->collegeTSGaleryTodolistCreateRepository->create($input);
    
            Flash::success('College T S Galery Todolist Create saved successfully.');
            return redirect(route('collegeTSGaleryTodolistCreates.index'));
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
            $collegeTSGaleryTodolistCreate = $this->collegeTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistCreate))
            {
                Flash::error('College T S Galery Todolist Create not found');
                return redirect(route('collegeTSGaleryTodolistCreates.index'));
            }
            
            if($collegeTSGaleryTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_galery_todolist_creates.show')->with('collegeTSGaleryTodolistCreate', $collegeTSGaleryTodolistCreate);
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
            $collegeTSGaleryTodolistCreate = $this->collegeTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistCreate))
            {
                Flash::error('College T S Galery Todolist Create not found');
                return redirect(route('collegeTSGaleryTodolistCreates.index'));
            }
    
            if($collegeTSGaleryTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_galery_todolist_creates.edit')->with('collegeTSGaleryTodolistCreate', $collegeTSGaleryTodolistCreate);
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

    public function update($id, UpdateCollegeTSGaleryTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGaleryTodolistCreate = $this->collegeTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistCreate))
            {
                Flash::error('College T S Galery Todolist Create not found');
                return redirect(route('collegeTSGaleryTodolistCreates.index'));
            }
            
            if($collegeTSGaleryTodolistCreate -> user_id == $user_id)
            {
                $collegeTSGaleryTodolistCreate = $this->collegeTSGaleryTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S Galery Todolist Create updated successfully.');
                return redirect(route('collegeTSGaleryTodolistCreates.index'));
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
            $collegeTSGaleryTodolistCreate = $this->collegeTSGaleryTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistCreate))
            {
                Flash::error('College T S Galery Todolist Create not found');
                return redirect(route('collegeTSGaleryTodolistCreates.index'));
            }
    
            if($collegeTSGaleryTodolistCreate -> user_id == $user_id)
            {
                $this->collegeTSGaleryTodolistCreateRepository->delete($id);
            
                Flash::success('College T S Galery Todolist Create deleted successfully.');
                return redirect(route('collegeTSGaleryTodolistCreates.index'));
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