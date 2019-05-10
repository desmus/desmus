<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicTodolistUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTopicTodolistUpdateRequest;
use App\Repositories\PersonalDataTopicTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicTodolistUpdateController extends AppBaseController
{
    private $personalDataTopicTodolistUpdateRepository;

    public function __construct(PersonalDataTopicTodolistUpdateRepository $personalDataTopicTodolistUpdateRepo)
    {
        $this->personalDataTopicTodolistUpdateRepository = $personalDataTopicTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicTodolistUpdates = $this->personalDataTopicTodolistUpdateRepository->all();
    
            return view('personal_data_topic_todolist_updates.index')
                ->with('personalDataTopicTodolistUpdates', $personalDataTopicTodolistUpdates);
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
            return view('personal_data_topic_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTopicTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTopicTodolistUpdate = $this->personalDataTopicTodolistUpdateRepository->create($input);
    
            Flash::success('PersonalData Topic Todolist Update saved successfully.');
            return redirect(route('personalDataTopicTodolistUpdates.index'));
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
            $personalDataTopicTodolistUpdate = $this->personalDataTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistUpdate))
            {
                Flash::error('PersonalData Topic Todolist Update not found');
                return redirect(route('personalDataTopicTodolistUpdates.index'));
            }
            
            if($personalDataTopicTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_topic_todolist_updates.show')
                    ->with('personalDataTopicTodolistUpdate', $personalDataTopicTodolistUpdate);
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
            $personalDataTopicTodolistUpdate = $this->personalDataTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistUpdate))
            {
                Flash::error('PersonalData Topic Todolist Update not found');
                return redirect(route('personalDataTopicTodolistUpdates.index'));
            }
            
            if($personalDataTopicTodolistUpdate -> user_id == $user_id)
            {
                return view('personal_data_topic_todolist_updates.edit')
                    ->with('personalDataTopicTodolistUpdate', $personalDataTopicTodolistUpdate);
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

    public function update($id, UpdatePersonalDataTopicTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicTodolistUpdate = $this->personalDataTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistUpdate))
            {
                Flash::error('PersonalData Topic Todolist Update not found');
                return redirect(route('personalDataTopicTodolistUpdates.index'));
            }
    
            if($personalDataTopicTodolistUpdate -> user_id == $user_id)
            {
                $personalDataTopicTodolistUpdate = $this->personalDataTopicTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Todolist Update updated successfully.');
                return redirect(route('personalDataTopicTodolistUpdates.index'));
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
            $personalDataTopicTodolistUpdate = $this->personalDataTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolistUpdate))
            {
                Flash::error('PersonalData Topic Todolist Update not found');
                return redirect(route('personalDataTopicTodolistUpdates.index'));
            }
    
            if($personalDataTopicTodolistUpdate -> user_id == $user_id)
            {
                $this->personalDataTopicTodolistUpdateRepository->delete($id);
            
                Flash::success('PersonalData Topic Todolist Update deleted successfully.');
                return redirect(route('personalDataTopicTodolistUpdates.index'));
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