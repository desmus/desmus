<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSGaleryViewRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryViewRequest;
use App\Repositories\PersonalDataTSGaleryViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryViewController extends AppBaseController
{
    private $personalDataTSGaleryViewRepository;

    public function __construct(PersonalDataTSGaleryViewRepository $personalDataTSGaleryViewRepo)
    {
        $this->personalDataTSGaleryViewRepository = $personalDataTSGaleryViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryViews = $this->personalDataTSGaleryViewRepository->all();
    
            return view('personal_data_t_s_galery_views.index')
                ->with('personalDataTSGaleryViews', $personalDataTSGaleryViews);
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
            return view('personal_data_t_s_galery_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSGaleryViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSGaleryView = $this->personalDataTSGaleryViewRepository->create($input);
            
                Flash::success('PersonalData T S Galery View saved successfully.');
                return redirect(route('personalDataTSGaleryViews.index'));
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
            $personalDataTSGaleryView = $this->personalDataTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryView))
            {
                Flash::error('PersonalData T S Galery View not found');
                return redirect(route('personalDataTSGaleryViews.index'));
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
            
            if($user_id == $personalDataTSGaleryView -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_views.show')
                    ->with('personalDataTSGaleryView', $personalDataTSGaleryView);
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
            $personalDataTSGaleryView = $this->personalDataTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryView))
            {
                Flash::error('PersonalData T S Galery View not found');
                return redirect(route('personalDataTSGaleryViews.index'));
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
            
            if($user_id == $personalDataTSGaleryView -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_views.edit')
                    ->with('personalDataTSGaleryView', $personalDataTSGaleryView);
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

    public function update($id, UpdatePersonalDataTSGaleryViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryView = $this->personalDataTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryView))
            {
                Flash::error('PersonalData T S Galery View not found');
                return redirect(route('personalDataTSGaleryViews.index'));
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
            
            if($user_id == $personalDataTSGaleryView -> user_id || $isShared)
            {
                $personalDataTSGaleryView = $this->personalDataTSGaleryViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery View updated successfully.');
                return redirect(route('personalDataTSGaleryViews.index'));
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
            $personalDataTSGaleryView = $this->personalDataTSGaleryViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryView))
            {
                Flash::error('PersonalData T S Galery View not found');
                return redirect(route('personalDataTSGaleryViews.index'));
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
            
            if($user_id == $personalDataTSGaleryView -> user_id || $isShared)
            {
                $this->personalDataTSGaleryViewRepository->delete($id);
            
                Flash::success('PersonalData T S Galery View deleted successfully.');
                return redirect(route('personalDataTSGaleryViews.index'));
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