<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserProjectTSToolFileRequest;
use App\Http\Requests\UpdateUserProjectTSToolFileRequest;
use App\Repositories\UserProjectTSToolFileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserProjectTSToolFileController extends AppBaseController
{
    private $userProjectTSToolFileRepository;

    public function __construct(UserProjectTSToolFileRepository $userProjectTSToolFileRepo)
    {
        $this->userProjectTSToolFileRepository = $userProjectTSToolFileRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSToolFileRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSToolFiles = $this->userProjectTSToolFileRepository->all();
    
            return view('user_project_t_s_tool_files.index')
                ->with('userProjectTSToolFiles', $userProjectTSToolFiles);
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
            
            $userProjectTSToolFilesList = DB::table('user_project_t_s_tool_files')->join('users', 'user_project_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_tool_files.description', 'permissions', 'user_project_t_s_tool_files.datetime', 'user_project_t_s_tool_files.id', 'project_t_s_t_file_id')->where('project_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_project_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectTSToolFileViewsList = DB::table('users')->join('project_t_s_tool_file_views', 'users.id', '=', 'project_t_s_tool_file_views.user_id')->where('project_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTSToolFileUpdatesList = DB::table('users')->join('project_t_s_tool_file_updates', 'users.id', '=', 'project_t_s_tool_file_updates.user_id')->where('project_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_project_t_s_tool_files.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userProjectTSToolFilesList', $userProjectTSToolFilesList)
                ->with('projectTSToolFileViewsList', $projectTSToolFileViewsList)
                ->with('projectTSToolFileUpdatesList', $projectTSToolFileUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSToolFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('project_t_s_tool_files')->join('project_t_s_tools', 'project_t_s_tool_files.project_t_s_t_id', '=', 'project_t_s_tools.id')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_tool_files.id', '=', $request -> project_t_s_t_file_id)->get();
            
            $userProjectTSToolFileCheck = DB::table('user_project_t_s_tool_files')->where('user_id', '=', $request -> user_id)->where('project_t_s_t_file_id', '=', $request -> project_t_s_t_file_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userProjectTSToolFileCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userProjectTSToolFile = $this->userProjectTSToolFileRepository->create($input);
                    $user = DB::table('user_project_t_s_tool_files')->join('users', 'users.id', '=', 'user_project_t_s_tool_files.user_id')->where('user_project_t_s_tool_files.id', '=', $userProjectTSToolFile -> id)->select('name')->get();
                
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_t_f_c', 'user_id' => $user_id, 'entity_id' => $userProjectTSToolFile -> project_t_s_t_file_id, 'created_at' => $now]);
                    DB::table('user_project_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile -> id]);
                
                    Flash::success('User Project T S Tool File saved successfully.');
                    return redirect(route('userProjectTSToolFiles.show', [$userProjectTSToolFile -> project_t_s_t_file_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userProjectTSToolFiles.show', [$request -> project_t_s_t_file_id]));
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
            $userProjectTSToolFile = $this->userProjectTSToolFileRepository->findWithoutFail($id);
            $userProjectTSToolFiles = DB::table('user_project_t_s_tool_files')->join('users', 'user_project_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_tool_files.description', 'permissions', 'user_project_t_s_tool_files.datetime', 'user_project_t_s_tool_files.id', 'project_t_s_t_file_id')->where('project_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_project_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userProjectTSToolFiles[0]))
            {
                Flash::error('User Project T S Tool File not found');
                return redirect(route('userProjectTSToolFiles.create', [$id]));
            }
            
            $user = DB::table('project_t_s_tool_files')->join('project_t_s_tools', 'project_t_s_tool_files.project_t_s_t_id', '=', 'project_t_s_tools.id')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_tool_files.id', '=', $userProjectTSToolFiles[0] -> project_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTSToolFile = DB::table('project_t_s_tool_files')->where('id', '=', $userProjectTSToolFiles[0] -> project_t_s_t_file_id)->get();
            
                $userProjectTSToolFilesList = DB::table('user_project_t_s_tool_files')->join('users', 'user_project_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_tool_files.description', 'permissions', 'user_project_t_s_tool_files.datetime', 'user_project_t_s_tool_files.id', 'project_t_s_t_file_id')->where('project_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_project_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSToolFileViewsList = DB::table('users')->join('project_t_s_tool_file_views', 'users.id', '=', 'project_t_s_tool_file_views.user_id')->where('project_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSToolFileUpdatesList = DB::table('users')->join('project_t_s_tool_file_updates', 'users.id', '=', 'project_t_s_tool_file_updates.user_id')->where('project_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
                return view('user_project_t_s_tool_files.show')
                    ->with('userProjectTSToolFiles', $userProjectTSToolFiles)
                    ->with('id', $id)
                    ->with('projectTSToolFile', $projectTSToolFile)
                    ->with('userProjectTSToolFilesList', $userProjectTSToolFilesList)
                    ->with('projectTSToolFileViewsList', $projectTSToolFileViewsList)
                    ->with('projectTSToolFileUpdatesList', $projectTSToolFileUpdatesList);
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
            $userProjectTSToolFile= DB::table('users')->join('user_project_t_s_tool_files', 'user_project_t_s_tool_files.user_id', '=', 'users.id')->where('user_project_t_s_tool_files.id', $id)->where(function ($query) {$query->where('user_project_t_s_tool_files.deleted_at', '=', null);})->get();
    
            if(empty($userProjectTSToolFile))
            {
                Flash::error('User Project T S Tool File not found');
                return redirect(route('userProjectTSToolFiles.index'));
            }
    
            $user = DB::table('project_t_s_tool_files')->join('project_t_s_tools', 'project_t_s_tool_files.project_t_s_t_id', '=', 'project_t_s_tools.id')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_tool_files.id', '=', $userProjectTSToolFile[0] -> project_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userProjectTSToolFilesList = DB::table('user_project_t_s_tool_files')->join('users', 'user_project_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_tool_files.description', 'permissions', 'user_project_t_s_tool_files.datetime', 'user_project_t_s_tool_files.id', 'project_t_s_t_file_id')->where('project_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_project_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSToolFileViewsList = DB::table('users')->join('project_t_s_tool_file_views', 'users.id', '=', 'project_t_s_tool_file_views.user_id')->where('project_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSToolFileUpdatesList = DB::table('users')->join('project_t_s_tool_file_updates', 'users.id', '=', 'project_t_s_tool_file_updates.user_id')->where('project_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_project_t_s_tool_files.edit')
                    ->with('userProjectTSToolFile', $userProjectTSToolFile)
                    ->with('id', $userProjectTSToolFile[0] -> project_t_s_t_file_id)
                    ->with('userProjectTSToolFilesList', $userProjectTSToolFilesList)
                    ->with('projectTSToolFileViewsList', $projectTSToolFileViewsList)
                    ->with('projectTSToolFileUpdatesList', $projectTSToolFileUpdatesList);
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

    public function update($id, UpdateUserProjectTSToolFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userProjectTSToolFile = $this->userProjectTSToolFileRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFile))
            {
                Flash::error('User Project T S Tool File not found');
                return redirect(route('userProjectTSToolFiles.index'));
            }
            
            $user = DB::table('project_t_s_tool_files')->join('project_t_s_tools', 'project_t_s_tool_files.project_t_s_t_id', '=', 'project_t_s_tools.id')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_tool_files.id', '=', $userProjectTSToolFile -> project_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userProjectTSToolFile = $this->userProjectTSToolFileRepository->update($request->all(), $id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_t_s_tool_files')->join('users', 'users.id', '=', 'user_project_t_s_tool_files.user_id')->where('user_project_t_s_tool_files.id', '=', $userProjectTSToolFile -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_t_f_u', 'user_id' => $user_id, 'entity_id' => $userProjectTSToolFile -> project_t_s_t_file_id, 'created_at' => $now]);
                DB::table('user_project_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile -> id]);
            
                Flash::success('User Project T S Tool File updated successfully.');
                return redirect(route('userProjectTSToolFiles.show', [$userProjectTSToolFile -> project_t_s_t_file_id]));
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
            $user_id = Auth::user()->id;
            $userProjectTSToolFile = $this->userProjectTSToolFileRepository->findWithoutFail($id);
    
            if(empty($userProjectTSToolFile))
            {
                Flash::error('User Project T S Tool File not found');
                return redirect(route('userProjectTSToolFiles.index'));
            }
    
            $user = DB::table('project_t_s_tool_files')->join('project_t_s_tools', 'project_t_s_tool_files.project_t_s_t_id', '=', 'project_t_s_tools.id')->join('project_topic_sections', 'project_t_s_tools.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_tool_files.id', '=', $userProjectTSToolFile -> project_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userProjectTSToolFileRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_t_s_tool_files')->join('users', 'users.id', '=', 'user_project_t_s_tool_files.user_id')->where('user_project_t_s_tool_files.id', '=', $userProjectTSToolFile -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_t_f_d', 'user_id' => $user_id, 'entity_id' => $userProjectTSToolFile -> project_t_s_t_file_id, 'created_at' => $now]);
                DB::table('user_project_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile -> id]);
            
                Flash::success('User Project T S Tool File deleted successfully.');
                return redirect(route('userProjectTSToolFiles.show', [$userProjectTSToolFile -> project_t_s_t_file_id]));
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