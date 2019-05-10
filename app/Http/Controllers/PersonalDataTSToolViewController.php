<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolViewRequest;
use App\Http\Requests\UpdatePersonalDataTSToolViewRequest;
use App\Repositories\PersonalDataTSToolViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolViewController extends AppBaseController
{
    private $personalDataTSToolViewRepository;

    public function __construct(PersonalDataTSToolViewRepository $personalDataTSToolViewRepo)
    {
        $this->personalDataTSToolViewRepository = $personalDataTSToolViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolViews = $this->personalDataTSToolViewRepository->all();
    
            return view('personal_data_t_s_tool_views.index')
                ->with('personalDataTSToolViews', $personalDataTSToolViews);
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
            return view('personal_data_t_s_tool_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSToolViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $personalDataTSToolView = $this->personalDataTSToolViewRepository->create($input);
            
                Flash::success('PersonalData T S Tool View saved successfully.');
                return redirect(route('personalDataTSToolViews.index'));
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
            $personalDataTSToolView = $this->personalDataTSToolViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolView))
            {
                Flash::error('PersonalData T S Tool View not found');
                return redirect(route('personalDataTSToolViews.index'));
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
            
            if($user_id == $personalDataTSToolView -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_views.show')->with('personalDataTSToolView', $personalDataTSToolView);
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
            $personalDataTSToolView = $this->personalDataTSToolViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolView))
            {
                Flash::error('PersonalData T S Tool View not found');
                return redirect(route('personalDataTSToolViews.index'));
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
            
            if($user_id == $personalDataTSToolView -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_views.edit')->with('personalDataTSToolView', $personalDataTSToolView);
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

    public function update($id, UpdatePersonalDataTSToolViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolView = $this->personalDataTSToolViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolView))
            {
                Flash::error('PersonalData T S Tool View not found');
                return redirect(route('personalDataTSToolViews.index'));
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
            
            if($user_id == $personalDataTSToolView -> user_id || $isShared)
            {
                $personalDataTSToolView = $this->personalDataTSToolViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool View updated successfully.');
                return redirect(route('personalDataTSToolViews.index'));
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
            $personalDataTSToolView = $this->personalDataTSToolViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolView))
            {
                Flash::error('PersonalData T S Tool View not found');
                return redirect(route('personalDataTSToolViews.index'));
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
            
            if($user_id == $personalDataTSToolView -> user_id || $isShared)
            {
                $this->personalDataTSToolViewRepository->delete($id);
            
                Flash::success('PersonalData T S Tool View deleted successfully.');
                return redirect(route('personalDataTSToolViews.index'));
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