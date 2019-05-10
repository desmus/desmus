<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTopicSectionDeleteRequest;
use App\Http\Requests\UpdateCollegeTopicSectionDeleteRequest;
use App\Repositories\CollegeTopicSectionDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTopicSectionDeleteController extends AppBaseController
{
    private $collegeTopicSectionDeleteRepository;

    public function __construct(CollegeTopicSectionDeleteRepository $collegeTopicSectionDeleteRepo)
    {
        $this->collegeTopicSectionDeleteRepository = $collegeTopicSectionDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTopicSectionDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTopicSectionDeletes = $this->collegeTopicSectionDeleteRepository->all();
    
            return view('college_topic_section_deletes.index')
                ->with('collegeTopicSectionDeletes', $collegeTopicSectionDeletes);
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
            return view('college_topic_section_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTopicSectionDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTopicSectionDelete = $this->collegeTopicSectionDeleteRepository->create($input);
            
                Flash::success('College Topic Section Delete saved successfully.');
                return redirect(route('collegeTopicSectionDeletes.index'));
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
            $collegeTopicSectionDelete = $this->collegeTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionDelete))
            {
                Flash::error('College Topic Section Delete not found');
                return redirect(route('collegeTopicSectionDeletes.index'));
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
            
            if($user_id == $collegeTopicSectionDelete -> user_id || $isShared)
            {
                return view('college_topic_section_deletes.show')->with('collegeTopicSectionDelete', $collegeTopicSectionDelete);
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
            $collegeTopicSectionDelete = $this->collegeTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionDelete))
            {
                Flash::error('College Topic Section Delete not found');
                return redirect(route('collegeTopicSectionDeletes.index'));
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
            
            if($user_id == $collegeTopicSectionDelete -> user_id || $isShared)
            {
                return view('college_topic_section_deletes.edit')->with('collegeTopicSectionDelete', $collegeTopicSectionDelete);
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

    public function update($id, UpdateCollegeTopicSectionDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTopicSectionDelete = $this->collegeTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionDelete))
            {
                Flash::error('College Topic Section Delete not found');
                return redirect(route('collegeTopicSectionDeletes.index'));
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
            
            if($user_id == $collegeTopicSectionDelete -> user_id || $isShared)
            {
                $collegeTopicSectionDelete = $this->collegeTopicSectionDeleteRepository->update($request->all(), $id);
            
                Flash::success('College Topic Section Delete updated successfully.');
                return redirect(route('collegeTopicSectionDeletes.index'));
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
            $collegeTopicSectionDelete = $this->collegeTopicSectionDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTopicSectionDelete))
            {
                Flash::error('College Topic Section Delete not found');
                return redirect(route('collegeTopicSectionDeletes.index'));
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
            
            if($user_id == $collegeTopicSectionDelete -> user_id || $isShared)
            {
                $this->collegeTopicSectionDeleteRepository->delete($id);
            
                Flash::success('College Topic Section Delete deleted successfully.');
                return redirect(route('collegeTopicSectionDeletes.index'));
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