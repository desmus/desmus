<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryImageCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryImageCreateRequest;
use App\Repositories\PersonalDataTSGaleryImageCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryImageCreateController extends AppBaseController
{
    private $personalDataTSGaleryImageCreateRepository;

    public function __construct(PersonalDataTSGaleryImageCreateRepository $personalDataTSGaleryImageCreateRepo)
    {
        $this->personalDataTSGaleryImageCreateRepository = $personalDataTSGaleryImageCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryImageCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryImageCreates = $this->personalDataTSGaleryImageCreateRepository->all();
    
            return view('personal_data_t_s_galery_image_creates.index')
                ->with('personalDataTSGaleryImageCreates', $personalDataTSGaleryImageCreates);
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
            return view('personal_data_t_s_galery_image_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSGaleryImageCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $personalDataTSGaleryImageCreate = $this->personalDataTSGaleryImageCreateRepository->create($input);
            
                Flash::success('PersonalData T S Galery Image Create saved successfully.');
                return redirect(route('personalDataTSGaleryImageCreates.index'));
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
            $personalDataTSGaleryImageCreate = $this->personalDataTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageCreate))
            {
                Flash::error('PersonalData T S Galery Image Create not found');
                return redirect(route('personalDataTSGaleryImageCreates.index'));
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
            
            if($user_id == $personalDataTSGaleryImageCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_image_creates.show')->with('personalDataTSGaleryImageCreate', $personalDataTSGaleryImageCreate);
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
            $personalDataTSGaleryImageCreate = $this->personalDataTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageCreate))
            {
                Flash::error('PersonalData T S Galery Image Create not found');
                return redirect(route('personalDataTSGaleryImageCreates.index'));
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
            
            if($user_id == $personalDataTSGaleryImageCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_image_creates.edit')->with('personalDataTSGaleryImageCreate', $personalDataTSGaleryImageCreate);
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

    public function update($id, UpdatePersonalDataTSGaleryImageCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryImageCreate = $this->personalDataTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageCreate))
            {
                Flash::error('PersonalData T S Galery Image Create not found');
                return redirect(route('personalDataTSGaleryImageCreates.index'));
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
            
            if($user_id == $personalDataTSGaleryImageCreate -> user_id || $isShared)
            {
                $personalDataTSGaleryImageCreate = $this->personalDataTSGaleryImageCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery Image Create updated successfully.');
                return redirect(route('personalDataTSGaleryImageCreates.index'));
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
            $personalDataTSGaleryImageCreate = $this->personalDataTSGaleryImageCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryImageCreate))
            {
                Flash::error('PersonalData T S Galery Image Create not found');
                return redirect(route('personalDataTSGaleryImageCreates.index'));
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
            
            if($user_id == $personalDataTSGaleryImageCreate -> user_id || $isShared)
            {
                $this->personalDataTSGaleryImageCreateRepository->delete($id);
            
                Flash::success('PersonalData T S Galery Image Create deleted successfully.');
                return redirect(route('personalDataTSGaleryImageCreates.index'));
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