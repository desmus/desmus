<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicCreateRequest;
use App\Http\Requests\UpdateCollegeTopicCreateRequest;
use App\Repositories\CollegeTopicCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicCreateController extends AppBaseController
{
    private $collegeTopicCreateRepository;

    public function __construct(CollegeTopicCreateRepository $collegeTopicCreateRepo)
    {
        $this->collegeTopicCreateRepository = $collegeTopicCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicCreates = $this->collegeTopicCreateRepository->all();
    
            return view('college_topic_creates.index')
                ->with('collegeTopicCreates', $collegeTopicCreates);
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
            return view('college_topic_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTopicCreate = $this->collegeTopicCreateRepository->create($input);
            
                Flash::success('College Topic Create saved successfully.');
                return redirect(route('collegeTopicCreates.index'));
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
            $collegeTopicCreate = $this->collegeTopicCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicCreate))
            {
                Flash::error('College Topic Create not found');
                return redirect(route('collegeTopicCreates.index'));
            }
            
            $userCollegeTopics = DB::table('user_college_topics')->where('college_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTopics as $userCollegeTopic)
            {
                if($userCollegeTopic -> user_id == $user_id && $userCollege -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $collegeTopicCreate -> user_id || $isShared)
            {
                return view('college_topic_creates.show')->with('collegeTopicCreate', $collegeTopicCreate);
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
            $collegeTopicCreate = $this->collegeTopicCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicCreate))
            {
                Flash::error('College Topic Create not found');
                return redirect(route('collegeTopicCreates.index'));
            }
            
            $userCollegeTopics = DB::table('user_college_topics')->where('college_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTopics as $userCollegeTopic)
            {
                if($userCollegeTopic -> user_id == $user_id && $userCollege -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $collegeTopicCreate -> user_id || $isShared)
            {
                return view('college_topic_creates.edit')->with('collegeTopicCreate', $collegeTopicCreate);
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

    public function update($id, UpdateCollegeTopicCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicCreate = $this->collegeTopicCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicCreate))
            {
                Flash::error('College Topic Create not found');
                return redirect(route('collegeTopicCreates.index'));
            }
            
            $userCollegeTopics = DB::table('user_college_topics')->where('college_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTopics as $userCollegeTopic)
            {
                if($userCollegeTopic -> user_id == $user_id && $userCollege -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
    
            if($user_id == $collegeTopicCreate -> user_id || $isShared)
            {
                $collegeTopicCreate = $this->collegeTopicCreateRepository->update($request->all(), $id);
            
                Flash::success('College Topic Create updated successfully.');
                return redirect(route('collegeTopicCreates.index'));
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
            $collegeTopicCreate = $this->collegeTopicCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicCreate))
            {
                Flash::error('College Topic Create not found');
                return redirect(route('collegeTopicCreates.index'));
            }
            
            $userCollegeTopics = DB::table('user_college_topics')->where('college_topic_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTopics as $userCollegeTopic)
            {
                if($userCollegeTopic -> user_id == $user_id && $userCollege -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
    
            if($user_id == $collegeTopicCreate -> user_id || $isShared)
            {
                $this->collegeTopicCreateRepository->delete($id);
            
                Flash::success('College Topic Create deleted successfully.');
                return redirect(route('collegeTopicCreates.index'));
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