<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicUpdateRequest;
use App\Http\Requests\UpdateCollegeTopicUpdateRequest;
use App\Repositories\CollegeTopicUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicUpdateController extends AppBaseController
{
    private $collegeTopicUpdateRepository;

    public function __construct(CollegeTopicUpdateRepository $collegeTopicUpdateRepo)
    {
        $this->collegeTopicUpdateRepository = $collegeTopicUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicUpdates = $this->collegeTopicUpdateRepository->all();
    
            return view('college_topic_updates.index')
                ->with('collegeTopicUpdates', $collegeTopicUpdates);
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
            return view('college_topic_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTopicUpdate = $this->collegeTopicUpdateRepository->create($input);
            }
            
            else
            {
                return view('deniedAccess');
            }
        
            Flash::success('College Topic Update saved successfully.');
            return redirect(route('collegeTopicUpdates.index'));
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
            $collegeTopicUpdate = $this->collegeTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicUpdate))
            {
                Flash::error('College Topic Update not found');
                return redirect(route('collegeTopicUpdates.index'));
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
            
            if($user_id == $collegeTopicUpdate -> user_id || $isShared)
            {
                return view('college_topic_updates.show')
                    ->with('collegeTopicUpdate', $collegeTopicUpdate);
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
            $collegeTopicUpdate = $this->collegeTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicUpdate))
            {
                Flash::error('College Topic Update not found');
                return redirect(route('collegeTopicUpdates.index'));
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
            
            if($user_id == $collegeTopicUpdate -> user_id || $isShared)
            {
                return view('college_topic_updates.edit')
                    ->with('collegeTopicUpdate', $collegeTopicUpdate);
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

    public function update($id, UpdateCollegeTopicUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicUpdate = $this->collegeTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicUpdate))
            {
                Flash::error('College Topic Update not found');
                return redirect(route('collegeTopicUpdates.index'));
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
            
            if($user_id == $collegeTopicUpdate -> user_id || $isShared)
            {
                $collegeTopicUpdate = $this->collegeTopicUpdateRepository->update($request->all(), $id);
            
                Flash::success('College Topic Update updated successfully.');
                return redirect(route('collegeTopicUpdates.index'));
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
            $collegeTopicUpdate = $this->collegeTopicUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicUpdate))
            {
                Flash::error('College Topic Update not found');
                return redirect(route('collegeTopicUpdates.index'));
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
            
            if($user_id == $collegeTopicUpdate -> user_id || $isShared)
            {
                $this->collegeTopicUpdateRepository->delete($id);
            
                Flash::success('College Topic Update deleted successfully.');
                return redirect(route('collegeTopicUpdates.index'));
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