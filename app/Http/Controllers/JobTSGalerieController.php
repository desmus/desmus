<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSGalerieRequest;
use App\Http\Requests\UpdateJobTSGalerieRequest;
use App\Repositories\JobTSGalerieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\JobTSGalerie;
use Illuminate\Support\Carbon;

class JobTSGalerieController extends AppBaseController
{
    private $jobTSGalerieRepository;

    public function __construct(JobTSGalerieRepository $jobTSGalerieRepo)
    {
        $this->jobTSGalerieRepository = $jobTSGalerieRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSGalerieRepository->pushCriteria(new RequestCriteria($request));
            $jobTSGaleries = $this->jobTSGalerieRepository->all();
    
            return view('job_t_s_galeries.index')
                ->with('jobTSGaleries', $jobTSGaleries);
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
            $jobTSGaleriesList = JobTSGalerie::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            return view('job_t_s_galeries.create')
                ->with('id', $id)
                ->with('jobTSGaleriesList', $jobTSGaleriesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSGalerieRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $jobTSGalerie = $this->jobTSGalerieRepository->create($input);
            
            DB::table('job_t_s_galery_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_galery_id' => $jobTSGalerie -> id]);
            DB::table('recent_activities')->insert(['name' => $jobTSGalerie -> name, 'status' => 'active', 'type' => 'j_t_s_g_c', 'user_id' => $user_id, 'entity_id' => $jobTSGalerie -> id, 'created_at' => $now]);
    
            Flash::success('Job T S Galerie saved successfully.');
            return redirect(route('jobTopicSections.show', [$jobTSGalerie -> job_topic_section_id]));
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
            $job_image_p = $request -> job_image_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $jobTSGalerie = $this->jobTSGalerieRepository->findWithoutFail($id);
            
            if(empty($jobTSGalerie))
            {
                Flash::error('Job T S Galerie not found');
                return redirect(route('jobTSGaleries.index'));
            }
            
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleries as $userJobTSGalerie)
            {
                if($userJobTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('job_t_s_galery_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_galery_id' => $id]);
                DB::table('job_t_s_galeries')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
                
                $jobTSGalerie = $this->jobTSGalerieRepository->findWithoutFail($id);
                $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->paginate(100, ['*'], 'job_image_p');
                $jobTopicSectionGaleryViews = DB::table('users')->join('job_t_s_galery_views', 'users.id', '=', 'job_t_s_galery_views.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $jobTopicSectionGaleryUpdates = DB::table('users')->join('job_t_s_galery_updates', 'users.id', '=', 'job_t_s_galery_updates.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $jobTSGaleryTodolist = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_galeries', 'job_topic_sections.id', '=', 'job_t_s_galeries.job_topic_section_id')->join('job_t_s_galery_todolists', 'job_t_s_galeries.id', '=', 'job_t_s_galery_todolists.j_t_s_g_id')->where('job_t_s_galery_todolists.j_t_s_g_id', '=', $jobTSGalerie -> id)->where(function ($query) {$query->where('job_t_s_galery_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_galery_todolists.status', '=', 'active');})->orderBy('job_t_s_galery_todolists.datetime', 'desc')->limit(50)->get();
                $jobTSGaleryTodolistCompleted = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_galeries', 'job_topic_sections.id', '=', 'job_t_s_galeries.job_topic_section_id')->join('job_t_s_galery_todolists', 'job_t_s_galeries.id', '=', 'job_t_s_galery_todolists.j_t_s_g_id')->where('job_t_s_galery_todolists.j_t_s_g_id', '=', $jobTSGalerie -> id)->where(function ($query) {$query->where('job_t_s_galery_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_t_s_galery_todolists.deleted_at', '=', null);})->orderBy('job_t_s_galery_todolists.datetime', 'desc')->limit(50)->get();

                $jobTSGImagesList = DB::table('job_t_s_galery_images')->where('job_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
                $jobTSGaleryTodolistsList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_galeries', 'job_topic_sections.id', '=', 'job_t_s_galeries.job_topic_section_id')->join('job_t_s_galery_todolists', 'job_t_s_galeries.id', '=', 'job_t_s_galery_todolists.j_t_s_g_id')->where('job_t_s_galery_todolists.j_t_s_g_id', '=', $jobTSGalerie -> id)->where(function ($query) {$query->where('job_t_s_galery_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_galery_todolists.status', '=', 'active');})->orderBy('job_t_s_galery_todolists.datetime', 'desc')->limit(5)->get();
                $jobTSGaleryTodolistsCompletedList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_galeries', 'job_topic_sections.id', '=', 'job_t_s_galeries.job_topic_section_id')->join('job_t_s_galery_todolists', 'job_t_s_galeries.id', '=', 'job_t_s_galery_todolists.j_t_s_g_id')->where('job_t_s_galery_todolists.j_t_s_g_id', '=', $jobTSGalerie -> id)->where(function ($query) {$query->where('job_t_s_galery_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_t_s_galery_todolists.deleted_at', '=', null);})->orderBy('job_t_s_galery_todolists.datetime', 'desc')->limit(5)->get();
                $userJobTSGaleriesList = DB::table('user_job_t_s_galeries')->join('users', 'user_job_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_galeries.description', 'permissions', 'user_job_t_s_galeries.datetime', 'user_job_t_s_galeries.id', 'job_t_s_galery_id')->where('job_t_s_galery_id', $id)->where(function ($query) {$query->where('user_job_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSGaleryViewsList = DB::table('users')->join('job_t_s_galery_views', 'users.id', '=', 'job_t_s_galery_views.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSGaleryUpdatesList = DB::table('users')->join('job_t_s_galery_updates', 'users.id', '=', 'job_t_s_galery_updates.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                            
                return view('job_t_s_galeries.show')
                    ->with('jobTSGalerie', $jobTSGalerie)
                    ->with('jobTSGaleryImages', $jobTSGaleryImages)
                    ->with('jobTSGaleryViews', $jobTopicSectionGaleryViews)
                    ->with('jobTSGaleryUpdates', $jobTopicSectionGaleryUpdates)
                    ->with('jobTSGaleryTodolist', $jobTSGaleryTodolist)
                    ->with('jobTSGaleryTodolistCompleted', $jobTSGaleryTodolistCompleted)
                    ->with('job_image_p', $job_image_p)
                    ->with('user_id', $user_id)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('jobTSGImagesList', $jobTSGImagesList)
                    ->with('jobTSGaleryTodolistsList', $jobTSGaleryTodolistsList)
                    ->with('jobTSGaleryTodolistsCompletedList', $jobTSGaleryTodolistsCompletedList)
                    ->with('userJobTSGaleriesList', $userJobTSGaleriesList)
                    ->with('jobTSGaleryViewsList', $jobTSGaleryViewsList)
                    ->with('jobTSGaleryUpdatesList', $jobTSGaleryUpdatesList);
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
            $jobTSGalerie = $this->jobTSGalerieRepository->findWithoutFail($id);
    
            if(empty($jobTSGalerie))
            {
                Flash::error('Job T S Galerie not found');
                return redirect(route('jobTSGaleries.index'));
            }
            
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleries as $userJobTSGalerie)
            {
                if($userJobTSGalerie -> user_id == $user_id && $userJobTSGalerie -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $jobTSGImagesList = DB::table('job_t_s_galery_images')->where('job_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
                $jobTSGaleryTodolistsList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_galeries', 'job_topic_sections.id', '=', 'job_t_s_galeries.job_topic_section_id')->join('job_t_s_galery_todolists', 'job_t_s_galeries.id', '=', 'job_t_s_galery_todolists.j_t_s_g_id')->where('job_t_s_galery_todolists.j_t_s_g_id', '=', $jobTSGalerie -> id)->where(function ($query) {$query->where('job_t_s_galery_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('job_t_s_galery_todolists.status', '=', 'active');})->orderBy('job_t_s_galery_todolists.datetime', 'desc')->limit(5)->get();
                $jobTSGaleryTodolistsCompletedList = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_galeries', 'job_topic_sections.id', '=', 'job_t_s_galeries.job_topic_section_id')->join('job_t_s_galery_todolists', 'job_t_s_galeries.id', '=', 'job_t_s_galery_todolists.j_t_s_g_id')->where('job_t_s_galery_todolists.j_t_s_g_id', '=', $jobTSGalerie -> id)->where(function ($query) {$query->where('job_t_s_galery_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('job_t_s_galery_todolists.deleted_at', '=', null);})->orderBy('job_t_s_galery_todolists.datetime', 'desc')->limit(5)->get();
                $userJobTSGaleriesList = DB::table('user_job_t_s_galeries')->join('users', 'user_job_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_galeries.description', 'permissions', 'user_job_t_s_galeries.datetime', 'user_job_t_s_galeries.id', 'job_t_s_galery_id')->where('job_t_s_galery_id', $id)->where(function ($query) {$query->where('user_job_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSGaleryViewsList = DB::table('users')->join('job_t_s_galery_views', 'users.id', '=', 'job_t_s_galery_views.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSGaleryUpdatesList = DB::table('users')->join('job_t_s_galery_updates', 'users.id', '=', 'job_t_s_galery_updates.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('job_t_s_galeries.edit')
                    ->with('jobTSGalerie', $jobTSGalerie)
                    ->with('jobTSGImagesList', $jobTSGImagesList)
                    ->with('jobTSGaleryTodolistsList', $jobTSGaleryTodolistsList)
                    ->with('jobTSGaleryTodolistsCompletedList', $jobTSGaleryTodolistsCompletedList)
                    ->with('userJobTSGaleriesList', $userJobTSGaleriesList)
                    ->with('jobTSGaleryViewsList', $jobTSGaleryViewsList)
                    ->with('jobTSGaleryUpdatesList', $jobTSGaleryUpdatesList);
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

    public function update($id, UpdateJobTSGalerieRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $jobTSGalerie = $this->jobTSGalerieRepository->findWithoutFail($id);
    
            if(empty($jobTSGalerie))
            {
                Flash::error('Job T S Galerie not found');
                return redirect(route('jobTSGaleries.index'));
            }
            
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSGaleries as $userJobTSGalerie)
            {
                if($userJobTSGalerie -> user_id == $user_id && $userJobTSGalerie -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
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
                $newJobTSGalerie = $this->jobTSGalerieRepository->update($request->all(), $id);
        
                DB::table('job_t_s_galeries')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('job_t_s_galery_updates')->insert(['actual_name' => $newJobTSGalerie -> name, 'past_name' => $jobTSGalerie -> name, 'datetime' => $now, 'job_t_s_galery_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $jobTSGalerie -> name, 'status' => 'active', 'type' => 'j_t_s_g_u', 'user_id' => $user_id, 'entity_id' => $jobTSGalerie -> id, 'created_at' => $now]);
            
                Flash::success('Job T S Galerie updated successfully.');
                return redirect(route('jobTSGaleries.show', [$id]));
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
            $jobTSGalerie = $this->jobTSGalerieRepository->findWithoutFail($id);
            
            if(empty($jobTSGalerie))
            {
                Flash::error('Job T S Galerie not found');
                return redirect(route('jobTSGaleries.index'));
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $jobTSGalerie -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', $jobTSGalerie -> id)->update(['deleted_at' => $now]);
                
                $userJobTSGalery = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $jobTSGalerie -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userJobTSGalery == null)
                {
                    DB::table('user_job_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_id' => $userJobTSGalery[0] -> id]);
                }
                
                foreach($jobTSGaleryImages as $jobTSGaleryImage)
                {
                    DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', $jobTSGaleryImage -> id)->update(['deleted_at' => $now]);
                    
                    $userJobTSGaleryImage = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $jobTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($userJobTSGaleryImage == null)
                    {
                        DB::table('user_job_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage[0] -> id]);
                    }
                }
                
                $this->jobTSGalerieRepository->delete($id);
                $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $jobTSGalerie -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($jobTSGaleryImages as $jobTSGaleryImage)
                {
                    DB::table('job_t_s_galery_images')->where('id', $jobTSGaleryImage -> id)->update(['deleted_at' => $now]);
                    DB::table('job_t_s_galery_image_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_g_image_id' => $jobTSGaleryImage -> id]);
                }
                
                DB::table('job_t_s_galery_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'job_t_s_galery_id' => $jobTSGalerie -> id]);
                DB::table('recent_activities')->insert(['name' => $jobTSGalerie -> name, 'status' => 'active', 'type' => 'j_t_s_g_d', 'user_id' => $user_id, 'entity_id' => $jobTSGalerie -> id, 'created_at' => $now]);
            
                Flash::success('Job T S Galerie deleted successfully.');
                return redirect(route('jobTopicSections.show', [$jobTSGalerie -> job_topic_section_id]));
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