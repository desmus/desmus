<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCollegeTSToolRequest;
use App\Http\Requests\UpdateUserCollegeTSToolRequest;
use App\Repositories\UserCollegeTSToolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSToolController extends AppBaseController
{
    private $userCollegeTSToolRepository;

    public function __construct(UserCollegeTSToolRepository $userCollegeTSToolRepo)
    {
        $this->userCollegeTSToolRepository = $userCollegeTSToolRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSToolRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSTools = $this->userCollegeTSToolRepository->all();
    
            return view('user_college_t_s_tools.index')
                ->with('userCollegeTSTools', $userCollegeTSTools);
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
            
            $collegeTSToolFilesList = DB::table('college_t_s_tool_files')->where('college_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
            $userCollegeTSToolsList = DB::table('user_college_t_s_tools')->join('users', 'user_college_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_tools.description', 'permissions', 'user_college_t_s_tools.datetime', 'user_college_t_s_tools.id', 'college_t_s_tool_id')->where('college_t_s_tool_id', $id)->where(function ($query) {$query->where('user_college_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTSToolViewsList = DB::table('users')->join('college_t_s_tool_views', 'users.id', '=', 'college_t_s_tool_views.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTSToolUpdatesList = DB::table('users')->join('college_t_s_tool_updates', 'users.id', '=', 'college_t_s_tool_updates.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_college_t_s_tools.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('collegeTSToolFilesList', $collegeTSToolFilesList)
                ->with('userCollegeTSToolsList', $userCollegeTSToolsList)
                ->with('collegeTSToolViewsList', $collegeTSToolViewsList)
                ->with('collegeTSToolUpdatesList', $collegeTSToolUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_tools.id', '=', $request -> college_t_s_tool_id)->get();
            
            $userCollegeTSToolCheck = DB::table('user_college_t_s_tools')->where('user_id', '=', $request -> user_id)->where('college_t_s_tool_id', '=', $request -> college_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userCollegeTSToolCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userCollegeTSTool = $this->userCollegeTSToolRepository->create($input);
                    $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $userCollegeTSTool -> college_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_college_t_s_tool_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool -> id]);
        
                    foreach($collegeTSToolFiles as $collegeTSToolFile)
                    {
                        DB::table('user_college_t_s_tool_files')->insert(['datetime' => $now, 'user_id' => $userCollegeTSTool -> user_id, 'description' => $userCollegeTSTool -> description, 'college_t_s_t_file_id' => $collegeTSToolFile -> id]);
                                                
                        $userCollegeTSToolFile = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $collegeTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                        if(isset($userCollegeTSToolFile[0]))
                        {
                            DB::table('user_college_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile[0] -> id]);
                        }
                    }
                    
                    $user = DB::table('user_college_t_s_tools')->join('users', 'users.id', '=', 'user_college_t_s_tools.user_id')->where('user_college_t_s_tools.id', '=', $userCollegeTSTool -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_t_c', 'user_id' => $user_id, 'entity_id' => $userCollegeTSTool -> college_t_s_tool_id, 'created_at' => $now]);
                
                    Flash::success('User College T S Tool saved successfully.');
                    return redirect(route('userCollegeTSTools.show', [$userCollegeTSTool -> college_t_s_tool_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userCollegeTSTools.show', [$request -> college_t_s_tool_id]));
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
            $userCollegeTSTool = $this->userCollegeTSToolRepository->findWithoutFail($id);
            $userCollegeTSTools = DB::table('user_college_t_s_tools')->join('users', 'user_college_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_tools.description', 'permissions', 'user_college_t_s_tools.datetime', 'user_college_t_s_tools.id', 'college_t_s_tool_id')->where('college_t_s_tool_id', $id)->where(function ($query) {$query->where('user_college_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userCollegeTSTools[0]))
            {
                Flash::error('User College T S Tool not found');
                return redirect(route('userCollegeTSTools.create', [$id]));
            }
            
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_tools.id', '=', $userCollegeTSTools[0] -> college_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTSTool = DB::table('college_t_s_tools')->where('id', '=', $userCollegeTSTools[0] -> college_t_s_tool_id)->get();
    
                $collegeTSToolFilesList = DB::table('college_t_s_tool_files')->where('college_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $userCollegeTSToolsList = DB::table('user_college_t_s_tools')->join('users', 'user_college_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_tools.description', 'permissions', 'user_college_t_s_tools.datetime', 'user_college_t_s_tools.id', 'college_t_s_tool_id')->where('college_t_s_tool_id', $id)->where(function ($query) {$query->where('user_college_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSToolViewsList = DB::table('users')->join('college_t_s_tool_views', 'users.id', '=', 'college_t_s_tool_views.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSToolUpdatesList = DB::table('users')->join('college_t_s_tool_updates', 'users.id', '=', 'college_t_s_tool_updates.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_college_t_s_tools.show')
                    ->with('userCollegeTSTools', $userCollegeTSTools)
                    ->with('id', $id)
                    ->with('collegeTSTool', $collegeTSTool)
                    ->with('collegeTSToolFilesList', $collegeTSToolFilesList)
                    ->with('userCollegeTSToolsList', $userCollegeTSToolsList)
                    ->with('collegeTSToolViewsList', $collegeTSToolViewsList)
                    ->with('collegeTSToolUpdatesList', $collegeTSToolUpdatesList);
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
            $userCollegeTSTool = DB::table('users')->join('user_college_t_s_tools', 'user_college_t_s_tools.user_id', '=', 'users.id')->where('user_college_t_s_tools.id', $id)->where(function ($query) {$query->where('user_college_t_s_tools.deleted_at', '=', null);})->get();
    
            if(empty($userCollegeTSTool[0]))
            {
                Flash::error('User College T S Tool not found');
                return redirect(route('userCollegeTSTools.index'));
            }
    
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_tools.id', '=', $userCollegeTSTool[0] -> college_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTSToolFilesList = DB::table('college_t_s_tool_files')->where('college_t_s_t_id' , '=', $id)->where(function ($query) {$query->where('college_t_s_tool_files.deleted_at', '=', null);})->limit(10)->get();
                $userCollegeTSToolsList = DB::table('user_college_t_s_tools')->join('users', 'user_college_t_s_tools.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_tools.description', 'permissions', 'user_college_t_s_tools.datetime', 'user_college_t_s_tools.id', 'college_t_s_tool_id')->where('college_t_s_tool_id', $id)->where(function ($query) {$query->where('user_college_t_s_tools.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSToolViewsList = DB::table('users')->join('college_t_s_tool_views', 'users.id', '=', 'college_t_s_tool_views.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSToolUpdatesList = DB::table('users')->join('college_t_s_tool_updates', 'users.id', '=', 'college_t_s_tool_updates.user_id')->where('college_t_s_tool_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_college_t_s_tools.edit')
                    ->with('userCollegeTSTool', $userCollegeTSTool)
                    ->with('id', $userCollegeTSTool[0] -> college_t_s_tool_id)
                    ->with('collegeTSToolFilesList', $collegeTSToolFilesList)
                    ->with('userCollegeTSToolsList', $userCollegeTSToolsList)
                    ->with('collegeTSToolViewsList', $collegeTSToolViewsList)
                    ->with('collegeTSToolUpdatesList', $collegeTSToolUpdatesList);
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

    public function update($id, UpdateUserCollegeTSToolRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userCollegeTSTool = $this->userCollegeTSToolRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userCollegeTSTool))
            {
                Flash::error('User College T S Tool not found');
                return redirect(route('userCollegeTSTools.index'));
            }
            
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_tools.id', '=', $userCollegeTSTool -> college_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollegeTSTool -> user_id;
                $userCollegeTSTool = $this->userCollegeTSToolRepository->update($request->all(), $id);
                $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $userCollegeTSTool -> college_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_college_t_s_tool_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool -> id]);
                 
                foreach($collegeTSToolFiles as $collegeTSToolFile)
                {
                    DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', $collegeTSToolFile -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTSTool -> permissions]);
                                            
                    $userCollegeTSToolFile = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $collegeTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userCollegeTSToolFile[0]))
                    {
                        DB::table('user_college_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_t_s_tools')->join('users', 'users.id', '=', 'user_college_t_s_tools.user_id')->where('user_college_t_s_tools.id', '=', $userCollegeTSTool -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_t_u', 'user_id' => $user_id, 'entity_id' => $userCollegeTSTool -> college_t_s_tool_id, 'created_at' => $now]);
            
                Flash::success('User College T S Tool updated successfully.');
                return redirect(route('userCollegeTSTools.show', [$userCollegeTSTool -> college_t_s_tool_id]));
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
            $userCollegeTSTool = $this->userCollegeTSToolRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userCollegeTSTool))
            {
                Flash::error('User College T S Tool not found');
                return redirect(route('userCollegeTSTools.index'));
            }
    
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_tools.id', '=', $userCollegeTSTool -> college_t_s_tool_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollegeTSTool -> user_id;
                $collegeTSToolFiles = DB::table('college_t_s_tool_files')->where('college_t_s_t_id', '=', $userCollegeTSTool -> college_t_s_tool_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_college_t_s_tool_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_id' => $userCollegeTSTool -> id]);
           
                foreach($collegeTSToolFiles as $collegeTSToolFile)
                {
                    DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', $collegeTSToolFile -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userCollegeTSToolFile = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $collegeTSToolFile -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userCollegeTSToolFile[0]))
                    {
                        DB::table('user_college_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile[0] -> id]);
                    }
                }
        
                $this->userCollegeTSToolRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_t_s_tools')->join('users', 'users.id', '=', 'user_college_t_s_tools.user_id')->where('user_college_t_s_tools.id', '=', $userCollegeTSTool -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_t_d', 'user_id' => $user_id, 'entity_id' => $userCollegeTSTool -> college_t_s_tool_id, 'created_at' => $now]);
            
                Flash::success('User College T S Tool deleted successfully.');
                return redirect(route('userCollegeTSTools.show', [$userCollegeTSTool -> college_t_s_tool_id]));
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