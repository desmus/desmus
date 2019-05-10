<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSNoteDeleteRequest;
use App\Http\Requests\UpdateCollegeTSNoteDeleteRequest;
use App\Repositories\CollegeTSNoteDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSNoteDeleteController extends AppBaseController
{
    private $collegeTSNoteDeleteRepository;

    public function __construct(CollegeTSNoteDeleteRepository $collegeTSNoteDeleteRepo)
    {
        $this->collegeTSNoteDeleteRepository = $collegeTSNoteDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSNoteDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSNoteDeletes = $this->collegeTSNoteDeleteRepository->all();
    
            return view('college_t_s_note_deletes.index')
                ->with('collegeTSNoteDeletes', $collegeTSNoteDeletes);
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
            return view('college_t_s_note_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSNoteDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeTSNoteDelete = $this->collegeTSNoteDeleteRepository->create($input);
                
                Flash::success('College T S Note Delete saved successfully.');
                return redirect(route('collegeTSNoteDeletes.index'));
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
            $collegeTSNoteDelete = $this->collegeTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteDelete))
            {
                Flash::error('College T S Note Delete not found');
                return redirect(route('collegeTSNoteDeletes.index'));
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
            
            if($user_id == $collegeTSNoteDelete -> user_id || $isShared)
            {
                return view('college_t_s_note_deletes.show')->with('collegeTSNoteDelete', $collegeTSNoteDelete);
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
            $collegeTSNoteDelete = $this->collegeTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteDelete))
            {
                Flash::error('College T S Note Delete not found');
                return redirect(route('collegeTSNoteDeletes.index'));
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
            
            if($user_id == $collegeTSNoteDelete -> user_id || $isShared)
            {
                return view('college_t_s_note_deletes.edit')->with('collegeTSNoteDelete', $collegeTSNoteDelete);
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

    public function update($id, UpdateCollegeTSNoteDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSNoteDelete = $this->collegeTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteDelete))
            {
                Flash::error('College T S Note Delete not found');
                return redirect(route('collegeTSNoteDeletes.index'));
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
            
            if($user_id == $collegeTSNoteDelete -> user_id || $isShared)
            {
                $collegeTSNoteDelete = $this->collegeTSNoteDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S Note Delete updated successfully.');
                return redirect(route('collegeTSNoteDeletes.index'));
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
            $collegeTSNoteDelete = $this->collegeTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteDelete))
            {
                Flash::error('College T S Note Delete not found');
                return redirect(route('collegeTSNoteDeletes.index'));
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
            
            if($user_id == $collegeTSNoteDelete -> user_id || $isShared)
            {
                $this->collegeTSNoteDeleteRepository->delete($id);
            
                Flash::success('College T S Note Delete deleted successfully.');
                return redirect(route('collegeTSNoteDeletes.index'));
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