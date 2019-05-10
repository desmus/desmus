<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolFileViewRequest;
use App\Http\Requests\UpdatePersonalDataTSToolFileViewRequest;
use App\Repositories\PersonalDataTSToolFileViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolFileViewController extends AppBaseController
{
    private $personalDataTSToolFileViewRepository;

    public function __construct(PersonalDataTSToolFileViewRepository $personalDataTSToolFileViewRepo)
    {
        $this->personalDataTSToolFileViewRepository = $personalDataTSToolFileViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolFileViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolFileViews = $this->personalDataTSToolFileViewRepository->all();
    
            return view('personal_data_t_s_tool_file_views.index')
                ->with('personalDataTSToolFileViews', $personalDataTSToolFileViews);
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
            return view('personal_data_t_s_tool_file_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSToolFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $personalDataTSToolFileView = $this->personalDataTSToolFileViewRepository->create($input);
            
                Flash::success('PersonalData T S Tool File View saved successfully.');
                return redirect(route('personalDataTSToolFileViews.index'));
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
            $personalDataTSToolFileView = $this->personalDataTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolFileView))
            {
                Flash::error('PersonalData T S Tool File View not found');
                return redirect(route('personalDataTSToolFileViews.index'));
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
            
            if($user_id == $personalDataTSToolFileView -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_file_views.show')->with('personalDataTSToolFileView', $personalDataTSToolFileView);
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
            $personalDataTSToolFileView = $this->personalDataTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolFileView))
            {
                Flash::error('PersonalData T S Tool File View not found');
                return redirect(route('personalDataTSToolFileViews.index'));
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
            
            if($user_id == $personalDataTSToolFileView -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_file_views.edit')->with('personalDataTSToolFileView', $personalDataTSToolFileView);
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

    public function update($id, UpdatePersonalDataTSToolFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolFileView = $this->personalDataTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolFileView))
            {
                Flash::error('PersonalData T S Tool File View not found');
                return redirect(route('personalDataTSToolFileViews.index'));
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
            
            if($user_id == $personalDataTSToolFileView -> user_id || $isShared)
            {
                $personalDataTSToolFileView = $this->personalDataTSToolFileViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool File View updated successfully.');
                return redirect(route('personalDataTSToolFileViews.index'));
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
            $personalDataTSToolFileView = $this->personalDataTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolFileView))
            {
                Flash::error('PersonalData T S Tool File View not found');
                return redirect(route('personalDataTSToolFileViews.index'));
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
            
            if($user_id == $personalDataTSToolFileView -> user_id || $isShared)
            {
                $this->personalDataTSToolFileViewRepository->delete($id);
            
                Flash::success('PersonalData T S Tool File View deleted successfully.');
                return redirect(route('personalDataTSToolFileViews.index'));
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