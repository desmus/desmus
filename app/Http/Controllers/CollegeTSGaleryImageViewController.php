<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryImageViewRequest;
use App\Http\Requests\UpdateCollegeTSGaleryImageViewRequest;
use App\Repositories\CollegeTSGaleryImageViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryImageViewController extends AppBaseController
{
    private $collegeTSGaleryImageViewRepository;

    public function __construct(CollegeTSGaleryImageViewRepository $collegeTSGaleryImageViewRepo)
    {
        $this->collegeTSGaleryImageViewRepository = $collegeTSGaleryImageViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGaleryImageViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryImageViews = $this->collegeTSGaleryImageViewRepository->all();
    
            return view('college_t_s_galery_image_views.index')
                ->with('collegeTSGaleryImageViews', $collegeTSGaleryImageViews);
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
            return view('college_t_s_galery_image_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSGaleryImageView = $this->collegeTSGaleryImageViewRepository->create($input);
            
                Flash::success('College T S Galery Image View saved successfully.');
                return redirect(route('collegeTSGaleryImageViews.index'));
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
            $collegeTSGaleryImageView = $this->collegeTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageView))
            {
                Flash::error('College T S Galery Image View not found');
                return redirect(route('collegeTSGaleryImageViews.index'));
            }
            
            $userCollegeTSGaleryImages = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleryImages as $userCollegeTSGaleryImage)
            {
                if($userCollegeTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galery_images')->join('college_t_s_galeries', 'college_t_s_galery_images.college_t_s_g_id', '=', 'college_t_s_galeries.id')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryImageView -> user_id || $isShared)
            {
                return view('college_t_s_galery_image_views.show')->with('collegeTSGaleryImageView', $collegeTSGaleryImageView);
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
            $collegeTSGaleryImageView = $this->collegeTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageView))
            {
                Flash::error('College T S Galery Image View not found');
                return redirect(route('collegeTSGaleryImageViews.index'));
            }
    
            $userCollegeTSGaleryImages = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleryImages as $userCollegeTSGaleryImage)
            {
                if($userCollegeTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galery_images')->join('college_t_s_galeries', 'college_t_s_galery_images.college_t_s_g_id', '=', 'college_t_s_galeries.id')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryImageView -> user_id || $isShared)
            {
                return view('college_t_s_galery_image_views.edit')->with('collegeTSGaleryImageView', $collegeTSGaleryImageView);
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

    public function update($id, UpdateCollegeTSGaleryImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGaleryImageView = $this->collegeTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageView))
            {
                Flash::error('College T S Galery Image View not found');
                return redirect(route('collegeTSGaleryImageViews.index'));
            }
            
            $userCollegeTSGaleryImages = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleryImages as $userCollegeTSGaleryImage)
            {
                if($userCollegeTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galery_images')->join('college_t_s_galeries', 'college_t_s_galery_images.college_t_s_g_id', '=', 'college_t_s_galeries.id')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryImageView -> user_id || $isShared)
            {
                $collegeTSGaleryImageView = $this->collegeTSGaleryImageViewRepository->update($request->all(), $id);
            
                Flash::success('College T S Galery Image View updated successfully.');
                return redirect(route('collegeTSGaleryImageViews.index'));
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
            $collegeTSGaleryImageView = $this->collegeTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageView))
            {
                Flash::error('College T S Galery Image View not found');
                return redirect(route('collegeTSGaleryImageViews.index'));
            }
    
            $userCollegeTSGaleryImages = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleryImages as $userCollegeTSGaleryImage)
            {
                if($userCollegeTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galery_images')->join('college_t_s_galeries', 'college_t_s_galery_images.college_t_s_g_id', '=', 'college_t_s_galeries.id')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryImageView -> user_id || $isShared)
            {
                $this->collegeTSGaleryImageViewRepository->delete($id);
            
                Flash::success('College T S Galery Image View deleted successfully.');
                return redirect(route('collegeTSGaleryImageViews.index'));
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