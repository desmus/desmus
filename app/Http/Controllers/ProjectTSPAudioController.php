<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSPAudioRequest;
use App\Http\Requests\UpdateProjectTSPAudioRequest;
use App\Repositories\ProjectTSPAudioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSPAudioController extends AppBaseController
{
    private $projectTSPAudioRepository;

    public function __construct(ProjectTSPAudioRepository $projectTSPAudioRepo)
    {
        $this->projectTSPAudioRepository = $projectTSPAudioRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSPAudioRepository->pushCriteria(new RequestCriteria($request));
            $projectTSPAudios = $this->projectTSPAudioRepository->all();
    
            return view('project_t_s_p_audios.index')
                ->with('projectTSPAudios', $projectTSPAudios);
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
            $projectTSPAudiosList = DB::table('project_t_s_p_audios')->where('p_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('project_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();

            return view('project_t_s_p_audios.create')
                ->with('id', $id)
                ->with('projectTSPAudiosList', $projectTSPAudiosList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $projectTSPAudio = $this->projectTSPAudioRepository->create($input);
            
            $file = $request->file('file');
            $new_file = 'audio_' . $projectTSPAudio -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("audios/projects/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
            $size = $request->file('file')->getClientSize();
    
            DB::table('project_t_s_p_audios')->where('id', $projectTSPAudio->id)->update(['file_type' => $fileType, 'file_size' => $size]);
            DB::table('project_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_a_id' => $projectTSPAudio -> id]);
            DB::table('recent_activities')->insert(['name' => $projectTSPAudio -> name, 'status' => 'active', 'type' => 'p_t_s_p_a_c', 'user_id' => $user_id, 'entity_id' => $projectTSPAudio -> id, 'created_at' => $now]);
    
            Flash::success('Project T S P Audio saved successfully.');
            return redirect(route('projectTSPlaylists.show', [$projectTSPAudio -> p_t_s_p_id]));
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
            $projectTSPAudio = $this->projectTSPAudioRepository->findWithoutFail($id);
            
            if(empty($projectTSPAudio))
            {
                Flash::error('Project T S P Audio not found');
                return redirect(route('projectTSPAudios.index'));
            }
            
            $userProjectTSPAudios = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPAudios as $userProjectTSPAudio)
            {
                if($userProjectTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('project_t_s_p_audio_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_a_id' => $id]);
                DB::table('project_t_s_p_audios')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
                $projectTSPAudio = $this->projectTSPAudioRepository->findWithoutFail($id);
                $projectTSPAudioViews = DB::table('users')->join('project_t_s_p_audio_views', 'users.id', '=', 'project_t_s_p_audio_views.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $projectTSPAudioUpdates = DB::table('users')->join('project_t_s_p_audio_updates', 'users.id', '=', 'project_t_s_p_audio_updates.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();

                $userProjectTSPAudiosList = DB::table('user_project_t_s_p_audios')->join('users', 'user_project_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_p_audios.description', 'permissions', 'user_project_t_s_p_audios.datetime', 'user_project_t_s_p_audios.id', 'p_t_s_p_a_id')->where('p_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_project_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSPAudioViewsList = DB::table('users')->join('project_t_s_p_audio_views', 'users.id', '=', 'project_t_s_p_audio_views.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSPAudioUpdatesList = DB::table('users')->join('project_t_s_p_audio_updates', 'users.id', '=', 'project_t_s_p_audio_updates.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('project_t_s_p_audios.show')
                    ->with('projectTSPAudio', $projectTSPAudio)
                    ->with('projectTSPAudioViews', $projectTSPAudioViews)
                    ->with('projectTSPAudioUpdates', $projectTSPAudioUpdates)
                    ->with('user', $user)
                    ->with('userProjectTSPAudiosList', $userProjectTSPAudiosList)
                    ->with('projectTSPAudioViewsList', $projectTSPAudioViewsList)
                    ->with('projectTSPAudioUpdatesList', $projectTSPAudioUpdatesList);
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
            $projectTSPAudio = $this->projectTSPAudioRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudio))
            {
                Flash::error('Project T S P Audio not found');
                return redirect(route('projectTSPAudios.index'));
            }
            
            $userProjectTSPAudios = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPAudios as $userProjectTSPAudio)
            {
                if($userProjectTSPAudio -> user_id == $user_id && $userProjectTSPAudio -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $userProjectTSPAudiosList = DB::table('user_project_t_s_p_audios')->join('users', 'user_project_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_p_audios.description', 'permissions', 'user_project_t_s_p_audios.datetime', 'user_project_t_s_p_audios.id', 'p_t_s_p_a_id')->where('p_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_project_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSPAudioViewsList = DB::table('users')->join('project_t_s_p_audio_views', 'users.id', '=', 'project_t_s_p_audio_views.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSPAudioUpdatesList = DB::table('users')->join('project_t_s_p_audio_updates', 'users.id', '=', 'project_t_s_p_audio_updates.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('project_t_s_p_audios.edit')
                    ->with('projectTSPAudio', $projectTSPAudio)
                    ->with('projectTSPAudioViewsList', $projectTSPAudioViewsList)
                    ->with('projectTSPAudioUpdatesList', $projectTSPAudioUpdatesList)
                    ->with('userProjectTSPAudiosList', $userProjectTSPAudiosList);
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

    public function update($id, UpdateProjectTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $projectTSPAudio = $this->projectTSPAudioRepository->findWithoutFail($id);
    
            if(empty($projectTSPAudio))
            {
                Flash::error('Project T S P Audio not found');
                return redirect(route('projectTSPAudios.index'));
            }
            
            $userProjectTSPAudios = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSPAudios as $userProjectTSPAudio)
            {
                if($userProjectTSPAudio -> user_id == $user_id && $userProjectTSPAudio -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_p_audios.id', '=', $id)->get();
            
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
                $newProjectTSPAudio = $this->projectTSPAudioRepository->update($request->all(), $id);
        
                DB::table('project_t_s_p_audios')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('project_t_s_p_audio_updates')->insert(['actual_name' => $newProjectTSPAudio -> name, 'past_name' => $projectTSPAudio -> name, 'datetime' => $now, 'p_t_s_p_a_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $projectTSPAudio -> name, 'status' => 'active', 'type' => 'p_t_s_p_a_u', 'user_id' => $user_id, 'entity_id' => $projectTSPAudio -> id, 'created_at' => $now]);
            
                Flash::success('Project T S P Audio updated successfully.');
                return redirect(route('projectTSPAudios.show', [$projectTSPAudio -> id]));
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
            $projectTSPAudio = $this->projectTSPAudioRepository->findWithoutFail($id);
    
            if (empty($projectTSPAudio))
            {
                Flash::error('Project T S P Audio not found');
                return redirect(route('projectTSPAudios.index'));
            }
            
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', $projectTSPAudio -> id)->update(['deleted_at' => $now]);
               
                $userProjectTSPlaylistAudio = DB::table('user_project_t_s_p_audios')->where('p_t_s_p_a_id', '=', $projectTSPAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userProjectTSPlaylistAudio == null)
                {
                    DB::table('u_p_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPlaylistAudio[0] -> id]);
                }
                
                $this->projectTSPAudioRepository->delete($id);
                
                DB::table('project_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_t_s_p_a_id' => $projectTSPAudio -> id]);
                DB::table('recent_activities')->insert(['name' => $projectTSPAudio -> name, 'status' => 'active', 'type' => 'p_t_s_p_a_d', 'user_id' => $user_id, 'entity_id' => $projectTSPAudio -> id, 'created_at' => $now]);
            
                Flash::success('Project T S P Audio deleted successfully.');
                return redirect(route('projectTSPlaylists.show', [$projectTSPAudio -> p_t_s_p_id]));
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