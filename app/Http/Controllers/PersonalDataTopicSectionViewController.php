<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicSectionViewRequest;
use App\Http\Requests\UpdatePersonalDataTopicSectionViewRequest;
use App\Repositories\PersonalDataTopicSectionViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicSectionViewController extends AppBaseController
{
    private $personalDataTopicSectionViewRepository;

    public function __construct(PersonalDataTopicSectionViewRepository $personalDataTopicSectionViewRepo)
    {
        $this->personalDataTopicSectionViewRepository = $personalDataTopicSectionViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicSectionViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicSectionViews = $this->personalDataTopicSectionViewRepository->all();
    
            return view('personal_data_topic_section_views.index')
                ->with('personalDataTopicSectionViews', $personalDataTopicSectionViews);
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
            return view('personal_data_topic_section_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTopicSectionViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTopicSectionView = $this->personalDataTopicSectionViewRepository->create($input);
            
                Flash::success('PersonalData Topic Section View saved successfully.');
                return redirect(route('personalDataTopicSectionViews.index'));
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
            $personalDataTopicSectionView = $this->personalDataTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionView))
            {
                Flash::error('PersonalData Topic Section View not found');
                return redirect(route('personalDataTopicSectionViews.index'));
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
            
            if($user_id == $personalDataTopicSectionView -> user_id || $isShared)
            {
                return view('personal_data_topic_section_views.show')
                    ->with('personalDataTopicSectionView', $personalDataTopicSectionView);
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
            $personalDataTopicSectionView = $this->personalDataTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionView))
            {
                Flash::error('PersonalData Topic Section View not found');
                return redirect(route('personalDataTopicSectionViews.index'));
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
            
            if($user_id == $personalDataTopicSectionView -> user_id || $isShared)
            {
                return view('personal_data_topic_section_views.edit')
                    ->with('personalDataTopicSectionView', $personalDataTopicSectionView);
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

    public function update($id, UpdatePersonalDataTopicSectionViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicSectionView = $this->personalDataTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionView))
            {
                Flash::error('PersonalData Topic Section View not found');
                return redirect(route('personalDataTopicSectionViews.index'));
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
            
            if($user_id == $personalDataTopicSectionView -> user_id || $isShared)
            {
                $personalDataTopicSectionView = $this->personalDataTopicSectionViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Section View updated successfully.');
                return redirect(route('personalDataTopicSectionViews.index'));
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
            $personalDataTopicSectionView = $this->personalDataTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicSectionView))
            {
                Flash::error('PersonalData Topic Section View not found');
                return redirect(route('personalDataTopicSectionViews.index'));
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
            
            if($user_id == $personalDataTopicSectionView -> user_id || $isShared)
            {
                $this->personalDataTopicSectionViewRepository->delete($id);
            
                Flash::success('PersonalData Topic Section View deleted successfully.');
                return redirect(route('personalDataTopicSectionViews.index'));
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