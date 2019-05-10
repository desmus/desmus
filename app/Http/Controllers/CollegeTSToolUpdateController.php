<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolUpdateRequest;
use App\Http\Requests\UpdateCollegeTSToolUpdateRequest;
use App\Repositories\CollegeTSToolUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolUpdateController extends AppBaseController
{
    private $collegeTSToolUpdateRepository;

    public function __construct(CollegeTSToolUpdateRepository $collegeTSToolUpdateRepo)
    {
        $this->collegeTSToolUpdateRepository = $collegeTSToolUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolUpdates = $this->collegeTSToolUpdateRepository->all();
    
            return view('college_t_s_tool_updates.index')
                ->with('collegeTSToolUpdates', $collegeTSToolUpdates);
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
            return view('college_t_s_tool_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSToolUpdate = $this->collegeTSToolUpdateRepository->create($input);
            
                Flash::success('College T S Tool Update saved successfully.');
                return redirect(route('collegeTSToolUpdates.index'));
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
            $collegeTSToolUpdate = $this->collegeTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolUpdate))
            {
                Flash::error('College T S Tool Update not found');
                return redirect(route('collegeTSToolUpdates.index'));
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
            
            if($user_id == $collegeTSToolUpdate -> user_id || $isShared)
            {
                return view('college_t_s_tool_updates.show')->with('collegeTSToolUpdate', $collegeTSToolUpdate);
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
            $collegeTSToolUpdate = $this->collegeTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolUpdate))
            {
                Flash::error('College T S Tool Update not found');
                return redirect(route('collegeTSToolUpdates.index'));
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
            
            if($user_id == $collegeTSToolUpdate -> user_id || $isShared)
            {
                return view('college_t_s_tool_updates.edit')->with('collegeTSToolUpdate', $collegeTSToolUpdate);
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

    public function update($id, UpdateCollegeTSToolUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolUpdate = $this->collegeTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolUpdate))
            {
                Flash::error('College T S Tool Update not found');
                return redirect(route('collegeTSToolUpdates.index'));
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
            
            if($user_id == $collegeTSToolUpdate -> user_id || $isShared)
            {
                $collegeTSToolUpdate = $this->collegeTSToolUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool Update updated successfully.');
                return redirect(route('collegeTSToolUpdates.index'));
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
            $collegeTSToolUpdate = $this->collegeTSToolUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolUpdate))
            {
                Flash::error('College T S Tool Update not found');
                return redirect(route('collegeTSToolUpdates.index'));
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
            
            if($user_id == $collegeTSToolUpdate -> user_id || $isShared)
            {
                $this->collegeTSToolUpdateRepository->delete($id);
            
                Flash::success('College T S Tool Update deleted successfully.');
                return redirect(route('collegeTSToolUpdates.index'));
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