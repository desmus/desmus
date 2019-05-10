<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicTodolistCreateRequest;
use App\Http\Requests\UpdatePersonalDataTopicTodolistCreateRequest;
use App\Repositories\PersonalDataTopicTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicTodolistCreateController extends AppBaseController
{
    private $personalDataTopicTodolistCreateRepository;

    public function __construct(PersonalDataTopicTodolistCreateRepository $personalDataTopicTodolistCreateRepo)
    {
        $this->personalDataTopicTodolistCreateRepository = $personalDataTopicTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicTodolistCreates = $this->personalDataTopicTodolistCreateRepository->all();
    
            return view('personal_data_topic_todolist_creates.index')
                ->with('personalDataTopicTodolistCreates', $personalDataTopicTodolistCreates);
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
            return view('personal_data_topic_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTopicTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTopicTodolistCreate = $this->personalDataTopicTodolistCreateRepository->create($input);
    
            Flash::success('PersonalData Topic Todolist Create saved successfully.');
            return redirect(route('personalDataTopicTodolistCreates.index'));
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
            $personalDataTopicTodolistCreate = $this->personalDataTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistCreate))
            {
                Flash::error('PersonalData Topic Todolist Create not found');
                return redirect(route('personalDataTopicTodolistCreates.index'));
            }
            
            if($personalDataTopicTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_topic_todolist_creates.show')
                    ->with('personalDataTopicTodolistCreate', $personalDataTopicTodolistCreate);
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
            $personalDataTopicTodolistCreate = $this->personalDataTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistCreate))
            {
                Flash::error('PersonalData Topic Todolist Create not found');
                return redirect(route('personalDataTopicTodolistCreates.index'));
            }
            
            if($personalDataTopicTodolistCreate -> user_id == $user_id)
            {
                return view('personal_data_topic_todolist_creates.edit')
                    ->with('personalDataTopicTodolistCreate', $personalDataTopicTodolistCreate);
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

    public function update($id, UpdatePersonalDataTopicTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicTodolistCreate = $this->personalDataTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistCreate))
            {
                Flash::error('PersonalData Topic Todolist Create not found');
                return redirect(route('personalDataTopicTodolistCreates.index'));
            }
    
            if($personalDataTopicTodolistCreate -> user_id == $user_id)
            {
                $personalDataTopicTodolistCreate = $this->personalDataTopicTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Todolist Create updated successfully.');
                return redirect(route('personalDataTopicTodolistCreates.index'));
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
            $personalDataTopicTodolistCreate = $this->personalDataTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistCreate))
            {
                Flash::error('PersonalData Topic Todolist Create not found');
                return redirect(route('personalDataTopicTodolistCreates.index'));
            }
    
            if($personalDataTopicTodolistCreate -> user_id == $user_id)
            {
                $this->personalDataTopicTodolistCreateRepository->delete($id);
            
                Flash::success('PersonalData Topic Todolist Create deleted successfully.');
                return redirect(route('personalDataTopicTodolistCreates.index'));
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