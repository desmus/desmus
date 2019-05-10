<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolCreateRequest;
use App\Http\Requests\UpdateCollegeTSToolCreateRequest;
use App\Repositories\CollegeTSToolCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolCreateController extends AppBaseController
{
    private $collegeTSToolCreateRepository;

    public function __construct(CollegeTSToolCreateRepository $collegeTSToolCreateRepo)
    {
        $this->collegeTSToolCreateRepository = $collegeTSToolCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolCreates = $this->collegeTSToolCreateRepository->all();
    
            return view('college_t_s_tool_creates.index')
                ->with('collegeTSToolCreates', $collegeTSToolCreates);
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
            return view('college_t_s_tool_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSToolCreate = $this->collegeTSToolCreateRepository->create($input);
            
                Flash::success('College T S Tool Create saved successfully.');
                return redirect(route('collegeTSToolCreates.index'));
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
            $collegeTSToolCreate = $this->collegeTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolCreate))
            {
                Flash::error('College T S Tool Create not found');
                return redirect(route('collegeTSToolCreates.index'));
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
            
            if($user_id == $collegeTSToolCreate -> user_id || $isShared)
            {
                return view('college_t_s_tool_creates.show')->with('collegeTSToolCreate', $collegeTSToolCreate);
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
            $collegeTSToolCreate = $this->collegeTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolCreate))
            {
                Flash::error('College T S Tool Create not found');
                return redirect(route('collegeTSToolCreates.index'));
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
            
            if($user_id == $collegeTSToolCreate -> user_id || $isShared)
            {
                return view('college_t_s_tool_creates.edit')->with('collegeTSToolCreate', $collegeTSToolCreate);
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

    public function update($id, UpdateCollegeTSToolCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolCreate = $this->collegeTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolCreate))
            {
                Flash::error('College T S Tool Create not found');
                return redirect(route('collegeTSToolCreates.index'));
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
            
            if($user_id == $collegeTSToolCreate -> user_id || $isShared)
            {
                $collegeTSToolCreate = $this->collegeTSToolCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool Create updated successfully.');
                return redirect(route('collegeTSToolCreates.index'));
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
            $collegeTSToolCreate = $this->collegeTSToolCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolCreate))
            {
                Flash::error('College T S Tool Create not found');
                return redirect(route('collegeTSToolCreates.index'));
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
            
            if($user_id == $collegeTSToolCreate -> user_id || $isShared)
            {
                $this->collegeTSToolCreateRepository->delete($id);
            
                Flash::success('College T S Tool Create deleted successfully.');
                return redirect(route('collegeTSToolCreates.index'));
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