<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSGaleryTodolistRequest;
use App\Http\Requests\UpdateProjectTSGaleryTodolistRequest;
use App\Repositories\ProjectTSGaleryTodolistRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSGaleryTodolistController extends AppBaseController
{
    private $projectTSGaleryTodolistRepository;

    public function __construct(ProjectTSGaleryTodolistRepository $projectTSGaleryTodolistRepo)
    {
        $this->projectTSGaleryTodolistRepository = $projectTSGaleryTodolistRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user_id = Auth::user()->id;
            $this->projectTSGaleryTodolistRepository->pushCriteria(new RequestCriteria($request));
            $projectTSGaleryTodolists = $this->projectTSGaleryTodolistRepository->all();
            $projectTSGaleryTodolists = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_galeries', 'project_topic_sections.id', '=', 'project_t_s_galeries.project_topic_section_id')->join('project_t_s_galery_todolists', 'project_t_s_galeries.id', '=', 'project_t_s_galery_todolists.p_t_s_g_id')->where('projects.user_id', '=', $user_id)->where(function ($query) {$query->where('project_t_s_galery_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_t_s_galery_todolists.status', '=', 'active');})->orderBy('project_t_s_galery_todolists.datetime', 'desc')->limit(50)->get();
    
            return view('project_t_s_galery_todolists.index')
                ->with('projectTSGaleryTodolists', $projectTSGaleryTodolists);
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
            return view('project_t_s_galery_todolists.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSGaleryTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_galeries')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_t_s_galeries.id', $request -> p_t_s_g_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $input = $request->all();
            $projectTSGaleryTodolist = $this->projectTSGaleryTodolistRepository->create($input);
    
            DB::table('project_t_s_galery_todolist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_g_t_id' => $projectTSGaleryTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_g_todo_c', 'user_id' => $user_id, 'entity_id' => $projectTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S Galery Todolist saved successfully.');
            return redirect(route('projectTSGaleries.show', [$projectTSGaleryTodolist -> p_t_s_g_id]));
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
            
            DB::table('project_t_s_galery_todolist_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_g_t_id' => $id]);
            DB::table('project_t_s_galery_todolists')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
    
            $projectTSGaleryTodolist = $this->projectTSGaleryTodolistRepository->findWithoutFail($id);        
            $projectTSGaleryTodolistViews = DB::table('users')->join('project_t_s_galery_todolist_views', 'users.id', '=', 'project_t_s_galery_todolist_views.user_id')->where('p_t_s_g_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            $projectTSGaleryTodolistUpdates = DB::table('users')->join('project_t_s_galery_todolist_updates', 'users.id', '=', 'project_t_s_galery_todolist_updates.user_id')->where('p_t_s_g_t_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
            if(empty($projectTSGaleryTodolist))
            {
                Flash::error('Project T S Galery Todolist not found');
                return redirect(route('projectTSGaleryTodolists.index'));
            }

            return view('project_t_s_galery_todolists.show')->with('projectTSGaleryTodolist', $projectTSGaleryTodolist)
                ->with('projectTSGaleryTodolistViews', $projectTSGaleryTodolistViews)
                ->with('projectTSGaleryTodolistUpdates', $projectTSGaleryTodolistUpdates);
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
            $projectTSGaleryTodolist = $this->projectTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolist))
            {
                Flash::error('Project T S Galery Todolist not found');
                return redirect(route('projectTSGaleryTodolists.index'));
            }
            
            $select = [];
            $select['active'] = 'Active';
            $select['finalized'] = 'Finalized';
    
            return view('project_t_s_galery_todolists.edit')
                ->with('projectTSGaleryTodolist', $projectTSGaleryTodolist)
                ->with('select', $select);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateProjectTSGaleryTodolistRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_galery_todolists')->join('project_t_s_galeries', 'project_t_s_galery_todolists.p_t_s_g_id', '=', 'project_t_s_galeries.id')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('p_t_s_g_id', $request -> p_t_s_g_id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTSGaleryTodolist = $this->projectTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolist))
            {
                Flash::error('Project T S Galery Todolist not found');
                return redirect(route('projectTSGaleryTodolists.index'));
            }
    
            $newProjectTSGaleryTodolist = $this->projectTSGaleryTodolistRepository->update($request->all(), $id);
    
            DB::table('project_t_s_galery_todolists')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
            DB::table('project_t_s_galery_todolist_updates')->insert(['actual_name' => $newProjectTSGaleryTodolist -> name, 'past_name' => $projectTSGaleryTodolist -> name, 'datetime' => $now, 'p_t_s_g_t_id' => $id, 'user_id' => $user_id]);
            DB::table('recent_activities')->insert(['name' => $projectTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_g_todo_u', 'user_id' => $user_id, 'entity_id' => $projectTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S Galery Todolist updated successfully.');
            return redirect(route('projectTSGaleries.show', [$projectTSGaleryTodolist -> p_t_s_g_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = DB::table('project_t_s_galery_todolists')->join('project_t_s_galeries', 'project_t_s_galery_todolists.p_t_s_g_id', '=', 'project_t_s_galeries.id')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'projects.user_id', '=', 'users.id')->where('project_t_s_galery_todolists.id', $id)->get();

        if(Auth::user() != null && $user[0] -> id == $user_id)
        {
            $now = Carbon::now();
            $projectTSGaleryTodolist = $this->projectTSGaleryTodolistRepository->findWithoutFail($id);
    
            if(empty($projectTSGaleryTodolist))
            {
                Flash::error('Project T S Galery Todolist not found');
                return redirect(route('projectTSGaleryTodolists.index'));
            }
    
            $this->projectTSGaleryTodolistRepository->delete($id);
           
            DB::table('project_t_s_galery_todolist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_g_t_id' => $projectTSGaleryTodolist -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTSGaleryTodolist -> name, 'status' => 'active', 'type' => 'p_t_s_g_todo_d', 'user_id' => $user_id, 'entity_id' => $projectTSGaleryTodolist -> id, 'created_at' => $now]);
    
            Flash::success('Project T S Galery Todolist deleted successfully.');
            return redirect(route('projectTSGaleries.show', [$projectTSGaleryTodolist -> p_t_s_g_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}