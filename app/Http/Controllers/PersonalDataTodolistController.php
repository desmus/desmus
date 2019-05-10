<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTodolistRequest;
use App\Http\Requests\UpdatePersonalDataTodolistRequest;
use App\Repositories\PersonalDataTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTodolistController extends AppBaseController
{
    private $personalDataTodolistRepository;

    public function __construct(PersonalDataTodolistRepository $personalDataTodolistRepo)
    {
        $this->personalDataTodolistRepository = $personalDataTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->personalDataTodolistRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTodolists = DB::table('users')->join('personal_datas', 'users.id', '=', 'personal_datas.user_id')->join('personal_data_todolists', 'personal_datas.id', '=', 'personal_data_todolists.personal_data_id')->where('user_id', $user_id)->where(function ($query) {$query->where('personal_data_todolists.deleted_at', '=', null);})->orderBy('datetime', 'desc')->limit(50)->get();
            
            return view('personal_data_todolists.index')
                ->with('personalDataTodolists', $personalDataTodolists);
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
            return view('personal_data_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_datas')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_datas.id', $request -> personal_data_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $personalDataTodolist = $this->personalDataTodolistRepository->create($input);
            
            DB::table('personal_data_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_id' => $personalDataTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTodolist -> name, 'status' => 'active', 'type' => 'p_d_todo_c', 'user_id' => $user_id, 'entity_id' => $personalDataTodolist -> id, 'created_at' => $now]);
            
            Flash::success('PersonalData Todolist saved successfully.');
            return redirect(route('personalDatas.show', [$personalDataTodolist -> personal_data_id]));
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
            
            DB::table('personal_data_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_id' => $id]);
            DB::table('personal_data_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $personalDataTodolist = $this->personalDataTodolistRepository->findWithoutFail($id);
            $personalDataTodolistViews = DB::table('users')->join('personal_data_todolist_views', 'users.id', '=', 'personal_data_todolist_views.user_id')->where('p_d_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $personalDataTodolistUpdates = DB::table('users')->join('personal_data_todolist_updates', 'users.id', '=', 'personal_data_todolist_updates.user_id')->where('p_d_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($personalDataTodolist))
            {
                Flash::error('PersonalData Todolist not found');
                return redirect(route('personalDataTodolists.index'));
            }
    
            return view('personal_data_todolists.show')
                ->with('personalDataTodolist', $personalDataTodolist)
                ->with('personalDataTodolistViews', $personalDataTodolistViews)
                ->with('personalDataTodolistUpdates', $personalDataTodolistUpdates);
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
            $personalDataTodolist = $this->personalDataTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolist))
            {
                Flash::error('PersonalData Todolist not found');
                return redirect(route('personalDataTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('personal_data_todolists.edit')
                ->with('personalDataTodolist', $personalDataTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdatePersonalDataTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_todolists')->join('personal_datas', 'personal_data_todolists.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_id', $request -> personal_data_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTodolist = $this->personalDataTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolist))
            {
                Flash::error('PersonalData Todolist not found');
                return redirect(route('personalDataTodolists.index'));
            }
    
            $newPersonalDataTodolist = $this->personalDataTodolistRepository->update($request->all(), $id);
            
            DB::table('personal_data_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('personal_data_todolist_updates')->insert(['actual_name' => $newPersonalDataTodolist -> name, 'past_name' => $personalDataTodolist -> name, 'datetime' => $now, 'p_d_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTodolist -> name, 'status' => 'active', 'type' => 'p_d_todo_u', 'user_id' => $user_id, 'entity_id' => $personalDataTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData Todolist updated successfully.');
            return redirect(route('personalDatas.show', [$personalDataTodolist -> personal_data_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_todolists')->join('personal_datas', 'personal_data_todolists.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTodolist = $this->personalDataTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTodolist))
            {
                Flash::error('PersonalData Todolist not found');
                return redirect(route('personalDataTodolists.index'));
            }
    
            $this->personalDataTodolistRepository->delete($id);
            
            DB::table('personal_data_todolist_deletes')->insert(['datetime' => $now, 'p_d_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTodolist -> name, 'status' => 'active', 'type' => 'p_d_todo_d', 'user_id' => $user_id, 'entity_id' => $personalDataTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData Todolist deleted successfully.');
            return redirect(route('personalDatas.show', [$personalDataTodolist -> personal_data_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}