<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserProjectTSNoteRequest;
use App\Http\Requests\UpdateUserProjectTSNoteRequest;
use App\Repositories\UserProjectTSNoteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserProjectTSNoteController extends AppBaseController
{
    private $userProjectTSNoteRepository;

    public function __construct(UserProjectTSNoteRepository $userProjectTSNoteRepo)
    {
        $this->userProjectTSNoteRepository = $userProjectTSNoteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSNoteRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSNotes = $this->userProjectTSNoteRepository->all();
    
            return view('user_project_t_s_notes.index')
                ->with('userProjectTSNotes', $userProjectTSNotes);
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
            
            $projectTSNoteViewsList = DB::table('users')->join('project_t_s_note_views', 'users.id', '=', 'project_t_s_note_views.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTSNoteUpdatesList = DB::table('users')->join('project_t_s_note_updates', 'users.id', '=', 'project_t_s_note_updates.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $userProjectTSNotesList = DB::table('user_project_t_s_notes')->join('users', 'user_project_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_notes.description', 'permissions', 'user_project_t_s_notes.datetime', 'user_project_t_s_notes.id', 'project_t_s_note_id')->where('project_t_s_note_id', $id)->where(function ($query) {$query->where('user_project_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            return view('user_project_t_s_notes.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('projectTSNoteViewsList', $projectTSNoteViewsList)
                ->with('projectTSNoteUpdatesList', $projectTSNoteUpdatesList)
                ->with('userProjectTSNotesList', $userProjectTSNotesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_notes.id', '=', $request -> project_t_s_note_id)->get();
            
            $userProjectTSNoteCheck = DB::table('user_project_t_s_notes')->where('user_id', '=', $request -> user_id)->where('project_t_s_note_id', '=', $request -> project_t_s_note_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userProjectTSNoteCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userProjectTSNote = $this->userProjectTSNoteRepository->create($input);
                    $user = DB::table('user_project_t_s_notes')->join('users', 'users.id', '=', 'user_project_t_s_notes.user_id')->where('user_project_t_s_notes.id', '=', $userProjectTSNote -> id)->select('name')->get();
                
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_n_c', 'user_id' => $user_id, 'entity_id' => $userProjectTSNote -> project_t_s_note_id, 'created_at' => $now]);
                    DB::table('user_project_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote -> id]);
                
                    Flash::success('User Project T S Note saved successfully.');
                    return redirect(route('userProjectTSNotes.show', [$userProjectTSNote -> project_t_s_note_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userProjectTSNotes.show', [$request -> project_t_s_note_id]));
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
            $userProjectTSNote = $this->userProjectTSNoteRepository->findWithoutFail($id);
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->join('users', 'user_project_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_notes.description', 'permissions', 'user_project_t_s_notes.datetime', 'user_project_t_s_notes.id', 'project_t_s_note_id')->where('project_t_s_note_id', $id)->where(function ($query) {$query->where('user_project_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userProjectTSNotes[0]))
            {
                Flash::error('User Project T S Note not found');
                return redirect(route('userProjectTSNotes.create', [$id]));
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_notes.id', '=', $userProjectTSNotes[0] -> project_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTSNote = DB::table('project_t_s_notes')->where('id', '=', $userProjectTSNotes[0] -> project_t_s_note_id)->get();
    
                $projectTSNoteViewsList = DB::table('users')->join('project_t_s_note_views', 'users.id', '=', 'project_t_s_note_views.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSNoteUpdatesList = DB::table('users')->join('project_t_s_note_updates', 'users.id', '=', 'project_t_s_note_updates.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userProjectTSNotesList = DB::table('user_project_t_s_notes')->join('users', 'user_project_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_notes.description', 'permissions', 'user_project_t_s_notes.datetime', 'user_project_t_s_notes.id', 'project_t_s_note_id')->where('project_t_s_note_id', $id)->where(function ($query) {$query->where('user_project_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
                return view('user_project_t_s_notes.show')
                    ->with('userProjectTSNotes', $userProjectTSNotes)
                    ->with('id', $id)
                    ->with('projectTSNote', $projectTSNote)
                    ->with('projectTSNoteViewsList', $projectTSNoteViewsList)
                    ->with('projectTSNoteUpdatesList', $projectTSNoteUpdatesList)
                    ->with('userProjectTSNotesList', $userProjectTSNotesList);
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
            $userProjectTSNote = DB::table('users')->join('user_project_t_s_notes', 'user_project_t_s_notes.user_id', '=', 'users.id')->where('user_project_t_s_notes.id', $id)->where(function ($query) {$query->where('user_project_t_s_notes.deleted_at', '=', null);})->get();
    
            if(empty($userProjectTSNote))
            {
                Flash::error('User Project T S Note not found');
                return redirect(route('userProjectTSNotes.index'));
            }
    
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_notes.id', '=', $userProjectTSNote[0] -> project_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTSNoteViewsList = DB::table('users')->join('project_t_s_note_views', 'users.id', '=', 'project_t_s_note_views.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSNoteUpdatesList = DB::table('users')->join('project_t_s_note_updates', 'users.id', '=', 'project_t_s_note_updates.user_id')->where('project_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userProjectTSNotesList = DB::table('user_project_t_s_notes')->join('users', 'user_project_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_notes.description', 'permissions', 'user_project_t_s_notes.datetime', 'user_project_t_s_notes.id', 'project_t_s_note_id')->where('project_t_s_note_id', $id)->where(function ($query) {$query->where('user_project_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();

                return view('user_project_t_s_notes.edit')
                    ->with('userProjectTSNote', $userProjectTSNote)
                    ->with('id', $userProjectTSNote[0] -> project_t_s_note_id)
                    ->with('userProjectTSNotesList', $userProjectTSNotesList)
                    ->with('projectTSNoteViewsList', $projectTSNoteViewsList)
                    ->with('projectTSNoteUpdatesList', $projectTSNoteUpdatesList)
                    ->with('userProjectTSNotesList', $userProjectTSNotesList);
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

    public function update($id, UpdateUserProjectTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userProjectTSNote = $this->userProjectTSNoteRepository->findWithoutFail($id);
    
            if(empty($userProjectTSNote))
            {
                Flash::error('User Project T S Note not found');
                return redirect(route('userProjectTSNotes.index'));
            }
    
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_notes.id', '=', $userProjectTSNote -> project_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userProjectTSNote = $this->userProjectTSNoteRepository->update($request->all(), $id);
                $user = DB::table('user_project_t_s_notes')->join('users', 'users.id', '=', 'user_project_t_s_notes.user_id')->where('user_project_t_s_notes.id', '=', $userProjectTSNote -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_n_u', 'user_id' => $user_id, 'entity_id' => $userProjectTSNote -> project_t_s_note_id, 'created_at' => $now]);        
                DB::table('user_project_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote -> id]);
            
                Flash::success('User Project T S Note updated successfully.');
                return redirect(route('userProjectTSNotes.show', [$userProjectTSNote -> project_t_s_note_id]));
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
            $userProjectTSNote = $this->userProjectTSNoteRepository->findWithoutFail($id);
    
            if(empty($userProjectTSNote))
            {
                Flash::error('User Project T S Note not found');
                return redirect(route('userProjectTSNotes.index'));
            }
    
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_notes.id', '=', $userProjectTSNote -> project_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userProjectTSNoteRepository->delete($id);
                $user = DB::table('user_project_t_s_notes')->join('users', 'users.id', '=', 'user_project_t_s_notes.user_id')->where('user_project_t_s_notes.id', '=', $userProjectTSNote -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_n_d', 'user_id' => $user_id, 'entity_id' => $userProjectTSNote -> project_t_s_note_id, 'created_at' => $now]);        
                DB::table('user_project_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote -> id]);
            
                Flash::success('User Project T S Note deleted successfully.');
                return redirect(route('userProjectTSNotes.show', [$userProjectTSNote -> project_t_s_note_id]));
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