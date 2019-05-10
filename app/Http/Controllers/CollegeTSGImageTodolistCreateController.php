<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGImageTodolistCreateRequest;
use App\Http\Requests\UpdateCollegeTSGImageTodolistCreateRequest;
use App\Repositories\CollegeTSGImageTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGImageTodolistCreateController extends AppBaseController
{
    private $collegeTSGImageTodolistCreateRepository;

    public function __construct(CollegeTSGImageTodolistCreateRepository $collegeTSGImageTodolistCreateRepo)
    {
        $this->collegeTSGImageTodolistCreateRepository = $collegeTSGImageTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGImageTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGImageTodolistCreates = $this->collegeTSGImageTodolistCreateRepository->all();
    
            return view('college_t_s_g_image_todolist_creates.index')
                ->with('collegeTSGImageTodolistCreates', $collegeTSGImageTodolistCreates);
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
            return view('college_t_s_g_image_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGImageTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSGImageTodolistCreate = $this->collegeTSGImageTodolistCreateRepository->create($input);
    
            Flash::success('College T S G Image Todolist Create saved successfully.');
            return redirect(route('collegeTSGImageTodolistCreates.index'));
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
            $collegeTSGImageTodolistCreate = $this->collegeTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistCreate))
            {
                Flash::error('College T S G Image Todolist Create not found');
                return redirect(route('collegeTSGImageTodolistCreates.index'));
            }
            
            if($collegeTSGImageTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_g_image_todolist_creates.show')->with('collegeTSGImageTodolistCreate', $collegeTSGImageTodolistCreate);
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
            $collegeTSGImageTodolistCreate = $this->collegeTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistCreate))
            {
                Flash::error('College T S G Image Todolist Create not found');
                return redirect(route('collegeTSGImageTodolistCreates.index'));
            }
            
            if($collegeTSGImageTodolistCreate -> user_id == $user_id)
            {
                return view('college_t_s_g_image_todolist_creates.edit')->with('collegeTSGImageTodolistCreate', $collegeTSGImageTodolistCreate);
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

    public function update($id, UpdateCollegeTSGImageTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGImageTodolistCreate = $this->collegeTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistCreate))
            {
                Flash::error('College T S G Image Todolist Create not found');
                return redirect(route('collegeTSGImageTodolistCreates.index'));
            }
            
            if($collegeTSGImageTodolistCreate -> user_id == $user_id)
            {
                $collegeTSGImageTodolistCreate = $this->collegeTSGImageTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S G Image Todolist Create updated successfully.');
                return redirect(route('collegeTSGImageTodolistCreates.index'));
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
            $collegeTSGImageTodolistCreate = $this->collegeTSGImageTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistCreate))
            {
                Flash::error('College T S G Image Todolist Create not found');
                return redirect(route('collegeTSGImageTodolistCreates.index'));
            }
    
            if($collegeTSGImageTodolistCreate -> user_id == $user_id)
            {
                $this->collegeTSGImageTodolistCreateRepository->delete($id);
            
                Flash::success('College T S G Image Todolist Create deleted successfully.');
                return redirect(route('collegeTSGImageTodolistCreates.index'));
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