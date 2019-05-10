<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicSectionCreateRequest;
use App\Http\Requests\UpdatePersonalDataTopicSectionCreateRequest;
use App\Repositories\PersonalDataTopicSectionCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicSectionCreateController extends AppBaseController
{
    private $personalDataTopicSectionCreateRepository;

    public function __construct(PersonalDataTopicSectionCreateRepository $personalDataTopicSectionCreateRepo)
    {
        $this->personalDataTopicSectionCreateRepository = $personalDataTopicSectionCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicSectionCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicSectionCreates = $this->personalDataTopicSectionCreateRepository->all();
    
            return view('personal_data_topic_section_creates.index')
                ->with('personalDataTopicSectionCreates', $personalDataTopicSectionCreates);
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
            return view('personal_data_topic_section_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTopicSectionCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTopicSectionCreate = $this->personalDataTopicSectionCreateRepository->create($input);
            
                Flash::success('PersonalData Topic Section Create saved successfully.');
                return redirect(route('personalDataTopicSectionCreates.index'));
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
            $personalDataTopicSectionCreate = $this->personalDataTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionCreate))
            {
                Flash::error('PersonalData Topic Section Create not found');
                return redirect(route('personalDataTopicSectionCreates.index'));
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
            
            if($user_id == $personalDataTopicSectionCreate -> user_id || $isShared)
            {
                return view('personal_data_topic_section_creates.show')
                    ->with('personalDataTopicSectionCreate', $personalDataTopicSectionCreate);
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
            $personalDataTopicSectionCreate = $this->personalDataTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionCreate))
            {
                Flash::error('PersonalData Topic Section Create not found');
                return redirect(route('personalDataTopicSectionCreates.index'));
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
            
            if($user_id == $personalDataTopicSectionCreate -> user_id || $isShared)
            {
                return view('personal_data_topic_section_creates.edit')
                    ->with('personalDataTopicSectionCreate', $personalDataTopicSectionCreate);
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

    public function update($id, UpdatePersonalDataTopicSectionCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicSectionCreate = $this->personalDataTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionCreate))
            {
                Flash::error('PersonalData Topic Section Create not found');
                return redirect(route('personalDataTopicSectionCreates.index'));
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
            
            if($user_id == $personalDataTopicSectionCreate -> user_id || $isShared)
            {
                $personalDataTopicSectionCreate = $this->personalDataTopicSectionCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Section Create updated successfully.');
                return redirect(route('personalDataTopicSectionCreates.index'));
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
            $personalDataTopicSectionCreate = $this->personalDataTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionCreate))
            {
                Flash::error('PersonalData Topic Section Create not found');
                return redirect(route('personalDataTopicSectionCreates.index'));
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
            
            if($user_id == $personalDataTopicSectionCreate -> user_id || $isShared)
            {
                $this->personalDataTopicSectionCreateRepository->delete($id);
            
                Flash::success('PersonalData Topic Section Create deleted successfully.');
                return redirect(route('personalDataTopicSectionCreates.index'));
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