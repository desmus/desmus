<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserJobTopicSectionRequest;
use App\Http\Requests\UpdateUserJobTopicSectionRequest;
use App\Repositories\UserJobTopicSectionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\JobTSFile;
use App\Models\JobTSNote;
use App\Models\JobTSGalerie;
use App\Models\JobTSTool;
use App\Models\JobTSPlaylist;

class UserJobTopicSectionController extends AppBaseController
{
    private $userJobTopicSectionRepository;

    public function __construct(UserJobTopicSectionRepository $userJobTopicSectionRepo)
    {
        $this->userJobTopicSectionRepository = $userJobTopicSectionRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTopicSectionRepository->pushCriteria(new RequestCriteria($request));
            $userJobTopicSections = $this->userJobTopicSectionRepository->all();
    
            return view('user_job_topic_sections.index')
                ->with('userJobTopicSections', $userJobTopicSections);
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
            
            $jobTSFilesList = JobTSFile::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $jobTSNotesList = JobTSNote::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $jobTSGaleriesList = JobTSGalerie::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $jobTSPlaylistsList = JobTSPlaylist::where('j_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $jobTSToolsList = JobTSTool::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
    
            $userJobTopicSectionsList = DB::table('user_job_topic_sections')->join('users', 'user_job_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_job_topic_sections.description', 'permissions', 'user_job_topic_sections.datetime', 'user_job_topic_sections.id', 'job_topic_section_id')->where('job_topic_section_id', $id)->where(function ($query) {$query->where('user_job_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $jobTopicSectionViewsList = DB::table('users')->join('job_topic_section_views', 'users.id', '=', 'job_topic_section_views.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $jobTopicSectionUpdatesList = DB::table('users')->join('job_topic_section_updates', 'users.id', '=', 'job_topic_section_updates.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_job_topic_sections.create', compact('select'))->with('id', $id)
                ->with('now', $now)
                ->with('jobTSFilesList', $jobTSFilesList)
                ->with('jobTSNotesList', $jobTSNotesList)
                ->with('jobTSGaleriesList', $jobTSGaleriesList)
                ->with('jobTSToolsList', $jobTSToolsList)
                ->with('jobTSPlaylistsList', $jobTSPlaylistsList)
                ->with('jobTopicSectionViewsList', $jobTopicSectionViewsList)
                ->with('jobTopicSectionUpdatesList', $jobTopicSectionUpdatesList)
                ->with('userJobTopicSectionsList', $userJobTopicSectionsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_topic_sections.id', '=', $request -> job_topic_section_id)->get();
            
            $userJobTopicSectionCheck = DB::table('user_job_topic_sections')->where('user_id', '=', $request -> user_id)->where('job_topic_section_id', '=', $request -> job_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userJobTopicSectionCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userJobTopicSection = $this->userJobTopicSectionRepository->create($input);
                    $jobTopicSection = DB::table('job_topic_sections')->where('id', '=', $userJobTopicSection -> job_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    $jobTSFiles = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $userJobTopicSection -> job_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_job_topic_section_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_id' => $userJobTopicSection -> id]);
                    
                    foreach($jobTSFiles as $jobTSFile)
                    {
                        DB::table('user_job_t_s_files')->insert(['datetime' => $now, 'user_id' => $userJobTopicSection -> user_id, 'description' => $userJobTopicSection -> description, 'job_t_s_file_id' => $jobTSFile -> id]);
                                        
                        $userJobTSFile = DB::table('user_job_t_s_files')->where('job_t_s_file_id', '=', $jobTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userJobTSFile[0]))
                        {
                            DB::table('user_job_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_f_id' => $userJobTSFile[0] -> id]);
                        }
                    }
                    
                    $jobTSNotes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($jobTSNotes as $jobTSNote)
                    {
                        DB::table('user_job_t_s_notes')->insert(['datetime' => $now, 'user_id' => $userJobTopicSection -> user_id, 'description' => $userJobTopicSection -> description, 'job_t_s_note_id' => $jobTSNote -> id]);
                                        
                        $userJobTSNote = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $jobTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userJobTSNote[0]))
                        {
                            DB::table('user_job_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_n_id' => $userJobTSNote[0] -> id]);
                        }
                    }
                                        
                    $jobTSGaleries = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($jobTSGaleries as $jobTSGalery)
                    {
                        DB::table('user_job_t_s_galeries')->insert(['datetime' => $now, 'user_id' => $userJobTopicSection -> user_id, 'description' => $userJobTopicSection -> description, 'job_t_s_galery_id' => $jobTSGalery -> id]);
                                        
                        $userJobTSGalery = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $jobTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userJobTSGalery[0]))
                        {
                            DB::table('user_job_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_id' => $userJobTSGalery[0] -> id]);
                    
                            $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $jobTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($jobTSGaleryImages as $jobTSGaleryImage)
                            {
                                DB::table('user_job_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userJobTopicSection -> user_id, 'description' => $userJobTopicSection -> description, 'job_t_s_g_image_id' => $jobTSGaleryImage -> id]);
                                                
                                $userJobTSGaleryImage = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $jobTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userJobTSGalery[0]))
                                {
                                    DB::table('user_job_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage[0] -> id]);
                                }        
                            }
                        }
                    }
                                    
