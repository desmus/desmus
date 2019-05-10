<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicSectionDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTopicSectionDeleteRequest;
use App\Repositories\PersonalDataTopicSectionDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicSectionDeleteController extends AppBaseController
{
    private $personalDataTopicSectionDeleteRepository;

    public function __construct(PersonalDataTopicSectionDeleteRepository $personalDataTopicSectionDeleteRepo)
    {
        $this->personalDataTopicSectionDeleteRepository = $personalDataTopicSectionDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicSectionDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicSectionDeletes = $this->personalDataTopicSectionDeleteRepository->all();
    
            return view('personal_data_topic_section_deletes.index')
                ->with('personalDataTopicSectionDeletes', $personalDataTopicSectionDeletes);
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
            return view('personal_data_topic_section_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTopicSectionDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTopicSectionDelete = $this->personalDataTopicSectionDeleteRepository->create($input);
            
                Flash::success('PersonalData Topic Section Delete saved successfully.');
                return redirect(route('personalDataTopicSectionDeletes.index'));
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
            $personalDataTopicSectionDelete = $this->personalDataTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionDelete))
            {
                Flash::error('PersonalData Topic Section Delete not found');
                return redirect(route('personalDataTopicSectionDeletes.index'));
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
            
            if($user_id == $personalDataTopicSectionDelete -> user_id || $isShared)
            {
                return view('personal_data_topic_section_deletes.show')
                    ->with('personalDataTopicSectionDelete', $personalDataTopicSectionDelete);
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
            $personalDataTopicSectionDelete = $this->personalDataTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionDelete))
            {
                Flash::error('PersonalData Topic Section Delete not found');
                return redirect(route('personalDataTopicSectionDeletes.index'));
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
            
            if($user_id == $personalDataTopicSectionDelete -> user_id || $isShared)
            {
                return view('personal_data_topic_section_deletes.edit')
                    ->with('personalDataTopicSectionDelete', $personalDataTopicSectionDelete);
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

    public function update($id, UpdatePersonalDataTopicSectionDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicSectionDelete = $this->personalDataTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionDelete))
            {
                Flash::error('PersonalData Topic Section Delete not found');
                return redirect(route('personalDataTopicSectionDeletes.index'));
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
            
            if($user_id == $personalDataTopicSectionDelete -> user_id || $isShared)
            {
                $personalDataTopicSectionDelete = $this->personalDataTopicSectionDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Section Delete updated successfully.');
                return redirect(route('personalDataTopicSectionDeletes.index'));
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
            $personalDataTopicSectionDelete = $this->personalDataTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionDelete))
            {
                Flash::error('PersonalData Topic Section Delete not found');
                return redirect(route('personalDataTopicSectionDeletes.index'));
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
            
            if($user_id == $personalDataTopicSectionDelete -> user_id || $isShared)
            {
                $this->personalDataTopicSectionDeleteRepository->delete($id);
            
                Flash::success('PersonalData Topic Section Delete deleted successfully.');
                return redirect(route('personalDataTopicSectionDeletes.index'));
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