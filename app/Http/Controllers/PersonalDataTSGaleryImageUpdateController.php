<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryImageUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryImageUpdateRequest;
use App\Repositories\PersonalDataTSGaleryImageUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryImageUpdateController extends AppBaseController
{
    private $personalDataTSGaleryImageUpdateRepository;

    public function __construct(PersonalDataTSGaleryImageUpdateRepository $personalDataTSGaleryImageUpdateRepo)
    {
        $this->personalDataTSGaleryImageUpdateRepository = $personalDataTSGaleryImageUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryImageUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryImageUpdates = $this->personalDataTSGaleryImageUpdateRepository->all();
    
            return view('personal_data_t_s_galery_image_updates.index')
                ->with('personalDataTSGaleryImageUpdates', $personalDataTSGaleryImageUpdates);
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
            return view('personal_data_t_s_galery_image_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSGaleryImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $personalDataTSGaleryImageUpdate = $this->personalDataTSGaleryImageUpdateRepository->create($input);
            
                Flash::success('PersonalData T S Galery Image Update saved successfully.');
                return redirect(route('personalDataTSGaleryImageUpdates.index'));
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
            $personalDataTSGaleryImageUpdate = $this->personalDataTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageUpdate))
            {
                Flash::error('PersonalData T S Galery Image Update not found');
                return redirect(route('personalDataTSGaleryImageUpdates.index'));
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
            
            if($user_id == $personalDataTSGaleryImageUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_image_updates.show')->with('personalDataTSGaleryImageUpdate', $personalDataTSGaleryImageUpdate);
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
            $personalDataTSGaleryImageUpdate = $this->personalDataTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageUpdate))
            {
                Flash::error('PersonalData T S Galery Image Update not found');
                return redirect(route('personalDataTSGaleryImageUpdates.index'));
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
            
            if($user_id == $personalDataTSGaleryImageUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_image_updates.edit')->with('personalDataTSGaleryImageUpdate', $personalDataTSGaleryImageUpdate);
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

    public function update($id, UpdatePersonalDataTSGaleryImageUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryImageUpdate = $this->personalDataTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageUpdate))
            {
                Flash::error('PersonalData T S Galery Image Update not found');
                return redirect(route('personalDataTSGaleryImageUpdates.index'));
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
            
            if($user_id == $personalDataTSGaleryImageUpdate -> user_id || $isShared)
            {
                $personalDataTSGaleryImageUpdate = $this->personalDataTSGaleryImageUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery Image Update updated successfully.');
                return redirect(route('personalDataTSGaleryImageUpdates.index'));
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
            $personalDataTSGaleryImageUpdate = $this->personalDataTSGaleryImageUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageUpdate))
            {
                Flash::error('PersonalData T S Galery Image Update not found');
                return redirect(route('personalDataTSGaleryImageUpdates.index'));
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
            
            if($user_id == $personalDataTSGaleryImageUpdate -> user_id || $isShared)
            {
                $this->personalDataTSGaleryImageUpdateRepository->delete($id);
            
                Flash::success('PersonalData T S Galery Image Update deleted successfully.');
                return redirect(route('personalDataTSGaleryImageUpdates.index'));
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