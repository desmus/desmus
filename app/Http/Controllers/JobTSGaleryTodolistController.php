<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGaleryTodolistRequest;
use App\Http\Requests\UpdateJobTSGaleryTodolistRequest;
use App\Repositories\JobTSGaleryTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSGaleryTodolistController extends AppBaseController
{
    private $jobTSGaleryTodolistRepository;

    public function __construct(JobTSGaleryTodolistRepository $jobTSGaleryTodolistRepo)
    {
        $this->jobTSGaleryTodolistRepository = $jobTSGaleryTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->jobTSGaleryTodolistRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleryTodolists = $this->jobTSGaleryTodolistRepository->all();
            $jobTSGaleryTodolists = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_galeries', 'job_topic_sections.id', '=', 'job_t_s_galeries.job_topic_section_id')->join('job_t_s_galery_todolists', 'job_t_s_galeries.id', '=', 'job_t_s_galery_todolists.j_t_s_g_id')->where('jobs.user_id', '=', $user_id)->where(function ($query) {$query->where('job_t_s_galery_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_galery_todolists.status', '=', 'active');})->orderBy('job_t_s_galery_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('job_t_s_galery_todolists.index')
                ->with('jobTSGaleryTodolists', $jobTSGaleryTodolists);
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
            return view('job_t_s_galery_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGaleryTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_t_s_galeries.id', $request -> j_t_s_g_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $jobTSGaleryTodolist = $this->jobTSGaleryTodolistRepository->create($input);
    
            DB::table('job_t_s_galery_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_g_t_id' => $jobTSGaleryTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_g_todo_c', 'user_id' => $user_id, 'entity_id' => $jobTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Galery Todolist saved successfully.');
            return redirect(route('jobTSGaleries.show', [$jobTSGaleryTodolist -> j_t_s_g_id]));
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
            
            DB::table('job_t_s_galery_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_g_t_id' => $id]);
            DB::table('job_t_s_galery_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $jobTSGaleryTodolist = $this->jobTSGaleryTodolistRepository->findWithoutFail($id);
            $jobTSGaleryTodolistViews = DB::table('users')->join('job_t_s_galery_todolist_views', 'users.id', '=', 'job_t_s_galery_todolist_views.user_id')->where('j_t_s_g_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $jobTSGaleryTodolistUpdates = DB::table('users')->join('job_t_s_galery_todolist_updates', 'users.id', '=', 'job_t_s_galery_todolist_updates.user_id')->where('j_t_s_g_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($jobTSGaleryTodolist))
            {
                Flash::error('Job T S Galery Todolist not found');
                return redirect(route('jobTSGaleryTodolists.index'));
            }
    
            return view('job_t_s_galery_todolists.show')->with('jobTSGaleryTodolist', $jobTSGaleryTodolist)
                ->with('jobTSGaleryTodolistViews', $jobTSGaleryTodolistViews)
                ->with('jobTSGaleryTodolistUpdates', $jobTSGaleryTodolistUpdates);
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
            $jobTSGaleryTodolist = $this->jobTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolist))
            {
                Flash::error('Job T S Galery Todolist not found');
                return redirect(route('jobTSGaleryTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('job_t_s_galery_todolists.edit')
                ->with('jobTSGaleryTodolist', $jobTSGaleryTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTSGaleryTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_galery_todolists')->join('job_t_s_galeries', 'job_t_s_galery_todolists.j_t_s_g_id', '=', 'job_t_s_galeries.id')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('j_t_s_g_id', $request -> j_t_s_g_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTSGaleryTodolist = $this->jobTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolist))
            {
                Flash::error('Job T S Galery Todolist not found');
                return redirect(route('jobTSGaleryTodolists.index'));
            }
    
            $newJobTSGaleryTodolist = $this->jobTSGaleryTodolistRepository->update($request->all(), $id);
    
            DB::table('job_t_s_galery_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('job_t_s_galery_todolist_updates')->insert(['actual_name' => $newJobTSGaleryTodolist -> name, 'past_name' => $jobTSGaleryTodolist -> name, 'datetime' => $now, 'j_t_s_g_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $jobTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_g_todo_u', 'user_id' => $user_id, 'entity_id' => $jobTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Galery Todolist updated successfully.');
            return redirect(route('jobTSGaleries.show', [$jobTSGaleryTodolist -> j_t_s_g_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_galery_todolists')->join('job_t_s_galeries', 'job_t_s_galery_todolists.j_t_s_g_id', '=', 'job_t_s_galeries.id')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_t_s_galery_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTSGaleryTodolist = $this->jobTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSGaleryTodolist))
            {
                Flash::error('Job T S Galery Todolist not found');
                return redirect(route('jobTSGaleryTodolists.index'));
            }
    
            $this->jobTSGaleryTodolistRepository->delete($id);
           
            DB::table('job_t_s_galery_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_g_t_id' => $jobTSGaleryTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_g_todo_d', 'user_id' => $user_id, 'entity_id' => $jobTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Galery Todolist deleted successfully.');
            return redirect(route('jobTSGaleries.show', [$jobTSGaleryTodolist -> j_t_s_g_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}