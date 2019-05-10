<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\DeleteCollegeTSFileDeleteRequest;
use App\Http\Requests\UpdateCollegeTSFileDeleteRequest;
use App\Repositories\CollegeTSFileDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSFileDeleteController extends AppBaseController
{
    private $collegeTSFileDeleteRepository;

    public function __construct(CollegeTSFileDeleteRepository $collegeTSFileDeleteRepo)
    {
        $this->collegeTSFileDeleteRepository = $collegeTSFileDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSFileDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSFileDeletes = $this->collegeTSFileDeleteRepository->all();
    
            return view('college_t_s_file_deletes.index')
                ->with('collegeTSFileDeletes', $collegeTSFileDeletes);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function delete()
    {
        if(Auth::user() != null)
        {
            return view('college_t_s_file_deletes.delete');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeleteCollegeTSFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSFileDelete = $this->collegeTSFileDeleteRepository->delete($input);
            
                Flash::success('College T S File Delete saved successfully.');
                return redirect(route('collegeTSFileDeletes.index'));
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
            $collegeTSFileDelete = $this->collegeTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileDelete))
            {
                Flash::error('College T S File Delete not found');
                return redirect(route('collegeTSFileDeletes.index'));
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
            
            if($user_id == $collegeTSFileDelete -> user_id || $isShared)
            {
                return view('college_t_s_file_deletes.show')->with('collegeTSFileDelete', $collegeTSFileDelete);
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
            $collegeTSFileDelete = $this->collegeTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileDelete))
            {
                Flash::error('College T S File Delete not found');
                return redirect(route('collegeTSFileDeletes.index'));
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
            
            if($user_id == $collegeTSFileDelete -> user_id || $isShared)
            {
                return view('college_t_s_file_deletes.edit')->with('collegeTSFileDelete', $collegeTSFileDelete);
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

    public function update($id, UpdateCollegeTSFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSFileDelete = $this->collegeTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileDelete))
            {
                Flash::error('College T S File Delete not found');
                return redirect(route('collegeTSFileDeletes.index'));
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
            
            if($user_id == $collegeTSFileDelete -> user_id || $isShared)
            {
                $collegeTSFileDelete = $this->collegeTSFileDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S File Delete updated successfully.');
                return redirect(route('collegeTSFileDeletes.index'));
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
            $collegeTSFileDelete = $this->collegeTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileDelete))
            {
                Flash::error('College T S File Delete not found');
                return redirect(route('collegeTSFileDeletes.index'));
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
            
            if($user_id == $collegeTSFileDelete -> user_id || $isShared)
            {
                $this->collegeTSFileDeleteRepository->delete($id);
                
                Flash::success('College T S File Delete deleted successfully.');
                return redirect(route('collegeTSFileDeletes.index'));
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