<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSToolDeleteRequest;
use App\Repositories\PersonalDataTSToolDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolDeleteController extends AppBaseController
{
    private $personalDataTSToolDeleteRepository;

    public function __construct(PersonalDataTSToolDeleteRepository $personalDataTSToolDeleteRepo)
    {
        $this->personalDataTSToolDeleteRepository = $personalDataTSToolDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolDeletes = $this->personalDataTSToolDeleteRepository->all();
    
            return view('personal_data_t_s_tool_deletes.index')
                ->with('personalDataTSToolDeletes', $personalDataTSToolDeletes);
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
            return view('personal_data_t_s_tool_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSToolDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $personalDataTSToolDelete = $this->personalDataTSToolDeleteRepository->create($input);
            
                Flash::success('PersonalData T S Tool Delete saved successfully.');
                return redirect(route('personalDataTSToolDeletes.index'));
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
            $personalDataTSToolDelete = $this->personalDataTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolDelete))
            {
                Flash::error('PersonalData T S Tool Delete not found');
                return redirect(route('personalDataTSToolDeletes.index'));
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
            
            if($user_id == $personalDataTSToolDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_deletes.show')->with('personalDataTSToolDelete', $personalDataTSToolDelete);
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
            $personalDataTSToolDelete = $this->personalDataTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolDelete))
            {
                Flash::error('PersonalData T S Tool Delete not found');
                return redirect(route('personalDataTSToolDeletes.index'));
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
            
            if($user_id == $personalDataTSToolDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_tool_deletes.edit')->with('personalDataTSToolDelete', $personalDataTSToolDelete);
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

    public function update($id, UpdatePersonalDataTSToolDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSToolDelete = $this->personalDataTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolDelete))
            {
                Flash::error('PersonalData T S Tool Delete not found');
                return redirect(route('personalDataTSToolDeletes.index'));
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
            
            if($user_id == $personalDataTSToolDelete -> user_id || $isShared)
            {
                $personalDataTSToolDelete = $this->personalDataTSToolDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Tool Delete updated successfully.');
                return redirect(route('personalDataTSToolDeletes.index'));
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
            $personalDataTSToolDelete = $this->personalDataTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSToolDelete))
            {
                Flash::error('PersonalData T S Tool Delete not found');
                return redirect(route('personalDataTSToolDeletes.index'));
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
            
            if($user_id == $personalDataTSToolDelete -> user_id || $isShared)
            {
                $this->personalDataTSToolDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S Tool Delete deleted successfully.');
                return redirect(route('personalDataTSToolDeletes.index'));
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