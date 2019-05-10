<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicTodolistDeleteRequest;
use App\Http\Requests\UpdateCollegeTopicTodolistDeleteRequest;
use App\Repositories\CollegeTopicTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicTodolistDeleteController extends AppBaseController
{
    private $collegeTopicTodolistDeleteRepository;

    public function __construct(CollegeTopicTodolistDeleteRepository $collegeTopicTodolistDeleteRepo)
    {
        $this->collegeTopicTodolistDeleteRepository = $collegeTopicTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicTodolistDeletes = $this->collegeTopicTodolistDeleteRepository->all();
    
            return view('college_topic_todolist_deletes.index')
                ->with('collegeTopicTodolistDeletes', $collegeTopicTodolistDeletes);
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
            return view('college_topic_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTopicTodolistDelete = $this->collegeTopicTodolistDeleteRepository->create($input);
    
            Flash::success('College Topic Todolist Delete saved successfully.');
            return redirect(route('collegeTopicTodolistDeletes.index'));
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
            $collegeTopicTodolistDelete = $this->collegeTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistDelete))
            {
                Flash::error('College Topic Todolist Delete not found');
                return redirect(route('collegeTopicTodolistDeletes.index'));
            }
    
            if($collegeTopicTodolistDelete -> user_id == $user_id)
            {
                return view('college_topic_todolist_deletes.show')
                    ->with('collegeTopicTodolistDelete', $collegeTopicTodolistDelete);
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
            $collegeTopicTodolistDelete = $this->collegeTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistDelete))
            {
                Flash::error('College Topic Todolist Delete not found');
                return redirect(route('collegeTopicTodolistDeletes.index'));
            }
            
            if($collegeTopicTodolistDelete -> user_id == $user_id)
            {
                return view('college_topic_todolist_deletes.edit')
                    ->with('collegeTopicTodolistDelete', $collegeTopicTodolistDelete);
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

    public function update($id, UpdateCollegeTopicTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicTodolistDelete = $this->collegeTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistDelete))
            {
                Flash::error('College Topic Todolist Delete not found');
                return redirect(route('collegeTopicTodolistDeletes.index'));
            }
    
            if($collegeTopicTodolistDelete -> user_id == $user_id)
            {
                $collegeTopicTodolistDelete = $this->collegeTopicTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('College Topic Todolist Delete updated successfully.');
                return redirect(route('collegeTopicTodolistDeletes.index'));
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
            $collegeTopicTodolistDelete = $this->collegeTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistDelete))
            {
                Flash::error('College Topic Todolist Delete not found');
                return redirect(route('collegeTopicTodolistDeletes.index'));
            }
    
            if($collegeTopicTodolistDelete -> user_id == $user_id)
            {
                $this->collegeTopicTodolistDeleteRepository->delete($id);
            
                Flash::success('College Topic Todolist Delete deleted successfully.');
                return redirect(route('collegeTopicTodolistDeletes.index'));
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