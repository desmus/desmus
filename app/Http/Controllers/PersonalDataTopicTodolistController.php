<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicTodolistRequest;
use App\Http\Requests\UpdatePersonalDataTopicTodolistRequest;
use App\Repositories\PersonalDataTopicTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicTodolistController extends AppBaseController
{
    private $personalDataTopicTodolistRepository;

    public function __construct(PersonalDataTopicTodolistRepository $personalDataTopicTodolistRepo)
    {
        $this->personalDataTopicTodolistRepository = $personalDataTopicTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->personalDataTopicTodolistRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicTodolists = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_todolists', 'personal_data_topics.id', '=', 'personal_data_topic_todolists.p_d_t_id')->where('personal_datas.user_id', '=', $user_id)->where(function ($query) {$query->where('personal_data_topic_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_topic_todolists.status', '=', 'active');})->orderBy('personal_data_topic_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('personal_data_topic_todolists.index')
                ->with('personalDataTopicTodolists', $personalDataTopicTodolists);
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
            return view('personal_data_topic_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTopicTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_topics')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_topics.id', $request -> p_d_t_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $personalDataTopicTodolist = $this->personalDataTopicTodolistRepository->create($input);
            
            DB::table('personal_data_topic_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_t_id' => $personalDataTopicTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTopicTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_todo_c', 'user_id' => $user_id, 'entity_id' => $personalDataTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData Topic Todolist saved successfully.');
            return redirect(route('personalDataTopics.show', [$personalDataTopicTodolist -> p_d_t_id]));
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
            $personalDataTopicTodolist = $this->personalDataTopicTodolistRepository->findWithoutFail($id);
            
            DB::table('personal_data_topic_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_t_id' => $id]);
            DB::table('personal_data_topic_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $personalDataTopicTodolist = $this->personalDataTopicTodolistRepository->findWithoutFail($id);
            $personalDataTopicTodolistViews = DB::table('users')->join('personal_data_topic_todolist_views', 'users.id', '=', 'personal_data_topic_todolist_views.user_id')->where('p_d_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $personalDataTopicTodolistUpdates = DB::table('users')->join('personal_data_topic_todolist_updates', 'users.id', '=', 'personal_data_topic_todolist_updates.user_id')->where('p_d_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($personalDataTopicTodolist))
            {
                Flash::error('PersonalData Topic Todolist not found');
                return redirect(route('personalDataTopicTodolists.index'));
            }
    
            return view('personal_data_topic_todolists.show')
                ->with('personalDataTopicTodolist', $personalDataTopicTodolist)
                ->with('personalDataTopicTodolistViews', $personalDataTopicTodolistViews)
                ->with('personalDataTopicTodolistUpdates', $personalDataTopicTodolistUpdates);
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
            $personalDataTopicTodolist = $this->personalDataTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolist))
            {
                Flash::error('PersonalData Topic Todolist not found');
                return redirect(route('personalDataTopicTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('personal_data_topic_todolists.edit')
                ->with('personalDataTopicTodolist', $personalDataTopicTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdatePersonalDataTopicTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_topic_todolists')->join('personal_data_topics', 'personal_data_topic_todolists.p_d_t_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('p_d_t_id', $request -> p_d_t_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTopicTodolist = $this->personalDataTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolist))
            {
                Flash::error('PersonalData Topic Todolist not found');
                return redirect(route('personalDataTopicTodolists.index'));
            }
    
            $newPersonalDataTopicTodolist = $this->personalDataTopicTodolistRepository->update($request->all(), $id);
            
            DB::table('personal_data_topic_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('personal_data_topic_todolist_updates')->insert(['actual_name' => $newPersonalDataTopicTodolist -> name, 'past_name' => $personalDataTopicTodolist -> name, 'datetime' => $now, 'p_d_t_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTopicTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_todo_u', 'user_id' => $user_id, 'entity_id' => $personalDataTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData Topic Todolist updated successfully.');
            return redirect(route('personalDataTopics.show', [$personalDataTopicTodolist -> p_d_t_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_topic_todolists')->join('personal_data_topics', 'personal_data_topic_todolists.p_d_t_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_topic_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTopicTodolist = $this->personalDataTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicTodolist))
            {
                Flash::error('PersonalData Topic Todolist not found');
                return redirect(route('personalDataTopicTodolists.index'));
            }
    
            $this->personalDataTopicTodolistRepository->delete($id);
            
            DB::table('personal_data_topic_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_t_id' => $personalDataTopicTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTopicTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_todo_d', 'user_id' => $user_id, 'entity_id' => $personalDataTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData Topic Todolist deleted successfully.');
            return redirect(route('personalDataTopics.show', [$personalDataTopicTodolist -> p_d_t_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}