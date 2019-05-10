<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSFileUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSFileUpdateRequest;
use App\Repositories\PersonalDataTSFileUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSFileUpdateController extends AppBaseController
{
    private $personalDataTSFileUpdateRepository;

    public function __construct(PersonalDataTSFileUpdateRepository $personalDataTSFileUpdateRepo)
    {
        $this->personalDataTSFileUpdateRepository = $personalDataTSFileUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSFileUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSFileUpdates = $this->personalDataTSFileUpdateRepository->all();
    
            return view('personal_data_t_s_file_updates.index')
                ->with('personalDataTSFileUpdates', $personalDataTSFileUpdates);
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
            return view('personal_data_t_s_file_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSFileUpdate = $this->personalDataTSFileUpdateRepository->create($input);
            
                Flash::success('PersonalData T S File Update saved successfully.');
                return redirect(route('personalDataTSFileUpdates.index'));
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
            $personalDataTSFileUpdate = $this->personalDataTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileUpdate))
            {
                Flash::error('PersonalData T S File Update not found');
                return redirect(route('personalDataTSFileUpdates.index'));
            }
    
            $userPersonalDataTSFiles = DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSFiles as $userPersonalDataTSFile)
            {
                if($userPersonalDataTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_files')->join('personal_data_topic_sections', 'personal_data_t_s_files.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_files.id', '=', $id)->get();
            
            if($user_id == $personalDataTSFileUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_file_updates.show')->with('personalDataTSFileUpdate', $personalDataTSFileUpdate);
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
            $personalDataTSFileUpdate = $this->personalDataTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileUpdate))
            {
                Flash::error('PersonalData T S File Update not found');
                return redirect(route('personalDataTSFileUpdates.index'));
            }
            
            $userPersonalDataTSFiles = DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSFiles as $userPersonalDataTSFile)
            {
                if($userPersonalDataTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_files')->join('personal_data_topic_sections', 'personal_data_t_s_files.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_files.id', '=', $id)->get();
            
            if($user_id == $personalDataTSFileUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_file_updates.edit')->with('personalDataTSFileUpdate', $personalDataTSFileUpdate);
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

    public function update($id, UpdatePersonalDataTSFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSFileUpdate = $this->personalDataTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileUpdate))
            {
                Flash::error('PersonalData T S File Update not found');
                return redirect(route('personalDataTSFileUpdates.index'));
            }
    
            $userPersonalDataTSFiles = DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSFiles as $userPersonalDataTSFile)
            {
                if($userPersonalDataTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_files')->join('personal_data_topic_sections', 'personal_data_t_s_files.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_files.id', '=', $id)->get();
            
            if($user_id == $personalDataTSFileUpdate -> user_id || $isShared)
            {
                $personalDataTSFileUpdate = $this->personalDataTSFileUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S File Update updated successfully.');
                return redirect(route('personalDataTSFileUpdates.index'));
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
            $personalDataTSFileUpdate = $this->personalDataTSFileUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileUpdate))
            {
                Flash::error('PersonalData T S File Update not found');
                return redirect(route('personalDataTSFileUpdates.index'));
            }
            
            $userPersonalDataTSFiles = DB::table('user_personal_data_t_s_files')->where('personal_data_t_s_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSFiles as $userPersonalDataTSFile)
            {
                if($userPersonalDataTSFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_files')->join('personal_data_topic_sections', 'personal_data_t_s_files.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_files.id', '=', $id)->get();
            
            if($user_id == $personalDataTSFileUpdate -> user_id || $isShared)
            {
                $this->personalDataTSFileUpdateRepository->delete($id);
            
                Flash::success('PersonalData T S File Update deleted successfully.');
                return redirect(route('personalDataTSFileUpdates.index'));
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