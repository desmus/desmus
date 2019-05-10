<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserProjectTSFileRequest;
use App\Http\Requests\UpdateUserProjectTSFileRequest;
use App\Repositories\UserProjectTSFileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserProjectTSFileController extends AppBaseController
{
    private $userProjectTSFileRepository;

    public function __construct(UserProjectTSFileRepository $userProjectTSFileRepo)
    {
        $this->userProjectTSFileRepository = $userProjectTSFileRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSFileRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSFiles = $this->userProjectTSFileRepository->all();
    
            return view('user_project_t_s_files.index')
                ->with('userProjectTSFiles', $userProjectTSFiles);
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
            
            $userProjectTSFilesList = DB::table('user_project_t_s_files')->join('users', 'user_project_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_files.description', 'permissions', 'user_project_t_s_files.datetime', 'user_project_t_s_files.id', 'project_t_s_file_id')->where('project_t_s_file_id', $id)->where(function ($query) {$query->where('user_project_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectTopicSectionFileViewsList = DB::table('users')->join('project_t_s_file_views', 'users.id', '=', 'project_t_s_file_views.user_id')->where('project_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTopicSectionFileUpdatesList = DB::table('users')->join('project_t_s_file_updates', 'users.id', '=', 'project_t_s_file_updates.user_id')->where('project_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_project_t_s_files.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userProjectTSFilesList', $userProjectTSFilesList)
                ->with('projectTSFileViewsList', $projectTopicSectionFileViewsList)
                ->with('projectTSFileUpdatesList', $projectTopicSectionFileUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('project_t_s_files')->join('project_topic_sections', 'project_t_s_files.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_files.id', '=', $request -> project_t_s_file_id)->get();
            
            $userProjectTSFileCheck = DB::table('user_project_t_s_files')->where('user_id', '=', $request -> user_id)->where('project_t_s_file_id', '=', $request -> project_t_s_file_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userProjectTSFileCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userProjectTSFile = $this->userProjectTSFileRepository->create($input);
                    $user = DB::table('user_project_t_s_files')->join('users', 'users.id', '=', 'user_project_t_s_files.user_id')->where('user_project_t_s_files.id', '=', $userProjectTSFile -> id)->select('name')->get();
                   
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_f_c', 'user_id' => $user_id, 'entity_id' => $userProjectTSFile -> project_t_s_file_id, 'created_at' => $now]);
                    DB::table('user_project_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile -> id]);
                
                    Flash::success('User Project T S File saved successfully.');
                    return redirect(route('userProjectTSFiles.show', [$userProjectTSFile -> project_t_s_file_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userProjectTSFiles.show', [$request -> project_t_s_file_id]));
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
            $userProjectTSFile = $this->userProjectTSFileRepository->findWithoutFail($id);
            $userProjectTSFiles = DB::table('user_project_t_s_files')->join('users', 'user_project_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_files.description', 'permissions', 'user_project_t_s_files.datetime', 'user_project_t_s_files.id', 'project_t_s_file_id')->where('project_t_s_file_id', $id)->where(function ($query) {$query->where('user_project_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userProjectTSFiles[0]))
            {
                Flash::error('User Project T S File not found');
                return redirect(route('userProjectTSFiles.create', [$id]));
            }
    
            $user = DB::table('project_t_s_files')->join('project_topic_sections', 'project_t_s_files.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_files.id', '=', $userProjectTSFiles[0] -> project_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $projectTSFile = DB::table('project_t_s_files')->where('id', '=', $userProjectTSFiles[0] -> project_t_s_file_id)->get();
    
                $userProjectTSFilesList = DB::table('user_project_t_s_files')->join('users', 'user_project_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_files.description', 'permissions', 'user_project_t_s_files.datetime', 'user_project_t_s_files.id', 'project_t_s_file_id')->where('project_t_s_file_id', $id)->where(function ($query) {$query->where('user_project_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTopicSectionFileViewsList = DB::table('users')->join('project_t_s_file_views', 'users.id', '=', 'project_t_s_file_views.user_id')->where('project_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTopicSectionFileUpdatesList = DB::table('users')->join('project_t_s_file_updates', 'users.id', '=', 'project_t_s_file_updates.user_id')->where('project_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_project_t_s_files.show')
                    ->with('userProjectTSFiles', $userProjectTSFiles)
                    ->with('id', $id)
                    ->with('projectTSFile', $projectTSFile)
                    ->with('userProjectTSFilesList', $userProjectTSFilesList)
                    ->with('projectTSFileViewsList', $projectTopicSectionFileViewsList)
                    ->with('projectTSFileUpdatesList', $projectTopicSectionFileUpdatesList);
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
            $userProjectTSFile = DB::table('users')->join('user_project_t_s_files', 'user_project_t_s_files.user_id', '=', 'users.id')->where('user_project_t_s_files.id', $id)->where(function ($query) {$query->where('user_project_t_s_files.deleted_at', '=', null);})->get();
    
            if(empty($userProjectTSFile[0]))
            {
                Flash::error('User Project T S File not found');
                return redirect(route('userProjectTSFiles.index'));
            }
    
            $user = DB::table('project_t_s_files')->join('project_topic_sections', 'project_t_s_files.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_files.id', '=', $userProjectTSFile[0] -> project_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $userProjectTSFilesList = DB::table('user_project_t_s_files')->join('users', 'user_project_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_files.description', 'permissions', 'user_project_t_s_files.datetime', 'user_project_t_s_files.id', 'project_t_s_file_id')->where('project_t_s_file_id', $id)->where(function ($query) {$query->where('user_project_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTopicSectionFileViewsList = DB::table('users')->join('project_t_s_file_views', 'users.id', '=', 'project_t_s_file_views.user_id')->where('project_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTopicSectionFileUpdatesList = DB::table('users')->join('project_t_s_file_updates', 'users.id', '=', 'project_t_s_file_updates.user_id')->where('project_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_project_t_s_files.edit')
                    ->with('userProjectTSFile', $userProjectTSFile)
                    ->with('id', $userProjectTSFile[0] -> project_t_s_file_id)
                    ->with('userProjectTSFilesList', $userProjectTSFilesList)
                    ->with('projectTSFileViewsList', $projectTopicSectionFileViewsList)
                    ->with('projectTSFileUpdatesList', $projectTopicSectionFileUpdatesList);
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

    public function update($id, UpdateUserProjectTSFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userProjectTSFile = $this->userProjectTSFileRepository->findWithoutFail($id);
    
            if(empty($userProjectTSFile))
            {
                Flash::error('User Project T S File not found');
                return redirect(route('userProjectTSFiles.index'));
            }
    
            $user = DB::table('project_t_s_files')->join('project_topic_sections', 'project_t_s_files.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_files.id', '=', $userProjectTSFile -> project_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $userProjectTSFile = $this->userProjectTSFileRepository->update($request->all(), $id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_t_s_files')->join('users', 'users.id', '=', 'user_project_t_s_files.user_id')->where('user_project_t_s_files.id', '=', $userProjectTSFile -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_f_u', 'user_id' => $user_id, 'entity_id' => $userProjectTSFile -> project_t_s_file_id, 'created_at' => $now]);
                DB::table('user_project_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile -> id]);
            
                Flash::success('User Project T S File updated successfully.');
                return redirect(route('userProjectTSFiles.show', [$userProjectTSFile -> project_t_s_file_id]));
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
            $userProjectTSFile = $this->userProjectTSFileRepository->findWithoutFail($id);
    
            if(empty($userProjectTSFile))
            {
                Flash::error('User Project T S File not found');
                return redirect(route('userProjectTSFiles.index'));
            }
            
            $user = DB::table('project_t_s_files')->join('project_topic_sections', 'project_t_s_files.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_files.id', '=', $userProjectTSFile -> project_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $this->userProjectTSFileRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_t_s_files')->join('users', 'users.id', '=', 'user_project_t_s_files.user_id')->where('user_project_t_s_files.id', '=', $userProjectTSFile -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_f_d', 'user_id' => $user_id, 'entity_id' => $userProjectTSFile -> project_t_s_file_id, 'created_at' => $now]);
                DB::table('user_project_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile -> id]);
            
                Flash::success('User Project T S File deleted successfully.');
                return redirect(route('userProjectTSFiles.show', [$userProjectTSFile -> project_t_s_file_id]));
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}