<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicTodolistDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTopicTodolistDeleteRequest;
use App\Repositories\PersonalDataTopicTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicTodolistDeleteController extends AppBaseController
{
    private $personalDataTopicTodolistDeleteRepository;

    public function __construct(PersonalDataTopicTodolistDeleteRepository $personalDataTopicTodolistDeleteRepo)
    {
        $this->personalDataTopicTodolistDeleteRepository = $personalDataTopicTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicTodolistDeletes = $this->personalDataTopicTodolistDeleteRepository->all();
    
            return view('personal_data_topic_todolist_deletes.index')
                ->with('personalDataTopicTodolistDeletes', $personalDataTopicTodolistDeletes);
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
            return view('personal_data_topic_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTopicTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTopicTodolistDelete = $this->personalDataTopicTodolistDeleteRepository->create($input);
    
            Flash::success('PersonalData Topic Todolist Delete saved successfully.');
            return redirect(route('personalDataTopicTodolistDeletes.index'));
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
            $personalDataTopicTodolistDelete = $this->personalDataTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistDelete))
            {
                Flash::error('PersonalData Topic Todolist Delete not found');
                return redirect(route('personalDataTopicTodolistDeletes.index'));
            }
            
            if($personalDataTopicTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_topic_todolist_deletes.show')
                    ->with('personalDataTopicTodolistDelete', $personalDataTopicTodolistDelete);
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
            $personalDataTopicTodolistDelete = $this->personalDataTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistDelete))
            {
                Flash::error('PersonalData Topic Todolist Delete not found');
                return redirect(route('personalDataTopicTodolistDeletes.index'));
            }
            
            if($personalDataTopicTodolistDelete -> user_id == $user_id)
            {
                return view('personal_data_topic_todolist_deletes.edit')
                    ->with('personalDataTopicTodolistDelete', $personalDataTopicTodolistDelete);
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

    public function update($id, UpdatePersonalDataTopicTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicTodolistDelete = $this->personalDataTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistDelete))
            {
                Flash::error('PersonalData Topic Todolist Delete not found');
                return redirect(route('personalDataTopicTodolistDeletes.index'));
            }
    
            if($personalDataTopicTodolistDelete -> user_id == $user_id)
            {
                $personalDataTopicTodolistDelete = $this->personalDataTopicTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Todolist Delete updated successfully.');
                return redirect(route('personalDataTopicTodolistDeletes.index'));
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
            $personalDataTopicTodolistDelete = $this->personalDataTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistDelete))
            {
                Flash::error('PersonalData Topic Todolist Delete not found');
                return redirect(route('personalDataTopicTodolistDeletes.index'));
            }
    
            if($personalDataTopicTodolistDelete -> user_id == $user_id)
            {
                $this->personalDataTopicTodolistDeleteRepository->delete($id);
            
                Flash::success('PersonalData Topic Todolist Delete deleted successfully.');
                return redirect(route('personalDataTopicTodolistDeletes.index'));
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