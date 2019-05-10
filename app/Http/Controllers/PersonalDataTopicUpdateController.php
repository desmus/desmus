<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTopicUpdateRequest;
use App\Repositories\PersonalDataTopicUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicUpdateController extends AppBaseController
{
    private $personalDataTopicUpdateRepository;

    public function __construct(PersonalDataTopicUpdateRepository $personalDataTopicUpdateRepo)
    {
        $this->personalDataTopicUpdateRepository = $personalDataTopicUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicUpdates = $this->personalDataTopicUpdateRepository->all();
    
            return view('personal_data_topic_updates.index')
                ->with('personalDataTopicUpdates', $personalDataTopicUpdates);
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
            return view('personal_data_topic_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTopicUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTopicUpdate = $this->personalDataTopicUpdateRepository->create($input);
            
                Flash::success('PersonalData Topic Update saved successfully.');
                return redirect(route('personalDataTopicUpdates.index'));
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
            $personalDataTopicUpdate = $this->personalDataTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicUpdate))
            {
                Flash::error('PersonalData Topic Update not found');
                return redirect(route('personalDataTopicUpdates.index'));
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
            
            if($user_id == $personalDataTopicUpdate -> user_id || $isShared)
            {
                return view('personal_data_topic_updates.show')->with('personalDataTopicUpdate', $personalDataTopicUpdate);
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
            $personalDataTopicUpdate = $this->personalDataTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicUpdate))
            {
                Flash::error('PersonalData Topic Update not found');
                return redirect(route('personalDataTopicUpdates.index'));
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
            
            if($user_id == $personalDataTopicUpdate -> user_id || $isShared)
            {
                return view('personal_data_topic_updates.edit')->with('personalDataTopicUpdate', $personalDataTopicUpdate);
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

    public function update($id, UpdatePersonalDataTopicUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicUpdate = $this->personalDataTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicUpdate))
            {
                Flash::error('PersonalData Topic Update not found');
                return redirect(route('personalDataTopicUpdates.index'));
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
    
            if($user_id == $personalDataTopicUpdate -> user_id || $isShared)
            {
                $personalDataTopicUpdate = $this->personalDataTopicUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Update updated successfully.');
                return redirect(route('personalDataTopicUpdates.index'));
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
            $personalDataTopicUpdate = $this->personalDataTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicUpdate))
            {
                Flash::error('PersonalData Topic Update not found');
                return redirect(route('personalDataTopicUpdates.index'));
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
    
            if($user_id == $personalDataTopicUpdate -> user_id || $isShared)
            {
                $this->personalDataTopicUpdateRepository->delete($id);
            
                Flash::success('PersonalData Topic Update deleted successfully.');
                return redirect(route('personalDataTopicUpdates.index'));
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