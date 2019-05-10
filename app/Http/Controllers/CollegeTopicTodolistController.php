<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicTodolistRequest;
use App\Http\Requests\UpdateCollegeTopicTodolistRequest;
use App\Repositories\CollegeTopicTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicTodolistController extends AppBaseController
{
    private $collegeTopicTodolistRepository;

    public function __construct(CollegeTopicTodolistRepository $collegeTopicTodolistRepo)
    {
        $this->collegeTopicTodolistRepository = $collegeTopicTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->collegeTopicTodolistRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicTodolists = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_todolists', 'college_topics.id', '=', 'college_topic_todolists.college_topic_id')->where('colleges.user_id', '=', $user_id)->where(function ($query) {$query->where('college_topic_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_topic_todolists.status', '=', 'active');})->orderBy('college_topic_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('college_topic_todolists.index')
                ->with('collegeTopicTodolists', $collegeTopicTodolists);
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
            return view('college_topic_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_topics')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_topics.id', $request -> college_topic_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $collegeTopicTodolist = $this->collegeTopicTodolistRepository->create($input);
            
            DB::table('college_topic_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_t_id' => $collegeTopicTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTopicTodolist -> name, 'status' => 'active', 'type' => 'c_t_todo_c', 'user_id' => $user_id, 'entity_id' => $collegeTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College Topic Todolist saved successfully.');
            return redirect(route('collegeTopics.show', [$collegeTopicTodolist -> college_topic_id]));
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
            $collegeTopicTodolist = $this->collegeTopicTodolistRepository->findWithoutFail($id);
            
            DB::table('college_topic_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_t_id' => $id]);
            DB::table('college_topic_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $collegeTopicTodolist = $this->collegeTopicTodolistRepository->findWithoutFail($id);
            $collegeTopicTodolistViews = DB::table('users')->join('college_topic_todolist_views', 'users.id', '=', 'college_topic_todolist_views.user_id')->where('c_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $collegeTopicTodolistUpdates = DB::table('users')->join('college_topic_todolist_updates', 'users.id', '=', 'college_topic_todolist_updates.user_id')->where('c_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($collegeTopicTodolist))
            {
                Flash::error('College Topic Todolist not found');
                return redirect(route('collegeTopicTodolists.index'));
            }
    
            return view('college_topic_todolists.show')
                ->with('collegeTopicTodolist', $collegeTopicTodolist)
                ->with('collegeTopicTodolistViews', $collegeTopicTodolistViews)
                ->with('collegeTopicTodolistUpdates', $collegeTopicTodolistUpdates);
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
            $collegeTopicTodolist = $this->collegeTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolist))
            {
                Flash::error('College Topic Todolist not found');
                return redirect(route('collegeTopicTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('college_topic_todolists.edit')
                ->with('collegeTopicTodolist', $collegeTopicTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateCollegeTopicTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_topic_todolists')->join('college_topics', 'college_topic_todolists.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_topic_id', $request -> college_topic_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTopicTodolist = $this->collegeTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolist))
            {
                Flash::error('College Topic Todolist not found');
                return redirect(route('collegeTopicTodolists.index'));
            }
    
            $newCollegeTopicTodolist = $this->collegeTopicTodolistRepository->update($request->all(), $id);
            
            DB::table('college_topic_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('college_topic_todolist_updates')->insert(['actual_name' => $newCollegeTopicTodolist -> name, 'past_name' => $collegeTopicTodolist -> name, 'datetime' => $now, 'c_t_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $collegeTopicTodolist -> name, 'status' => 'active', 'type' => 'c_t_todo_u', 'user_id' => $user_id, 'entity_id' => $collegeTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College Topic Todolist updated successfully.');
            return redirect(route('collegeTopics.show', [$collegeTopicTodolist -> college_topic_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_topic_todolists')->join('college_topics', 'college_topic_todolists.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_topic_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTopicTodolist = $this->collegeTopicTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTopicTodolist))
            {
                Flash::error('College Topic Todolist not found');
                return redirect(route('collegeTopicTodolists.index'));
            }
    
            $this->collegeTopicTodolistRepository->delete($id);
            
            DB::table('college_topic_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_t_id' => $collegeTopicTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTopicTodolist -> name, 'status' => 'active', 'type' => 'c_t_todo_d', 'user_id' => $user_id, 'entity_id' => $collegeTopicTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College Topic Todolist deleted successfully.');
            return redirect(route('collegeTopics.show', [$collegeTopicTodolist -> college_topic_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}