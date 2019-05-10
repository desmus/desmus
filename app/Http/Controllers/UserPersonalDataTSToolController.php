<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserPersonalDataTSToolRequest;
use App\Http\Requests\UpdateUserPersonalDataTSToolRequest;
use App\Repositories\UserPersonalDataTSToolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserPersonalDataTSToolController extends AppBaseController
{
    private $userPersonalDataTSToolRepository;

    public function __construct(UserPersonalDataTSToolRepository $userPersonalDataTSToolRepo)
    {
        $this->userPersonalDataTSToolRepository = $userPersonalDataTSToolRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSToolRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSTools = $this->userPersonalDataTSToolRepository->all();
    
            return view('user_personal_data_t_s_tools.index')
                ->with('userPersonalDataTSTools', $userPersonalDataTSTools);
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
            
            $personalDataTSToolFilesList = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
            $userPersonalDataTSToolsList = DB::table('user_personal_data_t_s_tools')->join('users', 'user_personal_data_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_tools.description', 'permissions', 'user_personal_data_t_s_tools.datetime', 'user_personal_data_t_s_tools.id', 'personal_data_t_s_tool_id')->where('personal_data_t_s_tool_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTSToolViewsList = DB::table('users')->join('personal_data_t_s_tool_views', 'users.id', '=', 'personal_data_t_s_tool_views.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTSToolUpdatesList = DB::table('users')->join('personal_data_t_s_tool_updates', 'users.id', '=', 'personal_data_t_s_tool_updates.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_personal_data_t_s_tools.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('personalDataTSToolFilesList', $personalDataTSToolFilesList)
                ->with('userPersonalDataTSToolsList', $userPersonalDataTSToolsList)
                ->with('personalDataTSToolViewsList', $personalDataTSToolViewsList)
                ->with('personalDataTSToolUpdatesList', $personalDataTSToolUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('personal_data_t_s_tools')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_tools.id', '=', $request -> personal_data_t_s_tool_id)->get();
            
            $userPersonalDataTSToolCheck = DB::table('user_personal_data_t_s_tools')->where('user_id', '=', $request -> user_id)->where('personal_data_t_s_tool_id', '=', $request -> personal_data_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userPersonalDataTSToolCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userPersonalDataTSTool = $this->userPersonalDataTSToolRepository->create($input);
                    $personalDataTSToolFiles = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $userPersonalDataTSTool -> personal_data_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_personal_data_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_id' => $userPersonalDataTSTool -> id]);
                        
                    foreach($personalDataTSToolFiles as $personalDataTSToolFile)
                    {
                        DB::table('user_personal_data_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTSTool -> user_id, 'description' => $userPersonalDataTSTool -> description, 'personal_d_t_s_t_f_id' => $personalDataTSToolFile -> id]);
                                                
                        $userPersonalDataTSToolFile = DB::table('user_personal_data_t_s_tool_files')->where('id', '=', $personalDataTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                        if(isset($userPersonalDataTSToolFile[0]))
                        {
                            DB::table('user_personal_data_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile[0] -> id]);
                        }
                    }
                    
                    $user = DB::table('user_personal_data_t_s_tools')->join('users', 'users.id', '=', 'user_personal_data_t_s_tools.user_id')->where('user_personal_data_t_s_tools.id', '=', $userPersonalDataTSTool -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_t_c', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSTool -> personal_data_t_s_tool_id, 'created_at' => $now]);
                
                    Flash::success('User PersonalData T S Tool saved successfully.');
                    return redirect(route('userPersonalDataTSTools.show', [$userPersonalDataTSTool -> personal_data_t_s_tool_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userPersonalDataTSTools.show', [$request -> personal_data_t_s_tool_id]));
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
            $userPersonalDataTSTool = $this->userPersonalDataTSToolRepository->findWithoutFail($id);
            $userPersonalDataTSTools = DB::table('user_personal_data_t_s_tools')->join('users', 'user_personal_data_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_tools.description', 'permissions', 'user_personal_data_t_s_tools.datetime', 'user_personal_data_t_s_tools.id', 'personal_data_t_s_tool_id')->where('personal_data_t_s_tool_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userPersonalDataTSTools[0]))
            {
                Flash::error('User PersonalData T S Tool not found');
                return redirect(route('userPersonalDataTSTools.create', [$id]));
            }
    
            $user = DB::table('personal_data_t_s_tools')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_tools.id', '=', $userPersonalDataTSTools[0] -> personal_data_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSTool = DB::table('personal_data_t_s_tools')->where('id', '=', $userPersonalDataTSTools[0] -> personal_data_t_s_tool_id)->get();
    
                $personalDataTSToolFilesList = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $userPersonalDataTSToolsList = DB::table('user_personal_data_t_s_tools')->join('users', 'user_personal_data_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_tools.description', 'permissions', 'user_personal_data_t_s_tools.datetime', 'user_personal_data_t_s_tools.id', 'personal_data_t_s_tool_id')->where('personal_data_t_s_tool_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSToolViewsList = DB::table('users')->join('personal_data_t_s_tool_views', 'users.id', '=', 'personal_data_t_s_tool_views.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSToolUpdatesList = DB::table('users')->join('personal_data_t_s_tool_updates', 'users.id', '=', 'personal_data_t_s_tool_updates.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_personal_data_t_s_tools.show')
                    ->with('userPersonalDataTSTools', $userPersonalDataTSTools)
                    ->with('id', $id)
                    ->with('personalDataTSTool', $personalDataTSTool)
                    ->with('personalDataTSToolFilesList', $personalDataTSToolFilesList)
                    ->with('userPersonalDataTSToolsList', $userPersonalDataTSToolsList)
                    ->with('personalDataTSToolViewsList', $personalDataTSToolViewsList)
                    ->with('personalDataTSToolUpdatesList', $personalDataTSToolUpdatesList);
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
            $userPersonalDataTSTool = DB::table('users')->join('user_personal_data_t_s_tools', 'user_personal_data_t_s_tools.user_id', '=', 'users.id')->where('user_personal_data_t_s_tools.id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tools.deleted_at', '=', null);})->get();
    
            if(empty($userPersonalDataTSTool))
            {
                Flash::error('User PersonalData T S Tool not found');
                return redirect(route('userPersonalDataTSTools.index'));
            }
    
            $user = DB::table('personal_data_t_s_tools')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_tools.id', '=', $userPersonalDataTSTool[0] -> personal_data_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSToolFilesList = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('personal_data_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $userPersonalDataTSToolsList = DB::table('user_personal_data_t_s_tools')->join('users', 'user_personal_data_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_tools.description', 'permissions', 'user_personal_data_t_s_tools.datetime', 'user_personal_data_t_s_tools.id', 'personal_data_t_s_tool_id')->where('personal_data_t_s_tool_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSToolViewsList = DB::table('users')->join('personal_data_t_s_tool_views', 'users.id', '=', 'personal_data_t_s_tool_views.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSToolUpdatesList = DB::table('users')->join('personal_data_t_s_tool_updates', 'users.id', '=', 'personal_data_t_s_tool_updates.user_id')->where('personal_data_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_personal_data_t_s_tools.edit')
                    ->with('userPersonalDataTSTool', $userPersonalDataTSTool)
                    ->with('id', $userPersonalDataTSTool[0] -> personal_data_t_s_tool_id)
                    ->with('personalDataTSToolFilesList', $personalDataTSToolFilesList)
                    ->with('userPersonalDataTSToolsList', $userPersonalDataTSToolsList)
                    ->with('personalDataTSToolViewsList', $personalDataTSToolViewsList)
                    ->with('personalDataTSToolUpdatesList', $personalDataTSToolUpdatesList);
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

    public function update($id, UpdateUserPersonalDataTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userPersonalDataTSTool = $this->userPersonalDataTSToolRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userPersonalDataTSTool))
            {
                Flash::error('User PersonalData T S Tool not found');
                return redirect(route('userPersonalDataTSTools.index'));
            }
    
            $user = DB::table('personal_data_t_s_tools')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_tools.id', '=', $userPersonalDataTSTool -> personal_data_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userPersonalDataTSTool -> user_id;
                $userPersonalDataTSTool = $this->userPersonalDataTSToolRepository->update($request->all(), $id);
                $personalDataTSToolFiles = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $userPersonalDataTSTool -> personal_data_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_personal_data_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_id' => $userPersonalDataTSTool -> id]);
         
                $userPersonalDataTSTool = $this->userPersonalDataTSToolRepository->update($request->all(), $id);
                 
                foreach($personalDataTSToolFiles as $personalDataTSToolFile)
                {
                    DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', $personalDataTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTSTool -> permissions]);
                                           
                    $userPersonalDataTSToolFile = DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', '=', $personalDataTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                    
                    if(isset($userPersonalDataTSToolFile[0]))
                    {
                        DB::table('user_personal_data_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_t_u', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSTool -> personal_data_t_s_tool_id, 'created_at' => $now]);
            
                Flash::success('User PersonalData T S Tool updated successfully.');
                return redirect(route('userPersonalDataTSTools.show', [$userPersonalDataTSTool -> personal_data_t_s_tool_id]));
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
            $userPersonalDataTSTool = $this->userPersonalDataTSToolRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userPersonalDataTSTool))
            {
                Flash::error('User PersonalData T S Tool not found');
                return redirect(route('userPersonalDataTSTools.index'));
            }
            
            $user = DB::table('personal_data_t_s_tools')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_tools.id', '=', $userPersonalDataTSTool -> personal_data_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userPersonalDataTSTool -> user_id;
                $personalDataTSToolFiles = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $userPersonalDataTSTool -> personal_data_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_personal_data_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_id' => $userPersonalDataTSTool -> id]);
                          
                foreach($personalDataTSToolFiles as $personalDataTSToolFile)
                {
                    DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', $personalDataTSToolFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userPersonalDataTSToolFile = DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', '=', $personalDataTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userPersonalDataTSToolFile[0]))
                    {
                        DB::table('user_personal_data_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile[0] -> id]);
                    }
                }
        
                $this->userPersonalDataTSToolRepository->delete($id);
                $user_id = Auth::user()->id;
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_t_d', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSTool -> personal_data_t_s_tool_id, 'created_at' => $now]);
            
                Flash::success('User PersonalData T S Tool deleted successfully.');
                return redirect(route('userPersonalDataTSTools.show', [$userPersonalDataTSTool -> personal_data_t_s_tool_id]));
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