<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserPersonalDataTSFileRequest;
use App\Http\Requests\UpdateUserPersonalDataTSFileRequest;
use App\Repositories\UserPersonalDataTSFileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserPersonalDataTSFileController extends AppBaseController
{
    private $userPersonalDataTSFileRepository;

    public function __construct(UserPersonalDataTSFileRepository $userPersonalDataTSFileRepo)
    {
        $this->userPersonalDataTSFileRepository = $userPersonalDataTSFileRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSFileRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSFiles = $this->userPersonalDataTSFileRepository->all();
    
            return view('user_personal_data_t_s_files.index')
                ->with('userPersonalDataTSFiles', $userPersonalDataTSFiles);
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
            
            $userPersonalDataTSFilesList = DB::table('user_personal_data_t_s_files')->join('users', 'user_personal_data_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_files.description', 'permissions', 'user_personal_data_t_s_files.datetime', 'user_personal_data_t_s_files.id', 'personal_data_t_s_file_id')->where('personal_data_t_s_file_id', '=', $id)->where(function ($query) {$query->where('user_personal_data_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTSFileViewsList = DB::table('users')->join('personal_data_t_s_file_views', 'users.id', '=', 'personal_data_t_s_file_views.user_id')->where('personal_data_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTSFileUpdatesList = DB::table('users')->join('personal_data_t_s_file_updates', 'users.id', '=', 'personal_data_t_s_file_updates.user_id')->where('personal_data_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_personal_data_t_s_files.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userPersonalDataTSFilesList', $userPersonalDataTSFilesList)
                ->with('personalDataTSFileViewsList', $personalDataTSFileViewsList)
                ->with('personalDataTSFileUpdatesList', $personalDataTSFileUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('personal_data_t_s_files')->join('personal_data_topic_sections', 'personal_data_t_s_files.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_files.id', '=', $request -> personal_data_t_s_file_id)->get();
            
            $userPersonalDataTSFileCheck = DB::table('user_personal_data_t_s_files')->where('user_id', '=', $request -> user_id)->where('personal_data_t_s_file_id', '=', $request -> personal_data_t_s_file_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userPersonalDataTSFileCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userPersonalDataTSFile = $this->userPersonalDataTSFileRepository->create($input);
                    $user = DB::table('user_personal_data_t_s_files')->join('users', 'users.id', '=', 'user_personal_data_t_s_files.user_id')->where('user_personal_data_t_s_files.id', '=', $userPersonalDataTSFile -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_f_c', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSFile -> personal_data_t_s_file_id, 'created_at' => $now]);
                    DB::table('user_personal_data_t_s_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_f_id' => $userPersonalDataTSFile -> id]);
                
                    Flash::success('User PersonalData T S File saved successfully.');
                    return redirect(route('userPersonalDataTSFiles.show', [$userPersonalDataTSFile -> personal_data_t_s_file_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
        
            return redirect(route('userPersonalDataTSFiles.show', [$request -> personal_data_t_s_file_id]));
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
            $userPersonalDataTSFile = $this->userPersonalDataTSFileRepository->findWithoutFail($id);
            $userPersonalDataTSFiles = DB::table('user_personal_data_t_s_files')->join('users', 'user_personal_data_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_files.description', 'permissions', 'user_personal_data_t_s_files.datetime', 'user_personal_data_t_s_files.id', 'personal_data_t_s_file_id')->where('personal_data_t_s_file_id', '=', $id)->where(function ($query) {$query->where('user_personal_data_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userPersonalDataTSFiles[0]))
            {
                Flash::error('User PersonalData T S File not found');
                return redirect(route('userPersonalDataTSFiles.create', [$id]));
            }
    
            $user = DB::table('personal_data_t_s_files')->join('personal_data_topic_sections', 'personal_data_t_s_files.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_files.id', '=', $userPersonalDataTSFiles[0] -> personal_data_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSFile = DB::table('personal_data_t_s_files')->where('id', '=', $userPersonalDataTSFiles[0] -> personal_data_t_s_file_id)->get();
    
                $userPersonalDataTSFilesList = DB::table('user_personal_data_t_s_files')->join('users', 'user_personal_data_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_files.description', 'permissions', 'user_personal_data_t_s_files.datetime', 'user_personal_data_t_s_files.id', 'personal_data_t_s_file_id')->where('personal_data_t_s_file_id', '=', $id)->where(function ($query) {$query->where('user_personal_data_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSFileViewsList = DB::table('users')->join('personal_data_t_s_file_views', 'users.id', '=', 'personal_data_t_s_file_views.user_id')->where('personal_data_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSFileUpdatesList = DB::table('users')->join('personal_data_t_s_file_updates', 'users.id', '=', 'personal_data_t_s_file_updates.user_id')->where('personal_data_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_personal_data_t_s_files.show')
                    ->with('userPersonalDataTSFiles', $userPersonalDataTSFiles)
                    ->with('id', $id)
                    ->with('personalDataTSFile', $personalDataTSFile)
                    ->with('userPersonalDataTSFilesList', $userPersonalDataTSFilesList)
                    ->with('personalDataTSFileViewsList', $personalDataTSFileViewsList)
                    ->with('personalDataTSFileUpdatesList', $personalDataTSFileUpdatesList);
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
            $userPersonalDataTSFile = DB::table('users')->join('user_personal_data_t_s_files', 'user_personal_data_t_s_files.user_id', '=', 'users.id')->where('user_personal_data_t_s_files.id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_files.deleted_at', '=', null);})->get();
    
            if(empty($userPersonalDataTSFile))
            {
                Flash::error('User PersonalData T S File not found');
                return redirect(route('userPersonalDataTSFiles.index'));
            }
            
            $user = DB::table('personal_data_t_s_files')->join('personal_data_topic_sections', 'personal_data_t_s_files.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_files.id', '=', $userPersonalDataTSFile[0] -> personal_data_t_s_file_id)->get();
    
            $userPersonalDataTSFilesList = DB::table('user_personal_data_t_s_files')->join('users', 'user_personal_data_t_s_files.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_files.description', 'permissions', 'user_personal_data_t_s_files.datetime', 'user_personal_data_t_s_files.id', 'personal_data_t_s_file_id')->where('personal_data_t_s_file_id', '=', $id)->where(function ($query) {$query->where('user_personal_data_t_s_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTSFileViewsList = DB::table('users')->join('personal_data_t_s_file_views', 'users.id', '=', 'personal_data_t_s_file_views.user_id')->where('personal_data_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTSFileUpdatesList = DB::table('users')->join('personal_data_t_s_file_updates', 'users.id', '=', 'personal_data_t_s_file_updates.user_id')->where('personal_data_t_s_file_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_files.edit')
                    ->with('userPersonalDataTSFile', $userPersonalDataTSFile)
                    ->with('id', $userPersonalDataTSFile[0] -> personal_data_t_s_file_id)
                    ->with('userPersonalDataTSFilesList', $userPersonalDataTSFilesList)
                    ->with('personalDataTSFileViewsList', $personalDataTSFileViewsList)
                    ->with('personalDataTSFileUpdatesList', $personalDataTSFileUpdatesList);
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

    public function update($id, UpdateUserPersonalDataTSFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userPersonalDataTSFile = $this->userPersonalDataTSFileRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFile))
            {
                Flash::error('User PersonalData T S File not found');
                return redirect(route('userPersonalDataTSFiles.index'));
            }
    
            $user = DB::table('personal_data_t_s_files')->join('personal_data_topic_sections', 'personal_data_t_s_files.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_files.id', '=', $userPersonalDataTSFile -> personal_data_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $userPersonalDataTSFile = $this->userPersonalDataTSFileRepository->update($request->all(), $id);
                $user = DB::table('user_personal_data_t_s_files')->join('users', 'users.id', '=', 'user_personal_data_t_s_files.user_id')->where('user_personal_data_t_s_files.id', '=', $userPersonalDataTSFile -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_f_u', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSFile -> personal_data_t_s_file_id, 'created_at' => $now]);
                DB::table('user_personal_data_t_s_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_f_id' => $userPersonalDataTSFile -> id]);
            
                Flash::success('User PersonalData T S File updated successfully.');
                return redirect(route('userPersonalDataTSFiles.show', [$userPersonalDataTSFile -> personal_data_t_s_file_id]));
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
            $userPersonalDataTSFile = $this->userPersonalDataTSFileRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSFile))
            {
                Flash::error('User PersonalData T S File not found');
                return redirect(route('userPersonalDataTSFiles.index'));
            }
    
            $user = DB::table('personal_data_t_s_files')->join('personal_data_topic_sections', 'personal_data_t_s_files.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_files.id', '=', $userPersonalDataTSFile -> personal_data_t_s_file_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $this->userPersonalDataTSFileRepository->delete($id);
                $user = DB::table('user_personal_data_t_s_files')->join('users', 'users.id', '=', 'user_personal_data_t_s_files.user_id')->where('user_personal_data_t_s_files.id', '=', $userPersonalDataTSFile -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_f_d', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSFile -> personal_data_t_s_file_id, 'created_at' => $now]);
                DB::table('user_personal_data_t_s_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_f_id' => $userPersonalDataTSFile -> id]);
            
                Flash::success('User PersonalData T S File deleted successfully.');
                return redirect(route('userPersonalDataTSFiles.show', [$userPersonalDataTSFile -> personal_data_t_s_file_id]));
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