<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserJobTSNoteRequest;
use App\Http\Requests\UpdateUserJobTSNoteRequest;
use App\Repositories\UserJobTSNoteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserJobTSNoteController extends AppBaseController
{
    private $userJobTSNoteRepository;

    public function __construct(UserJobTSNoteRepository $userJobTSNoteRepo)
    {
        $this->userJobTSNoteRepository = $userJobTSNoteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSNoteRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSNotes = $this->userJobTSNoteRepository->all();
    
            return view('user_job_t_s_notes.index')
                ->with('userJobTSNotes', $userJobTSNotes);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $users = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->select('name', 'contacts.user_id', 'users.id')->where('contacts.user_id', '=', $user_id)->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->orderBy('name', 'asc')->get();
            $select = [];
                
            foreach($users as $user)
            {
                $select[$user->id] = $user->name;
            }
            
            $userJobTSNotesList = DB::table('user_job_t_s_notes')->join('users', 'user_job_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_notes.description', 'permissions', 'user_job_t_s_notes.datetime', 'user_job_t_s_notes.id', 'job_t_s_note_id')->where('job_t_s_note_id', $id)->where(function ($query) {$query->where('user_job_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $jobTSNoteViewsList = DB::table('users')->join('job_t_s_note_views', 'users.id', '=', 'job_t_s_note_views.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->paginate(10);
            $jobTSNoteUpdatesList = DB::table('users')->join('job_t_s_note_updates', 'users.id', '=', 'job_t_s_note_updates.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_job_t_s_notes.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userJobTSNotesList', $userJobTSNotesList)
                ->with('jobTSNoteViewsList', $jobTSNoteViewsList)
                ->with('jobTSNoteUpdatesList', $jobTSNoteUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_notes.id', '=', $request -> job_t_s_note_id)->get();
            
            $userJobTSNoteCheck = DB::table('user_job_t_s_notes')->where('user_id', '=', $request -> user_id)->where('job_t_s_note_id', '=', $request -> job_t_s_note_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userJobTSNoteCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userJobTSNote = $this->userJobTSNoteRepository->create($input);
                    $user = DB::table('user_job_t_s_notes')->join('users', 'users.id', '=', 'user_job_t_s_notes.user_id')->where('user_job_t_s_notes.id', '=', $userJobTSNote -> id)->select('name')->get();
                
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_n_c', 'user_id' => $user_id, 'entity_id' => $userJobTSNote -> job_t_s_note_id, 'created_at' => $now]);
                    DB::table('user_job_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_n_id' => $userJobTSNote -> id]);
                
                    Flash::success('User Job T S Note saved successfully.');
                    return redirect(route('userJobTSNotes.show', [$userJobTSNote -> job_t_s_note_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userJobTSNotes.show', [$request -> job_t_s_note_id]));
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
            $userJobTSNote = $this->userJobTSNoteRepository->findWithoutFail($id);
            $userJobTSNotes = DB::table('user_job_t_s_notes')->join('users', 'user_job_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_notes.description', 'permissions', 'user_job_t_s_notes.datetime', 'user_job_t_s_notes.id', 'job_t_s_note_id')->where('job_t_s_note_id', $id)->where(function ($query) {$query->where('user_job_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userJobTSNotes[0]))
            {
                Flash::error('User Job T S Note not found');
                return redirect(route('userJobTSNotes.create', [$id]));
            }
            
            $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_notes.id', '=', $userJobTSNotes[0] -> job_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $jobTSNote = DB::table('job_t_s_notes')->where('id', '=', $userJobTSNotes[0] -> job_t_s_note_id)->get();
    
                $userJobTSNotesList = DB::table('user_job_t_s_notes')->join('users', 'user_job_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_notes.description', 'permissions', 'user_job_t_s_notes.datetime', 'user_job_t_s_notes.id', 'job_t_s_note_id')->where('job_t_s_note_id', $id)->where(function ($query) {$query->where('user_job_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSNoteViewsList = DB::table('users')->join('job_t_s_note_views', 'users.id', '=', 'job_t_s_note_views.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->paginate(10);
                $jobTSNoteUpdatesList = DB::table('users')->join('job_t_s_note_updates', 'users.id', '=', 'job_t_s_note_updates.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_job_t_s_notes.show')
                    ->with('userJobTSNotes', $userJobTSNotes)
                    ->with('id', $id)
                    ->with('jobTSNote', $jobTSNote)
                    ->with('userJobTSNotesList', $userJobTSNotesList)
                    ->with('jobTSNoteViewsList', $jobTSNoteViewsList)
                    ->with('jobTSNoteUpdatesList', $jobTSNoteUpdatesList);
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
            $userJobTSNote = DB::table('users')->join('user_job_t_s_notes', 'user_job_t_s_notes.user_id', '=', 'users.id')->where('user_job_t_s_notes.id', $id)->where(function ($query) {$query->where('user_job_t_s_notes.deleted_at', '=', null);})->get();
    
            if(empty($userJobTSNote))
            {
                Flash::error('User Job T S Note not found');
                return redirect(route('userJobTSNotes.index'));
            }
    
            $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_notes.id', '=', $userJobTSNote[0] -> job_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userJobTSNotesList = DB::table('user_job_t_s_notes')->join('users', 'user_job_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_notes.description', 'permissions', 'user_job_t_s_notes.datetime', 'user_job_t_s_notes.id', 'job_t_s_note_id')->where('job_t_s_note_id', $id)->where(function ($query) {$query->where('user_job_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSNoteViewsList = DB::table('users')->join('job_t_s_note_views', 'users.id', '=', 'job_t_s_note_views.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->paginate(10);
                $jobTSNoteUpdatesList = DB::table('users')->join('job_t_s_note_updates', 'users.id', '=', 'job_t_s_note_updates.user_id')->where('job_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_job_t_s_notes.edit')
                    ->with('userJobTSNote', $userJobTSNote)
                    ->with('id', $userJobTSNote[0] -> job_t_s_note_id)
                    ->with('userJobTSNotesList', $userJobTSNotesList)
                    ->with('jobTSNoteViewsList', $jobTSNoteViewsList)
                    ->with('jobTSNoteUpdatesList', $jobTSNoteUpdatesList);
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

    public function update($id, UpdateUserJobTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userJobTSNote = $this->userJobTSNoteRepository->findWithoutFail($id);
    
            if(empty($userJobTSNote))
            {
                Flash::error('User Job T S Note not found');
                return redirect(route('userJobTSNotes.index'));
            }
    
            $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_notes.id', '=', $userJobTSNote -> job_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userJobTSNote = $this->userJobTSNoteRepository->update($request->all(), $id);
                $user = DB::table('user_job_t_s_notes')->join('users', 'users.id', '=', 'user_job_t_s_notes.user_id')->where('user_job_t_s_notes.id', '=', $userJobTSNote -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_n_u', 'user_id' => $user_id, 'entity_id' => $userJobTSNote -> job_t_s_note_id, 'created_at' => $now]);        
                DB::table('user_job_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_n_id' => $userJobTSNote -> id]);
            
                Flash::success('User Job T S Note updated successfully.');
                return redirect(route('userJobTSNotes.show', [$userJobTSNote -> job_t_s_note_id]));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userJobTSNote = $this->userJobTSNoteRepository->findWithoutFail($id);
    
            if(empty($userJobTSNote))
            {
                Flash::error('User Job T S Note not found');
                return redirect(route('userJobTSNotes.index'));
            }
    
            $user = DB::table('job_t_s_notes')->join('job_topic_sections', 'job_t_s_notes.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_notes.id', '=', $userJobTSNote -> job_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userJobTSNoteRepository->delete($id);
                $user = DB::table('user_job_t_s_notes')->join('users', 'users.id', '=', 'user_job_t_s_notes.user_id')->where('user_job_t_s_notes.id', '=', $userJobTSNote -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_n_d', 'user_id' => $user_id, 'entity_id' => $userJobTSNote -> job_t_s_note_id, 'created_at' => $now]);        
                DB::table('user_job_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_n_id' => $userJobTSNote -> id]);
            
                Flash::success('User Job T S Note deleted successfully.');
                return redirect(route('userJobTSNotes.show', [$userJobTSNote -> job_t_s_note_id]));
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