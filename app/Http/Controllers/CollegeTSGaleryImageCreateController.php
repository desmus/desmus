<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryImageCreateRequest;
use App\Http\Requests\UpdateCollegeTSGaleryImageCreateRequest;
use App\Repositories\CollegeTSGaleryImageCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryImageCreateController extends AppBaseController
{
    private $collegeTSGaleryImageCreateRepository;

    public function __construct(CollegeTSGaleryImageCreateRepository $collegeTSGaleryImageCreateRepo)
    {
        $this->collegeTSGaleryImageCreateRepository = $collegeTSGaleryImageCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGaleryImageCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryImageCreates = $this->collegeTSGaleryImageCreateRepository->all();
    
            return view('college_t_s_galery_image_creates.index')
                ->with('collegeTSGaleryImageCreates', $collegeTSGaleryImageCreates);
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
            return view('college_t_s_galery_image_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryImageCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSGaleryImageCreate = $this->collegeTSGaleryImageCreateRepository->create($input);
            
                Flash::success('College T S Galery Image Create saved successfully.');
                return redirect(route('collegeTSGaleryImageCreates.index'));
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
            $collegeTSGaleryImageCreate = $this->collegeTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageCreate))
            {
                Flash::error('College T S Galery Image Create not found');
                return redirect(route('collegeTSGaleryImageCreates.index'));
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
            
            if($user_id == $collegeTSGaleryImageCreate -> user_id || $isShared)
            {
                return view('college_t_s_galery_image_creates.show')->with('collegeTSGaleryImageCreate', $collegeTSGaleryImageCreate);
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
            $collegeTSGaleryImageCreate = $this->collegeTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageCreate))
            {
                Flash::error('College T S Galery Image Create not found');
                return redirect(route('collegeTSGaleryImageCreates.index'));
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
            
            if($user_id == $collegeTSGaleryImageCreate -> user_id || $isShared)
            {
                return view('college_t_s_galery_image_creates.edit')->with('collegeTSGaleryImageCreate', $collegeTSGaleryImageCreate);
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

    public function update($id, UpdateCollegeTSGaleryImageCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGaleryImageCreate = $this->collegeTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageCreate))
            {
                Flash::error('College T S Galery Image Create not found');
                return redirect(route('collegeTSGaleryImageCreates.index'));
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
            
            if($user_id == $collegeTSGaleryImageCreate -> user_id || $isShared)
            {
                $collegeTSGaleryImageCreate = $this->collegeTSGaleryImageCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S Galery Image Create updated successfully.');
                return redirect(route('collegeTSGaleryImageCreates.index'));
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
            $collegeTSGaleryImageCreate = $this->collegeTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageCreate))
            {
                Flash::error('College T S Galery Image Create not found');
                return redirect(route('collegeTSGaleryImageCreates.index'));
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
            
            if($user_id == $collegeTSGaleryImageCreate -> user_id || $isShared)
            {
                $this->collegeTSGaleryImageCreateRepository->delete($id);
            
                Flash::success('College T S Galery Image Create deleted successfully.');
                return redirect(route('collegeTSGaleryImageCreates.index'));
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