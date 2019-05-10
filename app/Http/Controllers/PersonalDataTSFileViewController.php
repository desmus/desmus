<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSFileViewRequest;
use App\Http\Requests\UpdatePersonalDataTSFileViewRequest;
use App\Repositories\PersonalDataTSFileViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSFileViewController extends AppBaseController
{
    private $personalDataTSFileViewRepository;

    public function __construct(PersonalDataTSFileViewRepository $personalDataTSFileViewRepo)
    {
        $this->personalDataTSFileViewRepository = $personalDataTSFileViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSFileViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSFileViews = $this->personalDataTSFileViewRepository->all();
    
            return view('personal_data_t_s_file_views.index')
                ->with('personalDataTSFileViews', $personalDataTSFileViews);
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
            return view('personal_data_t_s_file_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSFileView = $this->personalDataTSFileViewRepository->create($input);
            
                Flash::success('PersonalData T S File View saved successfully.');
                return redirect(route('personalDataTSFileViews.index'));
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
            $personalDataTSFileView = $this->personalDataTSFileViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileView))
            {
                Flash::error('PersonalData T S File View not found');
                return redirect(route('personalDataTSFileViews.index'));
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
            
            if($user_id == $personalDataTSFileView -> user_id || $isShared)
            {
                return view('personal_data_t_s_file_views.show')->with('personalDataTSFileView', $personalDataTSFileView);
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
            $personalDataTSFileView = $this->personalDataTSFileViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileView))
            {
                Flash::error('PersonalData T S File View not found');
                return redirect(route('personalDataTSFileViews.index'));
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
            
            if($user_id == $personalDataTSFileView -> user_id || $isShared)
            {
                return view('personal_data_t_s_file_views.edit')->with('personalDataTSFileView', $personalDataTSFileView);
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

    public function update($id, UpdatePersonalDataTSFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSFileView = $this->personalDataTSFileViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileView))
            {
                Flash::error('PersonalData T S File View not found');
                return redirect(route('personalDataTSFileViews.index'));
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
            
            if($user_id == $personalDataTSFileView -> user_id || $isShared)
            {
                $personalDataTSFileView = $this->personalDataTSFileViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S File View updated successfully.');
                return redirect(route('personalDataTSFileViews.index'));
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
            $personalDataTSFileView = $this->personalDataTSFileViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSFileView))
            {
                Flash::error('PersonalData T S File View not found');
                return redirect(route('personalDataTSFileViews.index'));
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
            
            if($user_id == $personalDataTSFileView -> user_id || $isShared)
            {
                $this->personalDataTSFileViewRepository->delete($id);
            
                Flash::success('PersonalData T S File View deleted successfully.');
                return redirect(route('personalDataTSFileViews.index'));
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