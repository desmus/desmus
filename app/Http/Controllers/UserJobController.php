<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserJobRequest;
use App\Http\Requests\UpdateUserJobRequest;
use App\Repositories\UserJobRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\JobTopic;

class UserJobController extends AppBaseController
{
    private $userJobRepository;

    public function __construct(UserJobRepository $userJobRepo)
    {
        $this->userJobRepository = $userJobRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobRepository->pushCriteria(new RequestCriteria($request));
            $userJobs = $this->userJobRepository->all();
    
            return view('user_jobs.index')
                ->with('userJobs', $userJobs);
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
            
            $jobTopicsList = JobTopic::where('job_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $userJobsList = DB::table('user_jobs')->join('users', 'user_jobs.user_id', '=', 'users.id')->select('name', 'email', 'user_jobs.description', 'permissions', 'user_jobs.datetime', 'user_jobs.id', 'job_id', 'users.id as user_id')->where('job_id', $id)->where(function ($query) {$query->where('user_jobs.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $jobViewsList = DB::table('users')->join('job_views', 'users.id', '=', 'job_views.user_id')->where('job_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $jobUpdatesList = DB::table('users')->join('job_updates', 'users.id', '=', 'job_updates.user_id')->where('job_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_jobs.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('jobTopicsList', $jobTopicsList)
                ->with('userJobsList', $userJobsList)
                ->with('jobViewsList', $jobViewsList)
                ->with('jobUpdatesList', $jobUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('jobs')->where('id', '=', $request -> job_id)->get();
            
            $userJobCheck = DB::table('user_jobs')->where('user_id', '=', $request -> user_id)->where('job_id', '=', $request -> job_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userJobCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userJob = $this->userJobRepository->create($input);
                    $jobTopics = DB::table('job_topics')->where('job_id', '=', $userJob -> job_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                    DB::table('user_job_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_id' => $userJob -> id]);
        
                    foreach($jobTopics as $jobTopic)
                    {
                        DB::table('user_job_topics')->insert(['datetime' => $now, 'user_id' => $userJob -> user_id, 'description' => $userJob -> description, 'job_topic_id' => $jobTopic -> id]);
                        
                        $userJobTopic = DB::table('user_job_topics')->where('job_topic_id', '=', $jobTopic -> id)->orderBy('datetime', 'desc')->limit(1)->get();
    
                        if(isset($userJobTopic[0]))
                        {
                            DB::table('user_job_topic_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_id' => $userJobTopic[0] -> id]);
            
                            $jobTopicSections = DB::table('job_topic_sections')->where('job_topic_id', '=', $jobTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                            foreach($jobTopicSections as $jobTopicSection)
                            {
                                DB::table('user_job_topic_sections')->insert(['datetime' => $now, 'user_id' => $userJob -> user_id, 'description' => $userJob -> description, 'job_topic_section_id' => $jobTopicSection -> id]);
                                
                                $userJobTopicSection = DB::table('user_job_topic_sections')->where('job_topic_section_id', '=', $jobTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                
                                if(isset($userJobTopicSection[0]))
                                {
                                    DB::table('user_job_topic_section_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_id' => $userJobTopicSection[0] -> id]);
                                    
                                    $jobTSFiles = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                                    foreach($jobTSFiles as $jobTSFile)
                                    {
                                        DB::table('user_job_t_s_files')->insert(['datetime' => $now, 'user_id' => $userJob -> user_id, 'description' => $userJob -> description, 'job_t_s_file_id' => $jobTSFile -> id]);
                                        
                                        $userJobTSFile = DB::table('user_job_t_s_files')->where('job_t_s_file_id', '=', $jobTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userJobTSFile[0]))
                                        {
                                            DB::table('user_job_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_f_id' => $userJobTSFile[0] -> id]);
                                        }
                                    }
                    
                                    $jobTSNotes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                                    foreach($jobTSNotes as $jobTSNote)
                                    {
                                        DB::table('user_job_t_s_notes')->insert(['datetime' => $now, 'user_id' => $userJob -> user_id, 'description' => $userJob -> description, 'job_t_s_note_id' => $jobTSNote -> id]);
                                        
                                        $userJobTSNote = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $jobTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userJobTSNote[0]))
                                        {
                                            DB::table('user_job_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_n_id' => $userJobTSNote[0] -> id]);
                                        }
                                    }
                                        
                                    $jobTSGaleries = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                                    foreach($jobTSGaleries as $jobTSGalery)
                                    {
                                        DB::table('user_job_t_s_galeries')->insert(['datetime' => $now, 'user_id' => $userJob -> user_id, 'description' => $userJob -> description, 'job_t_s_galery_id' => $jobTSGalery -> id]);
                                        
                                        $userJobTSGalery = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $jobTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userJobTSGalery[0]))
                                        {
                                            DB::table('user_job_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_id' => $userJobTSGalery[0] -> id]);
                    
                                            $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $jobTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                                            foreach($jobTSGaleryImages as $jobTSGaleryImage)
                                            {
                                                DB::table('user_job_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userJob -> user_id, 'description' => $userJob -> description, 'job_t_s_g_image_id' => $jobTSGaleryImage -> id]);
                                                
                                                $userJobTSGaleryImage = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $jobTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                                if(isset($userJobTSGalery[0]))
                                                {
                                                    DB::table('user_job_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage[0] -> id]);
                                                }        
                                            }
                                        }
                                    }
                                    
                                    $jobTSPlaylists = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                                    foreach($jobTSPlaylists as $jobTSPlaylist)
                                    {
                                        DB::table('user_job_t_s_playlists')->insert(['datetime' => $now, 'user_id' => $userJob -> user_id, 'description' => $userJob -> description, 'j_t_s_p_id' => $jobTSPlaylist -> id]);
                                        
                                        $userJobTSPlaylist = DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userJobTSPlaylist[0]))
                                        {
                                            DB::table('u_j_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_id' => $userJobTSPlaylist[0] -> id]);
                                        }
                                        
                                        $jobTSPlaylistAudios = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                        
                                        foreach($jobTSPlaylistAudios as $jobTSPlaylistAudio)
                                        {
                                            DB::table('user_job_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userJob -> user_id, 'description' => $userJob -> description, 'j_t_s_p_a_id' => $jobTSPlaylistAudio -> id]);
                                           
                                            $userJobTSPlaylistAudio = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $jobTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                            if(isset($userJobTSPlaylistAudio[0]))
                                            {
                                                DB::table('u_j_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPlaylistAudio[0] -> id]);
                                            }
                                        }
                                    }
                                    
                                    $jobTSTools = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                                    foreach($jobTSTools as $jobTSTool)
                                    {
                                        DB::table('user_job_t_s_tools')->insert(['datetime' => $now, 'user_id' => $userJob -> user_id, 'description' => $userJob -> description, 'job_t_s_tool_id' => $jobTSTool -> id]);
                                        
                                        $userJobTSTool = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $jobTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userJobTSTool[0]))
                                        {
                                            DB::table('user_job_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_id' => $userJobTSTool[0] -> id]);
                                            
                                            $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                                            foreach($jobTSToolFiles as $jobTSToolFile)
                                            {
                                                DB::table('user_job_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userJob -> user_id, 'description' => $userJob -> description, 'job_t_s_t_file_id' => $jobTSToolFile -> id]);
                                                
                                                $userJobTSToolFile = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $jobTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                                if(isset($userJobTSToolFile[0]))
                                                {
                                                    DB::table('user_job_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile[0] -> id]);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                    $user = DB::table('user_jobs')->join('users', 'users.id', '=', 'user_jobs.user_id')->where('user_jobs.id', '=', $userJob -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_c', 'user_id' => $user_id, 'entity_id' => $userJob -> job_id, 'created_at' => $now]);
                
                    Flash::success('User Job saved successfully.');
                    return redirect(route('userJobs.show', [$userJob -> job_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }

            return redirect(route('userJobs.show', [$request -> job_id]));
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
            $userJob = $this->userJobRepository->findWithoutFail($id);
            $userJobs = DB::table('user_jobs')->join('users', 'user_jobs.user_id', '=', 'users.id')->select('name', 'email', 'user_jobs.description', 'permissions', 'user_jobs.datetime', 'user_jobs.id', 'job_id', 'users.id as user_id')->where('job_id', $id)->where(function ($query) {$query->where('user_jobs.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            if(empty($userJobs[0]))
            {
                Flash::error('User Job not found');
                return redirect(route('userJobs.create', [$id]));
            }
            
            $user = DB::table('jobs')->where('id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $job = DB::table('jobs')->where('id', '=', $userJobs[0] -> job_id)->get();
        
                $jobTopicsList = JobTopic::where('job_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userJobsList = DB::table('user_jobs')->join('users', 'user_jobs.user_id', '=', 'users.id')->select('name', 'email', 'user_jobs.description', 'permissions', 'user_jobs.datetime', 'user_jobs.id', 'job_id', 'users.id as user_id')->where('job_id', $id)->where(function ($query) {$query->where('user_jobs.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobViewsList = DB::table('users')->join('job_views', 'users.id', '=', 'job_views.user_id')->where('job_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobUpdatesList = DB::table('users')->join('job_updates', 'users.id', '=', 'job_updates.user_id')->where('job_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
        
                return view('user_jobs.show')
                    ->with('userJobs', $userJobs)
                    ->with('id', $id)
                    ->with('job', $job)
                    ->with('jobTopicsList', $jobTopicsList)
                    ->with('userJobsList', $userJobsList)
                    ->with('jobViewsList', $jobViewsList)
                    ->with('jobUpdatesList', $jobUpdatesList);
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
            $userJob = DB::table('users')->join('user_jobs', 'user_jobs.user_id', '=', 'users.id')->where('user_jobs.id', $id)->where(function ($query) {$query->where('user_jobs.deleted_at', '=', null);})->get();
    
            if(empty($userJob[0]))
            {
                Flash::error('User Job not found');
                return redirect(route('userJobs.index'));
            }
            
            $user = DB::table('jobs')->where('id', '=', $userJob[0] -> job_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $jobTopicsList = JobTopic::where('job_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userJobsList = DB::table('user_jobs')->join('users', 'user_jobs.user_id', '=', 'users.id')->select('name', 'email', 'user_jobs.description', 'permissions', 'user_jobs.datetime', 'user_jobs.id', 'job_id', 'users.id as user_id')->where('job_id', $id)->where(function ($query) {$query->where('user_jobs.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobViewsList = DB::table('users')->join('job_views', 'users.id', '=', 'job_views.user_id')->where('job_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobUpdatesList = DB::table('users')->join('job_updates', 'users.id', '=', 'job_updates.user_id')->where('job_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_jobs.edit')
                    ->with('userJob', $userJob)
                    ->with('id', $userJob[0] -> job_id)
                    ->with('jobTopicsList', $jobTopicsList)
                    ->with('userJobsList', $userJobsList)
                    ->with('jobViewsList', $jobViewsList)
                    ->with('jobUpdatesList', $jobUpdatesList);
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

    public function update($id, UpdateUserJobRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userJob = $this->userJobRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userJob))
            {
                Flash::error('User Job not found');
                return redirect(route('userJobs.index'));
            }
            
            $user = DB::table('jobs')->where('id', '=', $userJob -> job_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userJob -> user_id;
                $userJob = $this->userJobRepository->update($request->all(), $id);
                $jobTopics = DB::table('job_topics')->where('job_id', '=', $userJob -> job_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_job_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_id' => $userJob -> id]);
        
                foreach($jobTopics as $jobTopic)
                {
                    $jobTopicSections = DB::table('job_topic_sections')->where('job_topic_id', '=', $jobTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_job_topics')->where('job_topic_id', $jobTopic -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJob -> permissions]);
                    
                    $userJobTopic = DB::table('user_job_topics')->where('job_topic_id', '=', $jobTopic -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if(isset($userJobTopic[0]))
                    {
                        DB::table('user_job_topic_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_id' => $userJobTopic[0] -> id]);
                                    
                        foreach($jobTopicSections as $jobTopicSection)
                        {
                            $jobTSFiles = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                            DB::table('user_job_topic_sections')->where('job_topic_section_id', $jobTopicSection -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJob -> permissions]);
                            
                            $userJobTopicSection = DB::table('user_job_topic_sections')->where('job_topic_section_id', '=', $jobTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                            if(isset($userJobTopicSection[0]))
                            {
                                DB::table('user_job_topic_section_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_id' => $userJobTopicSection[0] -> id]);
                
                                foreach($jobTSFiles as $jobTSFile)
                                {
                                    DB::table('user_job_t_s_files')->where('job_t_s_file_id', $jobTSFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJob -> permissions]);
                                    
                                    $userJobTSFile = DB::table('user_job_t_s_files')->where('job_t_s_file_id', '=', $jobTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                             
                                    if(isset($userJobTSFile[0]))
                                    {
                                        DB::table('user_job_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_f_id' => $userJobTSFile[0] -> id]);
                                    }
                                }
                
                                $jobTSNotes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                                foreach($jobTSNotes as $jobTSNote)
                                {
                                    DB::table('user_job_t_s_notes')->where('job_t_s_note_id', $jobTSNote -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJob -> permissions]);
                                    
                                    $userJobTSNote = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $jobTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userJobTSNote[0]))
                                    {
                                        DB::table('user_job_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_n_id' => $userJobTSNote[0] -> id]);
                                    }
                                }
                                
                                $jobTSGaleries = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                                foreach($jobTSGaleries as $jobTSGalery)
                                {
                                    $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $jobTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                                    DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', $jobTSGalery -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJob -> permissions]);
                                    
                                    $userJobTSGalery = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $jobTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userJobTSGalery[0]))
                                    {
                                        DB::table('user_job_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_id' => $userJobTSGalery[0] -> id]);
                    
                                        foreach($jobTSGaleryImages as $jobTSGaleryImage)
                                        {
                                            DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', $jobTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJob -> permissions]);
                                            
                                            $userJobTSGaleryImage = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $jobTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                            if(isset($userJobTSGaleryImage[0]))
                                            {
                                                DB::table('user_job_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage[0] -> id]);
                                            }
                                        }
                                    }
                                }
                                
                                $jobTSPlaylists = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                                foreach($jobTSPlaylists as $jobTSPlaylist)
                                {
                                    $jobTSPlaylistAudios = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                                    DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', $jobTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJob -> permissions]);
                                    
                                    $userJobTSPlaylist = DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userJobTSPlaylist[0]))
                                    {
                                        DB::table('u_j_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_id' => $userJobTSPlaylist[0] -> id]);
                    
                                        foreach($jobTSPlaylistAudios as $jobTSPlaylistAudio)
                                        {
                                            DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', $jobTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJob -> permissions]);
                                            
                                            $userJobTSPlaylistAudio = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $jobTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                            if(isset($userJobTSPlaylistAudio[0]))
                                            {
                                                DB::table('u_j_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPlaylistAudio[0] -> id]);
                                            }
                                        }
                                    }
                                }
                                
                                $jobTSTools = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                                foreach($jobTSTools as $jobTSTool)
                                {
                                    $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                                    DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', $jobTSTool -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJob -> permissions]);
                                    
                                    $userJobTSTool = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $jobTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userJobTSTool[0]))
                                    {
                                        DB::table('user_job_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_id' => $userJobTSTool[0] -> id]);
                                    
                                        foreach($jobTSToolFiles as $jobTSToolFile)
                                        {
                                            DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', $jobTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJob -> permissions]);
                                            
                                            $userJobTSToolFile = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $jobTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                            if(isset($userJobTSToolFile[0]))
                                            {
                                                DB::table('user_job_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile[0] -> id]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }                    
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_jobs')->join('users', 'users.id', '=', 'user_jobs.user_id')->where('user_jobs.id', '=', $userJob -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_u', 'user_id' => $user_id, 'entity_id' => $userJob -> job_id, 'created_at' => $now]);
            
                Flash::success('User Job updated successfully.');
                return redirect(route('userJobs.show', [$userJob -> job_id]));
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
            $userJob = $this->userJobRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userJob))
            {
                Flash::error('User Job not found');
                return redirect(route('userJobs.index'));
            }
            
            $user = DB::table('jobs')->where('id', '=', $userJob -> job_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userJob -> user_id;
                $jobTopics = DB::table('job_topics')->where('job_id', '=', $userJob -> job_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_job_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_id' => $userJob -> id]);
    
                foreach($jobTopics as $jobTopic)
                {
                    $jobTopicSections = DB::table('job_topic_sections')->where('job_topic_id', '=', $jobTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_job_topics')->where('job_topic_id', $jobTopic -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                    
                    $userJobTopic = DB::table('user_job_topics')->where('job_topic_id', '=', $jobTopic -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if(isset($userJobTopic[0]))
                    {
                        DB::table('user_job_topic_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_id' => $userJobTopic[0] -> id]);
                        
                        foreach($jobTopicSections as $jobTopicSection)
                        {
                            $jobTSFiles = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                            DB::table('user_job_topic_sections')->where('job_topic_section_id', $jobTopicSection -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                            
                            $userJobTopicSection = DB::table('user_job_topic_sections')->where('job_topic_section_id', '=', $jobTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                            if(isset($userJobTopicSection[0]))
                            {
                                DB::table('user_job_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_id' => $userJobTopicSection[0] -> id]);
                                
                                foreach($jobTSFiles as $jobTSFile)
                                {
                                    DB::table('user_job_t_s_files')->where('job_t_s_file_id', $jobTSFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                                    $userJobTSFile = DB::table('user_job_t_s_files')->where('job_t_s_file_id', '=', $jobTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userJobTSFile[0]))
                                    {
                                        DB::table('user_job_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_f_id' => $userJobTSFile[0] -> id]);
                                    }
                                }
                
                                $jobTSNotes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                                foreach($jobTSNotes as $jobTSNote)
                                {
                                    DB::table('user_job_t_s_notes')->where('job_t_s_note_id', $jobTSNote -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                   
                                    $userJobTSNote = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $jobTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userJobTSNote[0]))
                                    {
                                        DB::table('user_job_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_n_id' => $userJobTSNote[0] -> id]);
                                    }
                                }
                                
                                $jobTSGaleries = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                                foreach($jobTSGaleries as $jobTSGalery)
                                {
                                    $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $jobTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                                    DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', $jobTSGalery -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                                    $userJobTSGalery = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $jobTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userJobTSGalery[0]))
                                    {
                                        DB::table('user_job_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_id' => $userJobTSGalery[0] -> id]);
                    
                                        foreach($jobTSGaleryImages as $jobTSGaleryImage)
                                        {
                                            DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', $jobTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                                            $userJobTSGaleryImage = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $jobTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                            if(isset($userJobTSGaleryImage[0]))
                                            {
                                                DB::table('user_job_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage[0] -> id]);
                                            }
                                        }
                                    }
                                }
                                
                                $jobTSPlaylists = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                                foreach($jobTSPlaylists as $jobTSPlaylist)
                                {
                                    $jobTSPlaylistAudios = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                                    DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', $jobTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                                    $userJobTSPlaylist = DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userJobTSPlaylist[0]))
                                    {
                                        DB::table('u_j_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_id' => $userJobTSPlaylist[0] -> id]);
                                        
                                        foreach($jobTSPlaylistAudios as $jobTSPlaylistAudio)
                                        {
                                            DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', $jobTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                                            $userJobTSPlaylistAudio = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $jobTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                            if(isset($userJobTSPlaylistAudio[0]))
                                            {
                                                DB::table('u_j_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPlaylistAudio[0] -> id]);
                                            }
                                        }
                                    }
                                }
                                
                                $jobTSTools = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $jobTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                                foreach($jobTSTools as $jobTSTool)
                                {
                                    $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                                    DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', $jobTSTool -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                                    $userJobTSTool = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $jobTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userJobTSTool[0]))
                                    {
                                        DB::table('user_job_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_id' => $userJobTSTool[0] -> id]);
                                    
                                        foreach($jobTSToolFiles as $jobTSToolFile)
                                        {
                                            DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', $jobTSToolFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                                            $userJobTSToolFile = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $jobTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                            if(isset($userJobTSToolFile[0]))
                                            {
                                                DB::table('user_job_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile[0] -> id]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
        
                $this->userJobRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_jobs')->join('users', 'users.id', '=', 'user_jobs.user_id')->where('user_jobs.id', '=', $userJob -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_d', 'user_id' => $user_id, 'entity_id' => $userJob -> job_id, 'created_at' => $now]);
            
                Flash::success('User Job deleted successfully.');
                return redirect(route('userJobs.show', [$userJob -> job_id]));
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