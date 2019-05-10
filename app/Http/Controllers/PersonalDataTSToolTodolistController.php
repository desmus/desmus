<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolTodolistRequest;
use App\Http\Requests\UpdatePersonalDataTSToolTodolistRequest;
use App\Repositories\PersonalDataTSToolTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolTodolistController extends AppBaseController
{
    private $personalDataTSToolTodolistRepository;

    public function __construct(PersonalDataTSToolTodolistRepository $personalDataTSToolTodolistRepo)
    {
        $this->personalDataTSToolTodolistRepository = $personalDataTSToolTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->personalDataTSToolTodolistRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolTodolists = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_tools', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_tools.personal_data_topic_section_id')->join('personal_data_t_s_t_todolists', 'personal_data_t_s_tools.id', '=', 'personal_data_t_s_t_todolists.p_d_t_s_t_id')->where('personal_datas.user_id', '=', $user_id)->where(function ($query) {$query->where('personal_data_t_s_t_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_t_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_t_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('personal_data_t_s_tool_todolists.index')
                ->with('personalDataTSToolTodolists', $personalDataTSToolTodolists);
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
            return view('personal_data_t_s_tool_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSToolTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_tools')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_t_s_tools.id', $request -> p_d_t_s_t_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $personalDataTSToolTodolist = $this->personalDataTSToolTodolistRepository->create($input);
            
            DB::table('personal_data_t_s_t_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_t_t_id' => $personalDataTSToolTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSToolTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_t_todo_c', 'user_id' => $user_id, 'entity_id' => $personalDataTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Tool Todolist saved successfully.');
            return redirect(route('personalDataTSTools.show', [$personalDataTSToolTodolist -> p_d_t_s_t_id]));
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
            
            DB::table('personal_data_t_s_t_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_t_t_id' => $id]);
            DB::table('personal_data_t_s_t_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $personalDataTSToolTodolist = $this->personalDataTSToolTodolistRepository->findWithoutFail($id);
            $personalDataTSToolTodolistViews = DB::table('users')->join('personal_data_t_s_t_todolist_views', 'users.id', '=', 'personal_data_t_s_t_todolist_views.user_id')->where('p_d_t_s_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $personalDataTSToolTodolistUpdates = DB::table('users')->join('personal_data_t_s_t_todolist_updates', 'users.id', '=', 'personal_data_t_s_t_todolist_updates.user_id')->where('p_d_t_s_t_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($personalDataTSToolTodolist))
            {
                Flash::error('PersonalData T S Tool Todolist not found');
                return redirect(route('personalDataTSToolTodolists.index'));
            }
    
            return view('personal_data_t_s_tool_todolists.show')
                ->with('personalDataTSToolTodolist', $personalDataTSToolTodolist)
                ->with('personalDataTSToolTodolistViews', $personalDataTSToolTodolistViews)
                ->with('personalDataTSToolTodolistUpdates', $personalDataTSToolTodolistUpdates);
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
            $personalDataTSToolTodolist = $this->personalDataTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolist))
            {
                Flash::error('PersonalData T S Tool Todolist not found');
                return redirect(route('personalDataTSToolTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('personal_data_t_s_tool_todolists.edit')->with('personalDataTSToolTodolist', $personalDataTSToolTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdatePersonalDataTSToolTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_t_todolists')->join('personal_data_t_s_tools', 'personal_data_t_s_t_todolists.p_d_t_s_t_id', '=', 'personal_data_t_s_tools.id')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('p_d_t_s_t_id', $request -> p_d_t_s_t_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSToolTodolist = $this->personalDataTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolist))
            {
                Flash::error('PersonalData T S Tool Todolist not found');
                return redirect(route('personalDataTSToolTodolists.index'));
            }
    
            $newPersonalDataTSToolTodolist = $this->personalDataTSToolTodolistRepository->update($request->all(), $id);
    
            DB::table('personal_data_t_s_t_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('personal_data_t_s_t_todolist_updates')->insert(['actual_name' => $newPersonalDataTSToolTodolist -> name, 'past_name' => $personalDataTSToolTodolist -> name, 'datetime' => $now, 'p_d_t_s_t_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSToolTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_t_todo_u', 'user_id' => $user_id, 'entity_id' => $personalDataTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Tool Todolist updated successfully.');
            return redirect(route('personalDataTSTools.show', [$personalDataTSToolTodolist -> p_d_t_s_t_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_t_todolists')->join('personal_data_t_s_tools', 'personal_data_t_s_t_todolists.p_d_t_s_t_id', '=', 'personal_data_t_s_tools.id')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_t_s_t_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSToolTodolist = $this->personalDataTSToolTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolTodolist))
            {
                Flash::error('PersonalData T S Tool Todolist not found');
                return redirect(route('personalDataTSToolTodolists.index'));
            }
    
            $this->personalDataTSToolTodolistRepository->delete($id);
            
            DB::table('personal_data_t_s_t_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_t_t_id' => $personalDataTSToolTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSToolTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_t_todo_d', 'user_id' => $user_id, 'entity_id' => $personalDataTSToolTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Tool Todolist deleted successfully.');
            return redirect(route('personalDataTSTools.show', [$personalDataTSToolTodolist -> p_d_t_s_t_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}