<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicSectionTodolistViewRequest;
use App\Http\Requests\UpdateCollegeTopicSectionTodolistViewRequest;
use App\Repositories\CollegeTopicSectionTodolistViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicSectionTodolistViewController extends AppBaseController
{
    private $collegeTopicSectionTodolistViewRepository;

    public function __construct(CollegeTopicSectionTodolistViewRepository $collegeTopicSectionTodolistViewRepo)
    {
        $this->collegeTopicSectionTodolistViewRepository = $collegeTopicSectionTodolistViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicSectionTodolistViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicSectionTodolistViews = $this->collegeTopicSectionTodolistViewRepository->all();
    
            return view('college_topic_section_todolist_views.index')
                ->with('collegeTopicSectionTodolistViews', $collegeTopicSectionTodolistViews);
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
            return view('college_topic_section_todolist_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicSectionTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTopicSectionTodolistView = $this->collegeTopicSectionTodolistViewRepository->create($input);
    
            Flash::success('College Topic Section Todolist View saved successfully.');
            return redirect(route('collegeTSTodolistViews.index'));
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
            $collegeTopicSectionTodolistView = $this->collegeTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistView))
            {
                Flash::error('College Topic Section Todolist View not found');
                return redirect(route('collegeTSTodolistViews.index'));
            }
            
            if($collegeTopicSectionTodolistView -> user_id == $user_id)
            {
                return view('college_topic_section_todolist_views.show')->with('collegeTopicSectionTodolistView', $collegeTopicSectionTodolistView);
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
            $collegeTopicSectionTodolistView = $this->collegeTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistView))
            {
                Flash::error('College Topic Section Todolist View not found');
                return redirect(route('collegeTSTodolistViews.index'));
            }
    
            if($collegeTopicSectionTodolistView -> user_id == $user_id)
            {
                return view('college_topic_section_todolist_views.edit')->with('collegeTopicSectionTodolistView', $collegeTopicSectionTodolistView);
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

    public function update($id, UpdateCollegeTopicSectionTodolistViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicSectionTodolistView = $this->collegeTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistView))
            {
                Flash::error('College Topic Section Todolist View not found');
                return redirect(route('collegeTSTodolistViews.index'));
            }
    
            if($collegeTopicSectionTodolistView -> user_id == $user_id)
            {
                $collegeTopicSectionTodolistView = $this->collegeTopicSectionTodolistViewRepository->update($request->all(), $id);
            
                Flash::success('College Topic Section Todolist View updated successfully.');
                return redirect(route('collegeTSTodolistViews.index'));
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
            $collegeTopicSectionTodolistView = $this->collegeTopicSectionTodolistViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistView))
            {
                Flash::error('College Topic Section Todolist View not found');
                return redirect(route('collegeTSTodolistViews.index'));
            }
            
            if($collegeTopicSectionTodolistView -> user_id == $user_id)
            {
                $this->collegeTopicSectionTodolistViewRepository->delete($id);
            
                Flash::success('College Topic Section Todolist View deleted successfully.');
                return redirect(route('collegeTSTodolistViews.index'));
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