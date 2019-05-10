<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSFileCreateRequest;
use App\Http\Requests\UpdateCollegeTSFileCreateRequest;
use App\Repositories\CollegeTSFileCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSFileCreateController extends AppBaseController
{
    private $collegeTSFileCreateRepository;

    public function __construct(CollegeTSFileCreateRepository $collegeTSFileCreateRepo)
    {
        $this->collegeTSFileCreateRepository = $collegeTSFileCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSFileCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSFileCreates = $this->collegeTSFileCreateRepository->all();
    
            return view('college_t_s_file_creates.index')
                ->with('collegeTSFileCreates', $collegeTSFileCreates);
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
            return view('college_t_s_file_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSFileCreate = $this->collegeTSFileCreateRepository->create($input);
            
                Flash::success('College T S File Create saved successfully.');
                return redirect(route('collegeTSFileCreates.index'));
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
            $collegeTSFileCreate = $this->collegeTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileCreate))
            {
                Flash::error('College T S File Create not found');
                return redirect(route('collegeTSFileCreates.index'));
            }
    
            $userCollegeTSFiles = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSFiles as $userCollegeTSFile)
            {
                if($userCollegeTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_files')->join('college_topic_sections', 'college_t_s_files.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_files.id', '=', $id)->get();
            
            if($user_id == $collegeTSFileCreate -> user_id || $isShared)
            {
                return view('college_t_s_file_creates.show')->with('collegeTSFileCreate', $collegeTSFileCreate);
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
            $collegeTSFileCreate = $this->collegeTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileCreate))
            {
                Flash::error('College T S File Create not found');
                return redirect(route('collegeTSFileCreates.index'));
            }
            
            $userCollegeTSFiles = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSFiles as $userCollegeTSFile)
            {
                if($userCollegeTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_files')->join('college_topic_sections', 'college_t_s_files.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_files.id', '=', $id)->get();
            
            if($user_id == $collegeTSFileCreate -> user_id || $isShared)
            {
                return view('college_t_s_file_creates.edit')->with('collegeTSFileCreate', $collegeTSFileCreate);
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

    public function update($id, UpdateCollegeTSFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSFileCreate = $this->collegeTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileCreate))
            {
                Flash::error('College T S File Create not found');
                return redirect(route('collegeTSFileCreates.index'));
            }
    
            $userCollegeTSFiles = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSFiles as $userCollegeTSFile)
            {
                if($userCollegeTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_files')->join('college_topic_sections', 'college_t_s_files.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_files.id', '=', $id)->get();
            
            if($user_id == $collegeTSFileCreate -> user_id || $isShared)
            {
                $collegeTSFileCreate = $this->collegeTSFileCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S File Create updated successfully.');
                return redirect(route('collegeTSFileCreates.index'));
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
            $collegeTSFileCreate = $this->collegeTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileCreate))
            {
                Flash::error('College T S File Create not found');
                return redirect(route('collegeTSFileCreates.index'));
            }
            
            $userCollegeTSFiles = DB::table('user_college_t_s_files')->where('college_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSFiles as $userCollegeTSFile)
            {
                if($userCollegeTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_files')->join('college_topic_sections', 'college_t_s_files.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_files.id', '=', $id)->get();
            
            if($user_id == $collegeTSFileCreate -> user_id || $isShared)
            {
                $this->collegeTSFileCreateRepository->delete($id);
            
                Flash::success('College T S File Create deleted successfully.');
                return redirect(route('collegeTSFileCreates.index'));
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