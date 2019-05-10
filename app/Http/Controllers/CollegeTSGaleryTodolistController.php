<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryTodolistRequest;
use App\Http\Requests\UpdateCollegeTSGaleryTodolistRequest;
use App\Repositories\CollegeTSGaleryTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryTodolistController extends AppBaseController
{
    private $collegeTSGaleryTodolistRepository;

    public function __construct(CollegeTSGaleryTodolistRepository $collegeTSGaleryTodolistRepo)
    {
        $this->collegeTSGaleryTodolistRepository = $collegeTSGaleryTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->collegeTSGaleryTodolistRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryTodolists = $this->collegeTSGaleryTodolistRepository->all();
            $collegeTSGaleryTodolists = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_galeries', 'college_topic_sections.id', '=', 'college_t_s_galeries.college_topic_section_id')->join('college_t_s_galery_todolists', 'college_t_s_galeries.id', '=', 'college_t_s_galery_todolists.c_t_s_g_id')->where('colleges.user_id', '=', $user_id)->where(function ($query) {$query->where('college_t_s_galery_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_galery_todolists.status', '=', 'active');})->orderBy('college_t_s_galery_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('college_t_s_galery_todolists.index')
                ->with('collegeTSGaleryTodolists', $collegeTSGaleryTodolists);
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
            return view('college_t_s_galery_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_t_s_galeries.id', $request -> c_t_s_g_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $collegeTSGaleryTodolist = $this->collegeTSGaleryTodolistRepository->create($input);
    
            DB::table('college_t_s_galery_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_g_t_id' => $collegeTSGaleryTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_g_todo_c', 'user_id' => $user_id, 'entity_id' => $collegeTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S Galery Todolist saved successfully.');
            return redirect(route('collegeTSGaleries.show', [$collegeTSGaleryTodolist -> c_t_s_g_id]));
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
            
            DB::table('college_t_s_galery_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_g_t_id' => $id]);
            DB::table('college_t_s_galery_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $collegeTSGaleryTodolist = $this->collegeTSGaleryTodolistRepository->findWithoutFail($id);
            $collegeTSGaleryTodolistViews = DB::table('users')->join('college_t_s_galery_todolist_views', 'users.id', '=', 'college_t_s_galery_todolist_views.user_id')->where('c_t_s_g_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $collegeTSGaleryTodolistUpdates = DB::table('users')->join('college_t_s_galery_todolist_updates', 'users.id', '=', 'college_t_s_galery_todolist_updates.user_id')->where('c_t_s_g_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($collegeTSGaleryTodolist))
            {
                Flash::error('College T S Galery Todolist not found');
                return redirect(route('collegeTSGaleryTodolists.index'));
            }
    
            return view('college_t_s_galery_todolists.show')->with('collegeTSGaleryTodolist', $collegeTSGaleryTodolist)
                ->with('collegeTSGaleryTodolistViews', $collegeTSGaleryTodolistViews)
                ->with('collegeTSGaleryTodolistUpdates', $collegeTSGaleryTodolistUpdates);
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
            $collegeTSGaleryTodolist = $this->collegeTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolist))
            {
                Flash::error('College T S Galery Todolist not found');
                return redirect(route('collegeTSGaleryTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('college_t_s_galery_todolists.edit')
                ->with('collegeTSGaleryTodolist', $collegeTSGaleryTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateCollegeTSGaleryTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_galery_todolists')->join('college_t_s_galeries', 'college_t_s_galery_todolists.c_t_s_g_id', '=', 'college_t_s_galeries.id')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('c_t_s_g_id', $request -> c_t_s_g_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTSGaleryTodolist = $this->collegeTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolist))
            {
                Flash::error('College T S Galery Todolist not found');
                return redirect(route('collegeTSGaleryTodolists.index'));
            }
    
            $newCollegeTSGaleryTodolist = $this->collegeTSGaleryTodolistRepository->update($request->all(), $id);
    
            DB::table('college_t_s_galery_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('college_t_s_galery_todolist_updates')->insert(['actual_name' => $newCollegeTSGaleryTodolist -> name, 'past_name' => $collegeTSGaleryTodolist -> name, 'datetime' => $now, 'c_t_s_g_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_g_todo_u', 'user_id' => $user_id, 'entity_id' => $collegeTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S Galery Todolist updated successfully.');
            return redirect(route('collegeTSGaleries.show', [$collegeTSGaleryTodolist -> c_t_s_g_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_galery_todolists')->join('college_t_s_galeries', 'college_t_s_galery_todolists.c_t_s_g_id', '=', 'college_t_s_galeries.id')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_t_s_galery_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTSGaleryTodolist = $this->collegeTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolist))
            {
                Flash::error('College T S Galery Todolist not found');
                return redirect(route('collegeTSGaleryTodolists.index'));
            }
    
            $this->collegeTSGaleryTodolistRepository->delete($id);
           
            DB::table('college_t_s_galery_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_g_t_id' => $collegeTSGaleryTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_g_todo_d', 'user_id' => $user_id, 'entity_id' => $collegeTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S Galery Todolist deleted successfully.');
            return redirect(route('collegeTSGaleries.show', [$collegeTSGaleryTodolist -> c_t_s_g_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}