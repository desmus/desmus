<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicSectionUpdateRequest;
use App\Http\Requests\UpdateCollegeTopicSectionUpdateRequest;
use App\Repositories\CollegeTopicSectionUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicSectionUpdateController extends AppBaseController
{
    private $collegeTopicSectionUpdateRepository;

    public function __construct(CollegeTopicSectionUpdateRepository $collegeTopicSectionUpdateRepo)
    {
        $this->collegeTopicSectionUpdateRepository = $collegeTopicSectionUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicSectionUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicSectionUpdates = $this->collegeTopicSectionUpdateRepository->all();
    
            return view('college_topic_section_updates.index')
                ->with('collegeTopicSectionUpdates', $collegeTopicSectionUpdates);
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
            return view('college_topic_section_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicSectionUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTopicSectionUpdate = $this->collegeTopicSectionUpdateRepository->create($input);
            
                Flash::success('College Topic Section Update saved successfully.');
                return redirect(route('collegeTopicSectionUpdates.index'));
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
            $collegeTopicSectionUpdate = $this->collegeTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionUpdate))
            {
                Flash::error('College Topic Section Update not found');
                return redirect(route('collegeTopicSectionUpdates.index'));
            }
            
            $userCollegeTopicSections = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTopicSections as $userCollegeTopicSection)
            {
                if($userCollegeTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_topic_sections.id', '=', $id)->get();
            
            if($user_id == $collegeTopicSectionUpdate -> user_id || $isShared)
            {
                return view('college_topic_section_updates.show')
                    ->with('collegeTopicSectionUpdate', $collegeTopicSectionUpdate);
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
            $collegeTopicSectionUpdate = $this->collegeTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionUpdate))
            {
                Flash::error('College Topic Section Update not found');
                return redirect(route('collegeTopicSectionUpdates.index'));
            }
            
            $userCollegeTopicSections = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTopicSections as $userCollegeTopicSection)
            {
                if($userCollegeTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_topic_sections.id', '=', $id)->get();
            
            if($user_id == $collegeTopicSectionUpdate -> user_id || $isShared)
            {
                return view('college_topic_section_updates.edit')
                    ->with('collegeTopicSectionUpdate', $collegeTopicSectionUpdate);
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

    public function update($id, UpdateCollegeTopicSectionUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicSectionUpdate = $this->collegeTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionUpdate))
            {
                Flash::error('College Topic Section Update not found');
                return redirect(route('collegeTopicSectionUpdates.index'));
            }
            
            $userCollegeTopicSections = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTopicSections as $userCollegeTopicSection)
            {
                if($userCollegeTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_topic_sections.id', '=', $id)->get();
            
            if($user_id == $collegeTopicSectionUpdate -> user_id || $isShared)
            {
                $collegeTopicSectionUpdate = $this->collegeTopicSectionUpdateRepository->update($request->all(), $id);
            
                Flash::success('College Topic Section Update updated successfully.');
                return redirect(route('collegeTopicSectionUpdates.index'));
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
            $collegeTopicSectionUpdate = $this->collegeTopicSectionUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionUpdate))
            {
                Flash::error('College Topic Section Update not found');
                return redirect(route('collegeTopicSectionUpdates.index'));
            }
            
            $userCollegeTopicSections = DB::table('user_college_topic_sections')->where('college_topic_section_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTopicSections as $userCollegeTopicSection)
            {
                if($userCollegeTopicSection -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_topic_sections')->join('college_topics', 'college_topic_sections.college_topic_id', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_topic_sections.id', '=', $id)->get();
            
            if($user_id == $collegeTopicSectionUpdate -> user_id || $isShared)
            {
                $this->collegeTopicSectionUpdateRepository->delete($id);
            
                Flash::success('College Topic Section Update deleted successfully.');
                return redirect(route('collegeTopicSectionUpdates.index'));
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