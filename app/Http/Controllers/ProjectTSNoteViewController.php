<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSNoteViewRequest;
use App\Http\Requests\UpdateProjectTSNoteViewRequest;
use App\Repositories\ProjectTSNoteViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSNoteViewController extends AppBaseController
{
    private $projectTSNoteViewRepository;

    public function __construct(ProjectTSNoteViewRepository $projectTSNoteViewRepo)
    {
        $this->projectTSNoteViewRepository = $projectTSNoteViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSNoteViewRepository->pushCriteria(new RequestCriteria($request));
            $projectTSNoteViews = $this->projectTSNoteViewRepository->all();
    
            return view('project_t_s_note_views.index')
                ->with('projectTSNoteViews', $projectTSNoteViews);
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
            return view('project_t_s_note_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSNoteView = $this->projectTSNoteViewRepository->create($input);
                
                Flash::success('Project T S Note View saved successfully.');
                return redirect(route('projectTSNoteViews.index'));
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
            $projectTSNoteView = $this->projectTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteView))
            {
                Flash::error('Project T S Note View not found');
                return redirect(route('projectTSNoteViews.index'));
            }
    
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $projectTSNoteView -> user_id || $isShared)
            {
                return view('project_t_s_note_views.show')->with('projectTSNoteView', $projectTSNoteView);
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
            $projectTSNoteView = $this->projectTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteView))
            {
                Flash::error('Project T S Note View not found');
                return redirect(route('projectTSNoteViews.index'));
            }
            
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $projectTSNoteView -> user_id || $isShared)
            {
                return view('project_t_s_note_views.edit')->with('projectTSNoteView', $projectTSNoteView);
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

    public function update($id, UpdateProjectTSNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSNoteView = $this->projectTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteView))
            {
                Flash::error('Project T S Note View not found');
                return redirect(route('projectTSNoteViews.index'));
            }
            
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $projectTSNoteView -> user_id || $isShared)
            {
                $projectTSNoteView = $this->projectTSNoteViewRepository->update($request->all(), $id);
                
                Flash::success('Project T S Note View updated successfully.');
                return redirect(route('projectTSNoteViews.index'));
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
            $projectTSNoteView = $this->projectTSNoteViewRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteView))
            {
                Flash::error('Project T S Note View not found');
                return redirect(route('projectTSNoteViews.index'));
            }
            
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $projectTSNoteView -> user_id || $isShared)
            {
                $this->projectTSNoteViewRepository->delete($id);
                
                Flash::success('Project T S Note View deleted successfully.');
                return redirect(route('projectTSNoteViews.index'));
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