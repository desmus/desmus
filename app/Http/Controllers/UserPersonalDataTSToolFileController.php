<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserPersonalDataTSToolFileRequest;
use App\Http\Requests\UpdateUserPersonalDataTSToolFileRequest;
use App\Repositories\UserPersonalDataTSToolFileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserPersonalDataTSToolFileController extends AppBaseController
{
    private $userPersonalDataTSToolFileRepository;

    public function __construct(UserPersonalDataTSToolFileRepository $userPersonalDataTSToolFileRepo)
    {
        $this->userPersonalDataTSToolFileRepository = $userPersonalDataTSToolFileRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSToolFileRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSToolFiles = $this->userPersonalDataTSToolFileRepository->all();
    
            return view('user_personal_data_t_s_tool_files.index')
                ->with('userPersonalDataTSToolFiles', $userPersonalDataTSToolFiles);
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
            
            $userPersonalDataTSToolFilesList = DB::table('user_personal_data_t_s_tool_files')->join('users', 'user_personal_data_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_tool_files.description', 'permissions', 'user_personal_data_t_s_tool_files.datetime', 'user_personal_data_t_s_tool_files.id', 'personal_d_t_s_t_f_id')->where('personal_d_t_s_t_f_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTSToolFileViewsList = DB::table('users')->join('personal_data_t_s_tool_file_views', 'users.id', '=', 'personal_data_t_s_tool_file_views.user_id')->where('personal_d_t_s_t_f_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTSToolFileUpdatesList = DB::table('users')->join('personal_data_t_s_tool_file_updates', 'users.id', '=', 'personal_data_t_s_tool_file_updates.user_id')->where('p_d_t_s_t_f_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_personal_data_t_s_tool_files.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userPersonalDataTSToolFilesList', $userPersonalDataTSToolFilesList)
                ->with('personalDataTSToolFileViewsList', $personalDataTSToolFileViewsList)
                ->with('personalDataTSToolFileUpdatesList', $personalDataTSToolFileUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSToolFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('personal_data_t_s_tool_files')->join('personal_data_t_s_tools', 'personal_data_t_s_tool_files.personal_data_t_s_t_id', '=', 'personal_data_t_s_tools.id')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_tool_files.id', '=', $request -> personal_d_t_s_t_f_id)->get();
            
            $userPersonalDataTSToolFileCheck = DB::table('user_personal_data_t_s_tool_files')->where('user_id', '=', $request -> user_id)->where('personal_d_t_s_t_f_id', '=', $request -> personal_d_t_s_t_f_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userPersonalDataTSToolFileCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userPersonalDataTSToolFile = $this->userPersonalDataTSToolFileRepository->create($input);
                    $user = DB::table('user_personal_data_t_s_tool_files')->join('users', 'users.id', '=', 'user_personal_data_t_s_tool_files.user_id')->where('user_personal_data_t_s_tool_files.id', '=', $userPersonalDataTSToolFile -> id)->select('name')->get();
                   
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_t_f_c', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSToolFile -> personal_d_t_s_t_f_id, 'created_at' => $now]);
                    DB::table('user_personal_data_t_s_tool_file_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile -> id]);
                
                    Flash::success('User PersonalData T S Tool File saved successfully.');
                    return redirect(route('userPersonalDataTSToolFiles.show', [$userPersonalDataTSToolFile -> personal_d_t_s_t_f_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userPersonalDataTSToolFiles.show', [$request -> personal_d_t_s_t_f_id]));
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
            $userPersonalDataTSToolFile = $this->userPersonalDataTSToolFileRepository->findWithoutFail($id);
            $userPersonalDataTSToolFiles = DB::table('user_personal_data_t_s_tool_files')->join('users', 'user_personal_data_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_tool_files.description', 'permissions', 'user_personal_data_t_s_tool_files.datetime', 'user_personal_data_t_s_tool_files.id', 'personal_d_t_s_t_f_id')->where('personal_d_t_s_t_f_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userPersonalDataTSToolFiles[0]))
            {
                Flash::error('User PersonalData T S Tool File not found');
                return redirect(route('userPersonalDataTSToolFiles.create', [$id]));
            }
            
            $user = DB::table('personal_data_t_s_tool_files')->join('personal_data_t_s_tools', 'personal_data_t_s_tool_files.personal_data_t_s_t_id', '=', 'personal_data_t_s_tools.id')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_tool_files.id', '=', $userPersonalDataTSToolFiles[0] -> personal_d_t_s_t_f_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSToolFile = DB::table('personal_data_t_s_tool_files')->where('id', '=', $userPersonalDataTSToolFiles[0] -> personal_d_t_s_t_f_id)->get();
    
                $userPersonalDataTSToolFilesList = DB::table('user_personal_data_t_s_tool_files')->join('users', 'user_personal_data_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_tool_files.description', 'permissions', 'user_personal_data_t_s_tool_files.datetime', 'user_personal_data_t_s_tool_files.id', 'personal_d_t_s_t_f_id')->where('personal_d_t_s_t_f_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSToolFileViewsList = DB::table('users')->join('personal_data_t_s_tool_file_views', 'users.id', '=', 'personal_data_t_s_tool_file_views.user_id')->where('personal_d_t_s_t_f_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSToolFileUpdatesList = DB::table('users')->join('personal_data_t_s_tool_file_updates', 'users.id', '=', 'personal_data_t_s_tool_file_updates.user_id')->where('p_d_t_s_t_f_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_personal_data_t_s_tool_files.show')
                    ->with('userPersonalDataTSToolFiles', $userPersonalDataTSToolFiles)
                    ->with('id', $id)
                    ->with('personalDataTSToolFile', $personalDataTSToolFile)
                    ->with('userPersonalDataTSToolFilesList', $userPersonalDataTSToolFilesList)
                    ->with('personalDataTSToolFileViewsList', $personalDataTSToolFileViewsList)
                    ->with('personalDataTSToolFileUpdatesList', $personalDataTSToolFileUpdatesList);
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
            $userPersonalDataTSToolFile= DB::table('users')->join('user_personal_data_t_s_tool_files', 'user_personal_data_t_s_tool_files.user_id', '=', 'users.id')->where('user_personal_data_t_s_tool_files.id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tool_files.deleted_at', '=', null);})->get();
    
            if(empty($userPersonalDataTSToolFile)) 
            {
                Flash::error('User PersonalData T S Tool File not found');
                return redirect(route('userPersonalDataTSToolFiles.index'));
            }
    
            $user = DB::table('personal_data_t_s_tool_files')->join('personal_data_t_s_tools', 'personal_data_t_s_tool_files.personal_data_t_s_t_id', '=', 'personal_data_t_s_tools.id')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_tool_files.id', '=', $userPersonalDataTSToolFile[0] -> personal_d_t_s_t_f_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userPersonalDataTSToolFilesList = DB::table('user_personal_data_t_s_tool_files')->join('users', 'user_personal_data_t_s_tool_files.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_tool_files.description', 'permissions', 'user_personal_data_t_s_tool_files.datetime', 'user_personal_data_t_s_tool_files.id', 'personal_d_t_s_t_f_id')->where('personal_d_t_s_t_f_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_tool_files.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSToolFileViewsList = DB::table('users')->join('personal_data_t_s_tool_file_views', 'users.id', '=', 'personal_data_t_s_tool_file_views.user_id')->where('personal_d_t_s_t_f_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSToolFileUpdatesList = DB::table('users')->join('personal_data_t_s_tool_file_updates', 'users.id', '=', 'personal_data_t_s_tool_file_updates.user_id')->where('p_d_t_s_t_f_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_personal_data_t_s_tool_files.edit')
                    ->with('userPersonalDataTSToolFile', $userPersonalDataTSToolFile)
                    ->with('id', $userPersonalDataTSToolFile[0] -> personal_d_t_s_t_f_id)
                    ->with('userPersonalDataTSToolFilesList', $userPersonalDataTSToolFilesList)
                    ->with('personalDataTSToolFileViewsList', $personalDataTSToolFileViewsList)
                    ->with('personalDataTSToolFileUpdatesList', $personalDataTSToolFileUpdatesList);
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

    public function update($id, UpdateUserPersonalDataTSToolFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userPersonalDataTSToolFile = $this->userPersonalDataTSToolFileRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFile))
            {
                Flash::error('User PersonalData T S Tool File not found');
                return redirect(route('userPersonalDataTSToolFiles.index'));
            }
    
            $user = DB::table('personal_data_t_s_tool_files')->join('personal_data_t_s_tools', 'personal_data_t_s_tool_files.personal_data_t_s_t_id', '=', 'personal_data_t_s_tools.id')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_tool_files.id', '=', $userPersonalDataTSToolFile -> personal_d_t_s_t_f_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = Auth::user()->id;
                $userPersonalDataTSToolFile = $this->userPersonalDataTSToolFileRepository->update($request->all(), $id);
                $user = DB::table('user_personal_data_t_s_tool_files')->join('users', 'users.id', '=', 'user_personal_data_t_s_tool_files.user_id')->where('user_personal_data_t_s_tool_files.id', '=', $userPersonalDataTSToolFile -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_t_f_u', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSToolFile -> personal_d_t_s_t_f_id, 'created_at' => $now]);
                DB::table('user_personal_data_t_s_tool_file_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile -> id]);
            
                Flash::success('User PersonalData T S Tool File updated successfully.');
                return redirect(route('userPersonalDataTSToolFiles.show', [$userPersonalDataTSToolFile -> personal_d_t_s_t_f_id]));
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
            $userPersonalDataTSToolFile = $this->userPersonalDataTSToolFileRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSToolFile))
            {
                Flash::error('User PersonalData T S Tool File not found');
                return redirect(route('userPersonalDataTSToolFiles.index'));
            }
    
            $user = DB::table('personal_data_t_s_tool_files')->join('personal_data_t_s_tools', 'personal_data_t_s_tool_files.personal_data_t_s_t_id', '=', 'personal_data_t_s_tools.id')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_tool_files.id', '=', $userPersonalDataTSToolFile -> personal_d_t_s_t_f_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userPersonalDataTSToolFileRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_personal_data_t_s_tool_files')->join('users', 'users.id', '=', 'user_personal_data_t_s_tool_files.user_id')->where('user_personal_data_t_s_tool_files.id', '=', $userPersonalDataTSToolFile -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_t_f_d', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSToolFile -> personal_d_t_s_t_f_id, 'created_at' => $now]);
                DB::table('user_personal_data_t_s_tool_file_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_t_f_id' => $userPersonalDataTSToolFile -> id]);
            
                Flash::success('User PersonalData T S Tool File deleted successfully.');
                return redirect(route('userPersonalDataTSToolFiles.show', [$userPersonalDataTSToolFile -> personal_d_t_s_t_f_id]));
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