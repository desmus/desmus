<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicTodolistViewRequest;
use App\Http\Requests\UpdatePersonalDataTopicTodolistViewRequest;
use App\Repositories\PersonalDataTopicTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicTodolistViewController extends AppBaseController
{
    private $personalDataTopicTodolistViewRepository;

    public function __construct(PersonalDataTopicTodolistViewRepository $personalDataTopicTodolistViewRepo)
    {
        $this->personalDataTopicTodolistViewRepository = $personalDataTopicTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicTodolistViews = $this->personalDataTopicTodolistViewRepository->all();
    
            return view('personal_data_topic_todolist_views.index')
                ->with('personalDataTopicTodolistViews', $personalDataTopicTodolistViews);
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
            return view('personal_data_topic_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTopicTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTopicTodolistView = $this->personalDataTopicTodolistViewRepository->create($input);
    
            Flash::success('PersonalData Topic Todolist View saved successfully.');
            return redirect(route('personalDataTopicTodolistViews.index'));
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
            $personalDataTopicTodolistView = $this->personalDataTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistView))
            {
                Flash::error('PersonalData Topic Todolist View not found');
                return redirect(route('personalDataTopicTodolistViews.index'));
            }
            
            if($personalDataTopicTodolistView -> user_id == $user_id)
            {
                return view('personal_data_topic_todolist_views.show')
                    ->with('personalDataTopicTodolistView', $personalDataTopicTodolistView);
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
            $personalDataTopicTodolistView = $this->personalDataTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistView))
            {
                Flash::error('PersonalData Topic Todolist View not found');
                return redirect(route('personalDataTopicTodolistViews.index'));
            }
            
            if($personalDataTopicTodolistView -> user_id == $user_id)
            {
                return view('personal_data_topic_todolist_views.edit')
                    ->with('personalDataTopicTodolistView', $personalDataTopicTodolistView);
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

    public function update($id, UpdatePersonalDataTopicTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicTodolistView = $this->personalDataTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistView))
            {
                Flash::error('PersonalData Topic Todolist View not found');
                return redirect(route('personalDataTopicTodolistViews.index'));
            }
    
            if($personalDataTopicTodolistView -> user_id == $user_id)
            {
                $personalDataTopicTodolistView = $this->personalDataTopicTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Todolist View updated successfully.');
                return redirect(route('personalDataTopicTodolistViews.index'));
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
            $personalDataTopicTodolistView = $this->personalDataTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistView))
            {
                Flash::error('PersonalData Topic Todolist View not found');
                return redirect(route('personalDataTopicTodolistViews.index'));
            }
    
            if($personalDataTopicTodolistView -> user_id == $user_id)
            {
                $this->personalDataTopicTodolistViewRepository->delete($id);
            
                Flash::success('PersonalData Topic Todolist View deleted successfully.');
                return redirect(route('personalDataTopicTodolistViews.index'));
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