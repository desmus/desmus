<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSNoteCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSNoteCreateRequest;
use App\Repositories\PersonalDataTSNoteCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSNoteCreateController extends AppBaseController
{
    private $personalDataTSNoteCreateRepository;

    public function __construct(PersonalDataTSNoteCreateRepository $personalDataTSNoteCreateRepo)
    {
        $this->personalDataTSNoteCreateRepository = $personalDataTSNoteCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSNoteCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSNoteCreates = $this->personalDataTSNoteCreateRepository->all();
    
            return view('personal_data_t_s_note_creates.index')
                ->with('personalDataTSNoteCreates', $personalDataTSNoteCreates);
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
            return view('personal_data_t_s_note_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSNoteCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $personalDataTSNoteCreate = $this->personalDataTSNoteCreateRepository->create($input);
            
                Flash::success('PersonalData T S Note Create saved successfully.');
                return redirect(route('personalDataTSNoteCreates.index'));
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
            $personalDataTSNoteCreate = $this->personalDataTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteCreate))
            {
                Flash::error('PersonalData T S Note Create not found');
                return redirect(route('personalDataTSNoteCreates.index'));
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
            
            if($user_id == $personalDataTSNoteCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_note_creates.show')->with('personalDataTSNoteCreate', $personalDataTSNoteCreate);
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
            $personalDataTSNoteCreate = $this->personalDataTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteCreate))
            {
                Flash::error('PersonalData T S Note Create not found');
                return redirect(route('personalDataTSNoteCreates.index'));
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
            
            if($user_id == $personalDataTSNoteCreate -> user_id || $isShared)
            {
                return view('personal_data_t_s_note_creates.edit')->with('personalDataTSNoteCreate', $personalDataTSNoteCreate);
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

    public function update($id, UpdatePersonalDataTSNoteCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSNoteCreate = $this->personalDataTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteCreate))
            {
                Flash::error('PersonalData T S Note Create not found');
                return redirect(route('personalDataTSNoteCreates.index'));
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
            
            if($user_id == $personalDataTSNoteCreate -> user_id || $isShared)
            {
                $personalDataTSNoteCreate = $this->personalDataTSNoteCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S Note Create updated successfully.');
                return redirect(route('personalDataTSNoteCreates.index'));
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
            $personalDataTSNoteCreate = $this->personalDataTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNoteCreate))
            {
                Flash::error('PersonalData T S Note Create not found');
                return redirect(route('personalDataTSNoteCreates.index'));
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
            
            if($user_id == $personalDataTSNoteCreate -> user_id || $isShared)
            {
                $this->personalDataTSNoteCreateRepository->delete($id);
            
                Flash::success('PersonalData T S Note Create deleted successfully.');
                return redirect(route('personalDataTSNoteCreates.index'));
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