<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolFileCreateRequest;
use App\Http\Requests\UpdateCollegeTSToolFileCreateRequest;
use App\Repositories\CollegeTSToolFileCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolFileCreateController extends AppBaseController
{
    private $collegeTSToolFileCreateRepository;

    public function __construct(CollegeTSToolFileCreateRepository $collegeTSToolFileCreateRepo)
    {
        $this->collegeTSToolFileCreateRepository = $collegeTSToolFileCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolFileCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolFileCreates = $this->collegeTSToolFileCreateRepository->all();
    
            return view('college_t_s_tool_file_creates.index')
                ->with('collegeTSToolFileCreates', $collegeTSToolFileCreates);
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
            return view('college_t_s_tool_file_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSToolFileCreate = $this->collegeTSToolFileCreateRepository->create($input);
            
                Flash::success('College T S Tool File Create saved successfully.');
                return redirect(route('collegeTSToolFileCreates.index'));
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
            $collegeTSToolFileCreate = $this->collegeTSToolFileCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileCreate))
            {
                Flash::error('College T S Tool File Create not found');
                return redirect(route('collegeTSToolFileCreates.index'));
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
            
            if($user_id == $collegeTSToolFileCreate -> user_id || $isShared)
            {
                return view('college_t_s_tool_file_creates.show')->with('collegeTSToolFileCreate', $collegeTSToolFileCreate);
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
            $collegeTSToolFileCreate = $this->collegeTSToolFileCreateRepository->findWithoutFail($id);
    
            if (empty($collegeTSToolFileCreate))
            {
                Flash::error('College T S Tool File Create not found');
                return redirect(route('collegeTSToolFileCreates.index'));
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
            
            if($user_id == $collegeTSToolFileCreate -> user_id || $isShared)
            {
                return view('college_t_s_tool_file_creates.edit')->with('collegeTSToolFileCreate', $collegeTSToolFileCreate);
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

    public function update($id, UpdateCollegeTSToolFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolFileCreate = $this->collegeTSToolFileCreateRepository->findWithoutFail($id);
    
            if (empty($collegeTSToolFileCreate))
            {
                Flash::error('College T S Tool File Create not found');
                return redirect(route('collegeTSToolFileCreates.index'));
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
            
            if($user_id == $collegeTSToolFileCreate -> user_id || $isShared)
            {
                $collegeTSToolFileCreate = $this->collegeTSToolFileCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool File Create updated successfully.');
                return redirect(route('collegeTSToolFileCreates.index'));
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
            $collegeTSToolFileCreate = $this->collegeTSToolFileCreateRepository->findWithoutFail($id);
    
            if (empty($collegeTSToolFileCreate))
            {
                Flash::error('College T S Tool File Create not found');
                return redirect(route('collegeTSToolFileCreates.index'));
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
            
            if($user_id == $collegeTSToolFileCreate -> user_id || $isShared)
            {
                $this->collegeTSToolFileCreateRepository->delete($id);
            
                Flash::success('College T S Tool File Create deleted successfully.');
                return redirect(route('collegeTSToolFileCreates.index'));
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