<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolTodolistRequest;
use App\Http\Requests\UpdateJobTSToolTodolistRequest;
use App\Repositories\JobTSToolTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolTodolistController extends AppBaseController
{
    private $jobTSToolTodolistRepository;

    public function __construct(JobTSToolTodolistRepository $jobTSToolTodolistRepo)
    {
        $this->jobTSToolTodolistRepository = $jobTSToolTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->jobTSToolTodolistRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolTodolists = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_tools', 'job_topic_sections.id', '=', 'job_t_s_tools.job_topic_section_id')->join('job_t_s_tool_todolists', 'job_t_s_tools.id', '=', 'job_t_s_tool_todolists.j_t_s_t_id')->where('jobs.user_id', '=', $user_id)->where(function ($query) {$query->where('job_t_s_tool_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_tool_todolists.status', '=', 'active');})->orderBy('job_t_s_tool_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('job_t_s_tool_todolists.index')
                ->with('jobTSToolTodolists', $jobTSToolTodolists);
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
            return view('job_t_s_tool_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_t_s_tools.id', $request -> j_t_s_t_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $jobTSToolTodolist = $this->jobTSToolTodolistRepository->create($input);
            
            DB::table('job_t_s_tool_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_t_t_id' => $jobTSToolTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTSToolTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_t_todo_c', 'user_id' => $user_id, 'entity_id' => $jobTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Tool Todolist saved successfully.');
            return redirect(route('jobTSTools.show', [$jobTSToolTodolist -> j_t_s_t_id]));
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
            
            DB::table('job_t_s_tool_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_t_t_id' => $id]);
            DB::table('job_t_s_tool_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $jobTSToolTodolist = $this->jobTSToolTodolistRepository->findWithoutFail($id);
            $jobTSToolTodolistViews = DB::table('users')->join('job_t_s_tool_todolist_views', 'users.id', '=', 'job_t_s_tool_todolist_views.user_id')->where('j_t_s_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $jobTSToolTodolistUpdates = DB::table('users')->join('job_t_s_tool_todolist_updates', 'users.id', '=', 'job_t_s_tool_todolist_updates.user_id')->where('j_t_s_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($jobTSToolTodolist))
            {
                Flash::error('Job T S Tool Todolist not found');
                return redirect(route('jobTSToolTodolists.index'));
            }
    
            return view('job_t_s_tool_todolists.show')
                ->with('jobTSToolTodolist', $jobTSToolTodolist)
                ->with('jobTSToolTodolistViews', $jobTSToolTodolistViews)
                ->with('jobTSToolTodolistUpdates', $jobTSToolTodolistUpdates);
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
            $jobTSToolTodolist = $this->jobTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolist))
            {
                Flash::error('Job T S Tool Todolist not found');
                return redirect(route('jobTSToolTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('job_t_s_tool_todolists.edit')
                ->with('jobTSToolTodolist', $jobTSToolTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTSToolTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_tool_todolists')->join('job_t_s_tools', 'job_t_s_tool_todolists.j_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('j_t_s_t_id', $request -> j_t_s_t_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTSToolTodolist = $this->jobTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolist))
            {
                Flash::error('Job T S Tool Todolist not found');
                return redirect(route('jobTSToolTodolists.index'));
            }
    
            $newJobTSToolTodolist = $this->jobTSToolTodolistRepository->update($request->all(), $id);
    
            DB::table('job_t_s_tool_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('job_t_s_tool_todolist_updates')->insert(['actual_name' => $newJobTSToolTodolist -> name, 'past_name' => $jobTSToolTodolist -> name, 'datetime' => $now, 'j_t_s_t_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $jobTSToolTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_t_todo_u', 'user_id' => $user_id, 'entity_id' => $jobTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Tool Todolist updated successfully.');
            return redirect(route('jobTSTools.show', [$jobTSToolTodolist -> j_t_s_t_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_tool_todolists')->join('job_t_s_tools', 'job_t_s_tool_todolists.j_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_t_s_tool_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTSToolTodolist = $this->jobTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSToolTodolist))
            {
                Flash::error('Job T S Tool Todolist not found');
                return redirect(route('jobTSToolTodolists.index'));
            }
    
            $this->jobTSToolTodolistRepository->delete($id);
            
            DB::table('recent_activities')->insert(['name' => $jobTSToolTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_t_todo_d', 'user_id' => $user_id, 'entity_id' => $jobTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Tool Todolist deleted successfully.');
            return redirect(route('jobTSTools.show', [$jobTSToolTodolist -> j_t_s_t_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}