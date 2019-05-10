<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSFileViewRequest;
use App\Http\Requests\UpdateCollegeTSFileViewRequest;
use App\Repositories\CollegeTSFileViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSFileViewController extends AppBaseController
{
    private $collegeTSFileViewRepository;

    public function __construct(CollegeTSFileViewRepository $collegeTSFileViewRepo)
    {
        $this->collegeTSFileViewRepository = $collegeTSFileViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSFileViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSFileViews = $this->collegeTSFileViewRepository->all();
    
            return view('college_t_s_file_views.index')
                ->with('collegeTSFileViews', $collegeTSFileViews);
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
            return view('college_t_s_file_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSFileView = $this->collegeTSFileViewRepository->create($input);
            
                Flash::success('College T S File View saved successfully.');
                return redirect(route('collegeTSFileViews.index'));
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
            $collegeTSFileView = $this->collegeTSFileViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileView))
            {
                Flash::error('College T S File View not found');
                return redirect(route('collegeTSFileViews.index'));
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
            
            if($user_id == $collegeTSFileView -> user_id || $isShared)
            {
                return view('college_t_s_file_views.show')->with('collegeTSFileView', $collegeTSFileView);
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
            $collegeTSFileView = $this->collegeTSFileViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileView))
            {
                Flash::error('College T S File View not found');
                return redirect(route('collegeTSFileViews.index'));
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
            
            if($user_id == $collegeTSFileView -> user_id || $isShared)
            {
                return view('college_t_s_file_views.edit')->with('collegeTSFileView', $collegeTSFileView);
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

    public function update($id, UpdateCollegeTSFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSFileView = $this->collegeTSFileViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileView))
            {
                Flash::error('College T S File View not found');
                return redirect(route('collegeTSFileViews.index'));
            }
            
            if($user_id == $collegeTSFileView -> user_id || $isShared)
            {
                $collegeTSFileView = $this->collegeTSFileViewRepository->update($request->all(), $id);
            
                Flash::success('College T S File View updated successfully.');
                return redirect(route('collegeTSFileViews.index'));
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
            $collegeTSFileView = $this->collegeTSFileViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileView))
            {
                Flash::error('College T S File View not found');
                return redirect(route('collegeTSFileViews.index'));
            }
    
            if($user_id == $collegeTSFileView -> user_id || $isShared)
            {
                $this->collegeTSFileViewRepository->delete($id);
            
                Flash::success('College T S File View deleted successfully.');
                return redirect(route('collegeTSFileViews.index'));
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