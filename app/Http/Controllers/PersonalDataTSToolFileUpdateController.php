<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSToolFileUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSToolFileUpdateRequest;
use App\Repositories\PersonalDataTSToolFileUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSToolFileUpdateController extends AppBaseController
{
    private $personalDataTSToolFileUpdateRepository;

    public function __construct(PersonalDataTSToolFileUpdateRepository $personalDataTSToolFileUpdateRepo)
    {
        $this->personalDataTSToolFileUpdateRepository = $personalDataTSToolFileUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSToolFileUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSToolFileUpdates = $this->personalDataTSToolFileUpdateRepository->all();
    
            return view('personal_data_t_s_tool_file_updates.index')
                ->with('personalDataTSToolFileUpdates', $personalDataTSToolFileUpdates);
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
            return view('personal_data_t_s_tool_file_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSToolFileUpdateRequest $request)
    {
        $user_id = Auth::user()->id;
        $input = $request->all();

        if($input -> user_id == $user_id)
        {
            $personalDataTSToolFileUpdate = $this->personalDataTSToolFileUpdateRepository->create($input);
        
            Flash::success('PersonalData T S Tool File Update saved successfully.');
            return redirect(route('personalDataTSToolFileUpdates.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function show($id)
    {
        $user_id = Auth::user()->id;
        $personalDataTSToolFileUpdate = $this->personalDataTSToolFileUpdateRepository->findWithoutFail($id);

        if(empty($personalDataTSToolFileUpdate))
        {
            Flash::error('PersonalData T S Tool File Update not found');
            return redirect(route('personalDataTSToolFileUpdates.index'));
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
        
        if($user_id == $personalDataTSToolFileUpdate -> user_id || $isShared)
        {
            return view('personal_data_t_s_tool_file_updates.show')->with('personalDataTSToolFileUpdate', $personalDataTSToolFileUpdate);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $personalDataTSToolFileUpdate = $this->personalDataTSToolFileUpdateRepository->findWithoutFail($id);

        if(empty($personalDataTSToolFileUpdate))
        {
            Flash::error('PersonalData T S Tool File Update not found');
            return redirect(route('personalDataTSToolFileUpdates.index'));
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
        
        if($user_id == $personalDataTSToolFileUpdate -> user_id || $isShared)
        {
            return view('personal_data_t_s_tool_file_updates.edit')->with('personalDataTSToolFileUpdate', $personalDataTSToolFileUpdate);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdatePersonalDataTSToolFileUpdateRequest $request)
    {
        $user_id = Auth::user()->id;
        $personalDataTSToolFileUpdate = $this->personalDataTSToolFileUpdateRepository->findWithoutFail($id);

        if(empty($personalDataTSToolFileUpdate))
        {
            Flash::error('PersonalData T S Tool File Update not found');
            return redirect(route('personalDataTSToolFileUpdates.index'));
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
        
        if($user_id == $personalDataTSToolFileUpdate -> user_id || $isShared)
        {
            $personalDataTSToolFileUpdate = $this->personalDataTSToolFileUpdateRepository->update($request->all(), $id);
        
            Flash::success('PersonalData T S Tool File Update updated successfully.');
            return redirect(route('personalDataTSToolFileUpdates.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $personalDataTSToolFileUpdate = $this->personalDataTSToolFileUpdateRepository->findWithoutFail($id);

        if(empty($personalDataTSToolFileUpdate))
        {
            Flash::error('PersonalData T S Tool File Update not found');
            return redirect(route('personalDataTSToolFileUpdates.index'));
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
        
        if($user_id == $personalDataTSToolFileUpdate -> user_id || $isShared)
        {
            $this->personalDataTSToolFileUpdateRepository->delete($id);
        
            Flash::success('PersonalData T S Tool File Update deleted successfully.');
            return redirect(route('personalDataTSToolFileUpdates.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}