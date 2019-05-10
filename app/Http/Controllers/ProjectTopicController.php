<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTopicRequest;
use App\Http\Requests\UpdateProjectTopicRequest;
use App\Repositories\ProjectTopicRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\ProjectTopic;
use App\Models\ProjectTopicSection;
use App\Models\ProjectTopicUpdate;
use Illuminate\Support\Carbon;

class ProjectTopicController extends AppBaseController
{
    private $projectTopicRepository;

    public function __construct(ProjectTopicRepository $projectTopicRepo)
    {
        $this->projectTopicRepository = $projectTopicRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTopicRepository->pushCriteria(new RequestCriteria($request));
            $projectTopics = $this->projectTopicRepository->all();
    
            return view('project_topics.index')
                ->with('projectTopics', $projectTopics);
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
            $projectTopicsList = ProjectTopic::where('project_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();

            return view('project_topics.create')
                ->with('id', $id)
                ->with('projectTopicsList', $projectTopicsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTopicRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $projectTopic = $this->projectTopicRepository->create($input);
    
            DB::table('project_topic_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_topic_id' => $projectTopic -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTopic -> name, 'status' => 'active', 'type' => 'p_t_c', 'user_id' => $user_id, 'entity_id' => $projectTopic -> id, 'created_at' => $now]);
    
            Flash::success('Project Topic saved successfully.');
            return redirect(route('projects.show', [$projectTopic -> project_id]));
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
            $project_section_p = $request -> project_section_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $projectTopic = $this->projectTopicRepository->findWithoutFail($id);
            
            if(empty($projectTopic))
            {
                Flash::error('Project Topic not found');
                return redirect(route('projectTopics.index'));
            }
            
            $userProjectTopics = DB::table('user_project_topics')->where('project_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTopics as $userProjectTopic)
            {
                if($userProjectTopic -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_topics')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_topics.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('project_topic_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_topic_id' => $id]);
                DB::table('project_topics')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
    
                $projectTopic = $this->projectTopicRepository->findWithoutFail($id);
                $projectTopicSections = ProjectTopicSection::where('project_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->paginate(50, ['*'], 'project_section_p');
                $projectTopicSectionCount = DB::table('project_topic_sections')->where('project_topic_id', $id)->where('project_topic_id' , '=', $id)->where(function ($query) {$query->where('project_topic_sections.deleted_at', '=', null);})->count();
                $projectTopicSectionList = DB::table('project_topics')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->where('project_topic_id' , '=', $id)->where(function ($query) {$query->where('project_topic_sections.deleted_at', '=', null);})->orderBy('project_topic_sections.views_quantity', 'desc')->limit(5)->get();
                $projectTopicViews = DB::table('users')->join('project_topic_views', 'users.id', '=', 'project_topic_views.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $projectTopicUpdates = DB::table('users')->join('project_topic_updates', 'users.id', '=', 'project_topic_updates.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $projectTopicTodolist = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_todolists', 'project_topics.id', '=', 'project_topic_todolists.project_topic_id')->where('project_topic_todolists.project_topic_id', '=', $projectTopic -> id)->where(function ($query) {$query->where('project_topic_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_topic_todolists.status', '=', 'active');})->orderBy('project_topic_todolists.datetime', 'desc')->limit(50)->get();
                $projectTopicTodolistCompleted = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_todolists', 'project_topics.id', '=', 'project_topic_todolists.project_topic_id')->where('project_topic_todolists.project_topic_id', '=', $projectTopic -> id)->where(function ($query) {$query->where('project_topic_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('project_topic_todolists.deleted_at', '=', null);})->orderBy('project_topic_todolists.datetime', 'desc')->limit(50)->get();
    
                $projectTopicSectionsList = ProjectTopicSection::where('project_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $projectTopicTodolistsList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_todolists', 'project_topics.id', '=', 'project_topic_todolists.project_topic_id')->where('project_topic_todolists.project_topic_id', '=', $projectTopic -> id)->where(function ($query) {$query->where('project_topic_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_topic_todolists.status', '=', 'active');})->orderBy('project_topic_todolists.datetime', 'desc')->limit(5)->get();
                $projectTopicTodolistsCompletedList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_todolists', 'project_topics.id', '=', 'project_topic_todolists.project_topic_id')->where('project_topic_todolists.project_topic_id', '=', $projectTopic -> id)->where(function ($query) {$query->where('project_topic_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('project_topic_todolists.deleted_at', '=', null);})->orderBy('project_topic_todolists.datetime', 'desc')->limit(5)->get();
                $userProjectTopicsList = DB::table('user_project_topics')->join('users', 'user_project_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_project_topics.description', 'permissions', 'user_project_topics.datetime', 'user_project_topics.id', 'project_topic_id')->where('project_topic_id', $id)->where(function ($query) {$query->where('user_project_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTopicViewsList = DB::table('users')->join('project_topic_views', 'users.id', '=', 'project_topic_views.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTopicUpdatesList = DB::table('users')->join('project_topic_updates', 'users.id', '=', 'project_topic_updates.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                    
                return view('project_topics.show')
                    ->with('projectTopic', $projectTopic)
                    ->with('projectTopicSections', $projectTopicSections)
                    ->with('projectTopicSectionCount', $projectTopicSectionCount)
                    ->with('projectTopicSectionList', $projectTopicSectionList)
                    ->with('projectTopicViews', $projectTopicViews)
                    ->with('projectTopicUpdates', $projectTopicUpdates)
                    ->with('projectTopicTodolist', $projectTopicTodolist)
                    ->with('projectTopicTodolistCompleted', $projectTopicTodolistCompleted)
                    ->with('project_section_p', $project_section_p)
                    ->with('user_id', $user_id)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('projectTopicSectionsList', $projectTopicSectionsList)
                    ->with('projectTopicTodolistsList', $projectTopicTodolistsList)
                    ->with('projectTopicTodolistsCompletedList', $projectTopicTodolistsCompletedList)
                    ->with('userProjectTopicsList', $userProjectTopicsList)
                    ->with('projectTopicViewsList', $projectTopicViewsList)
                    ->with('projectTopicUpdatesList', $projectTopicUpdatesList);
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
            $projectTopic = $this->projectTopicRepository->findWithoutFail($id);
    
            if(empty($projectTopic))
            {
                Flash::error('Project Topic not found');
                return redirect(route('projectTopics.index'));
            }
            
            $userProjectTopics = DB::table('user_project_topics')->where('project_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTopics as $userProjectTopic)
            {
                if($userProjectTopic -> user_id == $user_id && $userProjectTopic -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_topics')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_topics.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $projectTopicSectionsList = ProjectTopicSection::where('project_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $projectTopicTodolistsList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_todolists', 'project_topics.id', '=', 'project_topic_todolists.project_topic_id')->where('project_topic_todolists.project_topic_id', '=', $projectTopic -> id)->where(function ($query) {$query->where('project_topic_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('project_topic_todolists.status', '=', 'active');})->orderBy('project_topic_todolists.datetime', 'desc')->limit(5)->get();
                $projectTopicTodolistsCompletedList = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_todolists', 'project_topics.id', '=', 'project_topic_todolists.project_topic_id')->where('project_topic_todolists.project_topic_id', '=', $projectTopic -> id)->where(function ($query) {$query->where('project_topic_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('project_topic_todolists.deleted_at', '=', null);})->orderBy('project_topic_todolists.datetime', 'desc')->limit(5)->get();
                $userProjectTopicsList = DB::table('user_project_topics')->join('users', 'user_project_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_project_topics.description', 'permissions', 'user_project_topics.datetime', 'user_project_topics.id', 'project_topic_id')->where('project_topic_id', $id)->where(function ($query) {$query->where('user_project_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTopicViewsList = DB::table('users')->join('project_topic_views', 'users.id', '=', 'project_topic_views.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTopicUpdatesList = DB::table('users')->join('project_topic_updates', 'users.id', '=', 'project_topic_updates.user_id')->where('project_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('project_topics.edit')
                    ->with('projectTopic', $projectTopic)
                    ->with('projectTopicSectionsList', $projectTopicSectionsList)
                    ->with('projectTopicTodolistsList', $projectTopicTodolistsList)
                    ->with('projectTopicTodolistsCompletedList', $projectTopicTodolistsCompletedList)
                    ->with('projectTopicViewsList', $projectTopicViewsList)
                    ->with('projectTopicUpdatesList', $projectTopicUpdatesList)
                    ->with('userProjectTopicsList', $userProjectTopicsList);
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

    public function update($id, UpdateProjectTopicRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $projectTopic = $this->projectTopicRepository->findWithoutFail($id);
    
            if(empty($projectTopic))
            {
                Flash::error('Project Topic not found');
                return redirect(route('projectTopics.index'));
            }
    
            $userProjectTopics = DB::table('user_project_topics')->where('project_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTopics as $userProjectTopic)
            {
                if($userProjectTopic -> user_id == $user_id && $userProjectTopic -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_topics')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_topics.id', '=', $id)->get();
            
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
                $newProjectTopic = $this->projectTopicRepository->update($request->all(), $id);
                $specific_info_size = strlen($request -> specific_info);
                
                DB::table('project_topics')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1'), 'specific_info_size' => $specific_info_size]);
                DB::table('project_topic_updates')->insert(['actual_name' => $newProjectTopic -> name, 'past_name' => $projectTopic -> name, 'datetime' => $now, 'project_topic_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $projectTopic -> name, 'status' => 'active', 'type' => 'p_t_u', 'user_id' => $user_id, 'entity_id' => $projectTopic -> id, 'created_at' => $now]);
                
                Flash::success('Project Topic updated successfully.');
                return redirect(route('projectTopics.show', [$id]));
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
            $projectTopic = $this->projectTopicRepository->findWithoutFail($id);
            
            if(empty($projectTopic))
            {
                Flash::error('Project Topic not found');
                return redirect(route('projectTopics.index'));
            }
            
            $user = DB::table('project_topics')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_topics.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $projectTopicSections = DB::table('project_topic_sections')->where('project_topic_id', '=', $projectTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_project_topics')->where('project_topic_id', $projectTopic -> id)->update(['deleted_at' => $now]);
                
                $userProjectTopic = DB::table('user_project_topics')->where('project_topic_id', '=', $projectTopic -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userProjectTopic == null)
                {
                    DB::table('user_project_topic_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_id' => $userProjectTopic[0] -> id]);
                }
                
                foreach($projectTopicSections as $projectTopicSection)
                {
                    $projectTSFiles = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                    DB::table('user_project_topic_sections')->where('project_topic_section_id', $projectTopicSection -> id)->update(['deleted_at' => $now]);
                    
                    $userProjectTopicSection = DB::table('user_project_topic_sections')->where('project_topic_section_id', '=', $projectTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userProjectTopicSection == null)
                    {
                        DB::table('user_project_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_id' => $userProjectTopicSection[0] -> id]);
                    }
                    
                    foreach($projectTSFiles as $projectTSFile)
                    {
                        DB::table('user_project_t_s_files')->where('project_t_s_file_id', $projectTSFile -> id)->update(['deleted_at' => $now]);
                        
                        $userProjectTSFile = DB::table('user_project_t_s_files')->where('project_t_s_file_id', '=', $projectTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userProjectTSFile == null)
                        {
                            DB::table('user_project_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_f_id' => $userProjectTSFile[0] -> id]);
                        }        
                    }
        
                    $projectTSNotes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($projectTSNotes as $projectTSNote)
                    {
                        DB::table('user_project_t_s_notes')->where('project_t_s_note_id', $projectTSNote -> id)->update(['deleted_at' => $now]);
                        
                        $userProjectTSNote = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $projectTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userProjectTSNote == null)
                        {
                            DB::table('user_project_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_n_id' => $userProjectTSNote[0] -> id]);
                        }
                    }
                        
                    $projectTSGaleries = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($projectTSGaleries as $projectTSGalery)
                    {
                        $projectTSGaleryImages = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $projectTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                        DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', $projectTSGalery -> id)->update(['deleted_at' => $now]);
                        
                        $userProjectTSGalery = DB::table('user_project_t_s_galeries')->where('project_t_s_galery_id', '=', $projectTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userProjectTSGalery == null)
                        {
                            DB::table('user_project_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_id' => $userProjectTSGalery[0] -> id]);
                        }
                        
                        foreach($projectTSGaleryImages as $projectTSGaleryImage)
                        {
                            DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', $projectTSGaleryImage -> id)->update(['deleted_at' => $now]);
                            
                            $userProjectTSGaleryImage = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $projectTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                            if($userProjectTSGaleryImage == null)
                            {
                                DB::table('user_project_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage[0] -> id]);
                            }
                        }
                    }
                        
                    $projectTSPlaylists = DB::table('project_t_s_playlists')->where('p_t_s_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($projectTSPlaylists as $projectTSPlaylist)
                    {
                        $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                        DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', $projectTSPlaylist -> id)->update(['deleted_at' => $now]);
                        
                        $userProjectTSPlaylist = DB::table('user_project_t_s_playlists')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userProjectTSPlaylist == null)
                        {
                            DB::table('u_p_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_id' => $userProjectTSPlaylist[0] -> id]);
                        }
                        
                        foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                        {
                            DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', $projectTSPlaylistAudio -> id)->update(['deleted_at' => $now]);
                            
                            $userProjectTSPlaylistAudio = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $projectTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                            if($userProjectTSPlaylistAudio == null)
                            {
                                DB::table('u_p_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPlaylistAudio[0] -> id]);
                            }
                        }
                    }
                        
                    $projectTSTools = DB::table('project_t_s_tools')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($projectTSTools as $projectTSTool)
                    {
                        $projectTSToolFiles = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $projectTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                        DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', $projectTSTool -> id)->update(['deleted_at' => $now]);
                        
                        $userProjectTSTool = DB::table('user_project_t_s_tools')->where('project_t_s_tool_id', '=', $projectTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                        
                        if($userProjectTSTool == null)
                        {
                            DB::table('user_project_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_id' => $userProjectTSTool[0] -> id]);
                        }
                        
                        foreach($projectTSToolFiles as $projectTSToolFile)
                        {
                            DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', $projectTSToolFile -> id)->update(['deleted_at' => $now]);
                            
                            $userProjectTSToolFile = DB::table('user_project_t_s_tool_files')->where('project_t_s_t_file_id', '=', $projectTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                            if($userProjectTSToolFile == null)
                            {
                                DB::table('user_project_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_t_f_id' => $userProjectTSToolFile[0] -> id]);
                            }
                        }
                    }
                }
                
                $this->projectTopicRepository->delete($id);
                $projectTopicSections = DB::table('project_topic_sections')->where('project_topic_id', '=', $projectTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                foreach($projectTopicSections as $projectTopicSection)
                {
                    $projectTSFiles = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                    DB::table('project_topic_sections')->where('id', $projectTopicSection -> id)->update(['deleted_at' => $now]);
                    DB::table('project_topic_section_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_topic_section_id' => $projectTopicSection -> id]);
                        
                    foreach($projectTSFiles as $projectTSFile)
                    {
                        DB::table('project_t_s_files')->where('id', $projectTSFile -> id)->update(['deleted_at' => $now]);
                        DB::table('project_t_s_file_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_t_s_file_id' => $projectTSFile -> id]);
                    }
        
                    $projectTSNotes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($projectTSNotes as $projectTSNote)
                    {
                        DB::table('project_t_s_notes')->where('id', $projectTSNote -> id)->update(['deleted_at' => $now]);
                        DB::table('project_t_s_note_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_t_s_note_id' => $projectTSNote -> id]);
                    }
                        
                    $projectTSGaleries = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($projectTSGaleries as $projectTSGalery)
                    {
                        $projectTSGaleryImages = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $projectTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                        DB::table('project_t_s_galeries')->where('id', $projectTSGalery -> id)->update(['deleted_at' => $now]);
                        DB::table('project_t_s_galery_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_t_s_galery_id' => $projectTSGalery -> id]);
        
                        foreach($projectTSGaleryImages as $projectTSGaleryImage)
                        {
                            DB::table('project_t_s_galery_images')->where('id', $projectTSGaleryImage -> id)->update(['deleted_at' => $now]);
                            DB::table('project_t_s_galery_image_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_t_s_g_image_id' => $projectTSGaleryImage -> id]);
                        }
                    }
                        
                    $projectTSPlaylists = DB::table('project_t_s_playlists')->where('p_t_s_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($projectTSPlaylists as $projectTSPlaylist)
                    {
                        $projectTSPlaylistAudios = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $projectTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                        DB::table('project_t_s_playlists')->where('id', $projectTSPlaylist -> id)->update(['deleted_at' => $now]);
                        DB::table('project_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_id' => $projectTSPlaylist -> id]);
                            
                        foreach($projectTSPlaylistAudios as $projectTSPlaylistAudio)
                        {
                            DB::table('project_t_s_p_audios')->where('id', $projectTSPlaylistAudio -> id)->update(['deleted_at' => $now]);
                            DB::table('project_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_a_id' => $projectTSPlaylistAudio -> id]);
                        }
                    }
                        
                    $projectTSTools = DB::table('project_t_s_tools')->where('project_topic_section_id', '=', $projectTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($projectTSTools as $projectTSTool)
                    {
                        $projectTSToolFiles = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $projectTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                        DB::table('project_t_s_tools')->where('id', $projectTSTool -> id)->update(['deleted_at' => $now]);
                        DB::table('project_t_s_tool_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_t_s_tool_id' => $projectTSTool -> id]);
                        
                        foreach($projectTSToolFiles as $projectTSToolFile)
                        {
                            DB::table('project_t_s_tool_files')->where('id', $projectTSToolFile -> id)->update(['deleted_at' => $now]);
                            DB::table('project_t_s_tool_file_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_t_s_t_file_id' => $projectTSToolFile -> id]);
                        }
                    }
                }
                
                DB::table('project_topic_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'project_topic_id' => $projectTopic -> id]);
                DB::table('recent_activities')->insert(['name' => $projectTopic -> name, 'status' => 'active', 'type' => 'p_t_d', 'user_id' => $user_id, 'entity_id' => $projectTopic -> id, 'created_at' => $now]);
            
                Flash::success('Project Topic deleted successfully.');
                return redirect(route('projects.show', [$projectTopic -> project_id]));
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