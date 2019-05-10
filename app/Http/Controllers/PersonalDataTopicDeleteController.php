<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTopicDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTopicDeleteRequest;
use App\Repositories\PersonalDataTopicDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTopicDeleteController extends AppBaseController
{
    private $personalDataTopicDeleteRepository;

    public function __construct(PersonalDataTopicDeleteRepository $personalDataTopicDeleteRepo)
    {
        $this->personalDataTopicDeleteRepository = $personalDataTopicDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTopicDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTopicDeletes = $this->personalDataTopicDeleteRepository->all();
    
            return view('personal_data_topic_deletes.index')
                ->with('personalDataTopicDeletes', $personalDataTopicDeletes);
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
            return view('personal_data_topic_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTopicDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTopicDelete = $this->personalDataTopicDeleteRepository->create($input);
            
                Flash::success('PersonalData Topic Delete saved successfully.');
                return redirect(route('personalDataTopicDeletes.index'));
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
            $personalDataTopicDelete = $this->personalDataTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicDelete))
            {
                Flash::error('PersonalData Topic Delete not found');
                return redirect(route('personalDataTopicDeletes.index'));
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
            
            if($user_id == $personalDataTopicDelete -> user_id || $isShared)
            {
                return view('personal_data_topic_deletes.show')->with('personalDataTopicDelete', $personalDataTopicDelete);
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
            $personalDataTopicDelete = $this->personalDataTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicDelete))
            {
                Flash::error('PersonalData Topic Delete not found');
                return redirect(route('personalDataTopicDeletes.index'));
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
            
            if($user_id == $personalDataTopicDelete -> user_id || $isShared)
            {
                return view('personal_data_topic_deletes.edit')->with('personalDataTopicDelete', $personalDataTopicDelete);
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

    public function update($id, UpdatePersonalDataTopicDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTopicDelete = $this->personalDataTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicDelete))
            {
                Flash::error('PersonalData Topic Delete not found');
                return redirect(route('personalDataTopicDeletes.index'));
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
    
            if($user_id == $personalDataTopicDelete -> user_id || $isShared)
            {
                $personalDataTopicDelete = $this->personalDataTopicDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData Topic Delete updated successfully.');
                return redirect(route('personalDataTopicDeletes.index'));
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
            $personalDataTopicDelete = $this->personalDataTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTopicDelete))
            {
                Flash::error('PersonalData Topic Delete not found');
                return redirect(route('personalDataTopicDeletes.index'));
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
    
            if($user_id == $personalDataTopicDelete -> user_id || $isShared)
            {
                $this->personalDataTopicDeleteRepository->delete($id);
            
                Flash::success('PersonalData Topic Delete deleted successfully.');
                return redirect(route('personalDataTopicDeletes.index'));
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