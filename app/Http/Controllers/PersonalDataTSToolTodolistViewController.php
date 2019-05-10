<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\ViewPersonalDataTSToolTodolistViewRequest;
use App\Http\Requests\UpdatePersonalDataTSToolTodolistViewRequest;
use App\Repositories\PersonalDataTSToolTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolTodolistViewController extends AppBaseController
{
    private $personalDataTSToolTodolistViewRepository;

    public function __construct(PersonalDataTSToolTodolistViewRepository $personalDataTSToolTodolistViewRepo)
    {
        $this->personalDataTSToolTodolistViewRepository = $personalDataTSToolTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolTodolistViews = $this->personalDataTSToolTodolistViewRepository->all();
    
            return view('personal_data_t_s_tool_todolist_views.index')
                ->with('personalDataTSToolTodolistViews', $personalDataTSToolTodolistViews);
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
            return view('personal_data_t_s_tool_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSToolTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSToolTodolistView = $this->personalDataTSToolTodolistViewRepository->create($input);
    
            Flash::success('PersonalData T S Tool Todolist View saved successfully.');
            return redirect(route('personalDataTSToolTodolistViews.index'));
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
            $personalDataTSToolTodolistView = $this->personalDataTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistView))
            {
                Flash::error('PersonalData T S Tool Todolist View not found');
                return redirect(route('personalDataTSToolTodolistViews.index'));
            }
            
            if($personalDataTSToolTodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_tool_todolist_views.show')->with('personalDataTSToolTodolistView', $personalDataTSToolTodolistView);
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
            $personalDataTSToolTodolistView = $this->personalDataTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistView))
            {
                Flash::error('PersonalData T S Tool Todolist View not found');
                return redirect(route('personalDataTSToolTodolistViews.index'));
            }
            
            if($personalDataTSToolTodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_tool_todolist_views.edit')->with('personalDataTSToolTodolistView', $personalDataTSToolTodolistView);
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

    public function update($id, UpdatePersonalDataTSToolTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolTodolistView = $this->personalDataTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistView))
            {
                Flash::error('PersonalData T S Tool Todolist View not found');
                return redirect(route('personalDataTSToolTodolistViews.index'));
            }
    
            if($personalDataTSToolTodolistView -> user_id == $user_id)
            {
                $personalDataTSToolTodolistView = $this->personalDataTSToolTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool Todolist View updated successfully.');
                return redirect(route('personalDataTSToolTodolistViews.index'));
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
            $personalDataTSToolTodolistView = $this->personalDataTSToolTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolistView))
            {
                Flash::error('PersonalData T S Tool Todolist View not found');
                return redirect(route('personalDataTSToolTodolistViews.index'));
            }
    
            if($personalDataTSToolTodolistView -> user_id == $user_id)
            {
                $this->personalDataTSToolTodolistViewRepository->delete($id);
            
                Flash::success('PersonalData T S Tool Todolist View deleted successfully.');
                return redirect(route('personalDataTSToolTodolistViews.index'));
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