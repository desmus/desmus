<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSToolCreateRequest;
use App\Repositories\PersonalDataTSToolCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolCreateController extends AppBaseController
{
    private $personalDataTSToolCreateRepository;

    public function __construct(PersonalDataTSToolCreateRepository $personalDataTSToolCreateRepo)
    {
        $this->personalDataTSToolCreateRepository = $personalDataTSToolCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolCreates = $this->personalDataTSToolCreateRepository->all();
    
            return view('personal_data_t_s_tool_creates.index')
                ->with('personalDataTSToolCreates', $personalDataTSToolCreates);
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
            return view('personal_data_t_s_tool_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSToolCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $personalDataTSToolCreate = $this->personalDataTSToolCreateRepository->create($input);
            
                Flash::success('PersonalData T S Tool Create saved successfully.');
                return redirect(route('personalDataTSToolCreates.index'));
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
            $personalDataTSToolCreate = $this->personalDataTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolCreate))
            {
                Flash::error('PersonalData T S Tool Create not found');
                return redirect(route('personalDataTSToolCreates.index'));
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
            
            if($user_id == $personalDataTSToolCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_creates.show')->with('personalDataTSToolCreate', $personalDataTSToolCreate);
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
            $personalDataTSToolCreate = $this->personalDataTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolCreate))
            {
                Flash::error('PersonalData T S Tool Create not found');
                return redirect(route('personalDataTSToolCreates.index'));
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
            
            if($user_id == $personalDataTSToolCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_creates.edit')->with('personalDataTSToolCreate', $personalDataTSToolCreate);
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

    public function update($id, UpdatePersonalDataTSToolCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolCreate = $this->personalDataTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolCreate))
            {
                Flash::error('PersonalData T S Tool Create not found');
                return redirect(route('personalDataTSToolCreates.index'));
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
            
            if($user_id == $personalDataTSToolCreate -> user_id || $isShared)
            {
                $personalDataTSToolCreate = $this->personalDataTSToolCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool Create updated successfully.');
                return redirect(route('personalDataTSToolCreates.index'));
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
            $personalDataTSToolCreate = $this->personalDataTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolCreate))
            {
                Flash::error('PersonalData T S Tool Create not found');
                return redirect(route('personalDataTSToolCreates.index'));
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
            
            if($user_id == $personalDataTSToolCreate -> user_id || $isShared)
            {
                $this->personalDataTSToolCreateRepository->delete($id);
            
                Flash::success('PersonalData T S Tool Create deleted successfully.');
                return redirect(route('personalDataTSToolCreates.index'));
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