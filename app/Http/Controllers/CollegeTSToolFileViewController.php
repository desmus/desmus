<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolFileViewRequest;
use App\Http\Requests\UpdateCollegeTSToolFileViewRequest;
use App\Repositories\CollegeTSToolFileViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolFileViewController extends AppBaseController
{
    private $collegeTSToolFileViewRepository;

    public function __construct(CollegeTSToolFileViewRepository $collegeTSToolFileViewRepo)
    {
        $this->collegeTSToolFileViewRepository = $collegeTSToolFileViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolFileViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolFileViews = $this->collegeTSToolFileViewRepository->all();
    
            return view('college_t_s_tool_file_views.index')
                ->with('collegeTSToolFileViews', $collegeTSToolFileViews);
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
            return view('college_t_s_tool_file_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSToolFileView = $this->collegeTSToolFileViewRepository->create($input);
            
                Flash::success('College T S Tool File View saved successfully.');
                return redirect(route('collegeTSToolFileViews.index'));
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
            $collegeTSToolFileView = $this->collegeTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileView))
            {
                Flash::error('College T S Tool File View not found');
                return redirect(route('collegeTSToolFileViews.index'));
            }
            
            $userCollegeTSToolFiles = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSToolFiles as $userCollegeTSToolFile)
            {
                if($userCollegeTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tool_files')->join('college_t_s_tools', 'college_t_s_tool_files.college_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $collegeTSToolFileView -> user_id || $isShared)
            {
                return view('college_t_s_tool_file_views.show')->with('collegeTSToolFileView', $collegeTSToolFileView);
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
            $collegeTSToolFileView = $this->collegeTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileView))
            {
                Flash::error('College T S Tool File View not found');
                return redirect(route('collegeTSToolFileViews.index'));
            }
            
            $userCollegeTSToolFiles = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSToolFiles as $userCollegeTSToolFile)
            {
                if($userCollegeTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tool_files')->join('college_t_s_tools', 'college_t_s_tool_files.college_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $collegeTSToolFileView -> user_id || $isShared)
            {
                return view('college_t_s_tool_file_views.edit')->with('collegeTSToolFileView', $collegeTSToolFileView);
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

    public function update($id, UpdateCollegeTSToolFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolFileView = $this->collegeTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileView))
            {
                Flash::error('College T S Tool File View not found');
                return redirect(route('collegeTSToolFileViews.index'));
            }
    
            $userCollegeTSToolFiles = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSToolFiles as $userCollegeTSToolFile)
            {
                if($userCollegeTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tool_files')->join('college_t_s_tools', 'college_t_s_tool_files.college_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $collegeTSToolFileView -> user_id || $isShared)
            {
                $collegeTSToolFileView = $this->collegeTSToolFileViewRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool File View updated successfully.');
                return redirect(route('collegeTSToolFileViews.index'));
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
            $collegeTSToolFileView = $this->collegeTSToolFileViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileView))
            {
                Flash::error('College T S Tool File View not found');
                return redirect(route('collegeTSToolFileViews.index'));
            }
            
            $userCollegeTSToolFiles = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSToolFiles as $userCollegeTSToolFile)
            {
                if($userCollegeTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tool_files')->join('college_t_s_tools', 'college_t_s_tool_files.college_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $collegeTSToolFileView -> user_id || $isShared)
            {
                $this->collegeTSToolFileViewRepository->delete($id);
            
                Flash::success('College T S Tool File View deleted successfully.');
                return redirect(route('collegeTSToolFileViews.index'));
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