<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolTodolistRequest;
use App\Http\Requests\UpdateCollegeTSToolTodolistRequest;
use App\Repositories\CollegeTSToolTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolTodolistController extends AppBaseController
{
    private $collegeTSToolTodolistRepository;

    public function __construct(CollegeTSToolTodolistRepository $collegeTSToolTodolistRepo)
    {
        $this->collegeTSToolTodolistRepository = $collegeTSToolTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->collegeTSToolTodolistRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolTodolists = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_tools', 'college_topic_sections.id', '=', 'college_t_s_tools.college_topic_section_id')->join('college_t_s_tool_todolists', 'college_t_s_tools.id', '=', 'college_t_s_tool_todolists.c_t_s_t_id')->where('colleges.user_id', '=', $user_id)->where(function ($query) {$query->where('college_t_s_tool_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_tool_todolists.status', '=', 'active');})->orderBy('college_t_s_tool_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('college_t_s_tool_todolists.index')
                ->with('collegeTSToolTodolists', $collegeTSToolTodolists);
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
            return view('college_t_s_tool_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_t_s_tools.id', $request -> c_t_s_t_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $collegeTSToolTodolist = $this->collegeTSToolTodolistRepository->create($input);
            
            DB::table('college_t_s_tool_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_t_t_id' => $collegeTSToolTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSToolTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_t_todo_c', 'user_id' => $user_id, 'entity_id' => $collegeTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S Tool Todolist saved successfully.');
            return redirect(route('collegeTSTools.show', [$collegeTSToolTodolist -> c_t_s_t_id]));
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
            
            DB::table('college_t_s_tool_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_t_t_id' => $id]);
            DB::table('college_t_s_tool_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $collegeTSToolTodolist = $this->collegeTSToolTodolistRepository->findWithoutFail($id);
            $collegeTSToolTodolistViews = DB::table('users')->join('college_t_s_tool_todolist_views', 'users.id', '=', 'college_t_s_tool_todolist_views.user_id')->where('c_t_s_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $collegeTSToolTodolistUpdates = DB::table('users')->join('college_t_s_tool_todolist_updates', 'users.id', '=', 'college_t_s_tool_todolist_updates.user_id')->where('c_t_s_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($collegeTSToolTodolist))
            {
                Flash::error('College T S Tool Todolist not found');
                return redirect(route('collegeTSToolTodolists.index'));
            }
    
            return view('college_t_s_tool_todolists.show')
                ->with('collegeTSToolTodolist', $collegeTSToolTodolist)
                ->with('collegeTSToolTodolistViews', $collegeTSToolTodolistViews)
                ->with('collegeTSToolTodolistUpdates', $collegeTSToolTodolistUpdates);
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
            $collegeTSToolTodolist = $this->collegeTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolist))
            {
                Flash::error('College T S Tool Todolist not found');
                return redirect(route('collegeTSToolTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('college_t_s_tool_todolists.edit')->with('collegeTSToolTodolist', $collegeTSToolTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateCollegeTSToolTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_tool_todolists')->join('college_t_s_tools', 'college_t_s_tool_todolists.c_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('c_t_s_t_id', $request -> c_t_s_t_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $collegeTSToolTodolist = $this->collegeTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolist))
            {
                Flash::error('College T S Tool Todolist not found');
                return redirect(route('collegeTSToolTodolists.index'));
            }
    
            $newCollegeTSToolTodolist = $this->collegeTSToolTodolistRepository->update($request->all(), $id);
    
            DB::table('college_t_s_tool_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('college_t_s_tool_todolist_updates')->insert(['actual_name' => $newCollegeTSToolTodolist -> name, 'past_name' => $collegeTSToolTodolist -> name, 'datetime' => $now, 'c_t_s_t_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSToolTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_t_todo_u', 'user_id' => $user_id, 'entity_id' => $collegeTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S Tool Todolist updated successfully.');
            return redirect(route('collegeTSTools.show', [$collegeTSToolTodolist -> c_t_s_t_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_tool_todolists')->join('college_t_s_tools', 'college_t_s_tool_todolists.c_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_t_s_tool_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $collegeTSToolTodolist = $this->collegeTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolist))
            {
                Flash::error('College T S Tool Todolist not found');
                return redirect(route('collegeTSToolTodolists.index'));
            }
    
            $this->collegeTSToolTodolistRepository->delete($id);
            
            DB::table('college_t_s_tool_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_t_t_id' => $collegeTSToolTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSToolTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_t_todo_d', 'user_id' => $user_id, 'entity_id' => $collegeTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S Tool Todolist deleted successfully.');
            return redirect(route('collegeTSTools.show', [$collegeTSToolTodolist -> c_t_s_t_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}