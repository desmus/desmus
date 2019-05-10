<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserJobTSToolFileRequest;
use App\Http\Requests\UpdateUserJobTSToolFileRequest;
use App\Repositories\UserJobTSToolFileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserJobTSToolFileController extends AppBaseController
{
    private $userJobTSToolFileRepository;

    public function __construct(UserJobTSToolFileRepository $userJobTSToolFileRepo)
    {
        $this->userJobTSToolFileRepository = $userJobTSToolFileRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSToolFileRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSToolFiles = $this->userJobTSToolFileRepository->all();
    
            return view('user_job_t_s_tool_files.index')
                ->with('userJobTSToolFiles', $userJobTSToolFiles);
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
            
            $userJobTSToolFilesList = DB::table('user_job_t_s_tool_files')->join('users', 'user_job_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_tool_files.description', 'permissions', 'user_job_t_s_tool_files.datetime', 'user_job_t_s_tool_files.id', 'job_t_s_t_file_id')->where('job_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_job_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $jobTSToolFileViewsList = DB::table('users')->join('job_t_s_tool_file_views', 'users.id', '=', 'job_t_s_tool_file_views.user_id')->where('job_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $jobTSToolFileUpdatesList = DB::table('users')->join('job_t_s_tool_file_updates', 'users.id', '=', 'job_t_s_tool_file_updates.user_id')->where('job_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_job_t_s_tool_files.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userJobTSToolFilesList', $userJobTSToolFilesList)
                ->with('jobTSToolFileViewsList', $jobTSToolFileViewsList)
                ->with('jobTSToolFileUpdatesList', $jobTSToolFileUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSToolFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('job_t_s_tool_files')->join('job_t_s_tools', 'job_t_s_tool_files.job_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_tool_files.id', '=', $request -> job_t_s_t_file_id)->get();
            
            $userJobTSToolFileCheck = DB::table('user_job_t_s_tool_files')->where('user_id', '=', $request -> user_id)->where('job_t_s_t_file_id', '=', $request -> job_t_s_t_file_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userJobTSToolFileCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userJobTSToolFile = $this->userJobTSToolFileRepository->create($input);
                    $user = DB::table('user_job_t_s_tool_files')->join('users', 'users.id', '=', 'user_job_t_s_tool_files.user_id')->where('user_job_t_s_tool_files.id', '=', $userJobTSToolFile -> id)->select('name')->get();
                
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_t_f_c', 'user_id' => $user_id, 'entity_id' => $userJobTSToolFile -> job_t_s_t_file_id, 'created_at' => $now]);
                    DB::table('user_job_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile -> id]);
                
                    Flash::success('User Job T S Tool File saved successfully.');
                    return redirect(route('userJobTSToolFiles.show', [$userJobTSToolFile -> job_t_s_t_file_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userJobTSToolFiles.show', [$request -> job_t_s_t_file_id]));
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
            $userJobTSToolFile = $this->userJobTSToolFileRepository->findWithoutFail($id);
            $userJobTSToolFiles = DB::table('user_job_t_s_tool_files')->join('users', 'user_job_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_tool_files.description', 'permissions', 'user_job_t_s_tool_files.datetime', 'user_job_t_s_tool_files.id', 'job_t_s_t_file_id')->where('job_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_job_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userJobTSToolFiles[0]))
            {
                Flash::error('User Job T S Tool File not found');
                return redirect(route('userJobTSToolFiles.create', [$id]));
            }
            
            $user = DB::table('job_t_s_tool_files')->join('job_t_s_tools', 'job_t_s_tool_files.job_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_tool_files.id', '=', $userJobTSToolFiles[0] -> job_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $jobTSToolFile = DB::table('job_t_s_tool_files')->where('id', '=', $userJobTSToolFiles[0] -> job_t_s_t_file_id)->get();
            
                $userJobTSToolFilesList = DB::table('user_job_t_s_tool_files')->join('users', 'user_job_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_tool_files.description', 'permissions', 'user_job_t_s_tool_files.datetime', 'user_job_t_s_tool_files.id', 'job_t_s_t_file_id')->where('job_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_job_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSToolFileViewsList = DB::table('users')->join('job_t_s_tool_file_views', 'users.id', '=', 'job_t_s_tool_file_views.user_id')->where('job_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSToolFileUpdatesList = DB::table('users')->join('job_t_s_tool_file_updates', 'users.id', '=', 'job_t_s_tool_file_updates.user_id')->where('job_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
                return view('user_job_t_s_tool_files.show')
                    ->with('userJobTSToolFiles', $userJobTSToolFiles)
                    ->with('id', $id)
                    ->with('jobTSToolFile', $jobTSToolFile)
                    ->with('userJobTSToolFilesList', $userJobTSToolFilesList)
                    ->with('jobTSToolFileViewsList', $jobTSToolFileViewsList)
                    ->with('jobTSToolFileUpdatesList', $jobTSToolFileUpdatesList);
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
            $userJobTSToolFile= DB::table('users')->join('user_job_t_s_tool_files', 'user_job_t_s_tool_files.user_id', '=', 'users.id')->where('user_job_t_s_tool_files.id', $id)->where(function ($query) {$query->where('user_job_t_s_tool_files.deleted_at', '=', null);})->get();
    
            if(empty($userJobTSToolFile))
            {
                Flash::error('User Job T S Tool File not found');
                return redirect(route('userJobTSToolFiles.index'));
            }
    
            $user = DB::table('job_t_s_tool_files')->join('job_t_s_tools', 'job_t_s_tool_files.job_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_tool_files.id', '=', $userJobTSToolFile[0] -> job_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userJobTSToolFilesList = DB::table('user_job_t_s_tool_files')->join('users', 'user_job_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_tool_files.description', 'permissions', 'user_job_t_s_tool_files.datetime', 'user_job_t_s_tool_files.id', 'job_t_s_t_file_id')->where('job_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_job_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSToolFileViewsList = DB::table('users')->join('job_t_s_tool_file_views', 'users.id', '=', 'job_t_s_tool_file_views.user_id')->where('job_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSToolFileUpdatesList = DB::table('users')->join('job_t_s_tool_file_updates', 'users.id', '=', 'job_t_s_tool_file_updates.user_id')->where('job_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_job_t_s_tool_files.edit')
                    ->with('userJobTSToolFile', $userJobTSToolFile)
                    ->with('id', $userJobTSToolFile[0] -> job_t_s_t_file_id)
                    ->with('userJobTSToolFilesList', $userJobTSToolFilesList)
                    ->with('jobTSToolFileViewsList', $jobTSToolFileViewsList)
                    ->with('jobTSToolFileUpdatesList', $jobTSToolFileUpdatesList);
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

    public function update($id, UpdateUserJobTSToolFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userJobTSToolFile = $this->userJobTSToolFileRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFile))
            {
                Flash::error('User Job T S Tool File not found');
                return redirect(route('userJobTSToolFiles.index'));
            }
            
            $user = DB::table('job_t_s_tool_files')->join('job_t_s_tools', 'job_t_s_tool_files.job_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_tool_files.id', '=', $userJobTSToolFile -> job_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userJobTSToolFile = $this->userJobTSToolFileRepository->update($request->all(), $id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_t_s_tool_files')->join('users', 'users.id', '=', 'user_job_t_s_tool_files.user_id')->where('user_job_t_s_tool_files.id', '=', $userJobTSToolFile -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_t_f_u', 'user_id' => $user_id, 'entity_id' => $userJobTSToolFile -> job_t_s_t_file_id, 'created_at' => $now]);
                DB::table('user_job_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile -> id]);
            
                Flash::success('User Job T S Tool File updated successfully.');
                return redirect(route('userJobTSToolFiles.show', [$userJobTSToolFile -> job_t_s_t_file_id]));
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
            $userJobTSToolFile = $this->userJobTSToolFileRepository->findWithoutFail($id);
    
            if(empty($userJobTSToolFile))
            {
                Flash::error('User Job T S Tool File not found');
                return redirect(route('userJobTSToolFiles.index'));
            }
    
            $user = DB::table('job_t_s_tool_files')->join('job_t_s_tools', 'job_t_s_tool_files.job_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_tool_files.id', '=', $userJobTSToolFile -> job_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userJobTSToolFileRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_t_s_tool_files')->join('users', 'users.id', '=', 'user_job_t_s_tool_files.user_id')->where('user_job_t_s_tool_files.id', '=', $userJobTSToolFile -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_t_f_d', 'user_id' => $user_id, 'entity_id' => $userJobTSToolFile -> job_t_s_t_file_id, 'created_at' => $now]);
                DB::table('user_job_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile -> id]);
            
                Flash::success('User Job T S Tool File deleted successfully.');
                return redirect(route('userJobTSToolFiles.show', [$userJobTSToolFile -> job_t_s_t_file_id]));
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