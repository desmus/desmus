<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolRequest;
use App\Http\Requests\UpdateCollegeTSToolRequest;
use App\Repositories\CollegeTSToolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\CollegeTSTool;
use Illuminate\Support\Carbon;

class CollegeTSToolController extends AppBaseController
{
    private $collegeTSToolRepository;

    public function __construct(CollegeTSToolRepository $collegeTSToolRepo)
    {
        $this->collegeTSToolRepository = $collegeTSToolRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSTools = $this->collegeTSToolRepository->all();
    
            return view('college_t_s_tools.index')
                ->with('collegeTSTools', $collegeTSTools);
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
            $collegeTSToolsList = CollegeTSTool::where('college_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            return view('college_t_s_tools.create')
                ->with('id', $id)
                ->with('collegeTSToolsList', $collegeTSToolsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $collegeTSTool = $this->collegeTSToolRepository->create($input);
    
            DB::table('college_t_s_tool_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_tool_id' => $collegeTSTool -> id]);
            DB::table('recent_activities')->insert(['name' => $collegeTSTool -> name, 'status' => 'active', 'type' => 'c_t_s_t_c', 'user_id' => $user_id, 'entity_id' => $collegeTSTool -> id, 'created_at' => $now]);
    
            Flash::success('College T S Tool saved successfully.');
            return redirect(route('collegeTopicSections.show', [$collegeTSTool -> college_topic_section_id]));
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
            $college_tool_file_p = $request -> college_tool_file_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $collegeTSTool = $this->collegeTSToolRepository->findWithoutFail($id);
            
            if(empty($collegeTSTool))
            {
                Flash::error('College T S Tool not found');
                return redirect(route('collegeTSTools.index'));
            }
            
            $userCollegeTSTools = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSTools as $userCollegeTSTool)
            {
                if($userCollegeTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('college_t_s_tool_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_tool_id' => $id]);
                DB::table('college_t_s_tools')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
                $collegeTSTool = $this->collegeTSToolRepository->findWithoutFail($id);
                $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_tool_files.deleted_at', '=', null);})->paginate(50, ['*'], 'college_tool_file_p');
                $collegeTopicSectionToolViews = DB::table('users')->join('college_t_s_tool_views', 'users.id', '=', 'college_t_s_tool_views.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeTopicSectionToolUpdates = DB::table('users')->join('college_t_s_tool_updates', 'users.id', '=', 'college_t_s_tool_updates.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeTSToolTodolist = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_tools', 'college_topic_sections.id', '=', 'college_t_s_tools.college_topic_section_id')->join('college_t_s_tool_todolists', 'college_t_s_tools.id', '=', 'college_t_s_tool_todolists.c_t_s_t_id')->where('college_t_s_tool_todolists.c_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('college_t_s_tool_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_tool_todolists.status', '=', 'active');})->orderBy('college_t_s_tool_todolists.datetime', 'desc')->limit(50)->get();
                $collegeTSToolTodolistCompleted = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_tools', 'college_topic_sections.id', '=', 'college_t_s_tools.college_topic_section_id')->join('college_t_s_tool_todolists', 'college_t_s_tools.id', '=', 'college_t_s_tool_todolists.c_t_s_t_id')->where('college_t_s_tool_todolists.c_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('college_t_s_tool_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_t_s_tool_todolists.deleted_at', '=', null);})->orderBy('college_t_s_tool_todolists.datetime', 'desc')->limit(50)->get();
        
                $collegeTSToolFilesList = DB::table('college_t_s_tool_files')->where('college_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $collegeTSToolTodolistsList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_tools', 'college_topic_sections.id', '=', 'college_t_s_tools.college_topic_section_id')->join('college_t_s_tool_todolists', 'college_t_s_tools.id', '=', 'college_t_s_tool_todolists.c_t_s_t_id')->where('college_t_s_tool_todolists.c_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('college_t_s_tool_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_tool_todolists.status', '=', 'active');})->orderBy('college_t_s_tool_todolists.datetime', 'desc')->limit(5)->get();
                $collegeTSToolTodolistsCompletedList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_tools', 'college_topic_sections.id', '=', 'college_t_s_tools.college_topic_section_id')->join('college_t_s_tool_todolists', 'college_t_s_tools.id', '=', 'college_t_s_tool_todolists.c_t_s_t_id')->where('college_t_s_tool_todolists.c_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('college_t_s_tool_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_t_s_tool_todolists.deleted_at', '=', null);})->orderBy('college_t_s_tool_todolists.datetime', 'desc')->limit(5)->get();
                $userCollegeTSToolsList = DB::table('user_college_t_s_tools')->join('users', 'user_college_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_tools.description', 'permissions', 'user_college_t_s_tools.datetime', 'user_college_t_s_tools.id', 'college_t_s_tool_id')->where('college_t_s_tool_id', $id)->where(function ($query) {$query->where('user_college_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSToolViewsList = DB::table('users')->join('college_t_s_tool_views', 'users.id', '=', 'college_t_s_tool_views.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSToolUpdatesList = DB::table('users')->join('college_t_s_tool_updates', 'users.id', '=', 'college_t_s_tool_updates.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                
                return view('college_t_s_tools.show')
                    ->with('collegeTSTool', $collegeTSTool)
                    ->with('collegeTSToolFiles', $collegeTSToolFiles)
                    ->with('collegeTSToolViews', $collegeTopicSectionToolViews)
                    ->with('collegeTSToolUpdates', $collegeTopicSectionToolUpdates)
                    ->with('collegeTSToolTodolist', $collegeTSToolTodolist)
                    ->with('collegeTSToolTodolistCompleted', $collegeTSToolTodolistCompleted)
                    ->with('college_tool_file_p', $college_tool_file_p)
                    ->with('user_id', $user_id)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('collegeTSToolFilesList', $collegeTSToolFilesList)
                    ->with('collegeTSToolTodolistsList', $collegeTSToolTodolistsList)
                    ->with('collegeTSToolTodolistsCompletedList', $collegeTSToolTodolistsCompletedList)
                    ->with('userCollegeTSToolsList', $userCollegeTSToolsList)
                    ->with('collegeTSToolViewsList', $collegeTSToolViewsList)
                    ->with('collegeTSToolUpdatesList', $collegeTSToolUpdatesList);
                    
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
            $collegeTSTool = $this->collegeTSToolRepository->findWithoutFail($id);
    
            if(empty($collegeTSTool))
            {
                Flash::error('College T S Tool not found');
                return redirect(route('collegeTSTools.index'));
            }
            
            $userCollegeTSTools = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSTools as $userCollegeTSTool)
            {
                if($userCollegeTSTool -> user_id == $user_id && $userCollegeTSTool -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $collegeTSToolFilesList = DB::table('college_t_s_tool_files')->where('college_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $collegeTSToolTodolistsList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_tools', 'college_topic_sections.id', '=', 'college_t_s_tools.college_topic_section_id')->join('college_t_s_tool_todolists', 'college_t_s_tools.id', '=', 'college_t_s_tool_todolists.c_t_s_t_id')->where('college_t_s_tool_todolists.c_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('college_t_s_tool_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_t_s_tool_todolists.status', '=', 'active');})->orderBy('college_t_s_tool_todolists.datetime', 'desc')->limit(5)->get();
                $collegeTSToolTodolistsCompletedList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_tools', 'college_topic_sections.id', '=', 'college_t_s_tools.college_topic_section_id')->join('college_t_s_tool_todolists', 'college_t_s_tools.id', '=', 'college_t_s_tool_todolists.c_t_s_t_id')->where('college_t_s_tool_todolists.c_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('college_t_s_tool_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_t_s_tool_todolists.deleted_at', '=', null);})->orderBy('college_t_s_tool_todolists.datetime', 'desc')->limit(5)->get();
                $userCollegeTSToolsList = DB::table('user_college_t_s_tools')->join('users', 'user_college_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_tools.description', 'permissions', 'user_college_t_s_tools.datetime', 'user_college_t_s_tools.id', 'college_t_s_tool_id')->where('college_t_s_tool_id', $id)->where(function ($query) {$query->where('user_college_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSToolViewsList = DB::table('users')->join('college_t_s_tool_views', 'users.id', '=', 'college_t_s_tool_views.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSToolUpdatesList = DB::table('users')->join('college_t_s_tool_updates', 'users.id', '=', 'college_t_s_tool_updates.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('college_t_s_tools.edit')
                    ->with('collegeTSTool', $collegeTSTool)
                    ->with('collegeTSToolFilesList', $collegeTSToolFilesList)
                    ->with('collegeTSToolTodolistsList', $collegeTSToolTodolistsList)
                    ->with('collegeTSToolTodolistsCompletedList', $collegeTSToolTodolistsCompletedList)
                    ->with('userCollegeTSToolsList', $userCollegeTSToolsList)
                    ->with('collegeTSToolViewsList', $collegeTSToolViewsList)
                    ->with('collegeTSToolUpdatesList', $collegeTSToolUpdatesList);
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

    public function update($id, UpdateCollegeTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $collegeTSTool = $this->collegeTSToolRepository->findWithoutFail($id);
    
            if(empty($collegeTSTool))
            {
                Flash::error('College T S Tool not found');
                return redirect(route('collegeTSTools.index'));
            }
            
            $userCollegeTSTools = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSTools as $userCollegeTSTool)
            {
                if($userCollegeTSTool -> user_id == $user_id && $userCollegeTSTool -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tools.id', '=', $id)->get();
            
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
                $newCollegeTSTool = $this->collegeTSToolRepository->update($request->all(), $id);
        
                DB::table('college_t_s_tools')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('college_t_s_tool_updates')->insert(['actual_name' => $newCollegeTSTool -> name, 'past_name' => $collegeTSTool -> name, 'datetime' => $now, 'college_t_s_tool_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $collegeTSTool -> name, 'status' => 'active', 'type' => 'c_t_s_t_u', 'user_id' => $user_id, 'entity_id' => $collegeTSTool -> id, 'created_at' => $now]);
            
                Flash::success('College T S Tool updated successfully.');
                return redirect(route('collegeTSTools.show', [$id]));
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
            $collegeTSTool = $this->collegeTSToolRepository->findWithoutFail($id);
            
            if(empty($collegeTSTool))
            {
                Flash::error('College T S Tool not found');
                return redirect(route('collegeTSTools.index'));
            }
            
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', $collegeTSTool -> id)->update(['deleted_at' => $now]);
                
                $userCollegeTSTool = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $collegeTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userCollegeTSTool == null)
                {
                    DB::table('user_college_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool[0] -> id]);
                }
                
                foreach($collegeTSToolFiles as $collegeTSToolFile)
                {
                    DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', $collegeTSToolFile -> id)->update(['deleted_at' => $now]);
                    
                    $userCollegeTSToolFile = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $collegeTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userCollegeTSToolFile == null)
                    {
                        DB::table('user_college_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile[0] -> id]);
                    }
                }
                    
                $this->collegeTSToolRepository->delete($id);
                $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                foreach($collegeTSToolFiles as $collegeTSToolFile)
                {
                    DB::table('college_t_s_tool_files')->where('id', $collegeTSToolFile -> id)->update(['deleted_at' => $now]);
                    DB::table('college_t_s_tool_file_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_t_file_id' => $collegeTSToolFile -> id]);
                }
                
                // Checar esta parte.
                
                DB::table('college_t_s_tool_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_tool_id' => $collegeTSTool -> id]);
                DB::table('recent_activities')->insert(['name' => $collegeTSTool -> name, 'status' => 'active', 'type' => 'c_t_s_t_d', 'user_id' => $user_id, 'entity_id' => $collegeTSTool -> id, 'created_at' => $now]);
            
                Flash::success('College T S Tool deleted successfully.');
                return redirect(route('collegeTopicSections.show', [$collegeTSTool -> college_topic_section_id]));
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