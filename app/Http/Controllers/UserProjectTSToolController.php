<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserProjectTSToolRequest;
use App\Http\Requests\UpdateUserProjectTSToolRequest;
use App\Repositories\UserProjectTSToolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserProjectTSToolController extends AppBaseController
{
    private $userProjectTSToolRepository;

    public function __construct(UserProjectTSToolRepository $userProjectTSToolRepo)
    {
        $this->userProjectTSToolRepository = $userProjectTSToolRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSToolRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSTools = $this->userProjectTSToolRepository->all();
    
            return view('user_project_t_s_tools.index')
                ->with('userProjectTSTools', $userProjectTSTools);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $users = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->select('name', 'contacts.user_id', 'users.id')->where('contacts.user_id', '=', $user_id)->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->orderBy('name', 'asc')->get();
            $select = [];
                
            foreach($users as $user)
            {
                $select[$user->id] = $user->name;
            }
            
            $projectTSToolFilesList = DB::table('project_t_s_tool_files')->where('project_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('project_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
            $userProjectTSToolsList = DB::table('user_project_t_s_tools')->join('users', 'user_project_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_tools.description', 'permissions', 'user_project_t_s_tools.datetime', 'user_project_t_s_tools.id', 'project_t_s_tool_id')->where('project_t_s_tool_id', $id)->where(function ($query) {$query->where('user_project_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectTSToolViewsList = DB::table('users')->join('project_t_s_tool_views', 'users.id', '=', 'project_t_s_tool_views.user_id')->where('project_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTSToolUpdatesList = DB::table('users')->join('project_t_s_tool_updates', 'users.id', '=', 'project_t_s_tool_updates.user_id')->where('project_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_project_t_s_tools.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('projectTSToolFilesList', $projectTSToolFilesList)
                ->with('userProjectTSToolsList', $userProjectTSToolsList)
                ->with('projectTSToolViewsList', $projectTSToolViewsList)
                ->with('projectTSToolUpdatesList', $projectTSToolUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('project_t_s_tools')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_tools.id', '=', $request -> project_t_s_tool_id)->get();
            
            $userProjectTSToolCheck = DB::table('user_project_t_s_tools')->where('user_id', '=', $request -> user_id)->where('project_t_s_tool_id', '=', $request -> project_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userProjectTSToolCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userProjectTSTool = $this->userProjectTSToolRepository->create($input);
                    $projectTSToolFiles = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $userProjectTSTool -> project_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_project_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_id' => $userProjectTSTool -> id]);
        
                    foreach($projectTSToolFiles as $projectTSToolFile)
                    {
                        DB::table('user_project_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userProjectTSTool -> user_id, 'description' => $userProjectTSTool -> description, 'project_t_s_t_file_id' => $projectTSToolFile -> id]);
                                                
                        $userProjectTSToolFile = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $projectTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                        if(isset($userProjectTSToolFile[0]))
                        {
                            DB::table('user_project_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile[0] -> id]);
                        }
                    }
                    
                    $user = DB::table('user_project_t_s_tools')->join('users', 'users.id', '=', 'user_project_t_s_tools.user_id')->where('user_project_t_s_tools.id', '=', $userProjectTSTool -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_t_c', 'user_id' => $user_id, 'entity_id' => $userProjectTSTool -> project_t_s_tool_id, 'created_at' => $now]);
                
                    Flash::success('User Project T S Tool saved successfully.');
                    return redirect(route('userProjectTSTools.show', [$userProjectTSTool -> project_t_s_tool_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userProjectTSTools.show', [$request -> project_t_s_tool_id]));
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
            $user_id = Auth::user()->id;
            $userProjectTSTool = $this->userProjectTSToolRepository->findWithoutFail($id);
            $userProjectTSTools = DB::table('user_project_t_s_tools')->join('users', 'user_project_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_tools.description', 'permissions', 'user_project_t_s_tools.datetime', 'user_project_t_s_tools.id', 'project_t_s_tool_id')->where('project_t_s_tool_id', $id)->where(function ($query) {$query->where('user_project_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userProjectTSTools[0]))
            {
                Flash::error('User Project T S Tool not found');
                return redirect(route('userProjectTSTools.create', [$id]));
            }
            
            $user = DB::table('project_t_s_tools')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_tools.id', '=', $userProjectTSTools[0] -> project_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTSTool = DB::table('project_t_s_tools')->where('id', '=', $userProjectTSTools[0] -> project_t_s_tool_id)->get();
    
                $projectTSToolFilesList = DB::table('project_t_s_tool_files')->where('project_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('project_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $userProjectTSToolsList = DB::table('user_project_t_s_tools')->join('users', 'user_project_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_tools.description', 'permissions', 'user_project_t_s_tools.datetime', 'user_project_t_s_tools.id', 'project_t_s_tool_id')->where('project_t_s_tool_id', $id)->where(function ($query) {$query->where('user_project_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSToolViewsList = DB::table('users')->join('project_t_s_tool_views', 'users.id', '=', 'project_t_s_tool_views.user_id')->where('project_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSToolUpdatesList = DB::table('users')->join('project_t_s_tool_updates', 'users.id', '=', 'project_t_s_tool_updates.user_id')->where('project_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_project_t_s_tools.show')
                    ->with('userProjectTSTools', $userProjectTSTools)
                    ->with('id', $id)
                    ->with('projectTSTool', $projectTSTool)
                    ->with('projectTSToolFilesList', $projectTSToolFilesList)
                    ->with('userProjectTSToolsList', $userProjectTSToolsList)
                    ->with('projectTSToolViewsList', $projectTSToolViewsList)
                    ->with('projectTSToolUpdatesList', $projectTSToolUpdatesList);
            }
            
            else
            {
                return view('deniedAccess');
            }
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
            $userProjectTSTool = DB::table('users')->join('user_project_t_s_tools', 'user_project_t_s_tools.user_id', '=', 'users.id')->where('user_project_t_s_tools.id', $id)->where(function ($query) {$query->where('user_project_t_s_tools.deleted_at', '=', null);})->get();
    
            if(empty($userProjectTSTool[0]))
            {
                Flash::error('User Project T S Tool not found');
                return redirect(route('userProjectTSTools.index'));
            }
    
            $user = DB::table('project_t_s_tools')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_tools.id', '=', $userProjectTSTool[0] -> project_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTSToolFilesList = DB::table('project_t_s_tool_files')->where('project_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('project_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $userProjectTSToolsList = DB::table('user_project_t_s_tools')->join('users', 'user_project_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_tools.description', 'permissions', 'user_project_t_s_tools.datetime', 'user_project_t_s_tools.id', 'project_t_s_tool_id')->where('project_t_s_tool_id', $id)->where(function ($query) {$query->where('user_project_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSToolViewsList = DB::table('users')->join('project_t_s_tool_views', 'users.id', '=', 'project_t_s_tool_views.user_id')->where('project_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSToolUpdatesList = DB::table('users')->join('project_t_s_tool_updates', 'users.id', '=', 'project_t_s_tool_updates.user_id')->where('project_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_project_t_s_tools.edit')
                    ->with('userProjectTSTool', $userProjectTSTool)
                    ->with('id', $userProjectTSTool[0] -> project_t_s_tool_id)
                    ->with('projectTSToolFilesList', $projectTSToolFilesList)
                    ->with('userProjectTSToolsList', $userProjectTSToolsList)
                    ->with('projectTSToolViewsList', $projectTSToolViewsList)
                    ->with('projectTSToolUpdatesList', $projectTSToolUpdatesList);
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateUserProjectTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userProjectTSTool = $this->userProjectTSToolRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userProjectTSTool))
            {
                Flash::error('User Project T S Tool not found');
                return redirect(route('userProjectTSTools.index'));
            }
            
            $user = DB::table('project_t_s_tools')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_tools.id', '=', $userProjectTSTool -> project_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProjectTSTool -> user_id;
                $userProjectTSTool = $this->userProjectTSToolRepository->update($request->all(), $id);
                $projectTSToolFiles = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $userProjectTSTool -> project_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_project_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_id' => $userProjectTSTool -> id]);
                 
                foreach($projectTSToolFiles as $projectTSToolFile)
                {
                    DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', $projectTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTSTool -> permissions]);
                                            
                    $userProjectTSToolFile = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $projectTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userProjectTSToolFile[0]))
                    {
                        DB::table('user_project_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_t_s_tools')->join('users', 'users.id', '=', 'user_project_t_s_tools.user_id')->where('user_project_t_s_tools.id', '=', $userProjectTSTool -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_t_u', 'user_id' => $user_id, 'entity_id' => $userProjectTSTool -> project_t_s_tool_id, 'created_at' => $now]);
            
                Flash::success('User Project T S Tool updated successfully.');
                return redirect(route('userProjectTSTools.show', [$userProjectTSTool -> project_t_s_tool_id]));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userProjectTSTool = $this->userProjectTSToolRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userProjectTSTool))
            {
                Flash::error('User Project T S Tool not found');
                return redirect(route('userProjectTSTools.index'));
            }
    
            $user = DB::table('project_t_s_tools')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_tools.id', '=', $userProjectTSTool -> project_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProjectTSTool -> user_id;
                $projectTSToolFiles = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $userProjectTSTool -> project_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_project_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_id' => $userProjectTSTool -> id]);
           
                foreach($projectTSToolFiles as $projectTSToolFile)
                {
                    DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', $projectTSToolFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userProjectTSToolFile = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $projectTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userProjectTSToolFile[0]))
                    {
                        DB::table('user_project_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile[0] -> id]);
                    }
                }
        
                $this->userProjectTSToolRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_t_s_tools')->join('users', 'users.id', '=', 'user_project_t_s_tools.user_id')->where('user_project_t_s_tools.id', '=', $userProjectTSTool -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_t_d', 'user_id' => $user_id, 'entity_id' => $userProjectTSTool -> project_t_s_tool_id, 'created_at' => $now]);
            
                Flash::success('User Project T S Tool deleted successfully.');
                return redirect(route('userProjectTSTools.show', [$userProjectTSTool -> project_t_s_tool_id]));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}