<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSNoteTodolistRequest;
use App\Http\Requests\UpdateCollegeTSNoteTodolistRequest;
use App\Repositories\CollegeTSNoteTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSNoteTodolistController extends AppBaseController
{
    private $collegeTSNoteTodolistRepository;

    public function __construct(CollegeTSNoteTodolistRepository $collegeTSNoteTodolistRepo)
    {
        $this->collegeTSNoteTodolistRepository = $collegeTSNoteTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->collegeTSNoteTodolistRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSNoteTodolists = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->join('college_t_s_note_todolists', 'college_t_s_notes.id', '=', 'college_t_s_note_todolists.c_t_s_n_id')->where('colleges.user_id', '=', $user_id)->where(function ($query) {$query->where('college_t_s_note_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_note_todolists.status', '=', 'active');})->orderBy('college_t_s_note_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('college_t_s_note_todolists.index')
                ->with('collegeTSNoteTodolists', $collegeTSNoteTodolists);
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
            return view('college_t_s_note_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSNoteTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_t_s_notes.id', $request -> c_t_s_n_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $collegeTSNoteTodolist = $this->collegeTSNoteTodolistRepository->create($input);
    
            DB::table('college_t_s_note_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_n_t_id' => $collegeTSNoteTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSNoteTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_n_todo_c', 'user_id' => $user_id, 'entity_id' => $collegeTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S Note Todolist saved successfully.');
            return redirect(route('collegeTSNotes.show', [$collegeTSNoteTodolist -> c_t_s_n_id]));
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
            
            DB::table('college_t_s_note_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_n_t_id' => $id]);
            DB::table('college_t_s_note_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $collegeTSNoteTodolist = $this->collegeTSNoteTodolistRepository->findWithoutFail($id);
            $collegeTSNoteTodolistViews = DB::table('users')->join('college_t_s_note_todolist_views', 'users.id', '=', 'college_t_s_note_todolist_views.user_id')->where('c_t_s_n_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $collegeTSNoteTodolistUpdates = DB::table('users')->join('college_t_s_note_todolist_updates', 'users.id', '=', 'college_t_s_note_todolist_updates.user_id')->where('c_t_s_n_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($collegeTSNoteTodolist))
            {
                Flash::error('College T S Note Todolist not found');
                return redirect(route('collegeTSNoteTodolists.index'));
            }
    
            return view('college_t_s_note_todolists.show')->with('collegeTSNoteTodolist', $collegeTSNoteTodolist)
                ->with('collegeTSNoteTodolistViews', $collegeTSNoteTodolistViews)
                ->with('collegeTSNoteTodolistUpdates', $collegeTSNoteTodolistUpdates);
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
            $collegeTSNoteTodolist = $this->collegeTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolist))
            {
                Flash::error('College T S Note Todolist not found');
                return redirect(route('collegeTSNoteTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('college_t_s_note_todolists.edit')->with('collegeTSNoteTodolist', $collegeTSNoteTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateCollegeTSNoteTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_note_todolists')->join('college_t_s_notes', 'college_t_s_note_todolists.c_t_s_n_id', '=', 'college_t_s_notes.id')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('c_t_s_n_id', $request -> c_t_s_n_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTSNoteTodolist = $this->collegeTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolist))
            {
                Flash::error('College T S Note Todolist not found');
                return redirect(route('collegeTSNoteTodolists.index'));
            }
    
            $newCollegeTSNoteTodolist = $this->collegeTSNoteTodolistRepository->update($request->all(), $id);
    
            DB::table('college_t_s_note_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('college_t_s_note_todolist_updates')->insert(['actual_name' => $newCollegeTSNoteTodolist -> name, 'past_name' => $collegeTSNoteTodolist -> name, 'datetime' => $now, 'c_t_s_n_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSNoteTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_n_todo_u', 'user_id' => $user_id, 'entity_id' => $collegeTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S Note Todolist updated successfully.');
            return redirect(route('collegeTSNotes.show', [$collegeTSNoteTodolist -> c_t_s_n_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_note_todolists')->join('college_t_s_notes', 'college_t_s_note_todolists.c_t_s_n_id', '=', 'college_t_s_notes.id')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_t_s_note_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTSNoteTodolist = $this->collegeTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolist))
            {
                Flash::error('College T S Note Todolist not found');
                return redirect(route('collegeTSNoteTodolists.index'));
            }
    
            $this->collegeTSNoteTodolistRepository->delete($id);
            DB::table('recent_activities')->insert(['name' => $collegeTSNoteTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_n_todo_d', 'user_id' => $user_id, 'entity_id' => $collegeTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S Note Todolist deleted successfully.');
            return redirect(route('collegeTSNotes.show', [$collegeTSNoteTodolist -> c_t_s_n_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}