<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryTodolistRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryTodolistRequest;
use App\Repositories\PersonalDataTSGaleryTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryTodolistController extends AppBaseController
{
    private $personalDataTSGaleryTodolistRepository;

    public function __construct(PersonalDataTSGaleryTodolistRepository $personalDataTSGaleryTodolistRepo)
    {
        $this->personalDataTSGaleryTodolistRepository = $personalDataTSGaleryTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->personalDataTSGaleryTodolistRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryTodolists = $this->personalDataTSGaleryTodolistRepository->all();
            $personalDataTSGaleryTodolists = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_galeries', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_galeries.personal_data_t_s_id')->join('personal_data_t_s_g_todolists', 'personal_data_t_s_galeries.id', '=', 'personal_data_t_s_g_todolists.p_d_t_s_g_id')->where('personal_datas.user_id', '=', $user_id)->where(function ($query) {$query->where('personal_data_t_s_g_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_g_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_g_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('personal_data_t_s_galery_todolists.index')
                ->with('personalDataTSGaleryTodolists', $personalDataTSGaleryTodolists);
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
            return view('personal_data_t_s_galery_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSGaleryTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_galeries')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_t_s_galeries.id', $request -> p_d_t_s_g_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $personalDataTSGaleryTodolist = $this->personalDataTSGaleryTodolistRepository->create($input);
    
            DB::table('personal_data_t_s_g_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_g_t_id' => $personalDataTSGaleryTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_g_todo_c', 'user_id' => $user_id, 'entity_id' => $personalDataTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Galery Todolist saved successfully.');
            return redirect(route('personalDataTSGaleries.show', [$personalDataTSGaleryTodolist -> p_d_t_s_g_id]));
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
            
            DB::table('personal_data_t_s_g_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_g_t_id' => $id]);
            DB::table('personal_data_t_s_g_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $personalDataTSGaleryTodolist = $this->personalDataTSGaleryTodolistRepository->findWithoutFail($id);
            $personalDataTSGaleryTodolistViews = DB::table('users')->join('personal_data_t_s_g_todolist_views', 'users.id', '=', 'personal_data_t_s_g_todolist_views.user_id')->where('p_d_t_s_g_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $personalDataTSGaleryTodolistUpdates = DB::table('users')->join('personal_data_t_s_g_todolist_updates', 'users.id', '=', 'personal_data_t_s_g_todolist_updates.user_id')->where('p_d_t_s_g_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($personalDataTSGaleryTodolist))
            {
                Flash::error('PersonalData T S Galery Todolist not found');
                return redirect(route('personalDataTSGaleryTodolists.index'));
            }
    
            return view('personal_data_t_s_galery_todolists.show')->with('personalDataTSGaleryTodolist', $personalDataTSGaleryTodolist)
                ->with('personalDataTSGaleryTodolistViews', $personalDataTSGaleryTodolistViews)
                ->with('personalDataTSGaleryTodolistUpdates', $personalDataTSGaleryTodolistUpdates);
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
            $personalDataTSGaleryTodolist = $this->personalDataTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolist))
            {
                Flash::error('PersonalData T S Galery Todolist not found');
                return redirect(route('personalDataTSGaleryTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('personal_data_t_s_galery_todolists.edit')
                ->with('personalDataTSGaleryTodolist', $personalDataTSGaleryTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdatePersonalDataTSGaleryTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_g_todolists')->join('personal_data_t_s_galeries', 'personal_data_t_s_g_todolists.p_d_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('p_d_t_s_g_id', $request -> p_d_t_s_g_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSGaleryTodolist = $this->personalDataTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolist))
            {
                Flash::error('PersonalData T S Galery Todolist not found');
                return redirect(route('personalDataTSGaleryTodolists.index'));
            }
    
            $newPersonalDataTSGaleryTodolist = $this->personalDataTSGaleryTodolistRepository->update($request->all(), $id);
    
            DB::table('personal_data_t_s_g_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('personal_data_t_s_g_todolist_updates')->insert(['actual_name' => $newPersonalDataTSGaleryTodolist -> name, 'past_name' => $personalDataTSGaleryTodolist -> name, 'datetime' => $now, 'p_d_t_s_g_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_g_todo_u', 'user_id' => $user_id, 'entity_id' => $personalDataTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Galery Todolist updated successfully.');
            return redirect(route('personalDataTSGaleries.show', [$personalDataTSGaleryTodolist -> p_d_t_s_g_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_g_todolists')->join('personal_data_t_s_galeries', 'personal_data_t_s_g_todolists.p_d_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_t_s_g_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSGaleryTodolist = $this->personalDataTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryTodolist))
            {
                Flash::error('PersonalData T S Galery Todolist not found');
                return redirect(route('personalDataTSGaleryTodolists.index'));
            }
    
            $this->personalDataTSGaleryTodolistRepository->delete($id);
           
            DB::table('personal_data_t_s_g_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_g_t_id' => $personalDataTSGaleryTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_g_todo_d', 'user_id' => $user_id, 'entity_id' => $personalDataTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Galery Todolist deleted successfully.');
            return redirect(route('personalDataTSGaleries.show', [$personalDataTSGaleryTodolist -> p_d_t_s_g_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}