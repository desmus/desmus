<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTodolistViewRequest;
use App\Http\Requests\UpdatePersonalDataTodolistViewRequest;
use App\Repositories\PersonalDataTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTodolistViewController extends AppBaseController
{
    private $personalDataTodolistViewRepository;

    public function __construct(PersonalDataTodolistViewRepository $personalDataTodolistViewRepo)
    {
        $this->personalDataTodolistViewRepository = $personalDataTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTodolistViews = $this->personalDataTodolistViewRepository->all();
    
            return view('personal_data_todolist_views.index')
                ->with('personalDataTodolistViews', $personalDataTodolistViews);
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
            return view('personal_data_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTodolistView = $this->personalDataTodolistViewRepository->create($input);
    
            Flash::success('PersonalData Todolist View saved successfully.');
            return redirect(route('personalDataTodolistViews.index'));
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
            $personalDataTodolistView = $this->personalDataTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistView))
            {
                Flash::error('PersonalData Todolist View not found');
                return redirect(route('personalDataTodolistViews.index'));
            }
            
            if($personalDataTodolistView -> user_id == $user_id)
            {
                return view('personal_data_todolist_views.show')
                    ->with('personalDataTodolistView', $personalDataTodolistView);
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
            $personalDataTodolistView = $this->personalDataTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistView))
            {
                Flash::error('PersonalData Todolist View not found');
                return redirect(route('personalDataTodolistViews.index'));
            }
    
            if($personalDataTodolistView -> user_id == $user_id)
            {
                return view('personal_data_todolist_views.edit')->with('personalDataTodolistView', $personalDataTodolistView);
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

    public function update($id, UpdatePersonalDataTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTodolistView = $this->personalDataTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistView))
            {
                Flash::error('PersonalData Todolist View not found');
                return redirect(route('personalDataTodolistViews.index'));
            }
    
            if($personalDataTodolistView -> user_id == $user_id)
            {
                $personalDataTodolistView = $this->personalDataTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Todolist View updated successfully.');
                return redirect(route('personalDataTodolistViews.index'));
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
            $personalDataTodolistView = $this->personalDataTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolistView))
            {
                Flash::error('PersonalData Todolist View not found');
                return redirect(route('personalDataTodolistViews.index'));
            }
            
            if($personalDataTodolistView -> user_id == $user_id)
            {
                $this->personalDataTodolistViewRepository->delete($id);
            
                Flash::success('PersonalData Todolist View deleted successfully.');
                return redirect(route('personalDataTodolistViews.index'));
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