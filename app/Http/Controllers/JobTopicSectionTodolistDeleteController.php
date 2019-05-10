<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicSectionTodolistDeleteRequest;
use App\Http\Requests\UpdateJobTopicSectionTodolistDeleteRequest;
use App\Repositories\JobTopicSectionTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicSectionTodolistDeleteController extends AppBaseController
{
    private $jobTopicSectionTodolistDeleteRepository;

    public function __construct(JobTopicSectionTodolistDeleteRepository $jobTopicSectionTodolistDeleteRepo)
    {
        $this->jobTopicSectionTodolistDeleteRepository = $jobTopicSectionTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicSectionTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicSectionTodolistDeletes = $this->jobTopicSectionTodolistDeleteRepository->all();
    
            return view('job_topic_section_todolist_deletes.index')
                ->with('jobTopicSectionTodolistDeletes', $jobTopicSectionTodolistDeletes);
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
            return view('job_topic_section_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicSectionTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTopicSectionTodolistDelete = $this->jobTopicSectionTodolistDeleteRepository->create($input);
    
            Flash::success('Job Topic Section Todolist Delete saved successfully.');
            return redirect(route('jobTSTodolistDeletes.index'));
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
            $jobTopicSectionTodolistDelete = $this->jobTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistDelete))
            {
                Flash::error('Job Topic Section Todolist Delete not found');
                return redirect(route('jobTSTodolistDeletes.index'));
            }
            
            if($jobTopicSectionTodolistDelete -> user_id == $user_id)
            {
                return view('job_topic_section_todolist_deletes.show')
                    ->with('jobTopicSectionTodolistDelete', $jobTopicSectionTodolistDelete);
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
            $jobTopicSectionTodolistDelete = $this->jobTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistDelete))
            {
                Flash::error('Job Topic Section Todolist Delete not found');
                return redirect(route('jobTSTodolistDeletes.index'));
            }
    
            if($jobTopicSectionTodolistDelete -> user_id == $user_id)
            {
                return view('job_topic_section_todolist_deletes.edit')->with('jobTopicSectionTodolistDelete', $jobTopicSectionTodolistDelete);
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

    public function update($id, UpdateJobTopicSectionTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicSectionTodolistDelete = $this->jobTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistDelete))
            {
                Flash::error('Job Topic Section Todolist Delete not found');
                return redirect(route('jobTSTodolistDeletes.index'));
            }
            
            if($jobTopicSectionTodolistDelete -> user_id == $user_id)
            {
                $jobTopicSectionTodolistDelete = $this->jobTopicSectionTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Section Todolist Delete updated successfully.');
                return redirect(route('jobTSTodolistDeletes.index'));
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
            $jobTopicSectionTodolistDelete = $this->jobTopicSectionTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolistDelete))
            {
                Flash::error('Job Topic Section Todolist Delete not found');
                return redirect(route('jobTSTodolistDeletes.index'));
            }
    
            if($jobTopicSectionTodolistDelete -> user_id == $user_id)
            {
                $this->jobTopicSectionTodolistDeleteRepository->delete($id);
            
                Flash::success('Job Topic Section Todolist Delete deleted successfully.');
                return redirect(route('jobTSTodolistDeletes.index'));
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