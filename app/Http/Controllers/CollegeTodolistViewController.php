<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTodolistViewRequest;
use App\Http\Requests\UpdateCollegeTodolistViewRequest;
use App\Repositories\CollegeTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTodolistViewController extends AppBaseController
{
    private $collegeTodolistViewRepository;

    public function __construct(CollegeTodolistViewRepository $collegeTodolistViewRepo)
    {
        $this->collegeTodolistViewRepository = $collegeTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTodolistViews = $this->collegeTodolistViewRepository->all();
    
            return view('college_todolist_views.index')
                ->with('collegeTodolistViews', $collegeTodolistViews);
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
            return view('college_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTodolistView = $this->collegeTodolistViewRepository->create($input);

            Flash::success('College Todolist View saved successfully.');
            return redirect(route('collegeTodolistViews.index'));
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
            $collegeTodolistView = $this->collegeTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistView))
            {
                Flash::error('College Todolist View not found');
                return redirect(route('collegeTodolistViews.index'));
            }
    
            if($collegeTodolistView -> user_id == $user_id)
            {  
                return view('college_todolist_views.show')->with('collegeTodolistView', $collegeTodolistView);
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
            $collegeTodolistView = $this->collegeTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistView))
            {
                Flash::error('College Todolist View not found');
                return redirect(route('collegeTodolistViews.index'));
            }
            
            if($collegeTodolistView -> user_id == $user_id)
            {
                return view('college_todolist_views.edit')->with('collegeTodolistView', $collegeTodolistView);
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

    public function update($id, UpdateCollegeTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTodolistView = $this->collegeTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistView))
            {
                Flash::error('College Todolist View not found');
                return redirect(route('collegeTodolistViews.index'));
            }
    
            if($collegeTodolistView -> user_id == $user_id)
            {
                $collegeTodolistView = $this->collegeTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('College Todolist View updated successfully.');
                return redirect(route('collegeTodolistViews.index'));
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
            $collegeTodolistView = $this->collegeTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistView))
            {
                Flash::error('College Todolist View not found');
                return redirect(route('collegeTodolistViews.index'));
            }
            
            if($collegeTodolistView -> user_id == $user_id)
            {
                $this->collegeTodolistViewRepository->delete($id);
            
                Flash::success('College Todolist View deleted successfully.');
                return redirect(route('collegeTodolistViews.index'));
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