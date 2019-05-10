<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSNoteDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSNoteDeleteRequest;
use App\Repositories\PersonalDataTSNoteDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSNoteDeleteController extends AppBaseController
{
    private $personalDataTSNoteDeleteRepository;

    public function __construct(PersonalDataTSNoteDeleteRepository $personalDataTSNoteDeleteRepo)
    {
        $this->personalDataTSNoteDeleteRepository = $personalDataTSNoteDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSNoteDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSNoteDeletes = $this->personalDataTSNoteDeleteRepository->all();
    
            return view('personal_data_t_s_note_deletes.index')
                ->with('personalDataTSNoteDeletes', $personalDataTSNoteDeletes);
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
            return view('personal_data_t_s_note_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSNoteDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSNoteDelete = $this->personalDataTSNoteDeleteRepository->create($input);
            
                Flash::success('PersonalData T S Note Delete saved successfully.');
                return redirect(route('personalDataTSNoteDeletes.index'));
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
            $personalDataTSNoteDelete = $this->personalDataTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteDelete))
            {
                Flash::error('PersonalData T S Note Delete not found');
                return redirect(route('personalDataTSNoteDeletes.index'));
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
            
            if($user_id == $personalDataTSNoteDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_note_deletes.show')->with('personalDataTSNoteDelete', $personalDataTSNoteDelete);
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
            $personalDataTSNoteDelete = $this->personalDataTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteDelete))
            {
                Flash::error('PersonalData T S Note Delete not found');
                return redirect(route('personalDataTSNoteDeletes.index'));
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
            
            if($user_id == $personalDataTSNoteDelete -> user_id || $isShared)
            {
                return view('personal_data_t_s_note_deletes.edit')->with('personalDataTSNoteDelete', $personalDataTSNoteDelete);
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

    public function update($id, UpdatePersonalDataTSNoteDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSNoteDelete = $this->personalDataTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteDelete))
            {
                Flash::error('PersonalData T S Note Delete not found');
                return redirect(route('personalDataTSNoteDeletes.index'));
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
            
            if($user_id == $personalDataTSNoteDelete -> user_id || $isShared)
            {
                $personalDataTSNoteDelete = $this->personalDataTSNoteDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Note Delete updated successfully.');
                return redirect(route('personalDataTSNoteDeletes.index'));
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
            $personalDataTSNoteDelete = $this->personalDataTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteDelete))
            {
                Flash::error('PersonalData T S Note Delete not found');
                return redirect(route('personalDataTSNoteDeletes.index'));
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
            
            if($user_id == $personalDataTSNoteDelete -> user_id || $isShared)
            {
                $this->personalDataTSNoteDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S Note Delete deleted successfully.');
                return redirect(route('personalDataTSNoteDeletes.index'));
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