<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicCreateRequest;
use App\Http\Requests\UpdatePersonalDataTopicCreateRequest;
use App\Repositories\PersonalDataTopicCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicCreateController extends AppBaseController
{
    private $personalDataTopicCreateRepository;

    public function __construct(PersonalDataTopicCreateRepository $personalDataTopicCreateRepo)
    {
        $this->personalDataTopicCreateRepository = $personalDataTopicCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicCreates = $this->personalDataTopicCreateRepository->all();
    
            return view('personal_data_topic_creates.index')
                ->with('personalDataTopicCreates', $personalDataTopicCreates);
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
            return view('personal_data_topic_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTopicCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTopicCreate = $this->personalDataTopicCreateRepository->create($input);
            
                Flash::success('PersonalData Topic Create saved successfully.');
                return redirect(route('personalDataTopicCreates.index'));
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
            $personalDataTopicCreate = $this->personalDataTopicCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicCreate))
            {
                Flash::error('PersonalData Topic Create not found');
                return redirect(route('personalDataTopicCreates.index'));
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
            
            if($user_id == $personalDataTopicCreate -> user_id || $isShared)
            {
                return view('personal_data_topic_creates.show')->with('personalDataTopicCreate', $personalDataTopicCreate);
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
            $personalDataTopicCreate = $this->personalDataTopicCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicCreate))
            {
                Flash::error('PersonalData Topic Create not found');
                return redirect(route('personalDataTopicCreates.index'));
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
            
            if($user_id == $personalDataTopicCreate -> user_id || $isShared)
            {
                return view('personal_data_topic_creates.edit')->with('personalDataTopicCreate', $personalDataTopicCreate);
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

    public function update($id, UpdatePersonalDataTopicCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicCreate = $this->personalDataTopicCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicCreate))
            {
                Flash::error('PersonalData Topic Create not found');
                return redirect(route('personalDataTopicCreates.index'));
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
    
            if($user_id == $personalDataTopicCreate -> user_id || $isShared)
            {
                $personalDataTopicCreate = $this->personalDataTopicCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Create updated successfully.');
                return redirect(route('personalDataTopicCreates.index'));
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
            $personalDataTopicCreate = $this->personalDataTopicCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicCreate))
            {
                Flash::error('PersonalData Topic Create not found');
                return redirect(route('personalDataTopicCreates.index'));
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
    
            if($user_id == $personalDataTopicCreate -> user_id || $isShared)
            {
                $this->personalDataTopicCreateRepository->delete($id);
            
                Flash::success('PersonalData Topic Create deleted successfully.');
                return redirect(route('personalDataTopicCreates.index'));
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