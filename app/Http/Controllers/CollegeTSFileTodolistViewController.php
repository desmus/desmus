<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSFileTodolistViewRequest;
use App\Http\Requests\UpdateCollegeTSFileTodolistViewRequest;
use App\Repositories\CollegeTSFileTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSFileTodolistViewController extends AppBaseController
{
    private $collegeTSFileTodolistViewRepository;

    public function __construct(CollegeTSFileTodolistViewRepository $collegeTSFileTodolistViewRepo)
    {
        $this->collegeTSFileTodolistViewRepository = $collegeTSFileTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSFileTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSFileTodolistViews = $this->collegeTSFileTodolistViewRepository->all();
    
            return view('college_t_s_file_todolist_views.index')
                ->with('collegeTSFileTodolistViews', $collegeTSFileTodolistViews);
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
            return view('college_t_s_file_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSFileTodolistView = $this->collegeTSFileTodolistViewRepository->create($input);
    
            Flash::success('College T S File Todolist View saved successfully.');
            return redirect(route('collegeTSFileTodolistViews.index'));
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
            $collegeTSFileTodolistView = $this->collegeTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistView))
            {
                Flash::error('College T S File Todolist View not found');
                return redirect(route('collegeTSFileTodolistViews.index'));
            }
            
            if($collegeTSFileTodolistView -> user_id == $user_id)
            {
                return view('college_t_s_file_todolist_views.show')
                    ->with('collegeTSFileTodolistView', $collegeTSFileTodolistView);
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
            $collegeTSFileTodolistView = $this->collegeTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistView))
            {
                Flash::error('College T S File Todolist View not found');
                return redirect(route('collegeTSFileTodolistViews.index'));
            }
            
            if($collegeTSFileTodolistView -> user_id == $user_id)
            {
                return view('college_t_s_file_todolist_views.edit')
                    ->with('collegeTSFileTodolistView', $collegeTSFileTodolistView);
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
    
    public function update($id, UpdateCollegeTSFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $collegeTSFileTodolistView = $this->collegeTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistView))
            {
                Flash::error('College T S File Todolist View not found');
                return redirect(route('collegeTSFileTodolistViews.index'));
            }
            
            if($collegeTSFileTodolistView -> user_id == $user_id)
            {
                $collegeTSFileTodolistView = $this->collegeTSFileTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('College T S File Todolist View updated successfully.');
                return redirect(route('collegeTSFileTodolistViews.index'));
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
            $collegeTSFileTodolistView = $this->collegeTSFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistView))
            {
                Flash::error('College T S File Todolist View not found');
                return redirect(route('collegeTSFileTodolistViews.index'));
            }
            
            if($collegeTSFileTodolistView -> user_id == $user_id)
            {
                $this->collegeTSFileTodolistViewRepository->delete($id);
            
                Flash::success('College T S File Todolist View deleted successfully.');
                return redirect(route('collegeTSFileTodolistViews.index'));
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