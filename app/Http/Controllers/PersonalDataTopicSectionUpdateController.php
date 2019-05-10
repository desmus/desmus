<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicSectionUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTopicSectionUpdateRequest;
use App\Repositories\PersonalDataTopicSectionUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicSectionUpdateController extends AppBaseController
{
    private $personalDataTopicSectionUpdateRepository;

    public function __construct(PersonalDataTopicSectionUpdateRepository $personalDataTopicSectionUpdateRepo)
    {
        $this->personalDataTopicSectionUpdateRepository = $personalDataTopicSectionUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicSectionUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicSectionUpdates = $this->personalDataTopicSectionUpdateRepository->all();
    
            return view('personal_data_topic_section_updates.index')
                ->with('personalDataTopicSectionUpdates', $personalDataTopicSectionUpdates);
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
            return view('personal_data_topic_section_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTopicSectionUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTopicSectionUpdate = $this->personalDataTopicSectionUpdateRepository->create($input);
            
                Flash::success('PersonalData Topic Section Update saved successfully.');
                return redirect(route('personalDataTopicSectionUpdates.index'));
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
            $personalDataTopicSectionUpdate = $this->personalDataTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionUpdate))
            {
                Flash::error('PersonalData Topic Section Update not found');
                return redirect(route('personalDataTopicSectionUpdates.index'));
            }
            
            $userPersonalDataTopicSections = DB::table('user_personal_data_topic_sections')->where('personal_data_t_s_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTopicSections as $userPersonalDataTopicSection)
            {
                if($userPersonalDataTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_topic_sections')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_topic_sections.id', '=', $id)->get();
            
            if($user_id == $personalDataTopicSectionUpdate -> user_id || $isShared)
            {
                return view('personal_data_topic_section_updates.show')
                    ->with('personalDataTopicSectionUpdate', $personalDataTopicSectionUpdate);
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
            $personalDataTopicSectionUpdate = $this->personalDataTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionUpdate))
            {
                Flash::error('PersonalData Topic Section Update not found');
                return redirect(route('personalDataTopicSectionUpdates.index'));
            }
            
            $userPersonalDataTopicSections = DB::table('user_personal_data_topic_sections')->where('personal_data_t_s_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTopicSections as $userPersonalDataTopicSection)
            {
                if($userPersonalDataTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_topic_sections')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_topic_sections.id', '=', $id)->get();
            
            if($user_id == $personalDataTopicSectionUpdate -> user_id || $isShared)
            {
                return view('personal_data_topic_section_updates.edit')
                    ->with('personalDataTopicSectionUpdate', $personalDataTopicSectionUpdate);
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

    public function update($id, UpdatePersonalDataTopicSectionUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicSectionUpdate = $this->personalDataTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionUpdate))
            {
                Flash::error('PersonalData Topic Section Update not found');
                return redirect(route('personalDataTopicSectionUpdates.index'));
            }
            
            $userPersonalDataTopicSections = DB::table('user_personal_data_topic_sections')->where('personal_data_t_s_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTopicSections as $userPersonalDataTopicSection)
            {
                if($userPersonalDataTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_topic_sections')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_topic_sections.id', '=', $id)->get();
            
            if($user_id == $personalDataTopicSectionUpdate -> user_id || $isShared)
            {
                $personalDataTopicSectionUpdate = $this->personalDataTopicSectionUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Section Update updated successfully.');
                return redirect(route('personalDataTopicSectionUpdates.index'));
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
            $personalDataTopicSectionUpdate = $this->personalDataTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionUpdate))
            {
                Flash::error('PersonalData Topic Section Update not found');
                return redirect(route('personalDataTopicSectionUpdates.index'));
            }
            
            $userPersonalDataTopicSections = DB::table('user_personal_data_topic_sections')->where('personal_data_t_s_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTopicSections as $userPersonalDataTopicSection)
            {
                if($userPersonalDataTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_topic_sections')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_topic_sections.id', '=', $id)->get();
            
            if($user_id == $personalDataTopicSectionUpdate -> user_id || $isShared)
            {
                $this->personalDataTopicSectionUpdateRepository->delete($id);
            
                Flash::success('PersonalData Topic Section Update deleted successfully.');
                return redirect(route('personalDataTopicSectionUpdates.index'));
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