<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolFileDeleteRequest;
use App\Http\Requests\UpdateCollegeTSToolFileDeleteRequest;
use App\Repositories\CollegeTSToolFileDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolFileDeleteController extends AppBaseController
{
    private $collegeTSToolFileDeleteRepository;

    public function __construct(CollegeTSToolFileDeleteRepository $collegeTSToolFileDeleteRepo)
    {
        $this->collegeTSToolFileDeleteRepository = $collegeTSToolFileDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolFileDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolFileDeletes = $this->collegeTSToolFileDeleteRepository->all();
    
            return view('college_t_s_tool_file_deletes.index')
                ->with('collegeTSToolFileDeletes', $collegeTSToolFileDeletes);
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
            return view('college_t_s_tool_file_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSToolFileDelete = $this->collegeTSToolFileDeleteRepository->create($input);
            
                Flash::success('College T S Tool File Delete saved successfully.');
                return redirect(route('collegeTSToolFileDeletes.index'));
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
            $collegeTSToolFileDelete = $this->collegeTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileDelete))
            {
                Flash::error('College T S Tool File Delete not found');
                return redirect(route('collegeTSToolFileDeletes.index'));
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
            
            if($user_id == $collegeTSToolFileDelete -> user_id || $isShared)
            {
                return view('college_t_s_tool_file_deletes.show')->with('collegeTSToolFileDelete', $collegeTSToolFileDelete);
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
            $collegeTSToolFileDelete = $this->collegeTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileDelete))
            {
                Flash::error('College T S Tool File Delete not found');
                return redirect(route('collegeTSToolFileDeletes.index'));
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
            
            if($user_id == $collegeTSToolFileDelete -> user_id || $isShared)
            {
                return view('college_t_s_tool_file_deletes.edit')->with('collegeTSToolFileDelete', $collegeTSToolFileDelete);
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

    public function update($id, UpdateCollegeTSToolFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolFileDelete = $this->collegeTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileDelete))
            {
                Flash::error('College T S Tool File Delete not found');
                return redirect(route('collegeTSToolFileDeletes.index'));
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
            
            if($user_id == $collegeTSToolFileDelete -> user_id || $isShared)
            {
                $collegeTSToolFileDelete = $this->collegeTSToolFileDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool File Delete updated successfully.');
                return redirect(route('collegeTSToolFileDeletes.index'));
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
            $collegeTSToolFileDelete = $this->collegeTSToolFileDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileDelete))
            {
                Flash::error('College T S Tool File Delete not found');
                return redirect(route('collegeTSToolFileDeletes.index'));
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
            
            if($user_id == $collegeTSToolFileDelete -> user_id || $isShared)
            {
                $this->collegeTSToolFileDeleteRepository->delete($id);
            
                Flash::success('College T S Tool File Delete deleted successfully.');
                return redirect(route('collegeTSToolFileDeletes.index'));
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