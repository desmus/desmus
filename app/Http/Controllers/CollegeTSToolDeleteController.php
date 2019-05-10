<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolDeleteRequest;
use App\Http\Requests\UpdateCollegeTSToolDeleteRequest;
use App\Repositories\CollegeTSToolDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolDeleteController extends AppBaseController
{
    private $collegeTSToolDeleteRepository;

    public function __construct(CollegeTSToolDeleteRepository $collegeTSToolDeleteRepo)
    {
        $this->collegeTSToolDeleteRepository = $collegeTSToolDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolDeletes = $this->collegeTSToolDeleteRepository->all();
    
            return view('college_t_s_tool_deletes.index')
                ->with('collegeTSToolDeletes', $collegeTSToolDeletes);
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
            return view('college_t_s_tool_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSToolDelete = $this->collegeTSToolDeleteRepository->create($input);
            
                Flash::success('College T S Tool Delete saved successfully.');
                return redirect(route('collegeTSToolDeletes.index'));
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
            $collegeTSToolDelete = $this->collegeTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolDelete))
            {
                Flash::error('College T S Tool Delete not found');
                return redirect(route('collegeTSToolDeletes.index'));
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
            
            if($user_id == $collegeTSToolDelete -> user_id || $isShared)
            {
                return view('college_t_s_tool_deletes.show')->with('collegeTSToolDelete', $collegeTSToolDelete);
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
            $collegeTSToolDelete = $this->collegeTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolDelete))
            {
                Flash::error('College T S Tool Delete not found');
                return redirect(route('collegeTSToolDeletes.index'));
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
            
            if($user_id == $collegeTSToolDelete -> user_id || $isShared)
            {
                return view('college_t_s_tool_deletes.edit')->with('collegeTSToolDelete', $collegeTSToolDelete);
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

    public function update($id, UpdateCollegeTSToolDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolDelete = $this->collegeTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolDelete))
            {
                Flash::error('College T S Tool Delete not found');
                return redirect(route('collegeTSToolDeletes.index'));
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
            
            if($user_id == $collegeTSToolDelete -> user_id || $isShared)
            {
                $collegeTSToolDelete = $this->collegeTSToolDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool Delete updated successfully.');
                return redirect(route('collegeTSToolDeletes.index'));
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
            $collegeTSToolDelete = $this->collegeTSToolDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolDelete))
            {
                Flash::error('College T S Tool Delete not found');
                return redirect(route('collegeTSToolDeletes.index'));
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
            
            if($user_id == $collegeTSToolDelete -> user_id || $isShared)
            {
                $this->collegeTSToolDeleteRepository->delete($id);
            
                Flash::success('College T S Tool Delete deleted successfully.');
                return redirect(route('collegeTSToolDeletes.index'));
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