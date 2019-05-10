<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\ViewPersonalDataTSGaleryImageViewRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryImageViewRequest;
use App\Repositories\PersonalDataTSGaleryImageViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryImageViewController extends AppBaseController
{
    private $personalDataTSGaleryImageViewRepository;

    public function __construct(PersonalDataTSGaleryImageViewRepository $personalDataTSGaleryImageViewRepo)
    {
        $this->personalDataTSGaleryImageViewRepository = $personalDataTSGaleryImageViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryImageViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryImageViews = $this->personalDataTSGaleryImageViewRepository->all();
    
            return view('personal_data_t_s_galery_image_views.index')
                ->with('personalDataTSGaleryImageViews', $personalDataTSGaleryImageViews);
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
            return view('personal_data_t_s_galery_image_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSGaleryImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $personalDataTSGaleryImageView = $this->personalDataTSGaleryImageViewRepository->create($input);
            
                Flash::success('PersonalData T S Galery Image View saved successfully.');
                return redirect(route('personalDataTSGaleryImageViews.index'));
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
            $personalDataTSGaleryImageView = $this->personalDataTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageView))
            {
                Flash::error('PersonalData T S Galery Image View not found');
                return redirect(route('personalDataTSGaleryImageViews.index'));
            }
            
            $userPersonalDataTSGaleryImages = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSGaleryImages as $userPersonalDataTSGaleryImage)
            {
                if($userPersonalDataTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $personalDataTSGaleryImageView -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_image_views.show')->with('personalDataTSGaleryImageView', $personalDataTSGaleryImageView);
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
            $personalDataTSGaleryImageView = $this->personalDataTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageView))
            {
                Flash::error('PersonalData T S Galery Image View not found');
                return redirect(route('personalDataTSGaleryImageViews.index'));
            }
    
            $userPersonalDataTSGaleryImages = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSGaleryImages as $userPersonalDataTSGaleryImage)
            {
                if($userPersonalDataTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $personalDataTSGaleryImageView -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_image_views.edit')->with('personalDataTSGaleryImageView', $personalDataTSGaleryImageView);
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

    public function update($id, UpdatePersonalDataTSGaleryImageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryImageView = $this->personalDataTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageView))
            {
                Flash::error('PersonalData T S Galery Image View not found');
                return redirect(route('personalDataTSGaleryImageViews.index'));
            }
            
            $userPersonalDataTSGaleryImages = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSGaleryImages as $userPersonalDataTSGaleryImage)
            {
                if($userPersonalDataTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $personalDataTSGaleryImageView -> user_id || $isShared)
            {
                $personalDataTSGaleryImageView = $this->personalDataTSGaleryImageViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery Image View updated successfully.');
                return redirect(route('personalDataTSGaleryImageViews.index'));
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
            $personalDataTSGaleryImageView = $this->personalDataTSGaleryImageViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageView))
            {
                Flash::error('PersonalData T S Galery Image View not found');
                return redirect(route('personalDataTSGaleryImageViews.index'));
            }
    
            $userPersonalDataTSGaleryImages = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSGaleryImages as $userPersonalDataTSGaleryImage)
            {
                if($userPersonalDataTSGaleryImage -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galery_images.id', '=', $id)->get();
            
            if($user_id == $personalDataTSGaleryImageView -> user_id || $isShared)
            {
                $this->personalDataTSGaleryImageViewRepository->delete($id);
            
                Flash::success('PersonalData T S Galery Image View deleted successfully.');
                return redirect(route('personalDataTSGaleryImageViews.index'));
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