<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSNoteCreateRequest;
use App\Http\Requests\UpdateCollegeTSNoteCreateRequest;
use App\Repositories\CollegeTSNoteCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSNoteCreateController extends AppBaseController
{
    private $collegeTSNoteCreateRepository;

    public function __construct(CollegeTSNoteCreateRepository $collegeTSNoteCreateRepo)
    {
        $this->collegeTSNoteCreateRepository = $collegeTSNoteCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSNoteCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSNoteCreates = $this->collegeTSNoteCreateRepository->all();
    
            return view('college_t_s_note_creates.index')
                ->with('collegeTSNoteCreates', $collegeTSNoteCreates);
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
            return view('college_t_s_note_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSNoteCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSNoteCreate = $this->collegeTSNoteCreateRepository->create($input);
            
                Flash::success('College T S Note Create saved successfully.');
                return redirect(route('collegeTSNoteCreates.index'));
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
            $collegeTSNoteCreate = $this->collegeTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteCreate))
            {
                Flash::error('College T S Note Create not found');
                return redirect(route('collegeTSNoteCreates.index'));
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
            
            if($user_id == $collegeTSNoteCreate -> user_id || $isShared)
            {
                return view('college_t_s_note_creates.show')->with('collegeTSNoteCreate', $collegeTSNoteCreate);
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
            $collegeTSNoteCreate = $this->collegeTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteCreate))
            {
                Flash::error('College T S Note Create not found');
                return redirect(route('collegeTSNoteCreates.index'));
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
            
            if($user_id == $collegeTSNoteCreate -> user_id || $isShared)
            {
                return view('college_t_s_note_creates.edit')->with('collegeTSNoteCreate', $collegeTSNoteCreate);
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

    public function update($id, UpdateCollegeTSNoteCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSNoteCreate = $this->collegeTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteCreate))
            {
                Flash::error('College T S Note Create not found');
                return redirect(route('collegeTSNoteCreates.index'));
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
            
            if($user_id == $collegeTSNoteCreate -> user_id || $isShared)
            {
                $collegeTSNoteCreate = $this->collegeTSNoteCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S Note Create updated successfully.');
                return redirect(route('collegeTSNoteCreates.index'));
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
            $collegeTSNoteCreate = $this->collegeTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteCreate))
            {
                Flash::error('College T S Note Create not found');
                return redirect(route('collegeTSNoteCreates.index'));
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
            
            if($user_id == $collegeTSNoteCreate -> user_id || $isShared)
            {
                $this->collegeTSNoteCreateRepository->delete($id);
            
                Flash::success('College T S Note Create deleted successfully.');
                return redirect(route('collegeTSNoteCreates.index'));
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