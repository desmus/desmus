<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSNoteTodolistRequest;
use App\Http\Requests\UpdatePersonalDataTSNoteTodolistRequest;
use App\Repositories\PersonalDataTSNoteTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSNoteTodolistController extends AppBaseController
{
    private $personalDataTSNoteTodolistRepository;

    public function __construct(PersonalDataTSNoteTodolistRepository $personalDataTSNoteTodolistRepo)
    {
        $this->personalDataTSNoteTodolistRepository = $personalDataTSNoteTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            
            $this->personalDataTSNoteTodolistRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSNoteTodolists = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->join('personal_data_t_s_n_todolists', 'personal_data_t_s_notes.id', '=', 'personal_data_t_s_n_todolists.p_d_t_s_n_id')->where('personal_datas.user_id', '=', $user_id)->where(function ($query) {$query->where('personal_data_t_s_n_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_n_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_n_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('personal_data_t_s_note_todolists.index')
                ->with('personalDataTSNoteTodolists', $personalDataTSNoteTodolists);
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
            return view('personal_data_t_s_note_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSNoteTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_t_s_notes.id', $request -> p_d_t_s_n_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            $personalDataTSNoteTodolist = $this->personalDataTSNoteTodolistRepository->create($input);
    
            DB::table('personal_data_t_s_n_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_n_t_id' => $personalDataTSNoteTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSNoteTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_n_todo_c', 'user_id' => $user_id, 'entity_id' => $personalDataTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Note Todolist saved successfully.');
            return redirect(route('personalDataTSNotes.show', [$personalDataTSNoteTodolist -> p_d_t_s_n_id]));
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
            
            DB::table('personal_data_t_s_n_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_n_t_id' => $id]);
            DB::table('personal_data_t_s_n_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $personalDataTSNoteTodolist = $this->personalDataTSNoteTodolistRepository->findWithoutFail($id);
            $personalDataTSNoteTodolistViews = DB::table('users')->join('personal_data_t_s_n_todolist_views', 'users.id', '=', 'personal_data_t_s_n_todolist_views.user_id')->where('p_d_t_s_n_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $personalDataTSNoteTodolistUpdates = DB::table('users')->join('personal_data_t_s_n_todolist_updates', 'users.id', '=', 'personal_data_t_s_n_todolist_updates.user_id')->where('p_d_t_s_n_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($personalDataTSNoteTodolist))
            {
                Flash::error('PersonalData T S Note Todolist not found');
                return redirect(route('personalDataTSNoteTodolists.index'));
            }
    
            return view('personal_data_t_s_note_todolists.show')->with('personalDataTSNoteTodolist', $personalDataTSNoteTodolist)
                ->with('personalDataTSNoteTodolistViews', $personalDataTSNoteTodolistViews)
                ->with('personalDataTSNoteTodolistUpdates', $personalDataTSNoteTodolistUpdates);
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
            $personalDataTSNoteTodolist = $this->personalDataTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolist))
            {
                Flash::error('PersonalData T S Note Todolist not found');
                return redirect(route('personalDataTSNoteTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('personal_data_t_s_note_todolists.edit')
                ->with('personalDataTSNoteTodolist', $personalDataTSNoteTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdatePersonalDataTSNoteTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_n_todolists')->join('personal_data_t_s_notes', 'personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', 'personal_data_t_s_notes.id')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('p_d_t_s_n_id', $request -> p_d_t_s_n_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSNoteTodolist = $this->personalDataTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolist))
            {
                Flash::error('PersonalData T S Note Todolist not found');
                return redirect(route('personalDataTSNoteTodolists.index'));
            }
    
            $newPersonalDataTSNoteTodolist = $this->personalDataTSNoteTodolistRepository->update($request->all(), $id);
    
            DB::table('personal_data_t_s_n_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('personal_data_t_s_n_todolist_updates')->insert(['actual_name' => $newPersonalDataTSNoteTodolist -> name, 'past_name' => $personalDataTSNoteTodolist -> name, 'datetime' => $now, 'p_d_t_s_n_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSNoteTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_n_todo_u', 'user_id' => $user_id, 'entity_id' => $personalDataTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Note Todolist updated successfully.');
            return redirect(route('personalDataTSNotes.show', [$personalDataTSNoteTodolist -> p_d_t_s_n_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_n_todolists')->join('personal_data_t_s_notes', 'personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', 'personal_data_t_s_notes.id')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_t_s_n_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSNoteTodolist = $this->personalDataTSNoteTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteTodolist))
            {
                Flash::error('PersonalData T S Note Todolist not found');
                return redirect(route('personalDataTSNoteTodolists.index'));
            }
    
            $this->personalDataTSNoteTodolistRepository->delete($id);
            
            DB::table('personal_data_t_s_n_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_n_t_id' => $personalDataTSNoteTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSNoteTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_n_todo_d', 'user_id' => $user_id, 'entity_id' => $personalDataTSNoteTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Note Todolist deleted successfully.');
            return redirect(route('personalDataTSNotes.show', [$personalDataTSNoteTodolist -> p_d_t_s_n_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}