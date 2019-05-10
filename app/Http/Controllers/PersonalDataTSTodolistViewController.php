<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSTodolistViewRequest;
use App\Http\Requests\UpdatePersonalDataTSTodolistViewRequest;
use App\Repositories\PersonalDataTSTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSTodolistViewController extends AppBaseController
{
    private $personalDataTSTodolistViewRepository;

    public function __construct(PersonalDataTSTodolistViewRepository $personalDataTSTodolistViewRepo)
    {
        $this->personalDataTSTodolistViewRepository = $personalDataTSTodolistViewRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSTodolistViews = $this->personalDataTSTodolistViewRepository->all();
    
            return view('personal_data_t_s_todolist_views.index')
                ->with('personalDataTSTodolistViews', $personalDataTSTodolistViews);
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
            return view('personal_data_t_s_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(ViewPersonalDataTSTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSTodolistView = $this->personalDataTSTodolistViewRepository->create($input);
    
            Flash::success('PersonalData Topic Section Todolist View saved successfully.');
            return redirect(route('personalDataTSTodolistViews.index'));
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
            $personalDataTSTodolistView = $this->personalDataTSTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistView))
            {
                Flash::error('PersonalData Topic Section Todolist View not found');
                return redirect(route('personalDataTSTodolistViews.index'));
            }
            
            if($personalDataTSTodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_todolist_views.show')
                    ->with('personalDataTSTodolistView', $personalDataTSTodolistView);
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
            $personalDataTSTodolistView = $this->personalDataTSTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistView))
            {
                Flash::error('PersonalData Topic Section Todolist View not found');
                return redirect(route('personalDataTSTodolistViews.index'));
            }
    
            if($personalDataTSTodolistView -> user_id == $user_id)
            {
                return view('personal_data_t_s_todolist_views.edit')
                    ->with('personalDataTSTodolistView', $personalDataTSTodolistView);
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

    public function update($id, UpdatePersonalDataTSTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSTodolistView = $this->personalDataTSTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistView))
            {
                Flash::error('PersonalData Topic Section Todolist View not found');
                return redirect(route('personalDataTSTodolistViews.index'));
            }
    
            if($personalDataTSTodolistView -> user_id == $user_id)
            {
                $personalDataTSTodolistView = $this->personalDataTSTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Section Todolist View updated successfully.');
                return redirect(route('personalDataTSTodolistViews.index'));
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
            $personalDataTSTodolistView = $this->personalDataTSTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolistView))
            {
                Flash::error('PersonalData Topic Section Todolist View not found');
                return redirect(route('personalDataTSTodolistViews.index'));
            }
    
            if($personalDataTSTodolistView -> user_id == $user_id)
            {
                $this->personalDataTSTodolistViewRepository->delete($id);
            
                Flash::success('PersonalData Topic Section Todolist View deleted successfully.');
                return redirect(route('personalDataTSTodolistViews.index'));
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