<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCollegeTSToolFileRequest;
use App\Http\Requests\UpdateUserCollegeTSToolFileRequest;
use App\Repositories\UserCollegeTSToolFileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSToolFileController extends AppBaseController
{
    private $userCollegeTSToolFileRepository;

    public function __construct(UserCollegeTSToolFileRepository $userCollegeTSToolFileRepo)
    {
        $this->userCollegeTSToolFileRepository = $userCollegeTSToolFileRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSToolFileRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSToolFiles = $this->userCollegeTSToolFileRepository->all();
    
            return view('user_college_t_s_tool_files.index')
                ->with('userCollegeTSToolFiles', $userCollegeTSToolFiles);
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
            
            $userCollegeTSToolFilesList = DB::table('user_college_t_s_tool_files')->join('users', 'user_college_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_tool_files.description', 'permissions', 'user_college_t_s_tool_files.datetime', 'user_college_t_s_tool_files.id', 'college_t_s_t_file_id')->where('college_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_college_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTSToolFileViewsList = DB::table('users')->join('college_t_s_tool_file_views', 'users.id', '=', 'college_t_s_tool_file_views.user_id')->where('college_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTSToolFileUpdatesList = DB::table('users')->join('college_t_s_tool_file_updates', 'users.id', '=', 'college_t_s_tool_file_updates.user_id')->where('college_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

            return view('user_college_t_s_tool_files.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userCollegeTSToolFilesList', $userCollegeTSToolFilesList)
                ->with('collegeTSToolFileViewsList', $collegeTSToolFileViewsList)
                ->with('collegeTSToolFileUpdatesList', $collegeTSToolFileUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSToolFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('college_t_s_tool_files')->join('college_t_s_tools', 'college_t_s_tool_files.college_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_tool_files.id', '=', $request -> college_t_s_t_file_id)->get();
            
            $userCollegeTSToolFileCheck = DB::table('user_college_t_s_tool_files')->where('user_id', '=', $request -> user_id)->where('college_t_s_t_file_id', '=', $request -> college_t_s_t_file_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userCollegeTSToolFileCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userCollegeTSToolFile = $this->userCollegeTSToolFileRepository->create($input);
                    $user = DB::table('user_college_t_s_tool_files')->join('users', 'users.id', '=', 'user_college_t_s_tool_files.user_id')->where('user_college_t_s_tool_files.id', '=', $userCollegeTSToolFile -> id)->select('name')->get();
                
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_t_f_c', 'user_id' => $user_id, 'entity_id' => $userCollegeTSToolFile -> college_t_s_t_file_id, 'created_at' => $now]);
                    DB::table('user_college_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile -> id]);
                
                    Flash::success('User College T S Tool File saved successfully.');
                    return redirect(route('userCollegeTSToolFiles.show', [$userCollegeTSToolFile -> college_t_s_t_file_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userCollegeTSToolFiles.show', [$request -> college_t_s_t_file_id]));
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
            $userCollegeTSToolFile = $this->userCollegeTSToolFileRepository->findWithoutFail($id);
            $userCollegeTSToolFiles = DB::table('user_college_t_s_tool_files')->join('users', 'user_college_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_tool_files.description', 'permissions', 'user_college_t_s_tool_files.datetime', 'user_college_t_s_tool_files.id', 'college_t_s_t_file_id')->where('college_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_college_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userCollegeTSToolFiles[0]))
            {
                Flash::error('User College T S Tool File not found');
                return redirect(route('userCollegeTSToolFiles.create', [$id]));
            }
            
            $user = DB::table('college_t_s_tool_files')->join('college_t_s_tools', 'college_t_s_tool_files.college_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_tool_files.id', '=', $userCollegeTSToolFiles[0] -> college_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTSToolFile = DB::table('college_t_s_tool_files')->where('id', '=', $userCollegeTSToolFiles[0] -> college_t_s_t_file_id)->get();
            
                $userCollegeTSToolFilesList = DB::table('user_college_t_s_tool_files')->join('users', 'user_college_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_tool_files.description', 'permissions', 'user_college_t_s_tool_files.datetime', 'user_college_t_s_tool_files.id', 'college_t_s_t_file_id')->where('college_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_college_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSToolFileViewsList = DB::table('users')->join('college_t_s_tool_file_views', 'users.id', '=', 'college_t_s_tool_file_views.user_id')->where('college_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSToolFileUpdatesList = DB::table('users')->join('college_t_s_tool_file_updates', 'users.id', '=', 'college_t_s_tool_file_updates.user_id')->where('college_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
                return view('user_college_t_s_tool_files.show')
                    ->with('userCollegeTSToolFiles', $userCollegeTSToolFiles)
                    ->with('id', $id)
                    ->with('collegeTSToolFile', $collegeTSToolFile)
                    ->with('userCollegeTSToolFilesList', $userCollegeTSToolFilesList)
                    ->with('collegeTSToolFileViewsList', $collegeTSToolFileViewsList)
                    ->with('collegeTSToolFileUpdatesList', $collegeTSToolFileUpdatesList);
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
            $userCollegeTSToolFile= DB::table('users')->join('user_college_t_s_tool_files', 'user_college_t_s_tool_files.user_id', '=', 'users.id')->where('user_college_t_s_tool_files.id', $id)->where(function ($query) {$query->where('user_college_t_s_tool_files.deleted_at', '=', null);})->get();
    
            if(empty($userCollegeTSToolFile))
            {
                Flash::error('User College T S Tool File not found');
                return redirect(route('userCollegeTSToolFiles.index'));
            }
    
            $user = DB::table('college_t_s_tool_files')->join('college_t_s_tools', 'college_t_s_tool_files.college_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_tool_files.id', '=', $userCollegeTSToolFile[0] -> college_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userCollegeTSToolFilesList = DB::table('user_college_t_s_tool_files')->join('users', 'user_college_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_tool_files.description', 'permissions', 'user_college_t_s_tool_files.datetime', 'user_college_t_s_tool_files.id', 'college_t_s_t_file_id')->where('college_t_s_t_file_id', $id)->where(function ($query) {$query->where('user_college_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSToolFileViewsList = DB::table('users')->join('college_t_s_tool_file_views', 'users.id', '=', 'college_t_s_tool_file_views.user_id')->where('college_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSToolFileUpdatesList = DB::table('users')->join('college_t_s_tool_file_updates', 'users.id', '=', 'college_t_s_tool_file_updates.user_id')->where('college_t_s_t_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_college_t_s_tool_files.edit')
                    ->with('userCollegeTSToolFile', $userCollegeTSToolFile)
                    ->with('id', $userCollegeTSToolFile[0] -> college_t_s_t_file_id)
                    ->with('userCollegeTSToolFilesList', $userCollegeTSToolFilesList)
                    ->with('collegeTSToolFileViewsList', $collegeTSToolFileViewsList)
                    ->with('collegeTSToolFileUpdatesList', $collegeTSToolFileUpdatesList);
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

    public function update($id, UpdateUserCollegeTSToolFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userCollegeTSToolFile = $this->userCollegeTSToolFileRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFile))
            {
                Flash::error('User College T S Tool File not found');
                return redirect(route('userCollegeTSToolFiles.index'));
            }
            
            $user = DB::table('college_t_s_tool_files')->join('college_t_s_tools', 'college_t_s_tool_files.college_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_tool_files.id', '=', $userCollegeTSToolFile -> college_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userCollegeTSToolFile = $this->userCollegeTSToolFileRepository->update($request->all(), $id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_t_s_tool_files')->join('users', 'users.id', '=', 'user_college_t_s_tool_files.user_id')->where('user_college_t_s_tool_files.id', '=', $userCollegeTSToolFile -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_t_f_u', 'user_id' => $user_id, 'entity_id' => $userCollegeTSToolFile -> college_t_s_t_file_id, 'created_at' => $now]);
                DB::table('user_college_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile -> id]);
            
                Flash::success('User College T S Tool File updated successfully.');
                return redirect(route('userCollegeTSToolFiles.show', [$userCollegeTSToolFile -> college_t_s_t_file_id]));
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
            $userCollegeTSToolFile = $this->userCollegeTSToolFileRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSToolFile))
            {
                Flash::error('User College T S Tool File not found');
                return redirect(route('userCollegeTSToolFiles.index'));
            }
    
            $user = DB::table('college_t_s_tool_files')->join('college_t_s_tools', 'college_t_s_tool_files.college_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_tool_files.id', '=', $userCollegeTSToolFile -> college_t_s_t_file_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userCollegeTSToolFileRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_t_s_tool_files')->join('users', 'users.id', '=', 'user_college_t_s_tool_files.user_id')->where('user_college_t_s_tool_files.id', '=', $userCollegeTSToolFile -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_t_f_d', 'user_id' => $user_id, 'entity_id' => $userCollegeTSToolFile -> college_t_s_t_file_id, 'created_at' => $now]);
                DB::table('user_college_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_t_f_id' => $userCollegeTSToolFile -> id]);
            
                Flash::success('User College T S Tool File deleted successfully.');
                return redirect(route('userCollegeTSToolFiles.show', [$userCollegeTSToolFile -> college_t_s_t_file_id]));
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