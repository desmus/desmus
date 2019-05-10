<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSFileUpdateRequest;
use App\Http\Requests\UpdateCollegeTSFileUpdateRequest;
use App\Repositories\CollegeTSFileUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSFileUpdateController extends AppBaseController
{
    private $collegeTSFileUpdateRepository;

    public function __construct(CollegeTSFileUpdateRepository $collegeTSFileUpdateRepo)
    {
        $this->collegeTSFileUpdateRepository = $collegeTSFileUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSFileUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSFileUpdates = $this->collegeTSFileUpdateRepository->all();
    
            return view('college_t_s_file_updates.index')
                ->with('collegeTSFileUpdates', $collegeTSFileUpdates);
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
            return view('college_t_s_file_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSFileUpdate = $this->collegeTSFileUpdateRepository->create($input);
            
                Flash::success('College T S File Update saved successfully.');
                return redirect(route('collegeTSFileUpdates.index'));
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
            $collegeTSFileUpdate = $this->collegeTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileUpdate))
            {
                Flash::error('College T S File Update not found');
                return redirect(route('collegeTSFileUpdates.index'));
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
            
            if($user_id == $collegeTSFileUpdate -> user_id || $isShared)
            {
                return view('college_t_s_file_updates.show')->with('collegeTSFileUpdate', $collegeTSFileUpdate);
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
            $collegeTSFileUpdate = $this->collegeTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileUpdate))
            {
                Flash::error('College T S File Update not found');
                return redirect(route('collegeTSFileUpdates.index'));
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
            
            if($user_id == $collegeTSFileUpdate -> user_id || $isShared)
            {
                return view('college_t_s_file_updates.edit')->with('collegeTSFileUpdate', $collegeTSFileUpdate);
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

    public function update($id, UpdateCollegeTSFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSFileUpdate = $this->collegeTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileUpdate))
            {
                Flash::error('College T S File Update not found');
                return redirect(route('collegeTSFileUpdates.index'));
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
            
            if($user_id == $collegeTSFileUpdate -> user_id || $isShared)
            {
                $collegeTSFileUpdate = $this->collegeTSFileUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S File Update updated successfully.');
                return redirect(route('collegeTSFileUpdates.index'));
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
            $collegeTSFileUpdate = $this->collegeTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileUpdate))
            {
                Flash::error('College T S File Update not found');
                return redirect(route('collegeTSFileUpdates.index'));
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
            
            if($user_id == $collegeTSFileUpdate -> user_id || $isShared)
            {
                $this->collegeTSFileUpdateRepository->delete($id);
            
                Flash::success('College T S File Update deleted successfully.');
                return redirect(route('collegeTSFileUpdates.index'));
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