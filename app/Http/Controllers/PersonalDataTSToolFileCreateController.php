<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolFileCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSToolFileCreateRequest;
use App\Repositories\PersonalDataTSToolFileCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolFileCreateController extends AppBaseController
{
    private $personalDataTSToolFileCreateRepository;

    public function __construct(PersonalDataTSToolFileCreateRepository $personalDataTSToolFileCreateRepo)
    {
        $this->personalDataTSToolFileCreateRepository = $personalDataTSToolFileCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolFileCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolFileCreates = $this->personalDataTSToolFileCreateRepository->all();
    
            return view('personal_data_t_s_tool_file_creates.index')
                ->with('personalDataTSToolFileCreates', $personalDataTSToolFileCreates);
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
            return view('personal_data_t_s_tool_file_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSToolFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $personalDataTSToolFileCreate = $this->personalDataTSToolFileCreateRepository->create($input);
            
                Flash::success('PersonalData T S Tool File Create saved successfully.');
                return redirect(route('personalDataTSToolFileCreates.index'));
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
            $personalDataTSToolFileCreate = $this->personalDataTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolFileCreate))
            {
                Flash::error('PersonalData T S Tool File Create not found');
                return redirect(route('personalDataTSToolFileCreates.index'));
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
            
            if($user_id == $personalDataTSToolFileCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_file_creates.show')->with('personalDataTSToolFileCreate', $personalDataTSToolFileCreate);
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
            $personalDataTSToolFileCreate = $this->personalDataTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolFileCreate))
            {
                Flash::error('PersonalData T S Tool File Create not found');
                return redirect(route('personalDataTSToolFileCreates.index'));
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
            
            if($user_id == $personalDataTSToolFileCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_file_creates.edit')->with('personalDataTSToolFileCreate', $personalDataTSToolFileCreate);
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

    public function update($id, UpdatePersonalDataTSToolFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolFileCreate = $this->personalDataTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolFileCreate))
            {
                Flash::error('PersonalData T S Tool File Create not found');
                return redirect(route('personalDataTSToolFileCreates.index'));
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
            
            if($user_id == $personalDataTSToolFileCreate -> user_id || $isShared)
            {
                $personalDataTSToolFileCreate = $this->personalDataTSToolFileCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool File Create updated successfully.');
                return redirect(route('personalDataTSToolFileCreates.index'));
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
            $personalDataTSToolFileCreate = $this->personalDataTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolFileCreate))
            {
                Flash::error('PersonalData T S Tool File Create not found');
                return redirect(route('personalDataTSToolFileCreates.index'));
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
            
            if($user_id == $personalDataTSToolFileCreate -> user_id || $isShared)
            {
                $this->personalDataTSToolFileCreateRepository->delete($id);
            
                Flash::success('PersonalData T S Tool File Create deleted successfully.');
                return redirect(route('personalDataTSToolFileCreates.index'));
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