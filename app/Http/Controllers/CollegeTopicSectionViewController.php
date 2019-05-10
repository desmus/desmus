<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicSectionViewRequest;
use App\Http\Requests\UpdateCollegeTopicSectionViewRequest;
use App\Repositories\CollegeTopicSectionViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicSectionViewController extends AppBaseController
{
    private $collegeTopicSectionViewRepository;

    public function __construct(CollegeTopicSectionViewRepository $collegeTopicSectionViewRepo)
    {
        $this->collegeTopicSectionViewRepository = $collegeTopicSectionViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicSectionViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicSectionViews = $this->collegeTopicSectionViewRepository->all();
    
            return view('college_topic_section_views.index')
                ->with('collegeTopicSectionViews', $collegeTopicSectionViews);
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
            return view('college_topic_section_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicSectionViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTopicSectionView = $this->collegeTopicSectionViewRepository->create($input);
            
                Flash::success('College Topic Section View saved successfully.');
                return redirect(route('collegeTopicSectionViews.index'));
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
            $collegeTopicSectionView = $this->collegeTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionView))
            {
                Flash::error('College Topic Section View not found');
                return redirect(route('collegeTopicSectionViews.index'));
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
            
            if($user_id == $collegeTopicSectionView -> user_id || $isShared)
            {
                return view('college_topic_section_views.show')->with('collegeTopicSectionView', $collegeTopicSectionView);
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
            $collegeTopicSectionView = $this->collegeTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionView))
            {
                Flash::error('College Topic Section View not found');
                return redirect(route('collegeTopicSectionViews.index'));
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
            
            if($user_id == $collegeTopicSectionView -> user_id || $isShared)
            {
                return view('college_topic_section_views.edit')->with('collegeTopicSectionView', $collegeTopicSectionView);
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

    public function update($id, UpdateCollegeTopicSectionViewRequest $request)
    {
        
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicSectionView = $this->collegeTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionView))
            {
                Flash::error('College Topic Section View not found');
                return redirect(route('collegeTopicSectionViews.index'));
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
            
            if($user_id == $collegeTopicSectionView -> user_id || $isShared)
            {
                $collegeTopicSectionView = $this->collegeTopicSectionViewRepository->update($request->all(), $id);
            
                Flash::success('College Topic Section View updated successfully.');
                return redirect(route('collegeTopicSectionViews.index'));
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
            $collegeTopicSectionView = $this->collegeTopicSectionViewRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionView))
            {
                Flash::error('College Topic Section View not found');
                return redirect(route('collegeTopicSectionViews.index'));
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
            
            if($user_id == $collegeTopicSectionView -> user_id || $isShared)
            {
                $this->collegeTopicSectionViewRepository->delete($id);
            
                Flash::success('College Topic Section View deleted successfully.');
                return redirect(route('collegeTopicSectionViews.index'));
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