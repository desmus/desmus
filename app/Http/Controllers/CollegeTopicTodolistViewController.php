<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicTodolistViewRequest;
use App\Http\Requests\UpdateCollegeTopicTodolistViewRequest;
use App\Repositories\CollegeTopicTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicTodolistViewController extends AppBaseController
{
    private $collegeTopicTodolistViewRepository;

    public function __construct(CollegeTopicTodolistViewRepository $collegeTopicTodolistViewRepo)
    {
        $this->collegeTopicTodolistViewRepository = $collegeTopicTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicTodolistViews = $this->collegeTopicTodolistViewRepository->all();
    
            return view('college_topic_todolist_views.index')
                ->with('collegeTopicTodolistViews', $collegeTopicTodolistViews);
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
            return view('college_topic_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTopicTodolistView = $this->collegeTopicTodolistViewRepository->create($input);
    
            Flash::success('College Topic Todolist View saved successfully.');
            return redirect(route('collegeTopicTodolistViews.index'));
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
            $collegeTopicTodolistView = $this->collegeTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistView))
            {
                Flash::error('College Topic Todolist View not found');
                return redirect(route('collegeTopicTodolistViews.index'));
            }
            
            if($collegeTopicTodolistView -> user_id == $user_id)
            {
                return view('college_topic_todolist_views.show')
                    ->with('collegeTopicTodolistView', $collegeTopicTodolistView);
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
            $collegeTopicTodolistView = $this->collegeTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistView))
            {
                Flash::error('College Topic Todolist View not found');
                return redirect(route('collegeTopicTodolistViews.index'));
            }
    
            if($collegeTopicTodolistView -> user_id == $user_id)
            {
                return view('college_topic_todolist_views.edit')
                    ->with('collegeTopicTodolistView', $collegeTopicTodolistView);
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

    public function update($id, UpdateCollegeTopicTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicTodolistView = $this->collegeTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistView))
            {
                Flash::error('College Topic Todolist View not found');
                return redirect(route('collegeTopicTodolistViews.index'));
            }
            
            if($collegeTopicTodolistView -> user_id == $user_id)
            {
                $collegeTopicTodolistView = $this->collegeTopicTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('College Topic Todolist View updated successfully.');
                return redirect(route('collegeTopicTodolistViews.index'));
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
            $collegeTopicTodolistView = $this->collegeTopicTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolistView))
            {
                Flash::error('College Topic Todolist View not found');
                return redirect(route('collegeTopicTodolistViews.index'));
            }
    
            if($collegeTopicTodolistView -> user_id == $user_id)
            {
                $this->collegeTopicTodolistViewRepository->delete($id);
            
                Flash::success('College Topic Todolist View deleted successfully.');
                return redirect(route('collegeTopicTodolistViews.index'));
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