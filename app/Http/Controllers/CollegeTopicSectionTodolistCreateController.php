<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicSectionTodolistCreateRequest;
use App\Http\Requests\UpdateCollegeTopicSectionTodolistCreateRequest;
use App\Repositories\CollegeTopicSectionTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicSectionTodolistCreateController extends AppBaseController
{
    private $collegeTopicSectionTodolistCreateRepository;

    public function __construct(CollegeTopicSectionTodolistCreateRepository $collegeTopicSectionTodolistCreateRepo)
    {
        $this->collegeTopicSectionTodolistCreateRepository = $collegeTopicSectionTodolistCreateRepo;
    }
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicSectionTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicSectionTodolistCreates = $this->collegeTopicSectionTodolistCreateRepository->all();
    
            return view('college_topic_section_todolist_creates.index')
                ->with('collegeTopicSectionTodolistCreates', $collegeTopicSectionTodolistCreates);
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
            return view('college_topic_section_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(CreateCollegeTopicSectionTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTopicSectionTodolistCreate = $this->collegeTopicSectionTodolistCreateRepository->create($input);
    
            Flash::success('College Topic Section Todolist Create saved successfully.');
            return redirect(route('collegeTSTodolistCreates.index'));
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
            $collegeTopicSectionTodolistCreate = $this->collegeTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistCreate))
            {
                Flash::error('College Topic Section Todolist Create not found');
                return redirect(route('collegeTSTodolistCreates.index'));
            }
            
            if($collegeTopicSectionTodolistCreate -> user_id == $user_id)
            {
                return view('college_topic_section_todolist_creates.show')
                    ->with('collegeTopicSectionTodolistCreate', $collegeTopicSectionTodolistCreate);
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
            $collegeTopicSectionTodolistCreate = $this->collegeTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistCreate))
            {
                Flash::error('College Topic Section Todolist Create not found');
                return redirect(route('collegeTSTodolistCreates.index'));
            }
    
            if($collegeTopicSectionTodolistCreate -> user_id == $user_id)
            {
                return view('college_topic_section_todolist_creates.edit')
                    ->with('collegeTopicSectionTodolistCreate', $collegeTopicSectionTodolistCreate);
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

    public function update($id, UpdateCollegeTopicSectionTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicSectionTodolistCreate = $this->collegeTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistCreate))
            {
                Flash::error('College Topic Section Todolist Create not found');
                return redirect(route('collegeTSTodolistCreates.index'));
            }
    
            if($collegeTopicSectionTodolistCreate -> user_id == $user_id)
            {
                $collegeTopicSectionTodolistCreate = $this->collegeTopicSectionTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('College Topic Section Todolist Create updated successfully.');
                return redirect(route('collegeTSTodolistCreates.index'));
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
            $collegeTopicSectionTodolistCreate = $this->collegeTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistCreate))
            {
                Flash::error('College Topic Section Todolist Create not found');
                return redirect(route('collegeTSTodolistCreates.index'));
            }
    
            if($collegeTopicSectionTodolistCreate -> user_id == $user_id)
            {
                $this->collegeTopicSectionTodolistCreateRepository->delete($id);
            
                Flash::success('College Topic Section Todolist Create deleted successfully.');
                return redirect(route('collegeTSTodolistCreates.index'));
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