<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserJobTSFileRequest;
use App\Http\Requests\UpdateUserJobTSFileRequest;
use App\Repositories\UserJobTSFileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserJobTSFileController extends AppBaseController
{
    private $userJobTSFileRepository;

    public function __construct(UserJobTSFileRepository $userJobTSFileRepo)
    {
        $this->userJobTSFileRepository = $userJobTSFileRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSFileRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSFiles = $this->userJobTSFileRepository->all();
    
            return view('user_job_t_s_files.index')
                ->with('userJobTSFiles', $userJobTSFiles);
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
            
            $userJobTSFilesList = DB::table('user_job_t_s_files')->join('users', 'user_job_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_files.description', 'permissions', 'user_job_t_s_files.datetime', 'user_job_t_s_files.id', 'job_t_s_file_id')->where('job_t_s_file_id', $id)->where(function ($query) {$query->where('user_job_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $jobTSFileViewsList = DB::table('users')->join('job_t_s_file_views', 'users.id', '=', 'job_t_s_file_views.user_id')->where('job_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $jobTSFileUpdatesList = DB::table('users')->join('job_t_s_file_updates', 'users.id', '=', 'job_t_s_file_updates.user_id')->where('job_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_job_t_s_files.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userJobTSFilesList', $userJobTSFilesList)
                ->with('jobTSFileViewsList', $jobTSFileViewsList)
                ->with('jobTSFileUpdatesList', $jobTSFileUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('job_t_s_files')->join('job_topic_sections', 'job_t_s_files.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_files.id', '=', $request -> job_t_s_file_id)->get();
            
            $userJobTSFileCheck = DB::table('user_job_t_s_files')->where('user_id', '=', $request -> user_id)->where('job_t_s_file_id', '=', $request -> job_t_s_file_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userJobTSFileCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userJobTSFile = $this->userJobTSFileRepository->create($input);
                    $user = DB::table('user_job_t_s_files')->join('users', 'users.id', '=', 'user_job_t_s_files.user_id')->where('user_job_t_s_files.id', '=', $userJobTSFile -> id)->select('name')->get();
                   
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_f_c', 'user_id' => $user_id, 'entity_id' => $userJobTSFile -> job_t_s_file_id, 'created_at' => $now]);
                    DB::table('user_job_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_f_id' => $userJobTSFile -> id]);
                
                    Flash::success('User Job T S File saved successfully.');
                    return redirect(route('userJobTSFiles.show', [$userJobTSFile -> job_t_s_file_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userJobTSFiles.show', [$request -> job_t_s_file_id]));
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
            $userJobTSFile = $this->userJobTSFileRepository->findWithoutFail($id);
            $userJobTSFiles = DB::table('user_job_t_s_files')->join('users', 'user_job_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_files.description', 'permissions', 'user_job_t_s_files.datetime', 'user_job_t_s_files.id', 'job_t_s_file_id')->where('job_t_s_file_id', $id)->where(function ($query) {$query->where('user_job_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userJobTSFiles[0]))
            {
                Flash::error('User Job T S File not found');
                return redirect(route('userJobTSFiles.create', [$id]));
            }
    
            $user = DB::table('job_t_s_files')->join('job_topic_sections', 'job_t_s_files.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_files.id', '=', $userJobTSFiles[0] -> job_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $jobTSFile = DB::table('job_t_s_files')->where('id', '=', $userJobTSFiles[0] -> job_t_s_file_id)->get();
    
                $userJobTSFilesList = DB::table('user_job_t_s_files')->join('users', 'user_job_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_files.description', 'permissions', 'user_job_t_s_files.datetime', 'user_job_t_s_files.id', 'job_t_s_file_id')->where('job_t_s_file_id', $id)->where(function ($query) {$query->where('user_job_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSFileViewsList = DB::table('users')->join('job_t_s_file_views', 'users.id', '=', 'job_t_s_file_views.user_id')->where('job_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSFileUpdatesList = DB::table('users')->join('job_t_s_file_updates', 'users.id', '=', 'job_t_s_file_updates.user_id')->where('job_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_job_t_s_files.show')
                    ->with('userJobTSFiles', $userJobTSFiles)
                    ->with('id', $id)
                    ->with('jobTSFile', $jobTSFile)
                    ->with('userJobTSFilesList', $userJobTSFilesList)
                    ->with('jobTSFileViewsList', $jobTSFileViewsList)
                    ->with('jobTSFileUpdatesList', $jobTSFileUpdatesList);
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
            $userJobTSFile = DB::table('users')->join('user_job_t_s_files', 'user_job_t_s_files.user_id', '=', 'users.id')->where('user_job_t_s_files.id', $id)->where(function ($query) {$query->where('user_job_t_s_files.deleted_at', '=', null);})->get();
    
            if(empty($userJobTSFile[0]))
            {
                Flash::error('User Job T S File not found');
                return redirect(route('userJobTSFiles.index'));
            }
    
            $user = DB::table('job_t_s_files')->join('job_topic_sections', 'job_t_s_files.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_files.id', '=', $userJobTSFile[0] -> job_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $userJobTSFilesList = DB::table('user_job_t_s_files')->join('users', 'user_job_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_files.description', 'permissions', 'user_job_t_s_files.datetime', 'user_job_t_s_files.id', 'job_t_s_file_id')->where('job_t_s_file_id', $id)->where(function ($query) {$query->where('user_job_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSFileViewsList = DB::table('users')->join('job_t_s_file_views', 'users.id', '=', 'job_t_s_file_views.user_id')->where('job_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSFileUpdatesList = DB::table('users')->join('job_t_s_file_updates', 'users.id', '=', 'job_t_s_file_updates.user_id')->where('job_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_job_t_s_files.edit')
                    ->with('userJobTSFile', $userJobTSFile)
                    ->with('id', $userJobTSFile[0] -> job_t_s_file_id)
                    ->with('userJobTSFilesList', $userJobTSFilesList)
                    ->with('jobTSFileViewsList', $jobTSFileViewsList)
                    ->with('jobTSFileUpdatesList', $jobTSFileUpdatesList);
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

    public function update($id, UpdateUserJobTSFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userJobTSFile = $this->userJobTSFileRepository->findWithoutFail($id);
    
            if(empty($userJobTSFile))
            {
                Flash::error('User Job T S File not found');
                return redirect(route('userJobTSFiles.index'));
            }
    
            $user = DB::table('job_t_s_files')->join('job_topic_sections', 'job_t_s_files.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_files.id', '=', $userJobTSFile -> job_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $userJobTSFile = $this->userJobTSFileRepository->update($request->all(), $id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_t_s_files')->join('users', 'users.id', '=', 'user_job_t_s_files.user_id')->where('user_job_t_s_files.id', '=', $userJobTSFile -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_f_u', 'user_id' => $user_id, 'entity_id' => $userJobTSFile -> job_t_s_file_id, 'created_at' => $now]);
                DB::table('user_job_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_f_id' => $userJobTSFile -> id]);
            
                Flash::success('User Job T S File updated successfully.');
                return redirect(route('userJobTSFiles.show', [$userJobTSFile -> job_t_s_file_id]));
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
            $userJobTSFile = $this->userJobTSFileRepository->findWithoutFail($id);
    
            if(empty($userJobTSFile))
            {
                Flash::error('User Job T S File not found');
                return redirect(route('userJobTSFiles.index'));
            }
            
            $user = DB::table('job_t_s_files')->join('job_topic_sections', 'job_t_s_files.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_files.id', '=', $userJobTSFile -> job_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $this->userJobTSFileRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_t_s_files')->join('users', 'users.id', '=', 'user_job_t_s_files.user_id')->where('user_job_t_s_files.id', '=', $userJobTSFile -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_f_d', 'user_id' => $user_id, 'entity_id' => $userJobTSFile -> job_t_s_file_id, 'created_at' => $now]);
                DB::table('user_job_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_f_id' => $userJobTSFile -> id]);
            
                Flash::success('User Job T S File deleted successfully.');
                return redirect(route('userJobTSFiles.show', [$userJobTSFile -> job_t_s_file_id]));
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}