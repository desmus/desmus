<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCollegeTSNoteRequest;
use App\Http\Requests\UpdateUserCollegeTSNoteRequest;
use App\Repositories\UserCollegeTSNoteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSNoteController extends AppBaseController
{
    private $userCollegeTSNoteRepository;

    public function __construct(UserCollegeTSNoteRepository $userCollegeTSNoteRepo)
    {
        $this->userCollegeTSNoteRepository = $userCollegeTSNoteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSNoteRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSNotes = $this->userCollegeTSNoteRepository->all();
    
            return view('user_college_t_s_notes.index')
                ->with('userCollegeTSNotes', $userCollegeTSNotes);
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
            
            $userCollegeTSNotesList = DB::table('user_college_t_s_notes')->join('users', 'user_college_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_notes.description', 'permissions', 'user_college_t_s_notes.datetime', 'user_college_t_s_notes.id', 'college_t_s_note_id')->where('college_t_s_note_id', $id)->where(function ($query) {$query->where('user_college_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTopicSectionNoteViewsList = DB::table('users')->join('college_t_s_note_views', 'users.id', '=', 'college_t_s_note_views.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTopicSectionNoteUpdatesList = DB::table('users')->join('college_t_s_note_updates', 'users.id', '=', 'college_t_s_note_updates.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_college_t_s_notes.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userCollegeTSNotesList', $userCollegeTSNotesList)
                ->with('collegeTSNoteViewsList', $collegeTopicSectionNoteViewsList)
                ->with('collegeTSNoteUpdatesList', $collegeTopicSectionNoteUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_notes.id', '=', $request -> college_t_s_note_id)->get();
            
            $userCollegeTSNoteCheck = DB::table('user_college_t_s_notes')->where('user_id', '=', $request -> user_id)->where('college_t_s_note_id', '=', $request -> college_t_s_note_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userCollegeTSNoteCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userCollegeTSNote = $this->userCollegeTSNoteRepository->create($input);
                    $user = DB::table('user_college_t_s_notes')->join('users', 'users.id', '=', 'user_college_t_s_notes.user_id')->where('user_college_t_s_notes.id', '=', $userCollegeTSNote -> id)->select('name')->get();
                
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_n_c', 'user_id' => $user_id, 'entity_id' => $userCollegeTSNote -> college_t_s_note_id, 'created_at' => $now]);
                    DB::table('user_college_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote -> id]);
                
                    Flash::success('User College T S Note saved successfully.');
                    return redirect(route('userCollegeTSNotes.show', [$userCollegeTSNote -> college_t_s_note_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userCollegeTSNotes.show', [$request -> college_t_s_note_id]));
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
            $userCollegeTSNote = $this->userCollegeTSNoteRepository->findWithoutFail($id);
            $userCollegeTSNotes = DB::table('user_college_t_s_notes')->join('users', 'user_college_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_notes.description', 'permissions', 'user_college_t_s_notes.datetime', 'user_college_t_s_notes.id', 'college_t_s_note_id')->where('college_t_s_note_id', $id)->where(function ($query) {$query->where('user_college_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userCollegeTSNotes[0]))
            {
                Flash::error('User College T S Note not found');
                return redirect(route('userCollegeTSNotes.create', [$id]));
            }
            
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_notes.id', '=', $userCollegeTSNotes[0] -> college_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTSNote = DB::table('college_t_s_notes')->where('id', '=', $userCollegeTSNotes[0] -> college_t_s_note_id)->get();
    
                $userCollegeTSNotesList = DB::table('user_college_t_s_notes')->join('users', 'user_college_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_notes.description', 'permissions', 'user_college_t_s_notes.datetime', 'user_college_t_s_notes.id', 'college_t_s_note_id')->where('college_t_s_note_id', $id)->where(function ($query) {$query->where('user_college_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTopicSectionNoteViewsList = DB::table('users')->join('college_t_s_note_views', 'users.id', '=', 'college_t_s_note_views.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTopicSectionNoteUpdatesList = DB::table('users')->join('college_t_s_note_updates', 'users.id', '=', 'college_t_s_note_updates.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_college_t_s_notes.show')
                    ->with('userCollegeTSNotes', $userCollegeTSNotes)
                    ->with('id', $id)
                    ->with('collegeTSNote', $collegeTSNote)
                    ->with('userCollegeTSNotesList', $userCollegeTSNotesList)
                    ->with('collegeTSNoteViewsList', $collegeTopicSectionNoteViewsList)
                    ->with('collegeTSNoteUpdatesList', $collegeTopicSectionNoteUpdatesList);
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
            $userCollegeTSNote = DB::table('users')->join('user_college_t_s_notes', 'user_college_t_s_notes.user_id', '=', 'users.id')->where('user_college_t_s_notes.id', $id)->where(function ($query) {$query->where('user_college_t_s_notes.deleted_at', '=', null);})->get();
    
            if(empty($userCollegeTSNote))
            {
                Flash::error('User College T S Note not found');
                return redirect(route('userCollegeTSNotes.index'));
            }
    
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_notes.id', '=', $userCollegeTSNote[0] -> college_t_s_note_id)->get();
            
            $userCollegeTSNotesList = DB::table('user_college_t_s_notes')->join('users', 'user_college_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_notes.description', 'permissions', 'user_college_t_s_notes.datetime', 'user_college_t_s_notes.id', 'college_t_s_note_id')->where('college_t_s_note_id', $id)->where(function ($query) {$query->where('user_college_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTopicSectionNoteViewsList = DB::table('users')->join('college_t_s_note_views', 'users.id', '=', 'college_t_s_note_views.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTopicSectionNoteUpdatesList = DB::table('users')->join('college_t_s_note_updates', 'users.id', '=', 'college_t_s_note_updates.user_id')->where('college_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('user_college_t_s_notes.edit')
                    ->with('userCollegeTSNote', $userCollegeTSNote)
                    ->with('id', $userCollegeTSNote[0] -> college_t_s_note_id)
                    ->with('userCollegeTSNotesList', $userCollegeTSNotesList)
                    ->with('collegeTSNoteViewsList', $collegeTopicSectionNoteViewsList)
                    ->with('collegeTSNoteUpdatesList', $collegeTopicSectionNoteUpdatesList);
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

    public function update($id, UpdateUserCollegeTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userCollegeTSNote = $this->userCollegeTSNoteRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNote))
            {
                Flash::error('User College T S Note not found');
                return redirect(route('userCollegeTSNotes.index'));
            }
    
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_notes.id', '=', $userCollegeTSNote -> college_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userCollegeTSNote = $this->userCollegeTSNoteRepository->update($request->all(), $id);
                $user = DB::table('user_college_t_s_notes')->join('users', 'users.id', '=', 'user_college_t_s_notes.user_id')->where('user_college_t_s_notes.id', '=', $userCollegeTSNote -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_n_u', 'user_id' => $user_id, 'entity_id' => $userCollegeTSNote -> college_t_s_note_id, 'created_at' => $now]);        
                DB::table('user_college_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote -> id]);
            
                Flash::success('User College T S Note updated successfully.');
                return redirect(route('userCollegeTSNotes.show', [$userCollegeTSNote -> college_t_s_note_id]));
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
            $userCollegeTSNote = $this->userCollegeTSNoteRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNote))
            {
                Flash::error('User College T S Note not found');
                return redirect(route('userCollegeTSNotes.index'));
            }
    
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_notes.id', '=', $userCollegeTSNote -> college_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userCollegeTSNoteRepository->delete($id);
                $user = DB::table('user_college_t_s_notes')->join('users', 'users.id', '=', 'user_college_t_s_notes.user_id')->where('user_college_t_s_notes.id', '=', $userCollegeTSNote -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_n_d', 'user_id' => $user_id, 'entity_id' => $userCollegeTSNote -> college_t_s_note_id, 'created_at' => $now]);        
                DB::table('user_college_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote -> id]);
            
                Flash::success('User College T S Note deleted successfully.');
                return redirect(route('userCollegeTSNotes.show', [$userCollegeTSNote -> college_t_s_note_id]));
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