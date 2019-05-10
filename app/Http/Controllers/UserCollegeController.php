<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCollegeRequest;
use App\Http\Requests\UpdateUserCollegeRequest;
use App\Repositories\UserCollegeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\CollegeTopic;
use Illuminate\Support\Carbon;

class UserCollegeController extends AppBaseController
{
    private $userCollegeRepository;

    public function __construct(UserCollegeRepository $userCollegeRepo)
    {
        $this->userCollegeRepository = $userCollegeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeRepository->pushCriteria(new RequestCriteria($request));
            $userColleges = $this->userCollegeRepository->all();
    
            return view('user_colleges.index')
                ->with('userColleges', $userColleges);
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
            
            $collegeTopicsList = CollegeTopic::where('college_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $userCollegesList = DB::table('user_colleges')->join('users', 'user_colleges.user_id', '=', 'users.id')->select('name', 'email', 'user_colleges.description', 'permissions', 'user_colleges.datetime', 'user_colleges.id', 'college_id', 'users.id as user_id')->where('college_id', $id)->where(function ($query) {$query->where('user_colleges.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeViewsList = DB::table('users')->join('college_views', 'users.id', '=', 'college_views.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeUpdatesList = DB::table('users')->join('college_updates', 'users.id', '=', 'college_updates.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                
            foreach($users as $user)
            {
                $select[$user->id] = $user->name;
            }
            
            return view('user_colleges.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('collegeTopicsList', $collegeTopicsList)
                ->with('userCollegesList', $userCollegesList)
                ->with('collegeViewsList', $collegeViewsList)
                ->with('collegeUpdatesList', $collegeUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('colleges')->where('id', '=', $request -> college_id)->get();
            
            $userCollegeCheck = DB::table('user_colleges')->where('user_id', '=', $request -> user_id)->where('college_id', '=', $request -> college_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userCollegeCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userCollege = $this->userCollegeRepository->create($input);
                    $collegeTopics = DB::table('college_topics')->where('college_id', '=', $userCollege -> college_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                    DB::table('user_college_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_id' => $userCollege -> id]);
        
                    foreach($collegeTopics as $collegeTopic)
                    {
                        DB::table('user_college_topics')->insert(['datetime' => $now, 'user_id' => $userCollege -> user_id, 'description' => $userCollege -> description, 'college_topic_id' => $collegeTopic -> id]);
                        
                        $userCollegeTopic = DB::table('user_college_topics')->where('college_topic_id', '=', $collegeTopic -> id)->orderBy('datetime', 'desc')->limit(1)->get();
    
                        if(isset($userCollegeTopic[0]))
                        {
                            DB::table('user_college_topic_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_id' => $userCollegeTopic[0] -> id]);
            
                            $collegeTopicSections = DB::table('college_topic_sections')->where('college_topic_id', '=', $collegeTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                            foreach($collegeTopicSections as $collegeTopicSection)
                            {
                                DB::table('user_college_topic_sections')->insert(['datetime' => $now, 'user_id' => $userCollege -> user_id, 'description' => $userCollege -> description, 'college_topic_section_id' => $collegeTopicSection -> id]);
                                
                                $userCollegeTopicSection = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                
                                if(isset($userCollegeTopicSection[0]))
                                {
                                    DB::table('user_college_topic_section_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_id' => $userCollegeTopicSection[0] -> id]);
                                    
                                    $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                                    foreach($collegeTSFiles as $collegeTSFile)
                                    {
                                        DB::table('user_college_t_s_files')->insert(['datetime' => $now, 'user_id' => $userCollege -> user_id, 'description' => $userCollege -> description, 'college_t_s_file_id' => $collegeTSFile -> id]);
                                        
                                        $userCollegeTSFile = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $collegeTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userCollegeTSFile[0]))
                                        {
                                            DB::table('user_college_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile[0] -> id]);
                                        }
                                    }
                    
                                    $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                                    foreach($collegeTSNotes as $collegeTSNote)
                                    {
                                        DB::table('user_college_t_s_notes')->insert(['datetime' => $now, 'user_id' => $userCollege -> user_id, 'description' => $userCollege -> description, 'college_t_s_note_id' => $collegeTSNote -> id]);
                                        
                                        $userCollegeTSNote = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $collegeTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userCollegeTSNote[0]))
                                        {
                                            DB::table('user_college_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_n_id' => $userCollegeTSNote[0] -> id]);
                                        }
                                    }
                                        
                                    $collegeTSGaleries = DB::table('college_t_s_galeries')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                                    foreach($collegeTSGaleries as $collegeTSGalery)
                                    {
                                        DB::table('user_college_t_s_galeries')->insert(['datetime' => $now, 'user_id' => $userCollege -> user_id, 'description' => $userCollege -> description, 'college_t_s_galery_id' => $collegeTSGalery -> id]);
                                        
                                        $userCollegeTSGalery = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $collegeTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userCollegeTSGalery[0]))
                                        {
                                            DB::table('user_college_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalery[0] -> id]);
                    
                                            $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $collegeTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                                            foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                                            {
                                                DB::table('user_college_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userCollege -> user_id, 'description' => $userCollege -> description, 'college_t_s_g_image_id' => $collegeTSGaleryImage -> id]);
                                                
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
                                        DB::table('user_college_t_s_playlists')->insert(['datetime' => $now, 'user_id' => $userCollege -> user_id, 'description' => $userCollege -> description, 'c_t_s_p_id' => $collegeTSPlaylist -> id]);
                                        
                                        $userCollegeTSPlaylist = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userCollegeTSPlaylist[0]))
                                        {
                                            DB::table('u_c_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist[0] -> id]);
                                        }
                                        
                                        $collegeTSPlaylistAudios = DB::table('college_t_s_p_audios')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                        
                                        foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                                        {
                                            DB::table('user_college_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userCollege -> user_id, 'description' => $userCollege -> description, 'c_t_s_p_a_id' => $collegeTSPlaylistAudio -> id]);
                                           
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
                                        DB::table('user_college_t_s_tools')->insert(['datetime' => $now, 'user_id' => $userCollege -> user_id, 'description' => $userCollege -> description, 'college_t_s_tool_id' => $collegeTSTool -> id]);
                                        
                                        $userCollegeTSTool = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $collegeTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                                        if(isset($userCollegeTSTool[0]))
                                        {
                                            DB::table('user_college_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool[0] -> id]);
                                            
                                            $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $collegeTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                                            foreach($collegeTSToolFiles as $collegeTSToolFile)
                                            {
                                                DB::table('user_college_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userCollege -> user_id, 'description' => $userCollege -> description, 'college_t_s_t_file_id' => $collegeTSToolFile -> id]);
                                                
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
                        }
                    }
                    
                    $user = DB::table('user_colleges')->join('users', 'users.id', '=', 'user_colleges.user_id')->where('user_colleges.id', '=', $userCollege -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_c', 'user_id' => $user_id, 'entity_id' => $userCollege -> college_id, 'created_at' => $now]);
                
                    Flash::success('User College saved successfully.');
                    return redirect(route('userColleges.show', [$userCollege -> college_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }

            return redirect(route('userColleges.show', [$request -> college_id]));
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
            $userCollege = $this->userCollegeRepository->findWithoutFail($id);
            $userColleges = DB::table('user_colleges')->join('users', 'user_colleges.user_id', '=', 'users.id')->select('name', 'email', 'user_colleges.description', 'permissions', 'user_colleges.datetime', 'user_colleges.id', 'college_id', 'users.id as user_id')->where('college_id', $id)->where(function ($query) {$query->where('user_colleges.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            if(empty($userColleges[0]))
            {
                Flash::error('User College not found');
                return redirect(route('userColleges.create', [$id]));
            }
            
            $user = DB::table('colleges')->where('id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $college = DB::table('colleges')->where('id', '=', $userColleges[0] -> college_id)->get();
                
                $collegeTopicsList = CollegeTopic::where('college_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userCollegesList = DB::table('user_colleges')->join('users', 'user_colleges.user_id', '=', 'users.id')->select('name', 'email', 'user_colleges.description', 'permissions', 'user_colleges.datetime', 'user_colleges.id', 'college_id', 'users.id as user_id')->where('college_id', $id)->where(function ($query) {$query->where('user_colleges.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeViewsList = DB::table('users')->join('college_views', 'users.id', '=', 'college_views.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeUpdatesList = DB::table('users')->join('college_updates', 'users.id', '=', 'college_updates.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
        
                return view('user_colleges.show')
                    ->with('userColleges', $userColleges)
                    ->with('id', $id)
                    ->with('college', $college)
                    ->with('collegeTopicsList', $collegeTopicsList)
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
            $userCollege = DB::table('users')->join('user_colleges', 'user_colleges.user_id', '=', 'users.id')->where('user_colleges.id', $id)->where(function ($query) {$query->where('user_colleges.deleted_at', '=', null);})->get();
    
            if (empty($userCollege[0]))
            {
                Flash::error('User College not found');
                return redirect(route('userColleges.index'));
            }
            
            $user = DB::table('colleges')->where('id', '=', $userCollege[0] -> college_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTopicsList = CollegeTopic::where('college_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userCollegesList = DB::table('user_colleges')->join('users', 'user_colleges.user_id', '=', 'users.id')->select('name', 'email', 'user_colleges.description', 'permissions', 'user_colleges.datetime', 'user_colleges.id', 'college_id', 'users.id as user_id')->where('college_id', $id)->where(function ($query) {$query->where('user_colleges.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeViewsList = DB::table('users')->join('college_views', 'users.id', '=', 'college_views.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeUpdatesList = DB::table('users')->join('college_updates', 'users.id', '=', 'college_updates.user_id')->where('college_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_colleges.edit')
                    ->with('userCollege', $userCollege)
                    ->with('id', $userCollege[0] -> college_id)
                    ->with('collegeTopicsList', $collegeTopicsList)
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

    public function update($id, UpdateUserCollegeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userCollege = $this->userCollegeRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userCollege))
            {
                Flash::error('User College not found');
                return redirect(route('userColleges.index'));
            }
            
            $user = DB::table('colleges')->where('id', '=', $userCollege -> college_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollege -> user_id;
                $userCollege = $this->userCollegeRepository->update($request->all(), $id);
                $collegeTopics = DB::table('college_topics')->where('college_id', '=', $userCollege -> college_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_college_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_id' => $userCollege -> id]);
        
                foreach($collegeTopics as $collegeTopic)
                {
                    $collegeTopicSections = DB::table('college_topic_sections')->where('college_topic_id', '=', $collegeTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_college_topics')->where('college_topic_id', $collegeTopic -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollege -> permissions]);
                    
                    $userCollegeTopic = DB::table('user_college_topics')->where('college_topic_id', '=', $collegeTopic -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if(isset($userCollegeTopic[0]))
                    {
                        DB::table('user_college_topic_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_id' => $userCollegeTopic[0] -> id]);
                                    
                        foreach($collegeTopicSections as $collegeTopicSection)
                        {
                            $collegeTSFiles = DB::table('college_t_s_files')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                            DB::table('user_college_topic_sections')->where('college_topic_section_id', $collegeTopicSection -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollege -> permissions]);
                            
                            $userCollegeTopicSection = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                            if(isset($userCollegeTopicSection[0]))
                            {
                                DB::table('user_college_topic_section_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_id' => $userCollegeTopicSection[0] -> id]);
                
                                foreach($collegeTSFiles as $collegeTSFile)
                                {
                                    DB::table('user_college_t_s_files')->where('college_t_s_file_id', $collegeTSFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollege -> permissions]);
                                    
                                    $userCollegeTSFile = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $collegeTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                             
                                    if(isset($userCollegeTSFile[0]))
                                    {
                                        DB::table('user_college_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile[0] -> id]);
                                    }
                                }
                
                                $collegeTSNotes = DB::table('college_t_s_notes')->where('college_topic_section_id', '=', $collegeTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                                foreach($collegeTSNotes as $collegeTSNote)
                                {
                                    DB::table('user_college_t_s_notes')->where('college_t_s_note_id', $collegeTSNote -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollege -> permissions]);
                                    
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
            
                                    DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', $collegeTSGalery -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollege -> permissions]);
                                    
                                    $userCollegeTSGalery = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $collegeTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userCollegeTSGalery[0]))
                                    {
                                        DB::table('user_college_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalery[0] -> id]);
                    
                                        foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                                        {
                                            DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', $collegeTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollege -> permissions]);
                                            
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
            
                                    DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', $collegeTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollege -> permissions]);
                                    
                                    $userCollegeTSPlaylist = DB::table('user_college_t_s_playlists')->where('c_t_s_p_id', '=', $collegeTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userCollegeTSPlaylist[0]))
                                    {
                                        DB::table('u_c_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_c_t_s_p_id' => $userCollegeTSPlaylist[0] -> id]);
                    
                                        foreach($collegeTSPlaylistAudios as $collegeTSPlaylistAudio)
                                        {
                                            DB::table('user_college_t_s_p_audios')->where('c_t_s_p_a_id', $collegeTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollege -> permissions]);
                                            
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
            
                                    DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', $collegeTSTool -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollege -> permissions]);
                                    
                                    $userCollegeTSTool = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $collegeTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userCollegeTSTool[0]))
                                    {
                                        DB::table('user_college_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool[0] -> id]);
                                    
                                        foreach($collegeTSToolFiles as $collegeTSToolFile)
                                        {
                                            DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', $collegeTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollege -> permissions]);
                                            
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
                    }                    
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_colleges')->join('users', 'users.id', '=', 'user_colleges.user_id')->where('user_colleges.id', '=', $userCollege -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_u', 'user_id' => $user_id, 'entity_id' => $userCollege -> college_id, 'created_at' => $now]);
            
                Flash::success('User College updated successfully.');
                return redirect(route('userColleges.show', [$userCollege -> college_id]));
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
            $userCollege = $this->userCollegeRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userCollege))
            {
                Flash::error('User College not found');
                return redirect(route('userColleges.index'));
            }
            
            $user = DB::table('colleges')->where('id', '=', $userCollege -> college_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollege -> user_id;
                $collegeTopics = DB::table('college_topics')->where('college_id', '=', $userCollege -> college_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_college_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_id' => $userCollege -> id]);
    
                foreach($collegeTopics as $collegeTopic)
                {
                    $collegeTopicSections = DB::table('college_topic_sections')->where('college_topic_id', '=', $collegeTopic -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_college_topics')->where('college_topic_id', $collegeTopic -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                    
                    $userCollegeTopic = DB::table('user_college_topics')->where('college_topic_id', '=', $collegeTopic -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if(isset($userCollegeTopic[0]))
                    {
                        DB::table('user_college_topic_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_id' => $userCollegeTopic[0] -> id]);
                        
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
                    }
                }
        
                $this->userCollegeRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_colleges')->join('users', 'users.id', '=', 'user_colleges.user_id')->where('user_colleges.id', '=', $userCollege -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_d', 'user_id' => $user_id, 'entity_id' => $userCollege -> college_id, 'created_at' => $now]);
            
                Flash::success('User College deleted successfully.');
                return redirect(route('userColleges.show', [$userCollege -> college_id]));
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