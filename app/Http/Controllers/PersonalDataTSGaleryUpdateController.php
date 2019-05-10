<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryUpdateRequest;
use App\Repositories\PersonalDataTSGaleryUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryUpdateController extends AppBaseController
{
    private $personalDataTSGaleryUpdateRepository;

    public function __construct(PersonalDataTSGaleryUpdateRepository $personalDataTSGaleryUpdateRepo)
    {
        $this->personalDataTSGaleryUpdateRepository = $personalDataTSGaleryUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryUpdates = $this->personalDataTSGaleryUpdateRepository->all();
    
            return view('personal_data_t_s_galery_updates.index')
                ->with('personalDataTSGaleryUpdates', $personalDataTSGaleryUpdates);
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
            return view('personal_data_t_s_galery_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSGaleryUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSGaleryUpdate = $this->personalDataTSGaleryUpdateRepository->create($input);
            
                Flash::success('PersonalData T S Galery Update saved successfully.');
                return redirect(route('personalDataTSGaleryUpdates.index'));
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
            $personalDataTSGaleryUpdate = $this->personalDataTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryUpdate))
            {
                Flash::error('PersonalData T S Galery Update not found');
                return redirect(route('personalDataTSGaleryUpdates.index'));
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
            
            if($user_id == $personalDataTSGaleryUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_updates.show')->with('personalDataTSGaleryUpdate', $personalDataTSGaleryUpdate);
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
            $personalDataTSGaleryUpdate = $this->personalDataTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryUpdate))
            {
                Flash::error('PersonalData T S Galery Update not found');
                return redirect(route('personalDataTSGaleryUpdates.index'));
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
            
            if($user_id == $personalDataTSGaleryUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_updates.edit')->with('personalDataTSGaleryUpdate', $personalDataTSGaleryUpdate);
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

    public function update($id, UpdatePersonalDataTSGaleryUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryUpdate = $this->personalDataTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryUpdate))
            {
                Flash::error('PersonalData T S Galery Update not found');
                return redirect(route('personalDataTSGaleryUpdates.index'));
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
            
            if($user_id == $personalDataTSGaleryUpdate -> user_id || $isShared)
            {
                $personalDataTSGaleryUpdate = $this->personalDataTSGaleryUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery Update updated successfully.');
                return redirect(route('personalDataTSGaleryUpdates.index'));
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
            $personalDataTSGaleryUpdate = $this->personalDataTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryUpdate))
            {
                Flash::error('PersonalData T S Galery Update not found');
                return redirect(route('personalDataTSGaleryUpdates.index'));
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
            
            if($user_id == $personalDataTSGaleryUpdate -> user_id || $isShared)
            {
                $this->personalDataTSGaleryUpdateRepository->delete($id);
            
                Flash::success('PersonalData T S Galery Update deleted successfully.');
                return redirect(route('personalDataTSGaleryUpdates.index'));
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