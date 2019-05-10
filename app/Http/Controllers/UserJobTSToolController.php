<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserJobTSToolRequest;
use App\Http\Requests\UpdateUserJobTSToolRequest;
use App\Repositories\UserJobTSToolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserJobTSToolController extends AppBaseController
{
    private $userJobTSToolRepository;

    public function __construct(UserJobTSToolRepository $userJobTSToolRepo)
    {
        $this->userJobTSToolRepository = $userJobTSToolRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSToolRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSTools = $this->userJobTSToolRepository->all();
    
            return view('user_job_t_s_tools.index')
                ->with('userJobTSTools', $userJobTSTools);
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
            
            $jobTSToolFilesList = DB::table('job_t_s_tool_files')->where('job_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('job_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
            $userJobTSToolsList = DB::table('user_job_t_s_tools')->join('users', 'user_job_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_tools.description', 'permissions', 'user_job_t_s_tools.datetime', 'user_job_t_s_tools.id', 'job_t_s_tool_id')->where('job_t_s_tool_id', $id)->where(function ($query) {$query->where('user_job_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $jobTSToolViewsList = DB::table('users')->join('job_t_s_tool_views', 'users.id', '=', 'job_t_s_tool_views.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $jobTSToolUpdatesList = DB::table('users')->join('job_t_s_tool_updates', 'users.id', '=', 'job_t_s_tool_updates.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_job_t_s_tools.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('jobTSToolFilesList', $jobTSToolFilesList)
                ->with('jobTSToolViewsList', $jobTSToolViewsList)
                ->with('jobTSToolUpdatesList', $jobTSToolUpdatesList)
                ->with('userJobTSToolsList', $userJobTSToolsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_tools.id', '=', $request -> job_t_s_tool_id)->get();
            
            $userJobTSToolCheck = DB::table('user_job_t_s_tools')->where('user_id', '=', $request -> user_id)->where('job_t_s_tool_id', '=', $request -> job_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userJobTSToolCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userJobTSTool = $this->userJobTSToolRepository->create($input);
                    $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $userJobTSTool -> job_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_job_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_id' => $userJobTSTool -> id]);
        
                    foreach($jobTSToolFiles as $jobTSToolFile)
                    {
                        DB::table('user_job_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userJobTSTool -> user_id, 'description' => $userJobTSTool -> description, 'job_t_s_t_file_id' => $jobTSToolFile -> id]);
                                                
                        $userJobTSToolFile = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $jobTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                        if(isset($userJobTSToolFile[0]))
                        {
                            DB::table('user_job_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile[0] -> id]);
                        }
                    }
                    
                    $user = DB::table('user_job_t_s_tools')->join('users', 'users.id', '=', 'user_job_t_s_tools.user_id')->where('user_job_t_s_tools.id', '=', $userJobTSTool -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_t_c', 'user_id' => $user_id, 'entity_id' => $userJobTSTool -> job_t_s_tool_id, 'created_at' => $now]);
                
                    Flash::success('User Job T S Tool saved successfully.');
                    return redirect(route('userJobTSTools.show', [$userJobTSTool -> job_t_s_tool_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userJobTSTools.show', [$request -> job_t_s_tool_id]));
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
            $userJobTSTool = $this->userJobTSToolRepository->findWithoutFail($id);
            $userJobTSTools = DB::table('user_job_t_s_tools')->join('users', 'user_job_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_tools.description', 'permissions', 'user_job_t_s_tools.datetime', 'user_job_t_s_tools.id', 'job_t_s_tool_id')->where('job_t_s_tool_id', $id)->where(function ($query) {$query->where('user_job_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userJobTSTools[0]))
            {
                Flash::error('User Job T S Tool not found');
                return redirect(route('userJobTSTools.create', [$id]));
            }
            
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_tools.id', '=', $userJobTSTools[0] -> job_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $jobTSTool = DB::table('job_t_s_tools')->where('id', '=', $userJobTSTools[0] -> job_t_s_tool_id)->get();
    
                $jobTSToolFilesList = DB::table('job_t_s_tool_files')->where('job_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('job_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $userJobTSToolsList = DB::table('user_job_t_s_tools')->join('users', 'user_job_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_tools.description', 'permissions', 'user_job_t_s_tools.datetime', 'user_job_t_s_tools.id', 'job_t_s_tool_id')->where('job_t_s_tool_id', $id)->where(function ($query) {$query->where('user_job_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSToolViewsList = DB::table('users')->join('job_t_s_tool_views', 'users.id', '=', 'job_t_s_tool_views.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSToolUpdatesList = DB::table('users')->join('job_t_s_tool_updates', 'users.id', '=', 'job_t_s_tool_updates.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_job_t_s_tools.show')
                    ->with('userJobTSTools', $userJobTSTools)
                    ->with('id', $id)
                    ->with('jobTSTool', $jobTSTool)
                    ->with('jobTSToolFilesList', $jobTSToolFilesList)
                    ->with('jobTSToolViewsList', $jobTSToolViewsList)
                    ->with('jobTSToolUpdatesList', $jobTSToolUpdatesList)
                    ->with('userJobTSToolsList', $userJobTSToolsList);
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
            $userJobTSTool = DB::table('users')->join('user_job_t_s_tools', 'user_job_t_s_tools.user_id', '=', 'users.id')->where('user_job_t_s_tools.id', $id)->where(function ($query) {$query->where('user_job_t_s_tools.deleted_at', '=', null);})->get();
    
            if(empty($userJobTSTool[0]))
            {
                Flash::error('User Job T S Tool not found');
                return redirect(route('userJobTSTools.index'));
            }
    
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_tools.id', '=', $userJobTSTool[0] -> job_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $jobTSToolFilesList = DB::table('job_t_s_tool_files')->where('job_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('job_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $userJobTSToolsList = DB::table('user_job_t_s_tools')->join('users', 'user_job_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_tools.description', 'permissions', 'user_job_t_s_tools.datetime', 'user_job_t_s_tools.id', 'job_t_s_tool_id')->where('job_t_s_tool_id', $id)->where(function ($query) {$query->where('user_job_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSToolViewsList = DB::table('users')->join('job_t_s_tool_views', 'users.id', '=', 'job_t_s_tool_views.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSToolUpdatesList = DB::table('users')->join('job_t_s_tool_updates', 'users.id', '=', 'job_t_s_tool_updates.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_job_t_s_tools.edit')
                    ->with('userJobTSTool', $userJobTSTool)
                    ->with('id', $userJobTSTool[0] -> job_t_s_tool_id)
                    ->with('jobTSToolFilesList', $jobTSToolFilesList)
                    ->with('jobTSToolViewsList', $jobTSToolViewsList)
                    ->with('jobTSToolUpdatesList', $jobTSToolUpdatesList)
                    ->with('userJobTSToolsList', $userJobTSToolsList);
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

    public function update($id, UpdateUserJobTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userJobTSTool = $this->userJobTSToolRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userJobTSTool))
            {
                Flash::error('User Job T S Tool not found');
                return redirect(route('userJobTSTools.index'));
            }
            
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_tools.id', '=', $userJobTSTool -> job_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userJobTSTool -> user_id;
                $userJobTSTool = $this->userJobTSToolRepository->update($request->all(), $id);
                $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $userJobTSTool -> job_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_job_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_id' => $userJobTSTool -> id]);
                 
                foreach($jobTSToolFiles as $jobTSToolFile)
                {
                    DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', $jobTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJobTSTool -> permissions]);
                                            
                    $userJobTSToolFile = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $jobTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userJobTSToolFile[0]))
                    {
                        DB::table('user_job_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_t_s_tools')->join('users', 'users.id', '=', 'user_job_t_s_tools.user_id')->where('user_job_t_s_tools.id', '=', $userJobTSTool -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_t_u', 'user_id' => $user_id, 'entity_id' => $userJobTSTool -> job_t_s_tool_id, 'created_at' => $now]);
            
                Flash::success('User Job T S Tool updated successfully.');
                return redirect(route('userJobTSTools.show', [$userJobTSTool -> job_t_s_tool_id]));
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
            $userJobTSTool = $this->userJobTSToolRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userJobTSTool))
            {
                Flash::error('User Job T S Tool not found');
                return redirect(route('userJobTSTools.index'));
            }
    
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_tools.id', '=', $userJobTSTool -> job_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userJobTSTool -> user_id;
                $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $userJobTSTool -> job_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_job_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_id' => $userJobTSTool -> id]);
           
                foreach($jobTSToolFiles as $jobTSToolFile)
                {
                    DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', $jobTSToolFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userJobTSToolFile = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $jobTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userJobTSToolFile[0]))
                    {
                        DB::table('user_job_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile[0] -> id]);
                    }
                }
        
                $this->userJobTSToolRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_t_s_tools')->join('users', 'users.id', '=', 'user_job_t_s_tools.user_id')->where('user_job_t_s_tools.id', '=', $userJobTSTool -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_t_d', 'user_id' => $user_id, 'entity_id' => $userJobTSTool -> job_t_s_tool_id, 'created_at' => $now]);
            
                Flash::success('User Job T S Tool deleted successfully.');
                return redirect(route('userJobTSTools.show', [$userJobTSTool -> job_t_s_tool_id]));
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