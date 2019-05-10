<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolTodolistViewRequest;
use App\Http\Requests\UpdateCollegeTSToolTodolistViewRequest;
use App\Repositories\CollegeTSToolTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolTodolistViewController extends AppBaseController
{
    private $collegeTSToolTodolistViewRepository;

    public function __construct(CollegeTSToolTodolistViewRepository $collegeTSToolTodolistViewRepo)
    {
        $this->collegeTSToolTodolistViewRepository = $collegeTSToolTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolTodolistViews = $this->collegeTSToolTodolistViewRepository->all();
    
            return view('college_t_s_tool_todolist_views.index')
                ->with('collegeTSToolTodolistViews', $collegeTSToolTodolistViews);
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
            return view('college_t_s_tool_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSToolTodolistView = $this->collegeTSToolTodolistViewRepository->create($input);
    
            Flash::success('College T S Tool Todolist View saved successfully.');
            return redirect(route('collegeTSToolTodolistViews.index'));
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
            $collegeTSToolTodolistView = $this->collegeTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistView))
            {
                Flash::error('College T S Tool Todolist View not found');
                return redirect(route('collegeTSToolTodolistViews.index'));
            }
            
            if($collegeTSToolTodolistView -> user_id == $user_id)
            {
                return view('college_t_s_tool_todolist_views.show')->with('collegeTSToolTodolistView', $collegeTSToolTodolistView);
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
            $collegeTSToolTodolistView = $this->collegeTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistView))
            {
                Flash::error('College T S Tool Todolist View not found');
                return redirect(route('collegeTSToolTodolistViews.index'));
            }
            
            if($collegeTSToolTodolistView -> user_id == $user_id)
            {
                return view('college_t_s_tool_todolist_views.edit')->with('collegeTSToolTodolistView', $collegeTSToolTodolistView);
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

    public function update($id, UpdateCollegeTSToolTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolTodolistView = $this->collegeTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistView))
            {
                Flash::error('College T S Tool Todolist View not found');
                return redirect(route('collegeTSToolTodolistViews.index'));
            }
            
            if($collegeTSToolTodolistView -> user_id == $user_id)
            {
                $collegeTSToolTodolistView = $this->collegeTSToolTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool Todolist View updated successfully.');
                return redirect(route('collegeTSToolTodolistViews.index'));
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
            $collegeTSToolTodolistView = $this->collegeTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistView))
            {
                Flash::error('College T S Tool Todolist View not found');
                return redirect(route('collegeTSToolTodolistViews.index'));
            }
            
            if($collegeTSToolTodolistView -> user_id == $user_id)
            {
                $this->collegeTSToolTodolistViewRepository->delete($id);
                
                Flash::success('College T S Tool Todolist View deleted successfully.');
                return redirect(route('collegeTSToolTodolistViews.index'));
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