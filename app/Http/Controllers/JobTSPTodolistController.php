<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPTodolistRequest;
use App\Http\Requests\UpdateJobTSPTodolistRequest;
use App\Repositories\JobTSPTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPTodolistController extends AppBaseController
{
    private $jobTSPTodolistRepository;

    public function __construct(JobTSPTodolistRepository $jobTSPTodolistRepo)
    {
        $this->jobTSPTodolistRepository = $jobTSPTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->jobTSPTodolistRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPTodolists = $this->jobTSPTodolistRepository->all();
            $jobTSPTodolists = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_playlists', 'job_topic_sections.id', '=', 'job_t_s_playlists.j_t_s_id')->join('job_t_s_p_todolists', 'job_t_s_playlists.id', '=', 'job_t_s_p_todolists.j_t_s_p_id')->where('jobs.user_id', '=', $user_id)->where(function ($query) {$query->where('job_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_p_todolists.status', '=', 'active');})->orderBy('job_t_s_p_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('job_t_s_p_todolists.index')
                ->with('jobTSPTodolists', $jobTSPTodolists);
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
            return view('job_t_s_p_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_playlists')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_t_s_playlists.id', $request -> j_t_s_p_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $jobTSPTodolist = $this->jobTSPTodolistRepository->create($input);
    
            DB::table('job_t_s_p_t_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_p_t_id' => $jobTSPTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTSPTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_p_t_c', 'user_id' => $user_id, 'entity_id' => $jobTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S P Todolist saved successfully.');
            return redirect(route('jobTSPlaylists.show', [$jobTSPTodolist -> j_t_s_p_id]));
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
            
            DB::table('job_t_s_p_t_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_p_t_id' => $id]);
            DB::table('job_t_s_p_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $jobTSPTodolist = $this->jobTSPTodolistRepository->findWithoutFail($id);
            $jobTSPTViews = DB::table('users')->join('job_t_s_p_t_views', 'users.id', '=', 'job_t_s_p_t_views.user_id')->where('j_t_s_p_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $jobTSPTUpdates = DB::table('users')->join('job_t_s_p_t_updates', 'users.id', '=', 'job_t_s_p_t_updates.user_id')->where('j_t_s_p_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($jobTSPTodolist))
            {
                Flash::error('Job T S P Todolist not found');
                return redirect(route('jobTSPTodolists.index'));
            }
    
            return view('job_t_s_p_todolists.show')
                ->with('jobTSPTodolist', $jobTSPTodolist)
                ->with('jobTSPTViews', $jobTSPTViews)
                ->with('jobTSPTUpdates', $jobTSPTUpdates);
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
            $jobTSPTodolist = $this->jobTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSPTodolist))
            {
                Flash::error('Job T S P Todolist not found');
                return redirect(route('jobTSPTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('job_t_s_p_todolists.edit')
                ->with('jobTSPTodolist', $jobTSPTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTSPTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_p_todolists')->join('job_t_s_playlists', 'job_t_s_p_todolists.j_t_s_p_id', '=', 'job_t_s_playlists.id')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('j_t_s_p_id', $request -> j_t_s_p_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTSPTodolist = $this->jobTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSPTodolist))
            {
                Flash::error('Job T S P Todolist not found');
                return redirect(route('jobTSPTodolists.index'));
            }
            
            $newJobTSPTodolist = $this->jobTSPTodolistRepository->update($request->all(), $id);
    
            DB::table('job_t_s_p_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('job_t_s_p_t_updates')->insert(['actual_name' => $newJobTSPTodolist -> name, 'past_name' => $jobTSPTodolist -> name, 'datetime' => $now, 'j_t_s_p_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $jobTSPTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_p_t_u', 'user_id' => $user_id, 'entity_id' => $jobTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S P Todolist updated successfully.');
            return redirect(route('jobTSPlaylists.show', [$jobTSPTodolist -> j_t_s_p_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_p_todolists')->join('job_t_s_playlists', 'job_t_s_p_todolists.j_t_s_p_id', '=', 'job_t_s_playlists.id')->join('job_topic_sections', 'job_t_s_playlists.j_t_s_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_t_s_p_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTSPTodolist = $this->jobTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSPTodolist))
            {
                Flash::error('Job T S P Todolist not found');
                return redirect(route('jobTSPTodolists.index'));
            }
    
            $this->jobTSPTodolistRepository->delete($id);
            
            DB::table('job_t_s_p_t_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_p_t_id' => $jobTSPTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTSPTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_p_t_d', 'user_id' => $user_id, 'entity_id' => $jobTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S P Todolist deleted successfully.');
            return redirect(route('jobTSPlaylists.show', [$jobTSPTodolist -> j_t_s_p_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}