<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSNoteViewRequest;
use App\Http\Requests\UpdatePersonalDataTSNoteViewRequest;
use App\Repositories\PersonalDataTSNoteViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSNoteViewController extends AppBaseController
{
    private $personalDataTSNoteViewRepository;

    public function __construct(PersonalDataTSNoteViewRepository $personalDataTSNoteViewRepo)
    {
        $this->personalDataTSNoteViewRepository = $personalDataTSNoteViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSNoteViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSNoteViews = $this->personalDataTSNoteViewRepository->all();
    
            return view('personal_data_t_s_note_views.index')
                ->with('personalDataTSNoteViews', $personalDataTSNoteViews);
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
            return view('personal_data_t_s_note_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSNoteView = $this->personalDataTSNoteViewRepository->create($input);
            
                Flash::success('PersonalData T S Note View saved successfully.');
                return redirect(route('personalDataTSNoteViews.index'));
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
            $personalDataTSNoteView = $this->personalDataTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteView))
            {
                Flash::error('PersonalData T S Note View not found');
                return redirect(route('personalDataTSNoteViews.index'));
            }
    
            $userPersonalDataTSNotes = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSNotes as $userPersonalDataTSNote)
            {
                if($userPersonalDataTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $personalDataTSNoteView -> user_id || $isShared)
            {
                return view('personal_data_t_s_note_views.show')->with('personalDataTSNoteView', $personalDataTSNoteView);
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
            $personalDataTSNoteView = $this->personalDataTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteView))
            {
                Flash::error('PersonalData T S Note View not found');
                return redirect(route('personalDataTSNoteViews.index'));
            }
            
            $userPersonalDataTSNotes = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSNotes as $userPersonalDataTSNote)
            {
                if($userPersonalDataTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $personalDataTSNoteView -> user_id || $isShared)
            {
                return view('personal_data_t_s_note_views.edit')->with('personalDataTSNoteView', $personalDataTSNoteView);
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

    public function update($id, UpdatePersonalDataTSNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSNoteView = $this->personalDataTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteView))
            {
                Flash::error('PersonalData T S Note View not found');
                return redirect(route('personalDataTSNoteViews.index'));
            }
    
            $userPersonalDataTSNotes = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSNotes as $userPersonalDataTSNote)
            {
                if($userPersonalDataTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $personalDataTSNoteView -> user_id || $isShared)
            {
                $personalDataTSNoteView = $this->personalDataTSNoteViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Note View updated successfully.');
                return redirect(route('personalDataTSNoteViews.index'));
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
            $personalDataTSNoteView = $this->personalDataTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteView))
            {
                Flash::error('PersonalData T S Note View not found');
                return redirect(route('personalDataTSNoteViews.index'));
            }
            
            $userPersonalDataTSNotes = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSNotes as $userPersonalDataTSNote)
            {
                if($userPersonalDataTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $personalDataTSNoteView -> user_id || $isShared)
            {
                $this->personalDataTSNoteViewRepository->delete($id);
            
                Flash::success('PersonalData T S Note View deleted successfully.');
                return redirect(route('personalDataTSNoteViews.index'));
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