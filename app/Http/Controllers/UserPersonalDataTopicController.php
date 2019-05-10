<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserPersonalDataTopicRequest;
use App\Http\Requests\UpdateUserPersonalDataTopicRequest;
use App\Repositories\UserPersonalDataTopicRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\PersonalDataTopicSection;

class UserPersonalDataTopicController extends AppBaseController
{
    private $userPersonalDataTopicRepository;

    public function __construct(UserPersonalDataTopicRepository $userPersonalDataTopicRepo)
    {
        $this->userPersonalDataTopicRepository = $userPersonalDataTopicRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTopicRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTopics = $this->userPersonalDataTopicRepository->all();
    
            return view('user_personal_data_topics.index')
                ->with('userPersonalDataTopics', $userPersonalDataTopics);
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
            
            $personalDataTopicSectionsList = PersonalDataTopicSection::where('personal_data_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
            $userPersonalDataTopicsList = DB::table('user_personal_data_topics')->join('users', 'user_personal_data_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_topics.description', 'permissions', 'user_personal_data_topics.datetime', 'user_personal_data_topics.id', 'personal_data_topic_id')->where('personal_data_topic_id', $id)->where(function ($query) {$query->where('user_personal_data_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTopicViewsList = DB::table('users')->join('personal_data_topic_views', 'users.id', '=', 'personal_data_topic_views.user_id')->where('personal_data_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTopicUpdatesList = DB::table('users')->join('personal_data_topic_updates', 'users.id', '=', 'personal_data_topic_updates.user_id')->where('personal_data_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

            return view('user_personal_data_topics.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('personalDataTopicSectionsList', $personalDataTopicSectionsList)
                ->with('userPersonalDataTopicsList', $userPersonalDataTopicsList)
                ->with('personalDataTopicViewsList', $personalDataTopicViewsList)
                ->with('personalDataTopicUpdatesList', $personalDataTopicUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTopicRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('personal_data_topics')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_topics.id', '=', $request -> personal_data_topic_id)->get();
            
            $userPersonalDataTopicCheck = DB::table('user_personal_data_topics')->where('user_id', '=', $request -> user_id)->where('personal_data_topic_id', '=', $request -> personal_data_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userPersonalDataTopicCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userPersonalDataTopic = $this->userPersonalDataTopicRepository->create($input);
                    $personalDataTopicSections = DB::table('personal_data_topic_sections')->where('personal_data_topic_id', '=', $userPersonalDataTopic -> personal_data_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_personal_data_topic_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_id' => $userPersonalDataTopic -> id]);
    
                    foreach($personalDataTopicSections as $personalDataTopicSection)
                    {
                        DB::table('user_personal_data_topic_sections')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopic -> user_id, 'description' => $userPersonalDataTopic -> description, 'personal_data_t_s_id' => $personalDataTopicSection -> id]);
                                        
                        $userPersonalDataTopicSection = DB::table('user_personal_data_topic_sections')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userPersonalDataTopicSection[0]))
                        {
                            DB::table('user_personal_data_topic_section_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_id' => $userPersonalDataTopicSection[0] -> id]);
                                            
                            $personalDataTSFiles = DB::table('personal_data_t_s_files')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                            
                            foreach($personalDataTSFiles as $personalDataTSFile)
                            {
                                DB::table('user_personal_data_t_s_files')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopic -> user_id, 'description' => $userPersonalDataTopic -> description, 'personal_data_t_s_file_id' => $personalDataTSFile -> id]);
                                                
                                $userPersonalDataTSFile = DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', '=', $personalDataTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userPersonalDataTSFile[0]))
                                {
                                    DB::table('user_personal_data_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_f_id' => $userPersonalDataTSFile[0] -> id]);
                                }
                            }
                            
                            $personalDataTSNotes = DB::table('personal_data_t_s_notes')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($personalDataTSNotes as $personalDataTSNote)
                            {
                                DB::table('user_personal_data_t_s_notes')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopic -> user_id, 'description' => $userPersonalDataTopic -> description, 'personal_data_t_s_note_id' => $personalDataTSNote -> id]);
                                                
                                $userPersonalDataTSNote = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $personalDataTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userPersonalDataTSNote[0]))
                                {
                                    DB::table('user_personal_data_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_n_id' => $userPersonalDataTSNote[0] -> id]);
                                }
                            }
                                            
                            $personalDataTSGaleries = DB::table('personal_data_t_s_galeries')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($personalDataTSGaleries as $personalDataTSGalery)
                            {
                                DB::table('user_personal_data_t_s_galeries')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopic -> user_id, 'description' => $userPersonalDataTopic -> description, 'personal_data_t_s_g_id' => $personalDataTSGalery -> id]);
                                                
                                $userPersonalDataTSGalery = DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', '=', $personalDataTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userPersonalDataTSGalery[0]))
                                {
                                    DB::table('user_personal_data_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_id' => $userPersonalDataTSGalery[0] -> id]);
                            
                                    $personalDataTSGaleryImages = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $personalDataTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                                    foreach($personalDataTSGaleryImages as $personalDataTSGaleryImage)
                                    {
                                        DB::table('user_personal_data_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopic -> user_id, 'description' => $userPersonalDataTopic -> description, 'p_d_t_s_g_i_id' => $personalDataTSGaleryImage -> id]);
                                                        
                                        $userPersonalDataTSGaleryImage = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $personalDataTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                        
                                        if(isset($userPersonalDataTSGaleryImage[0]))
                                        {
                                            DB::table('user_personal_data_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage[0] -> id]);
                                        }
                                    }
                                }
                            }
                                            
                            $personalDataTSPlaylists = DB::table('personal_data_t_s_playlists')->where('p_d_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($personalDataTSPlaylists as $personalDataTSPlaylist)
                            {
                                DB::table('user_personal_data_t_s_p')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopic -> user_id, 'description' => $userPersonalDataTopic -> description, 'p_d_t_s_p_id' => $personalDataTSPlaylist -> id]);
                                                
                                $userPersonalDataTSPlaylist = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userPersonalDataTSPlaylist[0]))
                                {
                                    DB::table('u_p_d_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_id' => $userPersonalDataTSPlaylist[0] -> id]);
                                                
                                    $personalDataTSPlaylistAudios = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                                    
                                    foreach($personalDataTSPlaylistAudios as $personalDataTSPlaylistAudio)
                                    {
                                        DB::table('user_p_d_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopic -> user_id, 'description' => $userPersonalDataTopic -> description, 'p_d_t_s_p_a_id' => $personalDataTSPlaylistAudio -> id]);
                                                        
                                        $userPersonalDataTSPlaylistAudio = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $personalDataTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                        
                                        if(isset($userPersonalDataTSPlaylistAudio[0]))
                                        {
                                            DB::table('u_p_d_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPersonalDataTSPlaylistAudio[0] -> id]);
                                        }
                                    }
                                }
                            }
                                            
                            $personalDataTSTools = DB::table('personal_data_t_s_tools')->where('personal_data_topic_section_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($personalDataTSTools as $personalDataTSTool)
                            {
                                DB::table('user_personal_data_t_s_tools')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopic -> user_id, 'description' => $userPersonalDataTopic -> description, 'personal_data_t_s_tool_id' => $personalDataTSTool -> id]);
                                                
                                $userPersonalDataTSTool = DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', '=', $personalDataTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userPersonalDataTSTool[0]))
                                {
                                    DB::table('user_personal_data_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_id' => $userPersonalDataTSTool[0] -> id]);
                                                    
                                    $personalDataTSToolFiles = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                                    
                                    foreach($personalDataTSToolFiles as $personalDataTSToolFile)
                                    {
                                        DB::table('user_personal_data_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopic -> user_id, 'description' => $userPersonalDataTopic -> description, 'personal_d_t_s_t_f_id' => $personalDataTSToolFile -> id]);
                                                        
                                        $userPersonalDataTSToolFile = DB::table('user_personal_data_t_s_tool_files')->where('id', '=', $personalDataTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                        
                                        if(isset($userPersonalDataTSToolFile[0]))
                                        {
                                            DB::table('user_personal_data_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile[0] -> id]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            
            $user = DB::table('user_personal_data_topics')->join('users', 'users.id', '=', 'user_personal_data_topics.user_id')->where('user_personal_data_topics.id', '=', $userPersonalDataTopic -> id)->select('name')->get();
            DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_c', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTopic -> personal_data_topic_id, 'created_at' => $now]);

            Flash::success('User PersonalData saved successfully.');            
            return redirect(route('userPersonalDataTopics.show', [$request -> personal_data_topic_id]));
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
            $userPersonalDataTopic = $this->userPersonalDataTopicRepository->findWithoutFail($id);
            $userPersonalDataTopics = DB::table('user_personal_data_topics')->join('users', 'user_personal_data_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_topics.description', 'permissions', 'user_personal_data_topics.datetime', 'user_personal_data_topics.id', 'personal_data_topic_id')->where('personal_data_topic_id', $id)->where(function ($query) {$query->where('user_personal_data_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userPersonalDataTopics[0]))
            {
                Flash::error('User PersonalData Topic not found');
                return redirect(route('userPersonalDataTopics.create', [$id]));
            }
            
            $user = DB::table('personal_data_topics')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_topics.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTopic = DB::table('personal_data_topics')->where('id', '=', $userPersonalDataTopics[0] -> personal_data_topic_id)->get();
            
                $personalDataTopicSectionsList = PersonalDataTopicSection::where('personal_data_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userPersonalDataTopicsList = DB::table('user_personal_data_topics')->join('users', 'user_personal_data_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_topics.description', 'permissions', 'user_personal_data_topics.datetime', 'user_personal_data_topics.id', 'personal_data_topic_id')->where('personal_data_topic_id', $id)->where(function ($query) {$query->where('user_personal_data_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTopicViewsList = DB::table('users')->join('personal_data_topic_views', 'users.id', '=', 'personal_data_topic_views.user_id')->where('personal_data_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTopicUpdatesList = DB::table('users')->join('personal_data_topic_updates', 'users.id', '=', 'personal_data_topic_updates.user_id')->where('personal_data_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
                return view('user_personal_data_topics.show')
                    ->with('userPersonalDataTopics', $userPersonalDataTopics)
                    ->with('id', $id)
                    ->with('personalDataTopic', $personalDataTopic)
                    ->with('personalDataTopicSectionsList', $personalDataTopicSectionsList)
                    ->with('userPersonalDataTopicsList', $userPersonalDataTopicsList)
                    ->with('personalDataTopicViewsList', $personalDataTopicViewsList)
                    ->with('personalDataTopicUpdatesList', $personalDataTopicUpdatesList);
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
            $userPersonalDataTopic = DB::table('users')->join('user_personal_data_topics', 'user_personal_data_topics.user_id', '=', 'users.id')->where('user_personal_data_topics.id', $id)->where(function ($query) {$query->where('user_personal_data_topics.deleted_at', '=', null);})->get();
    
            if(empty($userPersonalDataTopic))
            {
                Flash::error('User PersonalData Topic not found');
                return redirect(route('userPersonalDataTopics.index'));
            }
    
            $user = DB::table('personal_data_topics')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_topics.id', '=', $userPersonalDataTopic[0] -> personal_data_topic_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTopicSectionsList = PersonalDataTopicSection::where('personal_data_topic_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(10)->get();
                $userPersonalDataTopicsList = DB::table('user_personal_data_topics')->join('users', 'user_personal_data_topics.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_topics.description', 'permissions', 'user_personal_data_topics.datetime', 'user_personal_data_topics.id', 'personal_data_topic_id')->where('personal_data_topic_id', $id)->where(function ($query) {$query->where('user_personal_data_topics.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTopicViewsList = DB::table('users')->join('personal_data_topic_views', 'users.id', '=', 'personal_data_topic_views.user_id')->where('personal_data_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTopicUpdatesList = DB::table('users')->join('personal_data_topic_updates', 'users.id', '=', 'personal_data_topic_updates.user_id')->where('personal_data_topic_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_personal_data_topics.edit')
                    ->with('userPersonalDataTopic', $userPersonalDataTopic)
                    ->with('id', $userPersonalDataTopic[0] -> personal_data_topic_id)
                    ->with('personalDataTopicSectionsList', $personalDataTopicSectionsList)
                    ->with('userPersonalDataTopicsList', $userPersonalDataTopicsList)
                    ->with('personalDataTopicViewsList', $personalDataTopicViewsList)
                    ->with('personalDataTopicUpdatesList', $personalDataTopicUpdatesList);
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

    public function update($id, UpdateUserPersonalDataTopicRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userPersonalDataTopic = $this->userPersonalDataTopicRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userPersonalDataTopic))
            {
                Flash::error('User PersonalData Topic not found');
                return redirect(route('userPersonalDataTopics.index'));
            }
    
            $user = DB::table('personal_data_topics')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_topics.id', '=', $userPersonalDataTopic -> personal_data_topic_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userPersonalDataTopic -> user_id;
                $userPersonalDataTopic = $this->userPersonalDataTopicRepository->update($request->all(), $id);
                $personalDataTopicSections = DB::table('personal_data_topic_sections')->where('personal_data_topic_id', '=', $userPersonalDataTopic -> personal_data_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_personal_data_topic_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_id' => $userPersonalDataTopic -> id]);
                
                foreach($personalDataTopicSections as $personalDataTopicSection)
                {
                    $personalDataTSFiles = DB::table('personal_data_t_s_files')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    DB::table('user_personal_data_topic_sections')->where('personal_data_t_s_id', $personalDataTopicSection -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopic -> permissions]);
                            
                    $userPersonalDataTopicSection = DB::table('user_personal_data_topic_sections')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                    if(isset($userPersonalDataTopicSection[0]))
                    {
                        DB::table('user_personal_data_topic_section_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_id' => $userPersonalDataTopicSection[0] -> id]);
                
                        foreach($personalDataTSFiles as $personalDataTSFile)
                        {
                            DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', $personalDataTSFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopic -> permissions]);
                                    
                            $userPersonalDataTSFile = DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', '=', $personalDataTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userPersonalDataTSFile[0]))
                            {
                                DB::table('user_personal_data_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_f_id' => $userPersonalDataTSFile[0] -> id]);
                            }
                        }
                
                        $personalDataTSNotes = DB::table('personal_data_t_s_notes')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personalDataTSNotes as $personalDataTSNote)
                        {
                            DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', $personalDataTSNote -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopic -> permissions]);
                                    
                            $userPersonalDataTSNote = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $personalDataTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userPersonalDataTSNote[0]))
                            {
                                DB::table('user_personal_data_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_n_id' => $userPersonalDataTSNote[0] -> id]);
                            }
                        }
                                
                        $personalDataTSGaleries = DB::table('personal_data_t_s_galeries')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personalDataTSGaleries as $personalDataTSGalery)
                        {
                            $personalDataTSGaleryImages = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $personalDataTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', $personalDataTSGalery -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopic -> permissions]);
                                    
                            $userPersonalDataTSGalery = DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', '=', $personalDataTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userPersonalDataTSGalery[0]))
                            {
                                DB::table('user_personal_data_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_id' => $userPersonalDataTSGalery[0] -> id]);
                    
                                foreach($personalDataTSGaleryImages as $personalDataTSGaleryImage)
                                {
                                    DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', $personalDataTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopic -> permissions]);
                                            
                                    $userPersonalDataTSGaleryImage = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $personalDataTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userPersonalDataTSGaleryImage[0]))
                                    {
                                        DB::table('user_personal_data_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage[0] -> id]);
                                    }
                                }
                            }
                        }
                                
                        $personalDataTSPlaylists = DB::table('personal_data_t_s_playlists')->where('p_d_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personalDataTSPlaylists as $personalDataTSPlaylist)
                        {
                            $personalDataTSPlaylistAudios = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', $personalDataTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopic -> permissions]);
                                    
                            $userPersonalDataTSPlaylist = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userPersonalDataTSPlaylist[0]))
                            {
                                DB::table('u_p_d_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_id' => $userPersonalDataTSPlaylist[0] -> id]);
                    
                                foreach($personalDataTSPlaylistAudios as $personalDataTSPlaylistAudio)
                                {
                                    DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', $personalDataTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopic -> permissions]);
                                            
                                    $userPersonalDataTSPlaylistAudio = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $personalDataTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userPersonalDataTSPlaylistAudio[0]))
                                    {
                                        DB::table('u_p_d_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPersonalDataTSPlaylistAudio[0] -> id]);
                                    }
                                }
                            }
                        }
                                
                        $personalDataTSTools = DB::table('personal_data_t_s_tools')->where('personal_data_topic_section_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personalDataTSTools as $personalDataTSTool)
                        {
                            $personalDataTSToolFiles = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', $personalDataTSTool -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopic -> permissions]);
                                    
                            $userPersonalDataTSTool = DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', '=', $personalDataTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userPersonalDataTSTool[0]))
                            {
                                DB::table('user_personal_data_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_id' => $userPersonalDataTSTool[0] -> id]);
                                    
                                foreach($personalDataTSToolFiles as $personalDataTSToolFile)
                                {
                                    DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', $personalDataTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopic -> permissions]);
                                           
                                    $userPersonalDataTSToolFile = DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', '=', $personalDataTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                                    if(isset($userPersonalDataTSToolFile[0]))
                                    {
                                        DB::table('user_personal_data_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile[0] -> id]);
                                    }
                                }
                            }
                        }
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_personal_data_topics')->join('users', 'users.id', '=', 'user_personal_data_topics.user_id')->where('user_personal_data_topics.id', '=', $userPersonalDataTopic -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_u', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTopic -> personal_data_topic_id, 'created_at' => $now]);
            
                Flash::success('User PersonalData Topic updated successfully.');
                return redirect(route('userPersonalDataTopics.show', [$userPersonalDataTopic -> personal_data_topic_id]));
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
            $userPersonalDataTopic = $this->userPersonalDataTopicRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
            
            if(empty($userPersonalDataTopic))
            {
                Flash::error('User PersonalData Topic not found');
                return redirect(route('userPersonalDataTopics.index'));
            }
            
            $user = DB::table('personal_data_topics')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_topics.id', '=', $userPersonalDataTopic -> personal_data_topic_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userPersonalDataTopic -> user_id;
                $personalDataTopicSections = DB::table('personal_data_topic_sections')->where('personal_data_topic_id', '=', $userPersonalDataTopic -> personal_data_topic_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_personal_data_topic_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_id' => $userPersonalDataTopic -> id]);
                
                foreach($personalDataTopicSections as $personalDataTopicSection)
                {
                    $personalDataTSFiles = DB::table('personal_data_t_s_files')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                    DB::table('user_personal_data_topic_sections')->where('personal_data_t_s_id', $personalDataTopicSection -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                            
                    $userPersonalDataTopicSection = DB::table('user_personal_data_topic_sections')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                            
                    if(isset($userPersonalDataTopicSection[0]))
                    {
                        DB::table('user_personal_data_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_id' => $userPersonalDataTopicSection[0] -> id]);
                                
                        foreach($personalDataTSFiles as $personalDataTSFile)
                        {
                            DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', $personalDataTSFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                            $userPersonalDataTSFile = DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', '=', $personalDataTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userPersonalDataTSFile[0]))
                            {
                                DB::table('user_personal_data_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_f_id' => $userPersonalDataTSFile[0] -> id]);
                            }
                        }
                
                        $personalDataTSNotes = DB::table('personal_data_t_s_notes')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personalDataTSNotes as $personalDataTSNote)
                        {
                            DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', $personalDataTSNote -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                            $userPersonalDataTSNote = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $personalDataTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userPersonalDataTSNote[0]))
                            {
                                DB::table('user_personal_data_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_n_id' => $userPersonalDataTSNote[0] -> id]);
                            }
                        }
                                
                        $personalDataTSGaleries = DB::table('personal_data_t_s_galeries')->where('personal_data_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personalDataTSGaleries as $personalDataTSGalery)
                        {
                            $personalDataTSGaleryImages = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $personalDataTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', $personalDataTSGalery -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                            $userPersonalDataTSGalery = DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', '=', $personalDataTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userPersonalDataTSGalery[0]))
                            {
                                DB::table('user_personal_data_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_id' => $userPersonalDataTSGalery[0] -> id]);
                    
                                foreach($personalDataTSGaleryImages as $personalDataTSGaleryImage)
                                {
                                    DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', $personalDataTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                                    $userPersonalDataTSGaleryImage = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $personalDataTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userPersonalDataTSGaleryImage[0]))
                                    {
                                        DB::table('user_personal_data_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage[0] -> id]);
                                    }
                                }
                            }
                        }
                                
                        $personalDataTSPlaylists = DB::table('personal_data_t_s_playlists')->where('p_d_t_s_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personalDataTSPlaylists as $personalDataTSPlaylist)
                        {
                            $personalDataTSPlaylistAudios = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', $personalDataTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                            $userPersonalDataTSPlaylist = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                
                            if(isset($userPersonalDataTSPlaylist[0]))
                            {
                                DB::table('u_p_d_t_s_playlist_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_id' => $userPersonalDataTSPlaylist[0] -> id]);
                                        
                                foreach($personalDataTSPlaylistAudios as $personalDataTSPlaylistAudio)
                                {
                                    DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', $personalDataTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                                    $userPersonalDataTSPlaylistAudio = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $personalDataTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userPersonalDataTSPlaylistAudio[0]))
                                    {
                                        DB::table('u_p_d_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPersonalDataTSPlaylistAudio[0] -> id]);
                                    }
                                }
                            }
                        }
                                
                        $personalDataTSTools = DB::table('personal_data_t_s_tools')->where('personal_data_topic_section_id', '=', $personalDataTopicSection -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personalDataTSTools as $personalDataTSTool)
                        {
                            $personalDataTSToolFiles = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                            DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', $personalDataTSTool -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                            $userPersonalDataTSTool = DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', '=', $personalDataTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userPersonalDataTSTool[0]))
                            {
                                DB::table('user_personal_data_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_id' => $userPersonalDataTSTool[0] -> id]);
                                    
                                foreach($personalDataTSToolFiles as $personalDataTSToolFile)
                                {
                                    DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', $personalDataTSToolFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                        
                                    $userPersonalDataTSToolFile = DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', '=', $personalDataTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                                    if(isset($userPersonalDataTSToolFile[0]))
                                    {
                                        DB::table('user_personal_data_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile[0] -> id]);
                                    }
                                }
                            }
                        }
                    }
                }
                
                $this->userPersonalDataTopicRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_personal_data_topics')->join('users', 'users.id', '=', 'user_personal_data_topics.user_id')->where('user_personal_data_topics.id', '=', $userPersonalDataTopic -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_d', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTopic -> personal_data_topic_id, 'created_at' => $now]);
            
                Flash::success('User PersonalData Topic deleted successfully.');
                return redirect(route('userPersonalDataTopics.show', [$userPersonalDataTopic -> personal_data_topic_id]));
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