<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicSectionTodolistUpdateRequest;
use App\Http\Requests\UpdateCollegeTopicSectionTodolistUpdateRequest;
use App\Repositories\CollegeTopicSectionTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicSectionTodolistUpdateController extends AppBaseController
{
    private $collegeTopicSectionTodolistUpdateRepository;

    public function __construct(CollegeTopicSectionTodolistUpdateRepository $collegeTopicSectionTodolistUpdateRepo)
    {
        $this->collegeTopicSectionTodolistUpdateRepository = $collegeTopicSectionTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicSectionTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicSectionTodolistUpdates = $this->collegeTopicSectionTodolistUpdateRepository->all();
    
            return view('college_topic_section_todolist_updates.index')
                ->with('collegeTopicSectionTodolistUpdates', $collegeTopicSectionTodolistUpdates);
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
            return view('college_topic_section_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicSectionTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTopicSectionTodolistUpdate = $this->collegeTopicSectionTodolistUpdateRepository->create($input);
    
            Flash::success('College Topic Section Todolist Update saved successfully.');
            return redirect(route('collegeTSTodolistUpdates.index'));
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
            $collegeTopicSectionTodolistUpdate = $this->collegeTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistUpdate))
            {
                Flash::error('College Topic Section Todolist Update not found');
                return redirect(route('collegeTSTodolistUpdates.index'));
            }
            
            if($collegeTopicSectionTodolistUpdate -> user_id == $user_id)
            {
                return view('college_topic_section_todolist_updates.show')
                    ->with('collegeTopicSectionTodolistUpdate', $collegeTopicSectionTodolistUpdate);
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
            $collegeTopicSectionTodolistUpdate = $this->collegeTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistUpdate))
            {
                Flash::error('College Topic Section Todolist Update not found');
                return redirect(route('collegeTSTodolistUpdates.index'));
            }
            
            if($collegeTopicSectionTodolistUpdate -> user_id == $user_id)
            {
                return view('college_topic_section_todolist_updates.edit')
                    ->with('collegeTopicSectionTodolistUpdate', $collegeTopicSectionTodolistUpdate);
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

    public function update($id, UpdateCollegeTopicSectionTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicSectionTodolistUpdate = $this->collegeTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistUpdate))
            {
                Flash::error('College Topic Section Todolist Update not found');
                return redirect(route('collegeTSTodolistUpdates.index'));
            }
            
            if($collegeTopicSectionTodolistUpdate -> user_id == $user_id)
            {  
                $collegeTopicSectionTodolistUpdate = $this->collegeTopicSectionTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('College Topic Section Todolist Update updated successfully.');
                return redirect(route('collegeTSTodolistUpdates.index'));
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
            $collegeTopicSectionTodolistUpdate = $this->collegeTopicSectionTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolistUpdate))
            {
                Flash::error('College Topic Section Todolist Update not found');
                return redirect(route('collegeTSTodolistUpdates.index'));
            }
    
            if($collegeTopicSectionTodolistUpdate -> user_id == $user_id)
            { 
                $this->collegeTopicSectionTodolistUpdateRepository->delete($id);
            
                Flash::success('College Topic Section Todolist Update deleted successfully.');
                return redirect(route('collegeTSTodolistUpdates.index'));
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