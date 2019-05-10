<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\DeletePersonalDataTSGaleryDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSGaleryDeleteRequest;
use App\Repositories\PersonalDataTSGaleryDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSGaleryDeleteController extends AppBaseController
{
    private $personalDataTSGaleryDeleteRepository;

    public function __construct(PersonalDataTSGaleryDeleteRepository $personalDataTSGaleryDeleteRepo)
    {
        $this->personalDataTSGaleryDeleteRepository = $personalDataTSGaleryDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSGaleryDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSGaleryDeletes = $this->personalDataTSGaleryDeleteRepository->all();
    
            return view('personal_data_t_s_galery_deletes.index')
                ->with('personalDataTSGaleryDeletes', $personalDataTSGaleryDeletes);
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
            return view('personal_data_t_s_galery_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSGaleryDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSGaleryDelete = $this->personalDataTSGaleryDeleteRepository->create($input);
            
                Flash::success('PersonalData T S Galery Delete saved successfully.');
                return redirect(route('personalDataTSGaleryDeletes.index'));
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
            $personalDataTSGaleryDelete = $this->personalDataTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryDelete))
            {
                Flash::error('PersonalData T S Galery Delete not found');
                return redirect(route('personalDataTSGaleryDeletes.index'));
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
            
            if($user_id == $personalDataTSGaleryDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_deletes.show')
                    ->with('personalDataTSGaleryDelete', $personalDataTSGaleryDelete);
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
            $personalDataTSGaleryDelete = $this->personalDataTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryDelete))
            {
                Flash::error('PersonalData T S Galery Delete not found');
                return redirect(route('personalDataTSGaleryDeletes.index'));
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
            
            if($user_id == $personalDataTSGaleryDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_galery_deletes.edit')
                    ->with('personalDataTSGaleryDelete', $personalDataTSGaleryDelete);
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

    public function update($id, UpdatePersonalDataTSGaleryDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSGaleryDelete = $this->personalDataTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryDelete))
            {
                Flash::error('PersonalData T S Galery Delete not found');
                return redirect(route('personalDataTSGaleryDeletes.index'));
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
            
            if($user_id == $personalDataTSGaleryDelete -> user_id || $isShared)
            {
                $personalDataTSGaleryDelete = $this->personalDataTSGaleryDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Galery Delete updated successfully.');
                return redirect(route('personalDataTSGaleryDeletes.index'));
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
            $personalDataTSGaleryDelete = $this->personalDataTSGaleryDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSGaleryDelete))
            {
                Flash::error('PersonalData T S Galery Delete not found');
                return redirect(route('personalDataTSGaleryDeletes.index'));
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
            
            if($user_id == $personalDataTSGaleryDelete -> user_id || $isShared)
            {
                $this->personalDataTSGaleryDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S Galery Delete deleted successfully.');
                return redirect(route('personalDataTSGaleryDeletes.index'));
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