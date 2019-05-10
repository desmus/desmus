<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicSectionCreateRequest;
use App\Http\Requests\UpdateCollegeTopicSectionCreateRequest;
use App\Repositories\CollegeTopicSectionCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicSectionCreateController extends AppBaseController
{
    private $collegeTopicSectionCreateRepository;

    public function __construct(CollegeTopicSectionCreateRepository $collegeTopicSectionCreateRepo)
    {
        $this->collegeTopicSectionCreateRepository = $collegeTopicSectionCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicSectionCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicSectionCreates = $this->collegeTopicSectionCreateRepository->all();
    
            return view('college_topic_section_creates.index')
                ->with('collegeTopicSectionCreates', $collegeTopicSectionCreates);
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
            return view('college_topic_section_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicSectionCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTopicSectionCreate = $this->collegeTopicSectionCreateRepository->create($input);
            
                Flash::success('College Topic Section Create saved successfully.');
                return redirect(route('collegeTopicSectionCreates.index'));
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
            $collegeTopicSectionCreate = $this->collegeTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionCreate))
            {
                Flash::error('College Topic Section Create not found');
                return redirect(route('collegeTopicSectionCreates.index'));
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
            
            if($user_id == $collegeTopicSectionCreate -> user_id || $isShared)
            {
                return view('college_topic_section_creates.show')
                    ->with('collegeTopicSectionCreate', $collegeTopicSectionCreate);
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
            $collegeTopicSectionCreate = $this->collegeTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionCreate))
            {
                Flash::error('College Topic Section Create not found');
                return redirect(route('collegeTopicSectionCreates.index'));
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
            
            if($user_id == $collegeTopicSectionCreate -> user_id || $isShared)
            {
                return view('college_topic_section_creates.edit')
                    ->with('collegeTopicSectionCreate', $collegeTopicSectionCreate);
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

    public function update($id, UpdateCollegeTopicSectionCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicSectionCreate = $this->collegeTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionCreate))
            {
                Flash::error('College Topic Section Create not found');
                return redirect(route('collegeTopicSectionCreates.index'));
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
            
            if($user_id == $collegeTopicSectionCreate -> user_id || $isShared)
            {
                $collegeTopicSectionCreate = $this->collegeTopicSectionCreateRepository->update($request->all(), $id);
            
                Flash::success('College Topic Section Create updated successfully.');
                return redirect(route('collegeTopicSectionCreates.index'));
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
            $collegeTopicSectionCreate = $this->collegeTopicSectionCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionCreate))
            {
                Flash::error('College Topic Section Create not found');
                return redirect(route('collegeTopicSectionCreates.index'));
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
            
            if($user_id == $collegeTopicSectionCreate -> user_id || $isShared)
            {
                $this->collegeTopicSectionCreateRepository->delete($id);
            
                Flash::success('College Topic Section Create deleted successfully.');
                return redirect(route('collegeTopicSectionCreates.index'));
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