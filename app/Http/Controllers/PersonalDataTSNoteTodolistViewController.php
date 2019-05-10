<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSNoteTodolistViewRequest;
use App\Http\Requests\UpdatePersonalDataTSNoteTodolistViewRequest;
use App\Repositories\PersonalDataTSNoteTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSNoteTodolistViewController extends AppBaseController
{
    private $personalDataTSNoteTodolistViewRepository;

    public function __construct(PersonalDataTSNoteTodolistViewRepository $personalDataTSNoteTodolistViewRepo)
    {
        $this->personalDataTSNoteTodolistViewRepository = $personalDataTSNoteTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSNoteTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSNoteTodolistViews = $this->personalDataTSNoteTodolistViewRepository->all();
    
            return view('personal_data_t_s_note_todolist_views.index')
                ->with('personalDataTSNoteTodolistViews', $personalDataTSNoteTodolistViews);
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
            return view('personal_data_t_s_note_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSNoteTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSNoteTodolistView = $this->personalDataTSNoteTodolistViewRepository->create($input);
    
            Flash::success('PersonalData T S Note Todolist View saved successfully.');
            return redirect(route('personalDataTSNoteTodolistViews.index'));
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
            $personalDataTSNoteTodolistView = $this->personalDataTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistView))
            {
                Flash::error('PersonalData T S Note Todolist View not found');
                return redirect(route('personalDataTSNoteTodolistViews.index'));
            }
    
            if($personalDataTSNoteTodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_note_todolist_views.show')->with('personalDataTSNoteTodolistView', $personalDataTSNoteTodolistView);
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
            $personalDataTSNoteTodolistView = $this->personalDataTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistView))
            {
                Flash::error('PersonalData T S Note Todolist View not found');
                return redirect(route('personalDataTSNoteTodolistViews.index'));
            }
    
            if($personalDataTSNoteTodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_note_todolist_views.edit')->with('personalDataTSNoteTodolistView', $personalDataTSNoteTodolistView);
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

    public function update($id, UpdatePersonalDataTSNoteTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSNoteTodolistView = $this->personalDataTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistView))
            {
                Flash::error('PersonalData T S Note Todolist View not found');
                return redirect(route('personalDataTSNoteTodolistViews.index'));
            }
            
            if($personalDataTSNoteTodolistView -> user_id == $user_id)
            {
                $personalDataTSNoteTodolistView = $this->personalDataTSNoteTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Note Todolist View updated successfully.');
                return redirect(route('personalDataTSNoteTodolistViews.index'));
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
            $personalDataTSNoteTodolistView = $this->personalDataTSNoteTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolistView))
            {
                Flash::error('PersonalData T S Note Todolist View not found');
                return redirect(route('personalDataTSNoteTodolistViews.index'));
            }
            
            if($personalDataTSNoteTodolistView -> user_id == $user_id)
            {
                $this->personalDataTSNoteTodolistViewRepository->delete($id);
            
                Flash::success('PersonalData T S Note Todolist View deleted successfully.');
                return redirect(route('personalDataTSNoteTodolistViews.index'));
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