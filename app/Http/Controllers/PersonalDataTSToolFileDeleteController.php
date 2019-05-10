<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolFileDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSToolFileDeleteRequest;
use App\Repositories\PersonalDataTSToolFileDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolFileDeleteController extends AppBaseController
{
    private $personalDataTSToolFileDeleteRepository;

    public function __construct(PersonalDataTSToolFileDeleteRepository $personalDataTSToolFileDeleteRepo)
    {
        $this->personalDataTSToolFileDeleteRepository = $personalDataTSToolFileDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolFileDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolFileDeletes = $this->personalDataTSToolFileDeleteRepository->all();
    
            return view('personal_data_t_s_tool_file_deletes.index')
                ->with('personalDataTSToolFileDeletes', $personalDataTSToolFileDeletes);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        if(Auth::user() != null)
        {
            return view('personal_data_t_s_tool_file_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSToolFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $personalDataTSToolFileDelete = $this->personalDataTSToolFileDeleteRepository->create($input);
            
                Flash::success('PersonalData T S Tool File Delete saved successfully.');
                return redirect(route('personalDataTSToolFileDeletes.index'));
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

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolFileDelete = $this->personalDataTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolFileDelete))
            {
                Flash::error('PersonalData T S Tool File Delete not found');
                return redirect(route('personalDataTSToolFileDeletes.index'));
            }
            
            $userPersonalDataTSToolFiles = DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSToolFiles as $userPersonalDataTSToolFile)
            {
                if($userPersonalDataTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_tool_files')->join('personal_data_t_s_tools', 'personal_data_t_s_tool_files.personal_data_t_s_t_id', '=', 'personal_data_t_s_tools.id')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $personalDataTSToolFileDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_file_deletes.show')->with('personalDataTSToolFileDelete', $personalDataTSToolFileDelete);
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
            $personalDataTSToolFileDelete = $this->personalDataTSToolFileDeleteRepository->findWithoutFail($id);
    
            if (empty($personalDataTSToolFileDelete))
            {
                Flash::error('PersonalData T S Tool File Delete not found');
                return redirect(route('personalDataTSToolFileDeletes.index'));
            }
    
            $userPersonalDataTSToolFiles = DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSToolFiles as $userPersonalDataTSToolFile)
            {
                if($userPersonalDataTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_tool_files')->join('personal_data_t_s_tools', 'personal_data_t_s_tool_files.personal_data_t_s_t_id', '=', 'personal_data_t_s_tools.id')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $personalDataTSToolFileDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_file_deletes.edit')->with('personalDataTSToolFileDelete', $personalDataTSToolFileDelete);
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

    public function update($id, UpdatePersonalDataTSToolFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolFileDelete = $this->personalDataTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolFileDelete))
            {
                Flash::error('PersonalData T S Tool File Delete not found');
                return redirect(route('personalDataTSToolFileDeletes.index'));
            }
            
            $userPersonalDataTSToolFiles = DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSToolFiles as $userPersonalDataTSToolFile)
            {
                if($userPersonalDataTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_tool_files')->join('personal_data_t_s_tools', 'personal_data_t_s_tool_files.personal_data_t_s_t_id', '=', 'personal_data_t_s_tools.id')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $personalDataTSToolFileDelete -> user_id || $isShared)
            {
                $personalDataTSToolFileDelete = $this->personalDataTSToolFileDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool File Delete updated successfully.');
                return redirect(route('personalDataTSToolFileDeletes.index'));
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
            $user_id = Auth::user()->id;
            $personalDataTSToolFileDelete = $this->personalDataTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolFileDelete))
            {
                Flash::error('PersonalData T S Tool File Delete not found');
                return redirect(route('personalDataTSToolFileDeletes.index'));
            }
            
            $userPersonalDataTSToolFiles = DB::table('user_personal_data_t_s_tool_files')->where('personal_d_t_s_t_f_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSToolFiles as $userPersonalDataTSToolFile)
            {
                if($userPersonalDataTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_tool_files')->join('personal_data_t_s_tools', 'personal_data_t_s_tool_files.personal_data_t_s_t_id', '=', 'personal_data_t_s_tools.id')->join('personal_data_topic_sections', 'personal_data_t_s_tools.personal_data_topic_section_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $personalDataTSToolFileDelete -> user_id || $isShared)
            {
                $this->personalDataTSToolFileDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S Tool File Delete deleted successfully.');
                return redirect(route('personalDataTSToolFileDeletes.index'));
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