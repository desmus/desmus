<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicDeleteRequest;
use App\Http\Requests\UpdateCollegeTopicDeleteRequest;
use App\Repositories\CollegeTopicDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicDeleteController extends AppBaseController
{
    private $collegeTopicDeleteRepository;

    public function __construct(CollegeTopicDeleteRepository $collegeTopicDeleteRepo)
    {
        $this->collegeTopicDeleteRepository = $collegeTopicDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicDeletes = $this->collegeTopicDeleteRepository->all();
    
            return view('college_topic_deletes.index')
                ->with('collegeTopicDeletes', $collegeTopicDeletes);
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
            return view('college_topic_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTopicDelete = $this->collegeTopicDeleteRepository->create($input);
            
                Flash::success('College Topic Delete saved successfully.');
                return redirect(route('collegeTopicDeletes.index'));
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
            $collegeTopicDelete = $this->collegeTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicDelete))
            {
                Flash::error('College Topic Delete not found');
                return redirect(route('collegeTopicDeletes.index'));
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
            
            if($user_id == $collegeTopicDelete -> user_id || $isShared)
            {
                return view('college_topic_deletes.show')->with('collegeTopicDelete', $collegeTopicDelete);
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
            $collegeTopicDelete = $this->collegeTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicDelete))
            {
                Flash::error('College Topic Delete not found');
                return redirect(route('collegeTopicDeletes.index'));
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
            
            if($user_id == $collegeTopicDelete -> user_id || $isShared)
            {
                return view('college_topic_deletes.edit')->with('collegeTopicDelete', $collegeTopicDelete);
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

    public function update($id, UpdateCollegeTopicDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicDelete = $this->collegeTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicDelete))
            {
                Flash::error('College Topic Delete not found');
                return redirect(route('collegeTopicDeletes.index'));
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
            
            if($user_id == $collegeTopicDelete -> user_id || $isShared)
            {
                $collegeTopicDelete = $this->collegeTopicDeleteRepository->update($request->all(), $id);
            
                Flash::success('College Topic Delete updated successfully.');
                return redirect(route('collegeTopicDeletes.index'));
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
            $collegeTopicDelete = $this->collegeTopicDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicDelete))
            {
                Flash::error('College Topic Delete not found');
                return redirect(route('collegeTopicDeletes.index'));
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
            
            if($user_id == $collegeTopicDelete -> user_id || $isShared)
            {
                $this->collegeTopicDeleteRepository->delete($id);
            
                Flash::success('College Topic Delete deleted successfully.');
                return redirect(route('collegeTopicDeletes.index'));
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