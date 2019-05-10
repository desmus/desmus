<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicViewRequest;
use App\Http\Requests\UpdateCollegeTopicViewRequest;
use App\Repositories\CollegeTopicViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicViewController extends AppBaseController
{
    private $collegeTopicViewRepository;

    public function __construct(CollegeTopicViewRepository $collegeTopicViewRepo)
    {
        $this->collegeTopicViewRepository = $collegeTopicViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicViews = $this->collegeTopicViewRepository->all();
    
            return view('college_topic_views.index')
                ->with('collegeTopicViews', $collegeTopicViews);
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
            return view('college_topic_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTopicView = $this->collegeTopicViewRepository->create($input);
            
                Flash::success('College Topic View saved successfully.');
                return redirect(route('collegeTopicViews.index'));
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
            $collegeTopicView = $this->collegeTopicViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicView))
            {
                Flash::error('College Topic View not found');
                return redirect(route('collegeTopicViews.index'));
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
            
            if($user_id == $collegeTopicView -> user_id || $isShared)
            {
                return view('college_topic_views.show')
                    ->with('collegeTopicView', $collegeTopicView);
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
            $collegeTopicView = $this->collegeTopicViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicView))
            {
                Flash::error('College Topic View not found');
                return redirect(route('collegeTopicViews.index'));
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
            
            if($user_id == $collegeTopicView -> user_id || $isShared)
            {
                return view('college_topic_views.edit')
                    ->with('collegeTopicView', $collegeTopicView);
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

    public function update($id, UpdateCollegeTopicViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicView = $this->collegeTopicViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicView))
            {
                Flash::error('College Topic View not found');
                return redirect(route('collegeTopicViews.index'));
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
            
            if($user_id == $collegeTopicView -> user_id || $isShared)
            {
                $collegeTopicView = $this->collegeTopicViewRepository->update($request->all(), $id);
            
                Flash::success('College Topic View updated successfully.');
                return redirect(route('collegeTopicViews.index'));
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
            $collegeTopicView = $this->collegeTopicViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicView))
            {
                Flash::error('College Topic View not found');
                return redirect(route('collegeTopicViews.index'));
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
            
            if($user_id == $collegeTopicView -> user_id || $isShared)
            {
                $this->collegeTopicViewRepository->delete($id);
            
                Flash::success('College Topic View deleted successfully.');
                return redirect(route('collegeTopicViews.index'));
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