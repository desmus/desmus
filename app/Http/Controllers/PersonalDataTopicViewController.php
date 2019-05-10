<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicViewRequest;
use App\Http\Requests\UpdatePersonalDataTopicViewRequest;
use App\Repositories\PersonalDataTopicViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicViewController extends AppBaseController
{
    private $personalDataTopicViewRepository;

    public function __construct(PersonalDataTopicViewRepository $personalDataTopicViewRepo)
    {
        $this->personalDataTopicViewRepository = $personalDataTopicViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicViews = $this->personalDataTopicViewRepository->all();
    
            return view('personal_data_topic_views.index')
                ->with('personalDataTopicViews', $personalDataTopicViews);
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
            return view('personal_data_topic_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTopicViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTopicView = $this->personalDataTopicViewRepository->create($input);
            
                Flash::success('PersonalData Topic View saved successfully.');
                return redirect(route('personalDataTopicViews.index'));
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
            $personalDataTopicView = $this->personalDataTopicViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicView))
            {
                Flash::error('PersonalData Topic View not found');
                return redirect(route('personalDataTopicViews.index'));
            }
            
            $userPersonalDataTopics = DB::table('user_personal_data_topics')->where('personal_data_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTopics as $userPersonalDataTopic)
            {
                if($userPersonalDataTopic -> user_id == $user_id && $userPersonalData -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $personalDataTopicView -> user_id || $isShared)
            {
                return view('personal_data_topic_views.show')->with('personalDataTopicView', $personalDataTopicView);
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
            $personalDataTopicView = $this->personalDataTopicViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicView))
            {
                Flash::error('PersonalData Topic View not found');
                return redirect(route('personalDataTopicViews.index'));
            }
            
            $userPersonalDataTopics = DB::table('user_personal_data_topics')->where('personal_data_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTopics as $userPersonalDataTopic)
            {
                if($userPersonalDataTopic -> user_id == $user_id && $userPersonalData -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $personalDataTopicView -> user_id || $isShared)
            {
                return view('personal_data_topic_views.edit')->with('personalDataTopicView', $personalDataTopicView);
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

    public function update($id, UpdatePersonalDataTopicViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicView = $this->personalDataTopicViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicView))
            {
                Flash::error('PersonalData Topic View not found');
                return redirect(route('personalDataTopicViews.index'));
            }
            
            $userPersonalDataTopics = DB::table('user_personal_data_topics')->where('personal_data_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTopics as $userPersonalDataTopic)
            {
                if($userPersonalDataTopic -> user_id == $user_id && $userPersonalData -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
    
            if($user_id == $personalDataTopicView -> user_id || $isShared)
            {
                $personalDataTopicView = $this->personalDataTopicViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic View updated successfully.');
                return redirect(route('personalDataTopicViews.index'));
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
            $personalDataTopicView = $this->personalDataTopicViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicView))
            {
                Flash::error('PersonalData Topic View not found');
                return redirect(route('personalDataTopicViews.index'));
            }
            
            $userPersonalDataTopics = DB::table('user_personal_data_topics')->where('personal_data_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTopics as $userPersonalDataTopic)
            {
                if($userPersonalDataTopic -> user_id == $user_id && $userPersonalData -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
    
            if($user_id == $personalDataTopicView -> user_id || $isShared)
            {
                $this->personalDataTopicViewRepository->delete($id);
            
                Flash::success('PersonalData Topic View deleted successfully.');
                return redirect(route('personalDataTopicViews.index'));
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