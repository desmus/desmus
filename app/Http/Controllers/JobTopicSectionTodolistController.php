<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTopicSectionTodolistRequest;
use App\Http\Requests\UpdateJobTopicSectionTodolistRequest;
use App\Repositories\JobTopicSectionTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTopicSectionTodolistController extends AppBaseController
{
    private $jobTopicSectionTodolistRepository;

    public function __construct(JobTopicSectionTodolistRepository $jobTopicSectionTodolistRepo)
    {
        $this->jobTopicSectionTodolistRepository = $jobTopicSectionTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->jobTopicSectionTodolistRepository->pushCriteria(new RequestCriteria($request));
            $jobTopicSectionTodolists = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_topic_section_todolists', 'job_topic_sections.id', '=', 'job_topic_section_todolists.j_t_s_id')->where('jobs.user_id', '=', $user_id)->where(function ($query) {$query->where('job_topic_section_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_topic_section_todolists.status', '=', 'active');})->orderBy('job_topic_section_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('job_topic_section_todolists.index')
                ->with('jobTopicSectionTodolists', $jobTopicSectionTodolists);
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
            return view('job_topic_section_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTopicSectionTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_topic_sections.id', $request -> j_t_s_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $jobTopicSectionTodolist = $this->jobTopicSectionTodolistRepository->create($input);
    
            DB::table('job_topic_section_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_t_id' => $jobTopicSectionTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTopicSectionTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_todo_c', 'user_id' => $user_id, 'entity_id' => $jobTopicSectionTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job Topic Section Todolist saved successfully.');
            return redirect(route('jobTopicSections.show', [$jobTopicSectionTodolist -> j_t_s_id]));
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
            
            DB::table('job_topic_section_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_t_id' => $id]);
            DB::table('job_topic_section_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
    
            $jobTopicSectionTodolist = $this->jobTopicSectionTodolistRepository->findWithoutFail($id);        
            $jobTopicSectionTodolistViews = DB::table('users')->join('job_topic_section_todolist_views', 'users.id', '=', 'job_topic_section_todolist_views.user_id')->where('j_t_s_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $jobTopicSectionTodolistUpdates = DB::table('users')->join('job_topic_section_todolist_updates', 'users.id', '=', 'job_topic_section_todolist_updates.user_id')->where('j_t_s_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($jobTopicSectionTodolist))
            {
                Flash::error('Job Topic Section Todolist not found');
                return redirect(route('jobTopicSectionTodolists.index'));
            }
    
            return view('job_topic_section_todolists.show')->with('jobTopicSectionTodolist', $jobTopicSectionTodolist)
                ->with('jobTopicSectionTodolistViews', $jobTopicSectionTodolistViews)
                ->with('jobTopicSectionTodolistUpdates', $jobTopicSectionTodolistUpdates);
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
            $jobTopicSectionTodolist = $this->jobTopicSectionTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolist))
            {
                Flash::error('Job Topic Section Todolist not found');
                return redirect(route('jobTopicSectionTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('job_topic_section_todolists.edit')->with('jobTopicSectionTodolist', $jobTopicSectionTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTopicSectionTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_topic_section_todolists')->join('job_topic_sections', 'job_topic_section_todolists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('j_t_s_id', $request -> j_t_s_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTopicSectionTodolist = $this->jobTopicSectionTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolist))
            {
                Flash::error('Job Topic Section Todolist not found');
                return redirect(route('jobTopicSectionTodolists.index'));
            }
    
            $newJobTopicSectionTodolist = $this->jobTopicSectionTodolistRepository->update($request->all(), $id);
    
            DB::table('job_topic_section_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('job_topic_section_todolist_updates')->insert(['actual_name' => $newJobTopicSectionTodolist -> name, 'past_name' => $jobTopicSectionTodolist -> name, 'datetime' => $now, 'j_t_s_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $jobTopicSectionTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_todo_u', 'user_id' => $user_id, 'entity_id' => $jobTopicSectionTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job Topic Section Todolist updated successfully.');
            return redirect(route('jobTopicSections.show', [$jobTopicSectionTodolist -> j_t_s_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_topic_section_todolists')->join('job_topic_sections', 'job_topic_section_todolists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_topic_section_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTopicSectionTodolist = $this->jobTopicSectionTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTopicSectionTodolist))
            {
                Flash::error('Job Topic Section Todolist not found');
                return redirect(route('jobTopicSectionTodolists.index'));
            }
    
            $this->jobTopicSectionTodolistRepository->delete($id);
            
            DB::table('job_topic_section_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_t_id' => $jobTopicSectionTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTopicSectionTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_todo_d', 'user_id' => $user_id, 'entity_id' => $jobTopicSectionTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job Topic Section Todolist deleted successfully.');
            return redirect(route('jobTopicSections.show', [$jobTopicSectionTodolist -> j_t_s_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}