<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTodolistRequest;
use App\Http\Requests\UpdateCollegeTodolistRequest;
use App\Repositories\CollegeTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTodolistController extends AppBaseController
{
    private $collegeTodolistRepository;

    public function __construct(CollegeTodolistRepository $collegeTodolistRepo)
    {
        $this->collegeTodolistRepository = $collegeTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->collegeTodolistRepository->pushCriteria(new RequestCriteria($request));
            $collegeTodolists = DB::table('users')->join('colleges', 'users.id', '=', 'colleges.user_id')->join('college_todolists', 'colleges.id', '=', 'college_todolists.college_id')->where('user_id', $user_id)->where(function ($query) {$query->where('college_todolists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->limit(50)->get();
            
            return view('college_todolists.index')
                ->with('collegeTodolists', $collegeTodolists);
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
            return view('college_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('colleges')->join('users', 'colleges.user_id', '=', 'users.id')->where('colleges.id', $request -> college_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $collegeTodolist = $this->collegeTodolistRepository->create($input);
            
            DB::table('college_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_id' => $collegeTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTodolist -> name, 'status' => 'active', 'type' => 'c_todo_c', 'user_id' => $user_id, 'entity_id' => $collegeTodolist -> id, 'created_at' => $now]);
            
            Flash::success('College Todolist saved successfully.');
            return redirect(route('colleges.show', [$collegeTodolist -> college_id]));
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
            
            DB::table('college_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_id' => $id]);
            DB::table('college_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $collegeTodolist = $this->collegeTodolistRepository->findWithoutFail($id);
            $collegeTodolistViews = DB::table('users')->join('college_todolist_views', 'users.id', '=', 'college_todolist_views.user_id')->where('c_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $collegeTodolistUpdates = DB::table('users')->join('college_todolist_updates', 'users.id', '=', 'college_todolist_updates.user_id')->where('c_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($collegeTodolist))
            {
                Flash::error('College Todolist not found');
                return redirect(route('collegeTodolists.index'));
            }
    
            return view('college_todolists.show')
                ->with('collegeTodolist', $collegeTodolist)
                ->with('collegeTodolistViews', $collegeTodolistViews)
                ->with('collegeTodolistUpdates', $collegeTodolistUpdates);
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
            $collegeTodolist = $this->collegeTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTodolist))
            {
                Flash::error('College Todolist not found');
                return redirect(route('collegeTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('college_todolists.edit')
                ->with('collegeTodolist', $collegeTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateCollegeTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_todolists')->join('colleges', 'college_todolists.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_id', $request -> college_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTodolist = $this->collegeTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTodolist))
            {
                Flash::error('College Todolist not found');
                return redirect(route('collegeTodolists.index'));
            }
    
            $newCollegeTodolist = $this->collegeTodolistRepository->update($request->all(), $id);
            
            DB::table('college_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('college_todolist_updates')->insert(['actual_name' => $newCollegeTodolist -> name, 'past_name' => $collegeTodolist -> name, 'datetime' => $now, 'c_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $collegeTodolist -> name, 'status' => 'active', 'type' => 'c_todo_u', 'user_id' => $user_id, 'entity_id' => $collegeTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College Todolist updated successfully.');
            return redirect(route('colleges.show', [$collegeTodolist -> college_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('college_todolists')->join('colleges', 'college_todolists.college_id', '=', 'colleges.id')->join('users', 'colleges.user_id', '=', 'users.id')->where('college_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $collegeTodolist = $this->collegeTodolistRepository->findWithoutFail($id);
    
            if(empty($collegeTodolist))
            {
                Flash::error('College Todolist not found');
                return redirect(route('collegeTodolists.index'));
            }
    
            $this->collegeTodolistRepository->delete($id);
            
            DB::table('college_todolist_deletes')->insert(['datetime' => $now, 'c_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $collegeTodolist -> name, 'status' => 'active', 'type' => 'c_todo_d', 'user_id' => $user_id, 'entity_id' => $collegeTodolist -> id, 'created_at' => $now]);
    
            Flash::success('College Todolist deleted successfully.');
            return redirect(route('colleges.show', [$collegeTodolist -> college_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}