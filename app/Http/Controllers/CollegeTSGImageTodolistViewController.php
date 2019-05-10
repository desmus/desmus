<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCollegeTSGImageTodolistViewRequest;
use App\Http\Requests\UpdateCollegeTSGImageTodolistViewRequest;
use App\Repositories\CollegeTSGImageTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGImageTodolistViewController extends AppBaseController
{
    private $collegeTSGImageTodolistViewRepository;

    public function __construct(CollegeTSGImageTodolistViewRepository $collegeTSGImageTodolistViewRepo)
    {
        $this->collegeTSGImageTodolistViewRepository = $collegeTSGImageTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGImageTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGImageTodolistViews = $this->collegeTSGImageTodolistViewRepository->all();
    
            return view('college_t_s_g_image_todolist_views.index')
                ->with('collegeTSGImageTodolistViews', $collegeTSGImageTodolistViews);
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
            return view('college_t_s_g_image_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGImageTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSGImageTodolistView = $this->collegeTSGImageTodolistViewRepository->create($input);
    
            Flash::success('College T S G Image Todolist View saved successfully.');
            return redirect(route('collegeTSGImageTodolistViews.index'));
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
            $collegeTSGImageTodolistView = $this->collegeTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistView))
            {
                Flash::error('College T S G Image Todolist View not found');
                return redirect(route('collegeTSGImageTodolistViews.index'));
            }
    
            if($collegeTSGImageTodolistView -> user_id == $user_id)
            {
                return view('college_t_s_g_image_todolist_views.show')
                    ->with('collegeTSGImageTodolistView', $collegeTSGImageTodolistView);
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
            $collegeTSGImageTodolistView = $this->collegeTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistView))
            {
                Flash::error('College T S G Image Todolist View not found');
                return redirect(route('collegeTSGImageTodolistViews.index'));
            }
    
            if($collegeTSGImageTodolistView -> user_id == $user_id)
            {
                return view('college_t_s_g_image_todolist_views.edit')
                    ->with('collegeTSGImageTodolistView', $collegeTSGImageTodolistView);
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

    public function update($id, UpdateCollegeTSGImageTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGImageTodolistView = $this->collegeTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistView))
            {
                Flash::error('College T S G Image Todolist View not found');
                return redirect(route('collegeTSGImageTodolistViews.index'));
            }
            
            if($collegeTSGImageTodolistView -> user_id == $user_id)
            {
                $collegeTSGImageTodolistView = $this->collegeTSGImageTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('College T S G Image Todolist View updated successfully.');
                return redirect(route('collegeTSGImageTodolistViews.index'));
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
            $collegeTSGImageTodolistView = $this->collegeTSGImageTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistView))
            {
                Flash::error('College T S G Image Todolist View not found');
                return redirect(route('collegeTSGImageTodolistViews.index'));
            }
            
            if($collegeTSGImageTodolistView -> user_id == $user_id)
            {
                $this->collegeTSGImageTodolistViewRepository->delete($id);
            
                Flash::success('College T S G Image Todolist View deleted successfully.');
                return redirect(route('collegeTSGImageTodolistViews.index'));
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