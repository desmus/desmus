<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGITodolistViewRequest;
use App\Http\Requests\UpdatePersonalDataTSGITodolistViewRequest;
use App\Repositories\PersonalDataTSGITodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGITodolistViewController extends AppBaseController
{
    private $personalDataTSGITodolistViewRepository;

    public function __construct0(PersonalDataTSGITodolistViewRepository $personalDataTSGITodolistViewRepo)
    {
        $this->personalDataTSGITodolistViewRepository = $personalDataTSGITodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGITodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGITodolistViews = $this->personalDataTSGITodolistViewRepository->all();
    
            return view('personal_data_t_s_g_i_todolist_views.index')
                ->with('personalDataTSGITodolistViews', $personalDataTSGITodolistViews);
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
            return view('personal_data_t_s_g_i_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSGITodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSGITodolistView = $this->personalDataTSGITodolistViewRepository->create($input);
    
            Flash::success('PersonalData T S G Image Todolist View saved successfully.');
            return redirect(route('personalDataTSGITodolistViews.index'));
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
            $personalDataTSGITodolistView = $this->personalDataTSGITodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistView))
            {
                Flash::error('PersonalData T S G Image Todolist View not found');
                return redirect(route('personalDataTSGITodolistViews.index'));
            }
            
            if($personalDataTSGITodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_g_i_todolist_views.show')->with('personalDataTSGITodolistView', $personalDataTSGITodolistView);
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
            $personalDataTSGITodolistView = $this->personalDataTSGITodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistView))
            {
                Flash::error('PersonalData T S G Image Todolist View not found');
                return redirect(route('personalDataTSGITodolistViews.index'));
            }
            
            if($personalDataTSGITodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_g_i_todolist_views.edit')->with('personalDataTSGITodolistView', $personalDataTSGITodolistView);
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

    public function update($id, UpdatePersonalDataTSGITodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGITodolistView = $this->personalDataTSGITodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistView))
            {
                Flash::error('PersonalData T S G Image Todolist View not found');
                return redirect(route('personalDataTSGITodolistViews.index'));
            }
            
            if($personalDataTSGITodolistView -> user_id == $user_id)
            {
                $personalDataTSGITodolistView = $this->personalDataTSGITodolistViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S G Image Todolist View updated successfully.');
                return redirect(route('personalDataTSGITodolistViews.index'));
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
            $personalDataTSGITodolistView = $this->personalDataTSGITodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGITodolistView))
            {
                Flash::error('PersonalData T S G Image Todolist View not found');
                return redirect(route('personalDataTSGITodolistViews.index'));
            }
    
            if($personalDataTSGITodolistView -> user_id == $user_id)
            {
                $this->personalDataTSGITodolistViewRepository->delete($id);
            
                Flash::success('PersonalData T S G Image Todolist View deleted successfully.');
                return redirect(route('personalDataTSGITodolistViews.index'));
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