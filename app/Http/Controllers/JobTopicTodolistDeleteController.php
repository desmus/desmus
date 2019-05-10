<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicTodolistDeleteRequest;
use App\Http\Requests\UpdateJobTopicTodolistDeleteRequest;
use App\Repositories\JobTopicTodolistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicTodolistDeleteController extends AppBaseController
{
    private $jobTopicTodolistDeleteRepository;

    public function __construct(JobTopicTodolistDeleteRepository $jobTopicTodolistDeleteRepo)
    {
        $this->jobTopicTodolistDeleteRepository = $jobTopicTodolistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicTodolistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicTodolistDeletes = $this->jobTopicTodolistDeleteRepository->all();
    
            return view('job_topic_todolist_deletes.index')
                ->with('jobTopicTodolistDeletes', $jobTopicTodolistDeletes);
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
            return view('job_topic_todolist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTopicTodolistDelete = $this->jobTopicTodolistDeleteRepository->create($input);
    
            Flash::success('Job Topic Todolist Delete saved successfully.');
            return redirect(route('jobTopicTodolistDeletes.index'));
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
            $jobTopicTodolistDelete = $this->jobTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistDelete))
            {
                Flash::error('Job Topic Todolist Delete not found');
                return redirect(route('jobTopicTodolistDeletes.index'));
            }
    
            if($jobTopicTodolistDelete -> user_id == $user_id)
            {
                return view('job_topic_todolist_deletes.show')
                    ->with('jobTopicTodolistDelete', $jobTopicTodolistDelete);
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
            $jobTopicTodolistDelete = $this->jobTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistDelete))
            {
                Flash::error('Job Topic Todolist Delete not found');
                return redirect(route('jobTopicTodolistDeletes.index'));
            }
            
            if($jobTopicTodolistDelete -> user_id == $user_id)
            {
                return view('job_topic_todolist_deletes.edit')
                    ->with('jobTopicTodolistDelete', $jobTopicTodolistDelete);
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

    public function update($id, UpdateJobTopicTodolistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicTodolistDelete = $this->jobTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistDelete))
            {
                Flash::error('Job Topic Todolist Delete not found');
                return redirect(route('jobTopicTodolistDeletes.index'));
            }
    
            if($jobTopicTodolistDelete -> user_id == $user_id)
            {
                $jobTopicTodolistDelete = $this->jobTopicTodolistDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Todolist Delete updated successfully.');
                return redirect(route('jobTopicTodolistDeletes.index'));
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
            $jobTopicTodolistDelete = $this->jobTopicTodolistDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistDelete))
            {
                Flash::error('Job Topic Todolist Delete not found');
                return redirect(route('jobTopicTodolistDeletes.index'));
            }
    
            if($jobTopicTodolistDelete -> user_id == $user_id)
            {
                $this->jobTopicTodolistDeleteRepository->delete($id);
            
                Flash::success('Job Topic Todolist Delete deleted successfully.');
                return redirect(route('jobTopicTodolistDeletes.index'));
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