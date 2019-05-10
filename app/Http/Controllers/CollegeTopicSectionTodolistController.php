<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicSectionTodolistRequest;
use App\Http\Requests\UpdateCollegeTopicSectionTodolistRequest;
use App\Repositories\CollegeTopicSectionTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicSectionTodolistController extends AppBaseController
{
    private $collegeTopicSectionTodolistRepository;

    public function __construct(CollegeTopicSectionTodolistRepository $collegeTopicSectionTodolistRepo)
    {
        $this->collegeTopicSectionTodolistRepository = $collegeTopicSectionTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->collegeTopicSectionTodolistRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicSectionTodolists = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_topic_section_todolists', 'college_topic_sections.id', '=', 'college_topic_section_todolists.c_t_s_id')->where('colleges.user_id', '=', $user_id)->where(function ($query) {$query->where('college_topic_section_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_topic_section_todolists.status', '=', 'active');})->orderBy('college_topic_section_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('college_topic_section_todolists.index')
                ->with('collegeTopicSectionTodolists', $collegeTopicSectionTodolists);
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
            return view('college_topic_section_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicSectionTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_topic_sections.id', $request -> c_t_s_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $collegeTopicSectionTodolist = $this->collegeTopicSectionTodolistRepository->create($input);
    
            DB::table('college_topic_section_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_t_id' => $collegeTopicSectionTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTopicSectionTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_todo_c', 'user_id' => $user_id, 'entity_id' => $collegeTopicSectionTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College Topic Section Todolist saved successfully.');
            return redirect(route('collegeTopicSections.show', [$collegeTopicSectionTodolist -> c_t_s_id]));
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
            
            DB::table('college_topic_section_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_t_id' => $id]);
            DB::table('college_topic_section_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $collegeTopicSectionTodolist = $this->collegeTopicSectionTodolistRepository->findWithoutFail($id);
            $collegeTopicSectionTodolistViews = DB::table('users')->join('college_topic_section_todolist_views', 'users.id', '=', 'college_topic_section_todolist_views.user_id')->where('c_t_s_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $collegeTopicSectionTodolistUpdates = DB::table('users')->join('college_topic_section_todolist_updates', 'users.id', '=', 'college_topic_section_todolist_updates.user_id')->where('c_t_s_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($collegeTopicSectionTodolist))
            {
                Flash::error('College Topic Section Todolist not found');
                return redirect(route('collegeTopicSectionTodolists.index'));
            }
    
            return view('college_topic_section_todolists.show')->with('collegeTopicSectionTodolist', $collegeTopicSectionTodolist)
                ->with('collegeTopicSectionTodolistViews', $collegeTopicSectionTodolistViews)
                ->with('collegeTopicSectionTodolistUpdates', $collegeTopicSectionTodolistUpdates);
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
            $collegeTopicSectionTodolist = $this->collegeTopicSectionTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolist))
            {
                Flash::error('College Topic Section Todolist not found');
                return redirect(route('collegeTopicSectionTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('college_topic_section_todolists.edit')->with('collegeTopicSectionTodolist', $collegeTopicSectionTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateCollegeTopicSectionTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_topic_section_todolists')->join('college_topic_sections', 'college_topic_section_todolists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('c_t_s_id', $request -> c_t_s_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTopicSectionTodolist = $this->collegeTopicSectionTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolist))
            {
                Flash::error('College Topic Section Todolist not found');
                return redirect(route('collegeTopicSectionTodolists.index'));
            }
    
            $newCollegeTopicSectionTodolist = $this->collegeTopicSectionTodolistRepository->update($request->all(), $id);
    
            DB::table('college_topic_section_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('college_topic_section_todolist_updates')->insert(['actual_name' => $newCollegeTopicSectionTodolist -> name, 'past_name' => $collegeTopicSectionTodolist -> name, 'datetime' => $now, 'c_t_s_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $collegeTopicSectionTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_todo_u', 'user_id' => $user_id, 'entity_id' => $collegeTopicSectionTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College Topic Section Todolist updated successfully.');
            return redirect(route('collegeTopicSections.show', [$collegeTopicSectionTodolist -> c_t_s_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_topic_section_todolists')->join('college_topic_sections', 'college_topic_section_todolists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_topic_section_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTopicSectionTodolist = $this->collegeTopicSectionTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionTodolist))
            {
                Flash::error('College Topic Section Todolist not found');
                return redirect(route('collegeTopicSectionTodolists.index'));
            }
    
            $this->collegeTopicSectionTodolistRepository->delete($id);
            
            DB::table('college_topic_section_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_t_id' => $collegeTopicSectionTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTopicSectionTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_todo_d', 'user_id' => $user_id, 'entity_id' => $collegeTopicSectionTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College Topic Section Todolist deleted successfully.');
            return redirect(route('collegeTopicSections.show', [$collegeTopicSectionTodolist -> c_t_s_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}