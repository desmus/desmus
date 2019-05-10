<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSPTodolistRequest;
use App\Http\Requests\UpdatePersonalDataTSPTodolistRequest;
use App\Repositories\PersonalDataTSPTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSPTodolistController extends AppBaseController
{
    private $personalDataTSPTodolistRepository;

    public function __construct(PersonalDataTSPTodolistRepository $personalDataTSPTodolistRepo)
    {
        $this->personalDataTSPTodolistRepository = $personalDataTSPTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->personalDataTSPTodolistRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSPTodolists = DB::table('personalDatas')->join('personal_data_topics', 'personalDatas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_playlists', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_playlists.p_d_t_s_id')->join('personal_data_t_s_p_todolists', 'personal_data_t_s_playlists.id', '=', 'personal_data_t_s_p_todolists.p_d_t_s_p_id')->where('personalDatas.user_id', '=', $user_id)->where(function ($query) {$query->where('personal_data_t_s_p_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_p_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_p_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('personal_data_t_s_p_todolists.index')
                ->with('personalDataTSPTodolists', $personalDataTSPTodolists);
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
            return view('personal_data_t_s_p_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSPTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_playlists')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_t_s_playlists.id', $request -> p_d_t_s_p_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $personalDataTSPTodolist = $this->personalDataTSPTodolistRepository->create($input);
    
            DB::table('personal_data_t_s_p_t_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_p_t_id' => $personalDataTSPTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSPTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_p_t_c', 'user_id' => $user_id, 'entity_id' => $personalDataTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S P Todolist saved successfully.');
            return redirect(route('personalDataTSPlaylists.show', [$personalDataTSPTodolist -> p_d_t_s_p_id]));
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
            
            DB::table('personal_data_t_s_p_t_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_p_t_id' => $id]);
            DB::table('personal_data_t_s_p_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
            
            $personalDataTSPTodolist = $this->personalDataTSPTodolistRepository->findWithoutFail($id);
            $personalDataTSPTViews = DB::table('users')->join('personal_data_t_s_p_t_views', 'users.id', '=', 'personal_data_t_s_p_t_views.user_id')->where('p_d_t_s_p_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $personalDataTSPTUpdates = DB::table('users')->join('personal_data_t_s_p_t_updates', 'users.id', '=', 'personal_data_t_s_p_t_updates.user_id')->where('p_d_t_s_p_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($personalDataTSPTodolist))
            {
                Flash::error('PersonalData T S P Todolist not found');
                return redirect(route('personalDataTSPTodolists.index'));
            }
    
            return view('personal_data_t_s_p_todolists.show')
                ->with('personalDataTSPTodolist', $personalDataTSPTodolist)
                ->with('personalDataTSPTViews', $personalDataTSPTViews)
                ->with('personalDataTSPTUpdates', $personalDataTSPTUpdates);
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
            $personalDataTSPTodolist = $this->personalDataTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTodolist))
            {
                Flash::error('PersonalData T S P Todolist not found');
                return redirect(route('personalDataTSPTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('personal_data_t_s_p_todolists.edit')
                ->with('personalDataTSPTodolist', $personalDataTSPTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function update($id, UpdatePersonalDataTSPTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_p_todolists')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_todolists.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('p_d_t_s_p_id', $request -> p_d_t_s_p_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSPTodolist = $this->personalDataTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTodolist))
            {
                Flash::error('PersonalData T S P Todolist not found');
                return redirect(route('personalDataTSPTodolists.index'));
            }
            
            $newPersonalDataTSPTodolist = $this->personalDataTSPTodolistRepository->update($request->all(), $id);
    
            DB::table('personal_data_t_s_p_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('personal_data_t_s_p_t_updates')->insert(['actual_name' => $newPersonalDataTSPTodolist -> name, 'past_name' => $personalDataTSPTodolist -> name, 'datetime' => $now, 'p_d_t_s_p_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSPTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_p_t_u', 'user_id' => $user_id, 'entity_id' => $personalDataTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S P Todolist updated successfully.');
            return redirect(route('personalDataTSPlaylists.show', [$personalDataTSPTodolist -> p_d_t_s_p_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('personal_data_t_s_p_todolists')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_todolists.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'personal_datas.user_id', '=', 'users.id')->where('personal_data_t_s_p_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSPTodolist = $this->personalDataTSPTodolistRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTodolist))
            {
                Flash::error('PersonalData T S P Todolist not found');
                return redirect(route('personalDataTSPTodolists.index'));
            }
    
            $this->personalDataTSPTodolistRepository->delete($id);
            
            DB::table('personal_data_t_s_p_t_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_p_t_id' => $personalDataTSPTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSPTodolist -> name, 'status' => 'active', 'type' => 'p_d_t_s_p_t_d', 'user_id' => $user_id, 'entity_id' => $personalDataTSPTodolist -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S P Todolist deleted successfully.');
            return redirect(route('personalDataTSPlaylists.show', [$personalDataTSPTodolist -> p_d_t_s_p_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}