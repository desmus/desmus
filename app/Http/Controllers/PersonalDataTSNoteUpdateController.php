<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSNoteUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSNoteUpdateRequest;
use App\Repositories\PersonalDataTSNoteUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSNoteUpdateController extends AppBaseController
{
    private $personalDataTSNoteUpdateRepository;

    public function __construct(PersonalDataTSNoteUpdateRepository $personalDataTSNoteUpdateRepo)
    {
        $this->personalDataTSNoteUpdateRepository = $personalDataTSNoteUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSNoteUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSNoteUpdates = $this->personalDataTSNoteUpdateRepository->all();
    
            return view('personal_data_t_s_note_updates.index')
                ->with('personalDataTSNoteUpdates', $personalDataTSNoteUpdates);
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
            return view('personal_data_t_s_note_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSNoteUpdate = $this->personalDataTSNoteUpdateRepository->create($input);
            
                Flash::success('PersonalData T S Note Update saved successfully.');
                return redirect(route('personalDataTSNoteUpdates.index'));
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
            $personalDataTSNoteUpdate = $this->personalDataTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteUpdate))
            {
                Flash::error('PersonalData T S Note Update not found');
                return redirect(route('personalDataTSNoteUpdates.index'));
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
            
            if($user_id == $personalDataTSNoteUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_note_updates.show')->with('personalDataTSNoteUpdate', $personalDataTSNoteUpdate);
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
            $personalDataTSNoteUpdate = $this->personalDataTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteUpdate))
            {
                Flash::error('PersonalData T S Note Update not found');
                return redirect(route('personalDataTSNoteUpdates.index'));
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
            
            if($user_id == $personalDataTSNoteUpdate -> user_id || $isShared)
            {
                return view('personal_data_t_s_note_updates.edit')->with('personalDataTSNoteUpdate', $personalDataTSNoteUpdate);
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

    public function update($id, UpdatePersonalDataTSNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSNoteUpdate = $this->personalDataTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteUpdate))
            {
                Flash::error('PersonalData T S Note Update not found');
                return redirect(route('personalDataTSNoteUpdates.index'));
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
            
            if($user_id == $personalDataTSNoteUpdate -> user_id || $isShared)
            {
                $personalDataTSNoteUpdate = $this->personalDataTSNoteUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Note Update updated successfully.');
                return redirect(route('personalDataTSNoteUpdates.index'));
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
            $personalDataTSNoteUpdate = $this->personalDataTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteUpdate))
            {
                Flash::error('PersonalData T S Note Update not found');
                return redirect(route('personalDataTSNoteUpdates.index'));
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
            
            if($user_id == $personalDataTSNoteUpdate -> user_id || $isShared)
            {
                $this->personalDataTSNoteUpdateRepository->delete($id);
        
                Flash::success('PersonalData T S Note Update deleted successfully.');
                return redirect(route('personalDataTSNoteUpdates.index'));
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