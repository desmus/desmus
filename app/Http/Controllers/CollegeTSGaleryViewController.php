<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryViewRequest;
use App\Http\Requests\UpdateCollegeTSGaleryViewRequest;
use App\Repositories\CollegeTSGaleryViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryViewController extends AppBaseController
{
    private $collegeTSGaleryViewRepository;

    public function __construct(CollegeTSGaleryViewRepository $collegeTSGaleryViewRepo)
    {
        $this->collegeTSGaleryViewRepository = $collegeTSGaleryViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGaleryViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryViews = $this->collegeTSGaleryViewRepository->all();
    
            return view('college_t_s_galery_views.index')
                ->with('collegeTSGaleryViews', $collegeTSGaleryViews);
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
            return view('college_t_s_galery_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSGaleryView = $this->collegeTSGaleryViewRepository->create($input);
            
                Flash::success('College T S Galery View saved successfully.');
                return redirect(route('collegeTSGaleryViews.index'));
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
            $collegeTSGaleryView = $this->collegeTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryView))
            {
                Flash::error('College T S Galery View not found');
                return redirect(route('collegeTSGaleryViews.index'));
            }
            
            $userCollegeTSGaleries = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleries as $userCollegeTSGalerie)
            {
                if($userCollegeTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryView -> user_id || $isShared)
            {
                return view('college_t_s_galery_views.show')->with('collegeTSGaleryView', $collegeTSGaleryView);
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
            $collegeTSGaleryView = $this->collegeTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryView))
            {
                Flash::error('College T S Galery View not found');
                return redirect(route('collegeTSGaleryViews.index'));
            }
            
            $userCollegeTSGaleries = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleries as $userCollegeTSGalerie)
            {
                if($userCollegeTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryView -> user_id || $isShared)
            {
                return view('college_t_s_galery_views.edit')->with('collegeTSGaleryView', $collegeTSGaleryView);
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

    public function update($id, UpdateCollegeTSGaleryViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGaleryView = $this->collegeTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryView))
            {
                Flash::error('College T S Galery View not found');
                return redirect(route('collegeTSGaleryViews.index'));
            }
    
            $userCollegeTSGaleries = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleries as $userCollegeTSGalerie)
            {
                if($userCollegeTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryView -> user_id || $isShared)
            {
                $collegeTSGaleryView = $this->collegeTSGaleryViewRepository->update($request->all(), $id);
            
                Flash::success('College T S Galery View updated successfully.');
                return redirect(route('collegeTSGaleryViews.index'));
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
            $collegeTSGaleryView = $this->collegeTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryView))
            {
                Flash::error('College T S Galery View not found');
                return redirect(route('collegeTSGaleryViews.index'));
            }
            
            $userCollegeTSGaleries = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleries as $userCollegeTSGalerie)
            {
                if($userCollegeTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryView -> user_id || $isShared)
            {
                $this->collegeTSGaleryViewRepository->delete($id);
            
                Flash::success('College T S Galery View deleted successfully.');
                return redirect(route('collegeTSGaleryViews.index'));
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