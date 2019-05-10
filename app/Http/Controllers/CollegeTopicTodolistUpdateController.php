<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicTodolistUpdateRequest;
use App\Http\Requests\UpdateCollegeTopicTodolistUpdateRequest;
use App\Repositories\CollegeTopicTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicTodolistUpdateController extends AppBaseController
{
    private $collegeTopicTodolistUpdateRepository;

    public function __construct(CollegeTopicTodolistUpdateRepository $collegeTopicTodolistUpdateRepo)
    {
        $this->collegeTopicTodolistUpdateRepository = $collegeTopicTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicTodolistUpdates = $this->collegeTopicTodolistUpdateRepository->all();
    
            return view('college_topic_todolist_updates.index')
                ->with('collegeTopicTodolistUpdates', $collegeTopicTodolistUpdates);
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
            return view('college_topic_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTopicTodolistUpdate = $this->collegeTopicTodolistUpdateRepository->create($input);
    
            Flash::success('College Topic Todolist Update saved successfully.');
            return redirect(route('collegeTopicTodolistUpdates.index'));
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
            $collegeTopicTodolistUpdate = $this->collegeTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistUpdate))
            {
                Flash::error('College Topic Todolist Update not found');
                return redirect(route('collegeTopicTodolistUpdates.index'));
            }
            
            if($collegeTopicTodolistUpdate -> user_id == $user_id)
            {
                return view('college_topic_todolist_updates.show')->with('collegeTopicTodolistUpdate', $collegeTopicTodolistUpdate);
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
            $collegeTopicTodolistUpdate = $this->collegeTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistUpdate))
            {
                Flash::error('College Topic Todolist Update not found');
                return redirect(route('collegeTopicTodolistUpdates.index'));
            }
    
            if($collegeTopicTodolistUpdate -> user_id == $user_id)
            {
                return view('college_topic_todolist_updates.edit')->with('collegeTopicTodolistUpdate', $collegeTopicTodolistUpdate);
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

    public function update($id, UpdateCollegeTopicTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicTodolistUpdate = $this->collegeTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistUpdate))
            {
                Flash::error('College Topic Todolist Update not found');
                return redirect(route('collegeTopicTodolistUpdates.index'));
            }
            
            if($collegeTopicTodolistUpdate -> user_id == $user_id)
            {
                $collegeTopicTodolistUpdate = $this->collegeTopicTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('College Topic Todolist Update updated successfully.');
                return redirect(route('collegeTopicTodolistUpdates.index'));
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
            $collegeTopicTodolistUpdate = $this->collegeTopicTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistUpdate))
            {
                Flash::error('College Topic Todolist Update not found');
                return redirect(route('collegeTopicTodolistUpdates.index'));
            }
            
            if($collegeTopicTodolistUpdate -> user_id == $user_id)
            {
                $this->collegeTopicTodolistUpdateRepository->delete($id);
            
                Flash::success('College Topic Todolist Update deleted successfully.');
                return redirect(route('collegeTopicTodolistUpdates.index'));
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