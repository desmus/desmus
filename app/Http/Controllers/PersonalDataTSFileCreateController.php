<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSFileCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSFileCreateRequest;
use App\Repositories\PersonalDataTSFileCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSFileCreateController extends AppBaseController
{
    private $personalDataTSFileCreateRepository;

    public function __construct(PersonalDataTSFileCreateRepository $personalDataTSFileCreateRepo)
    {
        $this->personalDataTSFileCreateRepository = $personalDataTSFileCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSFileCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSFileCreates = $this->personalDataTSFileCreateRepository->all();
    
            return view('personal_data_t_s_file_creates.index')
                ->with('personalDataTSFileCreates', $personalDataTSFileCreates);
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
            return view('personal_data_t_s_file_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSFileCreate = $this->personalDataTSFileCreateRepository->create($input);
            
                Flash::success('PersonalData T S File Create saved successfully.');
                return redirect(route('personalDataTSFileCreates.index'));
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
            $personalDataTSFileCreate = $this->personalDataTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileCreate))
            {
                Flash::error('PersonalData T S File Create not found');
                return redirect(route('personalDataTSFileCreates.index'));
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
            
            if($user_id == $personalDataTSFileCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_file_creates.show')->with('personalDataTSFileCreate', $personalDataTSFileCreate);
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
            $personalDataTSFileCreate = $this->personalDataTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileCreate))
            {
                Flash::error('PersonalData T S File Create not found');
                return redirect(route('personalDataTSFileCreates.index'));
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
            
            if($user_id == $personalDataTSFileCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_file_creates.edit')->with('personalDataTSFileCreate', $personalDataTSFileCreate);
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

    public function update($id, UpdatePersonalDataTSFileCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSFileCreate = $this->personalDataTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileCreate))
            {
                Flash::error('PersonalData T S File Create not found');
                return redirect(route('personalDataTSFileCreates.index'));
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
            
            if($user_id == $personalDataTSFileCreate -> user_id || $isShared)
            {
                $personalDataTSFileCreate = $this->personalDataTSFileCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S File Create updated successfully.');
                return redirect(route('personalDataTSFileCreates.index'));
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
            $personalDataTSFileCreate = $this->personalDataTSFileCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileCreate))
            {
                Flash::error('PersonalData T S File Create not found');
                return redirect(route('personalDataTSFileCreates.index'));
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
            
            if($user_id == $personalDataTSFileCreate -> user_id || $isShared)
            {
                $this->personalDataTSFileCreateRepository->delete($id);
            
                Flash::success('PersonalData T S File Create deleted successfully.');
                return redirect(route('personalDataTSFileCreates.index'));
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