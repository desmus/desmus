<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolViewRequest;
use App\Http\Requests\UpdateCollegeTSToolViewRequest;
use App\Repositories\CollegeTSToolViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolViewController extends AppBaseController
{
    private $collegeTSToolViewRepository;

    public function __construct(CollegeTSToolViewRepository $collegeTSToolViewRepo)
    {
        $this->collegeTSToolViewRepository = $collegeTSToolViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolViews = $this->collegeTSToolViewRepository->all();
    
            return view('college_t_s_tool_views.index')
                ->with('collegeTSToolViews', $collegeTSToolViews);
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
            return view('college_t_s_tool_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSToolView = $this->collegeTSToolViewRepository->create($input);
            
                Flash::success('College T S Tool View saved successfully.');
                return redirect(route('collegeTSToolViews.index'));
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
            $collegeTSToolView = $this->collegeTSToolViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolView))
            {
                Flash::error('College T S Tool View not found');
                return redirect(route('collegeTSToolViews.index'));
            }
            
            $userCollegeTSTools = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSTools as $userCollegeTSTool)
            {
                if($userCollegeTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $collegeTSToolView -> user_id || $isShared)
            {
                return view('college_t_s_tool_views.show')->with('collegeTSToolView', $collegeTSToolView);
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
            $collegeTSToolView = $this->collegeTSToolViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolView))
            {
                Flash::error('College T S Tool View not found');
                return redirect(route('collegeTSToolViews.index'));
            }
    
            $userCollegeTSTools = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSTools as $userCollegeTSTool)
            {
                if($userCollegeTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $collegeTSToolView -> user_id || $isShared)
            {
                return view('college_t_s_tool_views.edit')->with('collegeTSToolView', $collegeTSToolView);
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

    public function update($id, UpdateCollegeTSToolViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolView = $this->collegeTSToolViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolView))
            {
                Flash::error('College T S Tool View not found');
                return redirect(route('collegeTSToolViews.index'));
            }
            
            $userCollegeTSTools = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSTools as $userCollegeTSTool)
            {
                if($userCollegeTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $collegeTSToolView -> user_id || $isShared)
            {
                $collegeTSToolView = $this->collegeTSToolViewRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool View updated successfully.');
                return redirect(route('collegeTSToolViews.index'));
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
            $collegeTSToolView = $this->collegeTSToolViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolView))
            {
                Flash::error('College T S Tool View not found');
                return redirect(route('collegeTSToolViews.index'));
            }
            
            $userCollegeTSTools = DB::table('user_college_t_s_tools')->where('college_t_s_tool_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSTools as $userCollegeTSTool)
            {
                if($userCollegeTSTool -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tools')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tools.id', '=', $id)->get();
            
            if($user_id == $collegeTSToolView -> user_id || $isShared)
            {
                $this->collegeTSToolViewRepository->delete($id);
            
                Flash::success('College T S Tool View deleted successfully.');
                return redirect(route('collegeTSToolViews.index'));
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