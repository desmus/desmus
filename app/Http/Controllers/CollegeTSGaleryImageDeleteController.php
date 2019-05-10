<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryImageDeleteRequest;
use App\Http\Requests\UpdateCollegeTSGaleryImageDeleteRequest;
use App\Repositories\CollegeTSGaleryImageDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryImageDeleteController extends AppBaseController
{
    private $collegeTSGaleryImageDeleteRepository;

    public function __construct(CollegeTSGaleryImageDeleteRepository $collegeTSGaleryImageDeleteRepo)
    {
        $this->collegeTSGaleryImageDeleteRepository = $collegeTSGaleryImageDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGaleryImageDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryImageDeletes = $this->collegeTSGaleryImageDeleteRepository->all();
    
            return view('college_t_s_galery_image_deletes.index')
                ->with('collegeTSGaleryImageDeletes', $collegeTSGaleryImageDeletes);
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
            return view('college_t_s_galery_image_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryImageDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSGaleryImageDelete = $this->collegeTSGaleryImageDeleteRepository->create($input);
            
                Flash::success('College T S Galery Image Delete saved successfully.');
                return redirect(route('collegeTSGaleryImageDeletes.index'));
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
            $collegeTSGaleryImageDelete = $this->collegeTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageDelete))
            {
                Flash::error('College T S Galery Image Delete not found');
                return redirect(route('collegeTSGaleryImageDeletes.index'));
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
            
            if($user_id == $collegeTSGaleryImageDelete -> user_id || $isShared)
            {
                return view('college_t_s_galery_image_deletes.show')->with('collegeTSGaleryImageDelete', $collegeTSGaleryImageDelete);
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
            $collegeTSGaleryImageDelete = $this->collegeTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageDelete))
            {
                Flash::error('College T S Galery Image Delete not found');
                return redirect(route('collegeTSGaleryImageDeletes.index'));
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
            
            if($user_id == $collegeTSGaleryImageDelete -> user_id || $isShared)
            {
                return view('college_t_s_galery_image_deletes.edit')->with('collegeTSGaleryImageDelete', $collegeTSGaleryImageDelete);
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

    public function update($id, UpdateCollegeTSGaleryImageDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGaleryImageDelete = $this->collegeTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageDelete))
            {
                Flash::error('College T S Galery Image Delete not found');
                return redirect(route('collegeTSGaleryImageDeletes.index'));
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
            
            if($user_id == $collegeTSGaleryImageDelete -> user_id || $isShared)
            {
                $collegeTSGaleryImageDelete = $this->collegeTSGaleryImageDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S Galery Image Delete updated successfully.');
                return redirect(route('collegeTSGaleryImageDeletes.index'));
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
            $collegeTSGaleryImageDelete = $this->collegeTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageDelete))
            {
                Flash::error('College T S Galery Image Delete not found');
                return redirect(route('collegeTSGaleryImageDeletes.index'));
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
            
            if($user_id == $collegeTSGaleryImageDelete -> user_id || $isShared)
            {
                $this->collegeTSGaleryImageDeleteRepository->delete($id);
            
                Flash::success('College T S Galery Image Delete deleted successfully.');
                return redirect(route('collegeTSGaleryImageDeletes.index'));
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