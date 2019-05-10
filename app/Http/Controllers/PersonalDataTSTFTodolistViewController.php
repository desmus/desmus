<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSTFTodolistViewRequest;
use App\Http\Requests\UpdatePersonalDataTSTFTodolistViewRequest;
use App\Repositories\PersonalDataTSTFTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSTFTodolistViewController extends AppBaseController
{
    private $personalDataTSTFTodolistViewRepository;

    public function __construct(PersonalDataTSTFTodolistViewRepository $personalDataTSTFTodolistViewRepo)
    {
        $this->personalDataTSTFTodolistViewRepository = $personalDataTSTFTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSTFTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSTFTodolistViews = $this->personalDataTSTFTodolistViewRepository->all();
    
            return view('personal_data_t_s_t_f_todolist_views.index')
                ->with('personalDataTSTFTodolistViews', $personalDataTSTFTodolistViews);
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
            return view('personal_data_t_s_t_f_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSTFTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSTFTodolistView = $this->personalDataTSTFTodolistViewRepository->create($input);
    
            Flash::success('PersonalData T S Tool File Todolist View saved successfully.');
            return redirect(route('personalDataTSTFTodolistViews.index'));
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
            $personalDataTSTFTodolistView = $this->personalDataTSTFTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistView))
            {
                Flash::error('PersonalData T S Tool File Todolist View not found');
                return redirect(route('personalDataTSTFTodolistViews.index'));
            }
    
            if($personalDataTSTFTodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_t_f_todolist_views.show')->with('personalDataTSTFTodolistView', $personalDataTSTFTodolistView);
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
            $personalDataTSTFTodolistView = $this->personalDataTSTFTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistView))
            {
                Flash::error('PersonalData T S Tool File Todolist View not found');
                return redirect(route('personalDataTSTFTodolistViews.index'));
            }
    
            if($personalDataTSTFTodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_t_f_todolist_views.edit')->with('personalDataTSTFTodolistView', $personalDataTSTFTodolistView);
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

    public function update($id, UpdatePersonalDataTSTFTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSTFTodolistView = $this->personalDataTSTFTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistView))
            {
                Flash::error('PersonalData T S Tool File Todolist View not found');
                return redirect(route('personalDataTSTFTodolistViews.index'));
            }
            
            if($personalDataTSTFTodolistView -> user_id == $user_id)
            {
                $personalDataTSTFTodolistView = $this->personalDataTSTFTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool File Todolist View updated successfully.');
                return redirect(route('personalDataTSTFTodolistViews.index'));
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
            $personalDataTSTFTodolistView = $this->personalDataTSTFTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTFTodolistView))
            {
                Flash::error('PersonalData T S Tool File Todolist View not found');
                return redirect(route('personalDataTSTFTodolistViews.index'));
            }
    
            if($personalDataTSTFTodolistView -> user_id == $user_id)
            {
                $this->personalDataTSTFTodolistViewRepository->delete($id);
            
                Flash::success('PersonalData T S Tool File Todolist View deleted successfully.');
                return redirect(route('personalDataTSTFTodolistViews.index'));
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