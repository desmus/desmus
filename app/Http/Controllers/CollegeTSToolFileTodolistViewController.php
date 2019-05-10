<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolFileTodolistViewRequest;
use App\Http\Requests\UpdateCollegeTSToolFileTodolistViewRequest;
use App\Repositories\CollegeTSToolFileTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolFileTodolistViewController extends AppBaseController
{
    private $collegeTSToolFileTodolistViewRepository;

    public function __construct(CollegeTSToolFileTodolistViewRepository $collegeTSToolFileTodolistViewRepo)
    {
        $this->collegeTSToolFileTodolistViewRepository = $collegeTSToolFileTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolFileTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolFileTodolistViews = $this->collegeTSToolFileTodolistViewRepository->all();
    
            return view('college_t_s_tool_file_todolist_views.index')
                ->with('collegeTSToolFileTodolistViews', $collegeTSToolFileTodolistViews);
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
            return view('college_t_s_tool_file_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSToolFileTodolistView = $this->collegeTSToolFileTodolistViewRepository->create($input);
    
            Flash::success('College T S Tool File Todolist View saved successfully.');
            return redirect(route('collegeTSToolFileTodolistViews.index'));
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
            $collegeTSToolFileTodolistView = $this->collegeTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistView))
            {
                Flash::error('College T S Tool File Todolist View not found');
                return redirect(route('collegeTSToolFileTodolistViews.index'));
            }
            
            if($collegeTSToolFileTodolistView -> user_id == $user_id)
            {  
                return view('college_t_s_tool_file_todolist_views.show')->with('collegeTSToolFileTodolistView', $collegeTSToolFileTodolistView);
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
            $collegeTSToolFileTodolistView = $this->collegeTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistView))
            {
                Flash::error('College T S Tool File Todolist View not found');
                return redirect(route('collegeTSToolFileTodolistViews.index'));
            }
    
            if($collegeTSToolFileTodolistView -> user_id == $user_id)
            {
                return view('college_t_s_tool_file_todolist_views.edit')->with('collegeTSToolFileTodolistView', $collegeTSToolFileTodolistView);
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

    public function update($id, UpdateCollegeTSToolFileTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolFileTodolistView = $this->collegeTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistView))
            {
                Flash::error('College T S Tool File Todolist View not found');
                return redirect(route('collegeTSToolFileTodolistViews.index'));
            }
    
            if($collegeTSToolFileTodolistView -> user_id == $user_id)
            {
                $collegeTSToolFileTodolistView = $this->collegeTSToolFileTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool File Todolist View updated successfully.');
                return redirect(route('collegeTSToolFileTodolistViews.index'));
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
            $collegeTSToolFileTodolistView = $this->collegeTSToolFileTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistView))
            {
                Flash::error('College T S Tool File Todolist View not found');
                return redirect(route('collegeTSToolFileTodolistViews.index'));
            }
            
            if($collegeTSToolFileTodolistView -> user_id == $user_id)
            {
                $this->collegeTSToolFileTodolistViewRepository->delete($id);
            
                Flash::success('College T S Tool File Todolist View deleted successfully.');
                return redirect(route('collegeTSToolFileTodolistViews.index'));
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