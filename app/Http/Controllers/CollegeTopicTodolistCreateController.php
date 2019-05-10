<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicTodolistCreateRequest;
use App\Http\Requests\UpdateCollegeTopicTodolistCreateRequest;
use App\Repositories\CollegeTopicTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicTodolistCreateController extends AppBaseController
{
    private $collegeTopicTodolistCreateRepository;

    public function __construct(CollegeTopicTodolistCreateRepository $collegeTopicTodolistCreateRepo)
    {
        $this->collegeTopicTodolistCreateRepository = $collegeTopicTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicTodolistCreates = $this->collegeTopicTodolistCreateRepository->all();
    
            return view('college_topic_todolist_creates.index')
                ->with('collegeTopicTodolistCreates', $collegeTopicTodolistCreates);
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
            return view('college_topic_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTopicTodolistCreate = $this->collegeTopicTodolistCreateRepository->create($input);
    
            Flash::success('College Topic Todolist Create saved successfully.');
            return redirect(route('collegeTopicTodolistCreates.index'));
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
            $collegeTopicTodolistCreate = $this->collegeTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistCreate))
            {
                Flash::error('College Topic Todolist Create not found');
                return redirect(route('collegeTopicTodolistCreates.index'));
            }
            
            if($collegeTopicTodolistCreate -> user_id == $user_id)
            {
                return view('college_topic_todolist_creates.show')
                    ->with('collegeTopicTodolistCreate', $collegeTopicTodolistCreate);
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
            $collegeTopicTodolistCreate = $this->collegeTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistCreate))
            {
                Flash::error('College Topic Todolist Create not found');
                return redirect(route('collegeTopicTodolistCreates.index'));
            }
            
            if($collegeTopicTodolistCreate -> user_id == $user_id)
            {
                return view('college_topic_todolist_creates.edit')
                    ->with('collegeTopicTodolistCreate', $collegeTopicTodolistCreate);
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

    public function update($id, UpdateCollegeTopicTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicTodolistCreate = $this->collegeTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistCreate))
            {
                Flash::error('College Topic Todolist Create not found');
                return redirect(route('collegeTopicTodolistCreates.index'));
            }
    
            if($collegeTopicTodolistCreate -> user_id == $user_id)
            {
                $collegeTopicTodolistCreate = $this->collegeTopicTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('College Topic Todolist Create updated successfully.');
                return redirect(route('collegeTopicTodolistCreates.index'));
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
            $collegeTopicTodolistCreate = $this->collegeTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistCreate))
            {
                Flash::error('College Topic Todolist Create not found');
                return redirect(route('collegeTopicTodolistCreates.index'));
            }
    
            if($collegeTopicTodolistCreate -> user_id == $user_id)
            {
                $this->collegeTopicTodolistCreateRepository->delete($id);
            
                Flash::success('College Topic Todolist Create deleted successfully.');
                return redirect(route('collegeTopicTodolistCreates.index'));
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