<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSNoteViewRequest;
use App\Http\Requests\UpdateCollegeTSNoteViewRequest;
use App\Repositories\CollegeTSNoteViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSNoteViewController extends AppBaseController
{
    private $collegeTSNoteViewRepository;

    public function __construct(CollegeTSNoteViewRepository $collegeTSNoteViewRepo)
    {
        $this->collegeTSNoteViewRepository = $collegeTSNoteViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSNoteViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSNoteViews = $this->collegeTSNoteViewRepository->all();
    
            return view('college_t_s_note_views.index')
                ->with('collegeTSNoteViews', $collegeTSNoteViews);
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
            return view('college_t_s_note_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSNoteView = $this->collegeTSNoteViewRepository->create($input);
            
                Flash::success('College T S Note View saved successfully.');
                return redirect(route('collegeTSNoteViews.index'));
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
            $collegeTSNoteView = $this->collegeTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteView))
            {
                Flash::error('College T S Note View not found');
                return redirect(route('collegeTSNoteViews.index'));
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
            
            if($user_id == $collegeTSNoteView -> user_id || $isShared)
            {
                return view('college_t_s_note_views.show')->with('collegeTSNoteView', $collegeTSNoteView);
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
            $collegeTSNoteView = $this->collegeTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteView))
            {
                Flash::error('College T S Note View not found');
                return redirect(route('collegeTSNoteViews.index'));
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
            
            if($user_id == $collegeTSNoteView -> user_id || $isShared)
            {
                return view('college_t_s_note_views.edit')->with('collegeTSNoteView', $collegeTSNoteView);
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

    public function update($id, UpdateCollegeTSNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSNoteView = $this->collegeTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteView))
            {
                Flash::error('College T S Note View not found');
                return redirect(route('collegeTSNoteViews.index'));
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
            
            if($user_id == $collegeTSNoteView -> user_id || $isShared)
            {
                $collegeTSNoteView = $this->collegeTSNoteViewRepository->update($request->all(), $id);
            
                Flash::success('College T S Note View updated successfully.');
                return redirect(route('collegeTSNoteViews.index'));
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
            $collegeTSNoteView = $this->collegeTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteView))
            {
                Flash::error('College T S Note View not found');
                return redirect(route('collegeTSNoteViews.index'));
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
            
            if($user_id == $collegeTSNoteView -> user_id || $isShared)
            {
                $this->collegeTSNoteViewRepository->delete($id);
            
                Flash::success('College T S Note View deleted successfully.');
                return redirect(route('collegeTSNoteViews.index'));
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