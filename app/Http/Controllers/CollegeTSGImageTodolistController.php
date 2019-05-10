<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGImageTodolistRequest;
use App\Http\Requests\UpdateCollegeTSGImageTodolistRequest;
use App\Repositories\CollegeTSGImageTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGImageTodolistController extends AppBaseController
{
    private $collegeTSGImageTodolistRepository;

    public function __construct(CollegeTSGImageTodolistRepository $collegeTSGImageTodolistRepo)
    {
        $this->collegeTSGImageTodolistRepository = $collegeTSGImageTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGImageTodolistRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGImageTodolists = $this->collegeTSGImageTodolistRepository->all();
    
            return view('college_t_s_g_image_todolists.index')
                ->with('collegeTSGImageTodolists', $collegeTSGImageTodolists);
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
            return view('college_t_s_g_image_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGImageTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSGImageTodolist = $this->collegeTSGImageTodolistRepository->create($input);
    
            Flash::success('College T S G Image Todolist saved successfully.');
            return redirect(route('collegeTSGImageTodolists.index'));
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
            $collegeTSGImageTodolist = $this->collegeTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolist))
            {
                Flash::error('College T S G Image Todolist not found');
                return redirect(route('collegeTSGImageTodolists.index'));
            }
    
            return view('college_t_s_g_image_todolists.show')->with('collegeTSGImageTodolist', $collegeTSGImageTodolist);
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
            $collegeTSGImageTodolist = $this->collegeTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolist))
            {
                Flash::error('College T S G Image Todolist not found');
                return redirect(route('collegeTSGImageTodolists.index'));
            }
    
            return view('college_t_s_g_image_todolists.edit')->with('collegeTSGImageTodolist', $collegeTSGImageTodolist);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateCollegeTSGImageTodolistRequest $request)
    {
        if(Auth::user() != null)
        {
            $collegeTSGImageTodolist = $this->collegeTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolist))
            {
                Flash::error('College T S G Image Todolist not found');
                return redirect(route('collegeTSGImageTodolists.index'));
            }
    
            $collegeTSGImageTodolist = $this->collegeTSGImageTodolistRepository->update($request->all(), $id);
    
            Flash::success('College T S G Image Todolist updated successfully.');
            return redirect(route('collegeTSGImageTodolists.index'));
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
            $collegeTSGImageTodolist = $this->collegeTSGImageTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolist))
            {
                Flash::error('College T S G Image Todolist not found');
                return redirect(route('collegeTSGImageTodolists.index'));
            }
    
            $this->collegeTSGImageTodolistRepository->delete($id);
    
            Flash::success('College T S G Image Todolist deleted successfully.');
            return redirect(route('collegeTSGImageTodolists.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}