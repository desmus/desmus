<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSNoteUpdateRequest;
use App\Http\Requests\UpdateCollegeTSNoteUpdateRequest;
use App\Repositories\CollegeTSNoteUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSNoteUpdateController extends AppBaseController
{
    private $collegeTSNoteUpdateRepository;

    public function __construct(CollegeTSNoteUpdateRepository $collegeTSNoteUpdateRepo)
    {
        $this->collegeTSNoteUpdateRepository = $collegeTSNoteUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSNoteUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSNoteUpdates = $this->collegeTSNoteUpdateRepository->all();
    
            return view('college_t_s_note_updates.index')
                ->with('collegeTSNoteUpdates', $collegeTSNoteUpdates);
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
            return view('college_t_s_note_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSNoteUpdate = $this->collegeTSNoteUpdateRepository->create($input);
            
                Flash::success('College T S Note Update saved successfully.');
                return redirect(route('collegeTSNoteUpdates.index'));
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
            $collegeTSNoteUpdate = $this->collegeTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteUpdate))
            {
                Flash::error('College T S Note Update not found');
                return redirect(route('collegeTSNoteUpdates.index'));
            }
            
            $userCollegeTSNotes = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSNotes as $userCollegeTSNote)
            {
                if($userCollegeTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $collegeTSNoteUpdate -> user_id || $isShared)
            {
                return view('college_t_s_note_updates.show')->with('collegeTSNoteUpdate', $collegeTSNoteUpdate);
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
            $collegeTSNoteUpdate = $this->collegeTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteUpdate))
            {
                Flash::error('College T S Note Update not found');
                return redirect(route('collegeTSNoteUpdates.index'));
            }
    
            $userCollegeTSNotes = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSNotes as $userCollegeTSNote)
            {
                if($userCollegeTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $collegeTSNoteUpdate -> user_id || $isShared)
            {
                return view('college_t_s_note_updates.edit')->with('collegeTSNoteUpdate', $collegeTSNoteUpdate);
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

    public function update($id, UpdateCollegeTSNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSNoteUpdate = $this->collegeTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteUpdate))
            {
                Flash::error('College T S Note Update not found');
                return redirect(route('collegeTSNoteUpdates.index'));
            }
    
            $userCollegeTSNotes = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSNotes as $userCollegeTSNote)
            {
                if($userCollegeTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $collegeTSNoteUpdate -> user_id || $isShared)
            {
                $collegeTSNoteUpdate = $this->collegeTSNoteUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S Note Update updated successfully.');
                return redirect(route('collegeTSNoteUpdates.index'));
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
            $collegeTSNoteUpdate = $this->collegeTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteUpdate))
            {
                Flash::error('College T S Note Update not found');
                return redirect(route('collegeTSNoteUpdates.index'));
            }
            
            $userCollegeTSNotes = DB::table('user_college_t_s_notes')->where('college_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSNotes as $userCollegeTSNote)
            {
                if($userCollegeTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_notes')->join('college_topic_sections', 'college_t_s_notes.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $collegeTSNoteUpdate -> user_id || $isShared)
            {
                $this->collegeTSNoteUpdateRepository->delete($id);
            
                Flash::success('College T S Note Update deleted successfully.');
                return redirect(route('collegeTSNoteUpdates.index'));
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