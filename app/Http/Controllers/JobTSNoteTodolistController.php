<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSNoteTodolistRequest;
use App\Http\Requests\UpdateJobTSNoteTodolistRequest;
use App\Repositories\JobTSNoteTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSNoteTodolistController extends AppBaseController
{
    private $jobTSNoteTodolistRepository;

    public function __construct(JobTSNoteTodolistRepository $jobTSNoteTodolistRepo)
    {
        $this->jobTSNoteTodolistRepository = $jobTSNoteTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->jobTSNoteTodolistRepository->pushCriteria(new RequestCriteria($request));
            $jobTSNoteTodolists = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->join('job_t_s_note_todolists', 'job_t_s_notes.id', '=', 'job_t_s_note_todolists.j_t_s_n_id')->where('jobs.user_id', '=', $user_id)->where(function ($query) {$query->where('job_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_note_todolists.status', '=', 'active');})->orderBy('job_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('job_t_s_note_todolists.index')
                ->with('jobTSNoteTodolists', $jobTSNoteTodolists);
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
            return view('job_t_s_note_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSNoteTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_t_s_notes.id', $request -> j_t_s_n_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
    
            $jobTSNoteTodolist = $this->jobTSNoteTodolistRepository->create($input);
    
            DB::table('job_t_s_note_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_n_t_id' => $jobTSNoteTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTSNoteTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_n_todo_c', 'user_id' => $user_id, 'entity_id' => $jobTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Note Todolist saved successfully.');
            return redirect(route('jobTSNotes.show', [$jobTSNoteTodolist -> j_t_s_n_id]));
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
            
            DB::table('job_t_s_note_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'j_t_s_n_t_id' => $id]);
            DB::table('job_t_s_note_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $jobTSNoteTodolist = $this->jobTSNoteTodolistRepository->findWithoutFail($id);
            $jobTSNoteTodolistViews = DB::table('users')->join('job_t_s_note_todolist_views', 'users.id', '=', 'job_t_s_note_todolist_views.user_id')->where('j_t_s_n_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $jobTSNoteTodolistUpdates = DB::table('users')->join('job_t_s_note_todolist_updates', 'users.id', '=', 'job_t_s_note_todolist_updates.user_id')->where('j_t_s_n_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($jobTSNoteTodolist))
            {
                Flash::error('Job T S Note Todolist not found');
                return redirect(route('jobTSNoteTodolists.index'));
            }
    
            return view('job_t_s_note_todolists.show')->with('jobTSNoteTodolist', $jobTSNoteTodolist)
                ->with('jobTSNoteTodolistViews', $jobTSNoteTodolistViews)
                ->with('jobTSNoteTodolistUpdates', $jobTSNoteTodolistUpdates);
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
            $jobTSNoteTodolist = $this->jobTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolist))
            {
                Flash::error('Job T S Note Todolist not found');
                return redirect(route('jobTSNoteTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('job_t_s_note_todolists.edit')->with('jobTSNoteTodolist', $jobTSNoteTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateJobTSNoteTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_note_todolists')->join('job_t_s_notes', 'job_t_s_note_todolists.j_t_s_n_id', '=', 'job_t_s_notes.id')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('j_t_s_n_id', $request -> j_t_s_n_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTSNoteTodolist = $this->jobTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolist))
            {
                Flash::error('Job T S Note Todolist not found');
                return redirect(route('jobTSNoteTodolists.index'));
            }
    
            $newJobTSNoteTodolist = $this->jobTSNoteTodolistRepository->update($request->all(), $id);
    
            DB::table('job_t_s_note_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('job_t_s_note_todolist_updates')->insert(['actual_name' => $newJobTSNoteTodolist -> name, 'past_name' => $jobTSNoteTodolist -> name, 'datetime' => $now, 'j_t_s_n_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $jobTSNoteTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_n_todo_u', 'user_id' => $user_id, 'entity_id' => $jobTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Note Todolist updated successfully.');
            return redirect(route('jobTSNotes.show', [$jobTSNoteTodolist -> j_t_s_n_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('job_t_s_note_todolists')->join('job_t_s_notes', 'job_t_s_note_todolists.j_t_s_n_id', '=', 'job_t_s_notes.id')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'jobs.user_id', '=', 'users.id')->where('job_t_s_note_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $jobTSNoteTodolist = $this->jobTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($jobTSNoteTodolist))
            {
                Flash::error('Job T S Note Todolist not found');
                return redirect(route('jobTSNoteTodolists.index'));
            }
    
            $this->jobTSNoteTodolistRepository->delete($id);
            DB::table('recent_activities')->insert(['name' => $jobTSNoteTodolist -> name, 'status' => 'active', 'type' => 'j_t_s_n_todo_d', 'user_id' => $user_id, 'entity_id' => $jobTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Note Todolist deleted successfully.');
            return redirect(route('jobTSNotes.show', [$jobTSNoteTodolist -> j_t_s_n_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}