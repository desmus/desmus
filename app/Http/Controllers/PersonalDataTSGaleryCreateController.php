<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryCreateRequest;
use App\Repositories\PersonalDataTSGaleryCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryCreateController extends AppBaseController
{
    private $personalDataTSGaleryCreateRepository;

    public function __construct(PersonalDataTSGaleryCreateRepository $personalDataTSGaleryCreateRepo)
    {
        $this->personalDataTSGaleryCreateRepository = $personalDataTSGaleryCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryCreates = $this->personalDataTSGaleryCreateRepository->all();
    
            return view('personal_data_t_s_galery_creates.index')
                ->with('personalDataTSGaleryCreates', $personalDataTSGaleryCreates);
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
            return view('personal_data_t_s_galery_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSGaleryCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSGaleryCreate = $this->personalDataTSGaleryCreateRepository->create($input);
            
                Flash::success('PersonalData T S Galery Create saved successfully.');
                return redirect(route('personalDataTSGaleryCreates.index'));
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
            $personalDataTSGaleryCreate = $this->personalDataTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryCreate))
            {
                Flash::error('PersonalData T S Galery Create not found');
                return redirect(route('personalDataTSGaleryCreates.index'));
            }
            
            $userPersonalDataTSGaleries = DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSGaleries as $userPersonalDataTSGalerie)
            {
                if($userPersonalDataTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_galeries')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $personalDataTSGaleryCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_creates.show')
                    ->with('personalDataTSGaleryCreate', $personalDataTSGaleryCreate);
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
            $personalDataTSGaleryCreate = $this->personalDataTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryCreate))
            {
                Flash::error('PersonalData T S Galery Create not found');
                return redirect(route('personalDataTSGaleryCreates.index'));
            }
            
            $userPersonalDataTSGaleries = DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSGaleries as $userPersonalDataTSGalerie)
            {
                if($userPersonalDataTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_galeries')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $personalDataTSGaleryCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_creates.edit')
                    ->with('personalDataTSGaleryCreate', $personalDataTSGaleryCreate);
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

    public function update($id, UpdatePersonalDataTSGaleryCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryCreate = $this->personalDataTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryCreate))
            {
                Flash::error('PersonalData T S Galery Create not found');
                return redirect(route('personalDataTSGaleryCreates.index'));
            }
            
            $userPersonalDataTSGaleries = DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSGaleries as $userPersonalDataTSGalerie)
            {
                if($userPersonalDataTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_galeries')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $personalDataTSGaleryCreate -> user_id || $isShared)
            {
                $personalDataTSGaleryCreate = $this->personalDataTSGaleryCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery Create updated successfully.');
                return redirect(route('personalDataTSGaleryCreates.index'));
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
            $personalDataTSGaleryCreate = $this->personalDataTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryCreate))
            {
                Flash::error('PersonalData T S Galery Create not found');
                return redirect(route('personalDataTSGaleryCreates.index'));
            }
            
            $userPersonalDataTSGaleries = DB::table('user_personal_data_t_s_galeries')->where('personal_data_t_s_g_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSGaleries as $userPersonalDataTSGalerie)
            {
                if($userPersonalDataTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_galeries')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $personalDataTSGaleryCreate -> user_id || $isShared)
            {
                $this->personalDataTSGaleryCreateRepository->delete($id);
            
                Flash::success('PersonalData T S Galery Create deleted successfully.');
                return redirect(route('personalDataTSGaleryCreates.index'));
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