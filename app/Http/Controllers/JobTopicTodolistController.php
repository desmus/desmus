<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicTodolistRequest;
use App\Http\Requests\UpdateJobTopicTodolistRequest;
use App\Repositories\JobTopicTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicTodolistController extends AppBaseController
{
    private $jobTopicTodolistRepository;

    public function __construct(JobTopicTodolistRepository $jobTopicTodolistRepo)
    {
        $this->jobTopicTodolistRepository = $jobTopicTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->jobTopicTodolistRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicTodolists = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_todolists', 'job_topics.id', '=', 'job_topic_todolists.job_topic_id')->where('jobs.user_id', '=', $user_id)->where(function ($query) {$query->where('job_topic_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_topic_todolists.status', '=', 'active');})->orderBy('job_topic_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('job_topic_todolists.index')
                ->with('jobTopicTodolists', $jobTopicTodolists);
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
            return view('job_topic_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_topics')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_topics.id', $request -> job_topic_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $jobTopicTodolist = $this->jobTopicTodolistRepository->create($input);
            
            DB::table('job_topic_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_t_id' => $jobTopicTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTopicTodolist -> name, 'status' => 'active', 'type' => 'j_t_todo_c', 'user_id' => $user_id, 'entity_id' => $jobTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job Topic Todolist saved successfully.');
            return redirect(route('jobTopics.show', [$jobTopicTodolist -> job_topic_id]));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $jobTopicTodolist = $this->jobTopicTodolistRepository->findWithoutFail($id);
            
            DB::table('job_topic_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_t_id' => $id]);
            DB::table('job_topic_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $jobTopicTodolist = $this->jobTopicTodolistRepository->findWithoutFail($id);
            $jobTopicTodolistViews = DB::table('users')->join('job_topic_todolist_views', 'users.id', '=', 'job_topic_todolist_views.user_id')->where('j_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $jobTopicTodolistUpdates = DB::table('users')->join('job_topic_todolist_updates', 'users.id', '=', 'job_topic_todolist_updates.user_id')->where('j_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($jobTopicTodolist))
            {
                Flash::error('Job Topic Todolist not found');
                return redirect(route('jobTopicTodolists.index'));
            }
    
            return view('job_topic_todolists.show')
                ->with('jobTopicTodolist', $jobTopicTodolist)
                ->with('jobTopicTodolistViews', $jobTopicTodolistViews)
                ->with('jobTopicTodolistUpdates', $jobTopicTodolistUpdates);
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
            $jobTopicTodolist = $this->jobTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolist))
            {
                Flash::error('Job Topic Todolist not found');
                return redirect(route('jobTopicTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('job_topic_todolists.edit')
                ->with('jobTopicTodolist', $jobTopicTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTopicTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_topic_todolists')->join('job_topics', 'job_topic_todolists.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_topic_id', $request -> job_topic_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTopicTodolist = $this->jobTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolist))
            {
                Flash::error('Job Topic Todolist not found');
                return redirect(route('jobTopicTodolists.index'));
            }
    
            $newJobTopicTodolist = $this->jobTopicTodolistRepository->update($request->all(), $id);
            
            DB::table('job_topic_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('job_topic_todolist_updates')->insert(['actual_name' => $newJobTopicTodolist -> name, 'past_name' => $jobTopicTodolist -> name, 'datetime' => $now, 'j_t_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $jobTopicTodolist -> name, 'status' => 'active', 'type' => 'j_t_todo_u', 'user_id' => $user_id, 'entity_id' => $jobTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job Topic Todolist updated successfully.');
            return redirect(route('jobTopics.show', [$jobTopicTodolist -> job_topic_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_topic_todolists')->join('job_topics', 'job_topic_todolists.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_topic_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTopicTodolist = $this->jobTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTopicTodolist))
            {
                Flash::error('Job Topic Todolist not found');
                return redirect(route('jobTopicTodolists.index'));
            }
    
            $this->jobTopicTodolistRepository->delete($id);
            
            DB::table('job_topic_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_t_id' => $jobTopicTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTopicTodolist -> name, 'status' => 'active', 'type' => 'j_t_todo_d', 'user_id' => $user_id, 'entity_id' => $jobTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job Topic Todolist deleted successfully.');
            return redirect(route('jobTopics.show', [$jobTopicTodolist -> job_topic_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}