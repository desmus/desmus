<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCollegeTSFileRequest;
use App\Http\Requests\UpdateUserCollegeTSFileRequest;
use App\Repositories\UserCollegeTSFileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSFileController extends AppBaseController
{
    private $userCollegeTSFileRepository;

    public function __construct(UserCollegeTSFileRepository $userCollegeTSFileRepo)
    {
        $this->userCollegeTSFileRepository = $userCollegeTSFileRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSFileRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSFiles = $this->userCollegeTSFileRepository->all();
    
            return view('user_college_t_s_files.index')
                ->with('userCollegeTSFiles', $userCollegeTSFiles);
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
            
            $userCollegeTSFilesList = DB::table('user_college_t_s_files')->join('users', 'user_college_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_files.description', 'permissions', 'user_college_t_s_files.datetime', 'user_college_t_s_files.id', 'college_t_s_file_id')->where('college_t_s_file_id', $id)->where(function ($query) {$query->where('user_college_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTSFileViewsList = DB::table('users')->join('college_t_s_file_views', 'users.id', '=', 'college_t_s_file_views.user_id')->where('college_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTSFileUpdatesList = DB::table('users')->join('college_t_s_file_updates', 'users.id', '=', 'college_t_s_file_updates.user_id')->where('college_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_college_t_s_files.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('collegeTSFileViewsList', $collegeTSFileViewsList)
                ->with('collegeTSFileUpdatesList', $collegeTSFileUpdatesList)
                ->with('userCollegeTSFilesList', $userCollegeTSFilesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('college_t_s_files')->join('college_topic_sections', 'college_t_s_files.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_files.id', '=', $request -> college_t_s_file_id)->get();
            
            $userCollegeTSFileCheck = DB::table('user_college_t_s_files')->where('user_id', '=', $request -> user_id)->where('college_t_s_file_id', '=', $request -> college_t_s_file_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userCollegeTSFileCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userCollegeTSFile = $this->userCollegeTSFileRepository->create($input);
                    $user = DB::table('user_college_t_s_files')->join('users', 'users.id', '=', 'user_college_t_s_files.user_id')->where('user_college_t_s_files.id', '=', $userCollegeTSFile -> id)->select('name')->get();
                   
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_f_c', 'user_id' => $user_id, 'entity_id' => $userCollegeTSFile -> college_t_s_file_id, 'created_at' => $now]);
                    DB::table('user_college_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile -> id]);
                
                    Flash::success('User College T S File saved successfully.');
                    return redirect(route('userCollegeTSFiles.show', [$userCollegeTSFile -> college_t_s_file_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userCollegeTSFiles.show', [$request -> college_t_s_file_id]));
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
            $userCollegeTSFile = $this->userCollegeTSFileRepository->findWithoutFail($id);
            $userCollegeTSFiles = DB::table('user_college_t_s_files')->join('users', 'user_college_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_files.description', 'permissions', 'user_college_t_s_files.datetime', 'user_college_t_s_files.id', 'college_t_s_file_id')->where('college_t_s_file_id', $id)->where(function ($query) {$query->where('user_college_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userCollegeTSFiles[0]))
            {
                Flash::error('User College T S File not found');
                return redirect(route('userCollegeTSFiles.create', [$id]));
            }
    
            $user = DB::table('college_t_s_files')->join('college_topic_sections', 'college_t_s_files.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_files.id', '=', $userCollegeTSFiles[0] -> college_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $collegeTSFile = DB::table('college_t_s_files')->where('id', '=', $userCollegeTSFiles[0] -> college_t_s_file_id)->get();
                
                $userCollegeTSFilesList = DB::table('user_college_t_s_files')->join('users', 'user_college_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_files.description', 'permissions', 'user_college_t_s_files.datetime', 'user_college_t_s_files.id', 'college_t_s_file_id')->where('college_t_s_file_id', $id)->where(function ($query) {$query->where('user_college_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSFileViewsList = DB::table('users')->join('college_t_s_file_views', 'users.id', '=', 'college_t_s_file_views.user_id')->where('college_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSFileUpdatesList = DB::table('users')->join('college_t_s_file_updates', 'users.id', '=', 'college_t_s_file_updates.user_id')->where('college_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_college_t_s_files.show')
                    ->with('userCollegeTSFiles', $userCollegeTSFiles)
                    ->with('id', $id)
                    ->with('collegeTSFile', $collegeTSFile)
                    ->with('collegeTSFileViewsList', $collegeTSFileViewsList)
                    ->with('collegeTSFileUpdatesList', $collegeTSFileUpdatesList)
                    ->with('userCollegeTSFilesList', $userCollegeTSFilesList);
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
            $userCollegeTSFile = DB::table('users')->join('user_college_t_s_files', 'user_college_t_s_files.user_id', '=', 'users.id')->where('user_college_t_s_files.id', $id)->where(function ($query) {$query->where('user_college_t_s_files.deleted_at', '=', null);})->get();
    
            if(empty($userCollegeTSFile[0]))
            {
                Flash::error('User College T S File not found');
                return redirect(route('userCollegeTSFiles.index'));
            }
    
            $user = DB::table('college_t_s_files')->join('college_topic_sections', 'college_t_s_files.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_files.id', '=', $userCollegeTSFile[0] -> college_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $userCollegeTSFilesList = DB::table('user_college_t_s_files')->join('users', 'user_college_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_files.description', 'permissions', 'user_college_t_s_files.datetime', 'user_college_t_s_files.id', 'college_t_s_file_id')->where('college_t_s_file_id', $id)->where(function ($query) {$query->where('user_college_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSFileViewsList = DB::table('users')->join('college_t_s_file_views', 'users.id', '=', 'college_t_s_file_views.user_id')->where('college_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSFileUpdatesList = DB::table('users')->join('college_t_s_file_updates', 'users.id', '=', 'college_t_s_file_updates.user_id')->where('college_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_college_t_s_files.edit')
                    ->with('userCollegeTSFile', $userCollegeTSFile)
                    ->with('id', $userCollegeTSFile[0] -> college_t_s_file_id)
                    ->with('collegeTSFileViewsList', $collegeTSFileViewsList)
                    ->with('collegeTSFileUpdatesList', $collegeTSFileUpdatesList)
                    ->with('userCollegeTSFilesList', $userCollegeTSFilesList);
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

    public function update($id, UpdateUserCollegeTSFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userCollegeTSFile = $this->userCollegeTSFileRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSFile))
            {
                Flash::error('User College T S File not found');
                return redirect(route('userCollegeTSFiles.index'));
            }
    
            $user = DB::table('college_t_s_files')->join('college_topic_sections', 'college_t_s_files.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_files.id', '=', $userCollegeTSFile -> college_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $userCollegeTSFile = $this->userCollegeTSFileRepository->update($request->all(), $id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_t_s_files')->join('users', 'users.id', '=', 'user_college_t_s_files.user_id')->where('user_college_t_s_files.id', '=', $userCollegeTSFile -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_f_u', 'user_id' => $user_id, 'entity_id' => $userCollegeTSFile -> college_t_s_file_id, 'created_at' => $now]);
                DB::table('user_college_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile -> id]);
            
                Flash::success('User College T S File updated successfully.');
                return redirect(route('userCollegeTSFiles.show', [$userCollegeTSFile -> college_t_s_file_id]));
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
            $userCollegeTSFile = $this->userCollegeTSFileRepository->findWithoutFail($id);
    
            if (empty($userCollegeTSFile))
            {
                Flash::error('User College T S File not found');
                return redirect(route('userCollegeTSFiles.index'));
            }
            
            $user = DB::table('college_t_s_files')->join('college_topic_sections', 'college_t_s_files.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_files.id', '=', $userCollegeTSFile -> college_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $this->userCollegeTSFileRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_t_s_files')->join('users', 'users.id', '=', 'user_college_t_s_files.user_id')->where('user_college_t_s_files.id', '=', $userCollegeTSFile -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_f_d', 'user_id' => $user_id, 'entity_id' => $userCollegeTSFile -> college_t_s_file_id, 'created_at' => $now]);
                DB::table('user_college_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_f_id' => $userCollegeTSFile -> id]);
            
                Flash::success('User College T S File deleted successfully.');
                return redirect(route('userCollegeTSFiles.show', [$userCollegeTSFile -> college_t_s_file_id]));
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}