<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSFileDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSFileDeleteRequest;
use App\Repositories\PersonalDataTSFileDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSFileDeleteController extends AppBaseController
{
    private $personalDataTSFileDeleteRepository;

    public function __construct(PersonalDataTSFileDeleteRepository $personalDataTSFileDeleteRepo)
    {
        $this->personalDataTSFileDeleteRepository = $personalDataTSFileDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSFileDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSFileDeletes = $this->personalDataTSFileDeleteRepository->all();
    
            return view('personal_data_t_s_file_deletes.index')
                ->with('personalDataTSFileDeletes', $personalDataTSFileDeletes);
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
            return view('personal_data_t_s_file_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSFileDelete = $this->personalDataTSFileDeleteRepository->create($input);
            
                Flash::success('PersonalData T S File Delete saved successfully.');
                return redirect(route('personalDataTSFileDeletes.index'));
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
            $personalDataTSFileDelete = $this->personalDataTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileDelete))
            {
                Flash::error('PersonalData T S File Delete not found');
                return redirect(route('personalDataTSFileDeletes.index'));
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
            
            if($user_id == $personalDataTSFileDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_file_deletes.show')->with('personalDataTSFileDelete', $personalDataTSFileDelete);
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
            $personalDataTSFileDelete = $this->personalDataTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileDelete))
            {
                Flash::error('PersonalData T S File Delete not found');
                return redirect(route('personalDataTSFileDeletes.index'));
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
            
            if($user_id == $personalDataTSFileDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_file_deletes.edit')->with('personalDataTSFileDelete', $personalDataTSFileDelete);
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

    public function update($id, UpdatePersonalDataTSFileDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSFileDelete = $this->personalDataTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileDelete))
            {
                Flash::error('PersonalData T S File Delete not found');
                return redirect(route('personalDataTSFileDeletes.index'));
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
            
            if($user_id == $personalDataTSFileDelete -> user_id || $isShared)
            {
                $personalDataTSFileDelete = $this->personalDataTSFileDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S File Delete updated successfully.');
                return redirect(route('personalDataTSFileDeletes.index'));
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
            $personalDataTSFileDelete = $this->personalDataTSFileDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileDelete))
            {
                Flash::error('PersonalData T S File Delete not found');
                return redirect(route('personalDataTSFileDeletes.index'));
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
            
            if($user_id == $personalDataTSFileDelete -> user_id || $isShared)
            {
                $this->personalDataTSFileDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S File Delete deleted successfully.');
                return redirect(route('personalDataTSFileDeletes.index'));
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