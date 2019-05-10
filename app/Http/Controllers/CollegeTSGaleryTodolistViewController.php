<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryTodolistViewRequest;
use App\Http\Requests\UpdateCollegeTSGaleryTodolistViewRequest;
use App\Repositories\CollegeTSGaleryTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryTodolistViewController extends AppBaseController
{
    private $collegeTSGaleryTodolistViewRepository;

    public function __construct(CollegeTSGaleryTodolistViewRepository $collegeTSGaleryTodolistViewRepo)
    {
        $this->collegeTSGaleryTodolistViewRepository = $collegeTSGaleryTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGaleryTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryTodolistViews = $this->collegeTSGaleryTodolistViewRepository->all();
    
            return view('college_t_s_galery_todolist_views.index')
                ->with('collegeTSGaleryTodolistViews', $collegeTSGaleryTodolistViews);
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
            return view('college_t_s_galery_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSGaleryTodolistView = $this->collegeTSGaleryTodolistViewRepository->create($input);
    
            Flash::success('College T S Galery Todolist View saved successfully.');
            return redirect(route('collegeTSGaleryTodolistViews.index'));
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
            $collegeTSGaleryTodolistView = $this->collegeTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistView))
            {
                Flash::error('College T S Galery Todolist View not found');
                return redirect(route('collegeTSGaleryTodolistViews.index'));
            }
            
            if($collegeTSGaleryTodolistView -> user_id == $user_id)
            {
                return view('college_t_s_galery_todolist_views.show')->with('collegeTSGaleryTodolistView', $collegeTSGaleryTodolistView);
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
            $collegeTSGaleryTodolistView = $this->collegeTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistView))
            {
                Flash::error('College T S Galery Todolist View not found');
                return redirect(route('collegeTSGaleryTodolistViews.index'));
            }
    
            if($collegeTSGaleryTodolistView -> user_id == $user_id)
            {
                return view('college_t_s_galery_todolist_views.edit')->with('collegeTSGaleryTodolistView', $collegeTSGaleryTodolistView);
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

    public function update($id, UpdateCollegeTSGaleryTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGaleryTodolistView = $this->collegeTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistView))
            {
                Flash::error('College T S Galery Todolist View not found');
                return redirect(route('collegeTSGaleryTodolistViews.index'));
            }
    
            if($collegeTSGaleryTodolistView -> user_id == $user_id)
            {
                $collegeTSGaleryTodolistView = $this->collegeTSGaleryTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('College T S Galery Todolist View updated successfully.');
                return redirect(route('collegeTSGaleryTodolistViews.index'));
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
            $collegeTSGaleryTodolistView = $this->collegeTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistView))
            {
                Flash::error('College T S Galery Todolist View not found');
                return redirect(route('collegeTSGaleryTodolistViews.index'));
            }
    
            if($collegeTSGaleryTodolistView -> user_id == $user_id)
            {
                $this->collegeTSGaleryTodolistViewRepository->delete($id);
            
                Flash::success('College T S Galery Todolist View deleted successfully.');
                return redirect(route('collegeTSGaleryTodolistViews.index'));
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