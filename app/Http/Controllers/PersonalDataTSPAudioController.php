<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSPAudioRequest;
use App\Http\Requests\UpdatePersonalDataTSPAudioRequest;
use App\Repositories\PersonalDataTSPAudioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSPAudioController extends AppBaseController
{
    private $personalDataTSPAudioRepository;

    public function __construct(PersonalDataTSPAudioRepository $personalDataTSPAudioRepo)
    {
        $this->personalDataTSPAudioRepository = $personalDataTSPAudioRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSPAudioRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSPAudios = $this->personalDataTSPAudioRepository->all();
    
            return view('personal_data_t_s_p_audios.index')
                ->with('personalDataTSPAudios', $personalDataTSPAudios);
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
            $personalDataTSPAudiosList = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_p_audios.deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();

            return view('personal_data_t_s_p_audios.create')
                ->with('id', $id)
                ->with('personalDataTSPAudiosList', $personalDataTSPAudiosList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $personalDataTSPAudio = $this->personalDataTSPAudioRepository->create($input);
            
            $file = $request->file('file');
            $new_file = 'audio_' . $personalDataTSPAudio -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("audios/personal_datas/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
            $size = $request->file('file')->getClientSize();
    
            DB::table('personal_data_t_s_p_audios')->where('id', $personalDataTSPAudio->id)->update(['file_type' => $fileType, 'file_size' => $size]);
            DB::table('p_d_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_p_a_id' => $personalDataTSPAudio -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSPAudio -> name, 'status' => 'active', 'type' => 'p_d_t_s_p_a_c', 'user_id' => $user_id, 'entity_id' => $personalDataTSPAudio -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S P Audio saved successfully.');
            return redirect(route('personalDataTSPlaylists.show', [$personalDataTSPAudio -> p_d_t_s_p_id]));
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
            $personalDataTSPAudio = $this->personalDataTSPAudioRepository->findWithoutFail($id);
            
            if(empty($personalDataTSPAudio))
            {
                Flash::error('PersonalData T S P Audio not found');
                return redirect(route('personalDataTSPAudios.index'));
            }
            
            $userPersonalDataTSPAudios = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSPAudios as $userPersonalDataTSPAudio)
            {
                if($userPersonalDataTSPAudio -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('p_d_t_s_p_audio_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_p_a_id' => $id]);
                DB::table('personal_data_t_s_p_audios')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
                $personalDataTSPAudio = $this->personalDataTSPAudioRepository->findWithoutFail($id);
                $personalDataTSPAudioViews = DB::table('users')->join('p_d_t_s_p_audio_views', 'users.id', '=', 'p_d_t_s_p_audio_views.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $personalDataTSPAudioUpdates = DB::table('users')->join('p_d_t_s_p_audio_updates', 'users.id', '=', 'p_d_t_s_p_audio_updates.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                
                $userPDTSPAudiosList = DB::table('user_p_d_t_s_p_audios')->join('users', 'user_p_d_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_p_d_t_s_p_audios.description', 'permissions', 'user_p_d_t_s_p_audios.datetime', 'user_p_d_t_s_p_audios.id', 'p_d_t_s_p_a_id')->where('p_d_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_p_d_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSPAudioViewsList = DB::table('users')->join('p_d_t_s_p_audio_views', 'users.id', '=', 'p_d_t_s_p_audio_views.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSPAudioUpdatesList = DB::table('users')->join('p_d_t_s_p_audio_updates', 'users.id', '=', 'p_d_t_s_p_audio_updates.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('personal_data_t_s_p_audios.show')
                    ->with('personalDataTSPAudio', $personalDataTSPAudio)
                    ->with('personalDataTSPAudioViews', $personalDataTSPAudioViews)
                    ->with('personalDataTSPAudioUpdates', $personalDataTSPAudioUpdates)
                    ->with('user', $user)
                    ->with('userPDTSPAudiosList', $userPDTSPAudiosList)
                    ->with('personalDataTSPAudioViewsList', $personalDataTSPAudioViewsList)
                    ->with('personalDataTSPAudioUpdatesList', $personalDataTSPAudioUpdatesList);
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
            $personalDataTSPAudio = $this->personalDataTSPAudioRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPAudio))
            {
                Flash::error('PersonalData T S P Audio not found');
                return redirect(route('personalDataTSPAudios.index'));
            }
            
            $userPersonalDataTSPAudios = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSPAudios as $userPersonalDataTSPAudio)
            {
                if($userPersonalDataTSPAudio -> user_id == $user_id && $userPersonalDataTSPAudio -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $userPDTSPAudiosList = DB::table('user_p_d_t_s_p_audios')->join('users', 'user_p_d_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_p_d_t_s_p_audios.description', 'permissions', 'user_p_d_t_s_p_audios.datetime', 'user_p_d_t_s_p_audios.id', 'p_d_t_s_p_a_id')->where('p_d_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_p_d_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSPAudioViewsList = DB::table('users')->join('p_d_t_s_p_audio_views', 'users.id', '=', 'p_d_t_s_p_audio_views.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSPAudioUpdatesList = DB::table('users')->join('p_d_t_s_p_audio_updates', 'users.id', '=', 'p_d_t_s_p_audio_updates.user_id')->where('p_d_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('personal_data_t_s_p_audios.edit')
                    ->with('personalDataTSPAudio', $personalDataTSPAudio)
                    ->with('userPDTSPAudiosList', $userPDTSPAudiosList)
                    ->with('personalDataTSPAudioViewsList', $personalDataTSPAudioViewsList)
                    ->with('personalDataTSPAudioUpdatesList', $personalDataTSPAudioUpdatesList);
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

    public function update($id, UpdatePersonalDataTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSPAudio = $this->personalDataTSPAudioRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPAudio))
            {
                Flash::error('PersonalData T S P Audio not found');
                return redirect(route('personalDataTSPAudios.index'));
            }
            
            $userPersonalDataTSPAudios = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSPAudios as $userPersonalDataTSPAudio)
            {
                if($userPersonalDataTSPAudio -> user_id == $user_id && $userPersonalDataTSPAudio -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_p_audios.id', '=', $id)->get();
            
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
                $newPersonalDataTSPAudio = $this->personalDataTSPAudioRepository->update($request->all(), $id);
        
                DB::table('personal_data_t_s_p_audios')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('p_d_t_s_p_audio_updates')->insert(['actual_name' => $newPersonalDataTSPAudio -> name, 'past_name' => $personalDataTSPAudio -> name, 'datetime' => $now, 'p_d_t_s_p_a_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $personalDataTSPAudio -> name, 'status' => 'active', 'type' => 'p_d_t_s_p_a_u', 'user_id' => $user_id, 'entity_id' => $personalDataTSPAudio -> id, 'created_at' => $now]);
            
                Flash::success('PersonalData T S P Audio updated successfully.');
                return redirect(route('personalDataTSPAudios.show', [$id]));
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
            $personalDataTSPAudio = $this->personalDataTSPAudioRepository->findWithoutFail($id);
    
            if (empty($personalDataTSPAudio))
            {
                Flash::error('PersonalData T S P Audio not found');
                return redirect(route('personalDataTSPAudios.index'));
            }
            
            $user = DB::table('personal_data_t_s_p_audios')->join('personal_data_t_s_playlists', 'personal_data_t_s_p_audios.p_d_t_s_p_id', '=', 'personal_data_t_s_playlists.id')->join('personal_data_topic_sections', 'personal_data_t_s_playlists.p_d_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_p_audios.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', $personalDataTSPAudio -> id)->update(['deleted_at' => $now]);
                
                $userPersonalDataTSPlaylistAudio = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $personalDataTSPAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userPersonalDataTSPlaylistAudio == null)
                {
                    DB::table('u_p_d_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPersonalDataTSPlaylistAudio[0] -> id]);
                }
                
                $this->personalDataTSPAudioRepository->delete($id);
                
                DB::table('p_d_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_p_a_id' => $personalDataTSPAudio -> id]);
                DB::table('recent_activities')->insert(['name' => $personalDataTSPAudio -> name, 'status' => 'active', 'type' => 'p_d_t_s_p_a_d', 'user_id' => $user_id, 'entity_id' => $personalDataTSPAudio -> id, 'created_at' => $now]);
            
                Flash::success('PersonalData T S P Audio deleted successfully.');
                return redirect(route('personalDataTSPlaylists.show', [$personalDataTSPAudio -> p_d_t_s_p_id]));
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