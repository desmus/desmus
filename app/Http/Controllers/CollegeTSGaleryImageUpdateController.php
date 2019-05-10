<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryImageUpdateRequest;
use App\Http\Requests\UpdateCollegeTSGaleryImageUpdateRequest;
use App\Repositories\CollegeTSGaleryImageUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryImageUpdateController extends AppBaseController
{
    private $collegeTSGaleryImageUpdateRepository;

    public function __construct(CollegeTSGaleryImageUpdateRepository $collegeTSGaleryImageUpdateRepo)
    {
        $this->collegeTSGaleryImageUpdateRepository = $collegeTSGaleryImageUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGaleryImageUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryImageUpdates = $this->collegeTSGaleryImageUpdateRepository->all();
    
            return view('college_t_s_galery_image_updates.index')
                ->with('collegeTSGaleryImageUpdates', $collegeTSGaleryImageUpdates);
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
            return view('college_t_s_galery_image_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSGaleryImageUpdate = $this->collegeTSGaleryImageUpdateRepository->create($input);
            
                Flash::success('College T S Galery Image Update saved successfully.');
                return redirect(route('collegeTSGaleryImageUpdates.index'));
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
            $collegeTSGaleryImageUpdate = $this->collegeTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageUpdate))
            {
                Flash::error('College T S Galery Image Update not found');
                return redirect(route('collegeTSGaleryImageUpdates.index'));
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
            
            if($user_id == $collegeTSGaleryImageUpdate -> user_id || $isShared)
            {
                return view('college_t_s_galery_image_updates.show')->with('collegeTSGaleryImageUpdate', $collegeTSGaleryImageUpdate);
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
            $collegeTSGaleryImageUpdate = $this->collegeTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageUpdate))
            {
                Flash::error('College T S Galery Image Update not found');
                return redirect(route('collegeTSGaleryImageUpdates.index'));
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
            
            if($user_id == $collegeTSGaleryImageUpdate -> user_id || $isShared)
            {
                return view('college_t_s_galery_image_updates.edit')->with('collegeTSGaleryImageUpdate', $collegeTSGaleryImageUpdate);
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

    public function update($id, UpdateCollegeTSGaleryImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGaleryImageUpdate = $this->collegeTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageUpdate))
            {
                Flash::error('College T S Galery Image Update not found');
                return redirect(route('collegeTSGaleryImageUpdates.index'));
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
            
            if($user_id == $collegeTSGaleryImageUpdate -> user_id || $isShared)
            {
                $collegeTSGaleryImageUpdate = $this->collegeTSGaleryImageUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S Galery Image Update updated successfully.');
                return redirect(route('collegeTSGaleryImageUpdates.index'));
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
            $collegeTSGaleryImageUpdate = $this->collegeTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryImageUpdate))
            {
                Flash::error('College T S Galery Image Update not found');
                return redirect(route('collegeTSGaleryImageUpdates.index'));
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
            
            if($user_id == $collegeTSGaleryImageUpdate -> user_id || $isShared)
            {
                $this->collegeTSGaleryImageUpdateRepository->delete($id);
            
                Flash::success('College T S Galery Image Update deleted successfully.');
                return redirect(route('collegeTSGaleryImageUpdates.index'));
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