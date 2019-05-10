<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicSectionTodolistCreateRequest;
use App\Http\Requests\UpdateJobTopicSectionTodolistCreateRequest;
use App\Repositories\JobTopicSectionTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicSectionTodolistCreateController extends AppBaseController
{
    private $jobTopicSectionTodolistCreateRepository;

    public function __construct(JobTopicSectionTodolistCreateRepository $jobTopicSectionTodolistCreateRepo)
    {
        $this->jobTopicSectionTodolistCreateRepository = $jobTopicSectionTodolistCreateRepo;
    }
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicSectionTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicSectionTodolistCreates = $this->jobTopicSectionTodolistCreateRepository->all();
    
            return view('job_topic_section_todolist_creates.index')
                ->with('jobTopicSectionTodolistCreates', $jobTopicSectionTodolistCreates);
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
            return view('job_topic_section_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(CreateJobTopicSectionTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTopicSectionTodolistCreate = $this->jobTopicSectionTodolistCreateRepository->create($input);
    
            Flash::success('Job Topic Section Todolist Create saved successfully.');
            return redirect(route('jobTSTodolistCreates.index'));
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
            $jobTopicSectionTodolistCreate = $this->jobTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistCreate))
            {
                Flash::error('Job Topic Section Todolist Create not found');
                return redirect(route('jobTSTodolistCreates.index'));
            }
            
            if($jobTopicSectionTodolistCreate -> user_id == $user_id)
            {
                return view('job_topic_section_todolist_creates.show')
                    ->with('jobTopicSectionTodolistCreate', $jobTopicSectionTodolistCreate);
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
            $jobTopicSectionTodolistCreate = $this->jobTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistCreate))
            {
                Flash::error('Job Topic Section Todolist Create not found');
                return redirect(route('jobTSTodolistCreates.index'));
            }
    
            if($jobTopicSectionTodolistCreate -> user_id == $user_id)
            {
                return view('job_topic_section_todolist_creates.edit')
                    ->with('jobTopicSectionTodolistCreate', $jobTopicSectionTodolistCreate);
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

    public function update($id, UpdateJobTopicSectionTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicSectionTodolistCreate = $this->jobTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistCreate))
            {
                Flash::error('Job Topic Section Todolist Create not found');
                return redirect(route('jobTSTodolistCreates.index'));
            }
    
            if($jobTopicSectionTodolistCreate -> user_id == $user_id)
            {
                $jobTopicSectionTodolistCreate = $this->jobTopicSectionTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Section Todolist Create updated successfully.');
                return redirect(route('jobTSTodolistCreates.index'));
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
            $jobTopicSectionTodolistCreate = $this->jobTopicSectionTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistCreate))
            {
                Flash::error('Job Topic Section Todolist Create not found');
                return redirect(route('jobTSTodolistCreates.index'));
            }
    
            if($jobTopicSectionTodolistCreate -> user_id == $user_id)
            {
                $this->jobTopicSectionTodolistCreateRepository->delete($id);
            
                Flash::success('Job Topic Section Todolist Create deleted successfully.');
                return redirect(route('jobTSTodolistCreates.index'));
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