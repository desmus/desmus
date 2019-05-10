<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserPersonalDataTSNoteRequest;
use App\Http\Requests\UpdateUserPersonalDataTSNoteRequest;
use App\Repositories\UserPersonalDataTSNoteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserPersonalDataTSNoteController extends AppBaseController
{
    private $userPersonalDataTSNoteRepository;

    public function __construct(UserPersonalDataTSNoteRepository $userPersonalDataTSNoteRepo)
    {
        $this->userPersonalDataTSNoteRepository = $userPersonalDataTSNoteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSNoteRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSNotes = $this->userPersonalDataTSNoteRepository->all();
    
            return view('user_personal_data_t_s_notes.index')
                ->with('userPersonalDataTSNotes', $userPersonalDataTSNotes);
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
            
            $personalDataTSNoteViewsList = DB::table('users')->join('personal_data_t_s_note_views', 'users.id', '=', 'personal_data_t_s_note_views.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTSNoteUpdatesList = DB::table('users')->join('personal_data_t_s_note_updates', 'users.id', '=', 'personal_data_t_s_note_updates.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $userPersonalDataTSNotesList = DB::table('user_personal_data_t_s_notes')->join('users', 'user_personal_data_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_notes.description', 'permissions', 'user_personal_data_t_s_notes.datetime', 'user_personal_data_t_s_notes.id', 'personal_data_t_s_note_id')->where('personal_data_t_s_note_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            return view('user_personal_data_t_s_notes.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('personalDataTSNoteViewsList', $personalDataTSNoteViewsList)
                ->with('personalDataTSNoteUpdatesList', $personalDataTSNoteUpdatesList)
                ->with('userPersonalDataTSNotesList', $userPersonalDataTSNotesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_notes.id', '=', $request -> personal_data_t_s_note_id)->get();
            
            $userPersonalDataTSNoteCheck = DB::table('user_personal_data_t_s_notes')->where('user_id', '=', $request -> user_id)->where('personal_data_t_s_note_id', '=', $request -> personal_data_t_s_note_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userPersonalDataTSNoteCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userPersonalDataTSNote = $this->userPersonalDataTSNoteRepository->create($input);
                    $user = DB::table('user_personal_data_t_s_notes')->join('users', 'users.id', '=', 'user_personal_data_t_s_notes.user_id')->where('user_personal_data_t_s_notes.id', '=', $userPersonalDataTSNote -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_n_c', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSNote -> personal_data_t_s_note_id, 'created_at' => $now]);
                    DB::table('user_personal_data_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_n_id' => $userPersonalDataTSNote -> id]);
                
                    Flash::success('User PersonalData T S Note saved successfully.');
                    return redirect(route('userPersonalDataTSNotes.show', [$userPersonalDataTSNote -> personal_data_t_s_note_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userPersonalDataTSNotes.show', [$request -> personal_data_t_s_note_id]));
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
            $userPersonalDataTSNote = $this->userPersonalDataTSNoteRepository->findWithoutFail($id);
            $userPersonalDataTSNotes = DB::table('user_personal_data_t_s_notes')->join('users', 'user_personal_data_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_notes.description', 'permissions', 'user_personal_data_t_s_notes.datetime', 'user_personal_data_t_s_notes.id', 'personal_data_t_s_note_id')->where('personal_data_t_s_note_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userPersonalDataTSNotes[0]))
            {
                Flash::error('User PersonalData T S Note not found');
                return redirect(route('userPersonalDataTSNotes.create', [$id]));
            }
    
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_notes.id', '=', $userPersonalDataTSNotes[0] -> personal_data_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSNote = DB::table('personal_data_t_s_notes')->where('id', '=', $userPersonalDataTSNotes[0] -> personal_data_t_s_note_id)->get();
    
                $personalDataTSNoteViewsList = DB::table('users')->join('personal_data_t_s_note_views', 'users.id', '=', 'personal_data_t_s_note_views.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSNoteUpdatesList = DB::table('users')->join('personal_data_t_s_note_updates', 'users.id', '=', 'personal_data_t_s_note_updates.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userPersonalDataTSNotesList = DB::table('user_personal_data_t_s_notes')->join('users', 'user_personal_data_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_notes.description', 'permissions', 'user_personal_data_t_s_notes.datetime', 'user_personal_data_t_s_notes.id', 'personal_data_t_s_note_id')->where('personal_data_t_s_note_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
                return view('user_personal_data_t_s_notes.show')
                    ->with('userPersonalDataTSNotes', $userPersonalDataTSNotes)
                    ->with('id', $id)
                    ->with('personalDataTSNote', $personalDataTSNote)
                    ->with('personalDataTSNoteViewsList', $personalDataTSNoteViewsList)
                    ->with('personalDataTSNoteUpdatesList', $personalDataTSNoteUpdatesList)
                    ->with('userPersonalDataTSNotesList', $userPersonalDataTSNotesList);
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
            $userPersonalDataTSNote = DB::table('users')->join('user_personal_data_t_s_notes', 'user_personal_data_t_s_notes.user_id', '=', 'users.id')->where('user_personal_data_t_s_notes.id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_notes.deleted_at', '=', null);})->get();
    
            if(empty($userPersonalDataTSNote))
            {
                Flash::error('User PersonalData T S Note not found');
                return redirect(route('userPersonalDataTSNotes.index'));
            }
    
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_notes.id', '=', $userPersonalDataTSNote[0] -> personal_data_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSNoteViewsList = DB::table('users')->join('personal_data_t_s_note_views', 'users.id', '=', 'personal_data_t_s_note_views.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSNoteUpdatesList = DB::table('users')->join('personal_data_t_s_note_updates', 'users.id', '=', 'personal_data_t_s_note_updates.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userPersonalDataTSNotesList = DB::table('user_personal_data_t_s_notes')->join('users', 'user_personal_data_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_notes.description', 'permissions', 'user_personal_data_t_s_notes.datetime', 'user_personal_data_t_s_notes.id', 'personal_data_t_s_note_id')->where('personal_data_t_s_note_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                
                return view('user_personal_data_t_s_notes.edit')
                    ->with('userPersonalDataTSNote', $userPersonalDataTSNote)
                    ->with('id', $userPersonalDataTSNote[0] -> personal_data_t_s_note_id)
                    ->with('personalDataTSNoteViewsList', $personalDataTSNoteViewsList)
                    ->with('personalDataTSNoteUpdatesList', $personalDataTSNoteUpdatesList)
                    ->with('userPersonalDataTSNotesList', $userPersonalDataTSNotesList);
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

    public function update($id, UpdateUserPersonalDataTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userPersonalDataTSNote = $this->userPersonalDataTSNoteRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNote))
            {
                Flash::error('User PersonalData T S Note not found');
                return redirect(route('userPersonalDataTSNotes.index'));
            }
    
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_notes.id', '=', $userPersonalDataTSNote -> personal_data_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userPersonalDataTSNote = $this->userPersonalDataTSNoteRepository->update($request->all(), $id);
                $user = DB::table('user_personal_data_t_s_notes')->join('users', 'users.id', '=', 'user_personal_data_t_s_notes.user_id')->where('user_personal_data_t_s_notes.id', '=', $userPersonalDataTSNote -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_n_u', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSNote -> personal_data_t_s_note_id, 'created_at' => $now]);
                DB::table('user_personal_data_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_n_id' => $userPersonalDataTSNote -> id]);
            
                Flash::success('User PersonalData T S Note updated successfully.');
                return redirect(route('userPersonalDataTSNotes.show', [$userPersonalDataTSNote -> personal_data_t_s_note_id]));
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
            $userPersonalDataTSNote = $this->userPersonalDataTSNoteRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNote))
            {
                Flash::error('User PersonalData T S Note not found');
                return redirect(route('userPersonalDataTSNotes.index'));
            }
    
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_notes.id', '=', $userPersonalDataTSNote -> personal_data_t_s_note_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userPersonalDataTSNoteRepository->delete($id);
                $user = DB::table('user_personal_data_t_s_notes')->join('users', 'users.id', '=', 'user_personal_data_t_s_notes.user_id')->where('user_personal_data_t_s_notes.id', '=', $userPersonalDataTSNote -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_n_d', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSNote -> personal_data_t_s_note_id, 'created_at' => $now]);        
                DB::table('user_personal_data_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_n_id' => $userPersonalDataTSNote -> id]);
            
                Flash::success('User PersonalData T S Note deleted successfully.');
                return redirect(route('userPersonalDataTSNotes.show', [$userPersonalDataTSNote -> personal_data_t_s_note_id]));
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