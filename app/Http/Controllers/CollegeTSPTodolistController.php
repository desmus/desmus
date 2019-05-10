<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPTodolistRequest;
use App\Http\Requests\UpdateCollegeTSPTodolistRequest;
use App\Repositories\CollegeTSPTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPTodolistController extends AppBaseController
{
    private $collegeTSPTodolistRepository;

    public function __construct(CollegeTSPTodolistRepository $collegeTSPTodolistRepo)
    {
        $this->collegeTSPTodolistRepository = $collegeTSPTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->collegeTSPTodolistRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPTodolists = $this->collegeTSPTodolistRepository->all();
            $collegeTSPTodolists = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_playlists', 'college_topic_sections.id', '=', 'college_t_s_playlists.c_t_s_id')->join('college_t_s_p_todolists', 'college_t_s_playlists.id', '=', 'college_t_s_p_todolists.c_t_s_p_id')->where('colleges.user_id', '=', $user_id)->where(function ($query) {$query->where('college_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_p_todolists.status', '=', 'active');})->orderBy('college_t_s_p_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('college_t_s_p_todolists.index')
                ->with('collegeTSPTodolists', $collegeTSPTodolists);
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
            return view('college_t_s_p_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_playlists')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_t_s_playlists.id', $request -> c_t_s_p_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $collegeTSPTodolist = $this->collegeTSPTodolistRepository->create($input);
    
            DB::table('college_t_s_p_t_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_p_t_id' => $collegeTSPTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSPTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_p_t_c', 'user_id' => $user_id, 'entity_id' => $collegeTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S P Todolist saved successfully.');
            return redirect(route('collegeTSPlaylists.show', [$collegeTSPTodolist -> c_t_s_p_id]));
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
            
            DB::table('college_t_s_p_t_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_p_t_id' => $id]);
            DB::table('college_t_s_p_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $collegeTSPTodolist = $this->collegeTSPTodolistRepository->findWithoutFail($id);
            $collegeTSPTViews = DB::table('users')->join('college_t_s_p_t_views', 'users.id', '=', 'college_t_s_p_t_views.user_id')->where('c_t_s_p_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $collegeTSPTUpdates = DB::table('users')->join('college_t_s_p_t_updates', 'users.id', '=', 'college_t_s_p_t_updates.user_id')->where('c_t_s_p_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($collegeTSPTodolist))
            {
                Flash::error('College T S P Todolist not found');
                return redirect(route('collegeTSPTodolists.index'));
            }
    
            return view('college_t_s_p_todolists.show')
                ->with('collegeTSPTodolist', $collegeTSPTodolist)
                ->with('collegeTSPTViews', $collegeTSPTViews)
                ->with('collegeTSPTUpdates', $collegeTSPTUpdates);
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
            $collegeTSPTodolist = $this->collegeTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTodolist))
            {
                Flash::error('College T S P Todolist not found');
                return redirect(route('collegeTSPTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('college_t_s_p_todolists.edit')
                ->with('collegeTSPTodolist', $collegeTSPTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateCollegeTSPTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_p_todolists')->join('college_t_s_playlists', 'college_t_s_p_todolists.c_t_s_p_id', '=', 'college_t_s_playlists.id')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('c_t_s_p_id', $request -> c_t_s_p_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTSPTodolist = $this->collegeTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTodolist))
            {
                Flash::error('College T S P Todolist not found');
                return redirect(route('collegeTSPTodolists.index'));
            }
            
            $newCollegeTSPTodolist = $this->collegeTSPTodolistRepository->update($request->all(), $id);
    
            DB::table('college_t_s_p_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('college_t_s_p_t_updates')->insert(['actual_name' => $newCollegeTSPTodolist -> name, 'past_name' => $collegeTSPTodolist -> name, 'datetime' => $now, 'c_t_s_p_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSPTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_p_t_u', 'user_id' => $user_id, 'entity_id' => $collegeTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S P Todolist updated successfully.');
            return redirect(route('collegeTSPlaylists.show', [$collegeTSPTodolist -> c_t_s_p_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_t_s_p_todolists')->join('college_t_s_playlists', 'college_t_s_p_todolists.c_t_s_p_id', '=', 'college_t_s_playlists.id')->join('college_topic_sections', 'college_t_s_playlists.c_t_s_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_t_s_p_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTSPTodolist = $this->collegeTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTodolist))
            {
                Flash::error('College T S P Todolist not found');
                return redirect(route('collegeTSPTodolists.index'));
            }
    
            $this->collegeTSPTodolistRepository->delete($id);
            
            DB::table('college_t_s_p_t_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_p_t_id' => $collegeTSPTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSPTodolist -> name, 'status' => 'active', 'type' => 'c_t_s_p_t_d', 'user_id' => $user_id, 'entity_id' => $collegeTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College T S P Todolist deleted successfully.');
            return redirect(route('collegeTSPlaylists.show', [$collegeTSPTodolist -> c_t_s_p_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}