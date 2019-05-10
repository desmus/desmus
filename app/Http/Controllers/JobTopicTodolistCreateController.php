<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicTodolistCreateRequest;
use App\Http\Requests\UpdateJobTopicTodolistCreateRequest;
use App\Repositories\JobTopicTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicTodolistCreateController extends AppBaseController
{
    private $jobTopicTodolistCreateRepository;

    public function __construct(JobTopicTodolistCreateRepository $jobTopicTodolistCreateRepo)
    {
        $this->jobTopicTodolistCreateRepository = $jobTopicTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTopicTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicTodolistCreates = $this->jobTopicTodolistCreateRepository->all();

            return view('job_topic_todolist_creates.index')
                ->with('jobTopicTodolistCreates', $jobTopicTodolistCreates);
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
            return view('job_topic_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTopicTodolistCreate = $this->jobTopicTodolistCreateRepository->create($input);
    
            Flash::success('Job Topic Todolist Create saved successfully.');
            return redirect(route('jobTopicTodolistCreates.index'));
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
            $jobTopicTodolistCreate = $this->jobTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistCreate))
            {
                Flash::error('Job Topic Todolist Create not found');
                return redirect(route('jobTopicTodolistCreates.index'));
            }
            
            if($jobTopicTodolistCreate -> user_id == $user_id)
            {
                return view('job_topic_todolist_creates.show')
                    ->with('jobTopicTodolistCreate', $jobTopicTodolistCreate);
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
            $jobTopicTodolistCreate = $this->jobTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistCreate))
            {
                Flash::error('Job Topic Todolist Create not found');
                return redirect(route('jobTopicTodolistCreates.index'));
            }
            
            if($jobTopicTodolistCreate -> user_id == $user_id)
            {
                return view('job_topic_todolist_creates.edit')
                    ->with('jobTopicTodolistCreate', $jobTopicTodolistCreate);
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

    public function update($id, UpdateJobTopicTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTopicTodolistCreate = $this->jobTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistCreate))
            {
                Flash::error('Job Topic Todolist Create not found');
                return redirect(route('jobTopicTodolistCreates.index'));
            }
    
            if($jobTopicTodolistCreate -> user_id == $user_id)
            {
                $jobTopicTodolistCreate = $this->jobTopicTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('Job Topic Todolist Create updated successfully.');
                return redirect(route('jobTopicTodolistCreates.index'));
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
            $jobTopicTodolistCreate = $this->jobTopicTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolistCreate))
            {
                Flash::error('Job Topic Todolist Create not found');
                return redirect(route('jobTopicTodolistCreates.index'));
            }
    
            if($jobTopicTodolistCreate -> user_id == $user_id)
            {
                $this->jobTopicTodolistCreateRepository->delete($id);
            
                Flash::success('Job Topic Todolist Create deleted successfully.');
                return redirect(route('jobTopicTodolistCreates.index'));
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