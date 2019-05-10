<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCollegeTopicRequest;
use App\Http\Requests\UpdateUserCollegeTopicRequest;
use App\Repositories\UserCollegeTopicRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CollegeTopicSection;

class UserCollegeTopicController extends AppBaseController
{
    private $userCollegeTopicRepository;

    public function __construct(UserCollegeTopicRepository $userCollegeTopicRepo)
    {
        $this->userCollegeTopicRepository = $userCollegeTopicRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTopicRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTopics = $this->userCollegeTopicRepository->all();
    
            return view('user_college_topics.index')
                ->with('userCollegeTopics', $userCollegeTopics);
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
            
            $collegeTopicSectionsList = CollegeTopicSection::where('college_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $userCollegeTopicsList = DB::table('user_college_topics')->join('users', 'user_college_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_college_topics.description', 'permissions', 'user_college_topics.datetime', 'user_college_topics.id', 'college_topic_id')->where('college_topic_id', $id)->where(function ($query) {$query->where('user_college_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTopicViewsList = DB::table('users')->join('college_topic_views', 'users.id', '=', 'college_topic_views.user_id')->where('college_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTopicUpdatesList = DB::table('users')->join('college_topic_updates', 'users.id', '=', 'college_topic_updates.user_id')->where('college_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_college_topics.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('collegeTopicSectionsList', $collegeTopicSectionsList)
                ->with('userCollegeTopicsList', $userCollegeTopicsList)
                ->with('collegeTopicViewsList', $collegeTopicViewsList)
                ->with('collegeTopicUpdatesList', $collegeTopicUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTopicRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('college_topics')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_topics.id', '=', $request -> college_topic_id)->get();
            
            $userCollegeTopicCheck = DB::table('user_college_topics')->where('user_id', '=', $request -> user_id)->where('college_topic_id', '=', $request -> college_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userCollegeTopicCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userCollegeTopic = $this->userCollegeTopicRepository->create($input);
                    $collegeTopicSections = DB::table('college_topic_sections')->where('college_topic_id', '=', $userCollegeTopic -> college_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_college_topic_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_id' => $userCollegeTopic -> id]);
                    
                    foreach($collegeTopicSections as $collegeTopicSection)
                    {
                        DB::table('user_college_topic_sections')->insert(['datetime' => $now, 'user_id' => $userCollegeTopic  -> user_id, 'description' => $userCollegeTopic  -> description, 'college_topic_section_id' => $collegeTopicSection -> id]);
                                
                        $userCollegeTopicSection = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                
                        if(isset($userCollegeTopicSection[0]))
                        {
                            DB::table('user_college_topic_section_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_id' => $userCollegeTopicSection[0] -> id]);
                                    
                            $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                            foreach($collegeTSFiles as $collegeTSFile)
                            {
                                DB::table('user_college_t_s_files')->insert(['datetime' => $now, 'user_id' => $userCollegeTopic  -> user_id, 'description' => $userCollegeTopic  -> description, 'college_t_s_file_id' => $collegeTSFile -> id]);
                                        
                                $userCollegeTSFile = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $collegeTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                if(isset($userCollegeTSFile[0]))
                                {
                                    DB::table('user_college_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile[0] -> id]);
                                }
                            }
                    
                            $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                            foreach($collegeTSNotes as $collegeTSNote)
                            {
                                DB::table('user_college_t_s_notes')->insert(['datetime' => $now, 'user_id' => $userCollegeTopic  -> user_id, 'description' => $userCollegeTopic  -> description, 'college_t_s_note_id' => $collegeTSNote -> id]);
                                        
                                $userCollegeTSNote = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $collegeTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                if(isset($userCollegeTSNote[0]))
                                {
                                    DB::table('user_college_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote[0] -> id]);
                                }
                            }
                                        
                            $collegeTSGaleries = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($collegeTSGaleries as $collegeTSGalery)
                            {
                                DB::table('user_college_t_s_galeries')->insert(['datetime' => $now, 'user_id' => $userCollegeTopic  -> user_id, 'description' => $userCollegeTopic  -> description, 'college_t_s_galery_id' => $collegeTSGalery -> id]);
                                        
                                $userCollegeTSGalery = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $collegeTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                if(isset($userCollegeTSGalery[0]))
                                {
                                    DB::table('user_college_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalery[0] -> id]);
                    
                                    $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $collegeTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                                    foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                                    {
                                        DB::table('user_college_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userCollegeTopic  -> user_id, 'description' => $userCollegeTopic  -> description, 'college_t_s_g_image_id' => $collegeTSGaleryImage -> id]);
                                                
                                        $userCollegeTSGaleryImage = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $collegeTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                        if(isset($userCollegeTSGalery[0]))
                                        {
                                            DB::table('user_college_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage[0] -> id]);
                                        }        
                                    }
                                }
                            }
                                    
                            $collegeTSPlaylists = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($collegeTSPlaylists as $collegeTSPlaylist)
                            {
                                DB::table('user_college_t_s_playlists')->insert(['datetime' => $now, 'user_id' => $userCollegeTopic  -> user_id, 'description' => $userCollegeTopic  -> description, 'c_t_s_p_id' => $collegeTSPlaylist -> id]);
                                        
                                $userCollegeTSPlaylist = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                if(isset($userCollegeTSPlaylist[0]))
                                {
                                    DB::table('u_c_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist[0] -> id]);
                                }
                                        
                                $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                        
                                foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                                {
                                    DB::table('user_college_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userCollegeTopic  -> user_id, 'description' => $userCollegeTopic  -> description, 'c_t_s_p_a_id' => $collegeTSPlaylistAudio -> id]);
                                           
                                    $userCollegeTSPlaylistAudio = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $collegeTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userCollegeTSPlaylistAudio[0]))
                                    {
                                        DB::table('u_c_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPlaylistAudio[0] -> id]);
                                    }
                                }
                            }
                                    
                            $collegeTSTools = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($collegeTSTools as $collegeTSTool)
                            {
                                DB::table('user_college_t_s_tools')->insert(['datetime' => $now, 'user_id' => $userCollegeTopic  -> user_id, 'description' => $userCollegeTopic  -> description, 'college_t_s_tool_id' => $collegeTSTool -> id]);
                                        
                                $userCollegeTSTool = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $collegeTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                if(isset($userCollegeTSTool[0]))
                                {
                                    DB::table('user_college_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool[0] -> id]);
                                            
                                    $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                                    foreach($collegeTSToolFiles as $collegeTSToolFile)
                                    {
                                        DB::table('user_college_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userCollegeTopic  -> user_id, 'description' => $userCollegeTopic  -> description, 'college_t_s_t_file_id' => $collegeTSToolFile -> id]);
                                                
                                        $userCollegeTSToolFile = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $collegeTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                        if(isset($userCollegeTSToolFile[0]))
                                        {
                                            DB::table('user_college_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile[0] -> id]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                
                    $user = DB::table('user_college_topics')->join('users', 'users.id', '=', 'user_college_topics.user_id')->where('user_college_topics.id', '=', $userCollegeTopic -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_c', 'user_id' => $user_id, 'entity_id' => $userCollegeTopic -> college_topic_id, 'created_at' => $now]);
                
                    Flash::success('User College Topic saved successfully.');
                    return redirect(route('userCollegeTopics.show', [$userCollegeTopic -> college_topic_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userCollegeTopics.show', [$request -> college_topic_id]));
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
            $userCollegeTopic = $this->userCollegeTopicRepository->findWithoutFail($id);
            $userCollegeTopics = DB::table('user_college_topics')->join('users', 'user_college_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_college_topics.description', 'permissions', 'user_college_topics.datetime', 'user_college_topics.id', 'college_topic_id')->where('college_topic_id', $id)->where(function ($query) {$query->where('user_college_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            if(empty($userCollegeTopics[0]))
            {
                Flash::error('User College Topic not found');
                return redirect(route('userCollegeTopics.create', [$id]));
            }
            
            $user = DB::table('college_topics')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_topics.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTopic = DB::table('college_topics')->where('id', '=', $userCollegeTopics[0] -> college_topic_id)->get();
                
                $collegeTopicSectionsList = CollegeTopicSection::where('college_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userCollegeTopicsList = DB::table('user_college_topics')->join('users', 'user_college_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_college_topics.description', 'permissions', 'user_college_topics.datetime', 'user_college_topics.id', 'college_topic_id')->where('college_topic_id', $id)->where(function ($query) {$query->where('user_college_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTopicViewsList = DB::table('users')->join('college_topic_views', 'users.id', '=', 'college_topic_views.user_id')->where('college_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTopicUpdatesList = DB::table('users')->join('college_topic_updates', 'users.id', '=', 'college_topic_updates.user_id')->where('college_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_college_topics.show')
                    ->with('userCollegeTopics', $userCollegeTopics)
                    ->with('id', $id)
                    ->with('collegeTopic', $collegeTopic)
                    ->with('collegeTopicSectionsList', $collegeTopicSectionsList)
                    ->with('userCollegeTopicsList', $userCollegeTopicsList)
                    ->with('collegeTopicViewsList', $collegeTopicViewsList)
                    ->with('collegeTopicUpdatesList', $collegeTopicUpdatesList);
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
            $userCollegeTopic = DB::table('users')->join('user_college_topics', 'user_college_topics.user_id', '=', 'users.id')->where('user_college_topics.id', $id)->where(function ($query) {$query->where('user_college_topics.deleted_at', '=', null);})->get();
            
            if(empty($userCollegeTopic[0]))
            {
                Flash::error('User College Topic not found');
                return redirect(route('userCollegeTopics.index'));
            }
    
            $user = DB::table('college_topics')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_topics.id', '=', $userCollegeTopic[0] -> college_topic_id)->get();
    
            $collegeTopicSectionsList = CollegeTopicSection::where('college_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $userCollegeTopicsList = DB::table('user_college_topics')->join('users', 'user_college_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_college_topics.description', 'permissions', 'user_college_topics.datetime', 'user_college_topics.id', 'college_topic_id')->where('college_topic_id', $id)->where(function ($query) {$query->where('user_college_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTopicViewsList = DB::table('users')->join('college_topic_views', 'users.id', '=', 'college_topic_views.user_id')->where('college_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTopicUpdatesList = DB::table('users')->join('college_topic_updates', 'users.id', '=', 'college_topic_updates.user_id')->where('college_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                return view('user_college_topics.edit')
                    ->with('userCollegeTopic', $userCollegeTopic)
                    ->with('id', $userCollegeTopic[0] -> college_topic_id)
                    ->with('collegeTopicSectionsList', $collegeTopicSectionsList)
                    ->with('userCollegeTopicsList', $userCollegeTopicsList)
                    ->with('collegeTopicViewsList', $collegeTopicViewsList)
                    ->with('collegeTopicUpdatesList', $collegeTopicUpdatesList);
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

    public function update($id, UpdateUserCollegeTopicRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userCollegeTopic = $this->userCollegeTopicRepository->findWithoutFail($id);
            
            if(empty($userCollegeTopic))
            {
                Flash::error('User College Topic not found');
                return redirect(route('userCollegeTopics.index'));
            }
            
            $user = DB::table('college_topics')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_topics.id', '=', $userCollegeTopic -> college_topic_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollegeTopic -> user_id;
                $userCollegeTopic = $this->userCollegeTopicRepository->update($request->all(), $id);
                $collegeTopicSections = DB::table('college_topic_sections')->where('college_topic_id', '=', $userCollegeTopic -> college_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_college_topic_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_id' => $userCollegeTopic -> id]);
                
                foreach($collegeTopicSections as $collegeTopicSection)
                {
                    $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    DB::table('user_college_topic_sections')->where('college_topic_section_id', $collegeTopicSection -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopic -> permissions]);
                            
                    $userCollegeTopicSection = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                    if(isset($userCollegeTopicSection[0]))
                    {
                        DB::table('user_college_topic_section_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_id' => $userCollegeTopicSection[0] -> id]);
                
                        foreach($collegeTSFiles as $collegeTSFile)
                        {
                            DB::table('user_college_t_s_files')->where('college_t_s_file_id', $collegeTSFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopic -> permissions]);
                                    
                            $userCollegeTSFile = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $collegeTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                             
                            if(isset($userCollegeTSFile[0]))
                            {
                                DB::table('user_college_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile[0] -> id]);
                            }
                        }
                
                        $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($collegeTSNotes as $collegeTSNote)
                        {
                            DB::table('user_college_t_s_notes')->where('college_t_s_note_id', $collegeTSNote -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopic -> permissions]);
                                    
                            $userCollegeTSNote = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $collegeTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userCollegeTSNote[0]))
                            {
                                DB::table('user_college_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote[0] -> id]);
                            }
                        }
                                
                        $collegeTSGaleries = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($collegeTSGaleries as $collegeTSGalery)
                        {
                            $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $collegeTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', $collegeTSGalery -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopic -> permissions]);
                                    
                            $userCollegeTSGalery = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $collegeTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userCollegeTSGalery[0]))
                            {
                                DB::table('user_college_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalery[0] -> id]);
                    
                                foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                                {
                                    DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', $collegeTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopic -> permissions]);
                                            
                                    $userCollegeTSGaleryImage = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $collegeTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userCollegeTSGaleryImage[0]))
                                    {
                                        DB::table('user_college_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage[0] -> id]);
                                    }
                                }
                            }
                        }
                                
                        $collegeTSPlaylists = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($collegeTSPlaylists as $collegeTSPlaylist)
                        {
                            $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', $collegeTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopic -> permissions]);
                                    
                            $userCollegeTSPlaylist = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userCollegeTSPlaylist[0]))
                            {
                                DB::table('u_c_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist[0] -> id]);
                    
                                foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                                {
                                    DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', $collegeTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopic -> permissions]);
                                            
                                    $userCollegeTSPlaylistAudio = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $collegeTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userCollegeTSPlaylistAudio[0]))
                                    {
                                        DB::table('u_c_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPlaylistAudio[0] -> id]);
                                    }
                                }
                            }
                        }
                                
                        $collegeTSTools = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($collegeTSTools as $collegeTSTool)
                        {
                            $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', $collegeTSTool -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopic -> permissions]);
                                    
                            $userCollegeTSTool = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $collegeTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userCollegeTSTool[0]))
                            {
                                DB::table('user_college_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool[0] -> id]);
                                    
                                foreach($collegeTSToolFiles as $collegeTSToolFile)
                                {
                                    DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', $collegeTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTopic -> permissions]);
                                            
                                    $userCollegeTSToolFile = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $collegeTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userCollegeTSToolFile[0]))
                                    {
                                        DB::table('user_college_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile[0] -> id]);
                                    }
                                }
                            }
                        }
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_topics')->join('users', 'users.id', '=', 'user_college_topics.user_id')->where('user_college_topics.id', '=', $userCollegeTopic -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_u', 'user_id' => $user_id, 'entity_id' => $userCollegeTopic -> college_topic_id, 'created_at' => $now]);        
            
                Flash::success('User College Topic updated successfully.');
                return redirect(route('userCollegeTopics.show', [$userCollegeTopic -> college_topic_id]));
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
            $userCollegeTopic = $this->userCollegeTopicRepository->findWithoutFail($id);
            
            if(empty($userCollegeTopic))
            {
                Flash::error('User College Topic not found');
                return redirect(route('userCollegeTopics.index'));
            }
            
            $user = DB::table('college_topics')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_topics.id', '=', $userCollegeTopic -> college_topic_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollegeTopic -> user_id;
                $collegeTopicSections = DB::table('college_topic_sections')->where('college_topic_id', '=', $userCollegeTopic -> college_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_college_topic_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_id' => $userCollegeTopic -> id]);
                
                foreach($collegeTopicSections as $collegeTopicSection)
                {
                    $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                    DB::table('user_college_topic_sections')->where('college_topic_section_id', $collegeTopicSection -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                            
                    $userCollegeTopicSection = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                    if(isset($userCollegeTopicSection[0]))
                    {
                        DB::table('user_college_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_id' => $userCollegeTopicSection[0] -> id]);
                                
                        foreach($collegeTSFiles as $collegeTSFile)
                        {
                            DB::table('user_college_t_s_files')->where('college_t_s_file_id', $collegeTSFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                            $userCollegeTSFile = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $collegeTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userCollegeTSFile[0]))
                            {
                                DB::table('user_college_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile[0] -> id]);
                            }
                        }
                
                        $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($collegeTSNotes as $collegeTSNote)
                        {
                            DB::table('user_college_t_s_notes')->where('college_t_s_note_id', $collegeTSNote -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                   
                            $userCollegeTSNote = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $collegeTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userCollegeTSNote[0]))
                            {
                                DB::table('user_college_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote[0] -> id]);
                            }
                        }
                                
                        $collegeTSGaleries = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($collegeTSGaleries as $collegeTSGalery)
                        {
                            $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $collegeTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', $collegeTSGalery -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                            $userCollegeTSGalery = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $collegeTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userCollegeTSGalery[0]))
                            {
                                DB::table('user_college_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalery[0] -> id]);
                    
                                foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                                {
                                    DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', $collegeTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                                    $userCollegeTSGaleryImage = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $collegeTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userCollegeTSGaleryImage[0]))
                                    {
                                        DB::table('user_college_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage[0] -> id]);
                                    }
                                }
                            }
                        }
                                
                        $collegeTSPlaylists = DB::table('college_t_s_playlists')->where('c_t_s_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($collegeTSPlaylists as $collegeTSPlaylist)
                        {
                            $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', $collegeTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                            $userCollegeTSPlaylist = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userCollegeTSPlaylist[0]))
                            {
                                DB::table('u_c_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist[0] -> id]);
                                        
                                foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                                {
                                    DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', $collegeTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                                    $userCollegeTSPlaylistAudio = DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', '=', $collegeTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userCollegeTSPlaylistAudio[0]))
                                    {
                                        DB::table('u_c_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_a_id' => $userCollegeTSPlaylistAudio[0] -> id]);
                                    }
                                }
                            }
                        }
                                
                        $collegeTSTools = DB::table('college_t_s_tools')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($collegeTSTools as $collegeTSTool)
                        {
                            $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', $collegeTSTool -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                            $userCollegeTSTool = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $collegeTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userCollegeTSTool[0]))
                            {
                                DB::table('user_college_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool[0] -> id]);
                                    
                                foreach($collegeTSToolFiles as $collegeTSToolFile)
                                {
                                    DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', $collegeTSToolFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                                    $userCollegeTSToolFile = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $collegeTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userCollegeTSToolFile[0]))
                                    {
                                        DB::table('user_college_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile[0] -> id]);
                                    }
                                }
                            }
                        }
                    }
                }
        
                $this->userCollegeTopicRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_topics')->join('users', 'users.id', '=', 'user_college_topics.user_id')->where('user_college_topics.id', '=', $userCollegeTopic -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_d', 'user_id' => $user_id, 'entity_id' => $userCollegeTopic -> college_topic_id, 'created_at' => $now]);        
            
                Flash::success('User College Topic deleted successfully.');
                return redirect(route('userCollegeTopics.show', [$userCollegeTopic -> college_topic_id]));
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