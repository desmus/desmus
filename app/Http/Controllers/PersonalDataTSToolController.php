<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolRequest;
use App\Http\Requests\UpdatePersonalDataTSToolRequest;
use App\Repositories\PersonalDataTSToolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\PersonalDataTSTool;
use Illuminate\Support\Carbon;

class PersonalDataTSToolController extends AppBaseController
{
    private $personalDataTSToolRepository;

    public function __construct(PersonalDataTSToolRepository $personalDataTSToolRepo)
    {
        $this->personalDataTSToolRepository = $personalDataTSToolRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSTools = $this->personalDataTSToolRepository->all();
    
            return view('personal_data_t_s_tools.index')
                ->with('personalDataTSTools', $personalDataTSTools);
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
            $personalDataTSToolsList = PersonalDataTSTool::where('personal_data_topic_section_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            return view('personal_data_t_s_tools.create')
                ->with('id', $id)
                ->with('personalDataTSToolsList', $personalDataTSToolsList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $personalDataTSTool = $this->personalDataTSToolRepository->create($input);
    
            DB::table('personal_data_t_s_tool_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'personal_data_t_s_tool_id' => $personalDataTSTool -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSTool -> name, 'status' => 'active', 'type' => 'p_d_t_s_t_c', 'user_id' => $user_id, 'entity_id' => $personalDataTSTool -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Tool saved successfully.');
            return redirect(route('personalDataTopicSections.show', [$personalDataTSTool -> personal_data_topic_section_id]));
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
            $personal_data_tool_file_p = $request -> personal_data_tool_file_p;
            
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSTool = $this->personalDataTSToolRepository->findWithoutFail($id);
            
            if(empty($personalDataTSTool))
            {
                Flash::error('PersonalData T S Tool not found');
                return redirect(route('personalDataTSTools.index'));
            }
            
            $userPersonalDataTSTools = DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSTools as $userPersonalDataTSTool)
            {
                if($userPersonalDataTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_tools')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('personal_data_t_s_tool_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'personal_data_t_s_tool_id' => $id]);
                DB::table('personal_data_t_s_tools')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
                $personalDataTSTool = $this->personalDataTSToolRepository->findWithoutFail($id);
                $personalDataTSToolFiles = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_tool_files.deleted_at', '=', null);})->paginate(50, ['*'], 'personal_data_tool_file_p');
                $personalDataTopicSectionToolViews = DB::table('users')->join('personal_data_t_s_tool_views', 'users.id', '=', 'personal_data_t_s_tool_views.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $personalDataTopicSectionToolUpdates = DB::table('users')->join('personal_data_t_s_tool_updates', 'users.id', '=', 'personal_data_t_s_tool_updates.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $personalDataTSToolTodolist = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_tools', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_tools.personal_data_topic_section_id')->join('personal_data_t_s_t_todolists', 'personal_data_t_s_tools.id', '=', 'personal_data_t_s_t_todolists.p_d_t_s_t_id')->where('personal_data_t_s_t_todolists.p_d_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('personal_data_t_s_t_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_t_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_t_todolists.datetime', 'desc')->limit(50)->get();
                $personalDataTSToolTodolistCompleted = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_tools', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_tools.personal_data_topic_section_id')->join('personal_data_t_s_t_todolists', 'personal_data_t_s_tools.id', '=', 'personal_data_t_s_t_todolists.p_d_t_s_t_id')->where('personal_data_t_s_t_todolists.p_d_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('personal_data_t_s_t_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('personal_data_t_s_t_todolists.deleted_at', '=', null);})->orderBy('personal_data_t_s_t_todolists.datetime', 'desc')->limit(50)->get();

                $personalDataTSToolFilesList = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $userPersonalDataTSToolsList = DB::table('user_personal_data_t_s_tools')->join('users', 'user_personal_data_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_tools.description', 'permissions', 'user_personal_data_t_s_tools.datetime', 'user_personal_data_t_s_tools.id', 'personal_data_t_s_tool_id')->where('personal_data_t_s_tool_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSToolViewsList = DB::table('users')->join('personal_data_t_s_tool_views', 'users.id', '=', 'personal_data_t_s_tool_views.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSToolUpdatesList = DB::table('users')->join('personal_data_t_s_tool_updates', 'users.id', '=', 'personal_data_t_s_tool_updates.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSToolTodolistsList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_tools', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_tools.personal_data_topic_section_id')->join('personal_data_t_s_t_todolists', 'personal_data_t_s_tools.id', '=', 'personal_data_t_s_t_todolists.p_d_t_s_t_id')->where('personal_data_t_s_t_todolists.p_d_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('personal_data_t_s_t_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_t_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_t_todolists.datetime', 'desc')->limit(5)->get();
                $personalDataTSToolTodolistsCompletedList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_tools', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_tools.personal_data_topic_section_id')->join('personal_data_t_s_t_todolists', 'personal_data_t_s_tools.id', '=', 'personal_data_t_s_t_todolists.p_d_t_s_t_id')->where('personal_data_t_s_t_todolists.p_d_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('personal_data_t_s_t_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('personal_data_t_s_t_todolists.deleted_at', '=', null);})->orderBy('personal_data_t_s_t_todolists.datetime', 'desc')->limit(5)->get();

                return view('personal_data_t_s_tools.show')
                    ->with('personalDataTSTool', $personalDataTSTool)
                    ->with('personalDataTSToolFiles', $personalDataTSToolFiles)
                    ->with('personalDataTSToolViews', $personalDataTopicSectionToolViews)
                    ->with('personalDataTSToolUpdates', $personalDataTopicSectionToolUpdates)
                    ->with('personalDataTSToolTodolist', $personalDataTSToolTodolist)
                    ->with('personalDataTSToolTodolistCompleted', $personalDataTSToolTodolistCompleted)
                    ->with('personal_data_tool_file_p', $personal_data_tool_file_p)
                    ->with('user_id', $user_id)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('personalDataTSToolFilesList', $personalDataTSToolFilesList)
                    ->with('userPersonalDataTSToolsList', $userPersonalDataTSToolsList)
                    ->with('personalDataTSToolViewsList', $personalDataTSToolViewsList)
                    ->with('personalDataTSToolUpdatesList', $personalDataTSToolUpdatesList)
                    ->with('personalDataTSToolTodolistsList', $personalDataTSToolTodolistsList)
                    ->with('personalDataTSToolTodolistsCompletedList', $personalDataTSToolTodolistsCompletedList);
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
            $personalDataTSTool = $this->personalDataTSToolRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTool))
            {
                Flash::error('PersonalData T S Tool not found');
                return redirect(route('personalDataTSTools.index'));
            }
            
            $userPersonalDataTSTools = DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSTools as $userPersonalDataTSTool)
            {
                if($userPersonalDataTSTool -> user_id == $user_id && $userPersonalDataTSTool -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_tools')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $personalDataTSToolFilesList = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $personalDataTSToolViewsList = DB::table('users')->join('personal_data_t_s_tool_views', 'users.id', '=', 'personal_data_t_s_tool_views.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSToolUpdatesList = DB::table('users')->join('personal_data_t_s_tool_updates', 'users.id', '=', 'personal_data_t_s_tool_updates.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userPersonalDataTSToolsList = DB::table('user_personal_data_t_s_tools')->join('users', 'user_personal_data_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_tools.description', 'permissions', 'user_personal_data_t_s_tools.datetime', 'user_personal_data_t_s_tools.id', 'personal_data_t_s_tool_id')->where('personal_data_t_s_tool_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSToolTodolistsList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_tools', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_tools.personal_data_topic_section_id')->join('personal_data_t_s_t_todolists', 'personal_data_t_s_tools.id', '=', 'personal_data_t_s_t_todolists.p_d_t_s_t_id')->where('personal_data_t_s_t_todolists.p_d_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('personal_data_t_s_t_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_t_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_t_todolists.datetime', 'desc')->limit(5)->get();
                $personalDataTSToolTodolistsCompletedList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_tools', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_tools.personal_data_topic_section_id')->join('personal_data_t_s_t_todolists', 'personal_data_t_s_tools.id', '=', 'personal_data_t_s_t_todolists.p_d_t_s_t_id')->where('personal_data_t_s_t_todolists.p_d_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('personal_data_t_s_t_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('personal_data_t_s_t_todolists.deleted_at', '=', null);})->orderBy('personal_data_t_s_t_todolists.datetime', 'desc')->limit(5)->get();

                return view('personal_data_t_s_tools.edit')
                    ->with('personalDataTSTool', $personalDataTSTool)
                    ->with('personalDataTSToolFilesList', $personalDataTSToolFilesList)
                    ->with('personalDataTSToolViewsList', $personalDataTSToolViewsList)
                    ->with('userPersonalDataTSToolsList', $userPersonalDataTSToolsList)
                    ->with('personalDataTSToolUpdatesList', $personalDataTSToolUpdatesList)
                    ->with('personalDataTSToolTodolistsList', $personalDataTSToolTodolistsList)
                    ->with('personalDataTSToolTodolistsCompletedList', $personalDataTSToolTodolistsCompletedList);
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

    public function update($id, UpdatePersonalDataTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSTool = $this->personalDataTSToolRepository->findWithoutFail($id);
    
            if(empty($personalDataTSTool))
            {
                Flash::error('PersonalData T S Tool not found');
                return redirect(route('personalDataTSTools.index'));
            }
            
            $userPersonalDataTSTools = DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSTools as $userPersonalDataTSTool)
            {
                if($userPersonalDataTSTool -> user_id == $user_id && $userPersonalDataTSTool -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_tools')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_tools.id', '=', $id)->get();
            
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
                $newPersonalDataTSTool = $this->personalDataTSToolRepository->update($request->all(), $id);
        
                DB::table('personal_data_t_s_tools')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1')]);
                DB::table('personal_data_t_s_tool_updates')->insert(['actual_name' => $newPersonalDataTSTool -> name, 'past_name' => $personalDataTSTool -> name, 'datetime' => $now, 'personal_data_t_s_tool_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $personalDataTSTool -> name, 'status' => 'active', 'type' => 'p_d_t_s_t_u', 'user_id' => $user_id, 'entity_id' => $personalDataTSTool -> id, 'created_at' => $now]);
            
                Flash::success('PersonalData T S Tool updated successfully.');
                return redirect(route('personalDataTSTools.show', [$id]));
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
            $personalDataTSTool = $this->personalDataTSToolRepository->findWithoutFail($id);
            
            if (empty($personalDataTSTool))
            {
                Flash::error('PersonalData T S Tool not found');
                return redirect(route('personalDataTSTools.index'));
            }
            
            $user = DB::table('personal_data_t_s_tools')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $personalDataTSToolFiles = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
                DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', $personalDataTSTool -> id)->update(['deleted_at' => $now]);
                
                $userPersonalDataTSTool = DB::table('user_personal_data_t_s_tools')->where('personal_data_t_s_tool_id', '=', $personalDataTSTool -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userPersonalDataTSTool == null)
                {
                    DB::table('user_personal_data_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_d_t_s_t_id' => $userPersonalDataTSTool[0] -> id]);
                }
                
                foreach($personalDataTSToolFiles as $personalDataTSToolFile)
                {
                    DB::table('user_personal_data_t_s_tool_files')->where('personal_data_t_s_t_file_id', $personalDataTSToolFile -> id)->update(['deleted_at' => $now]);
                    
                    $userPersonalDataTSToolFile = DB::table('user_personal_data_t_s_tool_files')->where('personal_data_t_s_t_file_id', '=', $personalDataTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                    
                    if($$userPersonalDataTSToolFile == null)
                    {
                        DB::table('user_personal_data_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile[0] -> id]);
                    }
                }
                    
                $this->personalDataTSToolRepository->delete($id);
                $personalDataTSToolFiles = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $personalDataTSTool -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                foreach($personalDataTSToolFiles as $personalDataTSToolFile)
                {
                    DB::table('personal_data_t_s_tool_files')->where('id', $personalDataTSToolFile -> id)->update(['deleted_at' => $now]);
                    DB::table('personal_data_t_s_tool_file_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'personal_data_t_s_t_file_id' => $personalDataTSToolFile -> id]);
                }
                
                DB::table('personal_data_t_s_tool_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'personal_data_t_s_tool_id' => $personalDataTSTool -> id]);
                DB::table('recent_activities')->insert(['name' => $personalDataTSTool -> name, 'status' => 'active', 'type' => 'p_d_t_s_t_d', 'user_id' => $user_id, 'entity_id' => $personalDataTSTool -> id, 'created_at' => $now]);
            
                Flash::success('PersonalData T S Tool deleted successfully.');
                return redirect(route('personalDataTopicSections.show', [$personalDataTSTool -> personal_data_topic_section_id]));
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