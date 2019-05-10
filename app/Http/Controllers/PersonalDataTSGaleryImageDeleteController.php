<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryImageDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryImageDeleteRequest;
use App\Repositories\PersonalDataTSGaleryImageDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryImageDeleteController extends AppBaseController
{
    private $personalDataTSGaleryImageDeleteRepository;

    public function __construct(PersonalDataTSGaleryImageDeleteRepository $personalDataTSGaleryImageDeleteRepo)
    {
        $this->personalDataTSGaleryImageDeleteRepository = $personalDataTSGaleryImageDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryImageDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryImageDeletes = $this->personalDataTSGaleryImageDeleteRepository->all();
    
            return view('personal_data_t_s_galery_image_deletes.index')
                ->with('personalDataTSGaleryImageDeletes', $personalDataTSGaleryImageDeletes);
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
            return view('personal_data_t_s_galery_image_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSGaleryImageDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $personalDataTSGaleryImageDelete = $this->personalDataTSGaleryImageDeleteRepository->create($input);
            
                Flash::success('PersonalData T S Galery Image Delete saved successfully.');
                return redirect(route('personalDataTSGaleryImageDeletes.index'));
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
            $personalDataTSGaleryImageDelete = $this->personalDataTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageDelete))
            {
                Flash::error('PersonalData T S Galery Image Delete not found');
                return redirect(route('personalDataTSGaleryImageDeletes.index'));
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
            
            if($user_id == $personalDataTSGaleryImageDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_image_deletes.show')->with('personalDataTSGaleryImageDelete', $personalDataTSGaleryImageDelete);
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
            $personalDataTSGaleryImageDelete = $this->personalDataTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageDelete))
            {
                Flash::error('PersonalData T S Galery Image Delete not found');
                return redirect(route('personalDataTSGaleryImageDeletes.index'));
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
            
            if($user_id == $personalDataTSGaleryImageDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_image_deletes.edit')->with('personalDataTSGaleryImageDelete', $personalDataTSGaleryImageDelete);
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

    public function update($id, UpdatePersonalDataTSGaleryImageDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryImageDelete = $this->personalDataTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageDelete))
            {
                Flash::error('PersonalData T S Galery Image Delete not found');
                return redirect(route('personalDataTSGaleryImageDeletes.index'));
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
            
            if($user_id == $personalDataTSGaleryImageDelete -> user_id || $isShared)
            {
                $personalDataTSGaleryImageDelete = $this->personalDataTSGaleryImageDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery Image Delete updated successfully.');
                return redirect(route('personalDataTSGaleryImageDeletes.index'));
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
            $personalDataTSGaleryImageDelete = $this->personalDataTSGaleryImageDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageDelete))
            {
                Flash::error('PersonalData T S Galery Image Delete not found');
                return redirect(route('personalDataTSGaleryImageDeletes.index'));
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
            
            if($user_id == $personalDataTSGaleryImageDelete -> user_id || $isShared)
            {
                $this->personalDataTSGaleryImageDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S Galery Image Delete deleted successfully.');
                return redirect(route('personalDataTSGaleryImageDeletes.index'));
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