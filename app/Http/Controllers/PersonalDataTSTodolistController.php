<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSTodolistRequest;
use App\Http\Requests\UpdatePersonalDataTSTodolistRequest;
use App\Repositories\PersonalDataTSTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSTodolistController extends AppBaseController
{
    private $personalDataTSTodolistRepository;

    public function __construct(PersonalDataTSTodolistRepository $personalDataTSTodolistRepo)
    {
        $this->personalDataTSTodolistRepository = $personalDataTSTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->personalDataTSTodolistRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSTodolists = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_todolists', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_todolists.p_d_t_s_id')->where('personal_datas.user_id', '=', $user_id)->where(function ($query) {$query->where('personal_data_t_s_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('personal_data_t_s_todolists.index')
                ->with('personalDataTSTodolists', $personalDataTSTodolists);
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
            return view('personal_data_t_s_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_topic_sections')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_topic_sections.id', $request -> p_d_t_s_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $personalDataTSTodolist = $this->personalDataTSTodolistRepository->create($input);
    
            DB::table('personal_data_t_s_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_t_id' => $personalDataTSTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_todo_c', 'user_id' => $user_id, 'entity_id' => $personalDataTSTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData Topic Section Todolist saved successfully.');
            return redirect(route('personalDataTopicSections.show', [$personalDataTSTodolist -> p_d_t_s_id]));
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
            
            DB::table('personal_data_t_s_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_t_id' => $id]);
            DB::table('personal_data_t_s_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $personalDataTSTodolist = $this->personalDataTSTodolistRepository->findWithoutFail($id);
            $personalDataTSTodolistViews = DB::table('users')->join('personal_data_t_s_todolist_views', 'users.id', '=', 'personal_data_t_s_todolist_views.user_id')->where('p_d_t_s_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $personalDataTSTodolistUpdates = DB::table('users')->join('personal_data_t_s_todolist_updates', 'users.id', '=', 'personal_data_t_s_todolist_updates.user_id')->where('p_d_t_s_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($personalDataTSTodolist))
            {
                Flash::error('PersonalData Topic Section Todolist not found');
                return redirect(route('personalDataTSTodolists.index'));
            }
    
            return view('personal_data_t_s_todolists.show')->with('personalDataTSTodolist', $personalDataTSTodolist)
                ->with('personalDataTSTodolistViews', $personalDataTSTodolistViews)
                ->with('personalDataTSTodolistUpdates', $personalDataTSTodolistUpdates);
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
            $personalDataTSTodolist = $this->personalDataTSTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolist))
            {
                Flash::error('PersonalData Topic Section Todolist not found');
                return redirect(route('personalDataTSTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('personal_data_t_s_todolists.edit')
                ->with('personalDataTSTodolist', $personalDataTSTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdatePersonalDataTSTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_todolists')->join('personal_data_topic_sections', 'personal_data_t_s_todolists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('p_d_t_s_id', $request -> p_d_t_s_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSTodolist = $this->personalDataTSTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolist))
            {
                Flash::error('PersonalData Topic Section Todolist not found');
                return redirect(route('personalDataTSTodolists.index'));
            }
    
            $newPersonalDataTSTodolist = $this->personalDataTSTodolistRepository->update($request->all(), $id);
    
            DB::table('personal_data_t_s_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('personal_data_t_s_todolist_updates')->insert(['actual_name' => $newPersonalDataTSTodolist -> name, 'past_name' => $personalDataTSTodolist -> name, 'datetime' => $now, 'p_d_t_s_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_todo_u', 'user_id' => $user_id, 'entity_id' => $personalDataTSTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData Topic Section Todolist updated successfully.');
            return redirect(route('personalDataTopicSections.show', [$personalDataTSTodolist -> p_d_t_s_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_todolists')->join('personal_data_topic_sections', 'personal_data_t_s_todolists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_t_s_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSTodolist = $this->personalDataTSTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTodolist))
            {
                Flash::error('PersonalData Topic Section Todolist not found');
                return redirect(route('personalDataTSTodolists.index'));
            }
    
            $this->personalDataTSTodolistRepository->delete($id);
            
            DB::table('personal_data_t_s_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_t_id' => $personalDataTSTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_todo_d', 'user_id' => $user_id, 'entity_id' => $personalDataTSTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData Topic Section Todolist deleted successfully.');
            return redirect(route('personalDataTopicSections.show', [$personalDataTSTodolist -> p_d_t_s_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}