                    $jobTSPlaylists = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($jobTSPlaylists as $jobTSPlaylist)
                    {
                        DB::table('user_job_t_s_playlists')->insert(['datetime' => $now, 'user_id' => $userJobTopicSection -> user_id, 'description' => $userJobTopicSection -> description, 'j_t_s_p_id' => $jobTSPlaylist -> id]);
                                        
                        $userJobTSPlaylist = DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userJobTSPlaylist[0]))
                        {
                            DB::table('u_j_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_id' => $userJobTSPlaylist[0] -> id]);
                        }
                                        
                        $jobTSPlaylistAudios = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                        
                        foreach($jobTSPlaylistAudios as $jobTSPlaylistAudio)
                        {
                            DB::table('user_job_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userJobTopicSection -> user_id, 'description' => $userJobTopicSection -> description, 'j_t_s_p_a_id' => $jobTSPlaylistAudio -> id]);
                                           
                            $userJobTSPlaylistAudio = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $jobTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userJobTSPlaylistAudio[0]))
                            {
                                DB::table('u_j_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPlaylistAudio[0] -> id]);
                            }
                        }
                    }
                                    
                    $jobTSTools = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($jobTSTools as $jobTSTool)
                    {
                        DB::table('user_job_t_s_tools')->insert(['datetime' => $now, 'user_id' => $userJobTopicSection -> user_id, 'description' => $userJobTopicSection -> description, 'job_t_s_tool_id' => $jobTSTool -> id]);
                                        
                        $userJobTSTool = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $jobTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userJobTSTool[0]))
                        {
                            DB::table('user_job_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_id' => $userJobTSTool[0] -> id]);
                                            
                            $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($jobTSToolFiles as $jobTSToolFile)
                            {
                                DB::table('user_job_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userJobTopicSection -> user_id, 'description' => $userJobTopicSection -> description, 'job_t_s_t_file_id' => $jobTSToolFile -> id]);
                                                
                                $userJobTSToolFile = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $jobTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userJobTSToolFile[0]))
                                {
                                    DB::table('user_job_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile[0] -> id]);
                                }
                            }
                        }
                    }
                    
                    $user = DB::table('user_job_topic_sections')->join('users', 'users.id', '=', 'user_job_topic_sections.user_id')->where('user_job_topic_sections.id', '=', $userJobTopicSection -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_c', 'user_id' => $user_id, 'entity_id' => $userJobTopicSection -> job_topic_section_id, 'created_at' => $now]);
                
                    Flash::success('User Job Topic Section saved successfully.');
                    return redirect(route('userJobTopicSections.show', [$userJobTopicSection -> job_topic_section_id]));
                }
            
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userJobTopicSections.show', [$request -> job_topic_section_id]));
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
            $userJobTopicSection = $this->userJobTopicSectionRepository->findWithoutFail($id);
            $userJobTopicSections = DB::table('user_job_topic_sections')->join('users', 'user_job_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_job_topic_sections.description', 'permissions', 'user_job_topic_sections.datetime', 'user_job_topic_sections.id', 'job_topic_section_id')->where('job_topic_section_id', $id)->where(function ($query) {$query->where('user_job_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            if(empty($userJobTopicSections[0]))
            {
                Flash::error('User Job Topic Section not found');
                return redirect(route('userJobTopicSections.create', [$id]));
            }
            
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_topic_sections.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $jobTopicSection = DB::table('job_topic_sections')->where('id', '=', $userJobTopicSections[0] -> job_topic_section_id)->get();
                
                $jobTSFilesList = JobTSFile::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSNotesList = JobTSNote::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSGaleriesList = JobTSGalerie::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSPlaylistsList = JobTSPlaylist::where('j_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSToolsList = JobTSTool::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
    
                $userJobTopicSectionsList = DB::table('user_job_topic_sections')->join('users', 'user_job_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_job_topic_sections.description', 'permissions', 'user_job_topic_sections.datetime', 'user_job_topic_sections.id', 'job_topic_section_id')->where('job_topic_section_id', $id)->where(function ($query) {$query->where('user_job_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTopicSectionViewsList = DB::table('users')->join('job_topic_section_views', 'users.id', '=', 'job_topic_section_views.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTopicSectionUpdatesList = DB::table('users')->join('job_topic_section_updates', 'users.id', '=', 'job_topic_section_updates.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_job_topic_sections.show')
                    ->with('userJobTopicSections', $userJobTopicSections)
                    ->with('id', $id)
                    ->with('jobTopicSection', $jobTopicSection)
                    ->with('jobTSFilesList', $jobTSFilesList)
                    ->with('jobTSNotesList', $jobTSNotesList)
                    ->with('jobTSGaleriesList', $jobTSGaleriesList)
                    ->with('jobTSToolsList', $jobTSToolsList)
                    ->with('jobTSPlaylistsList', $jobTSPlaylistsList)
                    ->with('jobTopicSectionViewsList', $jobTopicSectionViewsList)
                    ->with('jobTopicSectionUpdatesList', $jobTopicSectionUpdatesList)
                    ->with('userJobTopicSectionsList', $userJobTopicSectionsList);
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
            $userJobTopicSection = DB::table('users')->join('user_job_topic_sections', 'user_job_topic_sections.user_id', '=', 'users.id')->where('user_job_topic_sections.id', $id)->where(function ($query) {$query->where('user_job_topic_sections.deleted_at', '=', null);})->get();
            
            if(empty($userJobTopicSection[0]))
            {
                Flash::error('User Job Topic Section not found');
                return redirect(route('userJobTopicSections.index'));
            }
            
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_topic_sections.id', '=', $userJobTopicSection[0] -> job_topic_section_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $jobTSFilesList = JobTSFile::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSNotesList = JobTSNote::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSGaleriesList = JobTSGalerie::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSPlaylistsList = JobTSPlaylist::where('j_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $jobTSToolsList = JobTSTool::where('job_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
    
                $userJobTopicSectionsList = DB::table('user_job_topic_sections')->join('users', 'user_job_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_job_topic_sections.description', 'permissions', 'user_job_topic_sections.datetime', 'user_job_topic_sections.id', 'job_topic_section_id')->where('job_topic_section_id', $id)->where(function ($query) {$query->where('user_job_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTopicSectionViewsList = DB::table('users')->join('job_topic_section_views', 'users.id', '=', 'job_topic_section_views.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTopicSectionUpdatesList = DB::table('users')->join('job_topic_section_updates', 'users.id', '=', 'job_topic_section_updates.user_id')->where('job_topic_section_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_job_topic_sections.edit')
                    ->with('userJobTopicSection', $userJobTopicSection)
                    ->with('id', $userJobTopicSection[0] -> job_topic_section_id)
                    ->with('jobTSFilesList', $jobTSFilesList)
                    ->with('jobTSNotesList', $jobTSNotesList)
                    ->with('jobTSGaleriesList', $jobTSGaleriesList)
                    ->with('jobTSToolsList', $jobTSToolsList)
                    ->with('jobTSPlaylistsList', $jobTSPlaylistsList)
                    ->with('jobTopicSectionViewsList', $jobTopicSectionViewsList)
                    ->with('jobTopicSectionUpdatesList', $jobTopicSectionUpdatesList)
                    ->with('userJobTopicSectionsList', $userJobTopicSectionsList);
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

    public function update($id, UpdateUserJobTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userJobTopicSection = $this->userJobTopicSectionRepository->findWithoutFail($id);
            
            if(empty($userJobTopicSection))
            {
                Flash::error('User Job Topic Section not found');
                return redirect(route('userJobTopicSections.index'));
            }
            
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_topic_sections.id', '=', $userJobTopicSection -> job_topic_section_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userJobTopicSection -> user_id;
                $userJobTopicSection = $this->userJobTopicSectionRepository->update($request->all(), $id);
                $jobTopicSection = DB::table('job_topic_sections')->where('id', '=', $userJobTopicSection -> job_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                $jobTSFiles = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $userJobTopicSection -> job_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_job_topic_section_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_id' => $userJobTopicSection -> id]);
        
                foreach($jobTSFiles as $jobTSFile)
                {
                    DB::table('user_job_t_s_files')->where('job_t_s_file_id', $jobTSFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJobTopicSection -> permissions]);
                                    
                    $userJobTSFile = DB::table('user_job_t_s_files')->where('job_t_s_file_id', '=', $jobTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                             
                    if(isset($userJobTSFile[0]))
                    {
                        DB::table('user_job_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_f_id' => $userJobTSFile[0] -> id]);
                    }
                }
                
                $jobTSNotes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($jobTSNotes as $jobTSNote)
                {
                    DB::table('user_job_t_s_notes')->where('job_t_s_note_id', $jobTSNote -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJobTopicSection -> permissions]);
                                    
                    $userJobTSNote = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $jobTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userJobTSNote[0]))
                    {
                        DB::table('user_job_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_n_id' => $userJobTSNote[0] -> id]);
                    }
                }
                                
                $jobTSGaleries = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($jobTSGaleries as $jobTSGalery)
                {
                    $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $jobTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', $jobTSGalery -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJobTopicSection -> permissions]);
                                    
                    $userJobTSGalery = DB::table('user_job_t_s_galeries')->where('job_t_s_galery_id', '=', $jobTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userJobTSGalery[0]))
                    {
                        DB::table('user_job_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_id' => $userJobTSGalery[0] -> id]);
                    
                        foreach($jobTSGaleryImages as $jobTSGaleryImage)
                        {
                            DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', $jobTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJobTopicSection -> permissions]);
                                            
                            $userJobTSGaleryImage = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $jobTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userJobTSGaleryImage[0]))
                            {
                                DB::table('user_job_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage[0] -> id]);
                            }
                        }
                    }
                }
                                
                $jobTSPlaylists = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($jobTSPlaylists as $jobTSPlaylist)
                {
                    $jobTSPlaylistAudios = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', $jobTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJobTopicSection -> permissions]);
                                    
                    $userJobTSPlaylist = DB::table('user_job_t_s_playlists')->where('j_t_s_p_id', '=', $jobTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userJobTSPlaylist[0]))
                    {
                        DB::table('u_j_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_id' => $userJobTSPlaylist[0] -> id]);
                    
                        foreach($jobTSPlaylistAudios as $jobTSPlaylistAudio)
                        {
                            DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', $jobTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJobTopicSection -> permissions]);
                                            
                            $userJobTSPlaylistAudio = DB::table('user_job_t_s_p_audios')->where('j_t_s_p_a_id', '=', $jobTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userJobTSPlaylistAudio[0]))
                            {
                                DB::table('u_j_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_j_t_s_p_a_id' => $userJobTSPlaylistAudio[0] -> id]);
                            }
                        }
                    }
                }
                                
                $jobTSTools = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($jobTSTools as $jobTSTool)
                {
                    $jobTSToolFiles = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $jobTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', $jobTSTool -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJobTopicSection -> permissions]);
                                    
                    $userJobTSTool = DB::table('user_job_t_s_tools')->where('job_t_s_tool_id', '=', $jobTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userJobTSTool[0]))
                    {
                        DB::table('user_job_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_id' => $userJobTSTool[0] -> id]);
                                    
                        foreach($jobTSToolFiles as $jobTSToolFile)
                        {
                            DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', $jobTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJobTopicSection -> permissions]);
                                            
                            $userJobTSToolFile = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $jobTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userJobTSToolFile[0]))
                            {
                                DB::table('user_job_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_t_f_id' => $userJobTSToolFile[0] -> id]);
                            }
                        }
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_topic_sections')->join('users', 'users.id', '=', 'user_job_topic_sections.user_id')->where('user_job_topic_sections.id', '=', $userJobTopicSection -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_u', 'user_id' => $user_id, 'entity_id' => $userJobTopicSection -> job_topic_section_id, 'created_at' => $now]);
            
                Flash::success('User Job Topic Section updated successfully.');
                return redirect(route('userJobTopicSections.show', [$userJobTopicSection -> job_topic_section_id]));
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
            $user_id = Auth::user()->id;
            $userJobTopicSection = $this->userJobTopicSectionRepository->findWithoutFail($id);
            
            if(empty($userJobTopicSection))
            {
                Flash::error('User Job Topic Section not found');
                return redirect(route('userJobTopicSections.index'));
            }
            
            $user = DB::table('job_topic_sections')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_topic_sections.id', '=', $userJobTopicSection -> job_topic_section_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userJobTopicSection -> user_id;
                $jobTopicSection = DB::table('job_topic_sections')->where('id', '=', $userJobTopicSection -> job_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                $jobTSFiles = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $userJobTopicSection -> job_topic_section_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_job_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_id' => $userJobTopicSection -> id]);
        
                foreach($jobTSFiles as $jobTSFile)
                {
                    DB::table('user_job_t_s_files')->where('job_t_s_file_id', $jobTSFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                    $userJobTSFile = DB::table('user_job_t_s_files')->where('job_t_s_file_id', '=', $jobTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userJobTSFile[0]))
                    {
                        DB::table('user_job_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_f_id' => $userJobTSFile[0] -> id]);
                    }
                }
                
                $jobTSNotes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($jobTSNotes as $jobTSNote)
                {
                    DB::table('user_job_t_s_notes')->where('job_t_s_note_id', $jobTSNote -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                   
                    $userJobTSNote = DB::table('user_job_t_s_notes')->where('job_t_s_note_id', '=', $jobTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userJobTSNote[0]))
                    {
                        DB::table('user_job_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_n_id' => $userJobTSNote[0] -> id]);
                    }
                }
                                
                $jobTSGaleries = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
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
                                
                $jobTSPlaylists = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
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
                                
                $jobTSTools = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $jobTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
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
        
                $this->userJobTopicSectionRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_topic_sections')->join('users', 'users.id', '=', 'user_job_topic_sections.user_id')->where('user_job_topic_sections.id', '=', $userJobTopicSection -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_d', 'user_id' => $user_id, 'entity_id' => $userJobTopicSection -> job_topic_section_id, 'created_at' => $now]);
            
                Flash::success('User Job Topic Section deleted successfully.');
                return redirect(route('userJobTopicSections.show', [$userJobTopicSection -> job_topic_section_id]));
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