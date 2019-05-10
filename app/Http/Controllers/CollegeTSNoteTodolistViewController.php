<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSNoteTodolistViewRequest;
use App\Http\Requests\UpdateCollegeTSNoteTodolistViewRequest;
use App\Repositories\CollegeTSNoteTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSNoteTodolistViewController extends AppBaseController
{
    private $collegeTSNoteTodolistViewRepository;

    public function __construct(CollegeTSNoteTodolistViewRepository $collegeTSNoteTodolistViewRepo)
    {
        $this->collegeTSNoteTodolistViewRepository = $collegeTSNoteTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSNoteTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSNoteTodolistViews = $this->collegeTSNoteTodolistViewRepository->all();
    
            return view('college_t_s_note_todolist_views.index')
                ->with('collegeTSNoteTodolistViews', $collegeTSNoteTodolistViews);
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
            return view('college_t_s_note_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSNoteTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSNoteTodolistView = $this->collegeTSNoteTodolistViewRepository->create($input);
    
            Flash::success('College T S Note Todolist View saved successfully.');
            return redirect(route('collegeTSNoteTodolistViews.index'));
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
            $collegeTSNoteTodolistView = $this->collegeTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistView))
            {
                Flash::error('College T S Note Todolist View not found');
                return redirect(route('collegeTSNoteTodolistViews.index'));
            }
    
            if($collegeTSNoteTodolistView -> user_id == $user_id)
            {
                return view('college_t_s_note_todolist_views.show')->with('collegeTSNoteTodolistView', $collegeTSNoteTodolistView);
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
            $collegeTSNoteTodolistView = $this->collegeTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistView))
            {
                Flash::error('College T S Note Todolist View not found');
                return redirect(route('collegeTSNoteTodolistViews.index'));
            }
    
            if($collegeTSNoteTodolistView -> user_id == $user_id)
            {
                return view('college_t_s_note_todolist_views.edit')->with('collegeTSNoteTodolistView', $collegeTSNoteTodolistView);
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

    public function update($id, UpdateCollegeTSNoteTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSNoteTodolistView = $this->collegeTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistView))
            {
                Flash::error('College T S Note Todolist View not found');
                return redirect(route('collegeTSNoteTodolistViews.index'));
            }
    
            if($collegeTSNoteTodolistView -> user_id == $user_id)
            {
                $collegeTSNoteTodolistView = $this->collegeTSNoteTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('College T S Note Todolist View updated successfully.');
                return redirect(route('collegeTSNoteTodolistViews.index'));
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
            $collegeTSNoteTodolistView = $this->collegeTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistView))
            {
                Flash::error('College T S Note Todolist View not found');
                return redirect(route('collegeTSNoteTodolistViews.index'));
            }
    
            if($collegeTSNoteTodolistView -> user_id == $user_id)
            {
                $this->collegeTSNoteTodolistViewRepository->delete($id);
            
                Flash::success('College T S Note Todolist View deleted successfully.');
                return redirect(route('collegeTSNoteTodolistViews.index'));
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