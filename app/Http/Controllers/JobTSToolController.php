<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolRequest;
use App\Http\Requests\UpdateJobTSToolRequest;
use App\Repositories\JobTSToolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\JobTSTool;
use Illuminate\Support\Carbon;

class JobTSToolController extends AppBaseController
{
    private $jobTSToolRepository;

    public function __construct(JobTSToolRepository $jobTSToolRepo)
    {
        $this->jobTSToolRepository = $jobTSToolRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolRepository->pushCriteria(new RequestCriteria($request));
            $jobTSTools = $this->jobTSToolRepository->all();
    
            return view('job_t_s_tools.index')
                ->with('jobTSTools', $jobTSTools);
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
            $jobTSToolsList = JobTSTool::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            
            return view('job_t_s_tools.create')
                ->with('id', $id)
                ->with('jobTSToolsList', $jobTSToolsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $jobTSTool = $this->jobTSToolRepository->create($input);
    
            DB::table('job_t_s_tool_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_tool_id' => $jobTSTool -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTSTool -> name, 'status' => 'active', 'type' => 'j_t_s_t_c', 'user_id' => $user_id, 'entity_id' => $jobTSTool -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Tool saved successfully.');
            return redirect(route('jobTopicSections.show', [$jobTSTool -> job_topic_section_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function show($id, Request $request)
    {
        if(Auth::user() != null)
        {
            $job_tool_file_p = $request -> job_tool_file_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $jobTSTool = $this->jobTSToolRepository->findWithoutFail($id);
            
            if(empty($jobTSTool))
            {
                Flash::error('Job T S Tool not found');
                return redirect(route('jobTSTools.index'));
            }
            
            $userJobTSTools = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSTools as $userJobTSTool)
            {
                if($userJobTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('job_t_s_tool_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_tool_id' => $id]);
                DB::table('job_t_s_tools')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
                $jobTSTool = $this->jobTSToolRepository->findWithoutFail($id);
                $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('job_t_s_tool_files.deleted_at', '=', null);})->paginate(50, ['*'], 'job_tool_file_p');
                $jobTopicSectionToolViews = DB::table('users')->join('job_t_s_tool_views', 'users.id', '=', 'job_t_s_tool_views.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $jobTopicSectionToolUpdates = DB::table('users')->join('job_t_s_tool_updates', 'users.id', '=', 'job_t_s_tool_updates.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $jobTSToolTodolist = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_tools', 'job_topic_sections.id', '=', 'job_t_s_tools.job_topic_section_id')->join('job_t_s_tool_todolists', 'job_t_s_tools.id', '=', 'job_t_s_tool_todolists.j_t_s_t_id')->where('job_t_s_tool_todolists.j_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('job_t_s_tool_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_tool_todolists.status', '=', 'active');})->orderBy('job_t_s_tool_todolists.datetime', 'desc')->limit(50)->get();
                $jobTSToolTodolistCompleted = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_tools', 'job_topic_sections.id', '=', 'job_t_s_tools.job_topic_section_id')->join('job_t_s_tool_todolists', 'job_t_s_tools.id', '=', 'job_t_s_tool_todolists.j_t_s_t_id')->where('job_t_s_tool_todolists.j_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('job_t_s_tool_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_t_s_tool_todolists.deleted_at', '=', null);})->orderBy('job_t_s_tool_todolists.datetime', 'desc')->limit(50)->get();

                $jobTSToolFilesList = DB::table('job_t_s_tool_files')->where('job_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('job_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $jobTSToolTodolistsList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_tools', 'job_topic_sections.id', '=', 'job_t_s_tools.job_topic_section_id')->join('job_t_s_tool_todolists', 'job_t_s_tools.id', '=', 'job_t_s_tool_todolists.j_t_s_t_id')->where('job_t_s_tool_todolists.j_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('job_t_s_tool_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_tool_todolists.status', '=', 'active');})->orderBy('job_t_s_tool_todolists.datetime', 'desc')->limit(5)->get();
                $jobTSToolTodolistsCompletedList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_tools', 'job_topic_sections.id', '=', 'job_t_s_tools.job_topic_section_id')->join('job_t_s_tool_todolists', 'job_t_s_tools.id', '=', 'job_t_s_tool_todolists.j_t_s_t_id')->where('job_t_s_tool_todolists.j_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('job_t_s_tool_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_t_s_tool_todolists.deleted_at', '=', null);})->orderBy('job_t_s_tool_todolists.datetime', 'desc')->limit(5)->get();
                $userJobTSToolsList = DB::table('user_job_t_s_tools')->join('users', 'user_job_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_tools.description', 'permissions', 'user_job_t_s_tools.datetime', 'user_job_t_s_tools.id', 'job_t_s_tool_id')->where('job_t_s_tool_id', $id)->where(function ($query) {$query->where('user_job_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSToolViewsList = DB::table('users')->join('job_t_s_tool_views', 'users.id', '=', 'job_t_s_tool_views.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSToolUpdatesList = DB::table('users')->join('job_t_s_tool_updates', 'users.id', '=', 'job_t_s_tool_updates.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
        
                return view('job_t_s_tools.show')
                    ->with('jobTSTool', $jobTSTool)
                    ->with('jobTSToolFiles', $jobTSToolFiles)
                    ->with('jobTSToolViews', $jobTopicSectionToolViews)
                    ->with('jobTSToolUpdates', $jobTopicSectionToolUpdates)
                    ->with('jobTSToolTodolist', $jobTSToolTodolist)
                    ->with('jobTSToolTodolistCompleted', $jobTSToolTodolistCompleted)
                    ->with('job_tool_file_p', $job_tool_file_p)
                    ->with('user_id', $user_id)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('jobTSToolFilesList', $jobTSToolFilesList)
                    ->with('jobTSToolTodolistsList', $jobTSToolTodolistsList)
                    ->with('jobTSToolTodolistsCompletedList', $jobTSToolTodolistsCompletedList)
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
            $jobTSTool = $this->jobTSToolRepository->findWithoutFail($id);
    
            if(empty($jobTSTool))
            {
                Flash::error('Job T S Tool not found');
                return redirect(route('jobTSTools.index'));
            }
            
            $userJobTSTools = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSTools as $userJobTSTool)
            {
                if($userJobTSTool -> user_id == $user_id && $userJobTSTool -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $jobTSToolFilesList = DB::table('job_t_s_tool_files')->where('job_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('job_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $jobTSToolTodolistsList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_tools', 'job_topic_sections.id', '=', 'job_t_s_tools.job_topic_section_id')->join('job_t_s_tool_todolists', 'job_t_s_tools.id', '=', 'job_t_s_tool_todolists.j_t_s_t_id')->where('job_t_s_tool_todolists.j_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('job_t_s_tool_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_tool_todolists.status', '=', 'active');})->orderBy('job_t_s_tool_todolists.datetime', 'desc')->limit(5)->get();
                $jobTSToolTodolistsCompletedList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_tools', 'job_topic_sections.id', '=', 'job_t_s_tools.job_topic_section_id')->join('job_t_s_tool_todolists', 'job_t_s_tools.id', '=', 'job_t_s_tool_todolists.j_t_s_t_id')->where('job_t_s_tool_todolists.j_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('job_t_s_tool_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_t_s_tool_todolists.deleted_at', '=', null);})->orderBy('job_t_s_tool_todolists.datetime', 'desc')->limit(5)->get();
                $userJobTSToolsList = DB::table('user_job_t_s_tools')->join('users', 'user_job_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_tools.description', 'permissions', 'user_job_t_s_tools.datetime', 'user_job_t_s_tools.id', 'job_t_s_tool_id')->where('job_t_s_tool_id', $id)->where(function ($query) {$query->where('user_job_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSToolViewsList = DB::table('users')->join('job_t_s_tool_views', 'users.id', '=', 'job_t_s_tool_views.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSToolUpdatesList = DB::table('users')->join('job_t_s_tool_updates', 'users.id', '=', 'job_t_s_tool_updates.user_id')->where('job_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('job_t_s_tools.edit')
                    ->with('jobTSTool', $jobTSTool)
                    ->with('jobTSToolFilesList', $jobTSToolFilesList)
                    ->with('jobTSToolTodolistsList', $jobTSToolTodolistsList)
                    ->with('jobTSToolTodolistsCompletedList', $jobTSToolTodolistsCompletedList)
                    ->with('userJobTSToolsList', $userJobTSToolsList)
                    ->with('jobTSToolViewsList', $jobTSToolViewsList)
                    ->with('jobTSToolUpdatesList', $jobTSToolUpdatesList);
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

    public function update($id, UpdateJobTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $jobTSTool = $this->jobTSToolRepository->findWithoutFail($id);
    
            if(empty($jobTSTool))
            {
                Flash::error('Job T S Tool not found');
                return redirect(route('jobTSTools.index'));
            }
            
            $userJobTSTools = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSTools as $userJobTSTool)
            {
                if($userJobTSTool -> user_id == $user_id && $userJobTSTool -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tools.id', '=', $id)->get();
            
            $size = 0;
            $college_data_sizes = DB::table('colleges')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            foreach($college_data_sizes as $college_data_size)
            {
                $size += $college_data_size -> specific_info_size;
                $college_topic_data_sizes = DB::table('college_topics')->where('college_id', '=', $college_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($college_topic_data_sizes as $college_topic_data_size)
                {
                    $size += $college_topic_data_size -> specific_info_size;
                    $college_section_data_sizes = DB::table('college_topic_sections')->where('college_topic_id', '=', $college_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($college_section_data_sizes as $college_section_data_size)
                    {
                        $size += $college_section_data_size -> specific_info_size;
                        $college_file_data_sizes = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $college_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($college_file_data_sizes as $college_file_data_size)
                        {
                            $size += $college_file_data_size -> file_size;
                        }
                
                        $college_note_data_sizes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $college_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($college_note_data_sizes as $college_note_data_size)
                        {
                            $size += $college_note_data_size -> specific_info_size;
                        }
                                
                        $college_galery_data_sizes = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $college_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($college_galery_data_sizes as $college_galery_data_size)
                        {
                            //$size += $college_galery_data_size -> specific_info_size;
                            $college_image_data_sizes = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $college_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($college_image_data_sizes as $college_image_data_size)
                            {
                                $size += $college_image_data_size -> file_size;
                            }
                        }
                                
                        $college_playlist_data_sizes = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $college_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($college_playlist_data_sizes as $college_playlist_data_size)
                        {
                            //$size += $college_playlist_data_size -> specific_info_size;
                            $college_audio_data_sizes = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $college_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($college_audio_data_sizes as $college_audio_data_size)
                            {
                                $size += $college_audio_data_size -> file_size;
                            }
                        }
                                
                        $college_tool_data_sizes = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $college_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($college_tool_data_sizes as $college_tool_data_size)
                        {
                            //$size += $college_tool_data_size -> specific_info_size;
                            $college_tool_file_data_sizes = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $college_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($college_tool_file_data_sizes as $college_tool_file_data_size)
                            {
                                $size += $college_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            $job_data_sizes = DB::table('jobs')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();

            foreach($job_data_sizes as $job_data_size)
            {
                $size += $job_data_size -> specific_info_size;
                $job_topic_data_sizes = DB::table('job_topics')->where('job_id', '=', $job_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($job_topic_data_sizes as $job_topic_data_size)
                {
                    $size += $job_topic_data_size -> specific_info_size;
                    $job_section_data_sizes = DB::table('job_topic_sections')->where('job_topic_id', '=', $job_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($job_section_data_sizes as $job_section_data_size)
                    {
                        $size += $job_section_data_size -> specific_info_size;
                        $job_file_data_sizes = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($job_file_data_sizes as $job_file_data_size)
                        {
                            $size += $job_file_data_size -> file_size;
                        }
                
                        $job_note_data_sizes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_note_data_sizes as $job_note_data_size)
                        {
                            $size += $job_note_data_size -> specific_info_size;
                        }
                                
                        $job_galery_data_sizes = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_galery_data_sizes as $job_galery_data_size)
                        {
                            //$size += $job_galery_data_size -> specific_info_size;
                            $job_image_data_sizes = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $job_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_image_data_sizes as $job_image_data_size)
                            {
                                $size += $job_image_data_size -> file_size;
                            }
                        }
                                
                        $job_playlist_data_sizes = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_playlist_data_sizes as $job_playlist_data_size)
                        {
                            //$size += $job_playlist_data_size -> specific_info_size;
                            $job_audio_data_sizes = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $job_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_audio_data_sizes as $job_audio_data_size)
                            {
                                $size += $job_audio_data_size -> file_size;
                            }
                        }
                                
                        $job_tool_data_sizes = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_tool_data_sizes as $job_tool_data_size)
                        {
                            //$size += $job_tool_data_size -> specific_info_size;
                            $job_tool_file_data_sizes = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $job_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_tool_file_data_sizes as $job_tool_file_data_size)
                            {
                                $size += $job_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            $project_data_sizes = DB::table('projects')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            foreach($project_data_sizes as $project_data_size)
            {
                $size += $project_data_size -> specific_info_size;
                $project_topic_data_sizes = DB::table('project_topics')->where('project_id', '=', $project_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($project_topic_data_sizes as $project_topic_data_size)
                {
                    $size += $project_topic_data_size -> specific_info_size;
                    $project_section_data_sizes = DB::table('project_topic_sections')->where('project_topic_id', '=', $project_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($project_section_data_sizes as $project_section_data_size)
                    {
                        $size += $project_section_data_size -> specific_info_size;
                        $project_file_data_sizes = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($project_file_data_sizes as $project_file_data_size)
                        {
                            $size += $project_file_data_size -> file_size;
                        }
                
                        $project_note_data_sizes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_note_data_sizes as $project_note_data_size)
                        {
                            $size += $project_note_data_size -> specific_info_size;
                        }
                                
                        $project_galery_data_sizes = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_galery_data_sizes as $project_galery_data_size)
                        {
                            //$size += $project_galery_data_size -> specific_info_size;
                            $project_image_data_sizes = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $project_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($project_image_data_sizes as $project_image_data_size)
                            {
                                $size += $project_image_data_size -> file_size;
                            }
                        }
                                
                        $project_playlist_data_sizes = DB::table('project_t_s_playlists')->where('p_t_s_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_playlist_data_sizes as $project_playlist_data_size)
                        {
                            //$size += $project_playlist_data_size -> specific_info_size;
                            $project_audio_data_sizes = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $project_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($project_audio_data_sizes as $project_audio_data_size)
                            {
                                $size += $project_audio_data_size -> file_size;
                            }
                        }
                                
                        $project_tool_data_sizes = DB::table('project_t_s_tools')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_tool_data_sizes as $project_tool_data_size)
                        {
                            //$size += $project_tool_data_size -> specific_info_size;
                            $project_tool_file_data_sizes = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $project_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($project_tool_file_data_sizes as $project_tool_file_data_size)
                            {
                                $size += $project_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            $personal_data_data_sizes = DB::table('personal_datas')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            foreach($personal_data_data_sizes as $personal_data_data_size)
            {
                $size += $personal_data_data_size -> specific_info_size;
                $personal_data_topic_data_sizes = DB::table('personal_data_topics')->where('personal_data_id', '=', $personal_data_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($personal_data_topic_data_sizes as $personal_data_topic_data_size)
                {
                    $size += $personal_data_topic_data_size -> specific_info_size;
                    $personal_data_section_data_sizes = DB::table('personal_data_topic_sections')->where('personal_data_topic_id', '=', $personal_data_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($personal_data_section_data_sizes as $personal_data_section_data_size)
                    {
                        $size += $personal_data_section_data_size -> specific_info_size;
                        $personal_data_file_data_sizes = DB::table('personal_data_t_s_files')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($personal_data_file_data_sizes as $personal_data_file_data_size)
                        {
                            $size += $personal_data_file_data_size -> file_size;
                        }
                
                        $personal_data_note_data_sizes = DB::table('personal_data_t_s_notes')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_note_data_sizes as $personal_data_note_data_size)
                        {
                            $size += $personal_data_note_data_size -> specific_info_size;
                        }
                                
                        $personal_data_galery_data_sizes = DB::table('personal_data_t_s_galeries')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_galery_data_sizes as $personal_data_galery_data_size)
                        {
                            //$size += $personal_data_galery_data_size -> specific_info_size;
                            $personal_data_image_data_sizes = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $personal_data_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_image_data_sizes as $personal_data_image_data_size)
                            {
                                $size += $personal_data_image_data_size -> file_size;
                            }
                        }
                                
                        $personal_data_playlist_data_sizes = DB::table('personal_data_t_s_playlists')->where('p_d_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_playlist_data_sizes as $personal_data_playlist_data_size)
                        {
                            //$size += $personal_data_playlist_data_size -> specific_info_size;
                            $personal_data_audio_data_sizes = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $personal_data_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_audio_data_sizes as $personal_data_audio_data_size)
                            {
                                $size += $personal_data_audio_data_size -> file_size;
                            }
                        }
                                
                        $personal_data_tool_data_sizes = DB::table('personal_data_t_s_tools')->where('personal_data_topic_section_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_tool_data_sizes as $personal_data_tool_data_size)
                        {
                            //$size += $personal_data_tool_data_size -> specific_info_size;
                            $personal_data_tool_file_data_sizes = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $personal_data_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_tool_file_data_sizes as $personal_data_tool_file_data_size)
                            {
                                $size += $personal_data_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            if(($user_id == $user[0] -> id || $isShared) && $size <= 1073741824)
            {
                $newJobTSTool = $this->jobTSToolRepository->update($request->all(), $id);
        
                DB::table('job_t_s_tools')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('job_t_s_tool_updates')->insert(['actual_name' => $newJobTSTool -> name, 'past_name' => $jobTSTool -> name, 'datetime' => $now, 'job_t_s_tool_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $jobTSTool -> name, 'status' => 'active', 'type' => 'j_t_s_t_u', 'user_id' => $user_id, 'entity_id' => $jobTSTool -> id, 'created_at' => $now]);
            
                Flash::success('Job T S Tool updated successfully.');
                return redirect(route('jobTSTools.show', [$id]));
            }
            
            else
            {
                if($size > 1073741824)
                {
                    Flash::error('Your storage space is exhausted, you can get more space at only 15 dollars per month.');
                    return redirect(route('colleges.index'));
                }
                
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
            $jobTSTool = $this->jobTSToolRepository->findWithoutFail($id);
            
            if(empty($jobTSTool))
            {
                Flash::error('Job T S Tool not found');
                return redirect(route('jobTSTools.index'));
            }
            
            $user = DB::table('job_t_s_tools')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', $jobTSTool -> id)->update(['deleted_at' => $now]);
                
                $userJobTSTool = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $jobTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userJobTSTool == null)
                {
                    DB::table('user_job_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_id' => $userJobTSTool[0] -> id]);
                }
                
                foreach($jobTSToolFiles as $jobTSToolFile)
                {
                    DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', $jobTSToolFile -> id)->update(['deleted_at' => $now]);
                    
                    $userJobTSToolFile = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $jobTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($$userJobTSToolFile == null)
                    {
                        DB::table('user_job_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile[0] -> id]);
                    }
                }
                    
                $this->jobTSToolRepository->delete($id);
                $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                foreach($jobTSToolFiles as $jobTSToolFile)
                {
                    DB::table('job_t_s_tool_files')->where('id', $jobTSToolFile -> id)->update(['deleted_at' => $now]);
                    DB::table('job_t_s_tool_file_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_t_file_id' => $jobTSToolFile -> id]);
                }
                
                DB::table('job_t_s_tool_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_tool_id' => $jobTSTool -> id]);
                DB::table('recent_activities')->insert(['name' => $jobTSTool -> name, 'status' => 'active', 'type' => 'j_t_s_t_d', 'user_id' => $user_id, 'entity_id' => $jobTSTool -> id, 'created_at' => $now]);
            
                Flash::success('Job T S Tool deleted successfully.');
                return redirect(route('jobTopicSections.show', [$jobTSTool -> job_topic_section_id]));
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