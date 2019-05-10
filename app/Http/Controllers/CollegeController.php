<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeRequest;
use App\Http\Requests\UpdateCollegeRequest;
use App\Repositories\CollegeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\College;
use App\Models\CollegeTopic;
use App\Models\CollegeView;
use App\Models\CollegeUpdate;
use Illuminate\Support\Carbon;

class CollegeController extends AppBaseController
{
    private $collegeRepository;

    public function __construct(CollegeRepository $collegeRepo)
    {
        $this->collegeRepository = $collegeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null)
        {
            $college_p = $request -> college_p;
            $user_id = Auth::user()->id;
            
            $this->collegeRepository->pushCriteria(new RequestCriteria($request));
            
            $college = College::where('user_id', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'college_p');
            $colleges_list = College::where('user_id', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
        
            return view('colleges.index')
                ->with('colleges', $college)
                ->with('college_p', $college_p)
                ->with('colleges_list', $colleges_list);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        $user_id = Auth::user()->id;
        
        if(Auth::user() != null)
        {
            $colleges_list = College::where('user_id', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            
            return view('colleges.create')
                ->with('user_id', $user_id)
                ->with('colleges_list', $colleges_list);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $college = $this->collegeRepository->create($input);
            
            if($college -> user_id == $user_id)
            {
                DB::table('college_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_id' => $college -> id]);
                DB::table('recent_activities')->insert(['name' => $college -> name, 'status' => 'active', 'type' => 'c_c', 'user_id' => $user_id, 'entity_id' => $college -> id, 'created_at' => $now]);
                
                Flash::success('College saved successfully.');
                return redirect(route('colleges.index'));
            }
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
            $college_topic_p = $request -> college_topic_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $college = $this->collegeRepository->findWithoutFail($id);
            
            if(empty($college))
            {
                Flash::error('College not found');
                return redirect(route('colleges.index'));
            }
            
            $userColleges = DB::table('user_colleges')->where('college_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userColleges as $userCollege)
            {
                if($userCollege -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $college -> user_id || $isShared)
            {
                DB::table('college_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_id' => $id]);
                DB::table('colleges')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
                
                $college = $this->collegeRepository->findWithoutFail($id);
                $collegeTopics = CollegeTopic::where('college_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'college_topic_p');
                $collegeTopicCount = DB::table('college_topics')->where('college_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->count();
                $collegeTopicList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->where('college_id' , '=', $id)->where(function ($query) {$query->where('college_topics.deleted_at', '=', null);})->orderBy('college_topics.views_quantity', 'desc')->limit(5)->get();
                $collegeTopicSectionList = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->where('college_id' , '=', $id)->where(function ($query) {$query->where('college_topic_sections.deleted_at', '=', null);})->orderBy('college_topic_sections.views_quantity', 'desc')->limit(5)->get();
                $collegeViews = DB::table('users')->join('college_views', 'users.id', '=', 'college_views.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeUpdates = DB::table('users')->join('college_updates', 'users.id', '=', 'college_updates.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $collegeTodolist = DB::table('colleges')->join('college_todolists', 'colleges.id', '=', 'college_todolists.college_id')->where('college_todolists.college_id', '=', $college -> id)->where(function ($query) {$query->where('college_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_todolists.status', '=', 'active');})->orderBy('college_todolists.datetime', 'desc')->limit(50)->get();
                $collegeTodolistCompleted = DB::table('colleges')->join('college_todolists', 'colleges.id', '=', 'college_todolists.college_id')->where('college_todolists.college_id', '=', $college -> id)->where(function ($query) {$query->where('college_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_todolists.deleted_at', '=', null);})->orderBy('college_todolists.datetime', 'desc')->limit(50)->get();
                $user = DB::table('colleges')->join('users', 'colleges.user_id', '=', 'users.id')->where('colleges.id', '=', $id)->get();
                
                $collegeTopicsList = CollegeTopic::where('college_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $collegeTodolistsList = DB::table('colleges')->join('college_todolists', 'colleges.id', '=', 'college_todolists.college_id')->where('college_todolists.college_id', '=', $college -> id)->where(function ($query) {$query->where('college_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_todolists.status', '=', 'active');})->orderBy('college_todolists.datetime', 'desc')->limit(5)->get();
                $collegeTodolistsCompletedList = DB::table('colleges')->join('college_todolists', 'colleges.id', '=', 'college_todolists.college_id')->where('college_todolists.college_id', '=', $college -> id)->where(function ($query) {$query->where('college_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_todolists.deleted_at', '=', null);})->orderBy('college_todolists.datetime', 'desc')->limit(5)->get();
                $userCollegesList = DB::table('user_colleges')->join('users', 'user_colleges.user_id', '=', 'users.id')->select('name', 'email', 'user_colleges.description', 'permissions', 'user_colleges.datetime', 'user_colleges.id', 'college_id', 'users.id as user_id')->where('college_id', $id)->where(function ($query) {$query->where('user_colleges.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeViewsList = DB::table('users')->join('college_views', 'users.id', '=', 'college_views.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeUpdatesList = DB::table('users')->join('college_updates', 'users.id', '=', 'college_updates.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                
                return view('colleges.show')
                    ->with('college', $college)
                    ->with('collegeTopics', $collegeTopics)
                    ->with('collegeTopicCount', $collegeTopicCount)
                    ->with('collegeTopicList', $collegeTopicList)
                    ->with('collegeTopicSectionList', $collegeTopicSectionList)
                    ->with('collegeViews', $collegeViews)
                    ->with('collegeUpdates', $collegeUpdates)
                    ->with('collegeTodolist', $collegeTodolist)
                    ->with('collegeTodolistCompleted', $collegeTodolistCompleted)
                    ->with('college_topic_p', $college_topic_p)
                    ->with('user_id', $user_id)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('collegeTopicsList', $collegeTopicsList)
                    ->with('collegeTodolistsList', $collegeTodolistsList)
                    ->with('collegeTodolistsCompletedList', $collegeTodolistsCompletedList)
                    ->with('userCollegesList', $userCollegesList)
                    ->with('collegeViewsList', $collegeViewsList)
                    ->with('collegeUpdatesList', $collegeUpdatesList);
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
            $college = $this->collegeRepository->findWithoutFail($id);
    
            if(empty($college))
            {
                Flash::error('College not found');
                return redirect(route('colleges.index'));
            }
            
            $userColleges = DB::table('user_colleges')->where('college_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userColleges as $userCollege)
            {
                if($userCollege -> user_id == $user_id && $userCollege -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $college -> user_id || $isShared)
            {
                $collegeTopicsList = CollegeTopic::where('college_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $collegeTodolistsList = DB::table('colleges')->join('college_todolists', 'colleges.id', '=', 'college_todolists.college_id')->where('college_todolists.college_id', '=', $college -> id)->where(function ($query) {$query->where('college_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('college_todolists.status', '=', 'active');})->orderBy('college_todolists.datetime', 'desc')->limit(5)->get();
                $collegeTodolistsCompletedList = DB::table('colleges')->join('college_todolists', 'colleges.id', '=', 'college_todolists.college_id')->where('college_todolists.college_id', '=', $college -> id)->where(function ($query) {$query->where('college_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('college_todolists.deleted_at', '=', null);})->orderBy('college_todolists.datetime', 'desc')->limit(5)->get();
                $userCollegesList = DB::table('user_colleges')->join('users', 'user_colleges.user_id', '=', 'users.id')->select('name', 'email', 'user_colleges.description', 'permissions', 'user_colleges.datetime', 'user_colleges.id', 'college_id', 'users.id as user_id')->where('college_id', $id)->where(function ($query) {$query->where('user_colleges.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeViewsList = DB::table('users')->join('college_views', 'users.id', '=', 'college_views.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeUpdatesList = DB::table('users')->join('college_updates', 'users.id', '=', 'college_updates.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                
                return view('colleges.edit')
                    ->with('college', $college)
                    ->with('user_id', $user_id)
                    ->with('collegeTopicsList', $collegeTopicsList)
                    ->with('collegeTodolistsList', $collegeTodolistsList)
                    ->with('collegeTodolistsCompletedList', $collegeTodolistsCompletedList)
                    ->with('userCollegesList', $userCollegesList)
                    ->with('collegeViewsList', $collegeViewsList)
                    ->with('collegeUpdatesList', $collegeUpdatesList);
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

    public function update($id, UpdateCollegeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $college = $this->collegeRepository->findWithoutFail($id);
    
            if(empty($college))
            {
                Flash::error('College not found');
                return redirect(route('colleges.index'));
            }
    
            $userColleges = DB::table('user_colleges')->where('college_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userColleges as $userCollege)
            {
                if($userCollege -> user_id == $user_id && $userCollege -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
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
            
            if(($user_id == $college -> user_id || $isShared) && $size <= 1073741824)
            {
                $newCollege = $this->collegeRepository->update($request->all(), $id);
                $specific_info_size = strlen($request -> specific_info);
    
                DB::table('colleges')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1'), 'specific_info_size' => $specific_info_size]);
                DB::table('college_updates')->insert(['actual_name' => $newCollege -> name, 'past_name' => $college -> name, 'datetime' => $now, 'college_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $college -> name, 'status' => 'active', 'type' => 'c_u', 'user_id' => $user_id, 'entity_id' => $college -> id, 'created_at' => $now]);
        
                Flash::success('College updated successfully.');
                return redirect(route('colleges.show', [$id]));
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
            $college = $this->collegeRepository->findWithoutFail($id);
            
            if(empty($college))
            {
                Flash::error('College not found');
                return redirect(route('colleges.index'));
            }
            
            if($user_id == $college -> user_id)
            {
                $collegeTopics = DB::table('college_topics')->where('college_id', '=', $college -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_colleges')->where('college_id', $college -> id)->update(['deleted_at' => $now]);
                
                $userCollege = DB::table('user_colleges')->where('college_id', '=', $college -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userCollege == null)
                {
                    DB::table('user_college_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_id' => $userCollege[0] -> id]);
                }
        
                foreach($collegeTopics as $collegeTopic)
                {
                    $collegeTopicSections = DB::table('college_topic_sections')->where('college_topic_id', '=', $collegeTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_college_topics')->where('college_topic_id', $collegeTopic -> id)->update(['deleted_at' => $now]);
                    
                    $userCollegeTopic = DB::table('user_college_topics')->where('college_topic_id', '=', $collegeTopic -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userCollegeTopic == null)
                    {
                        DB::table('user_college_topic_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_id' => $userCollegeTopic[0] -> id]);
                    }
                    
                    foreach($collegeTopicSections as $collegeTopicSection)
                    {
                        $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                        DB::table('user_college_topic_sections')->where('college_topic_section_id', $collegeTopicSection -> id)->update(['deleted_at' => $now]);
                        
                        $userCollegeTopicSection = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userCollegeTopicSection == null)
                        {
                            DB::table('user_college_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_id' => $userCollegeTopicSection[0] -> id]);
                        }
                        
                        foreach($collegeTSFiles as $collegeTSFile)
                        {
                            DB::table('user_college_t_s_files')->where('college_t_s_file_id', $collegeTSFile -> id)->update(['deleted_at' => $now]);
                            
                            $userCollegeTSFile = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $collegeTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                            if($userCollegeTSFile == null)
                            {
                                DB::table('user_college_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile[0] -> id]);
                            }
                        }
        
                        $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                        foreach($collegeTSNotes as $collegeTSNote)
                        {
                            DB::table('user_college_t_s_notes')->where('college_t_s_note_id', $collegeTSNote -> id)->update(['deleted_at' => $now]);
                            
                            $userCollegeTSNote = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $collegeTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                            if($userCollegeTSNote == null)
                            {
                                DB::table('user_college_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote[0] -> id]);
                            }
                        }
                        
                        $collegeTSGaleries = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                        foreach($collegeTSGaleries as $collegeTSGalery)
                        {
                            $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $collegeTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                            DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', $collegeTSGalery -> id)->update(['deleted_at' => $now]);
                            
                            $userCollegeTSGalery = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $collegeTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                            if($userCollegeTSGalery == null)
                            {
                                DB::table('user_college_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalery[0] -> id]);
                            }
        
                            foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                            {
                                DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', $collegeTSGaleryImage -> id)->update(['deleted_at' => $now]);
                                
                                $userCollegeTSGaleryImage = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $collegeTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                
                                if($userCollegeTSGaleryImage == null)
                                {
                                    DB::table('user_college_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage[0] -> id]);
                                }
                            }
                        }
                        
                        $collegeTSPlaylists = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                        foreach($collegeTSPlaylists as $collegeTSPlaylist)
                        {
                            $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                            DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', $collegeTSPlaylist -> id)->update(['deleted_at' => $now]);
                            
                            $userCollegeTSPlaylist = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                            if($userCollegeTSPlaylist == null)
                            {
                                DB::table('u_c_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist[0] -> id]);
                            }
                            
                            foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                            {
                                DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', $collegeTSPlaylistAudio -> id)->update(['deleted_at' => $now]);
                                
                                $userCollegeTSPlaylistAudio = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $collegeTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                
                                if($userCollegeTSPlaylistAudio == null)
                                {
                                    DB::table('u_c_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPlaylistAudio[0] -> id]);
                                }
                            }
                        }
                        
                        $collegeTSTools = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                        foreach($collegeTSTools as $collegeTSTool)
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
                        }
                    }
                }
                
                $this->collegeRepository->delete($id);
                $collegeTopics = DB::table('college_topics')->where('college_id', '=', $college -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($collegeTopics as $collegeTopic)
                {
                    $collegeTopicSections = DB::table('college_topic_sections')->where('college_topic_id', '=', $collegeTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('college_topics')->where('id', $collegeTopic -> id)->update(['deleted_at' => $now]);
                    DB::table('college_topic_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_topic_id' => $collegeTopic -> id]);
                    
                    foreach($collegeTopicSections as $collegeTopicSection)
                    {
                        $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                        DB::table('college_topic_sections')->where('id', $collegeTopicSection -> id)->update(['deleted_at' => $now]);
                        DB::table('college_topic_section_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_topic_section_id' => $collegeTopicSection -> id]);
                        
                        foreach($collegeTSFiles as $collegeTSFile)
                        {
                            DB::table('college_t_s_files')->where('id', $collegeTSFile -> id)->update(['deleted_at' => $now]);
                            DB::table('college_t_s_file_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_file_id' => $collegeTSFile -> id]);
                        }
        
                        $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                        foreach($collegeTSNotes as $collegeTSNote)
                        {
                            DB::table('college_t_s_notes')->where('id', $collegeTSNote -> id)->update(['deleted_at' => $now]);
                            DB::table('college_t_s_note_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_note_id' => $collegeTSNote -> id]);
                        }
                        
                        $collegeTSGaleries = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                        foreach($collegeTSGaleries as $collegeTSGalery)
                        {
                            $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $collegeTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                            DB::table('college_t_s_galeries')->where('id', $collegeTSGalery -> id)->update(['deleted_at' => $now]);
                            DB::table('college_t_s_galery_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_galery_id' => $collegeTSGalery -> id]);
        
                            foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                            {
                                DB::table('college_t_s_galery_images')->where('id', $collegeTSGaleryImage -> id)->update(['deleted_at' => $now]);
                                DB::table('college_t_s_galery_image_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_g_image_id' => $collegeTSGaleryImage -> id]);
                            }
                        }
                        
                        $collegeTSPlaylists = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                        foreach($collegeTSPlaylists as $collegeTSPlaylist)
                        {
                            $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                            DB::table('college_t_s_playlists')->where('id', $collegeTSPlaylist -> id)->update(['deleted_at' => $now]);
                            DB::table('college_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_p_id' => $collegeTSPlaylist -> id]);
                            
                            foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                            {
                                DB::table('college_t_s_p_audios')->where('id', $collegeTSPlaylistAudio -> id)->update(['deleted_at' => $now]);
                                DB::table('college_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'c_t_s_p_a_id' => $collegeTSPlaylistAudio -> id]);
                            }
                        }
                        
                        $collegeTSTools = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                        foreach($collegeTSTools as $collegeTSTool)
                        {
                            $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                            DB::table('college_t_s_tools')->where('id', $collegeTSTool -> id)->update(['deleted_at' => $now]);
                            DB::table('college_t_s_tool_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_tool_id' => $collegeTSTool -> id]);
                        
                            foreach($collegeTSToolFiles as $collegeTSToolFile)
                            {
                                DB::table('college_t_s_tool_files')->where('id', $collegeTSToolFile -> id)->update(['deleted_at' => $now]);
                                DB::table('college_t_s_tool_file_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_t_s_t_file_id' => $collegeTSToolFile -> id]);
                            }
                        }
                    }
                }
                
                DB::table('college_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'college_id' => $college -> id]);
                DB::table('recent_activities')->insert(['name' => $college -> name, 'status' => 'active', 'type' => 'c_d', 'user_id' => $user_id, 'entity_id' => $college -> id, 'created_at' => $now]);
        
                Flash::success('College deleted successfully.');
                return redirect(route('colleges.index'));
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