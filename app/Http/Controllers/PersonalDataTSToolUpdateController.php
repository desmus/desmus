<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSToolUpdateRequest;
use App\Repositories\PersonalDataTSToolUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolUpdateController extends AppBaseController
{
    private $personalDataTSToolUpdateRepository;

    public function __construct(PersonalDataTSToolUpdateRepository $personalDataTSToolUpdateRepo)
    {
        $this->personalDataTSToolUpdateRepository = $personalDataTSToolUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolUpdates = $this->personalDataTSToolUpdateRepository->all();
    
            return view('personal_data_t_s_tool_updates.index')
                ->with('personalDataTSToolUpdates', $personalDataTSToolUpdates);
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
            return view('personal_data_t_s_tool_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSToolUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $personalDataTSToolUpdate = $this->personalDataTSToolUpdateRepository->create($input);
            
                Flash::success('PersonalData T S Tool Update saved successfully.');
                return redirect(route('personalDataTSToolUpdates.index'));
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
            $personalDataTSToolUpdate = $this->personalDataTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolUpdate))
            {
                Flash::error('PersonalData T S Tool Update not found');
                return redirect(route('personalDataTSToolUpdates.index'));
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
            
            if($user_id == $personalDataTSToolUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_updates.show')->with('personalDataTSToolUpdate', $personalDataTSToolUpdate);
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
            $personalDataTSToolUpdate = $this->personalDataTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolUpdate))
            {
                Flash::error('PersonalData T S Tool Update not found');
                return redirect(route('personalDataTSToolUpdates.index'));
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
            
            if($user_id == $personalDataTSToolUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_updates.edit')->with('personalDataTSToolUpdate', $personalDataTSToolUpdate);
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

    public function update($id, UpdatePersonalDataTSToolUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolUpdate = $this->personalDataTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolUpdate))
            {
                Flash::error('PersonalData T S Tool Update not found');
                return redirect(route('personalDataTSToolUpdates.index'));
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
            
            if($user_id == $personalDataTSToolUpdate -> user_id || $isShared)
            {
                $personalDataTSToolUpdate = $this->personalDataTSToolUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool Update updated successfully.');
                return redirect(route('personalDataTSToolUpdates.index'));
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
            $personalDataTSToolUpdate = $this->personalDataTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolUpdate))
            {
                Flash::error('PersonalData T S Tool Update not found');
                return redirect(route('personalDataTSToolUpdates.index'));
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
            
            if($user_id == $personalDataTSToolUpdate -> user_id || $isShared)
            {
                $this->personalDataTSToolUpdateRepository->delete($id);
            
                Flash::success('PersonalData T S Tool Update deleted successfully.');
                return redirect(route('personalDataTSToolUpdates.index'));
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