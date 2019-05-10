<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicSectionTodolistDeleteRequest;
use App\Http\Requests\UpdateCollegeTopicSectionTodolistDeleteRequest;
use App\Repositories\CollegeTopicSectionTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicSectionTodolistDeleteController extends AppBaseController
{
    private $collegeTopicSectionTodolistDeleteRepository;

    public function __construct(CollegeTopicSectionTodolistDeleteRepository $collegeTopicSectionTodolistDeleteRepo)
    {
        $this->collegeTopicSectionTodolistDeleteRepository = $collegeTopicSectionTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicSectionTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicSectionTodolistDeletes = $this->collegeTopicSectionTodolistDeleteRepository->all();
    
            return view('college_topic_section_todolist_deletes.index')
                ->with('collegeTopicSectionTodolistDeletes', $collegeTopicSectionTodolistDeletes);
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
            return view('college_topic_section_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicSectionTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTopicSectionTodolistDelete = $this->collegeTopicSectionTodolistDeleteRepository->create($input);

            Flash::success('College Topic Section Todolist Delete saved successfully.');
            return redirect(route('collegeTSTodolistDeletes.index'));
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
            $collegeTopicSectionTodolistDelete = $this->collegeTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistDelete))
            {
                Flash::error('College Topic Section Todolist Delete not found');
                return redirect(route('collegeTSTodolistDeletes.index'));
            }
            
            if($collegeTopicSectionTodolistDelete -> user_id == $user_id)
            {
                return view('college_topic_section_todolist_deletes.show')
                    ->with('collegeTopicSectionTodolistDelete', $collegeTopicSectionTodolistDelete);
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
            $collegeTopicSectionTodolistDelete = $this->collegeTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistDelete))
            {
                Flash::error('College Topic Section Todolist Delete not found');
                return redirect(route('collegeTSTodolistDeletes.index'));
            }
    
            if($collegeTopicSectionTodolistDelete -> user_id == $user_id)
            {
                return view('college_topic_section_todolist_deletes.edit')->with('collegeTopicSectionTodolistDelete', $collegeTopicSectionTodolistDelete);
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

    public function update($id, UpdateCollegeTopicSectionTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicSectionTodolistDelete = $this->collegeTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistDelete))
            {
                Flash::error('College Topic Section Todolist Delete not found');
                return redirect(route('collegeTSTodolistDeletes.index'));
            }
            
            if($collegeTopicSectionTodolistDelete -> user_id == $user_id)
            {
                $collegeTopicSectionTodolistDelete = $this->collegeTopicSectionTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('College Topic Section Todolist Delete updated successfully.');
                return redirect(route('collegeTSTodolistDeletes.index'));
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
            $collegeTopicSectionTodolistDelete = $this->collegeTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistDelete))
            {
                Flash::error('College Topic Section Todolist Delete not found');
                return redirect(route('collegeTSTodolistDeletes.index'));
            }
    
            if($collegeTopicSectionTodolistDelete -> user_id == $user_id)
            {
                $this->collegeTopicSectionTodolistDeleteRepository->delete($id);
            
                Flash::success('College Topic Section Todolist Delete deleted successfully.');
                return redirect(route('collegeTSTodolistDeletes.index'));
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