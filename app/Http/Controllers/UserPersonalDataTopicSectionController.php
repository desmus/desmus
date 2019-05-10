<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserPersonalDataTopicSectionRequest;
use App\Http\Requests\UpdateUserPersonalDataTopicSectionRequest;
use App\Repositories\UserPersonalDataTopicSectionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\PersonalDataTSFile;
use App\Models\PersonalDataTSNote;
use App\Models\PersonalDataTSGalerie;
use App\Models\PersonalDataTSTool;
use App\Models\PersonalDataTSPlaylist;

class UserPersonalDataTopicSectionController extends AppBaseController
{
    private $userPersonalDataTopicSectionRepository;

    public function __construct(UserPersonalDataTopicSectionRepository $userPersonalDataTopicSectionRepo)
    {
        $this->userPersonalDataTopicSectionRepository = $userPersonalDataTopicSectionRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTopicSectionRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTopicSections = $this->userPersonalDataTopicSectionRepository->all();
    
            return view('user_personal_data_topic_sections.index')
                ->with('userPersonalDataTopicSections', $userPersonalDataTopicSections);
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
            
            $personalDataTSFilesList = PersonalDataTSFile::where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $personalDataTSNotesList = PersonalDataTSNote::where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $personalDataTSGaleriesList = PersonalDataTSGalerie::where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $personalDataTSPlaylistsList = PersonalDataTSPlaylist::where('p_d_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
            $personalDataTSToolsList = PersonalDataTSTool::where('personal_data_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            $userPersonalDataTopicSectionsList = DB::table('user_personal_data_topic_sections')->join('users', 'user_personal_data_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_topic_sections.description', 'permissions', 'user_personal_data_topic_sections.datetime', 'user_personal_data_topic_sections.id', 'personal_data_t_s_id')->where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('user_personal_data_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTopicSectionViewsList = DB::table('users')->join('personal_data_topic_section_views', 'users.id', '=', 'personal_data_topic_section_views.user_id')->where('personal_data_t_s_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTopicSectionUpdatesList = DB::table('users')->join('personal_data_topic_section_updates', 'users.id', '=', 'personal_data_topic_section_updates.user_id')->where('personal_data_t_s_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_personal_data_topic_sections.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('personalDataTSFilesList', $personalDataTSFilesList)
                ->with('personalDataTSNotesList', $personalDataTSNotesList)
                ->with('personalDataTSGaleriesList', $personalDataTSGaleriesList)
                ->with('personalDataTSPlaylistsList', $personalDataTSPlaylistsList)
                ->with('personalDataTSToolsList', $personalDataTSToolsList)
                ->with('userPersonalDataTopicSectionsList', $userPersonalDataTopicSectionsList)
                ->with('personalDataTopicSectionViewsList', $personalDataTopicSectionViewsList)
                ->with('personalDataTopicSectionUpdatesList', $personalDataTopicSectionUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('personal_data_topic_sections')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_topic_sections.id', '=', $request -> personal_data_t_s_id)->get();
            
            $userPersonalDataTopicSectionCheck = DB::table('user_personal_data_topic_sections')->where('user_id', '=', $request -> user_id)->where('personal_data_t_s_id', '=', $request -> personal_data_t_s_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userPersonalDataTopicSectionCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userPersonalDataTopicSection = $this->userPersonalDataTopicSectionRepository->create($input);
                    $personalDataTopicSection = DB::table('personal_data_topic_sections')->where('id', '=', $userPersonalDataTopicSection -> personal_data_t_s_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    $personalDataTSFiles = DB::table('personal_data_t_s_files')->where('personal_data_t_s_id', '=', $userPersonalDataTopicSection -> personal_data_t_s_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_personal_data_topic_section_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_id' => $userPersonalDataTopicSection -> id]);
            
                    foreach($personalDataTSFiles as $personalDataTSFile)
                    {
                        DB::table('user_personal_data_t_s_files')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopicSection -> user_id, 'description' => $userPersonalDataTopicSection -> description, 'personal_data_t_s_file_id' => $personalDataTSFile -> id]);
                                        
                        $userPersonalDataTSFile = DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', '=', $personalDataTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userPersonalDataTSFile[0]))
                        {
                            DB::table('user_personal_data_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_f_id' => $userPersonalDataTSFile[0] -> id]);
                        }
                    }
                    
                    $personalDataTSNotes = DB::table('personal_data_t_s_notes')->where('personal_data_t_s_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($personalDataTSNotes as $personalDataTSNote)
                    {
                        DB::table('user_personal_data_t_s_notes')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopicSection -> user_id, 'description' => $userPersonalDataTopicSection -> description, 'personal_data_t_s_note_id' => $personalDataTSNote -> id]);
                                        
                        $userPersonalDataTSNote = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $personalDataTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userPersonalDataTSNote[0]))
                        {
                            DB::table('user_personal_data_t_s_note_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_n_id' => $userPersonalDataTSNote[0] -> id]);
                        }
                    }
                                    
                    $personalDataTSGaleries = DB::table('personal_data_t_s_galeries')->where('personal_data_t_s_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($personalDataTSGaleries as $personalDataTSGalery)
                    {
                        DB::table('user_personal_data_t_s_galeries')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopicSection -> user_id, 'description' => $userPersonalDataTopicSection -> description, 'personal_data_t_s_g_id' => $personalDataTSGalery -> id]);
                                        
                        $userPersonalDataTSGalery = DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', '=', $personalDataTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userPersonalDataTSGalery[0]))
                        {
                            DB::table('user_personal_data_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_id' => $userPersonalDataTSGalery[0] -> id]);
                    
                            $personalDataTSGaleryImages = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $personalDataTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($personalDataTSGaleryImages as $personalDataTSGaleryImage)
                            {
                                DB::table('user_personal_data_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopicSection -> user_id, 'description' => $userPersonalDataTopicSection -> description, 'p_d_t_s_g_i_id' => $personalDataTSGaleryImage -> id]);
                                                
                                $userPersonalDataTSGaleryImage = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $personalDataTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userPersonalDataTSGaleryImage[0]))
                                {
                                    DB::table('user_personal_data_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage[0] -> id]);
                                }
                            }
                        }
                    }
                                    
                    $personalDataTSPlaylists = DB::table('personal_data_t_s_playlists')->where('p_d_t_s_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($personalDataTSPlaylists as $personalDataTSPlaylist)
                    {
                        DB::table('user_personal_data_t_s_p')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopicSection -> user_id, 'description' => $userPersonalDataTopicSection -> description, 'p_d_t_s_p_id' => $personalDataTSPlaylist -> id]);
                                        
                        $userPersonalDataTSPlaylist = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userPersonalDataTSPlaylist[0]))
                        {
                            DB::table('u_p_d_t_s_playlist_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_id' => $userPersonalDataTSPlaylist[0] -> id]);
                                        
                            $personalDataTSPlaylistAudios = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($personalDataTSPlaylistAudios as $personalDataTSPlaylistAudio)
                            {
                                DB::table('user_p_d_t_s_p_audios')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopicSection -> user_id, 'description' => $userPersonalDataTopicSection -> description, 'p_d_t_s_p_a_id' => $personalDataTSPlaylistAudio -> id]);
                                                
                                $userPersonalDataTSPlaylistAudio = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $personalDataTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userPersonalDataTSPlaylistAudio[0]))
                                {
                                    DB::table('u_p_d_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPersonalDataTSPlaylistAudio[0] -> id]);
                                }
                            }
                        }
                    }
                                    
                    $personalDataTSTools = DB::table('personal_data_t_s_tools')->where('personal_data_topic_section_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                    foreach($personalDataTSTools as $personalDataTSTool)
                    {
                        DB::table('user_personal_data_t_s_tools')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopicSection -> user_id, 'description' => $userPersonalDataTopicSection -> description, 'personal_data_t_s_tool_id' => $personalDataTSTool -> id]);
                                        
                        $userPersonalDataTSTool = DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', '=', $personalDataTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                        
                        if(isset($userPersonalDataTSTool[0]))
                        {
                            DB::table('user_personal_data_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_id' => $userPersonalDataTSTool[0] -> id]);
                                            
                            $personalDataTSToolFiles = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                            
                            foreach($personalDataTSToolFiles as $personalDataTSToolFile)
                            {
                                DB::table('user_personal_data_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTopicSection -> user_id, 'description' => $userPersonalDataTopicSection -> description, 'personal_d_t_s_t_f_id' => $personalDataTSToolFile -> id]);
                                                
                                $userPersonalDataTSToolFile = DB::table('user_personal_data_t_s_tool_files')->where('id', '=', $personalDataTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                                if(isset($userPersonalDataTSToolFile[0]))
                                {
                                    DB::table('user_personal_data_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile[0] -> id]);
                                }
                            }
                        }
                    }
                    
                    $user = DB::table('user_personal_data_topic_sections')->join('users', 'users.id', '=', 'user_personal_data_topic_sections.user_id')->where('user_personal_data_topic_sections.id', '=', $userPersonalDataTopicSection -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_c', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTopicSection -> personal_data_t_s_id, 'created_at' => $now]);
                
                    Flash::success('User PersonalData Topic Section saved successfully.');
                    return redirect(route('userPersonalDataTopicSections.show', [$userPersonalDataTopicSection -> personal_data_t_s_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userPersonalDataTopicSections.show', [$request -> personal_data_t_s_id]));
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
            $userPersonalDataTopicSection = $this->userPersonalDataTopicSectionRepository->findWithoutFail($id);
            $userPersonalDataTopicSections = DB::table('user_personal_data_topic_sections')->join('users', 'user_personal_data_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_topic_sections.description', 'permissions', 'user_personal_data_topic_sections.datetime', 'user_personal_data_topic_sections.id', 'personal_data_t_s_id')->where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('user_personal_data_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userPersonalDataTopicSections[0]))
            {
                Flash::error('User PersonalData Topic Section not found');
                return redirect(route('userPersonalDataTopicSections.create', [$id]));
            }
    
            $user = DB::table('personal_data_topic_sections')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_topic_sections.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTopicSection = DB::table('personal_data_topic_sections')->where('id', '=', $userPersonalDataTopicSections[0] -> personal_data_t_s_id)->get();

                $personalDataTSFilesList = PersonalDataTSFile::where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $personalDataTSNotesList = PersonalDataTSNote::where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $personalDataTSGaleriesList = PersonalDataTSGalerie::where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $personalDataTSPlaylistsList = PersonalDataTSPlaylist::where('p_d_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $personalDataTSToolsList = PersonalDataTSTool::where('personal_data_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
    
                $userPersonalDataTopicSectionsList = DB::table('user_personal_data_topic_sections')->join('users', 'user_personal_data_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_topic_sections.description', 'permissions', 'user_personal_data_topic_sections.datetime', 'user_personal_data_topic_sections.id', 'personal_data_t_s_id')->where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('user_personal_data_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTopicSectionViewsList = DB::table('users')->join('personal_data_topic_section_views', 'users.id', '=', 'personal_data_topic_section_views.user_id')->where('personal_data_t_s_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTopicSectionUpdatesList = DB::table('users')->join('personal_data_topic_section_updates', 'users.id', '=', 'personal_data_topic_section_updates.user_id')->where('personal_data_t_s_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_personal_data_topic_sections.show')
                    ->with('userPersonalDataTopicSections', $userPersonalDataTopicSections)
                    ->with('id', $id)
                    ->with('personalDataTopicSection', $personalDataTopicSection)
                    ->with('personalDataTSFilesList', $personalDataTSFilesList)
                    ->with('personalDataTSNotesList', $personalDataTSNotesList)
                    ->with('personalDataTSGaleriesList', $personalDataTSGaleriesList)
                    ->with('personalDataTSPlaylistsList', $personalDataTSPlaylistsList)
                    ->with('personalDataTSToolsList', $personalDataTSToolsList)
                    ->with('userPersonalDataTopicSectionsList', $userPersonalDataTopicSectionsList)
                    ->with('personalDataTopicSectionViewsList', $personalDataTopicSectionViewsList)
                    ->with('personalDataTopicSectionUpdatesList', $personalDataTopicSectionUpdatesList);
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
            $userPersonalDataTopicSection = DB::table('users')->join('user_personal_data_topic_sections', 'user_personal_data_topic_sections.user_id', '=', 'users.id')->where('user_personal_data_topic_sections.id', $id)->where(function ($query) {$query->where('user_personal_data_topic_sections.deleted_at', '=', null);})->get();
    
            if(empty($userPersonalDataTopicSection))
            {
                Flash::error('User PersonalData Topic Section not found');
                return redirect(route('userPersonalDataTopicSections.index'));
            }
    
            $user = DB::table('personal_data_topic_sections')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_topic_sections.id', '=', $userPersonalDataTopicSection[0] -> personal_data_t_s_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSFilesList = PersonalDataTSFile::where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $personalDataTSNotesList = PersonalDataTSNote::where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $personalDataTSGaleriesList = PersonalDataTSGalerie::where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $personalDataTSPlaylistsList = PersonalDataTSPlaylist::where('p_d_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
                $personalDataTSToolsList = PersonalDataTSTool::where('personal_data_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();
    
                $userPersonalDataTopicSectionsList = DB::table('user_personal_data_topic_sections')->join('users', 'user_personal_data_topic_sections.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_topic_sections.description', 'permissions', 'user_personal_data_topic_sections.datetime', 'user_personal_data_topic_sections.id', 'personal_data_t_s_id')->where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('user_personal_data_topic_sections.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTopicSectionViewsList = DB::table('users')->join('personal_data_topic_section_views', 'users.id', '=', 'personal_data_topic_section_views.user_id')->where('personal_data_t_s_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTopicSectionUpdatesList = DB::table('users')->join('personal_data_topic_section_updates', 'users.id', '=', 'personal_data_topic_section_updates.user_id')->where('personal_data_t_s_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_personal_data_topic_sections.edit')
                    ->with('userPersonalDataTopicSection', $userPersonalDataTopicSection)
                    ->with('id', $userPersonalDataTopicSection[0] -> personal_data_t_s_id)
                    ->with('personalDataTSFilesList', $personalDataTSFilesList)
                    ->with('personalDataTSNotesList', $personalDataTSNotesList)
                    ->with('personalDataTSGaleriesList', $personalDataTSGaleriesList)
                    ->with('personalDataTSPlaylistsList', $personalDataTSPlaylistsList)
                    ->with('personalDataTSToolsList', $personalDataTSToolsList)
                    ->with('userPersonalDataTopicSectionsList', $userPersonalDataTopicSectionsList)
                    ->with('personalDataTopicSectionViewsList', $personalDataTopicSectionViewsList)
                    ->with('personalDataTopicSectionUpdatesList', $personalDataTopicSectionUpdatesList);
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

    public function update($id, UpdateUserPersonalDataTopicSectionRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userPersonalDataTopicSection = $this->userPersonalDataTopicSectionRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userPersonalDataTopicSection))
            {
                Flash::error('User PersonalData Topic Section not found');
                return redirect(route('userPersonalDataTopicSections.index'));
            }
    
            $user = DB::table('personal_data_topic_sections')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_topic_sections.id', '=', $userPersonalDataTopicSection -> personal_data_t_s_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userPersonalDataTopicSection -> user_id;
                $userPersonalDataTopicSection = $this->userPersonalDataTopicSectionRepository->update($request->all(), $id);
                $personalDataTopicSection = DB::table('personal_data_topic_sections')->where('id', '=', $userPersonalDataTopicSection -> personal_data_t_s_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                $personalDataTSFiles = DB::table('personal_data_t_s_files')->where('personal_data_t_s_id', '=', $userPersonalDataTopicSection -> personal_data_t_s_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_personal_data_topic_section_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_id' => $userPersonalDataTopicSection -> id]);
        
                foreach($personalDataTSFiles as $personalDataTSFile)
                {
                    DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', $personalDataTSFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopicSection -> permissions]);
                                    
                    $userPersonalDataTSFile = DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', '=', $personalDataTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userPersonalDataTSFile[0]))
                    {
                        DB::table('user_personal_data_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_f_id' => $userPersonalDataTSFile[0] -> id]);
                    }
                }
                
                $personalDataTSNotes = DB::table('personal_data_t_s_notes')->where('personal_data_t_s_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($personalDataTSNotes as $personalDataTSNote)
                {
                    DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', $personalDataTSNote -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopicSection -> permissions]);
                                    
                    $userPersonalDataTSNote = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $personalDataTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userPersonalDataTSNote[0]))
                    {
                        DB::table('user_personal_data_t_s_note_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_n_id' => $userPersonalDataTSNote[0] -> id]);
                    }
                }
                                
                $personalDataTSGaleries = DB::table('personal_data_t_s_galeries')->where('personal_data_t_s_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($personalDataTSGaleries as $personalDataTSGalery)
                {
                    $personalDataTSGaleryImages = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $personalDataTSGalery -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', $personalDataTSGalery -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopicSection -> permissions]);
                                    
                    $userPersonalDataTSGalery = DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', '=', $personalDataTSGalery -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userPersonalDataTSGalery[0]))
                    {
                        DB::table('user_personal_data_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_id' => $userPersonalDataTSGalery[0] -> id]);
                    
                        foreach($personalDataTSGaleryImages as $personalDataTSGaleryImage)
                        {
                            DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', $personalDataTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopicSection -> permissions]);
                                            
                            $userPersonalDataTSGaleryImage = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $personalDataTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userPersonalDataTSGaleryImage[0]))
                            {
                                DB::table('user_personal_data_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage[0] -> id]);
                            }
                        }
                    }
                }
                                
                $personalDataTSPlaylists = DB::table('personal_data_t_s_playlists')->where('p_d_t_s_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($personalDataTSPlaylists as $personalDataTSPlaylist)
                {
                    $personalDataTSPlaylistAudios = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', $personalDataTSPlaylist -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopicSection -> permissions]);
                                    
                    $userPersonalDataTSPlaylist = DB::table('user_personal_data_t_s_p')->where('p_d_t_s_p_id', '=', $personalDataTSPlaylist -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userPersonalDataTSPlaylist[0]))
                    {
                        DB::table('u_p_d_t_s_playlist_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_id' => $userPersonalDataTSPlaylist[0] -> id]);
                    
                        foreach($personalDataTSPlaylistAudios as $personalDataTSPlaylistAudio)
                        {
                            DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', $personalDataTSPlaylistAudio -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopicSection -> permissions]);
                                            
                            $userPersonalDataTSPlaylistAudio = DB::table('user_p_d_t_s_p_audios')->where('p_d_t_s_p_a_id', '=', $personalDataTSPlaylistAudio -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                            if(isset($userPersonalDataTSPlaylistAudio[0]))
                            {
                                DB::table('u_p_d_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_p_a_id' => $userPersonalDataTSPlaylistAudio[0] -> id]);
                            }
                        }
                    }
                }
                                
                $personalDataTSTools = DB::table('personal_data_t_s_tools')->where('personal_data_topic_section_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($personalDataTSTools as $personalDataTSTool)
                {
                    $personalDataTSToolFiles = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
                    DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', $personalDataTSTool -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopicSection -> permissions]);
                                    
                    $userPersonalDataTSTool = DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', '=', $personalDataTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userPersonalDataTSTool[0]))
                    {
                        DB::table('user_personal_data_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_id' => $userPersonalDataTSTool[0] -> id]);
                                    
                        foreach($personalDataTSToolFiles as $personalDataTSToolFile)
                        {
                            DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', $personalDataTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTopicSection -> permissions]);
                                           
                            $userPersonalDataTSToolFile = DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', '=', $personalDataTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                            if(isset($userPersonalDataTSToolFile[0]))
                            {
                                DB::table('user_personal_data_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile[0] -> id]);
                            }
                        }
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_personal_data_topic_sections')->join('users', 'users.id', '=', 'user_personal_data_topic_sections.user_id')->where('user_personal_data_topic_sections.id', '=', $userPersonalDataTopicSection -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_u', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTopicSection -> personal_data_t_s_id, 'created_at' => $now]);
            
                Flash::success('User PersonalData Topic Section updated successfully.');
                return redirect(route('userPersonalDataTopicSections.show', [$userPersonalDataTopicSection -> personal_data_t_s_id]));
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
            $userPersonalDataTopicSection = $this->userPersonalDataTopicSectionRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userPersonalDataTopicSection))
            {
                Flash::error('User PersonalData Topic Section not found');
                return redirect(route('userPersonalDataTopicSections.index'));
            }
            
            $user = DB::table('personal_data_topic_sections')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_topic_sections.id', '=', $userPersonalDataTopicSection -> personal_data_t_s_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userPersonalDataTopicSection -> user_id;
                $personalDataTopicSection = DB::table('personal_data_topic_sections')->where('id', '=', $userPersonalDataTopicSection -> personal_data_t_s_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                $personalDataTSFiles = DB::table('personal_data_t_s_files')->where('personal_data_t_s_id', '=', $userPersonalDataTopicSection -> personal_data_t_s_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                DB::table('user_personal_data_topic_section_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_id' => $userPersonalDataTopicSection -> id]);
        
                foreach($personalDataTSFiles as $personalDataTSFile)
                {
                    DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', $personalDataTSFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                    $userPersonalDataTSFile = DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', '=', $personalDataTSFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userPersonalDataTSFile[0]))
                    {
                        DB::table('user_personal_data_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_f_id' => $userPersonalDataTSFile[0] -> id]);
                    }
                }
                
                $personalDataTSNotes = DB::table('personal_data_t_s_notes')->where('personal_data_t_s_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                foreach($personalDataTSNotes as $personalDataTSNote)
                {
                    DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', $personalDataTSNote -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                    
                    $userPersonalDataTSNote = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $personalDataTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userPersonalDataTSNote[0]))
                    {
                        DB::table('user_personal_data_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_n_id' => $userPersonalDataTSNote[0] -> id]);
                    }
                }
                                
                $personalDataTSGaleries = DB::table('personal_data_t_s_galeries')->where('personal_data_t_s_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
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
                                
                $personalDataTSPlaylists = DB::table('personal_data_t_s_playlists')->where('p_d_t_s_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
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
                                
                $personalDataTSTools = DB::table('personal_data_t_s_tools')->where('personal_data_topic_section_id', '=', $personalDataTopicSection[0] -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
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
        
                $this->userPersonalDataTopicSectionRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_personal_data_topic_sections')->join('users', 'users.id', '=', 'user_personal_data_topic_sections.user_id')->where('user_personal_data_topic_sections.id', '=', $userPersonalDataTopicSection -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_d', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTopicSection -> personal_data_t_s_id, 'created_at' => $now]);
            
                Flash::success('User PersonalData Topic Section deleted successfully.');
                return redirect(route('userPersonalDataTopicSections.show', [$userPersonalDataTopicSection -> personal_data_t_s_id]));
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