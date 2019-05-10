<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryImageRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryImageRequest;
use App\Repositories\PersonalDataTSGaleryImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryImageController extends AppBaseController
{
    private $personalDataTSGaleryImageRepository;

    public function __construct(PersonalDataTSGaleryImageRepository $personalDataTSGaleryImageRepo)
    {
        $this->personalDataTSGaleryImageRepository = $personalDataTSGaleryImageRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryImageRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryImages = $this->personalDataTSGaleryImageRepository->all();
    
            return view('personal_data_t_s_galery_images.index')
                ->with('personalDataTSGaleryImages', $personalDataTSGaleryImages);
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
            $personalDataTSGaleryImagesList = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();

            return view('personal_data_t_s_galery_images.create')
                ->with('id', $id)
                ->with('personalDataTSGaleryImagesList', $personalDataTSGaleryImagesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSGaleryImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $personalDataTSGaleryImage = $this->personalDataTSGaleryImageRepository->create($input);
            
            $file = $request->file('image');
            $new_file = 'image_' . $personalDataTSGaleryImage -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("images/personal_datas/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
            $size = $request->file('image')->getClientSize();
    
            DB::table('personal_data_t_s_galery_images')->where('id', $personalDataTSGaleryImage->id)->update(['file_type' => $fileType, 'file_size' => $size]);
            DB::table('personal_data_t_s_galery_image_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_g_i_id' => $personalDataTSGaleryImage -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSGaleryImage -> name, 'status' => 'active', 'type' => 'p_d_t_s_g_i_c', 'user_id' => $user_id, 'entity_id' => $personalDataTSGaleryImage -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Galery Image saved successfully.');
            return redirect(route('personalDataTSGaleries.show', [$personalDataTSGaleryImage -> personal_data_t_s_g_id]));
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
            $personalDataTSGaleryImage = $this->personalDataTSGaleryImageRepository->findWithoutFail($id);
            
            if(empty($personalDataTSGaleryImage))
            {
                Flash::error('PersonalData T S Galery Image not found');
                return redirect(route('personalDataTSGaleryImages.index'));
            }
            
            $userPersonalDataTSGaleryImages = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSGaleryImages as $userPersonalDataTSGaleryImage)
            {
                if($userPersonalDataTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('personal_data_t_s_galery_image_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_g_i_id' => $id]);
                DB::table('personal_data_t_s_galery_images')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
                $personalDataTSGaleryImage = $this->personalDataTSGaleryImageRepository->findWithoutFail($id);
                $personalDataTopicSectionGaleryImageViews = DB::table('users')->join('personal_data_t_s_galery_image_views', 'users.id', '=', 'personal_data_t_s_galery_image_views.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $personalDataTopicSectionGaleryImageUpdates = DB::table('users')->join('personal_data_t_s_galery_image_updates', 'users.id', '=', 'personal_data_t_s_galery_image_updates.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();

                $userPersonalDataTSGImagesList = DB::table('user_personal_data_t_s_galery_images')->join('users', 'user_personal_data_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_galery_images.description', 'permissions', 'user_personal_data_t_s_galery_images.datetime', 'user_personal_data_t_s_galery_images.id', 'p_d_t_s_g_i_id')->where('p_d_t_s_g_i_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSGaleryImageViewsList = DB::table('users')->join('personal_data_t_s_galery_image_views', 'users.id', '=', 'personal_data_t_s_galery_image_views.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSGaleryImageUpdatesList = DB::table('users')->join('personal_data_t_s_galery_image_updates', 'users.id', '=', 'personal_data_t_s_galery_image_updates.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('personal_data_t_s_galery_images.show')->with('personalDataTSGaleryImage', $personalDataTSGaleryImage)
                    ->with('personalDataTSGImageViews', $personalDataTopicSectionGaleryImageViews)
                    ->with('personalDataTSGImageUpdates', $personalDataTopicSectionGaleryImageUpdates)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('userPersonalDataTSGImagesList', $userPersonalDataTSGImagesList)
                    ->with('personalDataTSGaleryImageViewsList', $personalDataTSGaleryImageViewsList)
                    ->with('personalDataTSGaleryImageUpdatesList', $personalDataTSGaleryImageUpdatesList);
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
            $personalDataTSGaleryImage = $this->personalDataTSGaleryImageRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImage))
            {
                Flash::error('PersonalData T S Galery Image not found');
                return redirect(route('personalDataTSGaleryImages.index'));
            }
            
            $userPersonalDataTSGaleryImages = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSGaleryImages as $userPersonalDataTSGaleryImage)
            {
                if($userPersonalDataTSGaleryImage -> user_id == $user_id && $userPersonalDataTSGaleryImage -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $userPersonalDataTSGImagesList = DB::table('user_personal_data_t_s_galery_images')->join('users', 'user_personal_data_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_galery_images.description', 'permissions', 'user_personal_data_t_s_galery_images.datetime', 'user_personal_data_t_s_galery_images.id', 'p_d_t_s_g_i_id')->where('p_d_t_s_g_i_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSGaleryImageViewsList = DB::table('users')->join('personal_data_t_s_galery_image_views', 'users.id', '=', 'personal_data_t_s_galery_image_views.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSGaleryImageUpdatesList = DB::table('users')->join('personal_data_t_s_galery_image_updates', 'users.id', '=', 'personal_data_t_s_galery_image_updates.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('personal_data_t_s_galery_images.edit')
                    ->with('personalDataTSGaleryImage', $personalDataTSGaleryImage)
                    ->with('userPersonalDataTSGImagesList', $userPersonalDataTSGImagesList)
                    ->with('personalDataTSGaleryImageViewsList', $personalDataTSGaleryImageViewsList)
                    ->with('personalDataTSGaleryImageUpdatesList', $personalDataTSGaleryImageUpdatesList);
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

    public function update($id, UpdatePersonalDataTSGaleryImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSGaleryImage = $this->personalDataTSGaleryImageRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImage))
            {
                Flash::error('PersonalData T S Galery Image not found');
                return redirect(route('personalDataTSGaleryImages.index'));
            }
            
            $userPersonalDataTSGaleryImages = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSGaleryImages as $userPersonalDataTSGaleryImage)
            {
                if($userPersonalDataTSGaleryImage -> user_id == $user_id && $userPersonalDataTSGaleryImage -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galery_images.id', '=', $id)->get();
            
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
                $newPersonalDataTSGaleryImage = $this->personalDataTSGaleryImageRepository->update($request->all(), $id);
        
                DB::table('personal_data_t_s_galery_images')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('personal_data_t_s_galery_image_updates')->insert(['actual_name' => $newPersonalDataTSGaleryImage -> name, 'past_name' => $personalDataTSGaleryImage -> name, 'datetime' => $now, 'p_d_t_s_g_i_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $personalDataTSGaleryImage -> name, 'status' => 'active', 'type' => 'p_d_t_s_g_i_u', 'user_id' => $user_id, 'entity_id' => $personalDataTSGaleryImage -> id, 'created_at' => $now]);
            
                Flash::success('PersonalData T S Galery Image updated successfully.');
                return redirect(route('personalDataTSGaleryImages.show', [$id]));
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
            $personalDataTSGaleryImage = $this->personalDataTSGaleryImageRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImage))
            {
                Flash::error('PersonalData T S Galery Image not found');
                return redirect(route('personalDataTSGaleryImages.index'));
            }
            
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', $personalDataTSGaleryImage -> id)->update(['deleted_at' => $now]);
                
                $userPersonalDataTSGaleryImage = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $personalDataTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userPersonalDataTSGaleryImage == null)
                {
                    DB::table('user_personal_data_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage[0] -> id]);
                }
                
                $this->personalDataTSGaleryImageRepository->delete($id);
    
                DB::table('personal_data_t_s_galery_image_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'p_d_t_s_g_i_id' => $personalDataTSGaleryImage -> id]);
                DB::table('recent_activities')->insert(['name' => $personalDataTSGaleryImage -> name, 'status' => 'active', 'type' => 'p_d_t_s_g_i_d', 'user_id' => $user_id, 'entity_id' => $personalDataTSGaleryImage -> id, 'created_at' => $now]);
            
                Flash::success('PersonalData T S Galery Image deleted successfully.');
                return redirect(route('personalDataTSGaleries.show', [$personalDataTSGaleryImage -> personal_data_t_s_g_id]));
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