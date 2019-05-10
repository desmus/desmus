<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryTodolistViewRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryTodolistViewRequest;
use App\Repositories\PersonalDataTSGaleryTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryTodolistViewController extends AppBaseController
{
    private $personalDataTSGaleryTodolistViewRepository;

    public function __construct(PersonalDataTSGaleryTodolistViewRepository $personalDataTSGaleryTodolistViewRepo)
    {
        $this->personalDataTSGaleryTodolistViewRepository = $personalDataTSGaleryTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryTodolistViews = $this->personalDataTSGaleryTodolistViewRepository->all();
    
            return view('personal_data_t_s_galery_todolist_views.index')
                ->with('personalDataTSGaleryTodolistViews', $personalDataTSGaleryTodolistViews);
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
            return view('personal_data_t_s_galery_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSGaleryTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSGaleryTodolistView = $this->personalDataTSGaleryTodolistViewRepository->create($input);
    
            Flash::success('PersonalData T S Galery Todolist View saved successfully.');
            return redirect(route('personalDataTSGaleryTodolistViews.index'));
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
            $personalDataTSGaleryTodolistView = $this->personalDataTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistView))
            {
                Flash::error('PersonalData T S Galery Todolist View not found');
                return redirect(route('personalDataTSGaleryTodolistViews.index'));
            }
            
            if($personalDataTSGaleryTodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_galery_todolist_views.show')->with('personalDataTSGaleryTodolistView', $personalDataTSGaleryTodolistView);
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
            $personalDataTSGaleryTodolistView = $this->personalDataTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistView))
            {
                Flash::error('PersonalData T S Galery Todolist View not found');
                return redirect(route('personalDataTSGaleryTodolistViews.index'));
            }
    
            if($personalDataTSGaleryTodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_galery_todolist_views.edit')->with('personalDataTSGaleryTodolistView', $personalDataTSGaleryTodolistView);
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

    public function update($id, UpdatePersonalDataTSGaleryTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryTodolistView = $this->personalDataTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistView))
            {
                Flash::error('PersonalData T S Galery Todolist View not found');
                return redirect(route('personalDataTSGaleryTodolistViews.index'));
            }
            
            if($personalDataTSGaleryTodolistView -> user_id == $user_id)
            {
                $personalDataTSGaleryTodolistView = $this->personalDataTSGaleryTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery Todolist View updated successfully.');
                return redirect(route('personalDataTSGaleryTodolistViews.index'));
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
            $personalDataTSGaleryTodolistView = $this->personalDataTSGaleryTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolistView))
            {
                Flash::error('PersonalData T S Galery Todolist View not found');
                return redirect(route('personalDataTSGaleryTodolistViews.index'));
            }
    
            if($personalDataTSGaleryTodolistView -> user_id == $user_id)
            {
                $this->personalDataTSGaleryTodolistViewRepository->delete($id);
            
                Flash::success('PersonalData T S Galery Todolist View deleted successfully.');
                return redirect(route('personalDataTSGaleryTodolistViews.index'));
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